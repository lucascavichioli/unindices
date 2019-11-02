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
				$posicionamentoLi[$ano]['COMP_LI'] = $this->getPosicionamento($indices[$i]->COMP_LI, $quartilLi[$ano], 1);
				unset($elementosLi);

			foreach ($lcs[$ano] as $lc) {
				$elementosLc[] = $lc->COMP_LC;
			}
				$quartilLc[$ano][] = $this->quartil->getQuartilUm($elementosLc);
				$quartilLc[$ano][] = $this->quartil->getQuartilDois($elementosLc);
				$quartilLc[$ano][] = $this->quartil->getQuartilTres($elementosLc);
				$posicionamentoLc[$ano]['COMP_LC'] = $this->getPosicionamento($indices[$i]->COMP_LC, $quartilLc[$ano], 1);
				unset($elementosLc);
			
			foreach ($lss[$ano] as $ls) {
				$elementosLs[] = $ls->COMP_LS;
			}
				$quartilLs[$ano][] = $this->quartil->getQuartilUm($elementosLs);
				$quartilLs[$ano][] = $this->quartil->getQuartilDois($elementosLs);
				$quartilLs[$ano][] = $this->quartil->getQuartilTres($elementosLs);
				$posicionamentoLs[$ano]['COMP_LS'] = $this->getPosicionamento($indices[$i]->COMP_LS, $quartilLs[$ano], 1);
				unset($elementosLs);

			foreach ($lgs[$ano] as $lg) {
				$elementosLg[] = $lg->COMP_LG;
			}
				$quartilLg[$ano][] = $this->quartil->getQuartilUm($elementosLg);
				$quartilLg[$ano][] = $this->quartil->getQuartilDois($elementosLg);
				$quartilLg[$ano][] = $this->quartil->getQuartilTres($elementosLg);
				$posicionamentoLg[$ano]['COMP_LG'] = $this->getPosicionamento($indices[$i]->COMP_LG, $quartilLg[$ano], 1);
				unset($elementosLg);
		
			foreach ($egs[$ano] as $eg) {
				$elementosEg[] = $eg->COMP_EG;
			}
				$quartilEg[$ano][] = $this->quartil->getQuartilUm($elementosEg);
				$quartilEg[$ano][] = $this->quartil->getQuartilDois($elementosEg);
				$quartilEg[$ano][] = $this->quartil->getQuartilTres($elementosEg);
				$posicionamentoEg[$ano]['COMP_EG'] = $this->getPosicionamento($indices[$i]->COMP_EG, $quartilEg[$ano], 2);
				unset($elementosEg);
		
			foreach ($ges[$ano] as $ge) {
				$elementosGe[] = $ge->COMP_GE;
			}
				$quartilGe[$ano][] = $this->quartil->getQuartilUm($elementosGe);
				$quartilGe[$ano][] = $this->quartil->getQuartilDois($elementosGe);
				$quartilGe[$ano][] = $this->quartil->getQuartilTres($elementosGe);
				$posicionamentoGe[$ano]['COMP_GE'] = $this->getPosicionamento($indices[$i]->COMP_GE, $quartilGe[$ano], 2);
				unset($elementosGe);

			foreach ($ces[$ano] as $ce) {
				$elementosCe[] = $ce->COMP_CE;
			}
				$quartilCe[$ano][] = $this->quartil->getQuartilUm($elementosCe);
				$quartilCe[$ano][] = $this->quartil->getQuartilDois($elementosCe);
				$quartilCe[$ano][] = $this->quartil->getQuartilTres($elementosCe);
				$posicionamentoCe[$ano]['COMP_CE'] = $this->getPosicionamento($indices[$i]->COMP_CE, $quartilCe[$ano], 2);
				unset($elementosCe);

			foreach ($gis[$ano] as $gi) {
				$elementosGi[] = $gi->COMP_GI;
			}
				$quartilGi[$ano][] = $this->quartil->getQuartilUm($elementosGi);
				$quartilGi[$ano][] = $this->quartil->getQuartilDois($elementosGi);
				$quartilGi[$ano][] = $this->quartil->getQuartilTres($elementosGi);
				$posicionamentoGi[$ano]['COMP_GI'] = $this->getPosicionamento($indices[$i]->COMP_GI, $quartilGi[$ano], 2);
				unset($elementosGi);
		
			foreach ($gis[$ano] as $gi) {
				$elementosGi[] = $gi->COMP_GI;
			}
				$quartilGi[$ano][] = $this->quartil->getQuartilUm($elementosGi);
				$quartilGi[$ano][] = $this->quartil->getQuartilDois($elementosGi);
				$quartilGi[$ano][] = $this->quartil->getQuartilTres($elementosGi);
				$posicionamentoGi[$ano]['COMP_GI'] = $this->getPosicionamento($indices[$i]->COMP_GI, $quartilGi[$ano], 2);
				unset($elementosGi);
		
			foreach ($irncs[$ano] as $irnc) {
				$elementosIrnc[] = $irnc->COMP_IRNC;
			}
				$quartilIrnc[$ano][] = $this->quartil->getQuartilUm($elementosIrnc);
				$quartilIrnc[$ano][] = $this->quartil->getQuartilDois($elementosIrnc);
				$quartilIrnc[$ano][] = $this->quartil->getQuartilTres($elementosIrnc);
				$posicionamentoIrnc[$ano]['COMP_IRNC'] = $this->getPosicionamento($indices[$i]->COMP_IRNC, $quartilIrnc[$ano], 2);
				unset($elementosIrnc);

			foreach ($mafs[$ano] as $maf) {
				$elementosMaf[] = $maf->COMP_MAF;
			}
				$quartilMaf[$ano][] = $this->quartil->getQuartilUm($elementosMaf);
				$quartilMaf[$ano][] = $this->quartil->getQuartilDois($elementosMaf);
				$quartilMaf[$ano][] = $this->quartil->getQuartilTres($elementosMaf);
				$posicionamentoMaf[$ano]['COMP_MAF'] = $this->getPosicionamento($indices[$i]->COMP_MAF, $quartilMaf[$ano], 1);
				unset($elementosMaf);

			foreach ($mbs[$ano] as $mb) {
				$elementosMb[] = $mb->COMP_MB;
			}
				$quartilMb[$ano][] = $this->quartil->getQuartilUm($elementosMb);
				$quartilMb[$ano][] = $this->quartil->getQuartilDois($elementosMb);
				$quartilMb[$ano][] = $this->quartil->getQuartilTres($elementosMb);
				$posicionamentoMb[$ano]['COMP_MB'] = $this->getPosicionamento($indices[$i]->COMP_MB, $quartilMb[$ano], 1);
				unset($elementosMb);
		
			foreach ($mos[$ano] as $mo) {
				$elementosMo[] = $mo->COMP_MO;
			}
				$quartilMo[$ano][] = $this->quartil->getQuartilUm($elementosMo);
				$quartilMo[$ano][] = $this->quartil->getQuartilDois($elementosMo);
				$quartilMo[$ano][] = $this->quartil->getQuartilTres($elementosMo);
				$posicionamentoMo[$ano]['COMP_MO'] = $this->getPosicionamento($indices[$i]->COMP_MO, $quartilMo[$ano], 1);
				unset($elementosMo);

			foreach ($mls[$ano] as $ml) {
				$elementosMl[] = $ml->COMP_ML;
			}
				$quartilMl[$ano][] = $this->quartil->getQuartilUm($elementosMl);
				$quartilMl[$ano][] = $this->quartil->getQuartilDois($elementosMl);
				$quartilMl[$ano][] = $this->quartil->getQuartilTres($elementosMl);
				$posicionamentoMl[$ano]['COMP_ML'] = $this->getPosicionamento($indices[$i]->COMP_ML, $quartilMl[$ano], 1);
				unset($elementosMl);

		 $i++;
		}
		 print "<pre>";
		 print_r($posicionamentoLi);
		 print "</pre>";

		// print "<pre>";
		// print_r($posicionamentoLc);
		// print "</pre>";


		// print "<pre>";
		// print_r($posicionamentoLs);
		// print "</pre>";


        $data['title'] = "Índices";
        $this->dashboard->show('relatorio-indices', $data);
	}

	public function getPosicionamento($indice, $quartis, $mn){
		
		$quartilUm = $quartis[0];
		$quartilDois = $quartis[1];
		$quartilTres = $quartil[2];

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
	 }
	
}   