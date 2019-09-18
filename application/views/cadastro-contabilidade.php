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

                <form id="regForm" action="">
                    <!-- One "tab" for each step in the form: -->
                    <div class="tab">
                        <div class="wrap-input100 validate-input" data-validate = "Preencha sua senha">
                            <input class="input100" type="text" name="cnpj" placeholder="CNPJ" oninput="this.className = ''">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-building" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>

                    <div class="tab">Contact Info:
                    <p><input placeholder="E-mail..." oninput="this.className = ''"></p>
                    <p><input placeholder="Phone..." oninput="this.className = ''"></p>
                    </div>

                    <div class="tab">Birthday:
                    <p><input placeholder="dd" oninput="this.className = ''"></p>
                    <p><input placeholder="mm" oninput="this.className = ''"></p>
                    <p><input placeholder="yyyy" oninput="this.className = ''"></p>
                    </div>

                    <div class="tab">Login Info:
                    <p><input placeholder="Username..." oninput="this.className = ''"></p>
                    <p><input placeholder="Password..." oninput="this.className = ''"></p>
                    </div>

                    <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Próximo</button>
                    </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="<?=base_url("public/js/steps.js")?>"></script>
    </body>
</html>