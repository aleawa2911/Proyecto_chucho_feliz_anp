<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Historial Usuarios | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <div class="header-box-subseccion">
        <!--Box de historiales-->
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_productos" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/productos.png" alt="icono historial productos" class="icono-seccion">Historial Productos</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_proveedores" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/proveedores.png" alt="icono historial proveedores" class="icono-seccion">Historial Proveedores</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_categorias" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/categorias.png" alt="icono historial categorias" class="icono-seccion">Historial Categor&iacute;as</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_usuarios" class="boton boton-activo"><img src="/proyecto_chucho_feliz_anp/public/images/usuarios.png" alt="icono historial usuarios" class="icono-seccion">Historial Usuarios</a></div>
        <div class="header-boton"><a href="/proyecto_chucho_feliz_anp/index.php?url=historial_roles" class="boton"><img src="/proyecto_chucho_feliz_anp/public/images/roles.png" alt="icono historial roles" class="icono-seccion">Historial Roles</a></div>
    </div>
<!--Tabla de registros del historial-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID</th>
            <th class="th-registros">ID Usuario</th>
            <th class="th-registros">Accion</th>
            <th class="th-registros">Fecha Cambio</th>
            <th class="th-registros">Usuario Responsable</th>
            <th class="th-registros">Primer Nombre Anterior</th>
            <th class="th-registros">Primer Nombre Nuevo</th>
            <th class="th-registros">Segundo Nombre Anterior</th>
            <th class="th-registros">Segundo Nombre Nuevo</th>
            <th class="th-registros">Primer Apellido Anterior</th>
            <th class="th-registros">Primer Apellido Nuevo</th>
            <th class="th-registros">Segundo Apellido Anterior</th>
            <th class="th-registros">Segundo Apellido Nuevo</th>
            <th class="th-registros">Usuario Anterior</th>
            <th class="th-registros">Usuario Nuevo</th>
            <th class="th-registros">Correo Anterior</th>
            <th class="th-registros">Correo Nuevo</th>
            <th class="th-registros">ID Rol Anterior</th>
            <th class="th-registros">ID Rol Nuevo</th>
            <th class="th-registros">Estado Anterior</th>
            <th class="th-registros">Estado Nuevo</th>
            <th class="th-registros">Fecha Actualizacion Anterior</th>
            <th class="th-registros">Usuario Actualizacion Anterior</th>
        </tr>

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        <?php
        $contador_fila = 0; 
        foreach ($data as $historialusuario):
        $contador_fila++; 
        ?>
        <tr>
            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $historialusuario['id_historial']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['id_usuario']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['accion']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['fecha_cambio']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['usuario_responsable']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['primer_nombre_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['primer_nombre_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['segundo_nombre_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['segundo_nombre_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['primer_apellido_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['primer_apellido_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['segundo_apellido_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['segundo_apellido_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['nombre_usuario_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['nombre_usuario_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['correo_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['correo_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['id_rol_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['id_rol_nuevo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($historialusuario['activo_anterior']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($historialusuario['activo_nuevo']) {echo 'Activo';} else {echo 'Inactivo';} ; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['fecha_actualizacion_anterior']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $historialusuario['usuario_actualizacion_anterior']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
</body>
</html>
