<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaCliente extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function adicionarEmpresaCliente($empresa, $ip){
		$this->db->insert('empresa', $empresa);
		$log = array('ip_cliente' => $ip, 'operacao' => 'insert', 'usuario' => $this->session->userdata('usuario'), 'id_afetado' => $empresa['nomeFantasia'], 'tabela_afetada' => 'empresa');
		$this->db->insert('logs', $log);
		return true;
	}

	public function removerEmpresaCliente($empresa){

	}

	public function atualizarEmpresaCliente($empresa, $dados){
		
	}

	public function listaEmpresaCliente($empresa){
		
	}
}