<?php 
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Roles</title>
</head>
<body>
<h1>Gestión de roles</h1>
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <tr>
            <th class="th-registros">Nombre</th>
            <th class="th-registros">Descripcion</th>
            <th class="th-registros">Estado</th>
            <th class="th-registros">Fecha Creación</th>
            <th class="th-registros">Fecha Actualización</th>
            <th class="th-registros">Usuario Creación</th>
            <th class="th-registros">Usuario Actualización</th>
            <th class="th-registros">Acciones</th>  
        </tr>
        <?php foreach ($data as $rol):?>
        <tr>
            <td class="td-registros"><?php echo $rol['nombre_rol']; ?></td>
            <td class="td-registros"><?php echo $rol['descripcion']; ?></td>
            <td class="td-registros"><?php if ($rol['activo']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="td-registros"><?php echo $rol['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $rol['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $rol['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $rol['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                <form method="post" action="/proyecto_chucho_feliz_anp/controllers/roles.php">
                    <input type="hidden" name="id_rol" value="<?php echo $rol['id_rol']?>">
                    <input type="submit" class="boton-editar" name="accion" value="Editar">
                    <?php if ($rol['activo'] == '1') {?>
                    <input type="submit" class="boton-desactivar" name="accion" value="Desactivar">
                    <?php }else{ ?>
                    <input type="submit" class="boton-activar" name="accion" value="Activar">
                    <?php }?>
                </form>
            </td> 
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
