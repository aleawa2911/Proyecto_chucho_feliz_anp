<?php
/*Retomamos la sesión en autentificación.php*/
require_once __DIR__ . '/../sesion/autentificacion.php'; 

/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/control/dashboard.php';

/*Instanciamos el modelo de dashboard*/
$modelo = new DashboardModelo();

/*Obtenemos la información que se mostrará en tarjetas*/
$cajaDia = $modelo->ObtenerCajaDia();
$ventasDia = $modelo->ObtenerVentasDia();
$inventarioBajo = $modelo->ObtenerInventarioBajo();
$stockDefectuoso = $modelo->ObtenerStockDefectuoso();

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/control/dashboard.php';
?>
