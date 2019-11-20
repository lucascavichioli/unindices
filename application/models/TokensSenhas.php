<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TokensSenhas extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get($token){
        $this->db->select('token, data_solicitacao, email');
        $consulta = $this->db->get_where('tokens_senhas', array( 'token'  => $token ));
        
        return $consulta->result();
    }

    public function inserir($token, $email){
        try{
            
            $this->db->trans_begin();

            $this->db->set('token', $token);
            $this->db->set('email', $email);
            $this->db->insert('tokens_senhas');
        
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
                return true;
            }
        
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }
}