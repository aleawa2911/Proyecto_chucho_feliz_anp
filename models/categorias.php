<?php 
require_once __DIR__ . '/../config/conexion.php';
class CategoriasModelo{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }
    public function ObtenerTodos(){
        $sql = "SELECT 
                    c.id_categoria,
                    c.nombre,
                    c.descripcion,
                    c.activo,
                    c.fecha_creacion,
                    c.fecha_actualizacion,
                    uc.nombre_usuario AS usuario_creacion,
                    ua.nombre_usuario AS usuario_actualizacion
                FROM categorias c
                LEFT JOIN usuarios uc 
                    ON c.usuario_creacion = uc.id_usuario
                LEFT JOIN usuarios ua 
                    ON c.usuario_actualizacion = ua.id_usuario;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    /*public function Insertar(){

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([]);
    }*/

    public function Desactivar($id_categoria){
        $sql = "UPDATE categorias SET activo = 0 WHERE id_categoria = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_categoria]);
    } 

    public function Activar($id_categoria){
        $sql = "UPDATE categorias SET activo = 1 WHERE id_categoria = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_categoria]);
    }
}
?>