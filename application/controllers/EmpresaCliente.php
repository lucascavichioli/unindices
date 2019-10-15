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
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
			$id = base64_decode($id);
			$data['title'] = "Cadastro dos dados financeiros";
			$data['id'] = $id;
			$data['cont_id'] = $this->session->userdata('cont_id');
			$this->dashboard->show('adicionar-dados-financeiros', $data);
		}else{
			
			$balancoAnoAnteriorMenosUm['BATIV_EMP_ID'] 	  = $this->input->post('empId', true);
			$balancoAnoAnteriorMenosUm['BATIV_CLIENTES']  = $this->input->post('clientes', true);
			$balancoAnoAnteriorMenosUm['BATIV_ESTOQUE']   =  $this->input->post('estoque', true);
			$balancoAnoAnteriorMenosUm['BATIV_ANO_ID']    = $this->input->post('anoAnteriorMenosUm', true);


			$this->load->helper('FormataValores');

			formataValores(); //retunr array 



			

			$this->load->model('DadosFinanceiros');
			$this->BalancoAtivos->inserir($balancoAtivosAnoAnteriorMenosUm, $balancoPassivosAnoAnteriorMenosUm, $dreAnoAnteriorMenosUm, 
										  $balancoAtivosAnoAnterior, $balancoPassivosAnoAnterior, $dreAnoAnterior);
			
			
			var_dump($_POST);
		}
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
