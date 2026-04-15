<?php
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/sesion/login.php';

/*Instanciamos el modelo de login*/
$login = new LoginModelo();
/*Creamos la sesion*/
session_start();

/*Si ya hay una variable de sesion definida, nos redirige al dashboard*/
if (isset($_SESSION['nombre'])) {
    header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
    exit;
}

/*Si recibe un formulario post*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    /*Chequeamos si la accion esa acceder, si es acceder, verificamos las credenciales enviadas en el form*/
    if ($_POST['accion'] == 'Acceder') {    
        $verificacion = $login->verificar($_POST["usuario"],$_POST["contrasena"]);
        if($verificacion !== null){
            /*Si las credenciales fueron verificadas, guardamos las variables de sesion y redirigimos al dashboard*/
            $_SESSION["nombre"] = $verificacion['nombre_completo'];
            $_SESSION["rol"] = $verificacion['rol'];
            $_SESSION["id_usuario"] = $verificacion['id_usuario'];
            header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
            exit;
        }else{
            /*Si fueron incorrectas o el user esta desactivado, mostramos q es incorrecto*/
            echo "<script>alert('Usuario o contrasena incorrectos')</script>";
        } 
    }
}

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/login.php';
?>

