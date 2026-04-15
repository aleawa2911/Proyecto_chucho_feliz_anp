<?php
/*GETeamos la url para definir en que seccion estamos, y que asi podamos darle al boton correcto el estilo CSS boton-activo*/
$url = $_GET['url']
;?>

<!--Header del sitio, tiene la funcion de navbar-->
<header class="header">

<div class="header-box-sesion">
        <!--Box donde mostramos primer nombre y apellido junto al rol guardados en las variables de sesion-->
        <div class="sesion-datos-box">
                <div class="sesion-nombre-box">
                        <?php echo $_SESSION["nombre"]?>
                </div>
                <div class="sesion-rol-box">
                        <?php echo $_SESSION['rol']?>
                </div>
        </div>
        <!--Box donde tenemos un enlace q nos manda al logout, para cerrar la sesion, el cual esta detras de un boton que contiene una imagen-->
        <div class="sesion-logout-box">
                <a href="/proyecto_chucho_feliz_anp/index.php?url=logout" class="boton-logout"><img src="/proyecto_chucho_feliz_anp/public/images/logout.png" alt="logout" class="sesion-logout-icon"></a>
        </div>
</div>
<!--Box donde mostramos nuestro logo en el header-->
<div class="header-logo-box">
                <img src="/proyecto_chucho_feliz_anp/public/images/logo.png" alt="logo" class="header-logo">
</div>

<!--Aqui chequeamos que rol tenemos guardado en nuestra variable de session para decidir que secciones vamos a mostrar en el header
igualmente cada controlador chequea eso tambien para q no puedan entrar por url sin permiso-->
<?php switch ($_SESSION['rol']) { 
        /*Q mostraremos en caso de q rol sea admin*/
        case 'Administrador':?>
                <div class="header-box-seccion">
                        <!--Box de Panel Principal-->
                        <p class="header-box-seccion-titulo">Principal</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=dashboard" class="boton <?php if($url=='dashboard')echo 'boton-activo'?>">Dashboard</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de operaciones-->
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=ventas" class="boton <?php if($url=='ventas')echo 'boton-activo'?>">Ventas</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=cierre_caja" class="boton <?php if($url=='cierre_caja')echo 'boton-activo'?>">Cierre de caja</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=devoluciones" class="boton <?php if($url=='devoluciones')echo 'boton-activo'?>">Devoluciones</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=compras" class="boton <?php if($url=='compras')echo 'boton-activo'?>">Compras</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de inventario-->
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=productos" class="boton <?php if($url=='productos')echo 'boton-activo'?>">Productos</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=proveedores" class="boton <?php if($url=='proveedores')echo 'boton-activo'?>">Proveedores</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=categorias" class="boton <?php if($url=='categorias')echo 'boton-activo'?>">Categorías</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de administracion-->
                        <p class="header-box-seccion-titulo">Administración</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=usuarios" class="boton <?php if($url=='usuarios')echo 'boton-activo'?>">Usuarios</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=roles" class="boton <?php if($url=='roles')echo 'boton-activo'?>">Roles</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial" class="boton <?php if($url=='historial')echo 'boton-activo'?>">Historial de Cambios</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de control-->
                        <p class="header-box-seccion-titulo">Control</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=reportes" class="boton <?php if($url=='reportes')echo 'boton-activo'?>">Reportes</a></div>
                </div>
                <?php break;

        /*Q mostraremos en caso de q rol sea encargado*/
        case 'Encargado':?>
                <div class="header-box-seccion">
                        <!--Box de Panel Principal-->
                        <p class="header-box-seccion-titulo">Principal</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=dashboard" class="boton <?php if($url=='dashboard')echo 'boton-activo'?>">Dashboard</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de operaciones-->
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=ventas" class="boton <?php if($url=='ventas')echo 'boton-activo'?>">Ventas</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=cierre_caja" class="boton <?php if($url=='cierre_caja')echo 'boton-activo'?>">Cierre de caja</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=devoluciones" class="boton <?php if($url=='devoluciones')echo 'boton-activo'?>">Devoluciones</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=compras" class="boton <?php if($url=='compras')echo 'boton-activo'?>">Compras</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de inventario-->
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=productos" class="boton <?php if($url=='productos')echo 'boton-activo'?>">Productos</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=proveedores" class="boton <?php if($url=='proveedores')echo 'boton-activo'?>">Proveedores</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=categorias" class="boton <?php if($url=='categorias')echo 'boton-activo'?>">Categorías</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de control-->
                        <p class="header-box-seccion-titulo">Control</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=reportes" class="boton <?php if($url=='reportes')echo 'boton-activo'?>">Reportes</a></div>
                </div>
                <?php break;

        /*Q mostraremos en caso de q rol sea cajero*/
        case 'Cajero':?>
                <div class="header-box-seccion">
                        <!--Box de Panel Principal-->
                        <p class="header-box-seccion-titulo">Principal</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=dashboard" class="boton <?php if($url=='dashboard')echo 'boton-activo'?>">Dashboard</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de operaciones-->
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=ventas" class="boton" <?php if($url=='ventas')echo 'boton-activo'?>">Ventas</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=cierre_caja" class="boton <?php if($url=='cierre_caja')echo 'boton-activo'?>">Cierre de caja</a></div>
                </div>
                <div class="header-box-seccion">
                        <!--Box de inventario-->
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=productos" class="boton <?php if($url=='productos')echo 'boton-activo'?>">Productos</a></div>
                        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=categorias" class="boton <?php if($url=='categorias')echo 'boton-activo'?>">Categorías</a></div>
                </div>
                <?php break; 
} ?>


</header>
