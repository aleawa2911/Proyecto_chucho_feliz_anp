<?php
require_once __DIR__ . '/../config/autentificacion.php';
require_once __DIR__ . '/../models/roles.php';
require_once __DIR__ . '/../views/layout/header.php';
require_once __DIR__ . '/../views/layout/footer.php';

if ($_SESSION['rol'] == 'Cajero' || $_SESSION['rol'] == 'Encargado') {
    header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
}

    $modelo = new RolesModelo();
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
                # code...
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
require_once __DIR__ . '/../views/roles/roles.php';
?>
