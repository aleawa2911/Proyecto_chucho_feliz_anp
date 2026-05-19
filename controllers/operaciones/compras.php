<?php 
/*Retomamos la sesión en autentificación.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/operaciones/compras.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
    }

    /*Instanciamos el modelo de compras*/
    $modelo = new ComprasModelo();

    /*Guardamos la data de proveedores en $dataP*/
    $dataP = $modelo->ObtenerProveedores();

    /*Guardamos la data de productos en $dataProductos*/
    $dataProductos = $modelo->ObtenerProductos();

    /*Si no existe la lista temporal de detalles, la creamos*/
    if (!isset($_SESSION['detalles_compra'])) {
        $_SESSION['detalles_compra'] = [];
    }

    /*Si llegó una solicitud por post*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        /*Guardamos la acción enviada por el formulario*/
        $accion = $_POST['accion'];

        /*Revisamos que acción es para proceder*/
        switch ($accion) {
            case 'Agregar producto':
                try {
                    $id_proveedor = $_POST['id_proveedor'];
                    $id_producto = $_POST['id_producto'];
                    $lote = $_POST['lote'];
                    $cantidad = $_POST['cantidad'];
                    $precio_unitario = $_POST['precio_unitario'];
                    $fecha_vencimiento = $_POST['fecha_vencimiento'];
                    $nombre_producto = '';

                    /*Si viene mes y año, lo convertimos a una fecha válida para la DB*/
                    if ($fecha_vencimiento !== '') {
                        $fecha_vencimiento = $fecha_vencimiento . '-01';
                    }

                    /*Guardamos el proveedor seleccionado para mantenerlo en la compra temporal*/
                    $_SESSION['id_proveedor_compra'] = $id_proveedor;

                    /*Validamos que el producto pertenezca al proveedor seleccionado*/
                    if ($modelo->ProductoPerteneceAProveedor($id_producto, $id_proveedor) == false) {
                        throw new Exception("El producto no pertenece al proveedor seleccionado.");
                    }

                    /*Buscamos el nombre del producto seleccionado para mostrarlo en la tabla temporal*/
                    foreach ($dataProductos as $producto) {
                        if ($producto['id_producto'] == $id_producto) {
                            $nombre_producto = $producto['codigo'] . ' - ' . $producto['nombre_producto'];
                        }
                    }

                    /*Agregamos el detalle a la lista temporal de la compra*/
                    $_SESSION['detalles_compra'][] = [
                        'id_producto' => $id_producto,
                        'producto' => $nombre_producto,
                        'lote' => $lote,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precio_unitario,
                        'fecha_vencimiento' => $fecha_vencimiento,
                        'subtotal' => round(((int)$cantidad * (float)$precio_unitario), 2)
                    ];

                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=compras');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo agregar el detalle.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=compras');
                    exit;
                }
                break;

            case 'Quitar detalle':
                $indice = (int)$_POST['indice'];

                /*Quitamos el detalle seleccionado de la lista temporal*/
                if (isset($_SESSION['detalles_compra'][$indice])) {
                    unset($_SESSION['detalles_compra'][$indice]);
                    $_SESSION['detalles_compra'] = array_values($_SESSION['detalles_compra']);
                }

                header('Location: /proyecto_chucho_feliz_anp/index.php?url=compras');
                exit;
                break;

            case 'X':
                /*Limpiamos la compra temporal*/
                unset($_SESSION['detalles_compra']);
                unset($_SESSION['id_proveedor_compra']);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=compras');
                exit;
                break;

            case 'Registrar compra':
                try {
                    $id_usuario = $_SESSION['id_usuario'];

                    /*Tomamos el proveedor guardado en la compra temporal*/
                    if (isset($_SESSION['id_proveedor_compra'])) {
                        $id_proveedor = $_SESSION['id_proveedor_compra'];
                    } else {
                        $id_proveedor = $_POST['id_proveedor'];
                    }

                    /*Tomamos los detalles guardados temporalmente*/
                    $detalles = $_SESSION['detalles_compra'];

                    $id_compra = $modelo->RegistrarCompra($id_proveedor, $id_usuario, $detalles);

                    /*Limpiamos la compra temporal después de registrar*/
                    unset($_SESSION['detalles_compra']);
                    unset($_SESSION['id_proveedor_compra']);

                    $_SESSION['mensaje'] = "Se registró correctamente la compra con ID $id_compra.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=compras');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo registrar la compra.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=compras');
                    exit;
                }
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/operaciones/compras.php';
?>
