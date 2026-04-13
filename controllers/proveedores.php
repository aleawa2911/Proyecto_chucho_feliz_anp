<?php
require_once __DIR__ . '/../config/autentificacion.php';
require_once __DIR__ . '/../models/proveedores.php';
require_once __DIR__ . '/../views/layout/header.php';
require_once __DIR__ . '/../views/layout/footer.php';

if ($_SESSION['rol'] == 'Cajero') {
    header('Location:/proyecto_chucho_feliz_anp/index.php?url=dashboard');
}

    $modelo = new ProveedoresModelo();
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
                # code...
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
require_once __DIR__ . '/../views/proveedores/proveedores.php';
?>
