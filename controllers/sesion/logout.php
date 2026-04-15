<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/autentificacion.php';
/*Destruimos la sesion y mandamos pal login*/
session_destroy();
header('Location:/proyecto_chucho_feliz_anp/index.php?url=login');
exit;
?>
