<?php 
/*Jalamos la conexion a la db*/
require_once __DIR__ . '/../../config/conexion.php';
class UsuariosModelo{

    /*Propiedad privada q guarda la conexion PDO a la DB*/
    private $pdo;

    /*Guardamos la conexion a la DB en la propiedad pdo*/
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }
    public function ObtenerTodos(){
                $sql = "SELECT 
                    u.id_usuario,
                    u.primer_nombre,
                    u.segundo_nombre,
                    u.primer_apellido,
                    u.segundo_apellido,
                    CONCAT_WS(' ', u.primer_nombre, u.segundo_nombre, u.primer_apellido, u.segundo_apellido) AS nombre_completo,
                    u.nombre_usuario,
                    u.correo,
                    u.id_rol,
                    r.nombre_rol AS rol,
                    u.activo,
                    u.fecha_creacion,
                    u.fecha_actualizacion,
                    uc.nombre_usuario AS usuario_creacion,
                    ua.nombre_usuario AS usuario_actualizacion
                FROM usuarios u
                INNER JOIN roles r 
                    ON u.id_rol = r.id_rol
                LEFT JOIN usuarios uc 
                    ON u.usuario_creacion = uc.id_usuario
                LEFT JOIN usuarios ua 
                    ON u.usuario_actualizacion = ua.id_usuario ORDER BY u.id_usuario ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function ObtenerPorId($id_usuario){
        $sql = "SELECT
                    id_usuario,
                    primer_nombre,
                    segundo_nombre,
                    primer_apellido,
                    segundo_apellido,
                    nombre_usuario,
                    correo,
                    id_rol
                FROM usuarios
                WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_usuario"=>$id_usuario]);
        $data = $stmt->fetch();
        return $data;
    }

    public function Actualizar($id_usuario,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$nombre_usuario,$correo,$id_rol,$usuario_actualizacion){
        $sql = "UPDATE usuarios
                SET
                    primer_nombre = :primer_nombre,
                    segundo_nombre = :segundo_nombre,
                    primer_apellido = :primer_apellido,
                    segundo_apellido = :segundo_apellido,
                    nombre_usuario = :nombre_usuario,
                    correo = :correo,
                    id_rol = :id_rol,
                    usuario_actualizacion = :usuario_actualizacion
                WHERE
                    id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_usuario'=>$id_usuario,':primer_nombre'=>$primer_nombre,':segundo_nombre'=>$segundo_nombre,':primer_apellido'=>$primer_apellido,':segundo_apellido'=>$segundo_apellido,':nombre_usuario'=>$nombre_usuario,':correo'=>$correo,':id_rol'=>$id_rol,':usuario_actualizacion'=>$usuario_actualizacion]);
    }

    public function Insertar($primer_nombre,$segundo_nombre, $primer_apellido, $segundo_apellido, $nombre_usuario, $correo, $contrasena, $id_rol, $activo, $usuario_creacion){
        $salt = "IDfgdgbnmnSDFedsfLSDFGGdsffdssSdfhuyt";
        $pass = hash('sha256', $salt . trim($contrasena));
        $sql = "INSERT INTO usuarios (
                                primer_nombre, 
                                segundo_nombre, 
                                primer_apellido, 
                                segundo_apellido, 
                                nombre_usuario, 
                                correo, 
                                contrasena, 
                                id_rol, 
                                activo,
                                usuario_creacion
                            ) 
                    VALUES (
                        :primer_nombre, 
                        :segundo_nombre, 
                        :primer_apellido, 
                        :segundo_apellido, 
                        :nombre_usuario, 
                        :correo, 
                        :contrasena, 
                        :id_rol, 
                        :activo,
                        :usuario_creacion
                        )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':primer_nombre'=>$primer_nombre,':segundo_nombre'=> $segundo_nombre, ':primer_apellido'=>$primer_apellido, ':segundo_apellido'=>$segundo_apellido, ':nombre_usuario'=>$nombre_usuario, ':correo'=>$correo, ':contrasena'=>$pass, ':id_rol'=>$id_rol, ':activo'=>$activo, ':usuario_creacion'=>$usuario_creacion]);
    }

    public function Desactivar($id_usuario,$usuario_actualizacion){
        $activo = 0;
        $sql = "UPDATE usuarios SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_usuario, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    } 

    public function Activar($id_usuario,$usuario_actualizacion){
        $activo = 1;
        $sql = "UPDATE usuarios SET activo = :activo, usuario_actualizacion = :usuario_actualizacion WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id_usuario, ':activo'=>$activo, ':usuario_actualizacion'=>$usuario_actualizacion]);
    }
}
?>
