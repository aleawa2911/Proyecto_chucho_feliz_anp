<?php 
require_once __DIR__ . '/../config/conexion.php';
class RolesModelo{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }
    public function ObtenerTodos(){
        $sql = "SELECT 
                    r.id_rol,
                    r.nombre_rol,
                    r.descripcion,
                    r.activo,
                    r.fecha_creacion,
                    r.fecha_actualizacion,
                    uc.nombre_usuario AS usuario_creacion,
                    ua.nombre_usuario AS usuario_actualizacion
                FROM roles r
                LEFT JOIN usuarios uc 
                    ON r.usuario_creacion = uc.id_usuario
                LEFT JOIN usuarios ua 
                    ON r.usuario_actualizacion = ua.id_usuario;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function Insertar($nombre_rol,$descripcion,$activo,$usuario_creacion){
        $sql = "INSERT IGNORE INTO roles(
                    nombre_rol,
                    descripcion,
                    activo,
                    usuario_creacion)
                VALUES(
                    :nombre_rol,
                    :descripcion,
                    :activo,
                    :usuario_creacion
                    )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nombre_rol"=>$nombre_rol,":descripcion"=>$descripcion,":activo"=>$activo,":usuario_creacion"=>$usuario_creacion]);
    }

    public function Desactivar($id_rol,$usuario_actualizacion){
        $activo = 0;
        $sql = "UPDATE roles SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_rol, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    } 

    public function Activar($id_rol,$usuario_actualizacion){
        $activo = 1;
        $sql = "UPDATE roles SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_rol, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    }
}
?>
