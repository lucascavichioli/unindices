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

	public function removerEmpresaCliente($ip, $usuario, $empresa){
		try{
			$this->db->trans_begin();

			$this->db->delete('balanco_ativos', array('bativ_emp_id' => $empresa));
			$this->db->delete('balanco_passivos', array('bpas_emp_id' => $empresa));
			$this->db->delete('demonstracao_resultado', array('dres_emp_id' => $empresa));
			$this->db->delete('comparativos', array('comp_emp_id' => $empresa));
			$this->db->delete('comparativos_ano_anterior', array('compant_emp_id' => $empresa));
			$this->db->delete('empresa', array('emp_id' => $empresa));

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();

                $log = array('ip_cliente' => $ip, 'operacao' => 'delete', 'usuario' => $usuario, 'id_afetado' => $empresa, 'tabela_afetada' => 'balanco_ativos; balanco_passivos, demonstracao_resultado, comparativos, comparativos_ano_anterior, empresa');

                $this->db->insert('logs', $log);
              
                $this->db->close();
                return true;
            }
		}catch(PDOException $e){
			log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
			return false;
		}
	}

	public function atualizarEmpresaCliente($empresa, $dados, $ip){
		try{
			$this->db->where('emp_id', $empresa);
			$this->db->update('empresa', $dados); 
			
			$log = array('ip_cliente' => $ip, 'operacao' => 'update', 'usuario' => $this->session->userdata('usuario'), 'id_afetado' => $empresa, 'tabela_afetada' => 'empresa');

			$this->db->insert('logs', $log);
			
			$this->db->close();
			return true;
		}catch(PDOException $e){
			log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
			return false;
		}
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

	public function listaEmpresaClienteParaAtualizar($contId, $empId){
		$this->db->select('emp_id, emp_nome, emp_email, emp_cnae, emp_cnae_secundario, emp_qtd_emp, emp_uf, emp_telefone, emp_telefone2');
        $consulta = $this->db->get_where('empresa', array( 'emp_cont_id'  => $contId, 'emp_id' => $empId ));
		
        return $consulta->result();
	}

	public function listaQtdEmpresasDoMesmoRamo($emp, $uf, $cnae, $m1, $m2){
        try{      
            $this->db->select('emp_id');
			$this->db->distinct();
            $this->db->from('empresa');
            $this->db->join('comparativos', 'comp_emp_id = emp_id');
            $this->db->where('emp_id !=', $emp);
            $this->db->like('emp_cnae', $cnae, 'after');
            $this->db->where('emp_qtd_emp >=', $m1);
			$this->db->where('emp_qtd_emp <=', $m2);
			$this->db->where('emp_uf', $uf);

            $consulta = $this->db->get();

            return $consulta->num_rows();
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
	}
	
	public function listaEmpresasContribuintes(){
		$consulta = $this->db->query("SELECT count(distinct emp_id) as qtdEmpresas from empresa join comparativos on comp_emp_id = emp_id");
        
        return $consulta->result();
	}
}