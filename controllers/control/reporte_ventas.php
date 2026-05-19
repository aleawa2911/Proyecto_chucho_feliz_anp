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

    /*Obtenemos los datos para el resumen*/
    $tipo_resumen = $_GET['tipo_resumen'] ?? 'dia';
    $fecha_resumen = $_GET['fecha_resumen'] ?? date('Y-m-d');

    if ($tipo_resumen != 'dia' && $tipo_resumen != 'mes' && $tipo_resumen != 'anio') {
        $tipo_resumen = 'dia';
    }

    if ($fecha_resumen == '') {
        $fecha_resumen = date('Y-m-d');
    }

    $resumen = $modelo->ObtenerResumen($tipo_resumen, $fecha_resumen);
    
    /*Obtenemos el parametro 'buscar' enviado por GET y lo guardamos en $buscar, si no hay, la declaramos como vacía*/
    $buscar = trim($_GET['buscar'] ?? '');

    /*Si buscar no está vacío, la usamos para guardar en $data la concidencia con la db, sino, guardamos todos los datos */
    if ($buscar !== '') { 
        $data = $modelo->BuscarPorTexto($buscar);
    } else {
        $data = $modelo->ObtenerTodos();
    }

require_once __DIR__ . '/../../views/control/reporte_ventas.php';

?>
