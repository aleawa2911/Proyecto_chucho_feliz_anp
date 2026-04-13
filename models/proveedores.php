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
                    pr.nombre,
                    pr.contacto,
                    pr.telefono,
                    pr.email,
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

    /*public function Insertar(){

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([]);
    }*/

    public function Desactivar($id_proveedor){
        $sql = "UPDATE proveedores SET activo = 0 WHERE id_proveedor = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_proveedor]);
    } 

    public function Activar($id_proveedor){
        $sql = "UPDATE proveedores SET activo = 1 WHERE id_proveedor = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_proveedor]);
    }
}
?>