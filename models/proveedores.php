<?php 
require_once __DIR__ . '/../config/conexion.php';
class ProveedoresModelo{
    private $pdo;

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
                    ON pr.usuario_actualizacion = ua.id_usuario;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function Insertar($nombre_proveedor,$contacto,$telefono,$correo,$activo,$usuario_creacion){
        $sql = "INSERT IGNORE INTO proveedores(
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