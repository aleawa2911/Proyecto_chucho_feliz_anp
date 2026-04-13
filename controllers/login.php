<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../models/login.php';

$login = new LoginModelo();

session_start();

if (isset($_SESSION['nombre'])) {
    header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if ($_POST['accion'] == 'Acceder') {    
        $verificacion = $login->verificar($_POST["usuario"],$_POST["contrasena"]);
        if($verificacion !== null){
            $_SESSION["nombre"] = $verificacion['nombre_completo'];
            $_SESSION["rol"] = $verificacion['rol'];
            $_SESSION["id_usuario"] = $verificacion['id_usuario'];
            header('Location:http://localhost/proyecto_chucho_feliz_anp/index.php?url=dashboard');
            exit;
        }else{
            echo "<script>alert('Usuario o contrasena incorrectos')</script>";
        } 
    }
}

require_once __DIR__ . '/../views/login.php';
?>

