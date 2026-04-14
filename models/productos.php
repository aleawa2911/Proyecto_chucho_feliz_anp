<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../config/conexion.php';
class ProductosModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }
    public function ObtenerTodos(){
                $sql = "SELECT 
                    p.id_producto,
                    p.codigo,
                    p.nombre_producto,
                    p.precio_venta,
                    p.stock,
                    p.stock_defectuoso,
                    p.stock_minimo,
                    p.id_categoria,
                    p.id_proveedor,
                    c.nombre_categoria AS categoria,
                    pr.nombre_proveedor AS proveedor,
                    p.activo,
                    p.fecha_creacion,
                    p.fecha_actualizacion,
                    uc.nombre_usuario AS usuario_creacion,
                    ua.nombre_usuario AS usuario_actualizacion
                FROM productos p
                INNER JOIN categorias c 
                    ON p.id_categoria = c.id_categoria
                INNER JOIN proveedores pr 
                    ON p.id_proveedor = pr.id_proveedor
                LEFT JOIN usuarios uc 
                    ON p.usuario_creacion = uc.id_usuario
                LEFT JOIN usuarios ua 
                    ON p.usuario_actualizacion = ua.id_usuario ORDER BY p.activo DESC, p.id_producto ASC";
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
                    stock,
                    stock_defectuoso,
                    stock_minimo,
                    id_categoria,
                    id_proveedor
                FROM productos
                WHERE id_producto = :id_producto";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_producto"=>$id_producto]);
        $data = $stmt->fetch();
        return $data;
    }

    public function Actualizar($id_producto,$codigo,$nombre_producto,$precio_venta,$stock,$stock_defectuoso,$stock_minimo,$id_categoria,$id_proveedor,$usuario_actualizacion){
        $sql = "UPDATE productos
                SET
                    codigo = :codigo,
                    nombre_producto = :nombre_producto,
                    precio_venta = :precio_venta,
                    stock = :stock,
                    stock_defectuoso = :stock_defectuoso,
                    stock_minimo = :stock_minimo,
                    id_categoria = :id_categoria,
                    id_proveedor = :id_proveedor,
                    usuario_actualizacion = :usuario_actualizacion
                WHERE
                    id_producto = :id_producto";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_producto"=>$id_producto,":codigo"=>$codigo,":nombre_producto"=>$nombre_producto,":precio_venta"=>$precio_venta,":stock"=>$stock,":stock_defectuoso"=>$stock_defectuoso,":stock_minimo"=>$stock_minimo,":id_categoria"=>$id_categoria,":id_proveedor"=>$id_proveedor,":usuario_actualizacion"=>$usuario_actualizacion]);
    }

    public function ObtenerProveedor(){
        $sql = "SELECT 
                    pr.nombre_proveedor,
                    pr.id_proveedor
                FROM productos p
                RIGHT JOIN proveedores pr 
                    ON p.id_proveedor = pr.id_proveedor";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function ObtenerCategoria(){
        $sql = "SELECT 
                    c.nombre_categoria,
                    c.id_categoria
                FROM productos p
                RIGHT JOIN categorias c
                    ON p.id_categoria = c.id_categoria";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function Insertar($codigo,$nombre_producto,$precio_venta,$stock,$stock_defectuoso,$stock_minimo,$id_categoria,$id_proveedor,$activo,$usuario_creacion){
        $sql = "INSERT IGNORE INTO productos(
                    codigo,
                    nombre_producto,
                    precio_venta,
                    stock,
                    stock_defectuoso,
                    stock_minimo,
                    id_categoria,
                    id_proveedor,
                    activo,
                    usuario_creacion)
                VALUES(
                    :codigo,
                    :nombre_producto,
                    :precio_venta,
                    :stock,
                    :stock_defectuoso,
                    :stock_minimo,
                    :id_categoria,
                    :id_proveedor,
                    :activo,
                    :usuario_creacion
                    )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":codigo"=>$codigo,":nombre_producto"=>$nombre_producto,":precio_venta"=>$precio_venta,":stock"=>$stock,":stock_defectuoso"=>$stock_defectuoso,":stock_minimo"=>$stock_minimo,":id_categoria"=>$id_categoria,":id_proveedor"=>$id_proveedor,":activo"=>$activo, ":usuario_creacion"=>$usuario_creacion]);
    }

    public function Desactivar($id_producto, $usuario_actualizacion){
        $activo = 0;
        $sql = "UPDATE productos SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_producto = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_producto, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    } 

    public function Activar($id_producto, $usuario_actualizacion){
        $activo = 1;
        $sql = "UPDATE productos SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_producto = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_producto, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    }
}
?>
