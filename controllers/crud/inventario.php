<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/crud/inventario.php';

/*Instanciamos el modelo de inventario*/
$modelo = new InventarioModelo();

/*Obtenemos el parametro buscar enviado por GET*/
$buscar = trim($_GET['buscar'] ?? '');

/*Si buscar no esta vacio, guardamos las coincidencias; si no, guardamos todos los datos*/
if ($buscar !== '') {
    $data = $modelo->BuscarPorTexto($buscar);
} else {
    $data = $modelo->ObtenerTodos();
}

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/crud/inventario.php';
?>
