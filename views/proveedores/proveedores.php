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
    <title>Proveedores</title>
</head>
<body>
<h1>Gestión de Proveedores</h1>
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <tr>
            <th class="th-registros">ID</th>
            <th class="th-registros">Nombre</th>
            <th class="th-registros">Contacto</th>
            <th class="th-registros">Teléfono</th>
            <th class="th-registros">Email</th>
            <th class="th-registros">Estado</th>
            <th class="th-registros">Fecha Creación</th>
            <th class="th-registros">Fecha Actualización</th>
            <th class="th-registros">Usuario Creación</th>
            <th class="th-registros">Usuario Actualización</th>
            <th class="th-registros">Acciones</th>  
        </tr>

        <?php foreach ($data as $proveedor): ?>
        <tr>
            <td class="td-registros"><?php echo $proveedor['id_proveedor']; ?></td>
            <td class="td-registros"><?php echo $proveedor['nombre']; ?></td>
            <td class="td-registros"><?php echo $proveedor['contacto']; ?></td>
            <td class="td-registros"><?php echo $proveedor['telefono']; ?></td>
            <td class="td-registros"><?php echo $proveedor['email']; ?></td>
            <td class="td-registros"><?php if ($proveedor['activo']) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <td class="td-registros"><?php echo $proveedor['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $proveedor['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $proveedor['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $proveedor['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                <form method="post" action="/proyecto_chucho_feliz_anp/controllers/proveedores.php">
                    <input type="hidden" name="id_proveedor" value="<?php echo $usuario['id_proveedor']?>">
                    <input type="submit" class="boton-editar" name="accion" value="Editar">
                    <?php if ($proveedor['activo'] == '1') {?>
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
