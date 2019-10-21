<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comparativos extends CI_Model {   
    

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function inserirIndices($indicesAnoAnteriorMenosUm, $indicesAnoAnterior){
        try{
            print "<pre>";
            print_r($indicesAnoAnteriorMenosUm);
            print "</pre>";
            print "<pre>";
            print_r($indicesAnoAnterior);
            print "</pre>";
        }catch(PDOException $e){

        }
    }

    public function inserirSomenteIndicesAnoAnterior($data){
        try{
            print "<pre>";
            print_r($data);
            print "</pre>";
        }catch(PDOException $e){

        }
    }

}