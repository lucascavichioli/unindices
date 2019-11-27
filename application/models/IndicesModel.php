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

    public function listaDeIndicesDoMesmoGrupo($emp, $ano, $cnae, $uf, $m1, $m2, $comp){
        try{      
            
            $this->db->select('round('.$comp.', 2) as ' . $comp);
            $this->db->from('comparativos');
            $this->db->join('empresa', 'comp_emp_id = emp_id');
            $this->db->where('comp_emp_id !=', $emp);
            $this->db->where('comp_ano_id', $ano);
            $this->db->like('emp_cnae', $cnae, 'after');
            $this->db->where('emp_qtd_emp >=', $m1);
            $this->db->where('emp_qtd_emp <=', $m2);
            $this->db->where('emp_uf', $uf);

            $consulta = $this->db->get();

            return $consulta->result();
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }

    public function listaDeIndicesDoMesmoGrupoAnoAnterior($emp, $ano, $cnae, $uf, $m1, $m2, $comp){
        try{      
            
            $this->db->select('round('.$comp.', 2) as ' . $comp);
            $this->db->from('comparativos_ano_anterior');
            $this->db->join('empresa', 'compant_emp_id = emp_id');
            $this->db->where('compant_emp_id !=', $emp);
            $this->db->where('compant_ano_id', $ano);
            $this->db->like('emp_cnae', $cnae, 'after');
            $this->db->where('emp_qtd_emp >=', $m1);
            $this->db->where('emp_qtd_emp <=', $m2);
            $this->db->where('emp_uf', $uf);

            $consulta = $this->db->get();

            return $consulta->result();
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }

    public function listaIndices($empId){
        try{         
            $select = 'SELECT COMP_ID, round(COMP_LI,2) AS LI, round(COMP_LC,2) AS LC, round(COMP_LS,2) AS LS, round(COMP_LG,2) AS LG, 
            round(COMP_EG,2) AS EG, round(COMP_GE,2) AS GE, round(COMP_CE,2) AS CE, round(COMP_GI,2) AS GI, round(COMP_IRNC,2) AS IRNC, round(COMP_MAF,2) AS MAF, 
            round(COMP_MB,2) AS MB, round(COMP_MO,2) AS MO, round(COMP_ML,2) AS ML, COMP_ANO_ID FROM comparativos
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
            $select = 'SELECT COMPANT_ID, round(COMPANT_PMC,2) AS PMC, round(COMPANT_PME,2) AS PME, round(COMPANT_PMP,2) AS PMP, round(COMPANT_CO,2) AS CO,
            round(COMPANT_CF,2) AS CF, round(COMPANT_GA,2) AS GA, round(COMPANT_RSA,2) AS RSA, round(COMPANT_RSPL,2) AS RSPL, COMPANT_ANO_ID FROM comparativos_ano_anterior
            WHERE COMPANT_EMP_ID = ?
            ORDER BY COMPANT_ANO_ID ASC';
    
            $consulta = $this->db->query($select, array($empId));

            return $consulta->result();

        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }
    
    public function inserirIndicesAnoUnico($indicesAnoAnterior){
        try{ 
            $this->db->trans_begin();

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
}