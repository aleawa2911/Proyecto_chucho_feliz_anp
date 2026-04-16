<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Historial | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <div class="header-box-seccion-historiales">
        <!--Box de historiales-->
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_productos" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/productos.png" alt="icono historial productos" class="icono-seccion">Historial Productos</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_proveedores" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/proveedores.png" alt="icono historial proveedores" class="icono-seccion">Historial Proveedores</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_categorias" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/categorias.png" alt="icono historial categorias" class="icono-seccion">Historial Categor&iacute;as</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_usuarios" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/usuarios.png" alt="icono historial usuarios" class="icono-seccion">Historial Usuarios</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_roles" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/roles.png" alt="icono historial roles" class="icono-seccion">Historial Roles</a></div>
    </div>
    <?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
