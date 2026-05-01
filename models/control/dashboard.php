<?php
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class DashboardModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerCajaDia(){
        /*Obtenemos la caja registrada para el día actual*/
        $sql = "SELECT
                    estado,
                    total_ventas
                FROM cierre_caja
                WHERE fecha = CURDATE()
                ORDER BY id_cierre DESC
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ObtenerVentasDia(){
        /*Obtenemos el resumen de ventas del día actual*/
        $sql = "SELECT
                    COUNT(*) AS cantidad_ventas,
                    SUM(total) AS total_vendido
                FROM ventas
                WHERE DATE(fecha) = CURDATE()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ObtenerInventarioBajo(){
        /*Obtenemos productos cuyo stock total está bajo el mínimo*/
        $sql = "SELECT
                    p.codigo,
                    p.nombre_producto,
                    p.stock_minimo,
                    IFNULL(SUM(i.stock), 0) AS stock_total
                FROM productos p
                LEFT JOIN inventario i
                    ON p.id_producto = i.id_producto
                WHERE p.activo = 1
                GROUP BY
                    p.id_producto,
                    p.codigo,
                    p.nombre_producto,
                    p.stock_minimo
                HAVING stock_total < p.stock_minimo
                ORDER BY p.nombre_producto ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ObtenerStockDefectuoso(){
        /*Obtenemos los lotes que tienen stock defectuoso*/
        $sql = "SELECT
                    p.codigo,
                    p.nombre_producto,
                    i.lote,
                    i.stock_defectuoso
                FROM inventario i
                INNER JOIN productos p
                    ON i.id_producto = p.id_producto
                WHERE i.stock_defectuoso > 0
                ORDER BY p.nombre_producto ASC, i.lote ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
