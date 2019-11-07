<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BalancoPatrimonial extends CI_Controller {

    public function index(){
		if(!empty($this->session->userdata('usuario'))){
			redirect(base_url() . "balancopatrimonial/relatorio");
		}else{
			$this->load->view('login');
		}
    }
    
    public function relatorio($empId){
		if(empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/login");
		}
		$id = base64_decode($empId);

		$this->load->model('EmpresaClienteModel');
		$empresa = $this->EmpresaClienteModel->listaEmpresasDeUmUsuario($this->session->userdata('cont_id'), $id);

		//Se a empresa não pertence a contabilidade, volta para a dashboard
		if(empty($empresa)){
			redirect(base_url() . "painel/dashboard");
		}else{
			$this->load->model('BalancoPatrimonialModel');
			$relatorio = $this->BalancoPatrimonialModel->listar($id);
			$anos = $this->BalancoPatrimonialModel->listarAnosComRegistro($id);
			
			//$rel = array();
			
			foreach($relatorio as $ano => $array) {
				$relatorio[$ano] = $array;
				foreach($array as $chave => $valor) {
					if($valor < 0){
						$relatorio[$ano][$chave] = "(" .str_replace('-', '', (string)number_format($valor,2,',','.')) . ")";
					}else{
						$relatorio[$ano][$chave] = number_format($valor,2,',','.');
					}
				}
			}

			// print "<pre>";
			// print_r($rel); 
			// print "</pre>";exit();

			$data['anos'] = $anos;
			$data['balanco'] = $relatorio;
			$data['tituloGrafico'] = "BALANÇO PATRIMONIAL";
			$data['title'] = "Balanço Patrimonial";
			$this->dashboard->show('relatorio-balanco-patrimonial', $data);	
		}
    }
}