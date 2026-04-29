<?php
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class InventarioModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        /*Obtenemos los lotes de inventario junto con los datos del producto*/
        $sql = "SELECT
                    i.id_inventario,
                    i.id_producto,
                    p.codigo,
                    p.nombre_producto,
                    i.lote,
                    i.stock,
                    i.stock_defectuoso,
                    i.fecha_ingreso,
                    i.fecha_vencimiento
                FROM inventario i
                INNER JOIN productos p
                    ON i.id_producto = p.id_producto
                ORDER BY i.id_producto ASC, i.fecha_vencimiento ASC, i.id_inventario ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function BuscarPorTexto($buscar){
        /*Buscamos lotes por inventario, producto, lote, stock o fecha*/
        $sql = "SELECT
                    i.id_inventario,
                    i.id_producto,
                    p.codigo,
                    p.nombre_producto,
                    i.lote,
                    i.stock,
                    i.stock_defectuoso,
                    i.fecha_ingreso,
                    i.fecha_vencimiento
                FROM inventario i
                INNER JOIN productos p
                    ON i.id_producto = p.id_producto
                WHERE i.id_inventario LIKE :buscar
                    OR i.id_producto LIKE :buscar
                    OR p.codigo LIKE :buscar
                    OR p.nombre_producto LIKE :buscar
                    OR i.lote LIKE :buscar
                    OR i.stock LIKE :buscar
                    OR i.stock_defectuoso LIKE :buscar
                    OR i.fecha_ingreso LIKE :buscar
                    OR i.fecha_vencimiento LIKE :buscar
                    OR DATE_FORMAT(i.fecha_vencimiento, '%m/%Y') LIKE :buscar
                ORDER BY i.id_producto ASC, i.fecha_vencimiento ASC, i.id_inventario ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":buscar" => "%".$buscar."%"]);
        return $stmt->fetchAll();
    }
}
?>
