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
    <div class="espacio-header"></div>
    <br>
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=productos">
        <table >
            <tr>
                <th><label class="insertar-text">Codigo</label></th>
                <th><label class="insertar-text">Nombre</label></th>
                <th><label class="insertar-text">Precio de venta</label></th>
                <th><label class="insertar-text">Stock</label></th>
                <th><label class="insertar-text">Stock Defectuoso</label></th>
                <th><label class="insertar-text">Stock Mínimo</label></th>
                <th><label class="insertar-text">Categoría</label></th>
                <th><label class="insertar-text">Proveedor</label></th>
                <th><label class="insertar-text">Estado</label></th>
            </tr>
            <tr>
                <td><input type="text" name="codigo" required class="campo-texto" placeholder="ALI001"></td>
                <td><input type="text" name="nombre_producto" required class="campo-texto" placeholder="JugueteWawa"></td>
                <td><input type="text" name="precio_venta" required class="campo-texto" placeholder="12.99"></td>
                <td><input type="text" name="stock" required class="campo-texto" placeholder="4"></td>
                <td><input type="text" name="stock_defectuoso" required class="campo-texto" placeholder="5"></td>
                <td><input type="text" name="stock_minimo" required class="campo-texto" placeholder="10"></td>
                <td><select name="id_categoria" required class="campo-texto"> 
                        <option value="">Seleccione una categoría</option>
                        <?php foreach ($dataC as $categoria): ?>
                        <option value="<?php echo $categoria['id_categoria']?>"><?php echo $categoria['nombre_categoria']?></option>
                        <?php endforeach; ?>
                    </select></td>
                <td><select name="id_proveedor" required class="campo-texto"> 
                        <option value="">Seleccione un proveedor</option>
                        <?php foreach ($dataP as $proveedor): ?>
                        <option value="<?php echo $proveedor['id_proveedor']?>"><?php echo $proveedor['nombre_proveedor']?></option>
                        <?php endforeach; ?>
                    </select></td>
                <td><select name="activo" required class="campo-texto"> 
                        <option value="">Seleccione una categoría</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                </td>
                <td><input type="submit" value="Insertar" name="accion" class="boton-insertar"></td>
            </tr>
        </table>
        </form>
    </div>
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
            <th class="th-registros">Proveedor</th>
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
            <td class="td-registros"><?php echo $producto['nombre_producto']; ?></td>
            <td class="td-registros"><?php echo $producto['precio_venta']; ?></td>
            <td class="td-registros"><?php echo $producto['stock']; ?></td>
            <td class="td-registros"><?php echo $producto['stock_defectuoso']; ?></td>
            <td class="td-registros"><?php echo $producto['stock_minimo']; ?></td>
            <td class="td-registros"><?php echo $producto['categoria']; ?></td>
            <td class="td-registros"><?php echo $producto['proveedor']; ?></td>
            <td class="td-registros"><?php if ($producto['activo'] == 1) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <?php if ($_SESSION['rol'] != 'Cajero') { ?>
            <td class="td-registros"><?php echo $producto['fecha_creacion']; ?></td>
            <td class="td-registros"><?php echo $producto['fecha_actualizacion']; ?></td>
            <td class="td-registros"><?php echo $producto['usuario_creacion']; ?></td>
            <td class="td-registros"><?php echo $producto['usuario_actualizacion']; ?></td>
            <td class="td-registros">
                <form method="post" action="/proyecto_chucho_feliz_anp/index.php?url=productos">
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
