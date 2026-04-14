<?php 
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../config/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/

/*Jalamos el layout q usaremos en todo el sitio web*/
require_once __DIR__ . '/../views/layout/header.php';
require_once __DIR__ . '/../views/layout/footer.php';

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../views/operaciones/cierre_caja.php';
?>
