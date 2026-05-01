<?php 
/*Retomamos la sesión en autentificación.php*/
require_once __DIR__ . '/../sesion/autentificacion.php';
/*Jalamos el modelo con el q vamos a trabajar*/
require_once __DIR__ . '/../../models/operaciones/cierre_caja.php';

    /*Instanciamos el modelo de cierre caja*/
    $modelo = new CierreCajaModelo();

    /*Obtenemos la caja abierta si existe*/
    $cajaAbierta = $modelo->ObtenerCajaAbierta();

    /*Si llegó una solicitud por post*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        /*Guardamos la acción enviada por el formulario*/
        $accion = $_POST['accion'];

        /*Revisamos que acción es para proceder*/
        switch ($accion) {
            case 'Abrir caja':
                try {
                    $id_usuario = $_SESSION['id_usuario'];
                    $id_cierre = $modelo->AbrirCaja($id_usuario);

                    $_SESSION['mensaje'] = "Se abrió correctamente la caja con ID $id_cierre.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=cierre_caja');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = $e->getMessage();
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=cierre_caja');
                    exit;
                }
                break;

            case 'Cerrar caja':
                try {
                    $id_cierre = $_POST['id_cierre'];
                    $modelo->CerrarCaja($id_cierre);

                    $_SESSION['mensaje'] = "Se cerró correctamente la caja.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=cierre_caja');
                    exit;
                } catch (Exception $e) {
                    $_SESSION['mensaje'] = "No se pudo cerrar la caja.";
                    header('Location: /proyecto_chucho_feliz_anp/index.php?url=cierre_caja');
                    exit;
                }
                break;
        }
    }

/*Jalamos la vista con la q se trabajara*/
require_once __DIR__ . '/../../views/operaciones/cierre_caja.php';
?>
