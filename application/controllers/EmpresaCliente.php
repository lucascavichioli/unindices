<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaCliente extends CI_Controller {

	public function index(){
		if(!empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/dashboard");
		}else{
			$this->load->view('login');
		}
	}

	public function cadastrarDadosFinanceiros($id=null){
		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
			$id = base64_decode($id);
			$data['title'] = "Cadastro dos dados financeiros";
			$data['id'] = $id;
			$data['cont_id'] = $this->session->userdata('cont_id');
			$this->dashboard->show('adicionar-dados-financeiros', $data);
		}else{
			
			//BALANÇO DOS ATIVOS (ANO ANTERIOR MENOS UM)
			$ativosAnoAnteriorMenosUm['BATIV_EMP_ID'] = $this->input->post('empId', true);
			$ativosAnoAnteriorMenosUm['BATIV_ANO_ID'] = $this->input->post('anoAnteriorMenosUm', true);
			$ativosAnoAnteriorMenosUm['BATIV_CLIENTES'] = $this->input->post('clientes', true);
			$ativosAnoAnteriorMenosUm['BATIV_ESTOQUE'] =  $this->input->post('estoque', true);
			$ativosAnoAnteriorMenosUm['BATIV_CAIXA_EQUIV_CAIXA'] = $this->input->post('caixaEquivalenteDeCaixa', true);
			$ativosAnoAnteriorMenosUm['BATIV_OUTROS_ATIVOS_CIRCULANTES'] = $this->input->post('outrosAtivosCirculantes', true);
			$ativosAnoAnteriorMenosUm['BATIV_ATIVO_RLP'] = $this->input->post('ativoRealizavelLongoPrazo', true);
			$ativosAnoAnteriorMenosUm['BATIV_IMOB_INTANGIVEL'] = $this->input->post('imobilizadoIntangivel', true);
			$ativosAnoAnteriorMenosUm['BATIV_INVESTIMENTOS'] = $this->input->post('investimentos', true);

			//BALANÇO DOS ATIVOS (ANO ANTERIOR)
			$ativosAnoAnterior['BATIV_EMP_ID'] = $this->input->post('empId', true);
			$ativosAnoAnterior['BATIV_ANO_ID'] = $this->input->post('anoAnterior', true);
			$ativosAnoAnterior['BATIV_CLIENTES'] = $this->input->post('clientes2', true);
			$ativosAnoAnterior['BATIV_ESTOQUE'] =  $this->input->post('estoque2', true);
			$ativosAnoAnterior['BATIV_CAIXA_EQUIV_CAIXA'] = $this->input->post('caixaEquivalenteDeCaixa2', true);
			$ativosAnoAnterior['BATIV_OUTROS_ATIVOS_CIRCULANTES'] = $this->input->post('outrosAtivosCirculantes2', true);
			$ativosAnoAnterior['BATIV_ATIVO_RLP'] = $this->input->post('ativoRealizavelLongoPrazo2', true);
			$ativosAnoAnterior['BATIV_IMOB_INTANGIVEL'] = $this->input->post('imobilizadoIntangivel2', true);
			$ativosAnoAnterior['BATIV_INVESTIMENTOS'] = $this->input->post('investimentos2', true);

			//VALIDA FORMULÁRIOS
			$validouAtivosAnoAnteriorMenosUm = $this->validaBalancoAtivos($ativosAnoAnteriorMenosUm);
			$validouAtivosAnoAnterior = $this->validaBalancoAtivos($ativosAnoAnterior);

			//BALANÇO DOS PASSIVOS (ANO ANTERIOR MENOS UM)
			$passivosAnoAnteriorMenosUm['BPAS_EMP_ID'] = $this->input->post('empId', true);
			$passivosAnoAnteriorMenosUm['BPAS_ANO_ID'] = $this->input->post('anoAnteriorMenosUm', true);
			$passivosAnoAnteriorMenosUm['BPAS_PASSIVO_N_CIRCULANTE'] = $this->input->post('passivoNaoCirculante', true);
			$passivosAnoAnteriorMenosUm['BPAS_FORNECEDORES'] =  $this->input->post('fornecedores', true);
			$passivosAnoAnteriorMenosUm['BPAS_PATRIMONIO_LIQUIDO'] = $this->input->post('patrimonioLiquido', true);
			$passivosAnoAnteriorMenosUm['BPAS_OUTROS_PASSIVOS_CIRCULANTES'] = $this->input->post('outrosPassivosCirculantes', true);

			//BALANÇO DOS PASSIVOS (ANO ANTERIOR)
			$passivosAnoAnterior['BPAS_EMP_ID'] = $this->input->post('empId', true);
			$passivosAnoAnterior['BPAS_ANO_ID'] = $this->input->post('anoAnterior', true);
			$passivosAnoAnterior['BPAS_PASSIVO_N_CIRCULANTE'] = $this->input->post('passivoNaoCirculante2', true);
			$passivosAnoAnterior['BPAS_FORNECEDORES'] =  $this->input->post('fornecedores2', true);
			$passivosAnoAnterior['BPAS_PATRIMONIO_LIQUIDO'] = $this->input->post('patrimonioLiquido2', true);
			$passivosAnoAnterior['BPAS_OUTROS_PASSIVOS_CIRCULANTES'] = $this->input->post('outrosPassivosCirculantes2', true);
			
			//VALIDA FORMULÁRIOS
			$validouPassivosAnoAnteriorMenosUm = $this->validaBalancoPassivos($passivosAnoAnteriorMenosUm);
			$validouPassivosAnoAnterior = $this->validaBalancoPassivos($passivosAnoAnterior);

			// DEMONSTRAÇÃO DE RESULTADO (ANO ANTERIOR MENOS UM)
			$dreAnoAnteriorMenosUm['DRES_EMP_ID'] = $this->input->post('empId', true);
			$dreAnoAnteriorMenosUm['DRES_ANO_ID'] = $this->input->post('anoAnteriorMenosUm', true);
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
			$dreAnoAnterior['DRES_EMP_ID'] = $this->input->post('empId', true);
			$dreAnoAnterior['DRES_ANO_ID'] = $this->input->post('anoAnteriorMenosUm', true);
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
			$validouDreAnoAnteriorMenosUm = $this->validaDre($passivosAnoAnteriorMenosUm);
			$validouDreAnoAnterior = $this->validaDre($dreAnoAnterior);
			
			
			if($validouAtivosAnoAnteriorMenosUm && $validouAtivosAnoAnterior){

			}else{

			}


			$this->load->helper('FormataValores');

			$teste = formataValores($ativosAnoAnteriorMenosUm); //retunr array 

			var_dump($teste);
			die();



			

			$this->load->model('DadosFinanceiros');
			$this->BalancoAtivos->inserir($balancoAtivosAnoAnteriorMenosUm, $balancoPassivosAnoAnteriorMenosUm, $dreAnoAnteriorMenosUm, 
										  $balancoAtivosAnoAnterior, $balancoPassivosAnoAnterior, $dreAnoAnterior);
			
			
			var_dump($_POST);
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

        $this->form_validation->set_rules("user_email ", "Email ", "trim|required|valid_email");
        $this->form_validation->set_rules("user_password ", "Senha ", "trim|required|min_length[6]|max_length[10]");


        if ($this->form_validation->run()){
            return true;
		}else{
			return false;
		}
	}

	private function validaBalancoPassivos($data) {
		$this->load->helper( array( 'form' ,  'url' ));
		$this->load->library( 'form_validation' );

        $this->form_validation->set_data($data);

        $this->form_validation->set_rules("user_email ", "Email ", "trim|required|valid_email");
        $this->form_validation->set_rules("user_password ", "Senha ", "trim|required|min_length[6]|max_length[10]");


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

        $this->form_validation->set_rules("user_email ", "Email ", "trim|required|valid_email");
        $this->form_validation->set_rules("user_password ", "Senha ", "trim|required|min_length[6]|max_length[10]");

        if ($this->form_validation->run()){
            return true;
		}else{
			return false;
		}
	}
}
