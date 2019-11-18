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
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-background100">
        <form action="<?=base_url("novasenha/recuperasenha")?>" method="POST">
			<div class="cadastro100-form">
                <span class="cadastro100-form-title">
                    Recuperação de senha!
                </span>
                <div class="container-cadastro100-form-btn">
                    <div class="wrap-input100 validate-input" data-validate = "Preencha um e-mail válido">
                            <input style="text-align: center;" class="inputNovaSenha" type="text" name="email" placeholder="E-mail">
                            <span class="focus-input100"></span>
                    </div>
                    <button type="submit" class="login100-form-btn" onclick="">
                        ENVIAR
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
