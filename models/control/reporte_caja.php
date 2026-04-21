<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class ReporteCajaModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerTodos(){
        $sql = "SELECT 
                    c.id_cierre,
                    c.fecha,
                    c.total_ventas,
                    u.nombre_usuario AS usuario_responsable,
                    c.estado,
                    c.fecha_registro
                FROM cierre_caja c
                LEFT JOIN usuarios u
                    ON c.id_usuario = u.id_usuario
                ORDER BY c.id_cierre DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                c.id_cierre,
                c.fecha,
                c.total_ventas,
                u.nombre_usuario AS usuario_responsable,
                c.estado,
                c.fecha_registro
            FROM cierre_caja c
            LEFT JOIN usuarios u
                ON c.id_usuario = u.id_usuario
            WHERE c.id_cierre LIKE :buscar
                OR c.fecha LIKE :buscar
                OR c.total_ventas LIKE :buscar
                OR u.nombre_usuario LIKE :buscar
                OR c.estado LIKE :buscar
                OR c.fecha_registro LIKE :buscar
            ORDER BY c.id_cierre DESC;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
}

}
?>
