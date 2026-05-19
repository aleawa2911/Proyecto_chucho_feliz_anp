<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class ReporteDevolucionesClienteModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        $sql = "SELECT 
                    d.id_devolucion,
                    d.id_venta,
                    d.id_producto,
                    p.nombre_producto AS producto,
                    d.cantidad,
                    d.fecha,
                    d.razon,
                    u.nombre_usuario AS usuario_responsable
                FROM devoluciones_clientes d
                LEFT JOIN productos p
                    ON d.id_producto = p.id_producto
                LEFT JOIN usuarios u
                    ON d.id_usuario = u.id_usuario
                ORDER BY d.id_devolucion DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                d.id_devolucion,
                d.id_venta,
                d.id_producto,
                p.nombre_producto AS producto,
                d.cantidad,
                d.fecha,
                d.razon,
                u.nombre_usuario AS usuario_responsable
            FROM devoluciones_clientes d
            LEFT JOIN productos p
                ON d.id_producto = p.id_producto
            LEFT JOIN usuarios u
                ON d.id_usuario = u.id_usuario
            WHERE d.id_devolucion LIKE :buscar
                OR d.id_venta LIKE :buscar
                OR d.id_producto LIKE :buscar
                OR p.nombre_producto LIKE :buscar
                OR d.cantidad LIKE :buscar
                OR d.fecha LIKE :buscar
                OR d.razon LIKE :buscar
                OR u.nombre_usuario LIKE :buscar
            ORDER BY d.id_devolucion DESC;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
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
        /*Obtenemos el resumen de devoluciones de clientes segun el periodo elegido*/
        $condicion_fecha = $this->ObtenerCondicionFecha('d.fecha', $tipo_resumen);

        $sql = "SELECT
                    COUNT(*) AS cantidad_registros,
                    IFNULL(SUM(d.cantidad), 0) AS cantidad_productos
                FROM devoluciones_clientes d
                WHERE $condicion_fecha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":fecha_resumen" => $fecha_resumen]);
        return $stmt->fetch();
    }

}
?>
