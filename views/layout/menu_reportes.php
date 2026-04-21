    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

<?php
$buscadores_reportes = [
    'reporte_ventas',
    'reporte_compras',
    'movimientos_inventario'
];
?>
    <div class="submenu-controles">
    <div class="header-box-subseccion">
        <!--Box de reportes-->
        <div class="header-boton">
            <a href="/proyecto_chucho_feliz_anp/index.php?url=reporte_ventas" class="boton <?php if($url=='reporte_ventas')echo 'boton-activo'?>"><img src="/proyecto_chucho_feliz_anp/public/images/venta.png" alt="icono historial ventas" class="icono-seccion">Reporte Ventas</a>
        </div>
        <div class="header-boton">
            <a href="/proyecto_chucho_feliz_anp/index.php?url=reporte_compras" class="boton <?php if($url=='reporte_compras')echo 'boton-activo'?>"><img src="/proyecto_chucho_feliz_anp/public/images/compra.png" alt="icono historial compras" class="icono-seccion">Reporte Compras</a>
        </div>
        <div class="header-boton">
            <a href="/proyecto_chucho_feliz_anp/index.php?url=movimientos_inventario" class="boton <?php if($url=='movimientos_inventario')echo 'boton-activo'?>"><img src="/proyecto_chucho_feliz_anp/public/images/productos.png" alt="icono movimientos inventario" class="icono-seccion">Movimientos Inventario</a>
        </div>
    </div>
    <?php if (in_array($url, $buscadores_reportes)) { ?>
    <div class="buscar-box">
        <form method="GET" action="/proyecto_chucho_feliz_anp/index.php" class="buscar-form">
            <input type="hidden" name="url" value="<?php echo $url; ?>">
            <input type="text" name="buscar" class="campo-texto" value="<?php echo $_GET['buscar'] ?? ''; ?>" placeholder="Buscar...">
            <input type="submit" value="Buscar" class="boton-buscar">
            <a href="/proyecto_chucho_feliz_anp/index.php?url=<?php echo $url; ?>" class="boton-cancelar">X</a>
        </form>
    </div>
    <?php } ?>
    </div>
