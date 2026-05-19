<?php 
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class ReporteComprasModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        /*Obtenemos las compras registradas con proveedor y usuario responsable*/
        $sql = "SELECT 
                    c.id_compra,
                    c.id_proveedor,
                    p.nombre_proveedor AS proveedor,
                    c.fecha,
                    c.total,
                    u.nombre_usuario AS usuario_responsable
                FROM compras c
                LEFT JOIN proveedores p
                    ON c.id_proveedor = p.id_proveedor
                LEFT JOIN usuarios u
                    ON c.id_usuario = u.id_usuario
                ORDER BY c.id_compra DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
        /*Buscamos compras por datos generales*/
        $sql = "SELECT 
                    c.id_compra,
                    c.id_proveedor,
                    p.nombre_proveedor AS proveedor,
                    c.fecha,
                    c.total,
                    u.nombre_usuario AS usuario_responsable
                FROM compras c
                LEFT JOIN proveedores p
                    ON c.id_proveedor = p.id_proveedor
                LEFT JOIN usuarios u
                    ON c.id_usuario = u.id_usuario
                WHERE c.id_compra LIKE :buscar
                    OR c.id_proveedor LIKE :buscar
                    OR p.nombre_proveedor LIKE :buscar
                    OR c.fecha LIKE :buscar
                    OR c.total LIKE :buscar
                    OR u.nombre_usuario LIKE :buscar
                ORDER BY c.id_compra DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":buscar" => "%".$buscar."%"]);
        return $stmt->fetchAll();
    }

    public function ObtenerDetalleCompra($id_compra){
        /*Obtenemos los productos que pertenecen a una compra*/
        $sql = "SELECT
                    d.id_detalle,
                    d.id_producto,
                    p.codigo,
                    p.nombre_producto AS producto,
                    d.id_inventario,
                    i.lote,
                    i.fecha_vencimiento,
                    d.cantidad,
                    d.precio_unitario,
                    d.subtotal
                FROM detalle_compras d
                LEFT JOIN productos p
                    ON d.id_producto = p.id_producto
                LEFT JOIN inventario i
                    ON d.id_inventario = i.id_inventario
                WHERE d.id_compra = :id_compra
                ORDER BY d.id_detalle ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_compra" => $id_compra]);
        $data = $stmt->fetchAll();
        return $data;
    }

    private function ObtenerCondicionFecha($campo_fecha, $tipo_resumen){
        if ($tipo_resumen == 'mes') {
            return "YEAR($campo_fecha) = YEAR(:fecha_resumen) AND MONTH($campo_fecha) = MONTH(:fecha_resumen)";
        }

        if ($tipo_resumen == 'anio') {
            return "YEAR($campo_fecha) = YEAR(:fecha_resumen)";
        }

        return "DATE($campo_fecha) = :fecha_resumen";
    }

    public function ObtenerResumen($tipo_resumen, $fecha_resumen){
        /*Obtenemos el resumen de compras segun el periodo elegido*/
        $condicion_fecha = $this->ObtenerCondicionFecha('c.fecha', $tipo_resumen);

        $sql = "SELECT
                    COUNT(*) AS cantidad_registros,
                    IFNULL(SUM(c.total), 0) AS total
                FROM compras c
                WHERE $condicion_fecha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":fecha_resumen" => $fecha_resumen]);
        return $stmt->fetch();
    }

}
?>
