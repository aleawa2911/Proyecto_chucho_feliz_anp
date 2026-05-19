<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Reporte Devoluciones Proveedor | Chucho Feliz</title>
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
                <input type="hidden" name="url" value="reporte_devoluciones_proveedor">
                <input type="hidden" name="tipo_resumen" value="<?php echo $tipo_resumen; ?>">
                <input type="hidden" name="fecha_resumen" value="<?php echo $fecha_resumen; ?>">
                <input type="text" name="buscar" class="campo-texto" value="<?php echo $_GET['buscar'] ?? ''; ?>" placeholder="Buscar...">
                <input type="submit" value="Buscar" class="boton-buscar">
                <a href="/proyecto_chucho_feliz_anp/index.php?url=reporte_devoluciones_proveedor" class="boton-cancelar">X</a>
            </form>
        </div>
    </div>

<!--Tarjeta de resumen de devoluciones proveedor-->
<div class="reporte-resumen">
    <h2 class="resumen-titulo resumen-stock-defectuoso">Resumen de devoluciones proveedor</h2>
    <form method="GET" action="/proyecto_chucho_feliz_anp/index.php" class="reporte-resumen-form">
        <input type="hidden" name="url" value="reporte_devoluciones_proveedor">
        <input type="hidden" name="buscar" value="<?php echo $_GET['buscar'] ?? ''; ?>">
        <select name="tipo_resumen" class="campo-texto">
            <option value="dia" <?php if ($tipo_resumen == 'dia') echo 'selected'; ?>>Día</option>
            <option value="mes" <?php if ($tipo_resumen == 'mes') echo 'selected'; ?>>Mes</option>
            <option value="anio" <?php if ($tipo_resumen == 'anio') echo 'selected'; ?>>Año</option>
        </select>
        <input type="date" name="fecha_resumen" class="campo-texto" value="<?php echo $fecha_resumen; ?>">
        <input type="submit" value="Ver resumen" class="boton-buscar">
    </form>
    <div class="reporte-resumen-datos">
        <div class="reporte-resumen-dato">Devoluciones<br><?php echo $resumen['cantidad_registros']; ?></div>
        <div class="reporte-resumen-dato reporte-resumen-total">Productos<br><?php echo $resumen['cantidad_productos']; ?></div>
    </div>
</div>

<!--Tabla de registros de devoluciones proveedor-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID</th>
            <th class="th-registros">ID Compra</th>
            <th class="th-registros">ID Producto</th>
            <th class="th-registros">Producto</th>
            <th class="th-registros">Cantidad</th>
            <th class="th-registros">Fecha</th>
            <th class="th-registros">Razon</th>
            <th class="th-registros">Usuario Responsable</th>
        </tr>

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        <?php
        $contador_fila = 0; 
        foreach ($data as $devolucionproveedor):
        $contador_fila++; 
        ?>
        <tr>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $devolucionproveedor['id_devolucion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $devolucionproveedor['id_compra']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $devolucionproveedor['id_producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $devolucionproveedor['producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $devolucionproveedor['cantidad']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $devolucionproveedor['fecha']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $devolucionproveedor['razon']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $devolucionproveedor['usuario_responsable']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
