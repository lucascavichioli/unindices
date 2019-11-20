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
<div class="<?=$class ?? ''?>" role="alert">
 	<?=$success ?? '' ?>
</div>
	<div class="limiter">
		<div class="container-background100">
        <form action="" method="POST">
			<div class="cadastro100-form">
                <span class="cadastro100-form-title">
                    Nova Senha!
                </span>
                <div class="container-cadastro100-form-btn">
                    <div class="wrap-input50 validate-input <?=$alert ?? ''?>" data-validate = "Preencha uma senha válida">
                            <input style="text-align: center;" class="inputNovaSenha" type="password" name="senha" placeholder="Senha">
                            <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input50 validate-input <?=$alert ?? ''?>" data-validate = "As senhas não coincidem">
                            <input style="text-align: center;" class="inputNovaSenha" type="password" name="senhaConfirma" placeholder="Confirmação de senha">
                            <span class="focus-input100"></span>
                    </div>
                    <input type="hidden" name="key" value="<?=$token ?? ''?>">
                    <button type="submit" class="login100-form-btn" onclick="">
                        ALTERAR
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
