<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comparativos extends CI_Model {   
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function inserirIndices($indicesAnoAnteriorMenosUm, $indicesAnoAnterior){
        try{ 
            $this->db->trans_begin();

            $this->db->insert('comparativos', $indicesAnoAnteriorMenosUm);
            $this->db->insert('comparativos', $indicesAnoAnterior);
        
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
            }
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }

    public function inserirSomenteIndicesAnoAnterior($indicesSomenteAnoAnterior){
        try{ 
            $this->db->trans_begin();

            $this->db->insert('comparativos_ano_anterior', $indicesSomenteAnoAnterior);
        
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
            }
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }

}