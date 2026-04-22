<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Historial Categorias | Chucho Feliz</title>
</head>
<body>
    <!--Menu de tablas de historial-->
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>
    <div class="historial-controles">
        <div class="historial-menu">
            <?php require_once __DIR__ . '/../layout/menu_historial_botones.php';?>
        </div>
        <div class="buscar-box">
            <form method="GET" action="/proyecto_chucho_feliz_anp/index.php" class="buscar-form">
                <input type="hidden" name="url" value="historial_categorias">
                <input type="text" name="buscar" class="campo-texto" value="<?php echo $_GET['buscar'] ?? ''; ?>" placeholder="Buscar...">
                <input type="submit" value="Buscar" class="boton-buscar">
                <a href="/proyecto_chucho_feliz_anp/index.php?url=historial_categorias" class="boton-cancelar">X</a>
            </form>
        </div>
    </div>
<!--Tabla de registros del historial-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID</th>
            <th class="th-registros">ID Categoria</th>
            <th class="th-registros">Accion</th>
            <th class="th-registros">Fecha Cambio</th>
            <th class="th-registros">Usuario Responsable</th>
            <th class="th-registros">Nombre Categoria Anterior</th>
            <th class="th-registros">Nombre Categoria Nuevo</th>
            <th class="th-registros">Descripcion Anterior</th>
            <th class="th-registros">Descripcion Nuevo</th>
            <th class="th-registros">Estado Anterior</th>
            <th class="th-registros">Estado Nuevo</th>
            <th class="th-registros">Fecha Actualizacion Anterior</th>
            <th class="th-registros">Usuario Actualizacion Anterior</th>
        </tr>

        <!--Recibimos los datos de la funcion ObtenerTodos()-->

        <?php 
        $contador_fila = 0; 
        foreach ($data as $historialcategoria):
        $contador_fila++;
        ?>
        <tr>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $historialcategoria['id_historial']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['id_categoria']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['accion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['fecha_cambio']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['usuario_responsable']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['nombre_categoria_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['nombre_categoria_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['descripcion_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['descripcion_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($historialcategoria['activo_anterior']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($historialcategoria['activo_nuevo']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['fecha_actualizacion_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialcategoria['usuario_actualizacion_anterior']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
