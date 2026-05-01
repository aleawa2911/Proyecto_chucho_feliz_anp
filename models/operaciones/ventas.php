<?php
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class VentasModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerProductos(){
        /*Obtenemos los productos activos con su stock disponible*/
        $sql = "SELECT
                    p.id_producto,
                    p.codigo,
                    p.nombre_producto,
                    p.precio_venta,
                    COALESCE(SUM(i.stock), 0) AS stock_disponible
                FROM productos p
                LEFT JOIN inventario i
                    ON p.id_producto = i.id_producto
                    AND i.stock > 0
                    AND (i.fecha_vencimiento IS NULL OR i.fecha_vencimiento >= CURDATE())
                WHERE p.activo = 1
                GROUP BY
                    p.id_producto,
                    p.codigo,
                    p.nombre_producto,
                    p.precio_venta
                ORDER BY p.nombre_producto ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ObtenerCajaAbierta(){
        /*Buscamos si existe una caja abierta para registrar ventas*/
        $sql = "SELECT
                    id_cierre,
                    fecha,
                    total_ventas,
                    estado
                FROM cierre_caja
                WHERE estado = 'abierto'
                ORDER BY id_cierre DESC
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function RegistrarVenta($id_usuario, $id_cierre, $detalles){
        /*Chequeamos que vengan detalles de productos*/
        if ($detalles == null) {
            throw new Exception("Debe agregar al menos un producto a la venta.");
        }

        /*Chequeamos que la lista de detalles no esté vacía*/
        if (count($detalles) == 0) {
            throw new Exception("Debe agregar al menos un producto a la venta.");
        }

        /*Chequeamos que exista una caja abierta*/
        if ($id_cierre == null || $id_cierre == '') {
            throw new Exception("Debe abrir caja antes de registrar ventas.");
        }

        try {
            /*Iniciamos una transacción para que se guarde todo junto o nada*/
            $this->pdo->beginTransaction();

            /*Calculamos los totales de la venta*/
            $subtotal_venta = 0;
            foreach ($detalles as $detalle) {
                $cantidad = (int)$detalle['cantidad'];
                $precio_unitario = (float)$detalle['precio_unitario'];
                $subtotal = $cantidad * $precio_unitario;
                $subtotal_venta = $subtotal_venta + $subtotal;
            }

            $iva = round($subtotal_venta * 0.13, 2);
            $total = round($subtotal_venta + $iva, 2);

            /*Insertamos la venta principal*/
            $sql = "INSERT INTO ventas(
                        id_cierre,
                        id_usuario,
                        subtotal,
                        iva,
                        total)
                    VALUES(
                        :id_cierre,
                        :id_usuario,
                        :subtotal,
                        :iva,
                        :total)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_cierre" => $id_cierre,
                ":id_usuario" => $id_usuario,
                ":subtotal" => round($subtotal_venta, 2),
                ":iva" => $iva,
                ":total" => $total
            ]);

            $id_venta = $this->pdo->lastInsertId();

            /*Recorremos cada producto agregado a la venta*/
            foreach ($detalles as $detalle) {
                $id_producto = $detalle['id_producto'];
                $cantidad = (int)$detalle['cantidad'];
                $precio_unitario = (float)$detalle['precio_unitario'];
                $cantidad_pendiente = $cantidad;

                /*Buscamos los lotes disponibles del producto*/
                $lotes = $this->ObtenerLotesDisponibles($id_producto);

                /*Descontamos primero del lote que vence más pronto*/
                foreach ($lotes as $lote) {
                    if ($cantidad_pendiente > 0) {
                        $id_inventario = $lote['id_inventario'];
                        $stock_lote = (int)$lote['stock'];

                        if ($stock_lote >= $cantidad_pendiente) {
                            $cantidad_usada = $cantidad_pendiente;
                        } else {
                            $cantidad_usada = $stock_lote;
                        }

                        $subtotal_detalle = round($cantidad_usada * $precio_unitario, 2);

                        /*Restamos el stock del lote usado*/
                        $sql = "UPDATE inventario
                                SET stock = stock - :cantidad
                                WHERE id_inventario = :id_inventario";
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute([
                            ":cantidad" => $cantidad_usada,
                            ":id_inventario" => $id_inventario
                        ]);

                        /*Insertamos el detalle de la venta con el lote usado*/
                        $sql = "INSERT INTO detalle_ventas(
                                    id_venta,
                                    id_producto,
                                    id_inventario,
                                    cantidad,
                                    precio_unitario,
                                    subtotal)
                                VALUES(
                                    :id_venta,
                                    :id_producto,
                                    :id_inventario,
                                    :cantidad,
                                    :precio_unitario,
                                    :subtotal)";
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute([
                            ":id_venta" => $id_venta,
                            ":id_producto" => $id_producto,
                            ":id_inventario" => $id_inventario,
                            ":cantidad" => $cantidad_usada,
                            ":precio_unitario" => $precio_unitario,
                            ":subtotal" => $subtotal_detalle
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
                                    'venta',
                                    :cantidad,
                                    :id_usuario)";
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute([
                            ":id_producto" => $id_producto,
                            ":id_inventario" => $id_inventario,
                            ":cantidad" => $cantidad_usada,
                            ":id_usuario" => $id_usuario
                        ]);

                        $cantidad_pendiente = $cantidad_pendiente - $cantidad_usada;
                    }
                }

                /*Si no alcanzó el stock, se cancela toda la venta*/
                if ($cantidad_pendiente > 0) {
                    throw new Exception("No hay stock suficiente para completar la venta.");
                }
            }

            /*Actualizamos el total de ventas de la caja abierta*/
            $sql = "UPDATE cierre_caja
                    SET total_ventas = total_ventas + :total
                    WHERE id_cierre = :id_cierre
                        AND estado = 'abierto'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":total" => $total,
                ":id_cierre" => $id_cierre
            ]);

            /*Confirmamos la transacción si todo salió bien*/
            $this->pdo->commit();
            return $id_venta;
        } catch (Exception $e) {
            /*Si algo falla, revertimos la transacción*/
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function ObtenerLotesDisponibles($id_producto){
        /*Obtenemos los lotes con stock usando primero el que vence más pronto*/
        $sql = "SELECT
                    id_inventario,
                    id_producto,
                    lote,
                    stock,
                    fecha_vencimiento
                FROM inventario
                WHERE id_producto = :id_producto
                    AND stock > 0
                    AND (fecha_vencimiento IS NULL OR fecha_vencimiento >= CURDATE())
                ORDER BY
                    CASE WHEN fecha_vencimiento IS NULL THEN 1 ELSE 0 END,
                    fecha_vencimiento ASC,
                    id_inventario ASC
                FOR UPDATE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":id_producto" => $id_producto
        ]);
        return $stmt->fetchAll();
    }
}
?>
