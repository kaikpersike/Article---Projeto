<?php

    include("conecta.php");
    include("header.php");
    $test = $_SESSION['codigo'];
// user tela
    if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
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
            <title>Usuario Tela</title>
        </head>
        <body>
        <div class="cachota">


        <!-- Altear botao -->
               
                  <div class="editar">
                  <a href="javascript::" onclick="load_page('alterar.php')">Alterar</a>
                  <!-- criar post -->
                  <a href="publicar.php">Criar post</a>
                </div>
                
                  <?php

$sql = "select * from tb_usuario where nr_nivel = '1' and cd_usuario = '$test'";

if($resposta = $mysqli->query($sql)){
    if($resposta->num_rows==0){
        echo "nothing";
    }else{
        while($linha = $resposta->fetch_object()){
            $_SESSION['codigo'] = $linha->cd_usuario;
            $_SESSION['nome'] = $linha->nm_usuario;
            $_SESSION['login'] = $linha->ds_email;
            $_SESSION['senha'] = $linha->ds_senha;
            $_SESSION['nivel'] = $linha->nr_nivel;
            $_SESSION['perfil'] = $linha->ds_img;
            $_SESSION['banner'] = $linha->ds_banner;
        }

        ?>
                        <?php 
                if($_SESSION['banner']!=null){?><p><img src="<?php echo $_SESSION['banner']; ?>" id="banner"/></p><?php }?>
                <?php if($_SESSION['perfil']!=null){?><p><img src="<?php echo $_SESSION['perfil']; ?>" id="perfil"/></p><?php }?>  <p id="nick"><?php   echo $_SESSION['nome'];  ?></p>
<?php
    }
}

?>
                
               
              
                                


            <script>
// Inicio alterar
                function load_page(arquivo){
                    if(arquivo){
                    $.ajax({
                    url: arquivo,
                    type: 'GET',
                    data: arquivo,

                    success: function(data){
                        $("#editar").html(data);
                    }

                });
                    }
                }
// Fim alterar

            </script>
