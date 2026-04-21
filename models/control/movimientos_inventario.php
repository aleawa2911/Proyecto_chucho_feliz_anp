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
                ORDER BY m.id_movimiento DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
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
            WHERE m.id_movimiento LIKE :buscar
                OR m.id_producto LIKE :buscar
                OR p.nombre_producto LIKE :buscar
                OR m.tipo LIKE :buscar
                OR m.razon LIKE :buscar
                OR m.cantidad LIKE :buscar
                OR u.nombre_usuario LIKE :buscar
                OR m.fecha LIKE :buscar
            ORDER BY m.id_movimiento DESC;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
}

}
?>
