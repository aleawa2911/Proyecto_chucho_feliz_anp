<?php 
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: ../vistas/dashboard.php');
    exit;}
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/fonts.css">
    <link rel="stylesheet" href="../public/css/base.css">
    <link rel="stylesheet" href="../public/css/styles.css">
    <title>Login</title>
</head>
<body class="login-body">
    <div class="login-box">
        <h1 class="login-title">Chucho Feliz</h1>
        <p class="login-text">Iniciar sesión</p>
        <form method="POST" action="../controladores/login.php">
    <table class="login-form">
        <tr>
            <td><label for="usuario"><img src="../public/images/usuario.png" class="icono-login" alt="Usuario"> Usuario</label></td>
        </tr>
        <tr>
            <td><input type="text" name="usuario" placeholder="ChuchoFeliz123" required></td>
        </tr>
        <tr>
            <td><label for="contrasena"><img src="../public/images/contrasena.png" class="icono-login" alt="Contrasena"> Contraseña</label></td>
        </tr>
        <tr>
            <td><input type="password" name="contrasena" placeholder="Contraseña" required></td>
        </tr>
        <tr>
            <td style="text-align: center;"><input class="boton-iniciar-sesion" type="submit" value="Iniciar Sesión"></td>
        </tr>
    </table>
</form>
    </div>
</body>
</html>