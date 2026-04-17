<?php 
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/operaciones/devoluciones.php';
?>
