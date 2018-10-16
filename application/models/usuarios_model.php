<?php

class Usuarios_model extends CI_Model{

    public function login_usuario($email, $senha){
        $this->db->where("email", $email);
        $this->db->where("senha", $senha);
        $usuario = $this->db->get("usuario")->row_array();
        return $usuario;
    }

}

?>