<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anos extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getAnoAnteriorMenosUm(){
        $consulta = $this->db->query("SELECT ano_id, ano_ref FROM anos where (select max(ano_id)-1 from anos) = ano_id");
        
        return $consulta->result(); //result_array
    }

    public function getAnoAnterior(){
        $consulta = $this->db->query("SELECT ano_id, ano_ref FROM anos where (select max(ano_id) from anos) = ano_id");
        
        return $consulta->result(); //result_array
    }
}