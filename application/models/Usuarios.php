<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function inserirContabilidade($data, $ip){
        try{

          $contabilidade = array();

          $contabilidade['cont_nome'] = $data['nomeEmpresa'];
          $contabilidade['cont_telefone'] = $data['telefone'];
          $contabilidade['cont_telefone2'] = null;
          $contabilidade['cont_crc'] = null;
          $contabilidade['cont_email'] = $data['email'];
          $contabilidade['cont_senha'] = password_hash($data['senha'], CRYPT_BLOWFISH, ['cost' => 12]);
          $contabilidade['cont_rec_cnpj'] = $data['cnpj'];
          $contabilidade['cont_responsavel'] = $data['responsavel'];
          $contabilidade['cont_cpf'] = null;
          $contabilidade['cont_uf'] = null;
          $contabilidade['cont_logradouro'] = null;
          $contabilidade['cont_localidade'] = null;
          $contabilidade['cont_cep'] = $data['cep'];

          $this->db->insert('usuarios', $contabilidade);
          
          $log = array('ip_cliente' => $ip, 'operacao' => 'insert', 'usuario' => null, 'id_afetado' => $data['cnpj'], 'tabela_afetada' => 'receitaws; usuarios');

            $this->db->insert('logs', $log);
          
            $this->db->close();
            return true;
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }

    public function inserirContador($data, $ip){
        try{

            $contador = array();
  
            $contador['cont_nome'] = $data['nomeContador'];
            $contador['cont_telefone'] = $data['telefone'];
            $contador['cont_telefone2'] = null;
            $contador['cont_crc'] = $data['crc'];
            $contador['cont_email'] = $data['email'];
            $contador['cont_senha'] = password_hash($data['senha'], CRYPT_BLOWFISH, ['cost' => 12]);
            $contador['cont_rec_cnpj'] = null;
            $contador['cont_responsavel'] = null;
            $contador['cont_cpf'] = $data['cpf'];
            $contador['cont_uf'] = $data['uf'];
            $contador['cont_logradouro'] = $data['logradouro'];
            $contador['cont_localidade'] = $data['cidade'];
            $contador['cont_cep'] = $data['cep'];
  
  
            $this->db->insert('usuarios', $contador);
            
            $date =  date("d-m-Y H:i:s");
            
            $log = array('ip_cliente' => $ip, 'operacao' => 'insert', 'usuario' => null, 'id_afetado' => $data['cpf'], 'tabela_afetada' => 'usuarios');
  
              $this->db->insert('logs', $log);
            
              $this->db->close();
              return true;
          }catch(PDOException $e){
              log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
              return false;
          }
    }

    public function getUser($email){
        $this->db->select('cont_id, cont_rec_cnpj, cont_crc, cont_email, cont_senha');
        $consulta = $this->db->get_where('usuarios', array( 'cont_email'  => $email ));
        
        return $consulta->result();
    }

    public function alterarSenha($ip, $contId, $dados){
        try{
             $data['cont_senha'] = password_hash($dados['senha'], CRYPT_BLOWFISH, ['cost' => 12]);

             $this->db->where('cont_id', $contId);
             $this->db->update('usuarios', $data); 
             
              $log = array('ip_cliente' => $ip, 'operacao' => 'update', 'usuario' => $contId, 'id_afetado' => $contId, 'tabela_afetada' => 'usuarios');
  
              $this->db->insert('logs', $log);
            
              $this->db->close();
              return true;
          }catch(PDOException $e){
              log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
              return false;
          }

    }

    public function getDadosCadastrais($contId){
        try{ 
            $this->db->select('cont_id, cont_nome, cont_telefone, cont_telefone2, cont_crc, cont_email, cont_rec_cnpj, cont_responsavel');
            $consulta = $this->db->get_where('usuarios', array( 'cont_id'  => $contId));
            
            return $consulta->result();
         }catch(PDOException $e){
             log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
             return false;
         }
    }

    public function atualizarDadosCadastrais($ip, $contId, $data){
        try{ 
            $this->db->where('cont_id', $contId);
			$this->db->update('usuarios', $data); 
			
			$log = array('ip_cliente' => $ip, 'operacao' => 'update', 'usuario' => $this->session->userdata('usuario'), 'id_afetado' => $contId, 'tabela_afetada' => 'usuarios');

			$this->db->insert('logs', $log);
			
			$this->db->close();
			return true;
         }catch(PDOException $e){
             log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
             return false;
         }
    }
}