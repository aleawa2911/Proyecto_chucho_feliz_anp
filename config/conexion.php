<?php 
class Conexion{

    public function conectar(){
        $dsn = 'mysql:host=localhost;dbname=chucho_feliz';
        $user = 'root';
        $pass = '';
        try{
            $pdo = new PDO($dsn,$user,$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}


?>