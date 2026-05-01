<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!--Jalamos los estilos de CSS-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Resumen | Chucho Feliz</title>
</head>
<body>
    
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <?php
    $estado_caja = 'Sin abrir';
    $total_caja = 0;

    if ($cajaDia != false) {
        $total_caja = $cajaDia['total_ventas'];

        if ($cajaDia['estado'] == 'abierto') {
            $estado_caja = 'Abierta';
        }

        if ($cajaDia['estado'] == 'cerrado') {
            $estado_caja = 'Cerrada';
        }
    }

    $cantidad_ventas = 0;
    $total_vendido = 0;

    if ($ventasDia != false) {
        $cantidad_ventas = $ventasDia['cantidad_ventas'];

        if ($ventasDia['total_vendido'] != null) {
            $total_vendido = $ventasDia['total_vendido'];
        }
    }

    ?>

    <div class="resumen-header">
        <p class="resumen-header-titulo">Resumen del día y alertas principales</p>
    </div>

    <div class="resumen-cards">
        <div class="resumen-card">
            <h2 class="resumen-titulo resumen-caja">Caja del día</h2>
            <div class="resumen-dato">
                <span class="resumen-etiqueta">Estado</span>
                <span class="resumen-valor"><?php echo $estado_caja; ?></span>
            </div>
            <div class="resumen-dato resumen-total">
                <span class="resumen-etiqueta">Total vendido</span>
                <span class="resumen-valor">$<?php echo number_format($total_caja, 2); ?></span>
            </div>
        </div>

        <div class="resumen-card">
            <h2 class="resumen-titulo resumen-ventas">Ventas del día</h2>
            <div class="resumen-dato">
                <span class="resumen-etiqueta">Ventas realizadas</span>
                <span class="resumen-valor"><?php echo $cantidad_ventas; ?></span>
            </div>
            <div class="resumen-dato resumen-total">
                <span class="resumen-etiqueta">Total vendido</span>
                <span class="resumen-valor">$<?php echo number_format($total_vendido, 2); ?></span>
            </div>
        </div>
    </div>

    <div class="resumen-cards resumen-tabla">
        <div class="resumen-card">
            <h2 class="resumen-titulo resumen-inventario-bajo">Inventario bajo</h2>
            <?php if (count($inventarioBajo) > 0): ?>
            <div class="resumen-lista">
            <?php
            $contador_fila = 0;
            foreach ($inventarioBajo as $producto):
            $contador_fila++;
            ?>
                <div class="resumen-item <?php if ($contador_fila % 2 === 0) echo 'resumen-item-alterno'; ?>">
                    <div class="resumen-producto"><?php echo $producto['codigo']; ?> - <?php echo $producto['nombre_producto']; ?></div>
                    <div class="resumen-detalle">Stock: <?php echo $producto['stock_total']; ?> | Mínimo: <?php echo $producto['stock_minimo']; ?></div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="resumen-item">No hay productos bajo el mínimo</div>
            <?php endif; ?>
        </div>

        <div class="resumen-card">
            <h2 class="resumen-titulo resumen-stock-defectuoso">Stock defectuoso</h2>
            <?php if (count($stockDefectuoso) > 0): ?>
            <div class="resumen-lista">
            <?php
            $contador_fila = 0;
            foreach ($stockDefectuoso as $producto):
            $contador_fila++;
            ?>
                <div class="resumen-item <?php if ($contador_fila % 2 === 0) echo 'resumen-item-alterno'; ?>">
                    <div class="resumen-producto"><?php echo $producto['codigo']; ?> - <?php echo $producto['nombre_producto']; ?></div>
                    <div class="resumen-detalle">Lote: <?php echo $producto['lote']; ?> | Defectuoso: <?php echo $producto['stock_defectuoso']; ?></div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="resumen-item">No hay stock defectuoso</div>
            <?php endif; ?>
        </div>
    </div>

    <?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