<div class="caixa">
        <div id="editar"></div>

                <form action="" method="post" enctype="multipart/form-data">
                <p>
                <label class="teste">
                <span class="testando"></span>
                <input type="file" name="perfil_usuario" id="perfil_usuario"> 
                <br> <br> <br> Editar icone<br></p>
                </label>
                <p><input type="submit" id="foto_perfil" value="Salvar" class="ftop"></p>
                <input type="hidden" name="enviar_foto" value="send_photo">
            </form>
                

            <form action="" method="post" enctype="multipart/form-data">
                <p> 
                <label class="teste2">
                <span class="testando2"></span>
                <input type="file" name="banner" id="banner_bot">
                <br> <br> <br> Editar capa </p>
                </label>
                <p><input type="submit" id="foto_banner" value="Salvar" class="ftop2"></p>
                <input type="hidden" name="enviar_banner" value="send_banner">
            </form>
                </div>


        <div id="seila">
       

                <!-- PHP da foto -->

                <?php
                
                if(isset($_POST['enviar_foto']) && $_POST['enviar_foto'] == "send_photo"){

                    // foto perfil

                    $perfil_user = 'imagens/uploads/';
                    $uploadperfil = $perfil_user.basename($_FILES['perfil_usuario']['name']);
                    $imagem_perfil = $perfil_user.basename($_FILES['perfil_usuario']['name']);

                    if(move_uploaded_file($_FILES['perfil_usuario']['tmp_name'], $uploadperfil) ){
                        $sql = "update tb_usuario set ds_img = '".$imagem_perfil."' where cd_usuario = '".$_SESSION['codigo']."' ";
                        if($resposta = $mysqli->query($sql)){

                      
                                $img = "select * from tb_usuario where nr_nivel = '1' and cd_usuario = '$test'";

                                if($resposta = $mysqli->query($img)){
                                    if($resposta->num_rows==0){
                                        echo "nothing";
                                    }else{
                                        while($linha = $resposta->fetch_object()){
                                            $_SESSION['codigo'] = $linha->cd_usuario;
                                            $_SESSION['nome'] = $linha->nm_usuario;
                                            $_SESSION['login'] = $linha->ds_email;
                                            $_SESSION['senha'] = $linha->ds_senha;
                                            $_SESSION['nivel'] = $linha->nr_nivel;
                                            $_SESSION['perfil'] = $linha->ds_img;
                                            $_SESSION['banner'] = $linha->ds_banner;
                                        }
                                    }
                                }
                            

                        }else{
                            echo "erro";
                        }
                    }
                }
                
                ?>

                <?php
                
                if(isset($_POST['enviar_banner']) && $_POST['enviar_banner'] == "send_banner"){

                    // foto banner

                    $banner = 'imagens/uploads/';
                    $uploadbanner = $banner.basename($_FILES['banner']['name']);
                    $imagem_banner = $banner.basename($_FILES['banner']['name']);

                    if(move_uploaded_file($_FILES['banner']['tmp_name'], $uploadbanner) ){
                        $sql = "update tb_usuario set ds_banner = '".$imagem_banner."' where cd_usuario = '".$_SESSION['codigo']."' ";
                        if($resposta = $mysqli->query($sql)){

                         
                                $img = "select * from tb_usuario where nr_nivel = '1' and cd_usuario = '$test'";

                                if($resposta = $mysqli->query($img)){
                                    if($resposta->num_rows==0){
                                        echo "nothing";
                                    }else{
                                        while($linha = $resposta->fetch_object()){
                                            $_SESSION['codigo'] = $linha->cd_usuario;
                                            $_SESSION['nome'] = $linha->nm_usuario;
                                            $_SESSION['login'] = $linha->ds_email;
                                            $_SESSION['senha'] = $linha->ds_senha;
                                            $_SESSION['nivel'] = $linha->nr_nivel;
                                            $_SESSION['perfil'] = $linha->ds_img;
                                            $_SESSION['banner'] = $linha->ds_banner;
                                        }
                                    }
                                
                            }


                        }else{
                            echo "erro";
                        }
                    }
                }


                
            ?>
             </div> 
            
                <?php
                

                $sec = "select * from tb_post where id_user = '".$_SESSION['codigo']."' order by cd_post desc";

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
                        $_SESSION['user'] = $linha->id_user;
                        $_SESSION['status'] = $linha->ds_status;
                       
                            if($_SESSION['status'] == 1){

                            
                        
                        ?>
        
                        <!-- Aqui esta ocorrendo a exibicao -->

                        
                       
                        <div id="panel" align="center">
                            <!-- Pegando link via url -->
                        <p> <a href="post.php?codigo_post=<?php  echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                        <p><h1>Em avaliação...</h1></p>
                            <!-- outros... -->
                        
                         <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
                         <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>
                            
                         <p>
                              <i class="bi bi-hand-thumbs-up"></i> <i class="bi bi-chat-dots"></i>
                         </p>
                    
                  
        </div>
                   <?php
                   }
                   if($_SESSION['status']==2){
                    ?>
                                            <div id="panel" align="center">
                            <!-- Pegando link via url -->
                        <p> <a href="post.php?codigo_post=<?php  echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                        <p><h1>Avaliado</h1></p>
                            <!-- outros... -->
                        
                         <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
                         <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>
                            
                         <p>
                              <i class="bi bi-hand-thumbs-up"></i> <i class="bi bi-chat-dots"></i>
                         </p>
                    
                  
        </div>
                    <?php
                   }
                   elseif($_SESSION['status']==3){
                    ?>
                                                                <div id="panel" align="center">
                            <!-- Pegando link via url -->
                        <p> <a href="post.php?codigo_post=<?php  echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                        <p><h1>Nao permitido</h1></p>
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
                
                
              }
        
                
                ?>

        </body>
        </html>
