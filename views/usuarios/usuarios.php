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
    <title>Usuarios</title>
</head>
<body>
    <h1>Gestión de Usuarios</h1>
<div class="tabla-insertar">
    <form method="POST" action="/proyecto_chucho_feliz_anp/controllers/usuarios.php">
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
                    <option value="2">Encargado</option>
                    <option value="3">Cajero</option>
                </select>
            </td>
            <td><select name="estado" required class="campo-texto"> 
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

<div class="form-buscar">
    <p>Buscar usuario</p>
    <form method="POST" action="/proyecto_chucho_feliz_anp/controllers/usuarios.php"></form>
    <input type="text" class="campo-texto">
</div>

<div class="tabla-registros-box">
    <table class="tabla-registros">
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
        <?php foreach ($data as $usuario):?>
        <tr>
            <td class="td-registros"><?php echo $usuario['id_usuario']; ?></td>
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
                <form method="post" action="/proyecto_chucho_feliz_anp/controllers/usuarios.php">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']?>">
                    <input type="submit" class="boton-editar" name="accion" value="Editar">
                    <?php if ($usuario['activo'] == '1') {?>
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
