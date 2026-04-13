<?php $url = $_GET['url'];?>

<header class="header">
<!--Si la variable de sesion rol contiene administrador, se mostrarán todas las opciones-->
<div class="header-box-sesion">
        <div class="sesion-datos-box">
                <div class="sesion-nombre-box">
                        <?php echo $_SESSION["nombre"]?>
                </div>
                <div class="sesion-rol-box">
                        <?php echo $_SESSION['rol']?>
                </div>
        </div>
        
        <div class="sesion-logout-box">
                <a href="/proyecto_chucho_feliz_anp/controllers/logout.php"><button class="boton-logout"><img src="public/images/logout.png" alt="logout" class="sesion-logout-icon"></button></button></a>
        </div>
</div>
<div class="header-logo-box">
                <img src="public/images/logo.png" alt="logo" class="header-logo">
</div>

<?php switch ($_SESSION['rol']) { 
        case 'Administrador':?>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="index.php?url=ventas" class="boton <?php if($url=='ventas')echo 'boton-activo'?>">Ventas</a></div>
                        <div class="header-boton"><a href="index.php?url=cierre_caja" class="boton <?php if($url=='cierra_caja')echo 'boton-activo'?>">Cierre de caja</a></div>
                        <div class="header-boton"><a href="index.php?url=devoluciones" class="boton <?php if($url=='devoluciones')echo 'boton-activo'?>">Devoluciones</a></div>
                        <div class="header-boton"><a href="index.php?url=compras" class="boton <?php if($url=='compras')echo 'boton-activo'?>">Compras</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="index.php?url=productos" class="boton <?php if($url=='productos')echo 'boton-activo'?>">Productos</a></div>
                        <div class="header-boton"><a href="index.php?url=proveedores" class="boton <?php if($url=='proveedores')echo 'boton-activo'?>">Proveedores</a></div>
                        <div class="header-boton"><a href="index.php?url=categorias" class="boton <?php if($url=='categorias')echo 'boton-activo'?>">Categorías</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Administración</p>
                        <div class="header-boton"><a href="index.php?url=usuarios" class="boton <?php if($url=='usuarios')echo 'boton-activo'?>">Usuarios</a></div>
                        <div class="header-boton"><a href="index.php?url=roles" class="boton <?php if($url=='roles')echo 'boton-activo'?>">Roles</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Control</p>
                        <div class="header-boton"><a href="index.php?url=reportes" class="boton <?php if($url=='reportes')echo 'boton-activo'?>">Reportes</a></div>
                </div>
                <?php break;

        case 'Encargado':?>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="index.php?url=ventas" class="boton <?php if($url=='ventas')echo 'boton-activo'?>">Ventas</a></div>
                        <div class="header-boton"><a href="index.php?url=cierre_caja" class="boton <?php if($url=='cierra_caja')echo 'boton-activo'?>">Cierre de caja</a></div>
                        <div class="header-boton"><a href="index.php?url=devoluciones" class="boton <?php if($url=='devoluciones')echo 'boton-activo'?>">Devoluciones</a></div>
                        <div class="header-boton"><a href="index.php?url=compras" class="boton <?php if($url=='compras')echo 'boton-activo'?>">Compras</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="index.php?url=productos" class="boton <?php if($url=='productos')echo 'boton-activo'?>">Productos</a></div>
                        <div class="header-boton"><a href="index.php?url=proveedores" class="boton <?php if($url=='proveedores')echo 'boton-activo'?>">Proveedores</a></div>
                        <div class="header-boton"><a href="index.php?url=categorias" class="boton <?php if($url=='categorias')echo 'boton-activo'?>">Categorías</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Control</p>
                        <div class="header-boton"><a href="index.php?url=reportes" class="boton <?php if($url=='reportes')echo 'boton-activo'?>">Reportes</a></div>
                </div>
                <?php break;

        case 'Cajero':?>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="index.php?url=ventas" class="boton" <?php if($url=='ventas')echo 'boton-activo'?>">Ventas</a></div>
                        <div class="header-boton"><a href="index.php?url=cierre_caja" class="boton <?php if($url=='cierre_caja')echo 'boton-activo'?>">Cierre de caja</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="index.php?url=productos" class="boton <?php if($url=='productos')echo 'boton-activo'?>">Productos</a></div>
                        <div class="header-boton"><a href="index.php?url=categorias" class="boton <?php if($url=='categorias')echo 'boton-activo'?>">Categorías</a></div>
                </div>
                <?php break; 
} ?>


</header>