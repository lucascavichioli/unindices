<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
	<title>SISTEMA DE ANÁLISE DE INDICADORES</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url("public/images/icons/favicon.ico")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url("public/vendor/bootstrap/css/bootstrap.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url("public/fonts/font-awesome-4.7.0/css/font-awesome.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url("public/vendor/animate/animate.css")?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url("public/vendor/css-hamburgers/hamburgers.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url("public/vendor/select2/select2.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url("public/css/util.css")?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url("public/css/main.css")?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url("public/css/steps.css")?>">
<!--===============================================================================================-->
</head>
<body>
    <div class="limiter">
        <div class="container-background100">
            <div class="cadastro100-form">
                <span class="cadastro100-form-title">
                    <h1>CADASTRO > CONTABILIDADE</h1>
                </span>

                    <form id="formulario" method='post' action=''>
                        <ul id="progress">
                            <li class="ativo">Identificação</li>
                            <li>Dados cadastrais</li>
                            <li>Login</li>
                        </ul>
                        <fieldset>
                            <h2>Identificação da empresa</h2>
                            <h3>Preencha com seu cnpj</h3>
                            <div class="wrap-input100 validate-input" data-validate = "Preencha sua senha">
                                <input class="input100" type="text" name="cnpj" placeholder="CNPJ">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input class="next acao cadastro100-form-btn" type="submit" name="next" value="PRÓXIMO">
                        </fieldset>

                        <fieldset>
                            <h2>Dados cadastrais</h2>
                            <h3>Dados para contato</h3>
                            <div class="wrap-input100 validate-input" data-validate = "Preencha sua senha">
                                <input class="input100" type="text" name="cnpj" placeholder="CNPJ">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                </span>
                            </div>                  
                            <input class="prev acao cadastro100-form-btn" type="submit" name="prev" value="ANTERIOR">
                            <input class="next acao cadastro100-form-btn" type="submit" name="next" value="PRÓXIMO">
                        </fieldset>

                        <fieldset>
                            <h2>Dados de Login</h2>
                            <h3>Acesso a conta</h3>
                            <div class="wrap-input100 validate-input" data-validate = "Preencha sua senha">
                                <input class="input100" type="text" name="cnpj" placeholder="CNPJ">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                </span>
                            </div>                  
                            <input class="prev acao cadastro100-form-btn" type="submit" name="prev" value="ANTERIOR">
                            <button class="acao cadastro100-form-btn" type='submit'>
                                    CADASTRAR
                            </button>
                        </fieldset>

                    </form>
                        
                        
                        
                        
                        
                        
                        <!--<div class="wrap-input100 validate-input" data-validate = "Preencha sua senha">
                            <input class="input100" type="text" name="cnpj" placeholder="CNPJ" oninput="this.className = ''">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-building" aria-hidden="true"></i>
                            </span>
                        </div>-->
            </div>
        </div>
    </div>
    <script src="<?=base_url("public/js/jquery.js")?>"></script>
    <script src="<?=base_url("public/js/steps.js")?>"></script>
    </body>
</html>