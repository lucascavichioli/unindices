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
		$cnaeGeral = substr($cnae, 0, 4);

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
			$anosDosAnosAnteriores[$valor->COMPANT_ANO_ID] = $valor->COMPANT_ANO_ID;
		}

		if(empty($anos)){
			die("Não possui nenhum dado cadastrado");
		}

		//para cada ano; lista indices da empresa com o mesmo cnae, range de colaboradores e estado;
		//todos os arrays estão vazios no início desse laço de repetição.
		foreach ($anos as $chave => $ano) {
			$lis[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_LI');
			$lcs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_LC');
			$lss[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_LS');
			$lgs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_LG');
			$egs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_EG');
			$ges[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_GE');
			$ces[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_CE');
			$gis[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_GI');
			$irncs[$ano] = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_IRNC');
			$mafs[$ano]  = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_MAF');
			$mbs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_MB');
			$mos[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_MO');
			$mls[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupo($id, $ano, $cnaeGeral, $m1, $m2, 'COMP_ML');
		}

		foreach ($anosDosAnosAnteriores as $chave => $ano) {
			$pmcs[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $m1, $m2, 'COMPANT_PMC');
			$pmes[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $m1, $m2, 'COMPANT_PME');
			$pmps[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $m1, $m2, 'COMPANT_PMP');
			$cos[$ano]    = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $m1, $m2, 'COMPANT_CO');
			$cfs[$ano]    = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $m1, $m2, 'COMPANT_CF');
			$gas[$ano]    = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $m1, $m2, 'COMPANT_GA');
			$rsas[$ano]   = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $m1, $m2, 'COMPANT_RSA');
			$rspls[$ano]  = $this->IndicesModel->listaDeIndicesDoMesmoGrupoAnoAnterior($id, $ano, $cnaeGeral, $m1, $m2, 'COMPANT_RSPL');
		}	
		
		$quantidadeIndices = count($lis);
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
				$posicionamentoEg[$ano]['VALOR'] = $indices[$i]->COMP_EG . "%";
				unset($elementosEg);
		
			foreach ($ges[$ano] as $ge) {
				$elementosGe[] = $ge->COMP_GE;
			}
				$quartilGe[$ano][0] = $this->quartil->getQuartilUm($elementosGe);
				$quartilGe[$ano][1] = $this->quartil->getQuartilDois($elementosGe);
				$quartilGe[$ano][2] = $this->quartil->getQuartilTres($elementosGe);
				$posicionamentoGe[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_GE, $quartilGe[$ano], 2);
				$posicionamentoGe[$ano]['VALOR'] = $indices[$i]->COMP_GE . "%";
				unset($elementosGe);

			foreach ($ces[$ano] as $ce) {
				$elementosCe[] = $ce->COMP_CE;
			}
				$quartilCe[$ano][0] = $this->quartil->getQuartilUm($elementosCe);
				$quartilCe[$ano][1] = $this->quartil->getQuartilDois($elementosCe);
				$quartilCe[$ano][2] = $this->quartil->getQuartilTres($elementosCe);
				$posicionamentoCe[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_CE, $quartilCe[$ano], 2);
				$posicionamentoCe[$ano]['VALOR'] = $indices[$i]->COMP_CE . "%";
				unset($elementosCe);

			foreach ($gis[$ano] as $gi) {
				$elementosGi[] = $gi->COMP_GI;
			}
				$quartilGi[$ano][0] = $this->quartil->getQuartilUm($elementosGi);
				$quartilGi[$ano][1] = $this->quartil->getQuartilDois($elementosGi);
				$quartilGi[$ano][2] = $this->quartil->getQuartilTres($elementosGi);
				$posicionamentoGi[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_GI, $quartilGi[$ano], 2);
				$posicionamentoGi[$ano]['VALOR'] = $indices[$i]->COMP_GI . "%";
				unset($elementosGi);
		
			foreach ($irncs[$ano] as $irnc) {
				$elementosIrnc[] = $irnc->COMP_IRNC;
			}
				$quartilIrnc[$ano][0] = $this->quartil->getQuartilUm($elementosIrnc);
				$quartilIrnc[$ano][1] = $this->quartil->getQuartilDois($elementosIrnc);
				$quartilIrnc[$ano][2] = $this->quartil->getQuartilTres($elementosIrnc);
				$posicionamentoIrnc[$ano]['POSICIONAMENTO'] = $this->getPosicionamento($indices[$i]->COMP_IRNC, $quartilIrnc[$ano], 2);
				$posicionamentoIrnc[$ano]['VALOR'] = $indices[$i]->COMP_IRNC . "%";
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

		$j=0;
		foreach ($anosDosAnosAnteriores as $anoA){
			foreach ($pmcs[$anoA] as $pmc) {
				$elementosPmc[] = $pmc->COMPANT_PMC;
			}
				$quartilPmc[$anoA][0] = $this->quartil->getQuartilUm($elementosPmc);
				$quartilPmc[$anoA][1] = $this->quartil->getQuartilDois($elementosPmc);
				$quartilPmc[$anoA][2] = $this->quartil->getQuartilTres($elementosPmc);
				$posicionamentoPmc[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->COMPANT_PMC, $quartilPmc[$anoA], 2);
				$posicionamentoPmc[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->COMPANT_PMC;
				unset($elementosPmc);
		
			foreach ($pmes[$anoA] as $pme) {
				$elementosPme[] = $pme->COMPANT_PME;
			}
				$quartilPme[$anoA][0] = $this->quartil->getQuartilUm($elementosPme);
				$quartilPme[$anoA][1] = $this->quartil->getQuartilDois($elementosPme);
				$quartilPme[$anoA][2] = $this->quartil->getQuartilTres($elementosPme);
				$posicionamentoPme[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->COMPANT_PME, $quartilPme[$anoA], 2);
				$posicionamentoPme[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->COMPANT_PME;
				unset($elementosPme);
			
			foreach ($pmps[$anoA] as $pmp) {
				$elementosPmp[] = $pmp->COMPANT_PMP;
			}
				$quartilPmp[$anoA][0] = $this->quartil->getQuartilUm($elementosPmp);
				$quartilPmp[$anoA][1] = $this->quartil->getQuartilDois($elementosPmp);
				$quartilPmp[$anoA][2] = $this->quartil->getQuartilTres($elementosPmp);
				$posicionamentoPmp[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->COMPANT_PMP, $quartilPmp[$anoA], 1);
				$posicionamentoPmp[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->COMPANT_PMP;
				unset($elementosPmp);
			
			foreach ($cos[$anoA] as $co) {
				$elementosCo[] = $co->COMPANT_CO;
			}
				$quartilCo[$anoA][0] = $this->quartil->getQuartilUm($elementosCo);
				$quartilCo[$anoA][1] = $this->quartil->getQuartilDois($elementosCo);
				$quartilCo[$anoA][2] = $this->quartil->getQuartilTres($elementosCo);
				$posicionamentoCo[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->COMPANT_CO, $quartilCo[$anoA], 2);
				$posicionamentoCo[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->COMPANT_CO;
				unset($elementosCo);

			foreach ($cfs[$anoA] as $cf) {
				$elementosCf[] = $cf->COMPANT_CF;
			}
				$quartilCf[$anoA][0] = $this->quartil->getQuartilUm($elementosCf);
				$quartilCf[$anoA][1] = $this->quartil->getQuartilDois($elementosCf);
				$quartilCf[$anoA][2] = $this->quartil->getQuartilTres($elementosCf);
				$posicionamentoCf[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->COMPANT_CF, $quartilCf[$anoA], 1);
				$posicionamentoCf[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->COMPANT_CF;
				unset($elementosCf);

			foreach ($gas[$anoA] as $ga) {
				$elementosGa[] = $ga->COMPANT_GA;
			}
				$quartilGa[$anoA][0] = $this->quartil->getQuartilUm($elementosGa);
				$quartilGa[$anoA][1] = $this->quartil->getQuartilDois($elementosGa);
				$quartilGa[$anoA][2] = $this->quartil->getQuartilTres($elementosGa);
				$posicionamentoGa[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->COMPANT_GA, $quartilGa[$anoA], 1);
				$posicionamentoGa[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->COMPANT_GA;
				unset($elementosGa);

			foreach ($rsas[$anoA] as $rsa) {
				$elementosRsa[] = $rsa->COMPANT_RSA;
			}
				$quartilRsa[$anoA][0] = $this->quartil->getQuartilUm($elementosRsa);
				$quartilRsa[$anoA][1] = $this->quartil->getQuartilDois($elementosRsa);
				$quartilRsa[$anoA][2] = $this->quartil->getQuartilTres($elementosRsa);
				$posicionamentoRsa[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->COMPANT_RSA, $quartilRsa[$anoA], 1);
				$posicionamentoRsa[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->COMPANT_RSA;
				unset($elementosRsa);

			foreach ($rspls[$anoA] as $rspl) {
			$elementosRspl[] = $rspl->COMPANT_RSPL;
			}
				$quartilRspl[$anoA][0] = $this->quartil->getQuartilUm($elementosRspl);
				$quartilRspl[$anoA][1] = $this->quartil->getQuartilDois($elementosRspl);
				$quartilRspl[$anoA][2] = $this->quartil->getQuartilTres($elementosRspl);
				$posicionamentoRspl[$anoA]['POSICIONAMENTO'] = $this->getPosicionamento($indicesAnoAnterior[$j]->COMPANT_RSPL, $quartilRspl[$anoA], 1);
				$posicionamentoRspl[$anoA]['VALOR'] = $indicesAnoAnterior[$j]->COMPANT_RSPL;
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
		$data['indicesComparados'] = $quantidadeIndices;
		$data['indices'] = $indices;
		$data['anos'] = $anos; 
		$data['anosAnterior'] = $anosDosAnosAnteriores;
		$data['comparativos'] = $posicionamento;
		$data['comparativosAnoAnterior'] = $posicionamentoAnoAnterior;
        $data['title'] = "Índices";
        $this->dashboard->show('relatorio-indices', $data);
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
	
}   