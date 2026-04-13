<?php 
require_once __DIR__ . '/../config/autentificacion.php';
require_once __DIR__ . '/../models/categorias.php';

    $modelo = new CategoriasModelo();
    $data = $modelo->ObtenerTodos();

require_once __DIR__ . '/../views/categorias/categorias.php';
?>
