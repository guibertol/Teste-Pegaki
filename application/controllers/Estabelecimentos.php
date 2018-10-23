<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'controllers/Login.php';

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

	public function verificarToken(){

		$retorno = '0';
		
		try{

			$token_recebido = $_POST['token'];
			$decodedToken = AUTHORIZATION::validateToken($token_recebido);
			
			if ($decodedToken != false) {

				$retorno = '1';

			}

		}catch(Exception $e){
			
			$retorno = '0';

		}

		echo $retorno;
		
      
	}

	function viewNaoLogado(){
		$this->load->view("estabelecimentos/view_naologado");
	}

	function viewLogado(){

		$this->load->model("estabelecimentos_model");
		$lista = $this->estabelecimentos_model->buscaTodos();
		$dados = array("estabelecimentos" => $lista);
		$this->load->view('estabelecimentos/view_logado', $dados);

	}

}

?>