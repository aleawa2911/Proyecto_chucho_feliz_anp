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

    private function DefinirUsuarioResponsable($id_usuario){
        $stmt = $this->pdo->prepare("SET @id_usuario_responsable = :id_usuario");
        $stmt->execute([":id_usuario"=>$id_usuario]);
    }

    public function ObtenerTodos(){
        $sql = "SELECT 
                    r.id_rol,
                    r.nombre_rol,
                    r.descripcion,
                    r.activo
                FROM roles r
                ORDER BY r.id_rol ASC;";
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
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $sql = "UPDATE roles 
                SET 
                    nombre_rol = :nombre_rol,
                    descripcion = :descripcion
                WHERE 
                    id_rol = :id_rol";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_rol"=>$id_rol,":nombre_rol"=>$nombre_rol,":descripcion"=>$descripcion]);
    }

    public function Insertar($nombre_rol,$descripcion,$activo,$usuario_creacion){
        $this->DefinirUsuarioResponsable($usuario_creacion);
        $sql = "INSERT INTO roles(
                    nombre_rol,
                    descripcion,
                    activo)
                VALUES(
                    :nombre_rol,
                    :descripcion,
                    :activo
                    )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nombre_rol"=>$nombre_rol,":descripcion"=>$descripcion,":activo"=>$activo]);
    }

    public function Desactivar($id_rol,$usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $activo = 0;
        $sql = "UPDATE roles SET activo = :activo WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_rol, ':activo'=>$activo]);
    } 

    public function Activar($id_rol,$usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $activo = 1;
        $sql = "UPDATE roles SET activo = :activo WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_rol, ':activo'=>$activo]);
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                r.id_rol,
                r.nombre_rol,
                r.descripcion,
                r.activo
            FROM roles r
            WHERE r.id_rol LIKE :buscar
                OR r.nombre_rol LIKE :buscar
                OR r.descripcion LIKE :buscar
                OR (CASE WHEN r.activo = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
            ORDER BY r.id_rol ASC;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
}

}
?>
