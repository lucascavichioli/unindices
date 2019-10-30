<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quartil {
    private $qUm;
    private $qDois;
    private $qTres;
    private $elementos = array();

    public function __construct($elementos){
        $this->elementos = $elementos;
    }

    private function calculaQuartil($q){

        $elementos = $this->elementos;
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

    public function getQuartilUm(){
        $this->qUm = $this->calculaQuartil(1);
        return $this->qUm;
    }
    public function getQuartilDois(){
        $this->qDois = $this->calculaQuartil(2);
        return $this->qDois;
    }
    public function getQuartilTres(){
        $this->qTres = $this->calculaQuartil(3);
        return $this->qTres;
    }

}