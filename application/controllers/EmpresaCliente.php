<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaCliente extends CI_Controller {
	private $empId;
	private $anoAnteriorMenosUm;
	private $anoAnterior;

	public function index(){
		if(!empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/dashboard");
		}else{
			$this->load->view('login');
		}
	}

	public function cadastrarDadosFinanceiros($id=null){
		if(empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/login");
		}else{
				if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
					$this->load->model('Anos');
					$anoAnteriorMenosUm = $this->Anos->getAnoAnteriorMenosUm();
					$anoAnterior = $this->Anos->getAnoAnterior();


					$id = base64_decode($id);
					$data['title'] = "Cadastro dos dados financeiros";
					$data['id'] = $id;
					$data['anoAnteriorMenosUm'] = $anoAnteriorMenosUm;
					$data['anoAnterior'] = $anoAnterior;
					
					$this->dashboard->show('adicionar-dados-financeiros', $data);
				}else{
					$this->load->model('EmpresaClienteModel');
					$empresa = $this->EmpresaClienteModel->listaEmpresasDeUmUsuario($this->session->userdata('cont_id'), $this->input->post('empId', true));

					//Se a empresa não pertence a contabilidade, volta para a dashboard
					if(empty($empresa)){
						redirect(base_url() . "painel/dashboard");
					}else{

						$this->empId 			  = $this->input->post('empId', true);
						$this->anoAnteriorMenosUm = $this->input->post('anoAnteriorMenosUm', true);
						$this->anoAnterior		  = $this->input->post('anoAnterior', true);

						//BALANÇO DOS ATIVOS (ANO ANTERIOR MENOS UM)
						$ativosAnoAnteriorMenosUm['BATIV_EMP_ID'] = $this->empId;
						$ativosAnoAnteriorMenosUm['BATIV_ANO_ID'] = $this->anoAnteriorMenosUm;
						$ativosAnoAnteriorMenosUm['BATIV_CLIENTES'] = $this->input->post('clientes', true);
						$ativosAnoAnteriorMenosUm['BATIV_ESTOQUE'] =  $this->input->post('estoques', true);
						$ativosAnoAnteriorMenosUm['BATIV_CAIXA_EQUIV_CAIXA'] = $this->input->post('caixaEquivalenteDeCaixa', true);
						$ativosAnoAnteriorMenosUm['BATIV_OUTROS_ATIVOS_CIRCULANTES'] = $this->input->post('outrosAtivosCirculantes', true);
						$ativosAnoAnteriorMenosUm['BATIV_ATIVO_RLP'] = $this->input->post('ativoRealizavelLongoPrazo', true);
						$ativosAnoAnteriorMenosUm['BATIV_IMOB_INTANGIVEL'] = $this->input->post('imobilizadoIntangivel', true);
						$ativosAnoAnteriorMenosUm['BATIV_INVESTIMENTOS'] = $this->input->post('investimentos', true);

						//BALANÇO DOS ATIVOS (ANO ANTERIOR)
						$ativosAnoAnterior['BATIV_EMP_ID'] = $this->empId;
						$ativosAnoAnterior['BATIV_ANO_ID'] = $this->anoAnterior;
						$ativosAnoAnterior['BATIV_CLIENTES'] = $this->input->post('clientes2', true);
						$ativosAnoAnterior['BATIV_ESTOQUE'] =  $this->input->post('estoques2', true);
						$ativosAnoAnterior['BATIV_CAIXA_EQUIV_CAIXA'] = $this->input->post('caixaEquivalenteDeCaixa2', true);
						$ativosAnoAnterior['BATIV_OUTROS_ATIVOS_CIRCULANTES'] = $this->input->post('outrosAtivosCirculantes2', true);
						$ativosAnoAnterior['BATIV_ATIVO_RLP'] = $this->input->post('ativoRealizavelLongoPrazo2', true);
						$ativosAnoAnterior['BATIV_IMOB_INTANGIVEL'] = $this->input->post('imobilizadoIntangivel2', true);
						$ativosAnoAnterior['BATIV_INVESTIMENTOS'] = $this->input->post('investimentos2', true);

						//VALIDA FORMULÁRIOS
						$validouAtivosAnoAnteriorMenosUm = $this->validaBalancoAtivos($ativosAnoAnteriorMenosUm);
						$validouAtivosAnoAnterior = $this->validaBalancoAtivos($ativosAnoAnterior);

						//BALANÇO DOS PASSIVOS (ANO ANTERIOR MENOS UM)
						$passivosAnoAnteriorMenosUm['BPAS_EMP_ID'] = $this->empId;
						$passivosAnoAnteriorMenosUm['BPAS_ANO_ID'] = $this->anoAnteriorMenosUm;
						$passivosAnoAnteriorMenosUm['BPAS_PASSIVO_N_CIRCULANTE'] = $this->input->post('passivoNaoCirculante', true);
						$passivosAnoAnteriorMenosUm['BPAS_FORNECEDORES'] =  $this->input->post('fornecedores', true);
						$passivosAnoAnteriorMenosUm['BPAS_PATRIMONIO_LIQUIDO'] = $this->input->post('patrimonioLiquido', true);
						$passivosAnoAnteriorMenosUm['BPAS_OUTROS_PASSIVOS_CIRCULANTES'] = $this->input->post('outrosPassivosCirculantes', true);

						//BALANÇO DOS PASSIVOS (ANO ANTERIOR)
						$passivosAnoAnterior['BPAS_EMP_ID'] = $this->empId;
						$passivosAnoAnterior['BPAS_ANO_ID'] = $this->anoAnterior;
						$passivosAnoAnterior['BPAS_PASSIVO_N_CIRCULANTE'] = $this->input->post('passivoNaoCirculante2', true);
						$passivosAnoAnterior['BPAS_FORNECEDORES'] =  $this->input->post('fornecedores2', true);
						$passivosAnoAnterior['BPAS_PATRIMONIO_LIQUIDO'] = $this->input->post('patrimonioLiquido2', true);
						$passivosAnoAnterior['BPAS_OUTROS_PASSIVOS_CIRCULANTES'] = $this->input->post('outrosPassivosCirculantes2', true);
						
						//VALIDA FORMULÁRIOS
						$validouPassivosAnoAnteriorMenosUm = $this->validaBalancoPassivos($passivosAnoAnteriorMenosUm);
						$validouPassivosAnoAnterior = $this->validaBalancoPassivos($passivosAnoAnterior);

						// DEMONSTRAÇÃO DE RESULTADO (ANO ANTERIOR MENOS UM)
						$dreAnoAnteriorMenosUm['DRES_EMP_ID'] = $this->empId;
						$dreAnoAnteriorMenosUm['DRES_ANO_ID'] = $this->anoAnteriorMenosUm;
						$dreAnoAnteriorMenosUm['DRES_RECEITA_LIQUIDA_VENDAS'] = $this->input->post('receitaLiquidaVendas', true);
						$dreAnoAnteriorMenosUm['DRES_CUSTO_VENDAS'] =  $this->input->post('custoVendas', true);
						$dreAnoAnteriorMenosUm['DRES_DESPESAS_OPERACIONAIS'] = $this->input->post('despesasOperacionais', true);
						$dreAnoAnteriorMenosUm['DRES_OUTRAS_RECEITAS_OP'] = $this->input->post('outrasReceitasOperacionais', true);
						$dreAnoAnteriorMenosUm['DRES_DESPESAS_FINANCEIRAS'] = $this->input->post('despesasFinanceiras', true);
						$dreAnoAnteriorMenosUm['DRES_RECEITAS_FINANCEIRAS'] = $this->input->post('receitasFinanceiras', true);
						$dreAnoAnteriorMenosUm['DRES_OUTRAS_DESPESAS'] = $this->input->post('outrasDespesas', true);
						$dreAnoAnteriorMenosUm['DRES_IRPJ_CSLL'] = $this->input->post('irpjCsll', true);
						$dreAnoAnteriorMenosUm['DRES_CONTRIBUICOES_PARTICIP'] = $this->input->post('contribuicoesParticipacoes', true);

						// DEMONSTRAÇÃO DE RESULTADO (ANO ANTERIOR)
						$dreAnoAnterior['DRES_EMP_ID'] = $this->empId;
						$dreAnoAnterior['DRES_ANO_ID'] = $this->anoAnterior;
						$dreAnoAnterior['DRES_RECEITA_LIQUIDA_VENDAS'] = $this->input->post('receitaLiquidaVendas2', true);
						$dreAnoAnterior['DRES_CUSTO_VENDAS'] =  $this->input->post('custoVendas2', true);
						$dreAnoAnterior['DRES_DESPESAS_OPERACIONAIS'] = $this->input->post('despesasOperacionais2', true);
						$dreAnoAnterior['DRES_OUTRAS_RECEITAS_OP'] = $this->input->post('outrasReceitasOperacionais2', true);
						$dreAnoAnterior['DRES_DESPESAS_FINANCEIRAS'] = $this->input->post('despesasFinanceiras2', true);
						$dreAnoAnterior['DRES_RECEITAS_FINANCEIRAS'] = $this->input->post('receitasFinanceiras2', true);
						$dreAnoAnterior['DRES_OUTRAS_DESPESAS'] = $this->input->post('outrasDespesas2', true);
						$dreAnoAnterior['DRES_IRPJ_CSLL'] = $this->input->post('irpjCsll2', true);
						$dreAnoAnterior['DRES_CONTRIBUICOES_PARTICIP'] = $this->input->post('contribuicoesParticipacoes2', true);
						
						//VALIDA FORMULÁRIOS
						$validouDreAnoAnteriorMenosUm = $this->validaDre($dreAnoAnteriorMenosUm);
						$validouDreAnoAnterior = $this->validaDre($dreAnoAnterior);
					
						if($validouAtivosAnoAnteriorMenosUm && $validouAtivosAnoAnterior && $validouPassivosAnoAnteriorMenosUm
						&& $validouPassivosAnoAnterior && $validouDreAnoAnteriorMenosUm && $validouDreAnoAnterior){
							
							//carrega helper formata valores
							$this->load->helper('FormataValores');

							//formata os valores em decimais
							$ativosAnoAnteriorMenosUm   = formataValores($ativosAnoAnteriorMenosUm); //retunr array 
							$passivosAnoAnteriorMenosUm = formataValores($passivosAnoAnteriorMenosUm);
							$dreAnoAnteriorMenosUm 	    = formataValores($dreAnoAnteriorMenosUm);
							$ativosAnoAnterior 		    = formataValores($ativosAnoAnterior);
							$passivosAnoAnterior 	    = formataValores($passivosAnoAnterior);
							$dreAnoAnterior 		    = formataValores($dreAnoAnterior);

							//atribui os anos e os ids da empresa correspondente
							$ativosAnoAnteriorMenosUm['BATIV_ANO_ID']  = (int)$ativosAnoAnteriorMenosUm['BATIV_ANO_ID'];
							$passivosAnoAnteriorMenosUm['BPAS_ANO_ID'] = (int)$passivosAnoAnteriorMenosUm['BPAS_ANO_ID'];
							$dreAnoAnteriorMenosUm['DRES_ANO_ID'] 	   = (int)$dreAnoAnteriorMenosUm['DRES_ANO_ID'];	   
							$ativosAnoAnterior['BATIV_ANO_ID'] 		   = (int)$ativosAnoAnterior['BATIV_ANO_ID'];
							$passivosAnoAnterior['BPAS_ANO_ID']		   = (int)$passivosAnoAnterior['BPAS_ANO_ID'];	   
							$dreAnoAnterior['DRES_ANO_ID'] 			   = (int)$dreAnoAnterior['DRES_ANO_ID'];	  
							
							$ativosAnoAnteriorMenosUm['BATIV_EMP_ID']  = (int)$ativosAnoAnteriorMenosUm['BATIV_EMP_ID'];
							$passivosAnoAnteriorMenosUm['BPAS_EMP_ID'] = (int)$passivosAnoAnteriorMenosUm['BPAS_EMP_ID'];
							$dreAnoAnteriorMenosUm['DRES_EMP_ID'] 	   = (int)$dreAnoAnteriorMenosUm['DRES_EMP_ID'];	   
							$ativosAnoAnterior['BATIV_EMP_ID'] 		   = (int)$ativosAnoAnterior['BATIV_EMP_ID'];
							$passivosAnoAnterior['BPAS_EMP_ID']		   = (int)$passivosAnoAnterior['BPAS_EMP_ID'];	   
							$dreAnoAnterior['DRES_EMP_ID'] 			   = (int)$dreAnoAnterior['DRES_EMP_ID'];	

							//calcula contas
							$ativosAnoAnteriorMenosUm['BATIV_ATIVO_CIRCULANTE'] = ($ativosAnoAnteriorMenosUm['BATIV_CLIENTES'] + $ativosAnoAnteriorMenosUm['BATIV_ESTOQUE'] + $ativosAnoAnteriorMenosUm['BATIV_OUTROS_ATIVOS_CIRCULANTES'] + $ativosAnoAnteriorMenosUm['BATIV_CAIXA_EQUIV_CAIXA']);
							$ativosAnoAnterior['BATIV_ATIVO_CIRCULANTE'] = ($ativosAnoAnterior['BATIV_CLIENTES'] + $ativosAnoAnterior['BATIV_ESTOQUE'] + $ativosAnoAnterior['BATIV_OUTROS_ATIVOS_CIRCULANTES'] + $ativosAnoAnterior['BATIV_CAIXA_EQUIV_CAIXA']);

							$ativosAnoAnteriorMenosUm['BATIV_ATIVO_NAO_CIRCULANTE'] = ($ativosAnoAnteriorMenosUm['BATIV_ATIVO_RLP'] + $ativosAnoAnteriorMenosUm['BATIV_IMOB_INTANGIVEL'] + $ativosAnoAnteriorMenosUm['BATIV_INVESTIMENTOS']);
							$ativosAnoAnterior['BATIV_ATIVO_NAO_CIRCULANTE'] = ($ativosAnoAnterior['BATIV_ATIVO_RLP'] + $ativosAnoAnterior['BATIV_IMOB_INTANGIVEL'] + $ativosAnoAnterior['BATIV_INVESTIMENTOS']);

							$ativosAnoAnteriorMenosUm['BATIV_ATIVO_TOTAL'] = ($ativosAnoAnteriorMenosUm['BATIV_ATIVO_CIRCULANTE'] + $ativosAnoAnteriorMenosUm['BATIV_ATIVO_NAO_CIRCULANTE']);
							$ativosAnoAnterior['BATIV_ATIVO_TOTAL'] = ($ativosAnoAnterior['BATIV_ATIVO_CIRCULANTE'] + $ativosAnoAnterior['BATIV_ATIVO_NAO_CIRCULANTE']);

							$passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE'] = ($passivosAnoAnteriorMenosUm['BPAS_FORNECEDORES'] + $passivosAnoAnteriorMenosUm['BPAS_OUTROS_PASSIVOS_CIRCULANTES']);
							$passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE'] = ($passivosAnoAnterior['BPAS_FORNECEDORES'] + $passivosAnoAnterior['BPAS_OUTROS_PASSIVOS_CIRCULANTES']);
							
							$passivosAnoAnteriorMenosUm['BPAS_PASSIVO_TOTAL'] = ($passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE'] + $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_N_CIRCULANTE'] + $passivosAnoAnteriorMenosUm['BPAS_PATRIMONIO_LIQUIDO']);
							$passivosAnoAnterior['BPAS_PASSIVO_TOTAL'] = ($passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE'] + $passivosAnoAnterior['BPAS_PASSIVO_N_CIRCULANTE'] + $passivosAnoAnterior['BPAS_PATRIMONIO_LIQUIDO']);

							$dreAnoAnteriorMenosUm['DRES_LUCRO_BRUTO'] = ($dreAnoAnteriorMenosUm['DRES_RECEITA_LIQUIDA_VENDAS'] + $dreAnoAnteriorMenosUm['DRES_CUSTO_VENDAS']); 
							$dreAnoAnterior['DRES_LUCRO_BRUTO'] = ($dreAnoAnterior['DRES_RECEITA_LIQUIDA_VENDAS'] + $dreAnoAnterior['DRES_CUSTO_VENDAS']); 

							$dreAnoAnteriorMenosUm['DRES_RESULT_OPERACIONAL'] = ($dreAnoAnteriorMenosUm['DRES_LUCRO_BRUTO'] + $dreAnoAnteriorMenosUm['DRES_DESPESAS_OPERACIONAIS'] + $dreAnoAnteriorMenosUm['DRES_OUTRAS_RECEITAS_OP']);
							$dreAnoAnterior['DRES_RESULT_OPERACIONAL'] = ($dreAnoAnterior['DRES_LUCRO_BRUTO'] + $dreAnoAnterior['DRES_DESPESAS_OPERACIONAIS'] + $dreAnoAnterior['DRES_OUTRAS_RECEITAS_OP']);

							$dreAnoAnteriorMenosUm['DRES_RESULT_ANTES_IRPJ_CSLL'] = ($dreAnoAnteriorMenosUm['DRES_RESULT_OPERACIONAL'] + $dreAnoAnteriorMenosUm['DRES_DESPESAS_FINANCEIRAS'] + $dreAnoAnteriorMenosUm['DRES_RECEITAS_FINANCEIRAS'] + $dreAnoAnteriorMenosUm['DRES_OUTRAS_DESPESAS']);
							$dreAnoAnterior['DRES_RESULT_ANTES_IRPJ_CSLL'] = ($dreAnoAnterior['DRES_RESULT_OPERACIONAL'] + $dreAnoAnterior['DRES_DESPESAS_FINANCEIRAS'] + $dreAnoAnterior['DRES_RECEITAS_FINANCEIRAS'] + $dreAnoAnterior['DRES_OUTRAS_DESPESAS']);

							$dreAnoAnteriorMenosUm['DRES_RESULT_ANTES_CONT_PART'] = ($dreAnoAnteriorMenosUm['DRES_RESULT_ANTES_IRPJ_CSLL'] + $dreAnoAnteriorMenosUm['DRES_IRPJ_CSLL']);
							$dreAnoAnterior['DRES_RESULT_ANTES_CONT_PART'] = ($dreAnoAnterior['DRES_RESULT_ANTES_IRPJ_CSLL'] + $dreAnoAnterior['DRES_IRPJ_CSLL']);

							$dreAnoAnteriorMenosUm['DRES_RESULT_LIQUIDO_EXERCICIO'] = ($dreAnoAnteriorMenosUm['DRES_RESULT_ANTES_CONT_PART'] + $dreAnoAnteriorMenosUm['DRES_CONTRIBUICOES_PARTICIP']);
							$dreAnoAnterior['DRES_RESULT_LIQUIDO_EXERCICIO'] = ($dreAnoAnterior['DRES_RESULT_ANTES_CONT_PART'] + $dreAnoAnterior['DRES_CONTRIBUICOES_PARTICIP']);

							//carrega biblioteca dos índices.
							$this->load->library('indiceseconomicos');

							//índices para ano anterior menos um e ano anterior
							$indicesAnoAnteriorMenosUm['COMP_LI'] = $this->indiceseconomicos->li($ativosAnoAnteriorMenosUm['BATIV_CAIXA_EQUIV_CAIXA'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE']);
							$indicesAnoAnterior['COMP_LI'] = $this->indiceseconomicos->li($ativosAnoAnterior['BATIV_CAIXA_EQUIV_CAIXA'], $passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE']);

							$indicesAnoAnteriorMenosUm['COMP_LC'] = $this->indiceseconomicos->lc($ativosAnoAnteriorMenosUm['BATIV_ATIVO_CIRCULANTE'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE']);
							$indicesAnoAnterior['COMP_LC'] = $this->indiceseconomicos->lc($ativosAnoAnterior['BATIV_ATIVO_CIRCULANTE'], $passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE']);

							$indicesAnoAnteriorMenosUm['COMP_LS'] = $this->indiceseconomicos->ls($ativosAnoAnteriorMenosUm['BATIV_ATIVO_CIRCULANTE'], $ativosAnoAnteriorMenosUm['BATIV_ESTOQUE'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE']);
							$indicesAnoAnterior['COMP_LS'] = $this->indiceseconomicos->ls($ativosAnoAnterior['BATIV_ATIVO_CIRCULANTE'], $ativosAnoAnterior['BATIV_ESTOQUE'], $passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE']);

							$indicesAnoAnteriorMenosUm['COMP_LG'] = $this->indiceseconomicos->lg($ativosAnoAnteriorMenosUm['BATIV_ATIVO_CIRCULANTE'], $ativosAnoAnteriorMenosUm['BATIV_ATIVO_RLP'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_N_CIRCULANTE']);
							$indicesAnoAnterior['COMP_LG'] = $this->indiceseconomicos->lg($ativosAnoAnterior['BATIV_ATIVO_CIRCULANTE'], $ativosAnoAnterior['BATIV_ATIVO_RLP'], $passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE'], $passivosAnoAnterior['BPAS_PASSIVO_N_CIRCULANTE']);

							$indicesAnoAnteriorMenosUm['COMP_EG'] = $this->indiceseconomicos->eg($passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_N_CIRCULANTE'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_TOTAL']);
							$indicesAnoAnterior['COMP_EG'] = $this->indiceseconomicos->eg($passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE'], $passivosAnoAnterior['BPAS_PASSIVO_N_CIRCULANTE'], $passivosAnoAnterior['BPAS_PASSIVO_TOTAL']);

							$indicesAnoAnteriorMenosUm['COMP_GE'] = $this->indiceseconomicos->ge($passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_N_CIRCULANTE'],$passivosAnoAnteriorMenosUm['BPAS_PATRIMONIO_LIQUIDO']);
							$indicesAnoAnterior['COMP_GE'] = $this->indiceseconomicos->ge($passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE'], $passivosAnoAnterior['BPAS_PASSIVO_N_CIRCULANTE'],$passivosAnoAnterior['BPAS_PATRIMONIO_LIQUIDO']);

							$indicesAnoAnteriorMenosUm['COMP_CE'] = $this->indiceseconomicos->ce($passivosAnoAnteriorMenosUm['BPAS_PASSIVO_CIRCULANTE'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_N_CIRCULANTE']);
							$indicesAnoAnterior['COMP_CE'] = $this->indiceseconomicos->ce($passivosAnoAnterior['BPAS_PASSIVO_CIRCULANTE'], $passivosAnoAnterior['BPAS_PASSIVO_N_CIRCULANTE']);

							$indicesAnoAnteriorMenosUm['COMP_GI'] = $this->indiceseconomicos->gi($ativosAnoAnteriorMenosUm['BATIV_INVESTIMENTOS'], $ativosAnoAnteriorMenosUm['BATIV_IMOB_INTANGIVEL'], $passivosAnoAnteriorMenosUm['BPAS_PATRIMONIO_LIQUIDO']);
							$indicesAnoAnterior['COMP_GI'] = $this->indiceseconomicos->gi($ativosAnoAnterior['BATIV_INVESTIMENTOS'], $ativosAnoAnterior['BATIV_IMOB_INTANGIVEL'], $passivosAnoAnterior['BPAS_PATRIMONIO_LIQUIDO']);

							$indicesAnoAnteriorMenosUm['COMP_IRNC'] = $this->indiceseconomicos->irnc($ativosAnoAnteriorMenosUm['BATIV_INVESTIMENTOS'], $ativosAnoAnteriorMenosUm['BATIV_IMOB_INTANGIVEL'], $passivosAnoAnteriorMenosUm['BPAS_PASSIVO_N_CIRCULANTE'], $passivosAnoAnteriorMenosUm['BPAS_PATRIMONIO_LIQUIDO']);
							$indicesAnoAnterior['COMP_IRNC'] = $this->indiceseconomicos->irnc($ativosAnoAnterior['BATIV_INVESTIMENTOS'], $ativosAnoAnterior['BATIV_IMOB_INTANGIVEL'], $passivosAnoAnterior['BPAS_PASSIVO_N_CIRCULANTE'], $passivosAnoAnterior['BPAS_PATRIMONIO_LIQUIDO']);

							$indicesAnoAnteriorMenosUm['COMP_MAF'] = $this->indiceseconomicos->maf($passivosAnoAnteriorMenosUm['BPAS_PASSIVO_TOTAL'], $passivosAnoAnteriorMenosUm['BPAS_PATRIMONIO_LIQUIDO']);
							$indicesAnoAnterior['COMP_MAF'] = $this->indiceseconomicos->maf($passivosAnoAnterior['BPAS_PASSIVO_TOTAL'], $passivosAnoAnterior['BPAS_PATRIMONIO_LIQUIDO']);
							
							$indicesAnoAnteriorMenosUm['COMP_MB'] = $this->indiceseconomicos->mb($dreAnoAnteriorMenosUm['DRES_LUCRO_BRUTO'], $dreAnoAnteriorMenosUm['DRES_RECEITA_LIQUIDA_VENDAS']);
							$indicesAnoAnterior['COMP_MB'] = $this->indiceseconomicos->mb($dreAnoAnterior['DRES_LUCRO_BRUTO'], $dreAnoAnterior['DRES_RECEITA_LIQUIDA_VENDAS']);
							
							$indicesAnoAnteriorMenosUm['COMP_MO'] = $this->indiceseconomicos->mo($dreAnoAnteriorMenosUm['DRES_RESULT_OPERACIONAL'] , $dreAnoAnteriorMenosUm['DRES_RECEITA_LIQUIDA_VENDAS']);
							$indicesAnoAnterior['COMP_MO'] = $this->indiceseconomicos->mo($dreAnoAnterior['DRES_RESULT_OPERACIONAL'], $dreAnoAnterior['DRES_RECEITA_LIQUIDA_VENDAS']);

							$indicesAnoAnteriorMenosUm['COMP_ML'] = $this->indiceseconomicos->ml($dreAnoAnteriorMenosUm['DRES_RESULT_LIQUIDO_EXERCICIO'], $dreAnoAnteriorMenosUm['DRES_RECEITA_LIQUIDA_VENDAS']);
							$indicesAnoAnterior['COMP_ML'] = $this->indiceseconomicos->ml($dreAnoAnterior['DRES_RESULT_LIQUIDO_EXERCICIO'], $dreAnoAnterior['DRES_RECEITA_LIQUIDA_VENDAS']);

							$indicesAnoAnteriorMenosUm['COMP_EMP_ID'] = $this->empId;
							$indicesAnoAnteriorMenosUm['COMP_ANO_ID'] = $this->anoAnteriorMenosUm;
							$indicesAnoAnterior['COMP_EMP_ID'] = $this->empId;
							$indicesAnoAnterior['COMP_ANO_ID'] = $this->anoAnterior;


							//índices somente para ano anterior
							$indicesSomenteAnoAnterior['COMPANT_PMC'] = $this->indiceseconomicos->pmc($ativosAnoAnteriorMenosUm['BATIV_CLIENTES'], $ativosAnoAnterior['BATIV_CLIENTES'], $dreAnoAnterior['DRES_RECEITA_LIQUIDA_VENDAS']);
							$indicesSomenteAnoAnterior['COMPANT_PME'] = $this->indiceseconomicos->pme($ativosAnoAnteriorMenosUm['BATIV_ESTOQUE'], $ativosAnoAnterior['BATIV_ESTOQUE'], $dreAnoAnterior['DRES_CUSTO_VENDAS']);
							$indicesSomenteAnoAnterior['COMPANT_PMP'] = $this->indiceseconomicos->pmp($passivosAnoAnteriorMenosUm['BPAS_FORNECEDORES'], $passivosAnoAnterior['BPAS_FORNECEDORES'], $dreAnoAnterior['DRES_CUSTO_VENDAS'], $ativosAnoAnteriorMenosUm['BATIV_ESTOQUE'], $ativosAnoAnterior['BATIV_ESTOQUE']);
							$indicesSomenteAnoAnterior['COMPANT_CO'] = $this->indiceseconomicos->co($indicesSomenteAnoAnterior['COMPANT_PMC'], $indicesSomenteAnoAnterior['COMPANT_PME']);
							$indicesSomenteAnoAnterior['COMPANT_CF'] = $this->indiceseconomicos->cf($indicesSomenteAnoAnterior['COMPANT_CO'], $indicesSomenteAnoAnterior['COMPANT_PMP']);
							$indicesSomenteAnoAnterior['COMPANT_GA'] = $this->indiceseconomicos->ga($dreAnoAnterior['DRES_RECEITA_LIQUIDA_VENDAS'], $ativosAnoAnteriorMenosUm['BATIV_ATIVO_TOTAL'], $ativosAnoAnterior['BATIV_ATIVO_TOTAL']);
							$indicesSomenteAnoAnterior['COMPANT_RSA'] = $this->indiceseconomicos->rsa($indicesAnoAnterior['COMP_ML'], $indicesSomenteAnoAnterior['COMPANT_GA']);
							$indicesSomenteAnoAnterior['COMPANT_RSPL'] = $this->indiceseconomicos->rspl($indicesSomenteAnoAnterior['COMPANT_RSA'], $indicesAnoAnterior['COMP_MAF']);
							$indicesSomenteAnoAnterior['COMPANT_EMP_ID'] = $this->empId;
							$indicesSomenteAnoAnterior['COMPANT_ANO_ID'] = $this->anoAnterior;
							//carrega modelo para inserir o balanço (ativos/passivos) e o dre
							$this->load->model('DadosFinanceiros');
							//$this->DadosFinanceiros->inserir($ativosAnoAnteriorMenosUm, $passivosAnoAnteriorMenosUm, $dreAnoAnteriorMenosUm, 
							//							$ativosAnoAnterior, $passivosAnoAnterior, $dreAnoAnterior);

							//carrega modelo para inserir os comparativos
							$this->load->model('Comparativos');
							$this->Comparativos->inserirIndices($indicesAnoAnteriorMenosUm, $indicesAnoAnterior);
							$this->Comparativos->inserirSomenteIndicesAnoAnterior($indicesSomenteAnoAnterior);
							die();
							}else{
								//retorna pra view com os alerts
								var_dump($this->form_validation->error_array());
								print "false";
							}

						}
					}
		}
	}

	public function cadastrarDre($id){
		
	}

	public function listarIndicesEconomicos(){

	}

	public function listarBalanco(){

	}

	public function listarDre(){

	}

	public function gerarQuartil(){
		
	}

	private function validaBalancoAtivos($data) {
		$this->load->helper( array( 'form' ,  'url' ));
		$this->load->library( 'form_validation' );

        $this->form_validation->set_data($data);

        $this->form_validation->set_rules("BATIV_EMP_ID", "Id da empresa ", "trim|required");
		$this->form_validation->set_rules("BATIV_ANO_ID", "Ano referente ao balanço patrimonial", "trim|required|max_length[10]");
		$this->form_validation->set_rules("BATIV_CLIENTES", "Clientes", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BATIV_ESTOQUE", "Estoque", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BATIV_CAIXA_EQUIV_CAIXA", "Caixa equivalente de caixa", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BATIV_OUTROS_ATIVOS_CIRCULANTES", "Outros ativos circulantes", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BATIV_ATIVO_RLP", "Ativo realizável a longo prazo", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BATIV_IMOB_INTANGIVEL", "Imobilizado e intangível", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BATIV_INVESTIMENTOS", "Investimentos", "trim|required|max_length[20]");
		
        if ($this->form_validation->run()){
            return true;
		}else{
			var_dump($this->form_validation->error_array());
			return false;
		}
	}

	private function validaBalancoPassivos($data) {
		$this->load->helper( array( 'form' ,  'url' ));
		$this->load->library( 'form_validation' );

        $this->form_validation->set_data($data);

        $this->form_validation->set_rules("BPAS_EMP_ID", "Id da empresa ", "trim|required");
		$this->form_validation->set_rules("BPAS_ANO_ID", "Ano referente ao balanço patrimonial", "trim|required|max_length[10]");
		$this->form_validation->set_rules("BPAS_PASSIVO_N_CIRCULANTE", "Passivo não circulante", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BPAS_FORNECEDORES", "Fornecedores", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BPAS_PATRIMONIO_LIQUIDO", "Patrimônio líquido", "trim|required|max_length[20]");
		$this->form_validation->set_rules("BPAS_OUTROS_PASSIVOS_CIRCULANTES", "Outros passivos circulantes", "trim|required|max_length[20]");

        if ($this->form_validation->run()){
            return true;
		}else{
			return false;
		}
	}

	private function validaDre($data) {
		$this->load->helper( array( 'form' ,  'url' ));
		$this->load->library( 'form_validation' );

        $this->form_validation->set_data($data);

        $this->form_validation->set_rules("DRES_EMP_ID", "Id da empresa ", "trim|required");
		$this->form_validation->set_rules("DRES_ANO_ID", "Ano referente ao DRE", "trim|required|max_length[10]");
		$this->form_validation->set_rules("DRES_RECEITA_LIQUIDA_VENDAS", "Receita líquida de vendas", "trim|required|max_length[20]");
		$this->form_validation->set_rules("DRES_CUSTO_VENDAS", "Custo das vendas", "trim|required|max_length[20]");
		$this->form_validation->set_rules("DRES_DESPESAS_OPERACIONAIS", "Despesas Operacionais", "trim|required|max_length[20]");
		$this->form_validation->set_rules("DRES_OUTRAS_RECEITAS_OP", "Outras receitas operacionais", "trim|required|max_length[20]");
		$this->form_validation->set_rules("DRES_DESPESAS_FINANCEIRAS", "Despesas Financeiras", "trim|required|max_length[10]");
		$this->form_validation->set_rules("DRES_RECEITAS_FINANCEIRAS", "Receitas Financeiras", "trim|required|max_length[20]");
		$this->form_validation->set_rules("DRES_OUTRAS_DESPESAS", "Outras despesas", "trim|required|max_length[20]");
		$this->form_validation->set_rules("DRES_IRPJ_CSLL", "IRPJ e CSLL", "trim|required|max_length[20]");
		$this->form_validation->set_rules("DRES_CONTRIBUICOES_PARTICIP", "Contribuicoes e participacoes", "trim|required|max_length[20]");

        if ($this->form_validation->run()){
            return true;
		}else{
			return false;
		}
	}
}
