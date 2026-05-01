<?php
/*Retomamos la sesión en autentificación.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/control/reporte_ventas.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
    }

    /*Instanciamos el modelo de reporte ventas*/
    $modelo = new ReporteVentasModelo();

    /*Obtenemos la venta enviada por GET*/
    $id_venta = $_GET['id_venta'] ?? '';

    /*Si no viene la venta, regresamos al reporte*/
    if ($id_venta === '') {
        header('Location: /proyecto_chucho_feliz_anp/index.php?url=reporte_ventas');
        exit;
    }

    /*Obtenemos los detalles de la venta seleccionada*/
    $detalleVenta = $modelo->ObtenerDetalleVenta($id_venta);

require_once __DIR__ . '/../../views/control/detalle_venta.php';

?>
