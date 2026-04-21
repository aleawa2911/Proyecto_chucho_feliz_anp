<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Proveedores | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <div class="crud-controles">
    <!--Formulario para insertar datos en la tabla-->
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=proveedores">
        <table >
            <tr>
                <th><label class="insertar-text">Nombre</label></th>
                <th><label class="insertar-text">Contacto</label></th>
                <th><label class="insertar-text">Teléfono</label></th>
                <th><label class="insertar-text">Correo</label></th>
                <th><label class="insertar-text">Estado</label></th>
            </tr>
            <tr>
                <td><input type="text" name="nombre_proveedor" required class="campo-texto" placeholder="CuchoProveedor"></td>
                <td><input type="text" name="contacto" class="campo-texto" placeholder="Juana Chucho"></td>
                <td><input type="tel" name="telefono" class="campo-texto" placeholder="+503-12345678"></td>
                <td><input type="email" name="correo" class="campo-texto" placeholder="prov@chucho.com"></td>
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
    <div class="buscar-box">
        <form method="GET" action="/proyecto_chucho_feliz_anp/index.php" class="buscar-form">
            <input type="hidden" name="url" value="proveedores">
            <input type="text" name="buscar" class="campo-texto" value="<?php echo $_GET['buscar'] ?? ''; ?>" placeholder="Buscar...">
            <input type="submit" value="Buscar" class="boton-buscar">
            <a href="/proyecto_chucho_feliz_anp/index.php?url=proveedores" class="boton-cancelar">X</a>
        </form>
    </div>
    </div>
<!--Tabla de registros-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
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

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        <?php 
        $contador_fila = 0;
        foreach ($data as $proveedor): 
        $contador_fila++;
        ?>
        <tr>
            <!--Si existe $updateid (se define al presionar Editar) y su id coincide con el de esta fila, mostramos la fila en modo edicion con formuladior y boton de Actualizar.-->
            <?php if (isset($updateid) && $updateid['id_proveedor'] == $proveedor['id_proveedor']) { ?>
            <td class="th-registros"><?php echo $proveedor['id_proveedor']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="nombre_proveedor" value="<?php echo $proveedor['nombre_proveedor']; ?>" required class="campo-texto" form="form-editar-proveedores"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="contacto" value="<?php echo $proveedor['contacto']; ?>" class="campo-texto" form="form-editar-proveedores"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="telefono" value="<?php echo $proveedor['telefono']; ?>" class="campo-texto" form="form-editar-proveedores"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="correo" value="<?php echo $proveedor['correo']; ?>" class="campo-texto" form="form-editar-proveedores"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($proveedor['activo']) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['fecha_creacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['fecha_actualizacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['usuario_creacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['usuario_actualizacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                    <form id="form-editar-proveedores" method="post" action="/proyecto_chucho_feliz_anp/index.php?url=proveedores">
                    <input type="hidden" name="id_proveedor" value="<?php echo $proveedor['id_proveedor']?>">
                    <input type="submit" class="boton-actualizar" name="accion" value="Actualizar">
                    </form>
                    <a href="/proyecto_chucho_feliz_anp/index.php?url=proveedores" class="boton-cancelar">X</a>
            </td>
            <?php } else { ?>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $proveedor['id_proveedor']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['nombre_proveedor']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['contacto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['telefono']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['correo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($proveedor['activo']) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['fecha_creacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['fecha_actualizacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['usuario_creacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $proveedor['usuario_actualizacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <!--Botones que triggerean los cases del switch del controlador-->
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
            <?php } ?>
        </tr>
        <?php endforeach; ?>
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
