<?php
require_once __DIR__ . '/../config/autentificacion.php';
require_once __DIR__ . '/../models/roles.php';

if ($_SESSION['rol'] == 'Cajero' || $_SESSION['rol'] == 'Encargado') {
    header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
}

    $modelo = new RolesModelo();
    $data = $modelo->ObtenerTodos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        
        switch ($accion) {
            case 'Insertar':
            
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                break;
            
            case 'Editar':
                # code...
                break;

            case 'Desactivar':
                $id_rol = $_POST['id_rol'];
                $modelo->Desactivar($id_rol);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                break;

            case 'Activar':
                $id_rol = $_POST['id_rol'];
                $modelo->Activar($id_rol);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=roles');
                break;
        }
    }
require_once __DIR__ . '/../views/roles/roles.php';
?>
