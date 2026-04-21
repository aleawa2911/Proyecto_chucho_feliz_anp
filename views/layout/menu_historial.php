<?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>
<?php
$buscadores_historial = [
    'historial_productos',
    'historial_proveedores',
    'historial_categorias',
    'historial_usuarios',
    'historial_roles'
];
?>
<div class="submenu-controles">
<div class="header-box-subseccion">
    <!--Box de historiales-->
    <div class="header-boton">
        <a href="/proyecto_chucho_feliz_anp/index.php?url=historial_productos" class="boton <?php if($url=='historial_productos')echo 'boton-activo'?>"><img src="/proyecto_chucho_feliz_anp/public/images/productos.png" alt="icono historial productos" class="icono-seccion">Historial Productos</a>
    </div>
    <div class="header-boton">
        <a href="/proyecto_chucho_feliz_anp/index.php?url=historial_proveedores" class="boton <?php if($url=='historial_proveedores')echo 'boton-activo'?>"><img src="/proyecto_chucho_feliz_anp/public/images/proveedores.png" alt="icono historial proveedores" class="icono-seccion">Historial Proveedores</a>
    </div>
    <div class="header-boton">
        <a href="/proyecto_chucho_feliz_anp/index.php?url=historial_categorias" class="boton <?php if($url=='historial_categorias')echo 'boton-activo'?>"><img src="/proyecto_chucho_feliz_anp/public/images/categorias.png" alt="icono historial categorias" class="icono-seccion">Historial Categorías</a>
    </div>
    <div class="header-boton">
        <a href="/proyecto_chucho_feliz_anp/index.php?url=historial_usuarios" class="boton <?php if($url=='historial_usuarios')echo 'boton-activo'?>"><img src="/proyecto_chucho_feliz_anp/public/images/usuarios.png" alt="icono historial usuarios" class="icono-seccion">Historial Usuarios</a>
    </div>
    <div class="header-boton">
        <a href="/proyecto_chucho_feliz_anp/index.php?url=historial_roles" class="boton <?php if($url=='historial_roles')echo 'boton-activo'?>"><img src="/proyecto_chucho_feliz_anp/public/images/roles.png" alt="icono historial roles" class="icono-seccion">Historial Roles</a>
    </div>
</div>
<?php if (in_array($url, $buscadores_historial)) { ?>
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
