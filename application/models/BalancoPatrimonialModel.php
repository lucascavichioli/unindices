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
            BATIV_ATIVO_TOTAL as '<strong>Ativo Total</strong>',
            BPAS_FORNECEDORES as 'Fornecedores',
            BPAS_PASSIVO_CIRCULANTE as 'Passivo Circulante',
            BPAS_OUTROS_PASSIVOS_CIRCULANTES as 'Outros passivos circulantes',
            BPAS_PASSIVO_N_CIRCULANTE as 'Passivo não circulante',
            BPAS_PASSIVO_TOTAL as '<strong>Passivo Total</strong>',
            BPAS_PATRIMONIO_LIQUIDO as '<strong>Patrimônio Líquido</strong>',
            DRES_RECEITA_LIQUIDA_VENDAS as 'Receita Líquida de vendas',
            DRES_CUSTO_VENDAS as 'Custo das vendas',
            DRES_LUCRO_BRUTO as '<strong>Lucro bruto</strong>',            
            DRES_DESPESAS_OPERACIONAIS as 'Despesas operacionais (exceto financeiras)',
            DRES_OUTRAS_RECEITAS_OP as 'Outras receitas operacionais (exceto financeiras)',
            DRES_RESULT_OPERACIONAL as '<strong>Resultado Operacional</strong>',       
            DRES_DESPESAS_FINANCEIRAS as 'Despesas financeiras',
            DRES_RECEITAS_FINANCEIRAS as 'Receitas financeiras',
            DRES_OUTRAS_DESPESAS as 'Outras despesas',
            DRES_RESULT_ANTES_IRPJ_CSLL as '<strong>Resultado antes do IRPJ e CSLL</strong>',
            DRES_IRPJ_CSLL as 'IRPJ e CSLL',
            DRES_RESULT_ANTES_CONT_PART as '<strong>Resultado antes das contribuições e participações</strong>',
            DRES_CONTRIBUICOES_PARTICIP as 'Contribuições e participações',
            DRES_RESULT_LIQUIDO_EXERCICIO as '<strong>Resultado líquido do exercício</strong>'");
            $this->db->from('empresa');
            $this->db->join('balanco_ativos', 'bativ_emp_id = emp_id');
            $this->db->join('balanco_passivos', 'bpas_id = bativ_id');
            $this->db->join('demonstracao_resultado', 'dres_id = bpas_id');
            $this->db->where('emp_id', $emp);
            $this->db->order_by('bativ_ano_id', 'DESC');

            $consulta = $this->db->get();

            return $consulta->result_array();


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
            $this->db->order_by('bativ_ano_id', 'DESC');

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