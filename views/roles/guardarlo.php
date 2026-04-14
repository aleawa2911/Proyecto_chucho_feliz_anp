<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Editar Rol | Chucho Feliz</title>
</head>
<body>
    <div class="espacio-header"></div>
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=roles">
        <table >
            <tr>
                <th><label class="insertar-text">Nombre</label></th>
                <th><label class="insertar-text">Descripción</label></th>
            </tr>
            <tr>
                <td><input type="text" name="nombre_rol" required class="campo-texto" value="<?php echo $rol['nombre_rol']?>"></td>
                <td><input type="text" name="descripcion" required class="campo-texto" value="<?php echo $rol['descripcion']?>"></td>
                <td><input type="submit" value="Actualizar" name="accion" class="boton-editar"></td>
            </tr> 
        </table>
        </form>
    </div>
</div>
</body>
</html>
