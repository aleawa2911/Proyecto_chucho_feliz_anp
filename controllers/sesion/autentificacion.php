<?php 
/*Retomamos la sesion q creamos en el login*/
session_start();

/*Chequeamos q si haya una sesion creada, sino, te vas pal login*/
if (!isset($_SESSION['rol'])) {
    header('Location: /proyecto_chucho_feliz_anp/index.php?url=login');
    exit;
}
?>