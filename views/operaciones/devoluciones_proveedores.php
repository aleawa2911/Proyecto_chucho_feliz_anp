<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Devoluciones Proveedores | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>
    <?php require_once __DIR__ . '/../layout/menu_devoluciones_botones.php';?>

<!--Tabla de productos defectuosos para devolución a proveedor-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros" colspan="10">Devoluciones a proveedor</th>
        </tr>
        <tr>
            <th class="th-registros">ID Compra</th>
            <th class="th-registros">ID Producto</th>
            <th class="th-registros">Código</th>
            <th class="th-registros">Producto</th>
            <th class="th-registros">ID Inventario</th>
            <th class="th-registros">Lote</th>
            <th class="th-registros">Vencimiento</th>
            <th class="th-registros">Stock Defectuoso</th>
            <th class="th-registros">Cantidad</th>
            <th class="th-registros">Razón</th>
            <th class="th-registros">Acción</th>
        </tr>

        <!--Recibimos los lotes con stock defectuoso-->
        <?php
        $contador_fila = 0;
        foreach ($lotesDefectuosos as $detalle):
        $contador_fila++;
        $form_devolucion = 'form_devolucion_proveedor_' . $contador_fila;
        ?>
        <tr>
            <td class="th-registros"><?php echo $detalle['id_compra']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['id_producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['codigo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['id_inventario']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['lote']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($detalle['fecha_vencimiento'] != null && $detalle['fecha_vencimiento'] !== '') { echo date('m/Y', strtotime($detalle['fecha_vencimiento'])); } ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['stock_defectuoso']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <form id="<?php echo $form_devolucion; ?>" method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=devoluciones_proveedores"></form>
                <input form="<?php echo $form_devolucion; ?>" type="hidden" name="id_compra" value="<?php echo $detalle['id_compra']; ?>">
                <input form="<?php echo $form_devolucion; ?>" type="hidden" name="id_producto" value="<?php echo $detalle['id_producto']; ?>">
                <input form="<?php echo $form_devolucion; ?>" type="hidden" name="id_inventario" value="<?php echo $detalle['id_inventario']; ?>">
                <input form="<?php echo $form_devolucion; ?>" type="number" name="cantidad" required min="1" max="<?php echo $detalle['stock_defectuoso']; ?>" class="campo-texto-num" placeholder="1">
            </td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <select form="<?php echo $form_devolucion; ?>" name="razon" required class="campo-texto">
                    <option value="">Razón</option>
                    <option value="Producto defectuoso">Producto defectuoso</option>
                    <option value="Producto vencido">Producto vencido</option>
                    <option value="Error de proveedor">Error de proveedor</option>
                </select>
            </td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <input form="<?php echo $form_devolucion; ?>" type="submit" value="Registrar devolución" name="accion" class="boton-insertar">
            </td>
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
