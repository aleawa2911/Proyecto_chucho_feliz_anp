<?php
require_once __DIR__ . '/../config/autentificacion.php';    
session_destroy();
header('Location:/proyecto_chucho_feliz_anp/index.php?url=login');
exit;
?>
