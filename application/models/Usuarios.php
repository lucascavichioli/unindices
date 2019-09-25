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
          $contabilidade['cont_senha'] = $data['senha'];
          $contabilidade['cont_rec_cnpj'] = $data['cnpj'];
          $contabilidade['cont_responsavel'] = $data['responsavel'];

          $this->db->insert('usuarios', $contabilidade);
          
            $log = array('ip_cliente' => $ip, 'operacao' => 'insert', 'data' => time(), 'usuario' => null, 'id_afetado' => $data['cnpj']);

            $this->db->insert('logs', $log);
          
            $this->db->close();
            return true;
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }




        //return $this->db->get("anos")->result_array();
    }

}