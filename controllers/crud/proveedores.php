<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/crud/proveedores.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
    }

    /*Instanciamos el modelo de proveedores*/
    $modelo = new ProveedoresModelo();
    /*Guardamos la data de las tablas en $data*/
    $data = $modelo->ObtenerTodos();

    /*Si llegó una solicitud por POST*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        /*Guardamos la acción enviada por el formulario*/
        $accion = $_POST['accion'];
        
        /*Revisamos que acción es para proceder*/
        switch ($accion) {
            case 'Insertar':
                try {
                    $nombre_proveedor = $_POST['nombre_proveedor'];
                    $contacto = $_POST['contacto'];
                    $telefono = $_POST['telefono'];
                    $correo = $_POST['correo'];
                    $activo = $_POST['activo'];
                    $usuario_creacion = $_SESSION["id_usuario"];
                    $modelo->Insertar($nombre_proveedor, $contacto, $telefono,$correo,$activo,$usuario_creacion);
                    $_SESSION['mensaje'] = "Se insertó correctamente el proveedor.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo insertar el proveedor.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                    exit;
                }
                break;
            
            case 'Editar':
                $id_proveedor = $_POST['id_proveedor'];
                $updateid = $modelo->ObtenerPorId($id_proveedor);
                break;

            case 'Actualizar':
                try {
                    $id_proveedor = $_POST['id_proveedor'];
                    $nombre_proveedor = $_POST['nombre_proveedor'];
                    $contacto = $_POST['contacto'];
                    $telefono = $_POST['telefono'];
                    $correo = $_POST['correo'];
                    $usuario_actualizacion = $_SESSION["id_usuario"];
                    $modelo->Actualizar($id_proveedor,$nombre_proveedor,$contacto,$telefono,$correo,$usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se actualizó correctamente el proveedor con ID $id_proveedor.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo actualizar el proveedor con ID $id_proveedor.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                    exit;
                }
                break;

            case 'Desactivar':
                try {
                    $id_proveedor = $_POST['id_proveedor'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Desactivar($id_proveedor, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se desactivó correctamente el proveedor con ID $id_proveedor.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo desactivar el proveedor con ID $id_proveedor.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                    exit;
                }
                break;

            case 'Activar':
                try {
                    $id_proveedor = $_POST['id_proveedor'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Activar($id_proveedor, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se activó correctamente el proveedor con ID $id_proveedor.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo activar el proveedor con ID $id_proveedor.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=proveedores');
                    exit;
                }
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/crud/proveedores.php';
?>
