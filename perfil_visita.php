<?php

    include("conecta.php");
    include("header.php");
    $test = $_GET['cd'];
// user tela
    if(isset($test) && $test != $_SESSION['codigo']){
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

                  <?php

$sql = "select * from tb_usuario where cd_usuario='$test'";

if($resposta = $mysqli->query($sql)){
    if($resposta->num_rows==0){
        echo "nothing";
    }else{
        while($linha = $resposta->fetch_object()){
            $codigao = $linha->cd_usuario;
            $nomizao = $linha->nm_usuario;
            $perfao = $linha->ds_img;
            $banao = $linha->ds_banner;

        }

        ?>
                        <?php 
                if($banao!=null){?><p><img src="<?php echo $banao; ?>" id="banner"/></p><?php }?>
                <?php if($perfao!=null){?><p><img src="<?php echo $perfao; ?>" id="perfil"/></p><?php }?>  <p><?php   echo $nomizao;  ?></p>

        <?php

    }
}

?>
                

            
                <?php
                

                $sec = "select * from tb_post where id_user = '$test' order by cd_post desc";

                if($resposta = $mysqli->query($sec)){
                    if($resposta->num_rows==0){
                        echo "sem post";
                    }else{
                        while($linha = $resposta->fetch_object()){
                        $id = $linha->cd_post;
                        $titulo = $linha->ds_titulo;
                        $texto = $linha->ds_texto;
                        $imagem = $linha->im_imagem;
                        $data = $linha->ds_data;
                        $hora = $linha->ds_hora;
                        $postador = $linha->nm_postador;
                        $user = $linha->id_user;
                        $status = $linha->ds_status;
                       
                            if($status == 2){

                            
                        
                        ?>
        
                        <!-- Aqui esta ocorrendo a exibicao -->

                        
                       
                        <div id="panel" align="center">
                            <!-- Pegando link via url -->
                        <p> <a href="post.php?codigo_post=<?php  echo $id;?>" class="titulo"><?php echo $titulo;?></a></p>
                        
                            <!-- outros... -->
                        
                         <?php if($imagem!=null){?><p><img src="<?php echo $imagem; ?>" class="foto"/></p><?php }?>
                         <p><i class="bi bi-clock"></i> Postado em: <?php echo $data . " às " . $hora; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $postador;?> </p>
                            
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
                    window.location.href="perfil.php";
                </script>
                <?php
            }