<?php

    include("conecta.php");
    include("header.php");

    if(isset($_SESSION['login'])){
        include_once("logout.php");
    }

    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="user.css">
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" type="text/css" href="css/header.css">
            <script src="https://kit.fontawesome.com/e0f6b52dac.js" crossorigin="anonymous"></script>
            <!-- CSS only -->
            <!-- JavaScript Bundle with Popper -->
	        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <title>Visitante Tela</title>
        </head>
        <body>

        <div class="cachota">
            <!-- exibindo nome do user -->
            <h1>Olá Visitante</h1>  

                <select name="linguagem" id="linguagem">
                    <option value="">Todos</option>
                    <option value="1">PHP</option>
                    <option value="2">HTML</option>
                    <option value="3">CSS</option>
                    <option value="4">Java Script</option>
                </select>
                <input type="submit" id="pesquisar_linguagem" value="Pesquisar">

            <script>

                // Pesquisa

                $("#pesquisar_linguagem").click(function(){
                    $.ajax({
                url: "pesquisar.php",
                type: "POST",
                dataType: "html",

                data:{
                    linguagem: $("#linguagem").val()
                    
                },
                success: (resposta)=>{
                    $("#publicacao").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
                })

            </script>   

        </body>
        </html>

        <div id="publicacao">
        <!-- Exibicao do conteudo da publicacao -->
        <?php


        // inicio do contato com a tabela publicacao
        $sec = "select * from tb_post where ds_status = '2' order by cd_post desc";

        if($resposta = $mysqli->query($sec)){
			if($resposta->num_rows==0){
				echo "sem post";
			}else{
				while($linha = $resposta->fetch_object()){
                $_SESSION['id'] = $linha->cd_post;
                $_SESSION['titulo'] = $linha->ds_titulo;
                $_SESSION['texto'] = $linha->ds_texto;
                $_SESSION['imagem'] = $linha->im_imagem;
                $_SESSION['data'] = $linha->ds_data;
                $_SESSION['hora'] = $linha->ds_hora;
                $_SESSION['postador'] = $linha->nm_postador;
                $_SESSION['id_user_post'] = $linha->id_user;
               


                ?>

                <!-- Aqui esta ocorrendo a exibicao -->
               
                <div id="panel" align="center">
                    <!-- Pegando link via url -->
                <p> <a id="logar" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                <script>
                    $("#logar").click(function(){
                        alert("Você precisa estar logado!");
                        window.location.href="index.php";
                    })
                </script>
                    <!-- outros... -->
                
                 <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
                 <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>
                    
                 <p>
                      <i class="bi bi-hand-thumbs-up"></i> <i class="bi bi-chat-dots"></i>
                 </p>
            
           </div> 
           <?php

           }



        }
        
        
      }


?>
      </div>

