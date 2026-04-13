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
    <div class="espacio-header"></div>
    <br>
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=proveedores">
        <table >
            <tr>
                <th><label class="insertar-text">Nombre</label></th>
                <th><label class="insertar-text">Contacto</label></th>
                <th><label class="insertar-text">Teléfono</label></th>
                <th><label class="insertar-text">Correo</label></th>
                <th><label class="insertar-text">Activo</label></th>
            </tr>
            <tr>
                <td><input type="text" name="nombre_proveedor" required class="campo-texto" placeholder="CuchoProveedor"></td>
                <td><input type="text" name="contacto" required class="campo-texto" placeholder="Juana Chucho"></td>
                <td><input type="tel" name="telefono" class="campo-texto" placeholder="+503-12345678"></td>
                <td><input type="email" name="correo" required class="campo-texto" placeholder="Chucho@proveedor.com"></td>
                <td><select name="activo" required class="campo-texto"> 
                        <option value="">Seleccione un estado</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                </td>
                <td><input type="submit" value="Insertar" name="accion" class="boton-insertar"></td>
            </tr>
        </table>
        </form>
    </div>
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
            <td class="td-registros"><?php echo $proveedor['nombre_proveedor']; ?></td>
            <td class="td-registros"><?php echo $proveedor['contacto']; ?></td>
            <td class="td-registros"><?php echo $proveedor['telefono']; ?></td>
            <td class="td-registros"><?php echo $proveedor['correo']; ?></td>
            <td class="td-registros"><?php if ($proveedor['activo']) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <td class="td-registros"><?php echo $proveedor['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $proveedor['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $proveedor['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $proveedor['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                <form method="post" action="/proyecto_chucho_feliz_anp/index.php?url=proveedores">
                    <input type="hidden" name="id_proveedor" value="<?php echo $proveedor['id_proveedor']?>">
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