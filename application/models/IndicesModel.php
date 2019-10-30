<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndicesModel extends CI_Model {   
    
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

    public function listaDeIndicesDoMesmoGrupo($emp, $ano, $cnae, $m1, $m2, $comp){
        try{         
            $select = "SELECT $comp FROM comparativos 
            INNER JOIN empresa ON COMP_EMP_ID = EMP_ID  
            WHERE COMP_EMP_ID != ? AND COMP_ANO_ID = ? AND EMP_CNAE = ? AND EMP_QTD_EMP BETWEEN ? AND ?";

            $consulta = $this->db->query($select, array($emp, $ano, $cnae, $m1, $m2));

            return $consulta->result();
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }

    public function listaIndices($empId){
        try{         
            $select = 'SELECT COMP_ID, COMP_LI, COMP_LC, COMP_LS, COMP_LG, 
            COMP_EG, COMP_GE, COMP_CE, COMP_GI, COMP_IRNC, COMP_MAF, 
            COMP_MB, COMP_MO, COMP_ML, COMP_ANO_ID FROM comparativos
            WHERE COMP_EMP_ID = ?
            ORDER BY COMP_ANO_ID ASC';
    
            $consulta = $this->db->query($select, array($empId));

            return $consulta->result();

        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }   
}