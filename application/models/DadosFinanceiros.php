<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DadosFinanceiros extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function inserir($ativosAnoAnteriorMenosUm, $passivosAnoAnteriorMenosUm, $dreAnoAnteriorMenosUm, 
                            $ativosAnoAnterior, $passivosAnoAnterior, $dreAnoAnterior){
        try{ 
            $this->db->trans_begin();

            $this->db->insert('balanco_ativos', $ativosAnoAnteriorMenosUm);
            $this->db->insert('balanco_ativos', $ativosAnoAnterior);
            $this->db->insert('balanco_passivos', $passivosAnoAnteriorMenosUm);
            $this->db->insert('balanco_passivos', $passivosAnoAnterior);
            $this->db->insert('demonstracao_resultado', $dreAnoAnteriorMenosUm);
            $this->db->insert('demonstracao_resultado', $dreAnoAnterior);

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

    public function atualizar(){

    }

    public function possuiDadosDoAno($empId, $anoAnterior, $anoAnteriorMenosUm = null){
        try{ 
            $sql = "SELECT 1
            FROM balanco_ativos 
            JOIN balanco_passivos ON bpas_emp_id = bativ_emp_id AND bpas_ano_id = bativ_ano_id
            WHERE 
            bativ_emp_id = ?
            AND bativ_ano_id IN (?, ?) LIMIT 1";
            $consulta = $this->db->query($sql, array($empId, $anoAnteriorMenosUm, $anoAnterior));
    
            $array = $consulta->result();

            if(empty($array)){
                return false;
            }

            return true;
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false; 
        }
    }

}