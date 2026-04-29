<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class HistorialProductosModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }
    public function ObtenerTodos(){
        $sql = "SELECT 
                    h.id_historial,
                    h.id_producto,
                    h.accion,
                    h.fecha_cambio,
                    ur.nombre_usuario AS usuario_responsable,
                    h.codigo_anterior,
                    h.codigo_nuevo,
                    h.nombre_producto_anterior,
                    h.nombre_producto_nuevo,
                    h.precio_venta_anterior,
                    h.precio_venta_nuevo,
                    h.stock_anterior,
                    h.stock_nuevo,
                    h.stock_defectuoso_anterior,
                    h.stock_defectuoso_nuevo,
                    h.stock_minimo_anterior,
                    h.stock_minimo_nuevo,
                    h.id_categoria_anterior,
                    h.id_categoria_nuevo,
                    h.id_proveedor_anterior,
                    h.id_proveedor_nuevo,
                    h.activo_anterior,
                    h.activo_nuevo
                FROM historial_productos h
                LEFT JOIN usuarios ur
                    ON h.id_usuario_responsable = ur.id_usuario
                ORDER BY h.id_historial DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function BuscarPorTexto($buscar){
    $sql = "SELECT 
                h.id_historial,
                h.id_producto,
                h.accion,
                h.fecha_cambio,
                ur.nombre_usuario AS usuario_responsable,
                h.codigo_anterior,
                h.codigo_nuevo,
                h.nombre_producto_anterior,
                h.nombre_producto_nuevo,
                h.precio_venta_anterior,
                h.precio_venta_nuevo,
                h.stock_anterior,
                h.stock_nuevo,
                h.stock_defectuoso_anterior,
                h.stock_defectuoso_nuevo,
                h.stock_minimo_anterior,
                h.stock_minimo_nuevo,
                h.id_categoria_anterior,
                h.id_categoria_nuevo,
                h.id_proveedor_anterior,
                h.id_proveedor_nuevo,
                h.activo_anterior,
                h.activo_nuevo
            FROM historial_productos h
            LEFT JOIN usuarios ur
                ON h.id_usuario_responsable = ur.id_usuario
            WHERE h.id_historial LIKE :buscar
                OR h.id_producto LIKE :buscar
                OR h.accion LIKE :buscar
                OR h.fecha_cambio LIKE :buscar
                OR ur.nombre_usuario LIKE :buscar
                OR h.codigo_anterior LIKE :buscar
                OR h.codigo_nuevo LIKE :buscar
                OR h.nombre_producto_anterior LIKE :buscar
                OR h.nombre_producto_nuevo LIKE :buscar
                OR h.precio_venta_anterior LIKE :buscar
                OR h.precio_venta_nuevo LIKE :buscar
                OR h.stock_anterior LIKE :buscar
                OR h.stock_nuevo LIKE :buscar
                OR h.stock_defectuoso_anterior LIKE :buscar
                OR h.stock_defectuoso_nuevo LIKE :buscar
                OR h.stock_minimo_anterior LIKE :buscar
                OR h.stock_minimo_nuevo LIKE :buscar
                OR h.id_categoria_anterior LIKE :buscar
                OR h.id_categoria_nuevo LIKE :buscar
                OR h.id_proveedor_anterior LIKE :buscar
                OR h.id_proveedor_nuevo LIKE :buscar
                OR h.activo_anterior LIKE :buscar
                OR h.activo_nuevo LIKE :buscar
                OR (CASE WHEN h.activo_anterior = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
                OR (CASE WHEN h.activo_nuevo = 1 THEN 'Activo' ELSE 'Inactivo' END) LIKE :buscar
            ORDER BY h.id_historial DESC;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([":buscar" => "%".$buscar."%"]);
    return $stmt->fetchAll();
}

}
?>
