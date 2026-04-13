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
    <div class="espacio-header"></div>
    <br>
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=categorias">
        <table >
            <tr>
                <th><label class="insertar-text">Nombre</label></th>
                <th><label class="insertar-text">Descripción</label></th>
                <th><label class="insertar-text">Activo</label></th>
            </tr>
            <tr>
                <td><input type="text" name="nombre_categoria" required class="campo-texto" placeholder="Alimentos"></td>
                <td><input type="text" name="descripcion" required class="campo-texto" placeholder="Comida"></td>
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
            <th class="th-registros">Descripción</th>
            <th class="th-registros">Estado</th>
            <?php if ($_SESSION['rol'] != 'Cajero') { ?>
            <th class="th-registros">Fecha Creación</th>
            <th class="th-registros">Fecha Actualización</th>
            <th class="th-registros">Usuario Creación</th>
            <th class="th-registros">Usuario Actualización</th>
            <th class="th-registros">Acciones</th>  
            <?php } ?>
        </tr>

        <?php foreach ($data as $categoria): ?>
        <tr>
            <td class="td-registros"><?php echo $categoria['id_categoria']; ?></td>
            <td class="td-registros"><?php echo $categoria['nombre_categoria']; ?></td>
            <td class="td-registros"><?php echo $categoria['descripcion']; ?></td>
            <td class="td-registros"><?php if ($categoria['activo']) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <?php if ($_SESSION['rol'] != 'Cajero') { ?>
            <td class="td-registros"><?php echo $categoria['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $categoria['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $categoria['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $categoria['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                <form method="post" action="/proyecto_chucho_feliz_anp/index.php?url=categorias">
                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']?>">
                    <input type="submit" class="boton-editar" name="accion" value="Editar">
                    <?php if ($categoria['activo'] == '1') {?>
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
