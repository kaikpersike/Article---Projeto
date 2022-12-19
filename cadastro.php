<?php

	include("conecta.php");


?>

<!-- Inicio validaçao -->
	<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<title>Cadastro</title>
</head>
<body>

	<script>
		
		$(document).ready(function(){

		// Validação simples: senhas divergentes
			$("#enviar").click(function(){
				if($("#senha").val() != $("#confirmar_senha").val()){
					$("#show").css("color", "red");
					document.getElementById("show").innerHTML = "Senhas diferentes";
					return false;
				}
		// Validação simples: campos nulos
				if($("#senha").val() == 0){
					$("#nulo").css("color", "red");
					document.getElementById("nulo").innerHTML = "Preencha esse campo!";
					return false;
				}
		// Validação simples: autenticação de dados corretos
				else{
					$("#show").css("color", "green");
					document.getElementById("show").innerHTML = "Autenticado";
					return true;
				}
			});
		});

	</script>

		<!-- Inicio do formulario cadastro... -->

	<form id="form" method="post" action="cadastrar_usuario.php">
		<p>Nome Completo </p> <br>
			<input id="nome" type="text" name="nome_usuario"> <br> 
		<p>RM </p><br>
			<input id="rm" type="number" name="rm_usuario"> <br> 
		<p>Email </p><br>
			<input id="email" type="text" name="email_usuario"> <br> 
		<p>Senha: </p><br>

		<select name="curso">
			<option value="1">1º ano</option>
			<option value="2">2º ano</option>
			<option value="3">3º ano</option>
		</select><br>
		
			<input id="senha" type="password" name="senha_1"> <br>
			<p id="nulo"></p> 
		<p>Confirmar senha: </p><br>
		
			<input id="confirmar_senha" type="password" name="senha_2"> <br> 
		<p id="show"></p>

			<input id="enviar" type="submit" name="Entre">

		<a href="index.php">Já tem uma conta?</a>

	</form>

		<!-- Fim do formulario cadastro -->

</body>
</html>

<!-- Fim validaçao -->


