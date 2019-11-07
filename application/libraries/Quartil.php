<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quartil {
    private $qUm;
    private $qDois;
    private $qTres;

    //$e = array(7.1, 7.4, 7.5, 7.7, 7.8, 7.9);

    private function calculaQuartil($elementos, $q){

        sort($elementos);
        
        $qtdElementos = count($elementos);
        
        $x = ($q*($qtdElementos + 1)) / 4;
        $posicao = floor($x);

        if($posicao < 1){
            $posicao = 1;  
        }

        $posicaoArray = $posicao -1;

        $n = $x - $posicao;

        $var = $elementos[$posicaoArray+1] - $elementos[$posicaoArray];

        $quartil = $elementos[$posicaoArray] + $n * $var;

        return $quartil;
    
    }

    public function getQuartilUm($e){
        $this->qUm = $this->calculaQuartil($e, 1);
        return $this->qUm;
    }
    public function getQuartilDois($e){
        $this->qDois = $this->calculaQuartil($e, 2);
        return $this->qDois;
    }
    public function getQuartilTres($e){
        $this->qTres = $this->calculaQuartil($e, 3);
        return $this->qTres;
    }
}