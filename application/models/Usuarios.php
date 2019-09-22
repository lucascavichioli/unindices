<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function teste(){
        return $this->db->get("anos")->result_array();
    }

}