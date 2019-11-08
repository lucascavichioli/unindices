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
            $select = 'SELECT COMP_ID, COMP_LI AS LI, COMP_LC AS LC, COMP_LS AS LS, COMP_LG AS LG, 
            COMP_EG AS EG, COMP_GE AS GE, COMP_CE AS CE, COMP_GI AS GI, COMP_IRNC AS IRNC, COMP_MAF AS MAF, 
            COMP_MB AS MB, COMP_MO AS MO, COMP_ML AS ML, COMP_ANO_ID FROM comparativos
            WHERE COMP_EMP_ID = ?
            ORDER BY COMP_ANO_ID DESC';
    
            $consulta = $this->db->query($select, array($empId));

            return $consulta->result();

        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    } 
    
    public function listaIndicesAnoAnterior($empId){
        try{         
            $select = 'SELECT COMPANT_ID, COMPANT_PMC AS PMC, COMPANT_PME AS PME, COMPANT_PMP AS PMP, COMPANT_CO AS CO,
            COMPANT_CF AS CF, COMPANT_GA AS GA, COMPANT_RSA AS RSA, COMPANT_RSPL AS RSPL, COMPANT_ANO_ID FROM comparativos_ano_anterior
            WHERE COMPANT_EMP_ID = ?
            ORDER BY COMPANT_ANO_ID DESC';
    
            $consulta = $this->db->query($select, array($empId));

            return $consulta->result();

        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false;
        }
    }         
}