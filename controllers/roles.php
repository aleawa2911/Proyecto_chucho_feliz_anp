<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../config/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../models/roles.php';
/*Jalamos el layout q usaremos en todo el sitio web*/
require_once __DIR__ . '/../views/layout/header.php';
require_once __DIR__ . '/../views/layout/footer.php';

    /*Chequeamos q el rol no sea uno de los no permitidos para ver esta parte por si tratan de entrar por url, en caso de tener prohibido el acceso, lo mandamos al dashboard*/
    if ($_SESSION['rol'] == 'Cajero' || $_SESSION['rol'] == 'Encargado') {
        header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
    }

    /*Instanciamos el modelo de roles*/
    $modelo = new RolesModelo();
    /*Guardamos la data de las tablas en $data*/
    $data = $modelo->ObtenerTodos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        
        switch ($accion) {
            case 'Insertar':
                $nombre_rol = $_POST['nombre_rol'];
                $descripcion = $_POST['descripcion'];
                $activo = $_POST['activo'];
                $usuario_creacion = $_SESSION["id_usuario"];
                $modelo->Insertar($nombre_rol, $descripcion, $activo,$usuario_creacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                break;
            
            case 'Editar':
                $id_rol = $_POST['id_rol'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $updateid = $modelo->ObtenerPorId($id_rol);
                break;

            case 'Actualizar':
                $id_rol = $_POST['id_rol'];
                $nombre_rol = $_POST['nombre_rol'];
                $descripcion = $_POST['descripcion'];
                $usuario_actualizacion = $_SESSION["id_usuario"];
                $modelo->Actualizar($id_rol,$nombre_rol,$descripcion,$usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                break;

            case 'Desactivar':
                $id_rol = $_POST['id_rol'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Desactivar($id_rol, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                break;

            case 'Activar':
                $id_rol = $_POST['id_rol'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Activar($id_rol, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../views/roles/roles.php';
?>
