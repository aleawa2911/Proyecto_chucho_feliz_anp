<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Usuarios | Chucho Feliz</title>
</head>
<body>
    <div class="espacio-header"></div>
    <!--Formulario para insertar datos en la tabla-->
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=usuarios">
        <table >
            <tr>
                <th><label class="insertar-text">Primer Nombre</label></th>
                <th><label class="insertar-text">Segundo Nombre</label></th>
                <th><label class="insertar-text">Primer Apellido</label></th>
                <th><label class="insertar-text">Segundo Apellido</label></th>
                <th><label class="insertar-text">Nombre Usuario</label></th>
                <th><label class="insertar-text">Correo</label></th>
                <th><label class="insertar-text">Contraseña</label></th>
                <th><label class="insertar-text">Rol</label></th>
                <th><label class="insertar-text">Estado</label></th>
            </tr>
            <tr>
                <td><input type="text" name="primer_nombre" required class="campo-texto" placeholder="Juan"></td>
                <td><input type="text" name="segundo_nombre" class="campo-texto" placeholder="Jose"></td>
                <td><input type="text" name="primer_apellido" required class="campo-texto" placeholder="Pala"></td>
                <td><input type="text" name="segundo_apellido" class="campo-texto" placeholder="Pistola"></td>
                <td><input type="text" name="nombre_usuario" required class="campo-texto" placeholder="juanitopistola"></td>
                <td><input type="email" name="correo" required class="campo-texto" placeholder="correo@chucho.com"></td>
                <td><input type="password" name="contrasena" required class="campo-texto" placeholder="contrasena123"></td>
                <td><select name="id_rol" required class="campo-texto">
                        <option value="">Seleccione un rol</option>
                        <option value="1">Administrador</option>
                        <option value="2">Cajero</option>
                        <option value="3">Encargado</option>
                    </select>
                </td>
                <td><select name="activo" required class="campo-texto"> 
                        <option value="">Seleccione un estado</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                </td>
                <!--Boton que triggerea la accion insertar en el controlador-->
                <td><input type="submit" value="Insertar" name="accion" class="boton-insertar"></td>
            </tr>
        </table>
        </form>
    </div>
    
<!--Tabla de registros-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID</th>
            <th class="th-registros">Nombre Completo</th>
            <th class="th-registros">Nombre Usuario</th>
            <th class="th-registros">Correo</th>
            <th class="th-registros">Rol</th>
            <th class="th-registros">Estado</th>
            <th class="th-registros">Fecha Creación</th>
            <th class="th-registros">Fecha Actualización</th>
            <th class="th-registros">Usuario Creación</th>
            <th class="th-registros">Usuario Actualización</th>
            <th class="th-registros">Acciones</th> 
        </tr>
        </tr>
        <!--Recibimos los datos de la funcion ObtenerTodos() e imprimimos una fila por cada registro-->
        <?php foreach ($data as $usuario):?>
        <tr>
            <!--Chequeamos si esta definida la variable $updateid (se define cuando el controlador recibe la accion editar y el valor del id mediante $_POST)
            y si el valor coincide con el de la fila, si es true, mostramos los campos de la fila como formulario junto al boton actualizar 
            para enviar esos datos al controlador y usar la funcion Actualizar-->
            <?php if (isset($updateid) && $updateid['id_usuario'] == $usuario['id_usuario']) { ?>
            <form method="post" action="/proyecto_chucho_feliz_anp/index.php?url=usuarios">
            <td class="th-registros"><?php echo $usuario['id_usuario']; ?></td>
            <td class="td-registros">
                <input type="text" name="primer_nombre" value="<?php echo $usuario['primer_nombre']; ?>" required class="campo-texto" placeholder="Primer nombre">
                <input type="text" name="segundo_nombre" value="<?php echo $usuario['segundo_nombre']; ?>" class="campo-texto" placeholder="Segundo nombre">
                <br>
                <input type="text" name="primer_apellido" value="<?php echo $usuario['primer_apellido']; ?>" required class="campo-texto" placeholder="Primer apellido">
                <input type="text" name="segundo_apellido" value="<?php echo $usuario['segundo_apellido']; ?>" class="campo-texto" placeholder="Segundo apellido">
            </td>
            <td class="td-registros"><input type="text" name="nombre_usuario" value="<?php echo $usuario['nombre_usuario']; ?>" required class="campo-texto"></td>
            <td class="td-registros"><input type="email" name="correo" value="<?php echo $usuario['correo']; ?>" required class="campo-texto"></td>
            <td class="td-registros">
                <select name="id_rol" required class="campo-texto">
                    
                    <option value="1" <?php if ((int)$updateid['id_rol'] === 1) {echo 'selected';} ?>>Administrador</option>
                    <option value="2" <?php if ((int)$updateid['id_rol'] === 2) {echo 'selected';} ?>>Cajero</option>
                    <option value="3" <?php if ((int)$updateid['id_rol'] === 3) {echo 'selected';} ?>>Encargado</option>
                </select>
            </td>
            <td class="td-registros"><?php if ($usuario['activo'] == '1') {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="td-registros"><?php echo $usuario['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $usuario['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $usuario['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $usuario['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']?>">
                    <input type="submit" class="boton-actualizar" name="accion" value="Actualizar">
                </form>
            </td>
            <?php } else { ?>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $usuario['id_usuario']; ?></td>
            <td class="td-registros"><?php echo $usuario['nombre_completo']; ?></td>
            <td class="td-registros"><?php echo $usuario['nombre_usuario']; ?></td>
            <td class="td-registros"><?php echo $usuario['correo']; ?></td>
            <td class="td-registros"><?php echo $usuario['rol']; ?></td>
            <td class="td-registros"><?php if ($usuario['activo'] == '1') {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="td-registros"><?php echo $usuario['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $usuario['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $usuario['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $usuario['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                <!--Botones que triggerean los cases del switch del controlador-->
                <form method="post" action="/proyecto_chucho_feliz_anp/index.php?url=usuarios">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']?>">
                    <input type="submit" class="boton-editar" name="accion" value="Editar">
                    <?php if ($usuario['activo'] == '1') {?>
                    <input type="submit" class="boton-desactivar" name="accion" value="Desactivar">
                    <?php }else{ ?>
                    <input type="submit" class="boton-activar" name="accion" value="Activar">
                    <?php }?>
                </form>
            </td>
            <?php } ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
