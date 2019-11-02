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
                return true;
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
                return true;
            }
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }

    public function listaDeIndicesDoMesmoGrupo($emp, $ano, $cnae, $m1, $m2, $comp){
        try{      
            
            $this->db->select($comp);
            $this->db->from('comparativos');
            $this->db->join('empresa', 'comp_emp_id = emp_id');
            $this->db->where('comp_emp_id !=', $emp);
            $this->db->where('comp_ano_id', $ano);
            $this->db->like('emp_cnae', $cnae, 'after');
            $this->db->where('emp_qtd_emp >=', $m1);
            $this->db->where('emp_qtd_emp <=', $m2);

            $consulta = $this->db->get();

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
    
    public function listaIndicesAnoAnterior($empId){
        try{         
            $select = 'SELECT COMPANT_ID, COMPANT_PMC, COMPANT_PME, COMPANT_PMP, COMPANT_CO,
            COMPANT_CF, COMPANT_GA, COMPANT_RSA, COMPANT_RSPL, COMPANT_ANO_ID FROM comparativos_ano_anterior
            WHERE COMPANT_EMP_ID = ?
            ORDER BY COMPANT_ANO_ID ASC';
    
            $consulta = $this->db->query($select, array($empId));

            return $consulta->result();

        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }   
}