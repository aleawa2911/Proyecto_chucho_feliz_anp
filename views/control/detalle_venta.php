<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Detalle Venta | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <div class="reportes-controles">
        <div class="buscar-box">
            <a href="/proyecto_chucho_feliz_anp/index.php?url=reporte_ventas" class="boton-cancelar">X</a>
        </div>
    </div>

<!--Tabla de detalle de venta-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros" colspan="10">Detalle de venta ID <?php echo $id_venta; ?></th>
        </tr>
        <tr>
            <th class="th-registros">ID Detalle</th>
            <th class="th-registros">ID Producto</th>
            <th class="th-registros">Código</th>
            <th class="th-registros">Producto</th>
            <th class="th-registros">ID Inventario</th>
            <th class="th-registros">Lote</th>
            <th class="th-registros">Cantidad</th>
            <th class="th-registros">Precio Unitario</th>
            <th class="th-registros">Fecha Vencimiento</th>
            <th class="th-registros">Subtotal</th>
        </tr>

        <!--Recibimos los detalles de la venta seleccionada-->
        <?php
        $contador_fila = 0;
        foreach ($detalleVenta as $detalle):
        $contador_fila++;
        ?>
        <tr>
            <td class="th-registros"><?php echo $detalle['id_detalle']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['id_producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['codigo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['id_inventario']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['lote']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['cantidad']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">$<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($detalle['fecha_vencimiento'] != null && $detalle['fecha_vencimiento'] !== '') { echo date('m/Y', strtotime($detalle['fecha_vencimiento'])); } ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">$<?php echo number_format($detalle['subtotal'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
