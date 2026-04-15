<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class RolesModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
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
                    ON r.usuario_actualizacion = ua.id_usuario ORDER BY r.id_rol ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function ObtenerPorId($id_rol){
        $sql = "SELECT
                    id_rol,
                    nombre_rol,
                    descripcion
                FROM roles
                WHERE id_rol = :id_rol";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_rol"=>$id_rol]);
        $data = $stmt->fetch();
        return $data;
    }

    public function Actualizar($id_rol,$nombre_rol,$descripcion,$usuario_actualizacion){
        $sql = "UPDATE roles 
                SET 
                    nombre_rol = :nombre_rol,
                    descripcion = :descripcion,
                    usuario_actualizacion = :usuario_actualizacion
                WHERE 
                    id_rol = :id_rol";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_rol"=>$id_rol,":nombre_rol"=>$nombre_rol,":descripcion"=>$descripcion,":usuario_actualizacion"=>$usuario_actualizacion]);
    }

    public function Insertar($nombre_rol,$descripcion,$activo,$usuario_creacion){
        $sql = "INSERT INTO roles(
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
