<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Historial Roles | Chucho Feliz</title>
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
                <input type="hidden" name="url" value="historial_roles">
                <input type="text" name="buscar" class="campo-texto" value="<?php echo $_GET['buscar'] ?? ''; ?>" placeholder="Buscar...">
                <input type="submit" value="Buscar" class="boton-buscar">
                <a href="/proyecto_chucho_feliz_anp/index.php?url=historial_roles" class="boton-cancelar">X</a>
            </form>
        </div>
    </div>
<!--Tabla de registros del historial-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID</th>
            <th class="th-registros">ID Rol</th>
            <th class="th-registros">Accion</th>
            <th class="th-registros">Fecha Cambio</th>
            <th class="th-registros">Usuario Responsable</th>
            <th class="th-registros">Nombre Rol Anterior</th>
            <th class="th-registros">Nombre Rol Nuevo</th>
            <th class="th-registros">Descripcion Anterior</th>
            <th class="th-registros">Descripcion Nuevo</th>
            <th class="th-registros">Estado Anterior</th>
            <th class="th-registros">Estado Nuevo</th>
        </tr>

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        <?php
        $contador_fila = 0; 
        foreach ($data as $historialrol):
        $contador_fila++; 
        ?>
        <tr>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $historialrol['id_historial']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialrol['id_rol']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialrol['accion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialrol['fecha_cambio']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialrol['usuario_responsable']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialrol['nombre_rol_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialrol['nombre_rol_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialrol['descripcion_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialrol['descripcion_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($historialrol['activo_anterior']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($historialrol['activo_nuevo']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
