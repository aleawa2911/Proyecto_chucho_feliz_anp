<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class HistorialRolesModelo{

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
                    h.id_rol,
                    h.accion,
                    h.fecha_cambio,
                    ur.nombre_usuario AS usuario_responsable,
                    h.nombre_rol_anterior,
                    h.nombre_rol_nuevo,
                    h.descripcion_anterior,
                    h.descripcion_nuevo,
                    h.activo_anterior,
                    h.activo_nuevo,
                    h.fecha_actualizacion_anterior,
                    uaa.nombre_usuario AS usuario_actualizacion_anterior
                FROM historial_roles h
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
