<?php 
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: /proyecto_chucho_feliz_anp/index.php?url=login');
    exit;
}
?>