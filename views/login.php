
<!--Vista del login estilizado con css basico y fuentes basicas-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Acceder | Chucho Feliz</title>
</head>
<body class="login-body">
    <div class="login-box">

        <div class="login-elementos-decorativos">
            <div>
                <h1 class="login-title">Chucho Feliz</h1>
                <h6>ACCESO AL SISTEMA</h6>
                <h2 class=login-title>Iniciar sesion</h2>
                
            </div>
            
            <div>
                <img src="public/images/logo.png" alt="logo_chucho" class="logo">
            </div>
        </div>
        <h5 class>Ingresa tus credenciales para continuar.</h5>
        <div class="login-form-box">
            <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=login">
                <table class="login-form">
                    <tr>
                        <td><label for="usuario" class="login-text"><img src="/proyecto_chucho_feliz_anp/public/images/usuario.png" class="icono-login" alt="Usuario"> Usuario</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="campo-texto" name="usuario" placeholder="ChuchoFeliz123" required></td>
                    </tr>
                    <tr>
                        <td><label for="contrasena" class="login-text"><img src="/proyecto_chucho_feliz_anp/public/images/contrasena.png" class="icono-login" alt="Contrasena"> Contraseña</label></td>
                    </tr>
                    <tr>
                        <td><input type="password" class="campo-texto" name="contrasena" placeholder="Contraseña" required></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><input class="boton" type="submit" name="accion" value="Acceder"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
