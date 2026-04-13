<?php
require_once __DIR__ . '/../config/autentificacion.php';
require_once __DIR__ . '/../models/proveedores.php';

if ($_SESSION['rol'] == 'Cajero') {
    header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
}

    $modelo = new ProveedoresModelo();
    $data = $modelo->ObtenerTodos();

require_once __DIR__ . '/../views/proveedores/proveedores.php';
?>
