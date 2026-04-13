<?php
require_once __DIR__ . '/../config/conexion.php';

class LoginModelo{
    private $pdo;

    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    /*Funcion para verificar contraseña comparando con la database*/
    public function verificar($user,$password)
    {
        $salt = "IDfgdgbnmnSDFedsfLSDFGGdsffdssSdfhuyt";
        $pass = hash('sha256', $salt . trim($password));
        $sql = "SELECT 
                    CONCAT(u.primer_nombre, ' ', u.primer_apellido) AS nombre_completo,
                    u.id_usuario,
                    r.nombre_rol AS rol,
                    u.activo
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id_rol
                WHERE u.nombre_usuario = :usuario 
                AND u.contrasena = :pass;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario' => $user, ':pass'=>$pass]);
        $data=$stmt->fetch();
        
        if ($data) {
            if($data['activo'] == '1'){
            return $data;
            }
            return null;
        }   
    }
}
?>
