<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	public function index()
	{
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
			$this->load->view('login');
	}else{
		$usuario = $this->input->post("usuario", true);
		$senha = $this->input->post("pass", true);

		$this->load->model("usuarios");
			if($this->usuarios->getUser($usuario, $senha)){
				$this->load->library('session');
				
				$this->load->view('painel-de-controle');
			}else{
				$data['alert'] = "alert-validate"; 
				$data['mensagem'] = "Usuário ou senha incorretos";
				$this->load->view('login', $data);
			}
		}
	}
}