<?php

class Estabelecimentos_model extends CI_Model{

    public function buscaTodos(){
        return $this->db->get("estabelecimento")->result_array();
    }

    public function salvar($estabelecimento){
        $this->db->insert("estabelecimento", $estabelecimento);
    }

}

?>