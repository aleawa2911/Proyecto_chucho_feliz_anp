<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/crud/productos.php';

    /*Instanciamos el modelo de productos*/
    $modelo = new ProductosModelo();

    /*Guardamos la data de las tablas en $data*/
    $data = $modelo->ObtenerTodos();
    /*Guardamos la data del proveedor en $dataP*/
    $dataP = $modelo->ObtenerProveedor();
    /*Guardamos la data del proveedor en $dataC*/
    $dataC = $modelo->ObtenerCategoria();

    /*Si llegó una solicitud por post*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['rol'] != 'Cajero') {
        /*Guardamos la acción enviada por el formulario*/
        $accion = $_POST['accion'];
        
        /*Revisamos que acción es para proceder*/
        switch ($accion) {
            case 'Insertar':
                try {
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
                    $_SESSION['mensaje'] = "Se insertó correctamente el producto.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo insertar el producto.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                    exit;
                }
                break;
            
            case 'Editar':
                $id_producto = $_POST['id_producto'];
                $updateid = $modelo->ObtenerPorId($id_producto);
                break;

            case 'Actualizar':
                try {
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
                    $_SESSION['mensaje'] = "Se actualizó correctamente el producto con ID $id_producto.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo actualizar el producto con ID $id_producto.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                    exit;
                }
                break;

            case 'Desactivar':
                try {
                    $id_producto = $_POST['id_producto'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Desactivar($id_producto, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se desactivó correctamente el producto con ID $id_producto.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo desactivar el producto con ID $id_producto.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                    exit;
                }
                break;

            case 'Activar':
                try {
                    $id_producto = $_POST['id_producto'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Activar($id_producto, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se activó correctamente el producto con ID $id_producto.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo activar el producto con ID $id_producto.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=productos');
                    exit;
                }
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/crud/productos.php';
?>
