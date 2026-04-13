<?php
require_once __DIR__ . '/../config/autentificacion.php';
require_once __DIR__ . '/../models/productos.php';

    $modelo = new ProductosModelo();
    $data = $modelo->ObtenerTodos();

require_once __DIR__ . '/../views/productos/productos.php';
?>
