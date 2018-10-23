<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function autenticar()	{

        $this->load->model("usuarios_model");
        $email = $this->input->post("email");
        $senha = $this->input->post("senha");
        $usuario = $this->usuarios_model->login_usuario($email, $senha);
        $sucesso = false;

        if($usuario){

            $tokenData = array();
            $tokenData['id'] = $usuario; //TODO: Replace with data for token
            $output['token'] = AUTHORIZATION::generateToken($tokenData);

            //$this->session->set_userdata("usuario_logado", true);
            //$this->session->set_userdata("json_token", $output['token']);
            //$this->session->set_flashdata("success", "Logado com sucesso");

            //Decodificar em PHP
            //$retorna = AUTHORIZATION::validateToken($output['token']);
        
            //Decodificar em STRING
            //$status = JWT::urlsafeB64Decode($output['token']);
            //$infor = json_encode($status);

            $sucesso = true;
        
        }

        if($sucesso){
            echo $output['token'];
        }else{
            echo '0';
        }

        
        //redirect('/');

    }
    
    public function logout(){

        $this->session->unset_userdata("json_token");
        $this->session->unset_userdata("usuario_logado");
        $this->session->set_flashdata("success", "Deslogado com sucesso");
        redirect('/');

    }

}