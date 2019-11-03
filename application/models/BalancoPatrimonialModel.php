<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BalancoPatrimonialModel extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function inserir(){
        
    }

    public function atualizar(){

    }

    public function listar($emp){
        try{
            $this->db->select("BATIV_CAIXA_EQUIV_CAIXA as 'Caixa equivalente de caixa', 
            BATIV_CLIENTES as 'Clientes',
            BATIV_ESTOQUE as 'Estoque',
            BATIV_ATIVO_CIRCULANTE as 'Ativo circulante',
            BATIV_OUTROS_ATIVOS_CIRCULANTES as 'Outros ativos circulantes',
            BATIV_ATIVO_NAO_CIRCULANTE as 'Ativo não circulante',
            BATIV_ATIVO_RLP as 'Ativo realizável a longo prazo',
            BATIV_INVESTIMENTOS as 'Investimentos',
            BATIV_IMOB_INTANGIVEL as 'Imobilizado e Intangível',
            BATIV_ATIVO_TOTAL as '<strong>Ativo total</strong>'");
            $this->db->from('empresa');
            $this->db->join('balanco_ativos', 'bativ_emp_id = emp_id');
            $this->db->join('balanco_passivos', 'bpas_id = bativ_id');
            $this->db->join('demonstracao_resultado', 'dres_id = bpas_id');
            $this->db->where('emp_id', $emp);
            $this->db->order_by('bativ_ano_id', 'ASC');

            $consulta = $this->db->get();

            return $consulta->result();


        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false; 
        }
    }

    public function listarAnosComRegistro($emp){
        try{
            $this->db->select("BATIV_ANO_ID");
            $this->db->from('empresa');
            $this->db->join('balanco_ativos', 'bativ_emp_id = emp_id');
            $this->db->join('balanco_passivos', 'bpas_id = bativ_id');
            $this->db->join('demonstracao_resultado', 'dres_id = bpas_id');
            $this->db->where('emp_id', $emp);
            $this->db->order_by('bativ_ano_id', 'ASC');

            $consulta = $this->db->get();

            return $consulta->result();


        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false; 
        }
    }

    public function excluir(){

    }

}