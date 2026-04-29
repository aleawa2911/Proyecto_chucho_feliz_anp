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

    private function DefinirUsuarioResponsable($id_usuario){
        $stmt = $this->pdo->prepare("SET @id_usuario_responsable = :id_usuario");
        $stmt->execute([":id_usuario"=>$id_usuario]);
    }

    public function ObtenerTodos(){
        $sql = "SELECT 
                    pr.id_proveedor,
                    pr.nombre_proveedor,
                    pr.contacto,
                    pr.telefono,
                    pr.correo,
                    pr.activo
                FROM proveedores pr
                ORDER BY pr.id_proveedor ASC;";
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
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $sql = "UPDATE proveedores
                SET
                    nombre_proveedor = :nombre_proveedor,
                    contacto = :contacto,
                    telefono = :telefono,
                    correo = :correo
                WHERE
                    id_proveedor = :id_proveedor";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_proveedor"=>$id_proveedor,":nombre_proveedor"=>$nombre_proveedor,":contacto"=>$contacto,":telefono"=>$telefono,":correo"=>$correo]);
    }

    public function Insertar($nombre_proveedor,$contacto,$telefono,$correo,$activo,$usuario_creacion){
        $this->DefinirUsuarioResponsable($usuario_creacion);
        $sql = "INSERT INTO proveedores(
                    nombre_proveedor,
                    contacto,
                    telefono,
                    correo,
                    activo)
                VALUES(
                    :nombre_proveedor,
                    :contacto,
                    :telefono,
                    :correo,
                    :activo
                    )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nombre_proveedor"=>$nombre_proveedor,":contacto"=>$contacto,":telefono"=>$telefono,":correo"=>$correo,":activo"=>$activo]);
    }

    public function Desactivar($id_proveedor, $usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $activo = 0;
        $sql = "UPDATE proveedores SET activo = :activo WHERE id_proveedor = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_proveedor, ':activo'=>$activo]);
    } 

    public function Activar($id_proveedor, $usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $activo = 1;
        $sql = "UPDATE proveedores SET activo = :activo WHERE id_proveedor = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_proveedor, ':activo'=>$activo]);
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                pr.id_proveedor,
                pr.nombre_proveedor,
                pr.contacto,
                pr.telefono,
                pr.correo,
                pr.activo
            FROM proveedores pr
            WHERE pr.id_proveedor LIKE :buscar
                OR pr.nombre_proveedor LIKE :buscar
                OR pr.contacto LIKE :buscar
                OR pr.telefono LIKE :buscar
                OR pr.correo LIKE :buscar
                OR (CASE WHEN pr.activo = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
            ORDER BY pr.id_proveedor ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":buscar" => "%".$buscar."%"]);
        return $stmt->fetchAll();
    }

}
?>
