<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaCliente extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function adicionarEmpresaCliente($empresa, $ip){
		try{
			$this->db->insert('empresa', $empresa);
			$log = array('ip_cliente' => $ip, 'operacao' => 'insert', 'usuario' => $this->session->userdata('usuario'), 'id_afetado' => $empresa['EMP_NOME'], 'tabela_afetada' => 'empresa');
			$this->db->insert('logs', $log);
			return true;
		}catch(PDOException $e){
			log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
			return false;
		}
	}

	public function removerEmpresaCliente($empresa){

	}

	public function atualizarEmpresaCliente($empresa, $dados){
		
	}

	public function listaEmpresaCliente($contId){
		$this->db->select('emp_id, emp_cont_id, emp_nome, emp_cnae, emp_cnae_secundario, emp_uf, emp_qtd_emp');
        $consulta = $this->db->get_where('empresa', array( 'emp_cont_id'  => $contId ));
        
        return $consulta->result();
	}
}