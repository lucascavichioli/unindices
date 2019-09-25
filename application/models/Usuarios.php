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

          $this->db->insert('usuarios', $contabilidade);
          
          $date =  date("d-m-Y H:i:s");
          
          $log = array('ip_cliente' => $ip, 'operacao' => 'insert', 'usuario' => null, 'id_afetado' => $data['cnpj'], 'tabela_afetada' => 'receitaws; usuarios');

            $this->db->insert('logs', $log);
          
            $this->db->close();
            return true;
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }
}