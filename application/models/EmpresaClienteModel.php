<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaClienteModel extends CI_Model {   

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

	public function listaEmpresasDeUmUsuario($contId, $empId){
		$sql = "SELECT emp_id, emp_nome, cont_nome, cont_id FROM empresa INNER JOIN usuarios ON cont_id = emp_cont_id WHERE emp_cont_id = ? AND emp_id = ?";
		$consulta = $this->db->query($sql, array($contId, $empId));

		return $consulta->result();
	}

	public function listaIndicesEmpresaCliente($empId){
		$sql = "SELECT comp_li FROM comparativos WHERE comp_emp_id = ?";
		$consulta = $this->db->query($sql, array($empId));

		return $consulta->result();
	}

	public function listaCnaeEstadoQtdEmp($empId){
		$this->db->select('emp_nome, emp_cnae, emp_uf, emp_qtd_emp');
        $consulta = $this->db->get_where('empresa', array( 'emp_id'  => $empId ));
		
        return $consulta->result();
	}
}