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
    $sql = "select * from tb_pergunta where ds_titulo like '%$post%' order by cd_pergunta desc";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "Nenhum post encontrado...";
            ?>
                    <img src="https://s3.amazonaws.com/stickers.wiki/Animalnyan/494165.512.webp" alt="">

            <?php
        }else{
            while($linha = $resposta->fetch_object()){
                $_SESSION['id_duvida'] = $linha->cd_pergunta;
                $_SESSION['nm_duvida_usuario'] = $linha->nm_nome;
                $_SESSION['ds_duvida'] = $linha->ds_pergunta;
                $_SESSION['ds_data_duv'] = $linha->ds_data;
                $_SESSION['ds_hora_duv'] = $linha->ds_hora;
                $_SESSION['ds_titulo_duv'] = $linha->ds_titulo;
                $_SESSION['id_cod_pergunta'] = $linha->id_user_perg;


            ?>

            <!-- Aqui esta ocorrendo a exibicao -->
           
            <div id="panel" align="center">
          <!-- Pegando link via url -->
      <p> <a href="post_pergunta.php?pergunta_post=<?php echo $_SESSION['id_duvida']; ?>" class="titulo"><?php echo $_SESSION['ds_titulo_duv']; ?></a></p>
          <!-- outros... -->
       <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['ds_data_duv'] . " às " . $_SESSION['ds_hora_duv']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['nm_duvida_usuario'];?> </p>
  
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