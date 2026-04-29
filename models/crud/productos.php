<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class ProductosModelo{

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
                    p.id_producto,
                    p.codigo,
                    p.nombre_producto,
                    p.precio_venta,
                    p.id_categoria,
                    p.id_proveedor,
                    c.nombre_categoria AS categoria,
                    pr.nombre_proveedor AS proveedor,
                    p.activo
                FROM productos p
                INNER JOIN categorias c 
                    ON p.id_categoria = c.id_categoria
                INNER JOIN proveedores pr 
                    ON p.id_proveedor = pr.id_proveedor
                ORDER BY p.id_producto ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function ObtenerPorId($id_producto){
        $sql = "SELECT
                    id_producto,
                    codigo,
                    nombre_producto,
                    precio_venta,
                    id_categoria,
                    id_proveedor
                FROM productos
                WHERE id_producto = :id_producto";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_producto"=>$id_producto]);
        $data = $stmt->fetch();
        return $data;
    }

    public function Actualizar($id_producto,$codigo,$nombre_producto,$precio_venta,$id_categoria,$id_proveedor,$usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $sql = "UPDATE productos
                SET
                    codigo = :codigo,
                    nombre_producto = :nombre_producto,
                    precio_venta = :precio_venta,
                    id_categoria = :id_categoria,
                    id_proveedor = :id_proveedor
                WHERE
                    id_producto = :id_producto";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_producto"=>$id_producto,":codigo"=>$codigo,":nombre_producto"=>$nombre_producto,":precio_venta"=>$precio_venta,":id_categoria"=>$id_categoria,":id_proveedor"=>$id_proveedor]);
    }

    public function ObtenerProveedor(){
        $sql = "SELECT 
                    id_proveedor,
                    nombre_proveedor
                FROM proveedores
                ORDER BY nombre_proveedor ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function ObtenerCategoria(){
        $sql = "SELECT 
                    id_categoria,
                    nombre_categoria
                FROM categorias
                ORDER BY nombre_categoria ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function Insertar($codigo,$nombre_producto,$precio_venta,$id_categoria,$id_proveedor,$activo,$usuario_creacion){
        $this->DefinirUsuarioResponsable($usuario_creacion);
        $sql = "INSERT INTO productos(
                    codigo,
                    nombre_producto,
                    precio_venta,
                    id_categoria,
                    id_proveedor,
                    activo)
                VALUES(
                    :codigo,
                    :nombre_producto,
                    :precio_venta,
                    :id_categoria,
                    :id_proveedor,
                    :activo
                    )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":codigo"=>$codigo,":nombre_producto"=>$nombre_producto,":precio_venta"=>$precio_venta,":id_categoria"=>$id_categoria,":id_proveedor"=>$id_proveedor,":activo"=>$activo]);
    }

    public function Desactivar($id_producto, $usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $activo = 0;
        $sql = "UPDATE productos SET activo = :activo WHERE id_producto = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_producto, ':activo'=>$activo]);
    } 

    public function Activar($id_producto, $usuario_actualizacion){
        $this->DefinirUsuarioResponsable($usuario_actualizacion);
        $activo = 1;
        $sql = "UPDATE productos SET activo = :activo WHERE id_producto = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_producto, ':activo'=>$activo]);
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                p.id_producto,
                p.codigo,
                p.nombre_producto,
                p.precio_venta,
                p.id_categoria,
                p.id_proveedor,
                c.nombre_categoria AS categoria,
                pr.nombre_proveedor AS proveedor,
                p.activo
            FROM productos p
            INNER JOIN categorias c 
                ON p.id_categoria = c.id_categoria
            INNER JOIN proveedores pr 
                ON p.id_proveedor = pr.id_proveedor
            WHERE p.id_producto LIKE :buscar
                OR p.codigo LIKE :buscar
                OR p.nombre_producto LIKE :buscar
                OR p.precio_venta LIKE :buscar
                OR p.id_categoria LIKE :buscar
                OR p.id_proveedor LIKE :buscar
                OR c.nombre_categoria LIKE :buscar
                OR pr.nombre_proveedor LIKE :buscar
                OR (CASE WHEN p.activo = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
            ORDER BY p.id_producto ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
}

}
?>
