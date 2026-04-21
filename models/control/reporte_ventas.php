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
                v.fecha,
                u.nombre_usuario AS usuario_responsable,
                v.subtotal,
                v.iva,
                v.total
            FROM ventas v
            LEFT JOIN usuarios u
                ON v.id_usuario = u.id_usuario
            WHERE v.id_venta LIKE :buscar
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

}
?>
