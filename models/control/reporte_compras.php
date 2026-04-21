<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class ReporteComprasModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        $sql = "SELECT 
                    c.id_compra,
                    c.id_proveedor,
                    p.nombre_proveedor AS proveedor,
                    c.fecha,
                    c.total,
                    u.nombre_usuario AS usuario_responsable
                FROM compras c
                LEFT JOIN proveedores p
                    ON c.id_proveedor = p.id_proveedor
                LEFT JOIN usuarios u
                    ON c.id_usuario = u.id_usuario
                ORDER BY c.id_compra DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                c.id_compra,
                c.id_proveedor,
                p.nombre_proveedor AS proveedor,
                c.fecha,
                c.total,
                u.nombre_usuario AS usuario_responsable
            FROM compras c
            LEFT JOIN proveedores p
                ON c.id_proveedor = p.id_proveedor
            LEFT JOIN usuarios u
                ON c.id_usuario = u.id_usuario
            WHERE c.id_compra LIKE :buscar
                OR c.id_proveedor LIKE :buscar
                OR p.nombre_proveedor LIKE :buscar
                OR c.fecha LIKE :buscar
                OR c.total LIKE :buscar
                OR u.nombre_usuario LIKE :buscar
            ORDER BY c.id_compra DESC;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
}

    public function ObtenerDetalleCompra($id_compra){
        $sql = "SELECT
                    d.id_detalle,
                    d.id_producto,
                    p.nombre_producto AS producto,
                    d.cantidad,
                    d.precio_unitario,
                    d.subtotal
                FROM detalle_compras d
                LEFT JOIN productos p
                    ON d.id_producto = p.id_producto
                WHERE d.id_compra = :id_compra
                ORDER BY d.id_detalle ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_compra" => $id_compra]);
        $data = $stmt->fetchAll();
        return $data;
    }

}
?>
