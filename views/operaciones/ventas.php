<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Ventas | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <?php
    $subtotal_venta = 0;
    foreach ($_SESSION['detalles_venta'] as $detalle) {
        $subtotal_venta = $subtotal_venta + $detalle['subtotal'];
    }

    $iva_venta = round($subtotal_venta * 0.13, 2);
    $total_venta = round($subtotal_venta + $iva_venta, 2);
    ?>

    <div class="productos-controles">
    <?php if ($cajaAbierta == false): ?>
    <div class="tabla-insertar">
        <table>
            <tr>
                <th class="mensaje-error-caja">Debe abrir caja antes de registrar ventas</th>
            </tr>
        </table>
    </div>
    <?php else: ?>
    <!--Formulario para agregar detalles a la venta-->
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=ventas">
        <table>
            <tr>
                <th><label class="insertar-text">Producto</label></th>
                <th><label class="insertar-text">Cantidad</label></th>
            </tr>
            <tr>
                <td>
                    <select name="id_producto" required class="campo-texto select-producto-operacion">
                        <option value="">Producto</option>
                        <?php foreach ($dataProductos as $producto): ?>
                        <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['codigo']; ?> - <?php echo $producto['nombre_producto']; ?> | Stock disponible: <?php echo $producto['stock_disponible']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="number" name="cantidad" required min="1" class="campo-texto" placeholder="1"></td>
                <td><input type="submit" value="Agregar producto" name="accion" class="boton-insertar"></td>
            </tr>
        </table>
        </form>
    </div>
    <?php endif; ?>
    </div>

<!--Tabla temporal de detalles de la venta-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">Producto</th>
            <th class="th-registros">Cantidad</th>
            <th class="th-registros">Precio Unitario</th>
            <th class="th-registros">Subtotal</th>
            <th class="th-registros">Acciones</th>
        </tr>

        <!--Recibimos los detalles temporales guardados en sesión-->
        <?php
        $contador_fila = 0;
        foreach ($_SESSION['detalles_venta'] as $indice => $detalle):
        $contador_fila++;
        ?>
        <tr>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['cantidad']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">$<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">$<?php echo number_format($detalle['subtotal'], 2); ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=ventas">
                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                    <input type="submit" value="Quitar detalle" name="accion" class="boton-desactivar">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td class="th-registros" colspan="3">Subtotal</td>
            <td class="th-registros">$<?php echo number_format($subtotal_venta, 2); ?></td>
            <td class="th-registros"></td>
        </tr>
        <tr>
            <td class="th-registros" colspan="3">IVA</td>
            <td class="th-registros">$<?php echo number_format($iva_venta, 2); ?></td>
            <td class="th-registros"></td>
        </tr>
        <tr>
            <td class="th-registros" colspan="3">Total</td>
            <td class="th-registros">$<?php echo number_format($total_venta, 2); ?></td>
            <td class="th-registros">
                <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=ventas">
                    <?php if ($cajaAbierta != false): ?>
                    <input type="submit" value="Registrar venta" name="accion" class="boton-insertar">
                    <?php endif; ?>
                    <input type="submit" value="X" name="accion" class="boton-cancelar">
                </form>
            </td>
        </tr>
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
