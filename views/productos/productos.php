<?php 
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Productos</title>
</head>
<body>
<h1>Gestión de productos</h1>
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <tr>
            <th class="th-registros">Codigo</th>
            <th class="th-registros">Nombre</th>
            <th class="th-registros">Precio</th>
            <th class="th-registros">Stock</th>
            <th class="th-registros">Stock Mínimo</th>
            <th class="th-registros">Stock Defectuoso</th>  
            <th class="th-registros">Categoría</th>
            <th class="th-registros">producto</th>
            <th class="th-registros">Estado</th>

            <?php if ($_SESSION['rol'] != 'Cajero') { ?>      
            <th class="th-registros">Fecha Creación</th>
            <th class="th-registros">Fecha Actualización</th>
            <th class="th-registros">Usuario Creación</th>
            <th class="th-registros">Usuario Actualización</th>
            <th class="th-registros">Acciones</th> 
            <?php } ?>
        </tr>

        <?php foreach ($data as $producto): ?>
        <tr>
            <td class="td-registros"><?php echo $producto['codigo']; ?></td>
            <td class="td-registros"><?php echo $producto['nombre']; ?></td>
            <td class="td-registros"><?php echo $producto['precio_venta']; ?></td>
            <td class="td-registros"><?php echo $producto['stock']; ?></td>
            <td class="td-registros"><?php echo $producto['stock_minimo']; ?></td>
            <td class="td-registros"><?php echo $producto['stock_defectuoso']; ?></td>
            <td class="td-registros"><?php echo $producto['categoria']; ?></td>
            <td class="td-registros"><?php echo $producto['proveedor']; ?></td>
            <td class="td-registros"><?php if ($producto['activo']) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <?php if ($_SESSION['rol'] != 'Cajero') { ?>
            <td class="td-registros"><?php echo $producto['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $producto['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $producto['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $producto['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                <form method="post" action="/proyecto_chucho_feliz_anp/controllers/productos.php">
                    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']?>">
                    <input type="submit" class="boton-editar" name="accion" value="Editar">
                    <?php if ($producto['activo'] == '1') {?>
                    <input type="submit" class="boton-desactivar" name="accion" value="Desactivar">
                    <?php }else{ ?>
                    <input type="submit" class="boton-activar" name="accion" value="Activar">
                    <?php }?>
                </form>
            </td>    
            <?php } ?>  
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
