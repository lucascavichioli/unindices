<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IndicesEconomicos {

    private $li;
    private $lc;
    private $ls;
    private $lg;
    private $eg;
    private $ge;
    private $ce;
    private $gi;
    private $irnc;
    private $maf;
    private $pmc;
    private $pme;
    private $pmp;
    private $co;
    private $cf;
    private $ga;
    private $mb;
    private $mo;
    private $ml;
    private $rsa;
    private $rspl;


    public function duasCasasDecimais($valor){
        $v = intval(strval($valor * 100)) / 100;
        return $v;
    }

    public function li($caixa_equi_cai, $pas_circulante){
        $li = $caixa_equi_cai / $pas_circulante;
        $this->li = $this->duasCasasDecimais($li);
        return $this->li;
    }

    public function lc($atv_circulante, $pas_circulante){
        $lc = $atv_circulante / $pas_circulante;
        $this->lc = $this->duasCasasDecimais($lc);
        return $this->lc;
    }

    public function ls($atv_circulante, $estoque, $pas_circulante){
        $ls = ($atv_circulante - $estoque) / $pas_circulante;
        $this->ls = $this->duasCasasDecimais($ls);
        return $this->ls;
    }

    public function lg($atv_circulante, $atv_realizavel_longo_prazo, $pas_circulante, $pas_nao_circulante){
        $lg = ($atv_circulante + $atv_realizavel_longo_prazo) / ($pas_circulante + $pas_nao_circulante);
        $this->lg = $this->duasCasasDecimais($lg);
        return $this->lg;
    }

    public function eg($pas_circulante, $pas_nao_circulante, $pas_total){
        $eg = ($pas_circulante + $pas_nao_circulante) / $pas_total * 100;
        $this->eg = $this->duasCasasDecimais($eg);
        return $this->eg;
    }

    public function ge($pas_circulante, $pas_nao_circulante, $patrimonio_liquido){
        $ge = ($pas_circulante + $pas_nao_circulante) / $patrimonio_liquido * 100;
        $this->ge = $this->duasCasasDecimais($ge);
        return $this->ge;
    }

    public function ce($pas_circulante, $pas_nao_circulante){
        $ce = $pas_circulante / ($pas_circulante + $pas_nao_circulante) * 100;
        $this->ce = $this->duasCasasDecimais($ce);
        return $this->ce;
    }

    public function gi($investimentos, $imobilizado_intangivel, $patrimonio_liquido){
        $gi = ($investimentos + $imobilizado_intangivel) / $patrimonio_liquido * 100;
        $this->gi = $this->duasCasasDecimais($gi);
        return $this->gi;
    }

    public function irnc($investimentos, $imobilizado_intangivel, $pas_nao_circulante, $patrimonio_liquido){
        $irnc = ($investimentos + $imobilizado_intangivel) / ($pas_nao_circulante + $patrimonio_liquido) * 100;
        $this->irnc = $this->duasCasasDecimais($irnc);
        return $this->irnc;
    }

    public function maf($pas_total, $patrimonio_liquido){
        $maf = $pas_total / $patrimonio_liquido;
        $this->maf = $this->duasCasasDecimais($maf);
        return $this->maf;
    }

    //*
    public function pmc($clientes_ano_um, $clientes_ano_dois, $receita_liq_vendas){
        $pmc = ((($clientes_ano_um)+($clientes_ano_dois))/2) / ($receita_liq_vendas / 360);
        $this->pmc = $this->duasCasasDecimais($pmc);
        return $this->pmc;
    } 

    //*
    public function pme($estoque_ano_um, $estoque_ano_dois, $custo_vendas){
        $pme = ((($estoque_ano_um)+($estoque_ano_dois)) / 2) / ($custo_vendas / 360);
        $this->pme = $this->duasCasasDecimais($pme);
        return $this->pme;
    }

    //*
    public function pmp($fornecedores_ano_um, $fornecedores_ano_dois, 
                        $custo_vendas, $estoque_ano_um, $estoque_ano_dois){
        $pmp = ((($fornecedores_ano_um)+($fornecedores_ano_dois)) / 2) / (($custo_vendas+$estoque_ano_dois - $estoque_ano_um)/360);
        $this->pmp = $this->duasCasasDecimais($pmp);
        return $this->pmp;
    }

    //*
    public function co($pmc, $pme){
        $co = $pmc + $pme;
        $this->co = $this->duasCasasDecimais($co);
        return $this->co;
    }

    //*
    public function cf($co, $pmp){
        $cf = $co - $pmp;
        $this->cf = $this->duasCasasDecimais($cf);
        return $cf;
    }

    //*
    public function ga($receita_liq_vendas, $atv_total_ano_um, $atv_total_ano_dois){
        $ga = $receita_liq_vendas / (($atv_total_ano_um + $atv_total_ano_dois) / 2);
        $this->ga = $this->duasCasasDecimais($ga);
        return $this->ga;
    }

    public function mb($lucro_bruto, $receita_liq_vendas){
        $mb = $lucro_bruto/$receita_liq_vendas * 100;
        $this->mb = $this->duasCasasDecimais($mb);
        return $this->mb;
    }

    public function mo($resultado_operacional, $receita_liq_vendas){
        $mo = $resultado_operacional / $receita_liq_vendas * 100;
        $this->mo = $this->duasCasasDecimais($mo);
        return $this->mo;
    }

    public function ml($resultado_liq_exercicio, $receita_liq_vendas){
        $ml = $resultado_liq_exercicio / $receita_liq_vendas * 100;
        $this->ml = $this->duasCasasDecimais($ml);
        return $this->ml;
    }

    //*
    public function rsa($ml, $ga){
        $rsa = $ml * $ga;
        $this->rsa = $this->duasCasasDecimais($rsa);
        return $this->rsa;
    }

    //*
    public function rspl($rsa, $maf){
        $rspl = $rsa * $maf;
        $this->rspl = $this->duasCasasDecimais($rspl);
        return $this->rspl;
    }

}
