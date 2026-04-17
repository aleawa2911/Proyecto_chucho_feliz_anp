<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Categorías | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <?php if ($_SESSION['rol'] != 'Cajero') { ?>
    <!--Formulario para insertar datos en la tabla-->
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=categorias">
        <table >
            <tr>
                <th><label class="insertar-text">Nombre</label></th>
                <th><label class="insertar-text">Descripción</label></th>
                <th><label class="insertar-text">Estado</label></th>
            </tr>
            <tr>
                <td><input type="text" name="nombre_categoria" required class="campo-texto" placeholder="Alimentos"></td>
                <td><input type="text" name="descripcion" class="campo-texto" placeholder="Comida"></td>
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
    <?php } ?>   
<!--Tabla de registros-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
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

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        
        <?php 
        $contador_fila = 0;
        foreach ($data as $categoria): 
        $contador_fila++;
        ?>
        <tr>
            <!--Chequeamos si esta definida la variable $updateid (se define cuando el controlador recibe la accion editar y el valor con X id mediante $_POST)
            y si el valor coincide con el de la fila para mostrar los campos como formulario y el boton actualizar para enviar esos datos al controlador para la funcion Actualizar-->
            <?php if (isset($updateid) && $updateid['id_categoria'] == $categoria['id_categoria']) { ?>
            <td class="th-registros"><?php echo $categoria['id_categoria']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="nombre_categoria" value="<?php echo $categoria['nombre_categoria']; ?>" required class="campo-texto" form="form-editar-categorias"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="descripcion" value="<?php echo $categoria['descripcion']; ?>" class="campo-texto" form="form-editar-categorias"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($categoria['activo']) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <?php if ($_SESSION['rol'] != 'Cajero') { ?>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['fecha_creacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['fecha_actualizacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['usuario_creacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['usuario_actualizacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                    <form id="form-editar-categorias" method="post" action="/proyecto_chucho_feliz_anp/index.php?url=categorias">
                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']?>">
                    <input type="submit" class="boton-actualizar" name="accion" value="Actualizar">
                    </form>
                    <a href="/proyecto_chucho_feliz_anp/index.php?url=categorias" class="boton-cancelar">X</a>
            </td>
            <?php } ?>
            <?php } else { ?>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $categoria['id_categoria']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['nombre_categoria']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['descripcion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($categoria['activo']) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <?php if ($_SESSION['rol'] != 'Cajero') { ?>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['fecha_creacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['fecha_actualizacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['usuario_creacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $categoria['usuario_actualizacion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <!--Botones que triggerean los cases del switch del controlador-->
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
