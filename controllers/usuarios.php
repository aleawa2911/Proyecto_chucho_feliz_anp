<?php 
require_once __DIR__ . '/../config/autentificacion.php';
require_once __DIR__ . '/../models/usuarios.php';
require_once __DIR__ . '/../views/layout/header.php';
require_once __DIR__ . '/../views/layout/footer.php';

    if ($_SESSION['rol'] == 'Cajero' || $_SESSION['rol'] == 'Encargado') {
    header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
    }
    
    $modelo = new UsuariosModelo();
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
                # code...
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

require_once __DIR__ . '/../views/usuarios/usuarios.php';
?>
