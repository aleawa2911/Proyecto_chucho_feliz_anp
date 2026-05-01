<?php
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class DevolucionesVentasModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerDetalleVenta($id_venta){
        /*Obtenemos los productos vendidos y la cantidad disponible para devolver*/
        $sql = "SELECT
                    d.id_venta,
                    d.id_producto,
                    d.id_inventario,
                    p.codigo,
                    p.nombre_producto AS producto,
                    i.lote,
                    i.fecha_vencimiento,
                    d.precio_unitario,
                    SUM(d.cantidad) AS cantidad_vendida,
                    COALESCE(dev.cantidad_devuelta, 0) AS cantidad_devuelta,
                    SUM(d.cantidad) - COALESCE(dev.cantidad_devuelta, 0) AS cantidad_disponible
                FROM detalle_ventas d
                LEFT JOIN productos p
                    ON d.id_producto = p.id_producto
                LEFT JOIN inventario i
                    ON d.id_inventario = i.id_inventario
                LEFT JOIN (
                    SELECT
                        id_venta,
                        id_producto,
                        id_inventario,
                        SUM(cantidad) AS cantidad_devuelta
                    FROM devoluciones_clientes
                    GROUP BY
                        id_venta,
                        id_producto,
                        id_inventario
                ) dev
                    ON d.id_venta = dev.id_venta
                    AND d.id_producto = dev.id_producto
                    AND d.id_inventario = dev.id_inventario
                WHERE d.id_venta = :id_venta
                GROUP BY
                    d.id_venta,
                    d.id_producto,
                    d.id_inventario,
                    p.codigo,
                    p.nombre_producto,
                    i.lote,
                    i.fecha_vencimiento,
                    d.precio_unitario,
                    dev.cantidad_devuelta
                ORDER BY p.nombre_producto ASC, i.fecha_vencimiento ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":id_venta" => $id_venta
        ]);
        return $stmt->fetchAll();
    }

    public function RegistrarDevolucionCliente($id_venta, $id_producto, $id_inventario, $cantidad, $razon, $id_usuario){
        /*Chequeamos que la cantidad sea válida*/
        if ($cantidad <= 0) {
            throw new Exception("La cantidad debe ser mayor a cero.");
        }

        try {
            /*Iniciamos una transacción para que se guarde todo junto o nada*/
            $this->pdo->beginTransaction();

            /*Obtenemos la cantidad vendida para ese producto y lote*/
            $sql = "SELECT
                        COALESCE(SUM(cantidad), 0) AS cantidad_vendida
                    FROM detalle_ventas
                    WHERE id_venta = :id_venta
                        AND id_producto = :id_producto
                        AND id_inventario = :id_inventario
                    FOR UPDATE";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_venta" => $id_venta,
                ":id_producto" => $id_producto,
                ":id_inventario" => $id_inventario
            ]);
            $venta = $stmt->fetch();
            $cantidad_vendida = (int)$venta['cantidad_vendida'];

            /*Obtenemos la cantidad que ya fue devuelta*/
            $sql = "SELECT
                        COALESCE(SUM(cantidad), 0) AS cantidad_devuelta
                    FROM devoluciones_clientes
                    WHERE id_venta = :id_venta
                        AND id_producto = :id_producto
                        AND id_inventario = :id_inventario
                    FOR UPDATE";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_venta" => $id_venta,
                ":id_producto" => $id_producto,
                ":id_inventario" => $id_inventario
            ]);
            $devolucion = $stmt->fetch();
            $cantidad_devuelta = (int)$devolucion['cantidad_devuelta'];

            $cantidad_disponible = $cantidad_vendida - $cantidad_devuelta;

            /*No dejamos devolver más de lo vendido*/
            if ($cantidad > $cantidad_disponible) {
                throw new Exception("No puede devolver más de lo vendido.");
            }

            /*Insertamos la devolución del cliente*/
            $sql = "INSERT INTO devoluciones_clientes(
                        id_venta,
                        id_producto,
                        id_inventario,
                        cantidad,
                        razon,
                        id_usuario)
                    VALUES(
                        :id_venta,
                        :id_producto,
                        :id_inventario,
                        :cantidad,
                        :razon,
                        :id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_venta" => $id_venta,
                ":id_producto" => $id_producto,
                ":id_inventario" => $id_inventario,
                ":cantidad" => $cantidad,
                ":razon" => $razon,
                ":id_usuario" => $id_usuario
            ]);

            /*Si viene defectuoso, lo mandamos a stock defectuoso*/
            if ($razon == 'Defectuoso') {
                $sql = "UPDATE inventario
                        SET stock_defectuoso = stock_defectuoso + :cantidad
                        WHERE id_inventario = :id_inventario";
                $razon_movimiento = 'devolucion_cliente_defectuoso';
            } else {
                /*Si no viene defectuoso, vuelve al stock disponible*/
                $sql = "UPDATE inventario
                        SET stock = stock + :cantidad
                        WHERE id_inventario = :id_inventario";
                $razon_movimiento = 'devolucion_cliente';
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":cantidad" => $cantidad,
                ":id_inventario" => $id_inventario
            ]);

            /*Registramos la entrada en movimientos de inventario*/
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
                        'entrada',
                        :razon,
                        :cantidad,
                        :id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_producto" => $id_producto,
                ":id_inventario" => $id_inventario,
                ":razon" => $razon_movimiento,
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
