<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
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
    <link rel="stylesheet" type="text/css" href="<?=base_url("public/css/sweetalert.css")?>">
<!--===============================================================================================-->
</head>
<body>

    <div class="limiter">
        <div class="container-background100">
            <div class="cadastro100-form">
                <span class="cadastro100-form-title">
                    <h1>CADASTRO > CONTADOR</h1>
                </span>
                 <form id="formulario" name='formulario'class="login100-form validate-form" method='post' action=''>
                        <ul id="progress">
                            <li class="ativo">Identificação</li>
                            <li>Dados cadastrais</li>
                            <li>Login</li>
                        </ul>
                        <fieldset>
                            <h2>Identificação</h2><br>
                            <!--<h3>Preencha com seu CPF</h3>-->
                            <div id="divCpf" class="wrap-input100 validate-input <?= $erro ?? '' ?>" data-validate = "<?= $mensagem ?? "Preencha seu CPF"?>">
                                <input id="cpf" class="input100" type="text" name="cpf" placeholder="CPF" value="<?= $cpf ?? '' ?>" onkeypress="MascaraCPF(formulario.cpf)" maxlength="14" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="divCrc" class="wrap-input100 validate-input <?= $erro ?? '' ?>" data-validate = "Preencha seu Registro de Contabilidade">
                                <input id="crc" class="input100" type="text" name="crc" placeholder="CRC/UF" value=""  maxlength="20" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-id-badge" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input id="cpfBtn" class="nextCpf cadastro100-form-btn" type="submit" name="next" value="PRÓXIMO">
                        </fieldset>

                        <fieldset>
                            <h2>Dados cadastrais</h2><br>
                            <!--<h3>Dados para contato</h3>-->
                            <div id="divNomeCompleto" class="wrap-input100 validate-input" data-validate = "Preencha seu nome completo">
                                <input id="nomeContador" class="input100" type="text" name="nomeContador" placeholder="Nome Completo">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="divCep" class="wrap-input100 validate-input" data-validate = "Preencha um CEP">
                                <input id="cep" class="input100" type="text" name="cep" onkeypress="MascaraCEP(formulario.cep)" placeholder="CEP">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-map-pin" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="divLogradouro" class="wrap-input100 validate-input" data-validate = "Digite o nome da sua rua">
                                <input id="logradouro" class="input100" type="text" name="logradouro"  placeholder="Nome da rua">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-road" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="divCidade" class="wrap-input100 validate-input" data-validate = "Digite sua cidade">
                                <input id="cidade" class="input100" type="text" name="cidade"  placeholder="Cidade">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-university" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="divUf" class="wrap-input100 validate-input" data-validate = "Digite um estado">
                                <input id="uf" class="input100" type="text" name="uf" placeholder="Estado">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                </span>
                            </div>       
                            <div id="divTelefone" class="wrap-input100 validate-input" data-validate = "Preencha um telefone válido">
                                <input id="telefone" class="input100" type="text" name="telefone" onkeypress="MascaraTelefone(formulario.telefone);" maxlength="14" placeholder="(DDD)####-##### ou (DDD)####-####">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                            </div>            
                            <input class="prev  cadastro100-form-btn" type="submit" name="prev" value="VOLTAR">
                            <input class="nextCont cadastro100-form-btn" type="submit" name="next" value="PRÓXIMO">
                        </fieldset>

                        <fieldset>
                            <h2>Dados de Login</h2><br>
                            <!--<h3>Acesso a conta</h3>-->
                            <div class="wrap-input100 validate-input" data-validate = "Preencha um e-mail válido">
                                <input class="input100" type="text" name="email" placeholder="E-mail">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="senha1" class="wrap-input100 validate-input" data-validate = "Preencha uma senha">
                                <input class="input100" type="password" name="senha" placeholder="Senha - Mínimo 6 dígitos" minlength=6>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="senha2" class="wrap-input100 validate-input" data-validate = "Preencha uma senha">
                                <input id="senhaConfirmada" class="input100" type="password" name="senhaConfirmada" placeholder="Confirmar senha" minlength=6>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>         
                            <input class="prev  cadastro100-form-btn" type="submit" name="prev" value="VOLTAR">
                            <button  class="cadastro100-form-btn" type='submit'>
                                    CADASTRAR
                            </button>
                        </fieldset>

                    </form>
            </div>
        </div>
    </div>


    <script src="<?=base_url("public/js/jquery.js")?>"></script>
    <script src="<?=base_url("public/js/steps.js")?>"></script>
    <script src="<?=base_url("public/js/main.js")?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?=base_url("public/js/sweetalert.js")?>"></script>
    </body>
</html>