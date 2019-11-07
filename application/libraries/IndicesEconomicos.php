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

    private function ehZero($valor){
        if($valor == 0){
            return true;
        }
        return false;
    }

    public function duasCasasDecimais($valor){
        $v = round($valor, 2);
        //$v = intval(strval($valor * 100)) / 100;
        return $v;
    }

    public function li($caixa_equi_cai, $pas_circulante){
        if($this->ehZero($caixa_equi_cai)){$caixa_equi_cai = 1;}
        if($this->ehZero($pas_circulante)){$pas_circulante = 1;}
            $this->li = $caixa_equi_cai / $pas_circulante;
            return $this->li;
    }

    public function lc($atv_circulante, $pas_circulante){
        if($this->ehZero($atv_circulante)){$atv_circulante = 1;}
        if($this->ehZero($pas_circulante)){$pas_circulante = 1;}
        $this->lc = $atv_circulante / $pas_circulante;
        return $this->lc;
    }

    public function ls($atv_circulante, $estoque, $pas_circulante){
        if($this->ehZero($pas_circulante)){$pas_circulante = 1;}
        $this->ls = ($atv_circulante - $estoque) / $pas_circulante;
        return $this->ls;
    }

    public function lg($atv_circulante, $atv_realizavel_longo_prazo, $pas_circulante, $pas_nao_circulante){
        if($this->ehZero($pas_nao_circulante)){$pas_nao_circulante = 1;}
        $this->lg = ($atv_circulante + $atv_realizavel_longo_prazo) / ($pas_circulante + $pas_nao_circulante);
        return $this->lg;
    }

    public function eg($pas_circulante, $pas_nao_circulante, $pas_total){
        if($this->ehZero($pas_total)){$pas_total = 1;}
        $this->eg = ($pas_circulante + $pas_nao_circulante) / $pas_total * 100;
        return $this->eg;
    }

    public function ge($pas_circulante, $pas_nao_circulante, $patrimonio_liquido){
        if($this->ehZero($patrimonio_liquido)){$patrimonio_liquido = 1;}
        $this->ge = ($pas_circulante + $pas_nao_circulante) / $patrimonio_liquido * 100;
        return $this->ge;
    }

    public function ce($pas_circulante, $pas_nao_circulante){
        if($this->ehZero($pas_circulante)){$pas_circulante = 1;}
        $this->ce = $pas_circulante / ($pas_circulante + $pas_nao_circulante) * 100; 
        return $this->ce;
    }

    public function gi($investimentos, $imobilizado_intangivel, $patrimonio_liquido){
        if($this->ehZero($patrimonio_liquido)){$patrimonio_liquido = 1;}
        $this->gi = ($investimentos + $imobilizado_intangivel) / $patrimonio_liquido * 100;
        return $this->gi;
    }

    public function irnc($investimentos, $imobilizado_intangivel, $pas_nao_circulante, $patrimonio_liquido){
        if($this->ehZero($pas_nao_circulante)){$pas_nao_circulante = 1;}
        $this->irnc = ($investimentos + $imobilizado_intangivel) / ($pas_nao_circulante + $patrimonio_liquido) * 100;
        return $this->irnc;
    }

    public function maf($pas_total, $patrimonio_liquido){
        if($this->ehZero($patrimonio_liquido)){$patrimonio_liquido = 1;}
        $this->maf = $pas_total / $patrimonio_liquido;
        return $this->maf;
    }

    //*
    public function pmc($clientes_ano_um, $clientes_ano_dois, $receita_liq_vendas){
        if($this->ehZero($receita_liq_vendas)){$receita_liq_vendas = 1;}
        $this->pmc = ((($clientes_ano_um)+($clientes_ano_dois))/2) / ($receita_liq_vendas / 360);
        return $this->pmc;
    } 

    //*
    public function pme($estoque_ano_um, $estoque_ano_dois, $custo_vendas){
        if($this->ehZero($custo_vendas)){$custo_vendas = 1;}
        $this->pme = ((($estoque_ano_um)+($estoque_ano_dois)) / 2) / ($custo_vendas / 360);
        return $this->pme;
    }

    //*
    public function pmp($fornecedores_ano_um, $fornecedores_ano_dois, 
                        $custo_vendas, $estoque_ano_um, $estoque_ano_dois){
        if($this->ehZero($custo_vendas)){$custo_vendas = 1;}
        $this->pmp = ((($fornecedores_ano_um)+($fornecedores_ano_dois)) / 2) / (($custo_vendas+$estoque_ano_dois - $estoque_ano_um)/360);
        return $this->pmp;
    }

    //*
    public function co($pmc, $pme){
        $this->co = $pmc + $pme;
        return $this->co;
    }

    //*
    public function cf($co, $pmp){
        $this->cf = $co - $pmp;
        return $cf;
    }

    //*
    public function ga($receita_liq_vendas, $atv_total_ano_um, $atv_total_ano_dois){
        if($this->ehZero($atv_total_ano_um)){$atv_total_ano_um = 1;}
        $this->ga = $receita_liq_vendas / (($atv_total_ano_um + $atv_total_ano_dois) / 2);
        return $this->ga;
    }

    public function mb($lucro_bruto, $receita_liq_vendas){
        if($this->ehZero($receita_liq_vendas)){$receita_liq_vendas = 1;}
        $this->mb = $lucro_bruto/$receita_liq_vendas * 100;
        return $this->mb;
    }

    public function mo($resultado_operacional, $receita_liq_vendas){
        if($this->ehZero($receita_liq_vendas)){$receita_liq_vendas = 1;}
        $this->mo = $resultado_operacional / $receita_liq_vendas * 100;
        return $this->mo;
    }

    public function ml($resultado_liq_exercicio, $receita_liq_vendas){
        if($this->ehZero($receita_liq_vendas)){$receita_liq_vendas = 1;}
        $this->ml = $resultado_liq_exercicio / $receita_liq_vendas * 100;
        return $this->ml;
    }

    //*
    public function rsa($ml, $ga){
        $this->rsa = $ml * $ga;
        return $this->rsa;
    }

    //*
    public function rspl($rsa, $maf){
        $this->rspl = $rsa * $maf;
        return $this->rspl;
    }

}
