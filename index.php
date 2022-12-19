<?php
	
	include("conecta.php");
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$senha = $_POST['senha_1'];
		$sql = "select * from tb_usuario where ds_email = '".$email."' and ds_senha = '".$senha."'";

		if($resposta = $mysqli->query($sql)){
			if($resposta->num_rows==0){
				echo "usuario nao encontrado";
			}else{
				while($linha = $resposta->fetch_object()){
					$_SESSION['codigo'] = $linha->cd_usuario;
					$_SESSION['nome'] = $linha->nm_usuario;
					$_SESSION['login'] = $linha->ds_email;
                    $_SESSION['senha'] = $linha->ds_senha;
                    $_SESSION['nivel'] = $linha->nr_nivel;
					$_SESSION['perfil'] = $linha->ds_img;
					$_SESSION['banner'] = $linha->ds_banner;

                    if($_SESSION['nivel'] == 1){
                        header('Location:home.php');
                    }

					if($_SESSION['nivel'] == 2){
                        header('Location:home.php');
                    }

					if($_SESSION['nivel'] == 3){
						header('Location:painel_sug.php');
					}
				}
			}
		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://kit.fontawesome.com/e0f6b52dac.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<title>Login</title>
</head>
<body>

<!-- Inicio do Script Cadastro... -->

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

			
								$.ajax({
							url: "cadastrar_usuario.php",
							type: "POST",
							dataType: "html",

							data:{
								cadastrar_nome: $("#nome").val(),
								cadastrar_email: $("#email").val(),
								cadastrar_curso: $("#curso").val(),
								cadastrar_rm: $("#rm").val(),
								cadastrar_senha: $("#confirmar_senha").val()
								
							},
							success: (resposta)=>{
								$("#contratempo").html(resposta);
							}

						}).fail(function(jqXHR, textStatus ) {
							console.log("Request failed: " + textStatus);

						}).always(function() {
							console.log("");
						}); 
          

					return true;
				}
			});
		});

	</script>


<!-- Inicio do Script login... -->
	<script>
		
		$(document).ready(function(){

		// Validação simples: preenchimentos nulos
			$("#entrar").click(function(){
				if($("#senha_1").val() == 0 || $("#email_1").val() == 0){
					$("#show").css("color", "red");
					document.getElementById("show").innerHTML = "Preencha o campo!";
					return false;
				}
        // Validação: preenchimentos completos
				else{
					$("#show").css("color", "green");
					document.getElementById("show").innerHTML = "Autenticado";
					return true;
				}
			});

		});

	</script>


		
<div class="container">
	
<div class="forms-container">
	<div class="signin-signup">
		<!-- Inicio do campo formulario login... -->
		<form id="form" class="sign-in-form" method="post" action="index.php">
			<h2 class="title">Entrar</h2>
			<div class="input-field">
				<i class="fas fa-user"></i>	
			<input id="email_1" type="email" placeholder="Email" name="email"  autocomplete="off"> 
			</div>
			<div class="input-field">
				<i class="fas fa-lock"></i>
			<input id="senha_1" type="password" placeholder="Senha" name="senha_1"> 
			</div>
            <p id="show"></p>
		
			<input id="entrar" type="submit" name="Entre">

			<a href="home.php">Entrar como visitante</a>

		</form>
	</div>


		<!-- Fim do formulario login -->

		<!-- Inicio do formulario cadastro... -->
	<div class="signup-signup">
		<div class="formulario">

			<h2 class="title">Criar Conta</h2>
			<div class="input-field">
			<i class="fas fa-user"></i>	
			<input id="nome" type="text" placeholder="Nome"  name="nome_usuario"> 
			</div>

			<input id="rm" type="number" placeholder="RM"  name="rm_usuario" maxlength="5"> 

			<div class="input-field">
			<i class="fas fa-box"></i>	
			<input id="email" type="email" placeholder="Email" name="email_usuario"> 
			</div>

		<select name="curso" id="curso">
			<option value="1">1º ano</option>
			<option value="2">2º ano</option>
			<option value="3">3º ano</option>
		</select>

		<div class="input-field">
			<i class="fas fa-unlock"></i>
			<input id="senha" placeholder="Senha" type="password" name="senha_1"> 
			<p id="nulo"></p>
		</div>
		<div class="input-field">
			<i class="fas fa-lock"></i>
			<input id="confirmar_senha" placeholder="Confirmar Senha" type="password" name="senha_2"> 
		</div>
			<p id="show"></p>
			<input id="enviar" type="submit" name="Entre">

			<div style="color: red;" id="contratempo"></div>

		</div>

		</div> 
</div>

<div class="panels-container">
		<div class="panel left-panel">
		<div class="content">
			<h3>Novo Aqui?</h3>
			<p>
				Olá! Aqui é o projeto Article vinculado ao TCC da Etec de Itanhaém.
			</p>
			<button class="btn transparent" id="sign-up-button">Criar Conta</button>
		</div>
		</div>
        
		<div class="panel right-panel">
			<div class="content">
				<h3>Já tem uma conta?</h3>
				<p>
				Olá! Aqui é o projeto Article vinculado ao TCC da Etec de Itanhaém.
				</p>
				<button class="btn transparent" id="sign-in-button">Entrar em sua Conta</button>
			</div>
		</div>
</div>

</div>
		<!-- Fim do formulario cadastro -->	

		<script type="text/javascript">
			const sign_in_btn = document.querySelector('#sign-in-button');
			const sign_up_btn = document.querySelector('#sign-up-button');
			const container = document.querySelector('.container')

			sign_up_btn.addEventListener('click', () =>{
				container.classList.add('sign-up-mode');
			})

			sign_in_btn.addEventListener('click', () =>{
				container.classList.remove('sign-up-mode');
			})

		</script>

</body>
</html>

