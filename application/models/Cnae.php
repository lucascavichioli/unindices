<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cnae extends CI_Model {   
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get(){
        $consulta = $this->db->query("SELECT * FROM cnae");
        
        return $consulta->result();
    }
}