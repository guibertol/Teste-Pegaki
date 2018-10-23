<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function autenticar()	{

        $this->load->model("usuarios_model");
        $email = $this->input->post("email");
        $senha = $this->input->post("senha");

        $usuario = $this->usuarios_model->login_usuario($email, $senha);

        if($usuario){
            $this->session->set_userdata("usuario_logado", $usuario);
            $this->session->set_flashdata("success", "Logado com sucesso");
            //$infor = json_encode($status);
        }else{
            $this->session->set_flashdata("danger", "Erro ao efetuar login");
        }

        redirect('/');

    }
    
    public function logout(){

        $this->session->unset_userdata("usuario_logado");
        $this->session->set_flashdata("success", "Deslogado com sucesso");
        redirect('/');

    }

}
