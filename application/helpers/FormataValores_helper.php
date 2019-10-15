<?php

function formataValores($valores){
        //procedimento para verificar se todos os valores são float e cria variaveis com o mesmo nome dos campos
        //vindo do cadastroBalanco(forms)
        $erros = array();
        $array = array();
        foreach($valores as $chave => $valorIni){
            $valorM = str_replace(".", "", $valorIni);
            $valorF = str_replace(",", ".", $valorM);
            $valorIni = floatval($valorF);

            if(!is_numeric($valorIni)){
                $erros[] = $chave.' não é um número';
                var_dump($erros);
                die("Por favor insira somente números");
            }else{          
                $valor = intval(strval($valorIni * 100)) / 100;
                $array[$chave] = filter_var($valor, FILTER_VALIDATE_FLOAT);
            }
        }
        return $array;
    }