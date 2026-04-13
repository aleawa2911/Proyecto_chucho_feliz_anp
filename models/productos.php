<?php 
require_once __DIR__ . '/../config/conexion.php';
class ProductosModelo{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }
    public function ObtenerTodos(){
        $sql = "SELECT 
                    p.id_producto,
                    p.codigo,
                    p.nombre,
                    p.precio_venta,
                    p.stock,
                    p.stock_defectuoso,
                    p.stock_minimo,
                    c.nombre AS categoria,
                    pr.nombre AS proveedor,
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
                    ON p.usuario_actualizacion = ua.id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    /*public function Insertar(){

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([]);
    }*/

    public function Desactivar($id_producto){
        $sql = "UPDATE productos SET activo = 0 WHERE id_producto = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_producto]);
    } 

    public function Activar($id_producto){
        $sql = "UPDATE productos SET activo = 1 WHERE id_producto = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_producto]);
    }
}
?>