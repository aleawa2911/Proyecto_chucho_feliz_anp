<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class HistorialProductosModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }
    public function ObtenerTodos(){
        $sql = "SELECT 
                    h.id_historial,
                    h.id_producto,
                    h.accion,
                    h.fecha_cambio,
                    ur.nombre_usuario AS usuario_responsable,
                    h.codigo_anterior,
                    h.codigo_nuevo,
                    h.nombre_producto_anterior,
                    h.nombre_producto_nuevo,
                    h.precio_venta_anterior,
                    h.precio_venta_nuevo,
                    h.stock_anterior,
                    h.stock_nuevo,
                    h.stock_defectuoso_anterior,
                    h.stock_defectuoso_nuevo,
                    h.stock_minimo_anterior,
                    h.stock_minimo_nuevo,
                    h.id_categoria_anterior,
                    h.id_categoria_nuevo,
                    h.id_proveedor_anterior,
                    h.id_proveedor_nuevo,
                    h.activo_anterior,
                    h.activo_nuevo,
                    h.fecha_actualizacion_anterior,
                    uaa.nombre_usuario AS usuario_actualizacion_anterior
                FROM historial_productos h
                LEFT JOIN usuarios ur
                    ON h.id_usuario_responsable = ur.id_usuario
                LEFT JOIN usuarios uaa
                    ON h.usuario_actualizacion_anterior = uaa.id_usuario
                ORDER BY h.id_historial DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
}
?>
