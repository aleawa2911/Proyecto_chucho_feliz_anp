<?php 
//guarda en la variable $url lo que devuelve get en url, si no viene url, usa login
$url = $_GET['url'] ?? 'login';

//Los botones del menu reenvian a index.php?url=talcosa, entonces el index toma la decision de llamar a X o Y controlador segun q traiga la variable url
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

    case 'inventario':
        require_once __DIR__ . '/controllers/crud/inventario.php';
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

    case 'historial_productos':
        require_once __DIR__ . '/controllers/control/historial_productos.php';
        break;

    case 'historial_proveedores':
        require_once __DIR__ . '/controllers/control/historial_proveedores.php';
        break;

    case 'historial_categorias':
        require_once __DIR__ . '/controllers/control/historial_categorias.php';
        break;

    case 'historial_usuarios':
        require_once __DIR__ . '/controllers/control/historial_usuarios.php';
        break;

    case 'historial_roles':
        require_once __DIR__ . '/controllers/control/historial_roles.php';
        break;

    case 'reportes':
        require_once __DIR__ . '/controllers/control/reportes.php';
        break;

    case 'reporte_ventas':
        require_once __DIR__ . '/controllers/control/reporte_ventas.php';
        break;

    case 'reporte_compras':
        require_once __DIR__ . '/controllers/control/reporte_compras.php';
        break;

    case 'reporte_devoluciones_cliente':
        require_once __DIR__ . '/controllers/control/reporte_devoluciones_cliente.php';
        break;

    case 'reporte_devoluciones_proveedor':
        require_once __DIR__ . '/controllers/control/reporte_devoluciones_proveedor.php';
        break;

    case 'reporte_caja':
        require_once __DIR__ . '/controllers/control/reporte_caja.php';
        break;

    case 'movimientos_inventario':
        require_once __DIR__ . '/controllers/control/movimientos_inventario.php';
        break;

    default:
        header('Location: /proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
}
?>
