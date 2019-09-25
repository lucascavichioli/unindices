<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitaws extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }


    public function inserir($objCnpj){
        //$this->db->db_debug = false;
        try{
          $this->db->insert('receitaws', $objCnpj);
          $this->db->close();
          return true;
        }catch(PDOException $e){
          log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
          return false;
        }
    }
}