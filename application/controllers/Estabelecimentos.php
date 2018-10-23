<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimentos extends CI_Controller {

	public function index()	{

		$this->load->model("estabelecimentos_model");
		$lista = $this->estabelecimentos_model->buscaTodos();
		$dados = array("estabelecimentos" => $lista);
		$this->load->view('estabelecimentos/index', $dados);

	}

	public function novo(){

		$estabelecimento = array(
			"nome" => $this->input->post("nome"),
			"cep" => $this->input->post("cep"),
			"endereco" => $this->input->post("endereco")
		);

		$this->load->model("estabelecimentos_model");
		$this->estabelecimentos_model->salvar($estabelecimento);
		$this->load->view("estabelecimentos/novo");

	}

	public function consulta(){
    
        $cep = $this->input->post('cep');
        
        $this->load->library('curl');
        
        echo $this->curl->consulta($cep);
        
	}

}

?>