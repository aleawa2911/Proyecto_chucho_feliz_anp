<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class CategoriasModelo{

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
                    c.id_categoria,
                    c.nombre_categoria,
                    c.descripcion,
                    c.activo
                FROM categorias c
                ORDER BY c.id_categoria ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function ObtenerPorId($id_categoria){
        $sql = "SELECT
                    id_categoria,
                    nombre_categoria,
                    descripcion
                FROM categorias
                WHERE id_categoria = :id_categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_categoria"=>$id_categoria]);
        $data = $stmt->fetch();
        return $data;
    }

    public function Actualizar($id_categoria,$nombre_categoria,$descripcion,$usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $sql = "UPDATE categorias
                SET
                    nombre_categoria = :nombre_categoria,
                    descripcion = :descripcion
                WHERE
                    id_categoria = :id_categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_categoria"=>$id_categoria,":nombre_categoria"=>$nombre_categoria,":descripcion"=>$descripcion]);
    }

    public function Insertar($nombre_categoria,$descripcion,$activo,$usuario_creacion){
        $this->DefinirUsuarioResponsable($usuario_creacion);
        $sql = "INSERT INTO categorias(
                    nombre_categoria,
                    descripcion,
                    activo
                    )
                VALUES(
                    :nombre_categoria,
                    :descripcion,
                    :activo
                    )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nombre_categoria"=>$nombre_categoria,":descripcion"=>$descripcion,":activo"=>$activo]);
    }

    public function Desactivar($id_categoria,$usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $activo = 0;
        $sql = "UPDATE categorias SET activo = :activo WHERE id_categoria = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_categoria, ':activo'=>$activo]);
    } 

    public function Activar($id_categoria,$usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $activo = 1;
        $sql = "UPDATE categorias SET activo = :activo WHERE id_categoria = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_categoria, ':activo'=>$activo]);
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                c.id_categoria,
                c.nombre_categoria,
                c.descripcion,
                c.activo
            FROM categorias c
            WHERE c.id_categoria LIKE :buscar
                OR c.nombre_categoria LIKE :buscar
                OR c.descripcion LIKE :buscar
                OR (CASE WHEN c.activo = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
            ORDER BY c.id_categoria ASC;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
}

}
?>
