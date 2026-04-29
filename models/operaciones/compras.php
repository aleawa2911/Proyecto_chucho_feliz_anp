<?php
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class ComprasModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerProveedores(){
        /*Obtenemos los proveedores activos para llenar el select*/
        $sql = "SELECT
                    id_proveedor,
                    nombre_proveedor
                FROM proveedores
                WHERE activo = 1
                ORDER BY nombre_proveedor ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ObtenerProductos(){
        /*Obtenemos los productos activos para llenar el select*/
        $sql = "SELECT
                    id_producto,
                    codigo,
                    nombre_producto
                FROM productos
                WHERE activo = 1
                ORDER BY nombre_producto ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function RegistrarCompra($id_proveedor, $id_usuario, $detalles){
        /*Chequeamos que vengan detalles de productos*/
        if ($detalles == null) {
            throw new Exception("Debe agregar al menos un producto a la compra.");
        }

        /*Chequeamos que la lista de detalles no este vacia*/
        if (count($detalles) == 0) {
            throw new Exception("Debe agregar al menos un producto a la compra.");
        }

        try {
            /*Iniciamos una transacción para que se guarde todo junto o nada*/
            $this->pdo->beginTransaction();

            /*Calculamos el total de la compra sumando los subtotales*/
            $total = 0;
            foreach ($detalles as $detalle) {
                $cantidad = (int)$detalle['cantidad'];
                $precio_unitario = (float)$detalle['precio_unitario'];
                $subtotal = $cantidad * $precio_unitario;
                $total = $total + $subtotal;
            }

            /*Insertamos la compra principal*/
            $sql = "INSERT INTO compras(
                        id_proveedor,
                        total,
                        id_usuario)
                    VALUES(
                        :id_proveedor,
                        :total,
                        :id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":id_proveedor" => $id_proveedor,
                ":total" => round($total, 2),
                ":id_usuario" => $id_usuario
            ]);

            $id_compra = $this->pdo->lastInsertId();

            /*Recorremos cada producto agregado a la compra*/
            foreach ($detalles as $detalle) {
                /*Guardamos los datos del detalle en variables*/
                $id_producto = $detalle['id_producto'];
                $lote = trim($detalle['lote']);
                $cantidad = (int)$detalle['cantidad'];
                $precio_unitario = (float)$detalle['precio_unitario'];
                
                /*Si la fecha de vencimiento viene vacía, la dejamos como null*/
                $fecha_vencimiento = $detalle['fecha_vencimiento'];

                if ($fecha_vencimiento === '') {
                    $fecha_vencimiento = null;
                }

                /*Si viene solo mes y año, le agregamos día para guardarla en la DB*/
                if ($fecha_vencimiento != null) {
                    if (strlen($fecha_vencimiento) == 7) {
                        $fecha_vencimiento = $fecha_vencimiento . '-01';
                    }
                }

                /*Calculamos el subtotal del producto*/
                $subtotal = round($cantidad * $precio_unitario, 2);

                /*Buscamos si ya existe ese lote para ese producto*/
                $lote_existente = $this->BuscarLote($id_producto, $lote);

                /*Si el lote ya existe, usamos su id y aumentamos el stock*/
                if ($lote_existente != false) {
                    $id_inventario = $lote_existente['id_inventario'];

                    $sql = "UPDATE inventario
                            SET stock = stock + :cantidad
                            WHERE id_inventario = :id_inventario";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([
                        ":cantidad" => $cantidad,
                        ":id_inventario" => $id_inventario
                    ]);
                } else {
                    /*Si el lote no existe, creamos un registro nuevo en inventario*/
                    $sql = "INSERT INTO inventario(
                                id_producto,
                                lote,
                                stock,
                                stock_defectuoso,
                                fecha_vencimiento)
                            VALUES(
                                :id_producto,
                                :lote,
                                :stock,
                                0,
                                :fecha_vencimiento)";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([
                        ":id_producto" => $id_producto,
                        ":lote" => $lote,
                        ":stock" => $cantidad,
                        ":fecha_vencimiento" => $fecha_vencimiento
                    ]);
                    $id_inventario = $this->pdo->lastInsertId();
                }

                /*Insertamos el detalle de la compra con el lote usado*/
                $sql = "INSERT INTO detalle_compras(
                            id_compra,
                            id_producto,
                            id_inventario,
                            cantidad,
                            precio_unitario,
                            subtotal)
                        VALUES(
                            :id_compra,
                            :id_producto,
                            :id_inventario,
                            :cantidad,
                            :precio_unitario,
                            :subtotal)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ":id_compra" => $id_compra,
                    ":id_producto" => $id_producto,
                    ":id_inventario" => $id_inventario,
                    ":cantidad" => $cantidad,
                    ":precio_unitario" => $precio_unitario,
                    ":subtotal" => $subtotal
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
                            'compra',
                            :cantidad,
                            :id_usuario)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ":id_producto" => $id_producto,
                    ":id_inventario" => $id_inventario,
                    ":cantidad" => $cantidad,
                    ":id_usuario" => $id_usuario
                ]);
            }

            /*Confirmamos la transacción si todo salió bien*/
            $this->pdo->commit();
            return $id_compra;
        } catch (Exception $e) {
            /*Si algo falla, revertimos la transaccion*/
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function BuscarLote($id_producto, $lote){
        /*Buscamos si ya existe el lote para ese producto*/
        $sql = "SELECT
                    id_inventario,
                    id_producto,
                    lote,
                    stock
                FROM inventario
                WHERE id_producto = :id_producto
                    AND lote = :lote
                LIMIT 1
                FOR UPDATE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":id_producto" => $id_producto,
            ":lote" => $lote
        ]);
        return $stmt->fetch();
    }
}
?>
