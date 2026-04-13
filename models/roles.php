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

    /*public function Insertar(){

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([]);
    }*/

    public function Desactivar($id_rol){
        $sql = "UPDATE roles SET activo = 0 WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_rol]);
    } 

    public function Activar($id_rol){
        $sql = "UPDATE roles SET activo = 1 WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_rol]);
    }
}
?>
