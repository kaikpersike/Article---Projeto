<?php

include("conecta.php");

if($_SESSION['nivel'] != 2 && $_SESSION['nivel'] != 1){
    ?>
    <script>
        alert("Você não tem acesso a esta página");
        window.location.href = "index.php";
    </script>
    <?php
}else{
  

    $sql = "select * from tb_usuario where cd_usuario='".$_SESSION['codigo']."'";

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



$post = $_POST['filtro_post'];
if(isset($post)){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
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
        
    
<?php
    $sql = "select * from tb_post where ds_titulo like '%$post%' and ds_status='2' order by cd_post desc";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "Nenhum post encontrado...";
            ?>
                    <img src="https://s3.amazonaws.com/stickers.wiki/Animalnyan/494165.512.webp" alt="">

            <?php
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
}
}
?>