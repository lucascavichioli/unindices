<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaCliente extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function adicionarEmpresaCliente($empresa){

	}

	public function removerEmpresaCliente($empresa){

	}

	public function atualizarEmpresaCliente($empresa, $dados){
		
	}

	public function listaEmpresaCliente($empresa){
		
	}
}