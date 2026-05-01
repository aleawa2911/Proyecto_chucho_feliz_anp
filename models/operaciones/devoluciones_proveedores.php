<?php
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class DevolucionesProveedoresModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerLotesDefectuosos(){
        /*Obtenemos los lotes que tienen stock defectuoso disponible*/
        $sql = "SELECT
                    MIN(d.id_compra) AS id_compra,
                    d.id_producto,
                    d.id_inventario,
                    p.codigo,
                    p.nombre_producto AS producto,
                    i.lote,
                    i.fecha_vencimiento,
                    i.stock_defectuoso
                FROM detalle_compras d
                LEFT JOIN productos p
                    ON d.id_producto = p.id_producto
                LEFT JOIN inventario i
                    ON d.id_inventario = i.id_inventario
                WHERE i.stock_defectuoso > 0
                GROUP BY
                    d.id_producto,
                    d.id_inventario,
                    p.codigo,
                    p.nombre_producto,
                    i.lote,
                    i.fecha_vencimiento,
                    i.stock_defectuoso
                ORDER BY p.nombre_producto ASC, i.fecha_vencimiento ASC, id_compra ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function RegistrarDevolucionProveedor($id_compra, $id_producto, $id_inventario, $cantidad, $razon, $id_usuario){
        /*Chequeamos que la cantidad sea válida*/
        if ($cantidad <= 0) {
            throw new Exception("La cantidad debe ser mayor a cero.");
        }

        try {
            /*Iniciamos una transacción para que se guarde todo junto o nada*/
            $this->pdo->beginTransaction();

            /*Obtenemos la cantidad comprada para ese producto y lote*/
            $sql = "SELECT
                        SUM(cantidad) AS cantidad_comprada
                    FROM detalle_compras
                    WHERE id_compra = :id_compra
                        AND id_producto = :id_producto
                        AND id_inventario = :id_inventario
                    FOR UPDATE";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_compra" => $id_compra,
                ":id_producto" => $id_producto,
                ":id_inventario" => $id_inventario
            ]);
            $compra = $stmt->fetch();

            if ($compra['cantidad_comprada'] == null) {
                $cantidad_comprada = 0;
            } else {
                $cantidad_comprada = (int)$compra['cantidad_comprada'];
            }

            /*Obtenemos la cantidad que ya fue devuelta al proveedor*/
            $sql = "SELECT
                        SUM(cantidad) AS cantidad_devuelta
                    FROM devoluciones_proveedores
                    WHERE id_compra = :id_compra
                        AND id_producto = :id_producto
                        AND id_inventario = :id_inventario
                    FOR UPDATE";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_compra" => $id_compra,
                ":id_producto" => $id_producto,
                ":id_inventario" => $id_inventario
            ]);
            $devolucion = $stmt->fetch();

            if ($devolucion['cantidad_devuelta'] == null) {
                $cantidad_devuelta = 0;
            } else {
                $cantidad_devuelta = (int)$devolucion['cantidad_devuelta'];
            }

            /*Obtenemos el stock defectuoso disponible del lote*/
            $sql = "SELECT
                        stock_defectuoso
                    FROM inventario
                    WHERE id_inventario = :id_inventario
                    FOR UPDATE";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_inventario" => $id_inventario
            ]);
            $inventario = $stmt->fetch();

            if ($inventario == false) {
                throw new Exception("No se encontró el lote.");
            }

            $stock_defectuoso = (int)$inventario['stock_defectuoso'];
            $cantidad_disponible = $cantidad_comprada - $cantidad_devuelta;

            if ($stock_defectuoso < $cantidad_disponible) {
                $cantidad_disponible = $stock_defectuoso;
            }

            /*No dejamos devolver más de lo comprado ni más del stock defectuoso*/
            if ($cantidad > $cantidad_disponible) {
                throw new Exception("No puede devolver más del stock defectuoso disponible.");
            }

            /*Insertamos la devolución al proveedor*/
            $sql = "INSERT INTO devoluciones_proveedores(
                        id_compra,
                        id_producto,
                        id_inventario,
                        cantidad,
                        razon,
                        id_usuario)
                    VALUES(
                        :id_compra,
                        :id_producto,
                        :id_inventario,
                        :cantidad,
                        :razon,
                        :id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_compra" => $id_compra,
                ":id_producto" => $id_producto,
                ":id_inventario" => $id_inventario,
                ":cantidad" => $cantidad,
                ":razon" => $razon,
                ":id_usuario" => $id_usuario
            ]);

            /*Sacamos la cantidad devuelta del stock defectuoso*/
            $sql = "UPDATE inventario
                    SET stock_defectuoso = stock_defectuoso - :cantidad
                    WHERE id_inventario = :id_inventario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":cantidad" => $cantidad,
                ":id_inventario" => $id_inventario
            ]);

            /*Registramos la salida en movimientos de inventario*/
            $sql = "INSERT INTO movimientos_inventario(
                        id_producto,
                        id_inventario,
                        tipo,
                        razon,
                        cantidad,
                        id_usuario)
                    VALUES(
                        :id_producto,
                        :id_inventario,
                        'salida',
                        'devolucion_proveedor',
                        :cantidad,
                        :id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_producto" => $id_producto,
                ":id_inventario" => $id_inventario,
                ":cantidad" => $cantidad,
                ":id_usuario" => $id_usuario
            ]);

            /*Confirmamos la transacción si todo salió bien*/
            $this->pdo->commit();
        } catch (Exception $e) {
            /*Si algo falla, revertimos la transacción*/
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }
}
?>
