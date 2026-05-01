<?php 
/*Retomamos la sesión en autentificación.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/operaciones/devoluciones_ventas.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
    }

    /*Instanciamos el modelo de devoluciones ventas*/
    $modelo = new DevolucionesVentasModelo();

    /*Obtenemos la venta enviada por GET*/
    $id_venta = '';
    if (isset($_GET['id_venta'])) {
        $id_venta = $_GET['id_venta'];
    }

    /*Si viene una venta, obtenemos sus detalles*/
    $detalleVenta = [];
    if ($id_venta !== '') {
        $detalleVenta = $modelo->ObtenerDetalleVenta($id_venta);
    }

    /*Si llegó una solicitud por post*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        /*Guardamos la acción enviada por el formulario*/
        $accion = $_POST['accion'];

        /*Revisamos que acción es para proceder*/
        switch ($accion) {
            case 'Registrar devolución':
                try {
                    $id_venta = $_POST['id_venta'];
                    $id_producto = $_POST['id_producto'];
                    $id_inventario = $_POST['id_inventario'];
                    $cantidad = (int)$_POST['cantidad'];
                    $razon = $_POST['razon'];
                    $id_usuario = $_SESSION['id_usuario'];

                    $modelo->RegistrarDevolucionCliente($id_venta, $id_producto, $id_inventario, $cantidad, $razon, $id_usuario);

                    $_SESSION['mensaje'] = "Se registró correctamente la devolución.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=devoluciones_ventas&id_venta=' . $id_venta);
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = $e->getMessage();
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=devoluciones_ventas&id_venta=' . $_POST['id_venta']);
                    exit;
                }
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/operaciones/devoluciones_ventas.php';
?>
