<?php
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class InventarioModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        $sql = "SELECT
                    i.id_inventario,
                    i.id_producto,
                    i.lote,
                    i.stock,
                    i.stock_defectuoso,
                    i.stock_minimo,
                    i.fecha_ingreso,
                    i.fecha_vencimiento,
                    i.activo
                FROM inventario i
                ORDER BY i.id_producto ASC, i.fecha_vencimiento ASC, i.id_inventario ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function BuscarPorTexto($buscar){
        $sql = "SELECT
                    i.id_inventario,
                    i.id_producto,
                    i.lote,
                    i.stock,
                    i.stock_defectuoso,
                    i.stock_minimo,
                    i.fecha_ingreso,
                    i.fecha_vencimiento,
                    i.activo
                FROM inventario i
                WHERE i.id_inventario LIKE :buscar
                    OR i.id_producto LIKE :buscar
                    OR i.lote LIKE :buscar
                    OR i.stock LIKE :buscar
                    OR i.stock_defectuoso LIKE :buscar
                    OR i.stock_minimo LIKE :buscar
                    OR i.fecha_ingreso LIKE :buscar
                    OR i.fecha_vencimiento LIKE :buscar
                    OR (CASE WHEN i.activo = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
                ORDER BY i.id_producto ASC, i.fecha_vencimiento ASC, i.id_inventario ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":buscar" => "%".$buscar."%"]);
        return $stmt->fetchAll();
    }
}
?>
