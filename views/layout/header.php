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

<?php switch ($_SESSION['rol']) { 
        case 'Administrador':?>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="index.php?url=ventas" class="boton">Ventas</a></div>
                        <div class="header-boton"><a href="index.php?url=cierre_caja" class="boton">Cierre de caja</a></div>
                        <div class="header-boton"><a href="index.php?url=devoluciones" class="boton">Devoluciones</a></div>
                        <div class="header-boton"><a href="index.php?url=compras" class="boton">Compras</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="index.php?url=productos" class="boton">Productos</a></div>
                        <div class="header-boton"><a href="index.php?url=proveedores" class="boton">Proveedores</a></div>
                        <div class="header-boton"><a href="index.php?url=categorias" class="boton">Categorías</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Administración</p>
                        <div class="header-boton"><a href="index.php?url=usuarios" class="boton">Usuarios</a></div>
                        <div class="header-boton"><a href="index.php?url=roles" class="boton">Roles</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Control</p>
                        <div class="header-boton"><a href="index.php?url=reportes" class="boton">Reportes</a></div>
                </div>
                <?php break;

        case 'Encargado':?>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="index.php?url=ventas" class="boton">Ventas</a></div>
                        <div class="header-boton"><a href="index.php?url=cierre_caja" class="boton">Cierre de caja</a></div>
                        <div class="header-boton"><a href="index.php?url=devoluciones" class="boton">Devoluciones</a></div>
                        <div class="header-boton"><a href="index.php?url=compras" class="boton">Compras</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="index.php?url=productos" class="boton">Productos</a></div>
                        <div class="header-boton"><a href="index.php?url=proveedores" class="boton">Proveedores</a></div>
                        <div class="header-boton"><a href="index.php?url=categorias" class="boton">Categorías</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Control</p>
                        <div class="header-boton"><a href="index.php?url=reportes" class="boton">Reportes</a></div>
                </div>
                <?php break;

        case 'Cajero':?>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Operaciones</p>
                        <div class="header-boton"><a href="index.php?url=ventas" class="boton">Ventas</a></div>
                        <div class="header-boton"><a href="index.php?url=cierre_caja" class="boton">Cierre de caja</a></div>
                </div>
                <div class="header-box-seccion">
                        <p class="header-box-seccion-titulo">Inventario</p>
                        <div class="header-boton"><a href="index.php?url=productos" class="boton">Productos</a></div>
                        <div class="header-boton"><a href="index.php?url=categorias" class="boton">Categorías</a></div>
                </div>
                <?php break; 
} ?>

</header>