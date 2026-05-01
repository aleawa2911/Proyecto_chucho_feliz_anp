<?php
/*Jalamos la conexión a la db*/
require_once __DIR__ . '/../../config/conexion.php';

class CierreCajaModelo{

    /*Propiedad privada q guarda la conexión PDO a la DB*/
    private $pdo;

    /*Guardamos la conexión a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function ObtenerCajaAbierta(){
        /*Buscamos si existe una caja abierta*/
        $sql = "SELECT
                    id_cierre,
                    fecha,
                    total_ventas,
                    id_usuario,
                    estado,
                    fecha_registro
                FROM cierre_caja
                WHERE estado = 'abierto'
                ORDER BY id_cierre DESC
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function AbrirCaja($id_usuario){
        /*No dejamos abrir una caja si ya existe una abierta*/
        $caja_abierta = $this->ObtenerCajaAbierta();

        if ($caja_abierta != false) {
            throw new Exception("Ya existe una caja abierta.");
        }

        /*No dejamos abrir otra caja si la caja del día ya fue cerrada*/
        $sql = "SELECT
                    id_cierre,
                    estado
                FROM cierre_caja
                WHERE fecha = CURDATE()
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $caja_dia = $stmt->fetch();

        if ($caja_dia != false) {
            if ($caja_dia['estado'] == 'cerrado') {
                throw new Exception("Ya se cerró la caja del día.");
            }
        }

        /*Abrimos la caja del día*/
        $sql = "INSERT INTO cierre_caja(
                    fecha,
                    total_ventas,
                    id_usuario,
                    estado)
                VALUES(
                    CURDATE(),
                    0,
                    :id_usuario,
                    'abierto')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":id_usuario" => $id_usuario
        ]);

        return $this->pdo->lastInsertId();
    }

    public function CerrarCaja($id_cierre){
        /*Calculamos el total de ventas de la caja abierta*/
        $sql = "SELECT
                    COALESCE(SUM(total), 0) AS total_ventas
                FROM ventas
                WHERE id_cierre = :id_cierre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":id_cierre" => $id_cierre
        ]);
        $data = $stmt->fetch();
        $total_ventas = $data['total_ventas'];

        /*Cerramos la caja con el total calculado*/
        $sql = "UPDATE cierre_caja
                SET total_ventas = :total_ventas,
                    estado = 'cerrado'
                WHERE id_cierre = :id_cierre
                    AND estado = 'abierto'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":total_ventas" => $total_ventas,
            ":id_cierre" => $id_cierre
        ]);
    }
}
?>
