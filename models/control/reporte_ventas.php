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
                ORDER BY v.fecha DESC, v.id_venta DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
}
?>
