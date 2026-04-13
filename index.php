<?php 
// Si no viene nada en la URL, manda a login
$url = $_GET['url'] ?? 'login';

switch ($url) {

    case 'login':
        require_once __DIR__ . '/controllers/login.php';
        break;
    
    case 'dashboard':
        require_once __DIR__ . '/controllers/dashboard.php';
        break;

    case 'roles':
        require_once __DIR__ . '/controllers/roles.php';
        break;

    case 'cierre_caja':
        require_once __DIR__ . '/controllers/cierre_caja.php';
        break;

    case 'ventas':
        require_once __DIR__ . '/controllers/ventas.php';
        break;

    case 'productos':
        require_once __DIR__ . '/controllers/productos.php';
        break;

    case 'devoluciones':
        require_once __DIR__ . '/controllers/devoluciones.php';
        break;

    case 'compras':
        require_once __DIR__ . '/controllers/compras.php';
        break;

    case 'proveedores':
        require_once __DIR__ . '/controllers/proveedores.php';
        break;
    
    case 'categorias':
        require_once __DIR__ . '/controllers/categorias.php';
        break;

    case 'usuarios':
        require_once __DIR__ . '/controllers/usuarios.php';
        break;

    case 'reportes':
        require_once __DIR__ . '/controllers/reportes.php';
        break;

}

?>
