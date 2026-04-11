<?php
require_once __DIR__ . ('/../config/conexion.php');

class LoginModelo{
    private $pdo;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    public function verificar($user,$password)
    {
    $salt = "IDfgdgbnmnSDFedsfLSDFGGdsffdssSdfhuyt";
    $pass = hash('sha256', $salt . trim($password));
    $sql = "SELECT primer_nombre, primer_apellido, nombre_usuario, contrasena FROM usuarios where nombre_usuario = :usuario AND contrasena = :pass";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':usuario' => $user, ':pass'=>$pass]);
    $data=$stmt->fetchAll();

    if(count($data)===1){
        return 1;
    }else{
        return 0;
    }

    }

}

?>