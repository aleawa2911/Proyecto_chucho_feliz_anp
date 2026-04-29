<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class HistorialUsuariosModelo{

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
                    h.id_usuario,
                    h.accion,
                    h.fecha_cambio,
                    ur.nombre_usuario AS usuario_responsable,
                    h.primer_nombre_anterior,
                    h.primer_nombre_nuevo,
                    h.segundo_nombre_anterior,
                    h.segundo_nombre_nuevo,
                    h.primer_apellido_anterior,
                    h.primer_apellido_nuevo,
                    h.segundo_apellido_anterior,
                    h.segundo_apellido_nuevo,
                    h.nombre_usuario_anterior,
                    h.nombre_usuario_nuevo,
                    h.correo_anterior,
                    h.correo_nuevo,
                    h.id_rol_anterior,
                    h.id_rol_nuevo,
                    h.activo_anterior,
                    h.activo_nuevo
                FROM historial_usuarios h
                LEFT JOIN usuarios ur
                    ON h.id_usuario_responsable = ur.id_usuario
                ORDER BY h.id_historial DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
        $sql = "SELECT 
                    h.id_historial,
                    h.id_usuario,
                    h.accion,
                    h.fecha_cambio,
                    ur.nombre_usuario AS usuario_responsable,
                    h.primer_nombre_anterior,
                    h.primer_nombre_nuevo,
                    h.segundo_nombre_anterior,
                    h.segundo_nombre_nuevo,
                    h.primer_apellido_anterior,
                    h.primer_apellido_nuevo,
                    h.segundo_apellido_anterior,
                    h.segundo_apellido_nuevo,
                    h.nombre_usuario_anterior,
                    h.nombre_usuario_nuevo,
                    h.correo_anterior,
                    h.correo_nuevo,
                    h.id_rol_anterior,
                    h.id_rol_nuevo,
                    h.activo_anterior,
                    h.activo_nuevo
                FROM historial_usuarios h
                LEFT JOIN usuarios ur
                    ON h.id_usuario_responsable = ur.id_usuario
                WHERE h.id_historial LIKE :buscar
                    OR h.id_usuario LIKE :buscar
                    OR h.accion LIKE :buscar
                    OR h.fecha_cambio LIKE :buscar
                    OR ur.nombre_usuario LIKE :buscar
                    OR h.primer_nombre_anterior LIKE :buscar
                    OR h.primer_nombre_nuevo LIKE :buscar
                    OR h.segundo_nombre_anterior LIKE :buscar
                    OR h.segundo_nombre_nuevo LIKE :buscar
                    OR h.primer_apellido_anterior LIKE :buscar
                    OR h.primer_apellido_nuevo LIKE :buscar
                    OR h.segundo_apellido_anterior LIKE :buscar
                    OR h.segundo_apellido_nuevo LIKE :buscar
                    OR h.nombre_usuario_anterior LIKE :buscar
                    OR h.nombre_usuario_nuevo LIKE :buscar
                    OR h.correo_anterior LIKE :buscar
                    OR h.correo_nuevo LIKE :buscar
                    OR h.id_rol_anterior LIKE :buscar
                    OR h.id_rol_nuevo LIKE :buscar
                    OR h.activo_anterior LIKE :buscar
                    OR h.activo_nuevo LIKE :buscar
                    OR (CASE WHEN h.activo_anterior = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
                    OR (CASE WHEN h.activo_nuevo = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
                ORDER BY h.id_historial DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":buscar" => "%".$buscar."%"]);
        return $stmt->fetchAll();
    }


}
?>
