<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaCliente extends CI_Controller {

	public function index(){
		if(!empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/dashboard");
		}else{
			$this->load->view('login');
		}
	}

	public function cadastrarDadosFinanceiros($id=null){
		$id = base64_decode($id);
		$data['id'] = $id;
		$data['cont_id'] = $this->session->userdata('cont_id');
		$this->load->view('adicionar-dados-financeiros', $data);
	}

	public function cadastrarDre($id){
		
	}

	public function listarIndicesEconomicos(){

	}

	public function listarBalanco(){

	}

	public function listarDre(){

	}

	public function gerarQuartil(){
		
	}

}
