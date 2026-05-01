<?php
/*Retomamos la sesión en autentificación.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/control/reporte_compras.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
    }

    /*Instanciamos el modelo de reporte compras*/
    $modelo = new ReporteComprasModelo();

    /*Obtenemos la compra enviada por GET*/
    $id_compra = $_GET['id_compra'] ?? '';

    /*Si no viene la compra, regresamos al reporte*/
    if ($id_compra === '') {
        header('Location: /proyecto_chucho_feliz_anp/index.php?url=reporte_compras');
        exit;
    }

    /*Obtenemos los detalles de la compra seleccionada*/
    $detalleCompra = $modelo->ObtenerDetalleCompra($id_compra);

require_once __DIR__ . '/../../views/control/detalle_compra.php';

?>
