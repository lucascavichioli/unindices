<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	public function index()
	{
		$user = $this->input->post("usuario");
		$senha = $this->input->post("pass");
		if($user == 'lucas@lucas.com' && $senha == 123){
			$this->load->view('painel-de-controle');
		}else{
			$this->load->view('login');
		}
		
	}
}
