<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/crud/categorias.php';

    /*Instanciamos el modelo de categorias*/
    $modelo = new CategoriasModelo();
    /*Guardamos la data de las tablas en $data*/
    $data = $modelo->ObtenerTodos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        
        switch ($accion) {
            case 'Insertar':
                $nombre_categoria = $_POST['nombre_categoria'];
                $descripcion = $_POST['descripcion'];
                $activo = $_POST['activo'];
                $usuario_creacion = $_SESSION["id_usuario"];
                $modelo->Insertar($nombre_categoria, $descripcion, $activo,$usuario_creacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                break;
            
            case 'Editar':
                $id_categoria = $_POST['id_categoria'];
                $updateid = $modelo->ObtenerPorId($id_categoria);
                break;

            case 'Actualizar':
                $id_categoria = $_POST['id_categoria'];
                $nombre_categoria = $_POST['nombre_categoria'];
                $descripcion = $_POST['descripcion'];
                $usuario_actualizacion = $_SESSION["id_usuario"];
                $modelo->Actualizar($id_categoria,$nombre_categoria,$descripcion,$usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                break;

            case 'Desactivar':
                $id_categoria = $_POST['id_categoria'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Desactivar($id_categoria, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                break;

            case 'Activar':
                $id_categoria = $_POST['id_categoria'];
                $usuario_actualizacion = $_SESSION['id_usuario'];
                $modelo->Activar($id_categoria, $usuario_actualizacion);
                header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/crud/categorias.php';
?>
