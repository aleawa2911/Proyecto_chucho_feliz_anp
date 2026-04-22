<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Reporte Caja | Chucho Feliz</title>
</head>
<body>
    <!--Menu de tablas de reportes-->
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>
    <div class="reportes-controles">
        <div class="reportes-menu">
            <?php require_once __DIR__ . '/../layout/menu_reportes_botones.php';?>
        </div>
        <div class="buscar-box">
            <form method="GET" action="/proyecto_chucho_feliz_anp/index.php" class="buscar-form">
                <input type="hidden" name="url" value="reporte_caja">
                <input type="text" name="buscar" class="campo-texto" value="<?php echo $_GET['buscar'] ?? ''; ?>" placeholder="Buscar...">
                <input type="submit" value="Buscar" class="boton-buscar">
                <a href="/proyecto_chucho_feliz_anp/index.php?url=reporte_caja" class="boton-cancelar">X</a>
            </form>
        </div>
    </div>

<!--Tabla de registros de cierre caja-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID</th>
            <th class="th-registros">Fecha</th>
            <th class="th-registros">Total Ventas</th>
            <th class="th-registros">Usuario Responsable</th>
            <th class="th-registros">Estado</th>
            <th class="th-registros">Fecha Registro</th>
        </tr>

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        <?php
        $contador_fila = 0; 
        foreach ($data as $caja):
        $contador_fila++; 
        ?>
        <tr>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $caja['id_cierre']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $caja['fecha']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $caja['total_ventas']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $caja['usuario_responsable']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $caja['estado']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $caja['fecha_registro']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
