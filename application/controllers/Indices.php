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
		$indicesAnoAnterior = $this->IndicesModel->listaIndicesAnoAnterior($id);

		//carrega cnae da empresa
		//carrega estado da empresa
		//carrega quantidade de empregrados
	
		$this->load->model('EmpresaClienteModel');
		$dadosEmpresa = $this->EmpresaClienteModel->listaCnaeEstadoQtdEmp($id);

		$cnae = $dadosEmpresa[0]->emp_cnae;
		$cnae = substr($cnae, 0, 4);

		$uf = $dadosEmpresa[0]->emp_uf;
		$qtdEmp = $dadosEmpresa[0]->emp_qtd_emp;

		$m1 = $qtdEmp - 50;
		$m2 = $qtdEmp + 50;

		//separa anos
		foreach($indices as $chave => $valor){
			$anos[$valor->COMP_ANO_ID] = $valor->COMP_ANO_ID;
		}

		//separa anos dos indices ano anterior
		foreach($indicesAnoAnterior as $chave => $valor){
			$anosDosAnosAnterior[$valor->COMPANT_ANO_ID] = $valor->COMPANT_ANO_ID;
		}

		if(empty($anos)){
			die("Não possui nenhum dado cadastrado");
		}

		//para cada ano; lista indices da empresa com o mesmo cnae, range de colaboradores e estado;
		//todos os arrays estão vazios no início desse laço de repetição.
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
		

		//verifica se não existem índices suficientes
		// if(count($lis) < 4){
        //     die("Não há indices suficientes para calcular o quartil");
		// } 

		$i=0;
		$this->load->library('quartil');
		foreach ($anos as $ano) {
			foreach ($lis[$ano] as $li) {
				$elementosLi[] = $li->COMP_LI;
			}
				$quartilLi[$ano][0] = $this->quartil->getQuartilUm($elementosLi);
				$quartilLi[$ano][1] = $this->quartil->getQuartilDois($elementosLi);
				$quartilLi[$ano][2] = $this->quartil->getQuartilTres($elementosLi);
				$posicionamentoLi[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_LI, $quartilLi[$ano], 1);
				$posicionamentoLi[$ano]['VALOR'] = $indices[$i]->COMP_LI;
				unset($elementosLi);

			foreach ($lcs[$ano] as $lc) {
				$elementosLc[] = $lc->COMP_LC;
			}
				$quartilLc[$ano][0] = $this->quartil->getQuartilUm($elementosLc);
				$quartilLc[$ano][1] = $this->quartil->getQuartilDois($elementosLc);
				$quartilLc[$ano][2] = $this->quartil->getQuartilTres($elementosLc);
				$posicionamentoLc[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_LC, $quartilLc[$ano], 1);
				$posicionamentoLc[$ano]['VALOR'] = $indices[$i]->COMP_LC;
				unset($elementosLc);
			
			foreach ($lss[$ano] as $ls) {
				$elementosLs[] = $ls->COMP_LS;
			}
				$quartilLs[$ano][0] = $this->quartil->getQuartilUm($elementosLs);
				$quartilLs[$ano][1] = $this->quartil->getQuartilDois($elementosLs);
				$quartilLs[$ano][2] = $this->quartil->getQuartilTres($elementosLs);
				$posicionamentoLs[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_LS, $quartilLs[$ano], 1);
				$posicionamentoLs[$ano]['VALOR'] = $indices[$i]->COMP_LS;
				unset($elementosLs);

			foreach ($lgs[$ano] as $lg) {
				$elementosLg[] = $lg->COMP_LG;
			}
				$quartilLg[$ano][0] = $this->quartil->getQuartilUm($elementosLg);
				$quartilLg[$ano][1] = $this->quartil->getQuartilDois($elementosLg);
				$quartilLg[$ano][2] = $this->quartil->getQuartilTres($elementosLg);
				$posicionamentoLg[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_LG, $quartilLg[$ano], 1);
				$posicionamentoLg[$ano]['VALOR'] = $indices[$i]->COMP_LG;
				unset($elementosLg);
		
			foreach ($egs[$ano] as $eg) {
				$elementosEg[] = $eg->COMP_EG;
			}
				$quartilEg[$ano][0] = $this->quartil->getQuartilUm($elementosEg);
				$quartilEg[$ano][1] = $this->quartil->getQuartilDois($elementosEg);
				$quartilEg[$ano][2] = $this->quartil->getQuartilTres($elementosEg);
				$posicionamentoEg[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_EG, $quartilEg[$ano], 2);
				$posicionamentoEg[$ano]['VALOR'] = $indices[$i]->COMP_EG;
				unset($elementosEg);
		
			foreach ($ges[$ano] as $ge) {
				$elementosGe[] = $ge->COMP_GE;
			}
				$quartilGe[$ano][0] = $this->quartil->getQuartilUm($elementosGe);
				$quartilGe[$ano][1] = $this->quartil->getQuartilDois($elementosGe);
				$quartilGe[$ano][2] = $this->quartil->getQuartilTres($elementosGe);
				$posicionamentoGe[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_GE, $quartilGe[$ano], 2);
				$posicionamentoGe[$ano]['VALOR'] = $indices[$i]->COMP_GE;
				unset($elementosGe);

			foreach ($ces[$ano] as $ce) {
				$elementosCe[] = $ce->COMP_CE;
			}
				$quartilCe[$ano][0] = $this->quartil->getQuartilUm($elementosCe);
				$quartilCe[$ano][1] = $this->quartil->getQuartilDois($elementosCe);
				$quartilCe[$ano][2] = $this->quartil->getQuartilTres($elementosCe);
				$posicionamentoCe[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_CE, $quartilCe[$ano], 2);
				$posicionamentoCe[$ano]['VALOR'] = $indices[$i]->COMP_CE;
				unset($elementosCe);

			foreach ($gis[$ano] as $gi) {
				$elementosGi[] = $gi->COMP_GI;
			}
				$quartilGi[$ano][0] = $this->quartil->getQuartilUm($elementosGi);
				$quartilGi[$ano][1] = $this->quartil->getQuartilDois($elementosGi);
				$quartilGi[$ano][2] = $this->quartil->getQuartilTres($elementosGi);
				$posicionamentoGi[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_GI, $quartilGi[$ano], 2);
				$posicionamentoGi[$ano]['VALOR'] = $indices[$i]->COMP_GI;
				unset($elementosGi);
		
			foreach ($irncs[$ano] as $irnc) {
				$elementosIrnc[] = $irnc->COMP_IRNC;
			}
				$quartilIrnc[$ano][0] = $this->quartil->getQuartilUm($elementosIrnc);
				$quartilIrnc[$ano][1] = $this->quartil->getQuartilDois($elementosIrnc);
				$quartilIrnc[$ano][2] = $this->quartil->getQuartilTres($elementosIrnc);
				$posicionamentoIrnc[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_IRNC, $quartilIrnc[$ano], 2);
				$posicionamentoIrnc[$ano]['VALOR'] = $indices[$i]->COMP_IRNC;
				unset($elementosIrnc);

			foreach ($mafs[$ano] as $maf) {
				$elementosMaf[] = $maf->COMP_MAF;
			}
				$quartilMaf[$ano][0] = $this->quartil->getQuartilUm($elementosMaf);
				$quartilMaf[$ano][1] = $this->quartil->getQuartilDois($elementosMaf);
				$quartilMaf[$ano][2] = $this->quartil->getQuartilTres($elementosMaf);
				$posicionamentoMaf[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_MAF, $quartilMaf[$ano], 1);
				$posicionamentoMaf[$ano]['VALOR'] = $indices[$i]->COMP_MAF;
				unset($elementosMaf);

			foreach ($mbs[$ano] as $mb) {
				$elementosMb[] = $mb->COMP_MB;
			}
				$quartilMb[$ano][0] = $this->quartil->getQuartilUm($elementosMb);
				$quartilMb[$ano][1] = $this->quartil->getQuartilDois($elementosMb);
				$quartilMb[$ano][2] = $this->quartil->getQuartilTres($elementosMb);
				$posicionamentoMb[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_MB, $quartilMb[$ano], 1);
				$posicionamentoMb[$ano]['VALOR'] = $indices[$i]->COMP_MB;
				unset($elementosMb);
		
			foreach ($mos[$ano] as $mo) {
				$elementosMo[] = $mo->COMP_MO;
			}
				$quartilMo[$ano][0] = $this->quartil->getQuartilUm($elementosMo);
				$quartilMo[$ano][1] = $this->quartil->getQuartilDois($elementosMo);
				$quartilMo[$ano][2] = $this->quartil->getQuartilTres($elementosMo);
				$posicionamentoMo[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_MO, $quartilMo[$ano], 1);
				$posicionamentoMo[$ano]['VALOR'] = $indices[$i]->COMP_MO;
				unset($elementosMo);

			foreach ($mls[$ano] as $ml) {
				$elementosMl[] = $ml->COMP_ML;
			}
				$quartilMl[$ano][0] = $this->quartil->getQuartilUm($elementosMl);
				$quartilMl[$ano][1] = $this->quartil->getQuartilDois($elementosMl);
				$quartilMl[$ano][2] = $this->quartil->getQuartilTres($elementosMl);
				$posicionamentoMl[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_ML, $quartilMl[$ano], 1);
				$posicionamentoMl[$ano]['VALOR'] = $indices[$i]->COMP_ML;
				unset($elementosMl);

		 $i++;
		}

		$posicionamento['LI'] = $posicionamentoLi;
		$posicionamento['LC'] = $posicionamentoLc;
		$posicionamento['LS'] = $posicionamentoLs;
		$posicionamento['LG'] = $posicionamentoLg;
		$posicionamento['EG'] = $posicionamentoEg;
		$posicionamento['GE'] = $posicionamentoGe;
		$posicionamento['CE'] = $posicionamentoCe;
		$posicionamento['GI'] = $posicionamentoGi;
		$posicionamento['IRNC'] = $posicionamentoIrnc;
		$posicionamento['MAF'] = $posicionamentoMaf;
		$posicionamento['MB'] = $posicionamentoMb;
		$posicionamento['MO'] = $posicionamentoMo;
		$posicionamento['ML'] = $posicionamentoMl;

		$data['indices'] = $indices;
		$data['anos'] = $anos; 
		$data['comparativos'] = $posicionamento;
        $data['title'] = "Índices";
        $this->dashboard->show('relatorio-indices', $data);
	}

	public function getPosicionamento($indice, $quartis, $mn){
		
		$quartilUm = $quartis[0];
		$quartilDois = $quartis[1];
		$quartilTres = $quartis[2];

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