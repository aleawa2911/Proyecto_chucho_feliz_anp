<?php 
require_once __DIR__ . ('/../config/conexion.php');
require_once __DIR__ . ('/../modelos/login.php');

$login = new LoginModelo();

session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $usuario = $_POST["usuario"];
    $password = $_POST["contrasena"];

    $verificacion = $login->verificar($usuario,$password);
    if($verificacion == 1){
        $_SESSION["usuario"] = $usuario;
        header('Location: ../vistas/dashboard.php');
    }else{
        echo 'Usuario o contraseña incorrecto';
    }
}

