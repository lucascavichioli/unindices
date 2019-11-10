<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cnae extends CI_Model {   
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get($codigo){
        $this->db->select('*');
        $this->db->from('cnae');
        $this->db->like('codigo_cnae', $codigo, 'after');
        $this->db->or_like('desc_cnae', $codigo);
        $consulta = $this->db->get();
        
        return $consulta->result();
    }
}