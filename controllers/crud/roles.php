<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/crud/roles.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero' || $_SESSION['rol'] == 'Encargado') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
        exit;
    }

    /*Instanciamos el modelo de roles*/
    $modelo = new RolesModelo();

    /*Obtenemos el parametro 'buscar' enviado por GET y lo guardamos en $buscar, si no hay, la declaramos como vacía*/
    $buscar = trim($_GET['buscar'] ?? '');

    /*Si buscar no está vacío, la usamos para guardar en $data la concidencia con la db, sino, guardamos todos los datos */
    if ($buscar !== '') { 
        $data = $modelo->BuscarPorTexto($buscar);
    } else {
        $data = $modelo->ObtenerTodos();
    }

    /*Si llegó una solicitud por POST*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        /*Guardamos la acción enviada por el formulario*/
        $accion = $_POST['accion'];
        
        /*Revisamos que acción es para proceder*/
        switch ($accion) {
            case 'Insertar':
                try {
                    $nombre_rol = $_POST['nombre_rol'];
                    $descripcion = $_POST['descripcion'];
                    $activo = $_POST['activo'];
                    $usuario_creacion = $_SESSION["id_usuario"];
                    $modelo->Insertar($nombre_rol, $descripcion, $activo,$usuario_creacion);
                    $_SESSION['mensaje'] = "Se insertó correctamente el rol.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo insertar el rol.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                    exit;
                }

                break;
            
            case 'Editar':
                $id_rol = $_POST['id_rol'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $updateid = $modelo->ObtenerPorId($id_rol);
                break;

            case 'Actualizar':
                try {
                    $id_rol = $_POST['id_rol'];
                    $nombre_rol = $_POST['nombre_rol'];
                    $descripcion = $_POST['descripcion'];
                    $usuario_actualizacion = $_SESSION["id_usuario"];
                    $modelo->Actualizar($id_rol,$nombre_rol,$descripcion,$usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se actualizó correctamente el rol con ID $id_rol.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo actualizar el rol con ID $id_rol.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                    exit;
                }

                break;

            case 'Desactivar':
                try {
                    $id_rol = $_POST['id_rol'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Desactivar($id_rol, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se desactivó correctamente el rol con ID $id_rol.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo desactivar el rol con ID $id_rol.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                    exit;
                }

                break;

            case 'Activar':
                try {
                    $id_rol = $_POST['id_rol'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Activar($id_rol, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se activó correctamente el rol con ID $id_rol.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo activar el rol con ID $id_rol.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                    exit;
                }

                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/crud/roles.php';
?>
