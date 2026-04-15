<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Editar Roles | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

<!--Formulario para insertar datos en la tabla-->
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=roles">
        <table >
            <tr>
                <th><label class="insertar-text">Nombre</label></th>
                <th><label class="insertar-text">Descripción</label></th>
                <th><label class="insertar-text">Estado</label></th>
            </tr>
            <tr>
                <td><input type="text" name="nombre_rol" required class="campo-texto" placeholder="Cajero"></td>
                <td><input type="text" name="descripcion" class="campo-texto" placeholder="Permisos"></td>
                <td><select name="activo" required class="campo-texto"> 
                        <option value="">Estado</option>
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
            <th class="th-registros">Nombre</th>
            <th class="th-registros">Descripcion</th>
            <th class="th-registros">Estado</th>
            <th class="th-registros">Fecha Creación</th>
            <th class="th-registros">Fecha Actualización</th>
            <th class="th-registros">Usuario Creación</th>
            <th class="th-registros">Usuario Actualización</th>
            <th class="th-registros">Acciones</th>  
        </tr>

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        <?php foreach ($data as $rol):?>
        <tr>

            <!--Chequeamos si esta definida la variable $updateid (se define cuando el controlador recibe la accion editar y el valor con X id mediante $_POST)
            y si el valor coincide con el de la fila mostramos los campos como formulario y el boton actualizar para enviar esos datos al controlador para la funcion Actualizar-->
            <?php if (isset($updateid) && $updateid['id_rol'] == $rol['id_rol']){ ?>
            <td class="th-registros"><?php echo $rol['id_rol']; ?></td>
            <td class="td-registros"><input type="text" name="nombre_rol" value="<?php echo $rol['nombre_rol']; ?>" required class="campo-texto" form="form-editar-roles"></td>
            <td class="td-registros"><input type="text" name="descripcion" value="<?php echo $rol['descripcion']; ?>" class="campo-texto" form="form-editar-roles"></td>
            <td class="td-registros"><?php if ($rol['activo']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="td-registros"><?php echo $rol['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $rol['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $rol['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $rol['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                    <form id="form-editar-roles" method="post" action="/proyecto_chucho_feliz_anp/index.php?url=roles">
                    <input type="hidden" name="id_rol" value="<?php echo $rol['id_rol']?>">
                    <input type="submit" class="boton-actualizar" name="accion" value="Actualizar">
                    </form>
                    <a href="/proyecto_chucho_feliz_anp/index.php?url=roles" class="boton-cancelar">X</a>
            </td>
            <?php }else{?> 

            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $rol['id_rol']; ?></td>
            <td class="td-registros"><?php echo $rol['nombre_rol']; ?></td>
            <td class="td-registros"><?php echo $rol['descripcion']; ?></td>
            <td class="td-registros"><?php if ($rol['activo']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="td-registros"><?php echo $rol['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $rol['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $rol['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $rol['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                <!--Botones que triggerean los cases del switch del controlador-->
                <form method="post" action="/proyecto_chucho_feliz_anp/index.php?url=roles">
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
        <?php } endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
<?php if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}?>
</body>
</html>
