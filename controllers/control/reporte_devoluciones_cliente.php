<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/control/reporte_devoluciones_cliente.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
    }

    /*Instanciamos el modelo de reporte devoluciones cliente*/
    $modelo = new ReporteDevolucionesClienteModelo();

    /*Obtenemos el parametro 'buscar' enviado por GET y lo guardamos en $buscar, si no hay, la declaramos como vacia*/
    $buscar = trim($_GET['buscar'] ?? '');

    /*Si buscar no esta vacio, la usamos para guardar en $data la concidencia con la db, sino, guardamos todos los datos */
    if ($buscar !== '') { 
        $data = $modelo->BuscarPorTexto($buscar);
    } else {
        $data = $modelo->ObtenerTodos();
    }

require_once __DIR__ . '/../../views/control/reporte_devoluciones_cliente.php';

?>
