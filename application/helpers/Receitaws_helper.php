<?php

function apiReceita($cnpj){
            
    $ch = curl_init();
    $submit_url = "https://www.receitaws.com.br/v1/cnpj/" . $cnpj;
    curl_setopt($ch, CURLOPT_URL, $submit_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    //curl_setopt($ch, CURLOPT_CERTINFO, "C:\wamp\www\viacepcombr.crt");
    // var_dump(getcwd() . "\\" . "receitawscombr.crt");
    $json = curl_exec($ch);
       

    if($json === false){
       log_message('error', curl_errno($ch) . " -> " . curl_error($ch));
    } else {

    $var = json_decode($json);

    return $var;
    // Bloco de código: Seta todos os valores da api menos o cnpj
    //define delimitador do foreach em 0.
    }
}

function processaDadosCnpj($var){
    $jafoi = 0;
    $atividadesSecundarias = array();
    $qsa = array();
    $receitawsmodel = array();

    foreach($var as $valor){
    if($jafoi == 0){
        foreach($var->atividade_principal as $valor){
            $receitawsmodel['rec_atv_prin_code'] = $valor->code;
            $receitawsmodel['rec_atv_prin_text'] = $valor->text;
        }
        
        //bloco para pegar o array de objetos e separar em apenas um array
        foreach($var->atividades_secundarias as $key => $valor){
            $obj1 = $var->atividades_secundarias[$key];

            $a = array_map(function($obj) { $text = $obj->text; $code = $obj->code; 
                                            $array = array('code' => $code, 'text' => $text); return $array;}, 
                                            array($key => $obj1));                                          
            foreach($a as $valor){
                foreach($valor as $v){
                    $atividadesSecundarias[] = $v; 
                }
            }                                   
        }   
        //pega o array das atv secundarias e joga tudo dentro de uma variavel
        $strSec = implode(";", $atividadesSecundarias);
        //seta valor
        $receitawsmodel['rec_atividades_secundarias'] = $strSec;
        
        //bloco para pegar o array de objetos e separar em apenas um array
        foreach($var->qsa as $key => $valor){
            $obj2 = $var->qsa[$key];

            $a = array_map(function($obj) { $qual = $obj->qual; $nome = $obj->nome; 
                                            //$qual_rep_legal = $obj->qual_rep_legal;
                                            //$nome_rep_legal = $obj->nome_rep_legal;
                                            //$pais_origem = $obj->pais_origem;
                                            $array = array('nome' => $nome, 'qual' => $qual); return $array;}, 
                                            array($key => $obj2));                                        
                /*
                    'pais_origem' => $pais_origem,
                    'nome_rep_legal' => $nome_rep_legal,
                    'qual_rep_legal' => $qual_rep_legal
                */
                foreach($a as $valor){
                foreach($valor as $v){
                    $qsa[] = $v; 
                }
                }                                   
            }
            //pega o array do qsa e joga tudo dentro de uma variavel
            $strQsa = implode(";", $qsa);
            //seta o valor
            $receitawsmodel['rec_qsa'] = $strQsa;
        
        // não utilizado
        foreach($var->extra as $valor){
            $receitawsmodel['rec_extra'] = null;
        }     
            
        }
        $jafoi = 1;
    }     
$cnpj = preg_replace("/[^0-9]/", "", $var->cnpj);
$cnpj = filter_var($cnpj, FILTER_SANITIZE_NUMBER_INT);
$receitawsmodel['rec_cnpj'] = $cnpj;
$receitawsmodel['rec_data_situacao'] = $var->data_situacao;
$receitawsmodel['rec_nome'] = $var->nome; 
$receitawsmodel['rec_uf'] = $var->uf; 
$receitawsmodel['rec_telefone'] = $var->telefone; 
$receitawsmodel['rec_email'] = $var->email; 
$receitawsmodel['rec_situacao'] = $var->situacao; 
$receitawsmodel['rec_bairro'] = $var->bairro; 
$receitawsmodel['rec_logradouro'] = $var->logradouro; 
$receitawsmodel['rec_numero'] = $var->numero; 
$receitawsmodel['rec_cep'] = $var->cep; 
$receitawsmodel['rec_municipio'] = $var->municipio; 
$receitawsmodel['rec_abertura'] = $var->abertura; 
$receitawsmodel['rec_natureza_juridica'] = $var->natureza_juridica; 
$receitawsmodel['rec_ultima_atualizacao'] = $var->ultima_atualizacao; 
$receitawsmodel['rec_status'] = $var->status; 
$receitawsmodel['rec_tipo'] = $var->tipo; 
$receitawsmodel['rec_fantasia'] = $var->fantasia; 
$receitawsmodel['rec_complemento'] = $var->complemento; 
$receitawsmodel['rec_efr'] = null; 
$receitawsmodel['rec_motivo_situacao'] = $var->motivo_situacao; 
$receitawsmodel['rec_situacao_especial'] = $var->situacao_especial; 
$receitawsmodel['rec_data_situacao_especial'] = $var->data_situacao_especial;
$receitawsmodel['rec_capital_social'] = $var->capital_social;
        
    if($receitawsmodel){
        return $receitawsmodel;
    }  else {
        die("Objeto receita não preenchido");
    }
}
