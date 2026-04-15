<?php
/*Retomamos la sesion en autentificacion.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/crud/categorias.php';

    /*Instanciamos el modelo de categorias*/
    $modelo = new CategoriasModelo();
    /*Guardamos la data de las tablas en $data*/
    $data = $modelo->ObtenerTodos();

    /*Si llegó una solicitud por POST*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['rol'] != 'Cajero') {
        
        /*Guardamos la acción enviada por el formulario*/
        $accion = $_POST['accion'];
        
        /*Revisamos que acción es para proceder*/
        switch ($accion) {
            case 'Insertar':
                try {
                    $nombre_categoria = $_POST['nombre_categoria'];
                    $descripcion = $_POST['descripcion'];
                    $activo = $_POST['activo'];
                    $usuario_creacion = $_SESSION["id_usuario"];
                    $modelo->Insertar($nombre_categoria, $descripcion, $activo,$usuario_creacion);
                    $_SESSION['mensaje'] = "Se insertó correctamente la categoría.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo insertar la categoría.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                    exit;
                }
                break;
            
            case 'Editar':
                $id_categoria = $_POST['id_categoria'];
                $updateid = $modelo->ObtenerPorId($id_categoria);
                break;

            case 'Actualizar':
                try {
                    $id_categoria = $_POST['id_categoria'];
                    $nombre_categoria = $_POST['nombre_categoria'];
                    $descripcion = $_POST['descripcion'];
                    $usuario_actualizacion = $_SESSION["id_usuario"];
                    $modelo->Actualizar($id_categoria,$nombre_categoria,$descripcion,$usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se actualizó correctamente la categoría con ID $id_categoria.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo actualizar la categoría con ID $id_categoria.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                    exit;
                }
                break;

            case 'Desactivar':
                try {
                    $id_categoria = $_POST['id_categoria'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Desactivar($id_categoria, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se desactivó correctamente la categoría con ID $id_categoria.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo desactivar la categoría con ID $id_categoria.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                    exit;
                }
                break;

            case 'Activar':
                try {
                    $id_categoria = $_POST['id_categoria'];
                    $usuario_actualizacion = $_SESSION['id_usuario'];
                    $modelo->Activar($id_categoria, $usuario_actualizacion);
                    $_SESSION['mensaje'] = "Se activó correctamente la categoría con ID $id_categoria.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo activar la categoría con ID $id_categoria.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=categorias');
                    exit;
                }
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/crud/categorias.php';
?>
