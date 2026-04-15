<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/crud/proveedores.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
    }

    /*Instanciamos el modelo de proveedores*/
	$modelo = new ProveedoresModelo();
    /*Guardamos la data de las tablas en $data*/
	$data = $modelo->ObtenerTodos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        
        switch ($accion) {
            case 'Insertar':
                $nombre_proveedor = $_POST['nombre_proveedor'];
                $contacto = $_POST['contacto'];
                $telefono = $_POST['telefono'];
                $correo = $_POST['correo'];
                $activo = $_POST['activo'];
                $usuario_creacion = $_SESSION["id_usuario"];
                $modelo->Insertar($nombre_proveedor, $contacto, $telefono,$correo,$activo,$usuario_creacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                break;
            
	        case 'Editar':
                $id_proveedor = $_POST['id_proveedor'];
                $updateid = $modelo->ObtenerPorId($id_proveedor);
	            break;

            case 'Actualizar':
                $id_proveedor = $_POST['id_proveedor'];
                $nombre_proveedor = $_POST['nombre_proveedor'];
                $contacto = $_POST['contacto'];
                $telefono = $_POST['telefono'];
                $correo = $_POST['correo'];
                $usuario_actualizacion = $_SESSION["id_usuario"];
                $modelo->Actualizar($id_proveedor,$nombre_proveedor,$contacto,$telefono,$correo,$usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                break;

            case 'Desactivar':
                $id_proveedor = $_POST['id_proveedor'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Desactivar($id_proveedor, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                break;

            case 'Activar':
                $id_proveedor = $_POST['id_proveedor'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Activar($id_proveedor, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/crud/proveedores.php';
?>
