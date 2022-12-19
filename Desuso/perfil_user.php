<?php

    include("conecta.php");

    if($_SESSION['nivel'] == 1){
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="style.css">
            <!-- CSS only -->
	        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
            <!-- JavaScript Bundle with Popper -->
	        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <title>Usuario Tela</title>
        </head>
        <body>
            <style>

            </style>

        <!-- Altear botao -->
               
                  <a href="javascript::" onclick="load_page('alterar.php')">Alterar</a>
                  <!-- criar post -->
                  <a href="publicar.php">Criar post</a>

                <?php 
                if($_SESSION['banner']!=null){?><p><img src="<?php echo $_SESSION['banner']; ?>" id="banner"/></p><?php }?>
                <?php if($_SESSION['perfil']!=null){?><p><img src="<?php echo $_SESSION['perfil']; ?>" id="perfil"/></p><?php }?>  <p><?php   echo $_SESSION['nome'];  ?></p>
                
               
              
                                
            <?php

                    $sql = "select * from tb_usuario where nr_nivel = '1'";

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

        <div id="editar"></div>

                <div id="panel">
                <form action="" method="post" enctype="multipart/form-data">
                <p><input type="file" name="perfil_usuario" id="perfil_usuario"> Escolher foto de perfil <br></p>
                
                <p><input type="submit" id="foto_perfil" value="Salvar" class="btn btn-default"></p>
                <input type="hidden" name="enviar_foto" value="send_photo">
       
            </form>
                </div>

                <div id="panel">
                <form action="" method="post" enctype="multipart/form-data">
                
                <p> <input type="file" name="banner" id="banner_bot"> Escolher foto de capa </p>
                <p><input type="submit" value="Salvar" class="btn btn-default"></p>
                <input type="hidden" name="enviar_banner" value="send_banner">
            </form>
                </div>


        <div id="seila">
            

                <!-- PHP da foto -->

                <?php
                
                if(isset($_POST['enviar_foto']) && $_POST['enviar_foto'] == "send_photo"){

                    // foto perfil

                    $perfil_user = 'imagens/uploads/';
                    $uploadperfil = $banner.basename($_FILES['perfil_usuario']['name']);
                    $imagem_perfil = $banner.basename($_FILES['perfil_usuario']['name']);

                    if(move_uploaded_file($_FILES['perfil_usuario']['tmp_name'], $uploadperfil) ){
                        $sql = "update tb_usuario set ds_img = '".$imagem_perfil."' where cd_usuario = '".$_SESSION['codigo']."' ";
                        if($resposta = $mysqli->query($sql)){
                            header('Location:perfil_user.php');

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
                            header('Location:perfil_user.php');

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
    }else{
        ?>
        <script>
            alert("Você não tem acesso a esta página");
            window.location.href = "index.php";
        </script>
        <?php
    }

?>