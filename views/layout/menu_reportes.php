    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

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