<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Productos | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

    <div class="productos-controles">
    <?php if ($_SESSION['rol'] != 'Cajero') { ?>
    <!--Formulario para insertar datos en la tabla-->
    <div class="tabla-insertar">
        <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=productos">
        <table >
            <tr>
                
                <th><label class="insertar-text">Código</label></th>
                <th><label class="insertar-text">Nombre</label></th>
                <th><label class="insertar-text">Precio de venta</label></th>
                <th><label class="insertar-text">Stock Mínimo</label></th>
                <th><label class="insertar-text">Categoría</label></th>
                <th><label class="insertar-text">Proveedor</label></th>
                <th><label class="insertar-text">Estado</label></th>
            </tr>
            <tr>
                <td><input type="text" name="codigo" required class="campo-texto" placeholder="ALI001"></td>
                <td><input type="text" name="nombre_producto" required class="campo-texto" placeholder="JugueteWawa"></td>
                <td><input type="number" name="precio_venta" required class="campo-texto" placeholder="12.99"></td>
                <td><input type="number" name="stock_minimo" required min="0" class="campo-texto" placeholder="10"></td>
                <td><select name="id_categoria" required class="campo-texto"> 
                        <option value="">Categoría</option>
                        <?php foreach ($dataC as $categoria): ?>
                        <option value="<?php echo $categoria['id_categoria']?>"><?php echo $categoria['nombre_categoria']?></option>
                        <?php endforeach; ?>
                    </select></td>
                <td><select name="id_proveedor" required class="campo-texto"> 
                        <option value="">Proveedor</option>
                        <?php foreach ($dataP as $proveedor): ?>
                        <option value="<?php echo $proveedor['id_proveedor']?>"><?php echo $proveedor['nombre_proveedor']?></option>
                        <?php endforeach; ?>
                    </select></td>
                <td><select name="activo" required class="campo-texto"> 
                        <option value="">Estado</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                </td>
                <!--Boton que triggerea la accion insertar en el controlador-->
                <td><input type="submit" value="Insertar" name="accion" class="boton-insertar"></td>
            </tr>
        </table>
        </form>
    </div>
    <?php } ?> 
    <div class="buscar-box">
        <form method="GET" action="/proyecto_chucho_feliz_anp/index.php" class="buscar-form">
            <input type="hidden" name="url" value="productos">
            <input type="text" name="buscar" class="campo-texto" value="<?php echo $_GET['buscar'] ?? ''; ?>" placeholder="Buscar...">
            <input type="submit" value="Buscar" class="boton-buscar">
            <a href="/proyecto_chucho_feliz_anp/index.php?url=productos" class="boton-cancelar">X</a>
        </form>
    </div>
    </div>
<!--Tabla de registros-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID</th>
            <th class="th-registros">Código</th>
            <th class="th-registros">Nombre</th>
            <th class="th-registros">Precio</th>
            <th class="th-registros">Stock Total</th>
            <th class="th-registros">Stock Mínimo</th>
            <th class="th-registros">Categoría</th>
            <th class="th-registros">Estado</th>
            <?php if ($_SESSION['rol'] != 'Cajero') { ?>    
            <th class="th-registros">Proveedor</th> 
            <th class="th-registros">Acciones</th> 
            <?php } ?>
        </tr>

        <!--Recibimos los datos de la funcion ObtenerTodos()-->
        <?php 
        $contador_fila = 0;
        foreach ($data as $producto): 
        $contador_fila++;
        ?>
        <tr>
            <!--Formulario de edicion, chequeamos si esta definida la variable $updateid (se define cuando el controlador recibe la accion editar y el valor con X id mediante $_POST)
            y si el valor coincide con el de la fila para mostrar los campos como formulario y el boton actualizar para enviar esos datos al controlador para la funcion Actualizar-->
            <?php if (isset($updateid) && $updateid['id_producto'] == $producto['id_producto']) { ?>
            <td class="th-registros"><?php echo $producto['id_producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="codigo" value="<?php echo $producto['codigo']; ?>" required class="campo-texto" form="form-editar-productos"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="nombre_producto" value="<?php echo $producto['nombre_producto']; ?>" required class="campo-texto" form="form-editar-productos"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="precio_venta" value="<?php echo $producto['precio_venta']; ?>" required class="campo-texto-num" form="form-editar-productos"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $producto['stock_total']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><input type="text" name="stock_minimo" value="<?php echo $producto['stock_minimo']; ?>" required class="campo-texto-num" form="form-editar-productos"></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <select name="id_categoria" required class="campo-texto" form="form-editar-productos">
                    <!--Recibimos los id y nombres de las categorias con ObtenerCategoria()-->
                    <?php foreach ($dataC as $categoria): ?>
                        <!--Printeamos las id_categoria y nombre_categoria, luego chequeamos si el id_categoria de $producto es igual al de $categoria, si lo es, lo marcamos como selected-->
                        <option value="<?php echo $categoria['id_categoria']?>"
                            <?php if ($producto['id_categoria'] === $categoria['id_categoria']) { echo 'selected'; } ?>>
                            <?php echo $categoria['nombre_categoria']?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($producto['activo'] == 1) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <select name="id_proveedor" class="campo-texto" form="form-editar-productos">
                    <!--Recibimos los id y nombres de los proveedores con ObtenerProveedor()-->
                    <?php foreach ($dataP as $proveedor): ?>
                        <!--Printeamos las id_proveedor y nombre_proveedor, luego chequeamos si el id_proveedor de $producto es igual al de $proveedor, si lo es, lo marcamos como selected-->
                        <option value="<?php echo $proveedor['id_proveedor']?>"
                            <?php if ($producto['id_proveedor'] === $proveedor['id_proveedor']) { echo 'selected'; } ?>>
                            <?php echo $proveedor['nombre_proveedor']?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                    <form id="form-editar-productos" method="post" action="/proyecto_chucho_feliz_anp/index.php?url=productos">
                    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']?>">
                    <input type="submit" class="boton-actualizar" name="accion" value="Actualizar">
                    </form>
                    <a href="/proyecto_chucho_feliz_anp/index.php?url=productos" class="boton-cancelar">X</a>
            </td>
            <?php } else { ?>


            <!--Se muestran los registros de la tabla q obtuvimos con el foreach-->
            <td class="th-registros"><?php echo $producto['id_producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $producto['codigo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $producto['nombre_producto']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">$<?php echo number_format($producto['precio_venta'], 2); ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $producto['stock_total']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $producto['stock_minimo']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $producto['categoria']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php if ($producto['activo'] == 1) {echo 'Activo';} else {echo 'Inactivo';} ?></td>
            <!--Si el rol es cajero, no mostramos los datos innecesarios para la venta-->
            <?php if ($_SESSION['rol'] != 'Cajero') { ?>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>"><?php echo $producto['proveedor']; ?></td>
            <td class="<?php if ($contador_fila % 2 === 0) echo 'td-registros-alterno'; else echo 'td-registros'; ?>">
                <!--Botones que triggerean los cases del switch del controlador-->
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
            <?php } ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once __DIR__ . '/../layout/footer.php';?>
<?php if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}?>
</body>
</html>
