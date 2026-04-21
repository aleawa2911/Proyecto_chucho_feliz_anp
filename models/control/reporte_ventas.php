<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class ReporteVentasModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        $sql = "SELECT 
                    v.id_venta,
                    v.id_cierre,
                    v.fecha,
                    u.nombre_usuario AS usuario_responsable,
                    v.subtotal,
                    v.iva,
                    v.total
                FROM ventas v
                LEFT JOIN usuarios u
                    ON v.id_usuario = u.id_usuario
                ORDER BY v.id_venta DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                v.id_venta,
                v.id_cierre,
                v.fecha,
                u.nombre_usuario AS usuario_responsable,
                v.subtotal,
                v.iva,
                v.total
            FROM ventas v
            LEFT JOIN usuarios u
                ON v.id_usuario = u.id_usuario
            WHERE v.id_venta LIKE :buscar
                OR v.id_cierre LIKE :buscar
                OR v.fecha LIKE :buscar
                OR u.nombre_usuario LIKE :buscar
                OR v.subtotal LIKE :buscar
                OR v.iva LIKE :buscar
                OR v.total LIKE :buscar
            ORDER BY v.id_venta DESC;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
}

    public function ObtenerDetalleVenta($id_venta){
        $sql = "SELECT
                    d.id_detalle,
                    d.id_producto,
                    p.nombre_producto AS producto,
                    d.cantidad,
                    d.precio_unitario,
                    d.subtotal
                FROM detalle_ventas d
                LEFT JOIN productos p
                    ON d.id_producto = p.id_producto
                WHERE d.id_venta = :id_venta
                ORDER BY d.id_detalle ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_venta" => $id_venta]);
        $data = $stmt->fetchAll();
        return $data;
    }

}
?>
