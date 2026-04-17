<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Reportes | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <div class="header-box-subseccion">
        <!--Box de reportes-->
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=reporte_ventas" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/venta.png" alt="icono historial ventas" class="icono-seccion">Reporte Ventas</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=reporte_compras" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/compra.png" alt="icono historial compras" class="icono-seccion">Reporte Compras</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=movimientos_inventario" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/productos.png" alt="icono movimientos inventario" class="icono-seccion">Movimientos Inventario</a></div>
    </div>
    <?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
