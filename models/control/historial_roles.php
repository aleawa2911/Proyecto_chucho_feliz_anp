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

    public function BuscarPorTexto($buscar){
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
                WHERE h.id_historial LIKE :buscar
                    OR h.id_rol LIKE :buscar
                    OR h.accion LIKE :buscar
                    OR h.fecha_cambio LIKE :buscar
                    OR ur.nombre_usuario LIKE :buscar
                    OR h.nombre_rol_anterior LIKE :buscar
                    OR h.nombre_rol_nuevo LIKE :buscar
                    OR h.descripcion_anterior LIKE :buscar
                    OR h.descripcion_nuevo LIKE :buscar
                    OR h.activo_anterior LIKE :buscar
                    OR h.activo_nuevo LIKE :buscar
                    OR (CASE WHEN h.activo_anterior = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
                    OR (CASE WHEN h.activo_nuevo = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
                    OR h.fecha_actualizacion_anterior LIKE :buscar
                    OR uaa.nombre_usuario LIKE :buscar
                ORDER BY h.id_historial DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":buscar" => "%".$buscar."%"]);
        return $stmt->fetchAll();
    }


}
?>
