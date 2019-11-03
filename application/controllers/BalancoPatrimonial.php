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

        $data['title'] = "Balanço Patrimonial";
        $this->dashboard->show('relatorio-balanco-patrimonial', $data);
    }

}