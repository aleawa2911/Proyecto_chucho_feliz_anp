<?php 
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class ReporteVentasModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        /*Obtenemos las ventas registradas con usuario responsable*/
        $sql = "SELECT 
                    v.id_venta,
                    v.id_cierre,
                    v.fecha,
                    u.nombre_usuario AS usuario_responsable,
                    v.subtotal,
                    v.iva,
                    v.total
                FROM ventas v
                LEFT JOIN usuarios u
                    ON v.id_usuario = u.id_usuario
                ORDER BY v.id_venta DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
        /*Buscamos ventas por datos generales*/
        $sql = "SELECT 
                    v.id_venta,
                    v.id_cierre,
                    v.fecha,
                    u.nombre_usuario AS usuario_responsable,
                    v.subtotal,
                    v.iva,
                    v.total
                FROM ventas v
                LEFT JOIN usuarios u
                    ON v.id_usuario = u.id_usuario
                WHERE v.id_venta LIKE :buscar
                    OR v.id_cierre LIKE :buscar
                    OR v.fecha LIKE :buscar
                    OR u.nombre_usuario LIKE :buscar
                    OR v.subtotal LIKE :buscar
                    OR v.iva LIKE :buscar
                    OR v.total LIKE :buscar
                ORDER BY v.id_venta DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":buscar" => "%".$buscar."%"]);
        return $stmt->fetchAll();
    }

    public function ObtenerDetalleVenta($id_venta){
        /*Obtenemos los productos que pertenecen a una venta*/
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
                FROM detalle_ventas d
                LEFT JOIN productos p
                    ON d.id_producto = p.id_producto
                LEFT JOIN inventario i
                    ON d.id_inventario = i.id_inventario
                WHERE d.id_venta = :id_venta
                ORDER BY d.id_detalle ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_venta" => $id_venta]);
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
        /*Obtenemos el resumen de ventas segun el periodo elegido*/
        $condicion_fecha = $this->ObtenerCondicionFecha('v.fecha', $tipo_resumen);

        $sql = "SELECT
                    COUNT(*) AS cantidad_registros,
                    IFNULL(SUM(v.subtotal), 0) AS subtotal,
                    IFNULL(SUM(v.iva), 0) AS iva,
                    IFNULL(SUM(v.total), 0) AS total
                FROM ventas v
                WHERE $condicion_fecha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":fecha_resumen" => $fecha_resumen]);
        return $stmt->fetch();
    }

}
?>
