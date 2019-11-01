<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indices extends CI_Controller {

	private static $ruim         = 'RUIM';
    private static $satisfatorio = 'SATISFATÓRIO';
    private static $bom          = 'BOM';
	private static $otimo        = 'ÓTIMO';
	

    public function index(){
		if(!empty($this->session->userdata('usuario'))){
			redirect(base_url() . "indices/relatorio");
		}else{
			$this->load->view('login');
		}
	}

    public function relatorio($empId){
		if(empty($this->session->userdata('usuario'))){
			redirect(base_url() . "painel/login");
		}

		$id = base64_decode($empId);

		//carrega indices da empresa
		$this->load->model('IndicesModel');

		$indices = $this->IndicesModel->listaIndices($id);

		//carrega cnae da empresa
		//carrega estado da empresa
		//carrega quantidade de empregrados
	
		$this->load->model('EmpresaClienteModel');
		$dadosEmpresa = $this->EmpresaClienteModel->listaCnaeEstadoQtdEmp($id);

		$cnae = $dadosEmpresa[0]->emp_cnae;
		$uf = $dadosEmpresa[0]->emp_uf;
		$qtdEmp = $dadosEmpresa[0]->emp_qtd_emp;

		$m1 = $qtdEmp - 50;
		$m2 = $qtdEmp + 50;

		//separa anos
		foreach($indices as $chave => $valor){
			$anos[$valor->COMP_ANO_ID] = $valor->COMP_ANO_ID;
		}

		if(empty($anos)){
			die("Não possui nenhum dado cadastrado");
		}

		//para cada ano; lista indices da empresa com o mesmo cnae, range de colaboradores e estado;
		foreach ($anos as $chave => $ano) {
			$lis[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_LI');
			$lcs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_LC');
			$lss[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_LS');
			$lgs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_LG');
			$egs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_EG');
			$ges[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_GE');
			$ces[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_CE');
			$gis[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_GI');
			$irncs[$ano] = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_IRNC');
			$mafs[$ano]  = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_MAF');
			$mbs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_MB');
			$mos[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_MO');
			$mls[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnae, $m1, $m2, 'COMP_ML');
		}
		
		
		/*
		if(count($lis) < 4){
            die("Não há indices suficientes para calcular o quartil");
		} */
		//array que armazena os elementos
		$elementos = array();

		//array que separa os quartis de cada conjunto de elementos por ano
		$quartilPorAno = array();
		$i=0;
		$this->load->library('quartil');
		foreach ($anos as $ano) {
			foreach ($lis[$ano] as $li) {
				$elementosLi[] = $li->COMP_LI;
			}
				$quartilLi[$ano][] = $this->quartil->getQuartilUm($elementosLi);
				$quartilLi[$ano][] = $this->quartil->getQuartilDois($elementosLi);
				$quartilLi[$ano][] = $this->quartil->getQuartilTres($elementosLi);
			
			unset($elementosLi);

			foreach ($lcs[$ano] as $lc) {
				$elementosLc[] = $lc->COMP_LC;
			}
				$quartilLc[$ano][] = $this->quartil->getQuartilUm($elementosLc);
				$quartilLc[$ano][] = $this->quartil->getQuartilDois($elementosLc);
				$quartilLc[$ano][] = $this->quartil->getQuartilTres($elementosLc);

				unset($elementosLc);
			
			foreach ($lss[$ano] as $ls) {
				$elementosLs[] = $ls->COMP_LS;
			}
				$quartilLs[$ano][] = $this->quartil->getQuartilUm($elementosLs);
				$quartilLs[$ano][] = $this->quartil->getQuartilDois($elementosLs);
				$quartilLs[$ano][] = $this->quartil->getQuartilTres($elementosLs);
				$posicionamentoLs[$ano]['COMP_LS'] = $this->getPosicionamento($indices[$i]->COMP_LS, $quartilLi[$ano], 1);
				unset($elementosLs);

		 $i++;
		}
		print "<pre>";
		print_r($posicionamentoLs);
		print "</pre>";

        $data['title'] = "Índices";
        $this->dashboard->show('relatorio-indices', $data);
	}

	public function getPosicionamento($indice, $quartis, $mn){
		print "<pre>";
		print_r($indice);
		print "</pre>";
		
		print "<pre>";
		print_r($quartis);
		print "</pre>";
		
		print "<pre>";
		print_r($mn);
		print "</pre>";

		/*
		 if($mn === 1){
			 if($indice < $quartilUm){
				 return self::$ruim;
			 }
 
			 if($indice >= $quartilUm && $indice < $quartilDois){
				 return self::$satisfatorio;
			 }
 
			 if($indice >= $quartilDois && $indice < $quartilTres){
				 return self::$bom;
			 }
 
			 if($indice >= $quartilTres){
				 return self::$otimo;
			 }
		 }else{
			 if($indice < $quartilUm){
				 return self::$otimo;
			 }
	 
			 if($indice >= $quartilUm && $indice < $quartilDois){
				 return self::$bom;
			 }
	 
			 if($indice >= $quartilDois && $indice < $quartilTres){
				 return self::$satisfatorio;
			 }
	 
			 if($indice >= $quartilTres){
				 return self::$ruim;
			 }
		 }
		 */
	 }
	
}   