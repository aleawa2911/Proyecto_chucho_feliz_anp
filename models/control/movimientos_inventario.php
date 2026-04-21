<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class MovimientosInventarioModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        $sql = "SELECT 
                    m.id_movimiento,
                    m.id_producto,
                    p.nombre_producto AS producto,
                    m.tipo,
                    m.razon,
                    m.cantidad,
                    u.nombre_usuario AS usuario_responsable,
                    m.fecha
                FROM movimientos_inventario m
                LEFT JOIN productos p
                    ON m.id_producto = p.id_producto
                LEFT JOIN usuarios u
                    ON m.id_usuario = u.id_usuario
                ORDER BY m.fecha DESC, m.id_movimiento DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
}
?>
