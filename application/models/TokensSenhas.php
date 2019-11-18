<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TokensSenhas extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get($token){
        $this->db->select('token, data_solicitacao');
        $consulta = $this->db->get_where('tokens_senhas', array( 'token'  => $token ));
        
        return $consulta->result();
    }

    public function inserir(){

    }
}