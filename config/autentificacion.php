<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../vistas/login.php');
    exit;
}
?>