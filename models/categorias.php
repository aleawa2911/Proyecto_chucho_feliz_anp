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
                    c.nombre_categoria,
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

    public function Insertar($nombre_categoria,$descripcion,$activo,$usuario_creacion){
        $sql = "INSERT IGNORE INTO categorias(
                    nombre_categoria,
                    descripcion,
                    activo,
                    usuario_creacion
                    )
                VALUES(
                    :nombre_categoria,
                    :descripcion,
                    :activo,
                    :usuario_creacion
                    )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nombre_categoria"=>$nombre_categoria,":descripcion"=>$descripcion,":activo"=>$activo, ":usuario_creacion"=>$usuario_creacion]);
    }

    public function Desactivar($id_categoria,$usuario_actualizacion){
        $activo = 0;
        $sql = "UPDATE categorias SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_categoria = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_categoria, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    } 

    public function Activar($id_categoria,$usuario_actualizacion){
        $activo = 1;
        $sql = "UPDATE categorias SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_categoria = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_categoria, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    }
}
?>