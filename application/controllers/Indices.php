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

		if(empty($indices)){
			redirect(base_url() . "indices/erronenhumdadocadastrado");
		}

		//carrega cnae da empresa
		//carrega estado da empresa
		//carrega quantidade de empregrados
	
		$this->load->model('EmpresaClienteModel');
		$dadosEmpresa = $this->EmpresaClienteModel->listaCnaeEstadoQtdEmp($id);

		$cnae = $dadosEmpresa[0]->emp_cnae;
		$cnaeGeral = substr($cnae, 0, 3);

		$uf = $dadosEmpresa[0]->emp_uf;
		$qtdEmp = $dadosEmpresa[0]->emp_qtd_emp;

		//separa anos
		foreach($indices as $chave => $valor){
			$anos[$valor->COMP_ANO_ID] = $valor->COMP_ANO_ID;
		}

		//separa anos dos indices ano anterior
		foreach($indicesAnoAnterior as $chave => $valor){
			$anosDosAnosAnteriores[$valor->COMPANT_ANO_ID] = $valor->COMPANT_ANO_ID;
		}

		foreach ($indices as $ano => $array) {
			unset($array->COMP_ID);
			unset($array->COMP_ANO_ID);
		}

		foreach ($indicesAnoAnterior as $ano => $array) {
			unset($array->COMPANT_ID);
			unset($array->COMPANT_ANO_ID);
		}

		$data['tituloGrafico'] = "Índices Econômico-financeiros";
		$data['uf'] = $uf;
		$data['empresa'] = $dadosEmpresa[0]->emp_nome;
		$data['cnae'] = $cnae;
		$data['indices'] = $indices;
		$data['indicesAnoAnterior'] = $indicesAnoAnterior;
		$data['anos'] = $anos; 
		$data['anosAnterior'] = $anosDosAnosAnteriores;
        $data['title'] = "Índices";
        $this->dashboard->show('relatorio-indices', $data);

	}

    public function analise($empId){
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
		$cnaeGeral = substr($cnae, 0, 4);

		$uf = $dadosEmpresa[0]->emp_uf;
		$qtdEmp = $dadosEmpresa[0]->emp_qtd_emp;

		$m1 = $qtdEmp - 50;
		$m2 = $qtdEmp + 50;

		$qtdEmpresasDoMesmoRamo = $this->EmpresaClienteModel->listaQtdEmpresasDoMesmoRamo($id, $uf, $cnae, $m1, $m2);

		//separa anos
		foreach($indices as $chave => $valor){
			$anos[$valor->COMP_ANO_ID] = $valor->COMP_ANO_ID;
		}

		//separa anos dos indices ano anterior
		foreach($indicesAnoAnterior as $chave => $valor){
			$anosDosAnosAnteriores[$valor->COMPANT_ANO_ID] = $valor->COMPANT_ANO_ID;
		}

		if(empty($anos)){
			redirect(base_url() . "indices/erronenhumdadocadastrado");
		}
		if(empty($qtdEmpresasDoMesmoRamo) || $qtdEmpresasDoMesmoRamo < 4){
			redirect(base_url() . "indices/erronaopossuiindicessuficientes");
		}

		//para cada ano; lista indices da empresa com o mesmo cnae, range de colaboradores e estado;
		//todos os arrays estão vazios no início desse laço de repetição.
		foreach ($anos as $chave => $ano) {
			$lis[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_LI');
			$lcs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_LC');
			$lss[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_LS');
			$lgs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_LG');
			$egs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_EG');
			$ges[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_GE');
			$ces[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_CE');
			$gis[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_GI');
			$irncs[$ano] = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_IRNC');
			$mafs[$ano]  = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_MAF');
			$mbs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_MB');
			$mos[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_MO');
			$mls[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMP_ML');
		}

		foreach ($anosDosAnosAnteriores as $chave => $ano) {
			$pmcs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMPANT_PMC');
			$pmes[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMPANT_PME');
			$pmps[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMPANT_PMP');
			$cos[$ano]    = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMPANT_CO');
			$cfs[$ano]    = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMPANT_CF');
			$gas[$ano]    = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMPANT_GA');
			$rsas[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMPANT_RSA');
			$rspls[$ano]  = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $uf, $m1, $m2, 'COMPANT_RSPL');
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
				$posicionamentoLi[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->LI, $quartilLi[$ano], 1);
				$posicionamentoLi[$ano]['VALOR'] = $indices[$i]->LI;
				$posicionamentoLi[$ano]['Q1'] = $quartilLi[$ano][0];
				$posicionamentoLi[$ano]['Q2'] = $quartilLi[$ano][1];
				$posicionamentoLi[$ano]['Q3'] = $quartilLi[$ano][2];
				$posicionamentoLi[$ano]['ind'] = "Li";
				$posicionamentoLi[$ano]['ano'] = $ano;
				unset($elementosLi);

			foreach ($lcs[$ano] as $lc) {
				$elementosLc[] = $lc->COMP_LC;
			}
				$quartilLc[$ano][0] = $this->quartil->getQuartilUm($elementosLc);
				$quartilLc[$ano][1] = $this->quartil->getQuartilDois($elementosLc);
				$quartilLc[$ano][2] = $this->quartil->getQuartilTres($elementosLc);
				$posicionamentoLc[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->LC, $quartilLc[$ano], 1);
				$posicionamentoLc[$ano]['VALOR'] = $indices[$i]->LC;
				$posicionamentoLc[$ano]['Q1'] = $quartilLc[$ano][0];
				$posicionamentoLc[$ano]['Q2'] = $quartilLc[$ano][1];
				$posicionamentoLc[$ano]['Q3'] = $quartilLc[$ano][2];
				$posicionamentoLc[$ano]['ind'] = "Lc";
				$posicionamentoLc[$ano]['ano'] = $ano;

				unset($elementosLc);
			
			foreach ($lss[$ano] as $ls) {
				$elementosLs[] = $ls->COMP_LS;
			}
				$quartilLs[$ano][0] = $this->quartil->getQuartilUm($elementosLs);
				$quartilLs[$ano][1] = $this->quartil->getQuartilDois($elementosLs);
				$quartilLs[$ano][2] = $this->quartil->getQuartilTres($elementosLs);
				$posicionamentoLs[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->LS, $quartilLs[$ano], 1);
				$posicionamentoLs[$ano]['VALOR'] = $indices[$i]->LS;
				$posicionamentoLs[$ano]['Q1'] = $quartilLs[$ano][0];
				$posicionamentoLs[$ano]['Q2'] = $quartilLs[$ano][1];
				$posicionamentoLs[$ano]['Q3'] = $quartilLs[$ano][2];
				$posicionamentoLs[$ano]['ind'] = "Ls";
				$posicionamentoLs[$ano]['ano'] = $ano;
				unset($elementosLs);

			foreach ($lgs[$ano] as $lg) {
				$elementosLg[] = $lg->COMP_LG;
			}
				$quartilLg[$ano][0] = $this->quartil->getQuartilUm($elementosLg);
				$quartilLg[$ano][1] = $this->quartil->getQuartilDois($elementosLg);
				$quartilLg[$ano][2] = $this->quartil->getQuartilTres($elementosLg);
				$posicionamentoLg[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->LG, $quartilLg[$ano], 1);
				$posicionamentoLg[$ano]['VALOR'] = $indices[$i]->LG;
				$posicionamentoLg[$ano]['Q1'] = $quartilLg[$ano][0];
				$posicionamentoLg[$ano]['Q2'] = $quartilLg[$ano][1];
				$posicionamentoLg[$ano]['Q3'] = $quartilLg[$ano][2];
				$posicionamentoLg[$ano]['ind'] = "Lg";
				$posicionamentoLg[$ano]['ano'] = $ano;
				unset($elementosLg);
		
			foreach ($egs[$ano] as $eg) {
				$elementosEg[] = $eg->COMP_EG;
			}
				$quartilEg[$ano][0] = $this->quartil->getQuartilUm($elementosEg);
				$quartilEg[$ano][1] = $this->quartil->getQuartilDois($elementosEg);
				$quartilEg[$ano][2] = $this->quartil->getQuartilTres($elementosEg);
				$posicionamentoEg[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->EG, $quartilEg[$ano], 2);
				$posicionamentoEg[$ano]['VALOR'] = $indices[$i]->EG . "%";
				$posicionamentoEg[$ano]['Q1'] = $quartilEg[$ano][0];
				$posicionamentoEg[$ano]['Q2'] = $quartilEg[$ano][1];
				$posicionamentoEg[$ano]['Q3'] = $quartilEg[$ano][2];
				$posicionamentoEg[$ano]['ind'] = "Eg";
				$posicionamentoEg[$ano]['ano'] = $ano;
				unset($elementosEg);
		
			foreach ($ges[$ano] as $ge) {
				$elementosGe[] = $ge->COMP_GE;
			}
				$quartilGe[$ano][0] = $this->quartil->getQuartilUm($elementosGe);
				$quartilGe[$ano][1] = $this->quartil->getQuartilDois($elementosGe);
				$quartilGe[$ano][2] = $this->quartil->getQuartilTres($elementosGe);
				$posicionamentoGe[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->GE, $quartilGe[$ano], 2);
				$posicionamentoGe[$ano]['VALOR'] = $indices[$i]->GE . "%";
				$posicionamentoGe[$ano]['Q1'] = $quartilGe[$ano][0];
				$posicionamentoGe[$ano]['Q2'] = $quartilGe[$ano][1];
				$posicionamentoGe[$ano]['Q3'] = $quartilGe[$ano][2];
				$posicionamentoGe[$ano]['ind'] = "Ge";
				$posicionamentoGe[$ano]['ano'] = $ano;
				unset($elementosGe);

			foreach ($ces[$ano] as $ce) {
				$elementosCe[] = $ce->COMP_CE;
			}
				$quartilCe[$ano][0] = $this->quartil->getQuartilUm($elementosCe);
				$quartilCe[$ano][1] = $this->quartil->getQuartilDois($elementosCe);
				$quartilCe[$ano][2] = $this->quartil->getQuartilTres($elementosCe);
				$posicionamentoCe[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->CE, $quartilCe[$ano], 2);
				$posicionamentoCe[$ano]['VALOR'] = $indices[$i]->CE . "%";
				$posicionamentoCe[$ano]['Q1'] = $quartilCe[$ano][0];
				$posicionamentoCe[$ano]['Q2'] = $quartilCe[$ano][1];
				$posicionamentoCe[$ano]['Q3'] = $quartilCe[$ano][2];
				$posicionamentoCe[$ano]['ind'] = "Ce";
				$posicionamentoCe[$ano]['ano'] = $ano;
				unset($elementosCe);

			foreach ($gis[$ano] as $gi) {
				$elementosGi[] = $gi->COMP_GI;
			}
				$quartilGi[$ano][0] = $this->quartil->getQuartilUm($elementosGi);
				$quartilGi[$ano][1] = $this->quartil->getQuartilDois($elementosGi);
				$quartilGi[$ano][2] = $this->quartil->getQuartilTres($elementosGi);
				$posicionamentoGi[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->GI, $quartilGi[$ano], 2);
				$posicionamentoGi[$ano]['VALOR'] = $indices[$i]->GI . "%";
				$posicionamentoGi[$ano]['Q1'] = $quartilGi[$ano][0];
				$posicionamentoGi[$ano]['Q2'] = $quartilGi[$ano][1];
				$posicionamentoGi[$ano]['Q3'] = $quartilGi[$ano][2];
				$posicionamentoGi[$ano]['ind'] = "Gi";
				$posicionamentoGi[$ano]['ano'] = $ano;
				unset($elementosGi);
		
			foreach ($irncs[$ano] as $irnc) {
				$elementosIrnc[] = $irnc->COMP_IRNC;
			}
				$quartilIrnc[$ano][0] = $this->quartil->getQuartilUm($elementosIrnc);
				$quartilIrnc[$ano][1] = $this->quartil->getQuartilDois($elementosIrnc);
				$quartilIrnc[$ano][2] = $this->quartil->getQuartilTres($elementosIrnc);
				$posicionamentoIrnc[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->IRNC, $quartilIrnc[$ano], 2);
				$posicionamentoIrnc[$ano]['VALOR'] = $indices[$i]->IRNC . "%";
				$posicionamentoIrnc[$ano]['Q1'] = $quartilIrnc[$ano][0];
				$posicionamentoIrnc[$ano]['Q2'] = $quartilIrnc[$ano][1];
				$posicionamentoIrnc[$ano]['Q3'] = $quartilIrnc[$ano][2];
				$posicionamentoIrnc[$ano]['ind'] = "Irnc";
				$posicionamentoIrnc[$ano]['ano'] = $ano;
				unset($elementosIrnc);

			foreach ($mafs[$ano] as $maf) {
				$elementosMaf[] = $maf->COMP_MAF;
			}
				$quartilMaf[$ano][0] = $this->quartil->getQuartilUm($elementosMaf);
				$quartilMaf[$ano][1] = $this->quartil->getQuartilDois($elementosMaf);
				$quartilMaf[$ano][2] = $this->quartil->getQuartilTres($elementosMaf);
				$posicionamentoMaf[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->MAF, $quartilMaf[$ano], 1);
				$posicionamentoMaf[$ano]['VALOR'] = $indices[$i]->MAF;
				$posicionamentoMaf[$ano]['Q1'] = $quartilMaf[$ano][0];
				$posicionamentoMaf[$ano]['Q2'] = $quartilMaf[$ano][1];
				$posicionamentoMaf[$ano]['Q3'] = $quartilMaf[$ano][2];
				$posicionamentoMaf[$ano]['ind'] = "Maf";
				$posicionamentoMaf[$ano]['ano'] = $ano;
				unset($elementosMaf);

			foreach ($mbs[$ano] as $mb) {
				$elementosMb[] = $mb->COMP_MB;
			}
				$quartilMb[$ano][0] = $this->quartil->getQuartilUm($elementosMb);
				$quartilMb[$ano][1] = $this->quartil->getQuartilDois($elementosMb);
				$quartilMb[$ano][2] = $this->quartil->getQuartilTres($elementosMb);
				$posicionamentoMb[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->MB, $quartilMb[$ano], 1);
				$posicionamentoMb[$ano]['VALOR'] = $indices[$i]->MB;
				$posicionamentoMb[$ano]['Q1'] = $quartilMb[$ano][0];
				$posicionamentoMb[$ano]['Q2'] = $quartilMb[$ano][1];
				$posicionamentoMb[$ano]['Q3'] = $quartilMb[$ano][2];
				$posicionamentoMb[$ano]['ind'] = "Mb";
				$posicionamentoMb[$ano]['ano'] = $ano;
				unset($elementosMb);
		
			foreach ($mos[$ano] as $mo) {
				$elementosMo[] = $mo->COMP_MO;
			}
				$quartilMo[$ano][0] = $this->quartil->getQuartilUm($elementosMo);
				$quartilMo[$ano][1] = $this->quartil->getQuartilDois($elementosMo);
				$quartilMo[$ano][2] = $this->quartil->getQuartilTres($elementosMo);
				$posicionamentoMo[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->MO, $quartilMo[$ano], 1);
				$posicionamentoMo[$ano]['VALOR'] = $indices[$i]->MO;
				$posicionamentoMo[$ano]['Q1'] = $quartilMo[$ano][0];
				$posicionamentoMo[$ano]['Q2'] = $quartilMo[$ano][1];
				$posicionamentoMo[$ano]['Q3'] = $quartilMo[$ano][2];
				$posicionamentoMo[$ano]['ind'] = "Mo";
				$posicionamentoMo[$ano]['ano'] = $ano;
				unset($elementosMo);

			foreach ($mls[$ano] as $ml) {
				$elementosMl[] = $ml->COMP_ML;
			}
				$quartilMl[$ano][0] = $this->quartil->getQuartilUm($elementosMl);
				$quartilMl[$ano][1] = $this->quartil->getQuartilDois($elementosMl);
				$quartilMl[$ano][2] = $this->quartil->getQuartilTres($elementosMl);
				$posicionamentoMl[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->ML, $quartilMl[$ano], 1);
				$posicionamentoMl[$ano]['VALOR'] = $indices[$i]->ML;
				$posicionamentoMl[$ano]['Q1'] = $quartilMl[$ano][0];
				$posicionamentoMl[$ano]['Q2'] = $quartilMl[$ano][1];
				$posicionamentoMl[$ano]['Q3'] = $quartilMl[$ano][2];
				$posicionamentoMl[$ano]['ind'] = "Ml";
				$posicionamentoMl[$ano]['ano'] = $ano;
				unset($elementosMl);

		 $i++;
		}

		$j=0;
		foreach ($anosDosAnosAnteriores as $anoA){
			foreach ($pmcs[$anoA] as $pmc) {
				$elementosPmc[] = $pmc->COMPANT_PMC;
			}
				$quartilPmc[$anoA][0] = $this->quartil->getQuartilUm($elementosPmc);
				$quartilPmc[$anoA][1] = $this->quartil->getQuartilDois($elementosPmc);
				$quartilPmc[$anoA][2] = $this->quartil->getQuartilTres($elementosPmc);
				$posicionamentoPmc[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->PMC, $quartilPmc[$anoA], 2);
				$posicionamentoPmc[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->PMC;
				$posicionamentoPmc[$anoA]['Q1'] = $quartilPmc[$anoA][0];
				$posicionamentoPmc[$anoA]['Q2'] = $quartilPmc[$anoA][1];
				$posicionamentoPmc[$anoA]['Q3'] = $quartilPmc[$anoA][2];
				$posicionamentoPmc[$anoA]['ind'] = "Pmc";
				$posicionamentoPmc[$anoA]['ano'] = $anoA;
				unset($elementosPmc);
		
			foreach ($pmes[$anoA] as $pme) {
				$elementosPme[] = $pme->COMPANT_PME;
			}
				$quartilPme[$anoA][0] = $this->quartil->getQuartilUm($elementosPme);
				$quartilPme[$anoA][1] = $this->quartil->getQuartilDois($elementosPme);
				$quartilPme[$anoA][2] = $this->quartil->getQuartilTres($elementosPme);
				$posicionamentoPme[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->PME, $quartilPme[$anoA], 2);
				$posicionamentoPme[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->PME;
				$posicionamentoPme[$anoA]['Q1'] = $quartilPme[$anoA][0];
				$posicionamentoPme[$anoA]['Q2'] = $quartilPme[$anoA][1];
				$posicionamentoPme[$anoA]['Q3'] = $quartilPme[$anoA][2];
				$posicionamentoPme[$anoA]['ind'] = "Pme";
				$posicionamentoPme[$anoA]['ano'] = $anoA;
				unset($elementosPme);
			
			foreach ($pmps[$anoA] as $pmp) {
				$elementosPmp[] = $pmp->COMPANT_PMP;
			}
				$quartilPmp[$anoA][0] = $this->quartil->getQuartilUm($elementosPmp);
				$quartilPmp[$anoA][1] = $this->quartil->getQuartilDois($elementosPmp);
				$quartilPmp[$anoA][2] = $this->quartil->getQuartilTres($elementosPmp);
				$posicionamentoPmp[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->PMP, $quartilPmp[$anoA], 1);
				$posicionamentoPmp[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->PMP;
				$posicionamentoPmp[$anoA]['Q1'] = $quartilPmp[$anoA][0];
				$posicionamentoPmp[$anoA]['Q2'] = $quartilPmp[$anoA][1];
				$posicionamentoPmp[$anoA]['Q3'] = $quartilPmp[$anoA][2];
				$posicionamentoPmp[$anoA]['ind'] = "Pmp";
				$posicionamentoPmp[$anoA]['ano'] = $anoA;
				unset($elementosPmp);
			
			foreach ($cos[$anoA] as $co) {
				$elementosCo[] = $co->COMPANT_CO;
			}
				$quartilCo[$anoA][0] = $this->quartil->getQuartilUm($elementosCo);
				$quartilCo[$anoA][1] = $this->quartil->getQuartilDois($elementosCo);
				$quartilCo[$anoA][2] = $this->quartil->getQuartilTres($elementosCo);
				$posicionamentoCo[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->CO, $quartilCo[$anoA], 2);
				$posicionamentoCo[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->CO;
				$posicionamentoCo[$anoA]['Q1'] = $quartilCo[$anoA][0];
				$posicionamentoCo[$anoA]['Q2'] = $quartilCo[$anoA][1];
				$posicionamentoCo[$anoA]['Q3'] = $quartilCo[$anoA][2];
				$posicionamentoCo[$anoA]['ind'] = "Co";
				$posicionamentoCo[$anoA]['ano'] = $anoA;
				unset($elementosCo);

			foreach ($cfs[$anoA] as $cf) {
				$elementosCf[] = $cf->COMPANT_CF;
			}
				$quartilCf[$anoA][0] = $this->quartil->getQuartilUm($elementosCf);
				$quartilCf[$anoA][1] = $this->quartil->getQuartilDois($elementosCf);
				$quartilCf[$anoA][2] = $this->quartil->getQuartilTres($elementosCf);
				$posicionamentoCf[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->CF, $quartilCf[$anoA], 1);
				$posicionamentoCf[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->CF;
				$posicionamentoCf[$anoA]['Q1'] = $quartilCf[$anoA][0];
				$posicionamentoCf[$anoA]['Q2'] = $quartilCf[$anoA][1];
				$posicionamentoCf[$anoA]['Q3'] = $quartilCf[$anoA][2];
				$posicionamentoCf[$anoA]['ind'] = "Cf";
				$posicionamentoCf[$anoA]['ano'] = $anoA;
				unset($elementosCf);

			foreach ($gas[$anoA] as $ga) {
				$elementosGa[] = $ga->COMPANT_GA;
			}
				$quartilGa[$anoA][0] = $this->quartil->getQuartilUm($elementosGa);
				$quartilGa[$anoA][1] = $this->quartil->getQuartilDois($elementosGa);
				$quartilGa[$anoA][2] = $this->quartil->getQuartilTres($elementosGa);
				$posicionamentoGa[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->GA, $quartilGa[$anoA], 1);
				$posicionamentoGa[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->GA;
				$posicionamentoGa[$anoA]['Q1'] = $quartilGa[$anoA][0];
				$posicionamentoGa[$anoA]['Q2'] = $quartilGa[$anoA][1];
				$posicionamentoGa[$anoA]['Q3'] = $quartilGa[$anoA][2];
				$posicionamentoGa[$anoA]['ind'] = "Ga";
				$posicionamentoGa[$anoA]['ano'] = $anoA;
				unset($elementosGa);

			foreach ($rsas[$anoA] as $rsa) {
				$elementosRsa[] = $rsa->COMPANT_RSA;
			}
				$quartilRsa[$anoA][0] = $this->quartil->getQuartilUm($elementosRsa);
				$quartilRsa[$anoA][1] = $this->quartil->getQuartilDois($elementosRsa);
				$quartilRsa[$anoA][2] = $this->quartil->getQuartilTres($elementosRsa);
				$posicionamentoRsa[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->RSA, $quartilRsa[$anoA], 1);
				$posicionamentoRsa[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->RSA;
				$posicionamentoRsa[$anoA]['Q1'] = $quartilRsa[$anoA][0];
				$posicionamentoRsa[$anoA]['Q2'] = $quartilRsa[$anoA][1];
				$posicionamentoRsa[$anoA]['Q3'] = $quartilRsa[$anoA][2];
				$posicionamentoRsa[$anoA]['ind'] = "Rsa";
				$posicionamentoRsa[$anoA]['ano'] = $anoA;
				unset($elementosRsa);

			foreach ($rspls[$anoA] as $rspl) {
			$elementosRspl[] = $rspl->COMPANT_RSPL;
			}
				$quartilRspl[$anoA][0] = $this->quartil->getQuartilUm($elementosRspl);
				$quartilRspl[$anoA][1] = $this->quartil->getQuartilDois($elementosRspl);
				$quartilRspl[$anoA][2] = $this->quartil->getQuartilTres($elementosRspl);
				$posicionamentoRspl[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->RSPL, $quartilRspl[$anoA], 1);
				$posicionamentoRspl[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->RSPL;
				$posicionamentoRspl[$anoA]['Q1'] = $quartilRspl[$anoA][0];
				$posicionamentoRspl[$anoA]['Q2'] = $quartilRspl[$anoA][1];
				$posicionamentoRspl[$anoA]['Q3'] = $quartilRspl[$anoA][2];
				$posicionamentoRspl[$anoA]['ind'] = "Rspl";
				$posicionamentoRspl[$anoA]['ano'] = $anoA;
				unset($elementosRspl);
			
			
			$j++;
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

		$posicionamentoAnoAnterior['PMC'] = $posicionamentoPmc;
		$posicionamentoAnoAnterior['PME'] = $posicionamentoPme;
		$posicionamentoAnoAnterior['PMP'] = $posicionamentoPmp;
		$posicionamentoAnoAnterior['CO'] = $posicionamentoCo;
		$posicionamentoAnoAnterior['CF'] = $posicionamentoCf;
		$posicionamentoAnoAnterior['GA'] = $posicionamentoGa;
		$posicionamentoAnoAnterior['RSA'] = $posicionamentoRsa;
		$posicionamentoAnoAnterior['RSPL'] = $posicionamentoRspl;

		$data['tituloGrafico'] = "DESEMPENHO DOS ÍNDICES";
		$data['uf'] = $uf;
		$data['empresa'] = $dadosEmpresa[0]->emp_nome;
		$data['cnae'] = $cnaeGeral;
		$data['indicesComparados'] = $qtdEmpresasDoMesmoRamo;
		$data['indices'] = $indices;
		$data['anos'] = $anos; 
		$data['anosAnterior'] = $anosDosAnosAnteriores;
		$data['comparativos'] = $posicionamento;
		$data['comparativosAnoAnterior'] = $posicionamentoAnoAnterior;
        $data['title'] = "Índices";
        $this->dashboard->show('relatorio-analise', $data);
	}

	/*
	1 Para índices quanto maior melhor
	Qualquer outro número quanto menor melhor
	*/
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

	 public function erroNenhumDadoCadastrado(){
		$data['title'] = "Erro";
		$this->dashboard->show('erro-nenhum-dado-cadastrado', $data);
	 }
	
	 public function erroNaoPossuiIndicesSuficientes(){
		$data['title'] = "Erro";
		$this->dashboard->show('erro-nao-possui-indices-suficientes', $data);
	 }
}   