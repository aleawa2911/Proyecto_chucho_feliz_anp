<?php 
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../config/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../models/usuarios.php';
/*Jalamos el layout q usaremos en todo el sitio web*/
require_once __DIR__ . '/../views/layout/header.php';
require_once __DIR__ . '/../views/layout/footer.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero' || $_SESSION['rol'] == 'Encargado') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
    }

    /*Instanciamos el modelo de usuarios*/
	$modelo = new UsuariosModelo();
    /*Guardamos la data de las tablas en $data*/
	$data = $modelo->ObtenerTodos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        
        switch ($accion) {
            case 'Insertar':
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

                $modelo -> Insertar($primer_nombre,$segundo_nombre, $primer_apellido, $segundo_apellido, $nombre_usuario, $correo, $contrasena, $id_rol, $activo,$usuario_creacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                break;
            
	        case 'Editar':
                $id_usuario = $_POST['id_usuario'];
                $updateid = $modelo->ObtenerPorId($id_usuario);
	            break;

            case 'Actualizar':
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
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                break;

            case 'Desactivar':
                $id_usuario = $_POST['id_usuario'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Desactivar($id_usuario, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                break;

            case 'Activar':
                $id_usuario = $_POST['id_usuario'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Activar($id_usuario, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=usuarios');
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../views/usuarios/usuarios.php';
?>
