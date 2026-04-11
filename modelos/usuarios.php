<?php 

class UsuariosModelo{
    
    public function Encriptar($password){
        $salt = "IDfgdgbnmnSDFedsfLSDFGGdsffdssSdfhuyt";
        $pass = hash('sha256', $salt . trim($password));
        return($pass);
    }
}

?>