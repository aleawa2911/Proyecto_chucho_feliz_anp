<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Compras | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <?php
    $id_proveedor_compra = '';
    if (isset($_SESSION['id_proveedor_compra'])) {
        $id_proveedor_compra = $_SESSION['id_proveedor_compra'];
    }

    $total_compra = 0;
    foreach ($_SESSION['detalles_compra'] as $detalle) {
        $total_compra = $total_compra + $detalle['subtotal'];
    }
    ?>

    <div class="productos-controles">
    <!--Formulario para agregar detalles a la compra-->
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=compras">
        <table>
            <tr>
                <th><label class="insertar-text">Proveedor</label></th>
                <th><label class="insertar-text">Producto</label></th>
                <th><label class="insertar-text">Lote</label></th>
                <th><label class="insertar-text">Cantidad</label></th>
                <th><label class="insertar-text">Precio Unitario</label></th>
                <th><label class="insertar-text">Fecha Vencimiento</label></th>
            </tr>
            <tr>
                <td>
                    <select name="id_proveedor" required class="campo-texto">
                        <option value="">Proveedor</option>
                        <?php foreach ($dataP as $proveedor): ?>
                        <option value="<?php echo $proveedor['id_proveedor']; ?>" <?php if ($id_proveedor_compra == $proveedor['id_proveedor']) { echo 'selected'; } ?>><?php echo $proveedor['nombre_proveedor']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select name="id_producto" required class="campo-texto">
                        <option value="">Producto</option>
                        <?php foreach ($dataProductos as $producto): ?>
                        <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['codigo']; ?> - <?php echo $producto['nombre_producto']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="text" name="lote" required class="campo-texto" placeholder="LOTE001"></td>
                <td><input type="number" name="cantidad" required min="1" class="campo-texto" placeholder="1"></td>
                <td><input type="number" name="precio_unitario" required min="0" step="0.01" class="campo-texto" placeholder="0.00"></td>
                <td><input type="month" name="fecha_vencimiento" class="campo-texto"></td>
                <td><input type="submit" value="Agregar detalle" name="accion" class="boton-insertar"></td>
            </tr>
        </table>
        </form>
    </div>
    </div>

<!--Tabla temporal de detalles de la compra-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">Producto</th>
            <th class="th-registros">Lote</th>
            <th class="th-registros">Cantidad</th>
            <th class="th-registros">Precio Unitario</th>
            <th class="th-registros">Fecha Vencimiento</th>
            <th class="th-registros">Subtotal</th>
            <th class="th-registros">Acciones</th>
        </tr>

        <!--Recibimos los detalles temporales guardados en sesion-->
        <?php
        $contador_fila = 0;
        foreach ($_SESSION['detalles_compra'] as $indice => $detalle):
        $contador_fila++;
        ?>
        <tr>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['lote']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $detalle['cantidad']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">$<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($detalle['fecha_vencimiento'] != null && $detalle['fecha_vencimiento'] !== '') { echo date('m/Y', strtotime($detalle['fecha_vencimiento'])); } ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">$<?php echo number_format($detalle['subtotal'], 2); ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=compras">
                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                    <input type="submit" value="Quitar detalle" name="accion" class="boton-desactivar">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td class="th-registros" colspan="5">Total</td>
            <td class="th-registros">$<?php echo number_format($total_compra, 2); ?></td>
            <td class="th-registros">
                <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=compras">
                    <input type="hidden" name="id_proveedor" value="<?php echo $id_proveedor_compra; ?>">
                    <input type="submit" value="Registrar compra" name="accion" class="boton-insertar">
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
