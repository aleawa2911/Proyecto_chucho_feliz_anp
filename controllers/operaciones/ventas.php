<?php 
/*Retomamos la sesión en autentificación.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/operaciones/ventas.php';

    /*Instanciamos el modelo de ventas*/
    $modelo = new VentasModelo();

    /*Guardamos la data de productos en $dataProductos*/
    $dataProductos = $modelo->ObtenerProductos();

    /*Obtenemos la caja abierta para permitir ventas*/
    $cajaAbierta = $modelo->ObtenerCajaAbierta();

    /*Si no existe la lista temporal de detalles, la creamos*/
    if (!isset($_SESSION['detalles_venta'])) {
        $_SESSION['detalles_venta'] = [];
    }

    /*Si llegó una solicitud por post*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        /*Guardamos la acción enviada por el formulario*/
        $accion = $_POST['accion'];

        /*Revisamos que acción es para proceder*/
        switch ($accion) {
            case 'Agregar producto':
                try {
                    if ($cajaAbierta == false) {
                        throw new Exception("Debe abrir caja antes de vender.");
                    }

                    $id_producto = $_POST['id_producto'];
                    $cantidad = (int)$_POST['cantidad'];
                    $nombre_producto = '';
                    $precio_unitario = 0;
                    $stock_disponible = 0;
                    $producto_encontrado = false;

                    /*Buscamos el producto seleccionado para tomar su precio y stock*/
                    foreach ($dataProductos as $producto) {
                        if ($producto['id_producto'] == $id_producto) {
                            $nombre_producto = $producto['codigo'] . ' - ' . $producto['nombre_producto'];
                            $precio_unitario = $producto['precio_venta'];
                            $stock_disponible = (int)$producto['stock_disponible'];
                            $producto_encontrado = true;
                        }
                    }

                    if ($producto_encontrado == false) {
                        throw new Exception("Producto no encontrado.");
                    }

                    /*Calculamos cuanto de este producto ya está agregado en la venta temporal*/
                    $cantidad_agregada = 0;
                    foreach ($_SESSION['detalles_venta'] as $detalle) {
                        if ($detalle['id_producto'] == $id_producto) {
                            $cantidad_agregada = $cantidad_agregada + (int)$detalle['cantidad'];
                        }
                    }

                    $cantidad_total = $cantidad_agregada + $cantidad;

                    /*No dejamos agregar más cantidad que el stock disponible*/
                    if ($cantidad_total > $stock_disponible) {
                        throw new Exception("No hay stock suficiente.");
                    }

                    /*Agregamos el detalle a la lista temporal de la venta*/
                    $_SESSION['detalles_venta'][] = [
                        'id_producto' => $id_producto,
                        'producto' => $nombre_producto,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precio_unitario,
                        'subtotal' => round(($cantidad * (float)$precio_unitario), 2)
                    ];

                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=ventas');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo agregar el detalle.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=ventas');
                    exit;
                }
                break;

            case 'Quitar detalle':
                $indice = (int)$_POST['indice'];

                /*Quitamos el detalle seleccionado de la lista temporal*/
                if (isset($_SESSION['detalles_venta'][$indice])) {
                    unset($_SESSION['detalles_venta'][$indice]);
                    $_SESSION['detalles_venta'] = array_values($_SESSION['detalles_venta']);
                }

                header('Location: /proyecto_chucho_feliz_anp/index.php?url=ventas');
                exit;
                break;

            case 'X':
                /*Limpiamos la venta temporal*/
                unset($_SESSION['detalles_venta']);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=ventas');
                exit;
                break;

            case 'Registrar venta':
                try {
                    if ($cajaAbierta == false) {
                        throw new Exception("Debe abrir caja antes de vender.");
                    }

                    $id_usuario = $_SESSION['id_usuario'];
                    $id_cierre = $cajaAbierta['id_cierre'];
                    $detalles = $_SESSION['detalles_venta'];

                    $id_venta = $modelo->RegistrarVenta($id_usuario, $id_cierre, $detalles);

                    /*Limpiamos la venta temporal después de registrar*/
                    unset($_SESSION['detalles_venta']);

                    $_SESSION['mensaje'] = "Se registró correctamente la venta con ID $id_venta.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=ventas');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo registrar la venta.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=ventas');
                    exit;
                }
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/operaciones/ventas.php';
?>
