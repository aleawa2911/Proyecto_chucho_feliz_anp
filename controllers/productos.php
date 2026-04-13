<?php
require_once __DIR__ . '/../config/autentificacion.php';
require_once __DIR__ . '/../models/productos.php';
require_once __DIR__ . '/../models/categorias.php';
require_once __DIR__ . '/../models/proveedores.php';
require_once __DIR__ . '/../views/layout/header.php';
require_once __DIR__ . '/../views/layout/footer.php';

    $modelo = new ProductosModelo();

    $data = $modelo->ObtenerTodos();
    $dataP = $modelo->ObtenerProveedor();
    $dataC = $modelo->ObtenerCategoria();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        
        switch ($accion) {
            case 'Insertar':
                $codigo = $_POST['codigo'];
                $nombre_producto = $_POST['nombre_producto'];
                $precio_venta = $_POST['precio_venta'];
                $stock = $_POST['stock'];
                $stock_defectuoso = $_POST['stock_defectuoso'];
                $stock_minimo = $_POST['stock_minimo'];
                $id_categoria = $_POST['id_categoria'];
                $id_proveedor= $_POST['id_proveedor'];
                $activo = $_POST['activo'];
                $usuario_creacion = $_SESSION['id_usuario'];
                $modelo->Insertar($codigo,$nombre_producto,$precio_venta,$stock,$stock_defectuoso,$stock_minimo,$id_categoria,$id_proveedor,$activo);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                break;
            
            case 'Editar':
                # code...
                break;

            case 'Desactivar':
                $id_producto = $_POST['id_producto'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Desactivar($id_producto, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                break;

            case 'Activar':
                $id_producto = $_POST['id_producto'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Activar($id_producto, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                break;
        }
    }
require_once __DIR__ . '/../views/productos/productos.php';
?>
