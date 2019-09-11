<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<?php 
 	$form = new Form_helper();
	print $form->start('i') . "Versão 0.1. Start" . $form->end('i'); 
?> 
<head>
	<title>Login V1</title>
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
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?=base_url("public/images/img-01.png")?>" alt="IMG">
				</div>

				<form class="login100-form validate-form">
					<span class="login100-form-title">
						Sistema Contábil
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Preencha um e-mail válido">
						<input class="input100" type="text" name="email" placeholder="Email / Código / CPF">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Esqueci meu
						</span>
						<a class="txt2" href="#">
							usuário ou senha?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="<?=base_url("public/vendor/jquery/jquery-3.2.1.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url("public/vendor/bootstrap/js/popper.js")?>"></script>
	<script src="<?=base_url("public/vendor/bootstrap/js/bootstrap.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url("public/vendor/select2/select2.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url("public/vendor/tilt/tilt.jquery.min.js")?>"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?=base_url("public/js/main.js")?>"></script>

</body>
</html>