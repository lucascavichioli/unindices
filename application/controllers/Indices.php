<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indices extends CI_Controller {
    
    public function index(){
		if(!empty($this->session->userdata('usuario'))){
			redirect(base_url() . "indices/relatorio");
		}else{
			$this->load->view('login');
		}
	}

    public function relatorio($empId){
        $data['title'] = "Índices";
        $this->dashboard->show('relatorio-indices', $data);
    }
}   