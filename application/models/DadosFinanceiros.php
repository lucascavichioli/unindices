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

}