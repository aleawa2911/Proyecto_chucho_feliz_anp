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
                ORDER BY c.fecha DESC, c.id_compra DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
}
?>
