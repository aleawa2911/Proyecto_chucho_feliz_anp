<?php 
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/crud/usuarios.php';
/*Jalamos el layout q usaremos en todo el sitio web*/

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero' || $_SESSION['rol'] == 'Encargado') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
    }

    /*Instanciamos el modelo de usuarios*/
    $modelo = new UsuariosModelo();
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
                    $primer_nombre = $_POST["primer_nombre"];
                    $segundo_nombre = $_POST["segundo_nombre"];
                    $primer_apellido = $_POST["primer_apellido"];
                    $segundo_apellido = $_POST["segundo_apellido"];
                    $nombre_usuario = $_POST["nombre_usuario"];
                    $correo = $_POST["correo"];
                    $contrasena = $_POST["contrasena"];
                    $id_rol = $_POST["id_rol"];
                    $activo = $_POST["activo"];
                    $usuario_creacion = $_SESSION["id_usuario"];

                    $modelo->Insertar($primer_nombre,$segundo_nombre, $primer_apellido, $segundo_apellido, $nombre_usuario, $correo, $contrasena, $id_rol, $activo,$usuario_creacion);
                    $_SESSION['mensaje'] = "Se insertó correctamente el usuario.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo insertar el usuario.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                    exit;
                }

                break;
            
            case 'Editar':
                $id_usuario = $_POST['id_usuario'];
                $updateid = $modelo->ObtenerPorId($id_usuario);
                break;

            case 'Actualizar':
                try {
                    $id_usuario = $_POST["id_usuario"];
                    $primer_nombre = $_POST["primer_nombre"];
                    $segundo_nombre = $_POST["segundo_nombre"];
                    $primer_apellido = $_POST["primer_apellido"];
                    $segundo_apellido = $_POST["segundo_apellido"];
                    $nombre_usuario = $_POST["nombre_usuario"];
                    $correo = $_POST["correo"];
                    $id_rol = $_POST["id_rol"];
                    $usuario_actualizacion = $_SESSION["id_usuario"];

                    $modelo->Actualizar($id_usuario,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$nombre_usuario,$correo,$id_rol,$usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se actualizó correctamente el usuario con ID $id_usuario.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo actualizar el usuario con ID $id_usuario.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                    exit;
                }

                break;

            case 'Desactivar':
                try {
                    $id_usuario = $_POST['id_usuario'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Desactivar($id_usuario, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se desactivó correctamente el usuario con ID $id_usuario.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo desactivar el usuario con ID $id_usuario.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                    exit;
                }

                break;

            case 'Activar':
                try {
                    $id_usuario = $_POST['id_usuario'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Activar($id_usuario, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se activó correctamente el usuario con ID $id_usuario.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo activar el usuario con ID $id_usuario.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                    exit;
                }

                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/crud/usuarios.php';
?>
