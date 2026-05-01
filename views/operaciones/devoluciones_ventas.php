<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Devoluciones Ventas | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>
    <?php require_once __DIR__ . '/../layout/menu_devoluciones_botones.php';?>

    <div class="productos-controles">
        <div class="buscar-box">
            <form method="GET" action="/proyecto_chucho_feliz_anp/index.php" class="buscar-form">
                <input type="hidden" name="url" value="devoluciones_ventas">
                <input type="number" name="id_venta" class="campo-texto" value="<?php echo $id_venta; ?>" placeholder="ID Venta" required>
                <input type="submit" value="Buscar" class="boton-buscar">
                <a href="/proyecto_chucho_feliz_anp/index.php?url=devoluciones_ventas" class="boton-cancelar">X</a>
            </form>
        </div>
    </div>

<?php if ($id_venta !== ''): ?>
<!--Tabla de productos vendidos para devolución-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros" colspan="12">Devolución de venta ID <?php echo $id_venta; ?></th>
        </tr>
        <tr>
            <th class="th-registros">ID Producto</th>
            <th class="th-registros">Código</th>
            <th class="th-registros">Producto</th>
            <th class="th-registros">ID Inventario</th>
            <th class="th-registros">Lote</th>
            <th class="th-registros">Vencimiento</th>
            <th class="th-registros">Vendido</th>
            <th class="th-registros">Devuelto</th>
            <th class="th-registros">Disponible</th>
            <th class="th-registros">Cantidad</th>
            <th class="th-registros">Razón</th>
            <th class="th-registros">Acción</th>
        </tr>

        <!--Recibimos los detalles de la venta seleccionada-->
        <?php
        $contador_fila = 0;
        foreach ($detalleVenta as $detalle):
        $contador_fila++;
        $form_devolucion = 'form_devolucion_' . $contador_fila;
        ?>
        <tr>
            <td class="th-registros"><?php echo $detalle['id_producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['codigo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['id_inventario']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['lote']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($detalle['fecha_vencimiento'] != null && $detalle['fecha_vencimiento'] !== '') { echo date('m/Y', strtotime($detalle['fecha_vencimiento'])); } ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['cantidad_vendida']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['cantidad_devuelta']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['cantidad_disponible']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <form id="<?php echo $form_devolucion; ?>" method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=devoluciones_ventas"></form>
                <input form="<?php echo $form_devolucion; ?>" type="hidden" name="id_venta" value="<?php echo $detalle['id_venta']; ?>">
                <input form="<?php echo $form_devolucion; ?>" type="hidden" name="id_producto" value="<?php echo $detalle['id_producto']; ?>">
                <input form="<?php echo $form_devolucion; ?>" type="hidden" name="id_inventario" value="<?php echo $detalle['id_inventario']; ?>">
                <?php if ($detalle['cantidad_disponible'] > 0): ?>
                <input form="<?php echo $form_devolucion; ?>" type="number" name="cantidad" required min="1" max="<?php echo $detalle['cantidad_disponible']; ?>" class="campo-texto-num" placeholder="1">
                <?php else: ?>
                Sin disponible
                <?php endif; ?>
            </td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <?php if ($detalle['cantidad_disponible'] > 0): ?>
                <select form="<?php echo $form_devolucion; ?>" name="razon" required class="campo-texto">
                    <option value="">Razón</option>
                    <option value="Defectuoso">Defectuoso</option>
                    <option value="Cliente se equivocó">Cliente se equivocó</option>
                    <option value="No era lo que buscaba">No era lo que buscaba</option>
                </select>
                <?php endif; ?>
            </td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <?php if ($detalle['cantidad_disponible'] > 0): ?>
                <input form="<?php echo $form_devolucion; ?>" type="submit" value="Registrar devolución" name="accion" class="boton-insertar">
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layout/footer.php';?>
<?php if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}?>
</body>
</html>
