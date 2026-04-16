<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Historial Productos | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <div class="header-box-seccion-historiales">
        <!--Box de historiales-->
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_productos" class="boton boton-activo"><img src="/proyecto_chucho_feliz_anp/public/images/productos.png" alt="icono historial productos" class="icono-seccion">Historial Productos</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_proveedores" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/proveedores.png" alt="icono historial proveedores" class="icono-seccion">Historial Proveedores</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_categorias" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/categorias.png" alt="icono historial categorias" class="icono-seccion">Historial Categor&iacute;as</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_usuarios" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/usuarios.png" alt="icono historial usuarios" class="icono-seccion">Historial Usuarios</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_roles" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/roles.png" alt="icono historial roles" class="icono-seccion">Historial Roles</a></div>
    </div>

<!--Tabla de registros del historial-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID Historial</th>
            <th class="th-registros">ID Producto</th>
            <th class="th-registros">Accion</th>
            <th class="th-registros">Fecha Cambio</th>
            <th class="th-registros">Usuario Responsable</th>
            <th class="th-registros">Codigo Anterior</th>
            <th class="th-registros">Codigo Nuevo</th>
            <th class="th-registros">Nombre Producto Anterior</th>
            <th class="th-registros">Nombre Producto Nuevo</th>
            <th class="th-registros">Precio Venta Anterior</th>
            <th class="th-registros">Precio Venta Nuevo</th>
            <th class="th-registros">Stock Anterior</th>
            <th class="th-registros">Stock Nuevo</th>
            <th class="th-registros">Stock Defectuoso Anterior</th>
            <th class="th-registros">Stock Defectuoso Nuevo</th>
            <th class="th-registros">Stock Minimo Anterior</th>
            <th class="th-registros">Stock Minimo Nuevo</th>
            <th class="th-registros">ID Categoria Anterior</th>
            <th class="th-registros">ID Categoria Nuevo</th>
            <th class="th-registros">ID Proveedor Anterior</th>
            <th class="th-registros">ID Proveedor Nuevo</th>
            <th class="th-registros">Estado Anterior</th>
            <th class="th-registros">Estado Nuevo</th>
            <th class="th-registros">Fecha Actualizacion Anterior</th>
            <th class="th-registros">Usuario Actualizacion Anterior</th>
        </tr>

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        <?php foreach ($data as $historialproducto):?>
        <tr>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="td-registros"><?php echo $historialproducto['id_historial']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['id_producto']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['accion']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['fecha_cambio']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['usuario_responsable']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['codigo_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['codigo_nuevo']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['nombre_producto_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['nombre_producto_nuevo']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['precio_venta_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['precio_venta_nuevo']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['stock_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['stock_nuevo']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['stock_defectuoso_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['stock_defectuoso_nuevo']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['stock_minimo_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['stock_minimo_nuevo']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['id_categoria_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['id_categoria_nuevo']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['id_proveedor_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['id_proveedor_nuevo']; ?></td>
            <td class="td-registros"><?php if ($historialproducto['activo_anterior']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="td-registros"><?php if ($historialproducto['activo_nuevo']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="td-registros"><?php echo $historialproducto['fecha_actualizacion_anterior']; ?></td>
            <td class="td-registros"><?php echo $historialproducto['usuario_actualizacion_anterior']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