<?php
    }  
    // ADM tela
    if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2){
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
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
            <title>ADM Tela</title>
        </head>
        <body>
        <div class="cachota">


                    <!-- Alterar botao -->
                    <div class="editar">       
                    <a href="javascript::" onclick="load_page('alterar.php')">Alterar</a>
                    <a href="avaliacao.php">Artigos</a>
                  <!-- criar post -->
                  <a href="publicar.php">Criar post</a>
                  </div>
                  <?php

$sql = "select * from tb_usuario where nr_nivel='2' and cd_usuario='$test'";

if($resposta = $mysqli->query($sql)){
    if($resposta->num_rows==0){
        echo "nothing";
    }else{
        while($linha = $resposta->fetch_object()){
            $_SESSION['codigo'] = $linha->cd_usuario;
            $_SESSION['nome'] = $linha->nm_usuario;
            $_SESSION['login'] = $linha->ds_email;
            $_SESSION['senha'] = $linha->ds_senha;
            $_SESSION['nivel'] = $linha->nr_nivel;
            $_SESSION['perfil'] = $linha->ds_img;
            $_SESSION['banner'] = $linha->ds_banner;

        }

        ?>
                        <?php 
                if($_SESSION['banner']!=null){?><p><img src="<?php echo $_SESSION['banner']; ?>" id="banner"/></p><?php }?>
                <?php if($_SESSION['perfil']!=null){?><p><img src="<?php echo $_SESSION['perfil']; ?>" id="perfil"/></p><?php }?>  <p id="nick"><?php   echo $_SESSION['nome'];  ?></p>

        <?php

    }
}

?>
<br>
<br>
<br>
<br>                
                <select name="buscar_sala" class="buscar">
                    <option value="">Todos</option>
                    <option value="1">1º ano</option>
                    <option value="2">2º ano</option>
                    <option value="3">3º ano</option>
                </select>
               
                <input type="text" name="aluno" id="titulo" class="aluno_pesquisa">   
                <input type="submit"  id="btn-default" class="pesquisar_aluno" value="Pesquisar">
                

                <div class="resultado_aluno"></div>


		<style>
          .buscar{
                padding: 10px;
    outline: none;
    border: 1px;
    border-style: solid;
    border-color: #5F6078;
    border-radius: 15px;
    background-color: transparent;
    text-transform: uppercase;
    font-weight: 600;
    color: #5F6078;
          }
        </style>

            <script>
                // $(".esconde").hide();
// Inicio alterar
                function load_page(arquivo){
                    if(arquivo){
                    $.ajax({
                    url: arquivo,
                    type: 'GET',
                    data: arquivo,

                    success: function(data){
                        $("#editar").html(data);
                    }

                });
                    }
                }
// Fim alterar

// sala
                $(".buscar").click(function(){
                    // $(".esconde").show();
                    $.ajax({
                url: "pesquisar_sala.php",
                type: "POST",
                dataType: "html",

                data:{
                    sala: $(".buscar").val()
                    
                },
                success: (resposta)=>{
                    $(".resultado_aluno").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
                });
// aluno
                $(".aluno_pesquisa").change(function(){
                    $.ajax({
                url: "pesquisar_aluno.php",
                type: "POST",
                dataType: "html",

                data:{
                    aluno: $(".aluno_pesquisa").val(),
                    sala: $(".buscar").val()
                    
                },
                success: (resposta)=>{
                    $(".resultado_aluno").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
                });
                // else

                $(".pesquisar_aluno").click(function(){
                    $.ajax({
                url: "pesquisar_aluno.php",
                type: "POST",
                dataType: "html",

                data:{
                    aluno: $(".aluno_pesquisa").val(),
                    sala: $(".buscar").val()
                    
                },
                success: (resposta)=>{
                    $(".resultado_aluno").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
                });

            </script>
<div class="caixa">
        <div id="editar"></div>

                <form action="" method="post" enctype="multipart/form-data">
                <p>
                <label class="teste">
                <span class="testando"></span>
                <input type="file" name="perfil_usuario" id="perfil_usuario"> 
                <br> <br> <br> Editar icone<br></p>
                </label>
                <p><input type="submit" id="foto_perfil" value="Salvar" class="ftop"></p>
                <input type="hidden" name="enviar_foto" value="send_photo">
            </form>
                

            <form action="" method="post" enctype="multipart/form-data">
                <p> 
                <label class="teste2">
                <span class="testando2"></span>
                <input type="file" name="banner" id="banner_bot">
                <br> <br> <br> Editar capa </p>
                </label>
                <p><input type="submit" id="foto_banner" value="Salvar" class="ftop2"></p>
                <input type="hidden" name="enviar_banner" value="send_banner">
            </form>
                </div>


        <div id="seila">
   

                <!-- PHP da foto -->

                <?php
                
                if(isset($_POST['enviar_foto']) && $_POST['enviar_foto'] == "send_photo"){

                    // foto perfil

                    $perfil_user = 'imagens/uploads/';
                    $uploadperfil = $perfil_user.basename($_FILES['perfil_usuario']['name']);
                    $imagem_perfil = $perfil_user.basename($_FILES['perfil_usuario']['name']);

                    if(move_uploaded_file($_FILES['perfil_usuario']['tmp_name'], $uploadperfil) ){
                        $sql = "update tb_usuario set ds_img = '".$imagem_perfil."' where cd_usuario = '".$_SESSION['codigo']."' and nr_nivel='2' ";
                        if($resposta = $mysqli->query($sql)){
                             
                    $img = "select * from tb_usuario where nr_nivel='2' and cd_usuario='$test'";

                    if($resposta = $mysqli->query($img)){
                        if($resposta->num_rows==0){
                            echo "nothing";
                        }else{
                            while($linha = $resposta->fetch_object()){
                                $_SESSION['codigo'] = $linha->cd_usuario;
                                $_SESSION['nome'] = $linha->nm_usuario;
                                $_SESSION['login'] = $linha->ds_email;
                                $_SESSION['senha'] = $linha->ds_senha;
                                $_SESSION['nivel'] = $linha->nr_nivel;
                                $_SESSION['perfil'] = $linha->ds_img;
                                $_SESSION['banner'] = $linha->ds_banner;

                            }
                        }
                    }   
                            

                        }else{
                            echo "erro";
                        }
                    }
                }
                
                ?>

                <?php
                
                if(isset($_POST['enviar_banner']) && $_POST['enviar_banner'] == "send_banner"){

                    // foto banner

                    $banner = 'imagens/uploads/';
                    $uploadbanner = $banner.basename($_FILES['banner']['name']);
                    $imagem_banner = $banner.basename($_FILES['banner']['name']);

                    if(move_uploaded_file($_FILES['banner']['tmp_name'], $uploadbanner) ){
                        $sql = "update tb_usuario set ds_banner = '".$imagem_banner."' where cd_usuario = '".$_SESSION['codigo']."' and nr_nivel='2' ";
                        if($resposta = $mysqli->query($sql)){

                                $img = "select * from tb_usuario where nr_nivel='2' and cd_usuario='$test'";

                                if($resposta = $mysqli->query($img)){
                                    if($resposta->num_rows==0){
                                        echo "nothing";
                                    }else{
                                        while($linha = $resposta->fetch_object()){
                                            $_SESSION['codigo'] = $linha->cd_usuario;
                                            $_SESSION['nome'] = $linha->nm_usuario;
                                            $_SESSION['login'] = $linha->ds_email;
                                            $_SESSION['senha'] = $linha->ds_senha;
                                            $_SESSION['nivel'] = $linha->nr_nivel;
                                            $_SESSION['perfil'] = $linha->ds_img;
                                            $_SESSION['banner'] = $linha->ds_banner;
                                        }
                                    }
                                }
                            


                        }else{
                            echo "erro";
                        }
                    }
                }


                
            ?>
             </div> 
            
                <?php
                

                $sec = "select * from tb_post where id_user = '".$_SESSION['codigo']."' order by cd_post desc";

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
                        $_SESSION['user'] = $linha->id_user;
                       
        
                        
                        ?>
        
                        <!-- Aqui esta ocorrendo a exibicao -->
                       
                        <div id="panel" align="center">
                            <!-- Pegando link via url -->
                        <p> <a href="post.php?codigo_post=<?php  echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
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

        </body>
        </html>
<?php
    }elseif($_SESSION['nivel'] !=1 && $_SESSION['nivel'] !=2){
        ?>
        <script>
            alert("Voce precisa estar logado");
            window.location.href="index.php";
        </script>
        <?php
    }


?>