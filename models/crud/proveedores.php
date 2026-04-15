<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class ProveedoresModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }
    public function ObtenerTodos(){
        $sql = "SELECT 
                    pr.id_proveedor,
                    pr.nombre_proveedor,
                    pr.contacto,
                    pr.telefono,
                    pr.correo,
                    pr.activo,
                    pr.fecha_creacion,
                    pr.fecha_actualizacion,
                    uc.nombre_usuario AS usuario_creacion,
                    ua.nombre_usuario AS usuario_actualizacion
                FROM proveedores pr
                LEFT JOIN usuarios uc 
                    ON pr.usuario_creacion = uc.id_usuario
                LEFT JOIN usuarios ua 
                    ON pr.usuario_actualizacion = ua.id_usuario ORDER BY pr.id_proveedor ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function ObtenerPorId($id_proveedor){
        $sql = "SELECT
                    id_proveedor,
                    nombre_proveedor,
                    contacto,
                    telefono,
                    correo
                FROM proveedores
                WHERE id_proveedor = :id_proveedor";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_proveedor"=>$id_proveedor]);
        $data = $stmt->fetch();
        return $data;
    }

    public function Actualizar($id_proveedor,$nombre_proveedor,$contacto,$telefono,$correo,$usuario_actualizacion){
        $sql = "UPDATE proveedores
                SET
                    nombre_proveedor = :nombre_proveedor,
                    contacto = :contacto,
                    telefono = :telefono,
                    correo = :correo,
                    usuario_actualizacion = :usuario_actualizacion
                WHERE
                    id_proveedor = :id_proveedor";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_proveedor"=>$id_proveedor,":nombre_proveedor"=>$nombre_proveedor,":contacto"=>$contacto,":telefono"=>$telefono,":correo"=>$correo,":usuario_actualizacion"=>$usuario_actualizacion]);
    }

    public function Insertar($nombre_proveedor,$contacto,$telefono,$correo,$activo,$usuario_creacion){
        $sql = "INSERT INTO proveedores(
                    nombre_proveedor,
                    contacto,
                    telefono,
                    correo,
                    activo,
                    usuario_creacion)
                VALUES(
                    :nombre_proveedor,
                    :contacto,
                    :telefono,
                    :correo,
                    :activo,
                    :usuario_creacion
                    )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nombre_proveedor"=>$nombre_proveedor,":contacto"=>$contacto,":telefono"=>$telefono,":correo"=>$correo,":activo"=>$activo,":usuario_creacion"=>$usuario_creacion]);
    }

    public function Desactivar($id_proveedor, $usuario_actualizacion){
        $activo = 0;
        $sql = "UPDATE proveedores SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_proveedor = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_proveedor, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    } 

    public function Activar($id_proveedor, $usuario_actualizacion){
        $activo = 1;
        $sql = "UPDATE proveedores SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_proveedor = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_proveedor, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    }
}
?>
