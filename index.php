<?php 
// Si no viene nada en la URL, manda a login por default
$url = $_GET['url'] ?? 'login';

//Los botones de la pagina reenvian a un index.php?url=talcosa, entonces el index toma la decision segun que url se le da, de llamar a X o Y controlador

switch ($url) {

    case 'login':
        require_once __DIR__ . '/controllers/sesion/login.php';
        break;

    case 'logout':
        require_once __DIR__ . '/controllers/sesion/logout.php';
        break;    
    
    case 'dashboard':
        require_once __DIR__ . '/controllers/control/dashboard.php';
        break;

    case 'roles':
        require_once __DIR__ . '/controllers/crud/roles.php';
        break;

    case 'cierre_caja':
        require_once __DIR__ . '/controllers/operaciones/cierre_caja.php';
        break;

    case 'ventas':
        require_once __DIR__ . '/controllers/operaciones/ventas.php';
        break;

    case 'productos':
        require_once __DIR__ . '/controllers/crud/productos.php';
        break;

    case 'devoluciones':
        require_once __DIR__ . '/controllers/operaciones/devoluciones.php';
        break;

    case 'compras':
        require_once __DIR__ . '/controllers/operaciones/compras.php';
        break;

    case 'proveedores':
        require_once __DIR__ . '/controllers/crud/proveedores.php';
        break;
    
    case 'categorias':
        require_once __DIR__ . '/controllers/crud/categorias.php';
        break;

    case 'usuarios':
        require_once __DIR__ . '/controllers/crud/usuarios.php';
        break;

    case 'historial':
        require_once __DIR__ . '/controllers/control/historial.php';
        break;

    case 'reportes':
        require_once __DIR__ . '/controllers/control/reportes.php';
        break;

}

?>
