<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Jalamos los estilos de CSS-->
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/fonts.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/base.css">
    <link rel="stylesheet" href="/proyecto_chucho_feliz_anp/public/css/styles.css">
    <title>Cierre de Caja | Chucho Feliz</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php';?>
    <div class="espacio-header"></div>

<!--Formulario de cierre de caja-->
<div class="tabla-registros-box">
    <table class="tabla-registros">
        <!--Header de la tabla-->
        <tr>
            <th class="th-registros">ID Caja</th>
            <th class="th-registros">Fecha</th>
            <th class="th-registros">Total Ventas</th>
            <th class="th-registros">Estado</th>
            <th class="th-registros">Acciones</th>
        </tr>

        <tr>
            <?php if ($cajaAbierta != false): ?>
            <td class="th-registros"><?php echo $cajaAbierta['id_cierre']; ?></td>
            <td class="td-registros"><?php echo $cajaAbierta['fecha']; ?></td>
            <td class="td-registros">$<?php echo number_format($cajaAbierta['total_ventas'], 2); ?></td>
            <td class="td-registros"><?php echo $cajaAbierta['estado']; ?></td>
            <td class="td-registros">
                <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=cierre_caja">
                    <input type="hidden" name="id_cierre" value="<?php echo $cajaAbierta['id_cierre']; ?>">
                    <input type="submit" value="Cerrar caja" name="accion" class="boton-desactivar">
                </form>
            </td>
            <?php else: ?>
            <td class="th-registros" colspan="4">No hay caja abierta</td>
            <td class="td-registros">
                <form method="POST" action="/proyecto_chucho_feliz_anp/index.php?url=cierre_caja">
                    <input type="submit" value="Abrir caja" name="accion" class="boton-insertar">
                </form>
            </td>
            <?php endif; ?>
        </tr>
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
