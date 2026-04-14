<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../config/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../models/productos.php';
/*Jalamos el layout q usaremos en todo el sitio web*/
require_once __DIR__ . '/../views/layout/header.php';
require_once __DIR__ . '/../views/layout/footer.php';

    /*Instanciamos el modelo de productos*/
    $modelo = new ProductosModelo();

    /*Guardamos la data de las tablas en $data*/
    $data = $modelo->ObtenerTodos();
    /*Guardamos la data del proveedor en $dataP*/
    $dataP = $modelo->ObtenerProveedor();
    /*Guardamos la data del proveedor en $dataC*/
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
                $modelo->Insertar($codigo,$nombre_producto,$precio_venta,$stock,$stock_defectuoso,$stock_minimo,$id_categoria,$id_proveedor,$activo,$usuario_creacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                break;
            
            case 'Editar':
                $id_producto = $_POST['id_producto'];
                $updateid = $modelo->ObtenerPorId($id_producto);
                break;

            case 'Actualizar':
                $id_producto = $_POST['id_producto'];
                $codigo = $_POST['codigo'];
                $nombre_producto = $_POST['nombre_producto'];
                $precio_venta = $_POST['precio_venta'];
                $stock = $_POST['stock'];
                $stock_defectuoso = $_POST['stock_defectuoso'];
                $stock_minimo = $_POST['stock_minimo'];
                $id_categoria = $_POST['id_categoria'];
                $id_proveedor = $_POST['id_proveedor'];
                $usuario_actualizacion = $_SESSION["id_usuario"];
                $modelo->Actualizar($id_producto,$codigo,$nombre_producto,$precio_venta,$stock,$stock_defectuoso,$stock_minimo,$id_categoria,$id_proveedor,$usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
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

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../views/crud/productos.php';
?>
