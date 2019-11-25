<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DadosFinanceiros extends CI_Model {   

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function inserir($ip, $ativosAnoAnteriorMenosUm, $passivosAnoAnteriorMenosUm, $dreAnoAnteriorMenosUm, 
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

                $log = array('ip_cliente' => $ip, 'operacao' => 'insert', 'usuario' => null, 'id_afetado' => $ativosAnoAnterior['BATIV_EMP_ID']. ": ". $ativosAnoAnterior['BATIV_ANO_ID'], 'tabela_afetada' => 'balanco_ativos; balanco_passivos, demonstracao_resultado');

                $this->db->insert('logs', $log);
              
                $this->db->close();
                return true;
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

    public function possuiDoisOuMaisRegistros($empId){
        try{ 
            $sql = "SELECT 1
            FROM empresa emp
            JOIN balanco_ativos atv ON atv.bativ_emp_id = emp.emp_id
            WHERE 
            emp.emp_id = ? AND
            (SELECT count(bativ_ano_id) FROM balanco_ativos WHERE bativ_emp_id = emp.emp_id) >= 2
            LIMIT 1";
            $consulta = $this->db->query($sql, array($empId));
    
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

    public function inserirCadastroUnico($ip, $ativosAnoAnterior, $passivosAnoAnterior, $dreAnoAnterior){
        try{ 
            $this->db->trans_begin();

            $this->db->insert('balanco_ativos', $ativosAnoAnterior);
            $this->db->insert('balanco_passivos', $passivosAnoAnterior);
            $this->db->insert('demonstracao_resultado', $dreAnoAnterior);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }
            else{
                $this->db->trans_commit();
                
                $log = array('ip_cliente' => $ip, 'operacao' => 'insert', 'usuario' => null, 'id_afetado' => $dreAnoAnterior['DRES_ANO_ID'] , 'tabela_afetada' => 'balanco_ativos, balanco_passivos, demonstracao_resultado');

                $this->db->insert('logs', $log);
              
                $this->db->close();
            
                return true;
            }
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false; 
        }
    }

    public function ativosPassivosDresUltimoAno($emp){
        try{
            $sql = "SELECT 
            BATIV_ATIVO_CIRCULANTE, BATIV_ESTOQUE, BATIV_ATIVO_RLP, BATIV_INVESTIMENTOS, BATIV_IMOB_INTANGIVEL, 
            BATIV_ATIVO_TOTAL, BATIV_ATIVO_NAO_CIRCULANTE, BATIV_CAIXA_EQUIV_CAIXA, BATIV_CLIENTES, BATIV_OUTROS_ATIVOS_CIRCULANTES,
            BPAS_PASSIVO_CIRCULANTE, BPAS_PASSIVO_N_CIRCULANTE, BPAS_PATRIMONIO_LIQUIDO, BPAS_PASSIVO_TOTAL, BPAS_FORNECEDORES, 
            BPAS_OUTROS_PASSIVOS_CIRCULANTES, DRES_RECEITA_LIQUIDA_VENDAS, DRES_CUSTO_VENDAS, DRES_DESPESAS_OPERACIONAIS, 
            DRES_OUTRAS_RECEITAS_OP, DRES_DESPESAS_FINANCEIRAS, DRES_RECEITAS_FINANCEIRAS, DRES_OUTRAS_DESPESAS, DRES_IRPJ_CSLL, 
            DRES_CONTRIBUICOES_PARTICIP, DRES_LUCRO_BRUTO, DRES_RESULT_OPERACIONAL, DRES_RESULT_ANTES_IRPJ_CSLL, 
            DRES_RESULT_ANTES_CONT_PART, DRES_RESULT_LIQUIDO_EXERCICIO, DRES_ANO_ID
            from balanco_ativos
            join balanco_passivos on bpas_id = bativ_id
            join demonstracao_resultado dre on dre.dres_id = bpas_id
            where dre.dres_ano_id = (select max(dres_ano_id) from demonstracao_resultado where dres_emp_id = dre.dres_emp_id) and dre.dres_emp_id = ?";
            
            $consulta = $this->db->query($sql, array($emp));
            
            return $consulta->result(); //result_array
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false; 

        }
    }

    public function ativosPassivosDresAnoMenosUm($emp){
        try{
            $sql = "SELECT 
            BATIV_ATIVO_CIRCULANTE, BATIV_ESTOQUE, BATIV_ATIVO_RLP, BATIV_INVESTIMENTOS, BATIV_IMOB_INTANGIVEL, 
            BATIV_ATIVO_TOTAL, BATIV_ATIVO_NAO_CIRCULANTE, BATIV_CAIXA_EQUIV_CAIXA, BATIV_CLIENTES, BATIV_OUTROS_ATIVOS_CIRCULANTES,
            BPAS_PASSIVO_CIRCULANTE, BPAS_PASSIVO_N_CIRCULANTE, BPAS_PATRIMONIO_LIQUIDO, BPAS_PASSIVO_TOTAL, BPAS_FORNECEDORES, 
            BPAS_OUTROS_PASSIVOS_CIRCULANTES, DRES_RECEITA_LIQUIDA_VENDAS, DRES_CUSTO_VENDAS, DRES_DESPESAS_OPERACIONAIS, 
            DRES_OUTRAS_RECEITAS_OP, DRES_DESPESAS_FINANCEIRAS, DRES_RECEITAS_FINANCEIRAS, DRES_OUTRAS_DESPESAS, DRES_IRPJ_CSLL, 
            DRES_CONTRIBUICOES_PARTICIP, DRES_LUCRO_BRUTO, DRES_RESULT_OPERACIONAL, DRES_RESULT_ANTES_IRPJ_CSLL, 
            DRES_RESULT_ANTES_CONT_PART, DRES_RESULT_LIQUIDO_EXERCICIO, DRES_ANO_ID
            from balanco_ativos
            join balanco_passivos on bpas_id = bativ_id
            join demonstracao_resultado dre on dre.dres_id = bpas_id
            where dre.dres_ano_id = (select max(dres_ano_id) from demonstracao_resultado where dres_emp_id = dre.dres_emp_id)-1 and dre.dres_emp_id = ?";
            
            $consulta = $this->db->query($sql, array($emp));
            
            return $consulta->result(); //result_array
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false; 

        }
    }

    public function atualizarDadosFinanceiros($ip, $ativosAnoAnterior, $passivosAnoAnterior, $dreAnoAnterior, $indicesAnoAnterior, $indicesSomenteAnoAnterior){
        try{ 
            $this->db->trans_begin();

            $this->db->where('bativ_emp_id', $ativosAnoAnterior['BATIV_EMP_ID']);
            $this->db->where('bativ_ano_id', $ativosAnoAnterior['BATIV_ANO_ID']);
            $this->db->update('balanco_ativos', $ativosAnoAnterior);

            $this->db->where('bpas_emp_id', $passivosAnoAnterior['BPAS_EMP_ID']);
            $this->db->where('bpas_ano_id', $passivosAnoAnterior['BPAS_ANO_ID']);
            $this->db->update('balanco_passivos', $passivosAnoAnterior);

            $this->db->where('dres_emp_id', $dreAnoAnterior['DRES_EMP_ID']);
            $this->db->where('dres_ano_id', $dreAnoAnterior['DRES_ANO_ID']);
            $this->db->update('demonstracao_resultado', $dreAnoAnterior);

            $this->db->where('comp_emp_id', $indicesAnoAnterior['COMP_EMP_ID']);
            $this->db->where('comp_ano_id', $indicesAnoAnterior['COMP_ANO_ID']);
            $this->db->update('comparativos', $indicesAnoAnterior);

            $this->db->where('compant_emp_id', $indicesSomenteAnoAnterior['COMPANT_EMP_ID']);
            $this->db->where('compant_ano_id', $indicesSomenteAnoAnterior['COMPANT_ANO_ID']);
            $this->db->update('comparativos_ano_anterior', $indicesSomenteAnoAnterior);

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }
            else{
               
                $this->db->trans_commit();
                
                $log = array('ip_cliente' => $ip, 'operacao' => 'update', 'usuario' => null, 'id_afetado' => $dreAnoAnterior['DRES_ANO_ID'] , 'tabela_afetada' => 'balanco_ativos, balanco_passivos, demonstracao_resultado, comparativos, comparativos_ano_anterior');

                $this->db->insert('logs', $log);
              
                $this->db->close();
            
                return true;
            }
        }catch(PDOException $e){
            log_message('error', "Código: " . $e->getCode() . " -> " . $e->getMessage());
            return false; 
        }
    }

}