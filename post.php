<?php

include("conecta.php");
include("header.php");
// usuario tela
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){

    $_SESSION['ident_post'] = $_GET['codigo_post'];


$sql = "select * from tb_post where cd_post = '".$_SESSION['ident_post']."'";

// selecionando dados do post

if($resposta = $mysqli->query($sql)){
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
        $_SESSION['linguagem'] = $linha->ds_linguagem;

        ?>
        <!-- Exibindo conteudo post -->
        <div class="cachota">
<div id="conteudo_pagina">
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="css/header.css">
            <!-- CSS only -->
            <!-- JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
            <title>Post - Usuario</title>
</head>
<body>

<?php

           if($_SESSION['id_user_post'] == $_SESSION['codigo']){
            
                
          
                

        ?>


<div id="panel" align="left">
                <p> <a href="post.php?codigo_post=<?php $post =  $_SESSION['id']; echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
                 <?php if($_SESSION['texto']!=null){?><p class="descricao"><?php echo $_SESSION['texto'];?></p><?php }?>
                 <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>

                 <p> <a href="alterar_post.php?pegando_post=<?php  echo $_SESSION['id'];?>" class="titulo">Editar</a></p>


              

                 <p> <a id="deleting">Deletar</a></p>

<div class="burocracia">
    <p>Deseja deletar esse post?</p>
    <p> <a href="deletar_post.php?deletando_post=<?php  echo $_SESSION['id'];?>">Deletar</a></p>
    <p><a id="cancelar">Não</a></p>
</div>

<script>
$(".burocracia").hide();
$("#deleting").click(function(){
    $(".burocracia").show();
    $("#cancelar").click(function(){
        $(".burocracia").hide();
    });

});
</script>

           </div>
               <?php 

  }else{
    ?>
    <div id="panel" align="left">
                <p> <a href="post.php?codigo_post=<?php $post =  $_SESSION['id']; echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
                 <?php if($_SESSION['texto']!=null){?><p class="descricao"><?php echo $_SESSION['texto'];?></p><?php }?>
                 <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>

               
           </div>
           <?php
  }
  ?>

</body>
</html>
<?php



}
}
}
?>

<!-- fim exibicao post -->


<!-- Curtir, teste -->

<div id="panel">

 

        <!-- <p><input type="hidden" name="valor_curt" value="1"></p> -->
        <p><i class="fa-regular fa-heart"></i><input type="submit" id="curtir" value="Curtir" class="btn btn-button"></p>
        <!-- <input type="hidden" name="curtir_post" value="enjoy"> -->

   

    <!-- Verificando like -->

    <script>
        $(document).ready(function(){
            $("#curtir").click(function(){
                $.ajax({
                url: "curtir.php",
                type: "POST",
                dataType: "html",

                data:{
                    id: <?php echo $_SESSION['ident_post']; ?>,
                    id_us: <?php echo $_SESSION['codigo']; ?>
                    
                },
                success: (resposta)=>{
                    $("#like").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
            });

            $("#comentar_botao").click(function(){
                $.ajax({
                url: "comentario.php",
                type: "POST",
                dataType: "html",

                data:{
                    comentario_usuario: $("#comentario").val(),
                    id_comentario: <?php echo $_SESSION['ident_post']; ?>
                    
                },
                success: (resposta)=>{
                    $("#testando").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 

            

            });



        });
    </script>


    <hr>

    <!-- selecionando like -->

    <div id="like">
    <p> 
<?php

         $sel_like = "select * from tb_curtir where id_post_curtir = '".$_SESSION['ident_post']."'";

    if($resposta = $mysqli->query($sel_like)){
        if($resposta->num_rows==0){
             $_SESSION['qt_like'] =$resposta->num_rows ." like";
            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like']; ?> 
            <?php
        }else{
        if($resposta->num_rows==1){
            $_SESSION['qt_like'] =$resposta->num_rows ." like";
            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like']; ?> 
            <?php
        }elseif($resposta->num_rows > 1 ){

            $_SESSION['qt_like'] = $resposta->num_rows ." likes";

            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like']; ?> 
            <?php

        } 
            
            }

        }

?>

</p>

</div>

<!-- comentario quantidade -->
<p>
<?php

    $coment = "select * from tb_comentario where id_post = '".$_SESSION['ident_post']."' order by cd_comentario desc";

        if($resposta = $mysqli->query($coment)){
        if($resposta->num_rows==0){
            define("qt_comentario", $resposta->num_rows ." comentario");
            ?>

            <i class="bi bi-chat-dots"></i> <?php echo qt_comentario; ?>
            <?php

        }else{


            if($resposta->num_rows==1){
                define("qt_comentario", $resposta->num_rows ." comentario");
                ?>

                <i class="bi bi-chat-dots"></i> <?php echo qt_comentario; ?>
                <?php

            }elseif($resposta->num_rows > 1 ){

                define("qt_comentario", $resposta->num_rows ." comentarios");

                ?>
               <i class="bi bi-chat-dots"></i> <?php echo qt_comentario; ?>
                <?php

            } 


}
}

?>
</p>

    

</div>

<!-- aba comentario -->

<div id="testando">

<div id="panel">
   
        <p><?php echo "Digite algo, " . $_SESSION['nome'] . ":";?></p>
        <p><textarea name="comentario" id="comentario" class="form form-control" placeholder="Digite uma mensagem" ></textarea></p>
        <p><input type="submit" id="comentar_botao" value="enviar" class="btn btn-button"></p>
     

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>

    <script>
        $('#comentario').trumbowyg({
            lang: 'pt_br',
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['link'],
        ['insertImage'],
        ['upload'],
        ['horizontalRule']
    ],

    plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: 'upload.php',
            fileFieldName: 'image',
            headers: {
                'Authorization': 'Client-ID xxxxxxxxxxxx'
            },
            urlPropertyName: 'file'
        }, 

        resizimg: {
            minSize: 64,
            step: 16,
        }
        
    },
    autogrow: true
});

    </script>
<!-- verificando comentario -->

<hr>

<!-- selecionando comentario -->

    <?php

// $coment = "SELECT * FROM tb_comentario RIGHT JOIN tb_usuario ON tb_comentario.id_imagem = tb_usuario.ds_img";
$coment = "select * from tb_comentario where id_post = '".$_SESSION['ident_post']."' order by cd_comentario desc";
    
    if($resposta = $mysqli->query($coment)){
        if($resposta->num_rows==0){
            echo "sem comentario";
        }else{

            // pegando a quantidade de comentario

          

            while($linha = $resposta->fetch_object()){
                $cod_comentario = $linha->cd_comentario;
            $_SESSION['nome_comentario'] = $linha->nm_comentario_nome;
            $_SESSION['desc_coment'] = $linha->ds_comentario;
            $_SESSION['data_coment'] = $linha->ds_data;
            $_SESSION['hora_coment'] = $linha->ds_hora;    
            $_SESSION['comentario_perfil'] = $linha->id_imagem;
            $comentario_id = $linha->id_user_comentario;
     
    ?>
<?php

if($_SESSION['nome_comentario'] == $_SESSION['nome']){

?>
<div id="comentario_exibir">

<div id="resposta_comm">
<p><img src="<?php echo $_SESSION['comentario_perfil']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $comentario_id;?>"><?php echo " " . $_SESSION['nome_comentario']; ?></a></b></p>
<p class="list-group-item"><?php echo $_SESSION['desc_coment']; ?></p>
<p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment'] . " às " . $_SESSION['hora_coment'];?></p>



<p><a id="responder" href="javascript::" onclick="load_page('resposta.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button">Responder   </a> 

<a id="responder" href="javascript::" onclick="page('respostas_exibir.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button"><i class="bi bi-arrow-down-square"></i></a> Respondidos  <a onclick="crica()" ><i class="bi bi-trash"></i></a></p> 

</div>

<script>
              function crica(){
                   $.ajax({
       url: "deletar_comentario.php",
       type: "GET",
       dataType: "html",

       data:{
           del: <?php echo $cod_comentario; ?>
           
       },
       success: (resposta)=>{
           $("#resposta_comm").html(resposta);
       }

   }).fail(function(jqXHR, textStatus ) {
       console.log("Request failed: " + textStatus);

   }).always(function() {
       console.log("");
   }); 
               };
           </script>

<?php
}else{
?>

<div id="comentario_exibir">

<div id="resposta_comm">
<p><img src="<?php echo $_SESSION['comentario_perfil']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $comentario_id;?>"><?php echo " " . $_SESSION['nome_comentario']; ?></a></b></p>
<p class="list-group-item"><?php echo $_SESSION['desc_coment']; ?></p>
<p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment'] . " às " . $_SESSION['hora_coment'];?></p>



<p><a id="responder" href="javascript::" onclick="load_page('resposta.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button">Responder   </a> 

<a id="responder" href="javascript::" onclick="page('respostas_exibir.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button"><i class="bi bi-arrow-down-square"></i></a> Respondidos </p> 
</div>
<?php
}
?>

                <script>

                function page(arquivo){

                    if(arquivo){
                    $.ajax({
                    url: arquivo,
                    type: 'GET',
                    data: arquivo,
                    success: function(data){
                        $("#testando").html(data);
                    }

                });
                    }
                }

                function load_page(arquivo){

                    if(arquivo){
                    $.ajax({
                    url: arquivo,
                    type: 'GET',
                    data: arquivo,
                    success: function(data){
                        $("#testando").html(data);
                    }

                });
                    }
                }


                </script>
<!-- fim resposta -->

                <!-- css foto -->
                <style>
                    .foto-coment{
                        width: 30px;
                        height: 30px;
                        border-radius: 3px;
                    }
                </style>


    </div>
    <?php

        }
    }

}

    ?>
    
</div>


</div>

        </div>
        <?php
// adm tela
}if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2){
    $_SESSION['ident_post'] = $_GET['codigo_post'];


$sql = "select * from tb_post where cd_post = '".$_SESSION['ident_post']."'";

// selecionando dados do post

if($resposta = $mysqli->query($sql)){
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
        $_SESSION['linguagem'] = $linha->ds_linguagem;

        ?>
        <!-- Exibindo conteudo post -->
        <div class="cachota">
<div id="conteudo_pagina">
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="css/header.css">
            <!-- CSS only -->
            <!-- JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
            <title>Post - ADM</title>
</head>
<body>


<?php

           if($_SESSION['id_user_post'] == $_SESSION['codigo']){
            
                
          
                

        ?>


<div id="panel" align="left">
                <p> <a href="post.php?codigo_post=<?php $post =  $_SESSION['id']; echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
                 <?php if($_SESSION['texto']!=null){?><p class="descricao"><?php echo $_SESSION['texto'];?></p><?php }?>
                 <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>

                 <p> <a href="alterar_post.php?pegando_post=<?php  echo $_SESSION['id'];?>" class="titulo">Editar</a></p>

                 <p> <a id="deleting">Deletar</a></p>

                    <div class="burocracia">
                        <p>Deseja deletar esse post?</p>
                        <p> <a href="deletar_post.php?deletando_post=<?php  echo $_SESSION['id'];?>" class="titulo">Sim</a></p>
                        <p><a id="cancelar">Não</a></p>
                    </div>

                 <script>
                    $(".burocracia").hide();
                    $("#deleting").click(function(){
                        $(".burocracia").show();
                        $("#cancelar").click(function(){
                            $(".burocracia").hide();
                        });

                    });
                 </script>

           </div>
               <?php
           }else{
            ?>
            <div id="panel" align="left">
                <p> <a href="post.php?codigo_post=<?php $post =  $_SESSION['id']; echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
                 <?php if($_SESSION['texto']!=null){?><p class="descricao"><?php echo $_SESSION['texto'];?></p><?php }?>
                 <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>

                 

                 <p> <a id="deleting">Deletar</a></p>

                    <div class="burocracia">
                        <p>Deseja deletar esse post?</p>
                        <p> <a href="deletar_post.php?deletando_post=<?php  echo $_SESSION['id'];?>" class="titulo">Sim</a></p>
                        <p><a id="cancelar">Não</a></p>
                    </div>

                 <script>
                    $(".burocracia").hide();
                    $("#deleting").click(function(){
                        $(".burocracia").show();
                        $("#cancelar").click(function(){
                            $(".burocracia").hide();
                        });

                    });
                 </script>

           </div>
            <?php
           }
           ?>

</body>
</html>
<?php



}
}
}
?>

<!-- fim exibicao post -->


<!-- Curtir, teste -->

<div id="panel">

 

        <!-- <p><input type="hidden" name="valor_curt" value="1"></p> -->
        <p><i class="fa-regular fa-heart"></i><input type="submit" id="curtir" value="Curtir" class="btn btn-button"></p>
        <!-- <input type="hidden" name="curtir_post" value="enjoy"> -->

   

    <!-- Verificando like -->

    <script>
        $(document).ready(function(){
            $("#curtir").click(function(){
                $.ajax({
                url: "curtir.php",
                type: "POST",
                dataType: "html",

                data:{
                    id: <?php echo $_SESSION['ident_post']; ?>,
                    id_us: <?php echo $_SESSION['codigo']; ?>
                    
                },
                success: (resposta)=>{
                    $("#like").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
            });

            $("#comentar_botao").click(function(){
                $.ajax({
                url: "comentario.php",
                type: "POST",
                dataType: "html",

                data:{
                    comentario_usuario: $("#comentario").val(),
                    id_comentario: <?php echo $_SESSION['ident_post']; ?>
                    
                },
                success: (resposta)=>{
                    $("#testando").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 

            

            });



        });
    </script>


    <hr>

    <!-- selecionando like -->

    <div id="like">
    <p> 
<?php

         $sel_like = "select * from tb_curtir where id_post_curtir = '".$_SESSION['ident_post']."'";

    if($resposta = $mysqli->query($sel_like)){
        if($resposta->num_rows==0){
             $_SESSION['qt_like'] =$resposta->num_rows ." like";
            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like']; ?> 
            <?php
        }else{
        if($resposta->num_rows==1){
            $_SESSION['qt_like'] =$resposta->num_rows ." like";
            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like']; ?> 
            <?php
        }elseif($resposta->num_rows > 1 ){

            $_SESSION['qt_like'] = $resposta->num_rows ." likes";

            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like']; ?> 
            <?php

        } 
            
            }

        }

?>

</p>
</div>
<!-- comentario quantidade -->
<p>
<?php

    $coment = "select * from tb_comentario where id_post = '".$_SESSION['ident_post']."' order by cd_comentario desc";

        if($resposta = $mysqli->query($coment)){
        if($resposta->num_rows==0){
            define("qt_comentario", $resposta->num_rows ." comentario");
            ?>

            <i class="bi bi-chat-dots"></i> <?php echo qt_comentario; ?>
            <?php

        }else{


            if($resposta->num_rows==1){
                define("qt_comentario", $resposta->num_rows ." comentario");
                ?>

                <i class="bi bi-chat-dots"></i> <?php echo qt_comentario; ?>
                <?php

            }elseif($resposta->num_rows > 1 ){

                define("qt_comentario", $resposta->num_rows ." comentarios");

                ?>
               <i class="bi bi-chat-dots"></i> <?php echo qt_comentario; ?>
                <?php

            } 


}
}

?>
</p>

   

</div>

<!-- aba comentario -->

<div id="testando">

<div id="panel">
   
        <p><?php echo "Digite algo, " . $_SESSION['nome'] . ":";?></p>
        <p><textarea name="comentario" id="comentario" class="form form-control" placeholder="Digite uma mensagem" ></textarea></p>
        <p><input type="submit" id="comentar_botao" value="enviar" class="btn btn-button"></p>
     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>

    <script>
        $('#comentario').trumbowyg({
            lang: 'pt_br',
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['link'],
        ['insertImage'],
        ['upload'],
        ['horizontalRule']
    ],

    plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: 'upload.php',
            fileFieldName: 'image',
            headers: {
                'Authorization': 'Client-ID xxxxxxxxxxxx'
            },
            urlPropertyName: 'file'
        }, 

        resizimg: {
            minSize: 64,
            step: 16,
        }
        
    },
    autogrow: true
});

    </script>

<!-- verificando comentario -->

<hr>

<!-- selecionando comentario -->


    <?php

// $coment = "SELECT * FROM tb_comentario RIGHT JOIN tb_usuario ON tb_comentario.id_imagem = tb_usuario.ds_img";
$coment = "select * from tb_comentario where id_post = '".$_SESSION['ident_post']."' order by cd_comentario desc";
    
    if($resposta = $mysqli->query($coment)){
        if($resposta->num_rows==0){
            echo "sem comentario";
        }else{

            // pegando a quantidade de comentario

          

            while($linha = $resposta->fetch_object()){
                $cod_comentario = $linha->cd_comentario;
            $_SESSION['nome_comentario'] = $linha->nm_comentario_nome;
            $_SESSION['desc_coment'] = $linha->ds_comentario;
            $_SESSION['data_coment'] = $linha->ds_data;
            $_SESSION['hora_coment'] = $linha->ds_hora;    
            $_SESSION['comentario_perfil'] = $linha->id_imagem;
            $comentario_id = $linha->id_user_comentario;
     
    ?>
    <!-- exibicao comentario -->
    

<!-- resposta do comentario -->

<?php

                if($_SESSION['nome_comentario'] == $_SESSION['nome']){

?>
    <div id="comentario_exibir">
    
             <div id="resposta_comm">
                <p><img src="<?php echo $_SESSION['comentario_perfil']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $comentario_id;?>"><?php echo " " . $_SESSION['nome_comentario']; ?></a></b></p>
                <p class="list-group-item"><?php echo $_SESSION['desc_coment']; ?></p>
                <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment'] . " às " . $_SESSION['hora_coment'];?></p>

                

<p><a id="responder" href="javascript::" onclick="load_page('resposta.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button">Responder   </a> 

<a id="responder" href="javascript::" onclick="page('respostas_exibir.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button"><i class="bi bi-arrow-down-square"></i></a> Respondidos  <a onclick="crica()" ><i class="bi bi-trash"></i></a></p> 

 </div>

<script>
                              function crica(){
                                   $.ajax({
                       url: "deletar_comentario.php",
                       type: "GET",
                       dataType: "html",
           
                       data:{
                           del: <?php echo $cod_comentario; ?>
                           
                       },
                       success: (resposta)=>{
                           $("#resposta_comm").html(resposta);
                       }
           
                   }).fail(function(jqXHR, textStatus ) {
                       console.log("Request failed: " + textStatus);
           
                   }).always(function() {
                       console.log("");
                   }); 
                               };
                           </script>

<?php
}else{
    ?>

    <div id="comentario_exibir">
    
             <div id="resposta_comm">
                <p><img src="<?php echo $_SESSION['comentario_perfil']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $comentario_id;?>"><?php echo " " . $_SESSION['nome_comentario']; ?></a></b></p>
                <p class="list-group-item"><?php echo $_SESSION['desc_coment']; ?></p>
                <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment'] . " às " . $_SESSION['hora_coment'];?></p>

               

    <p><a id="responder" href="javascript::" onclick="load_page('resposta.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button">Responder   </a> 

<a id="responder" href="javascript::" onclick="page('respostas_exibir.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button"><i class="bi bi-arrow-down-square"></i></a> Respondidos </p> 
  </div>
<?php
}
?>


<script>
                function page(arquivo){

if(arquivo){
$.ajax({
url: arquivo,
type: 'GET',
data: arquivo,
success: function(data){
    $("#testando").html(data);
}

});
}
}

function load_page(arquivo){

if(arquivo){
$.ajax({
url: arquivo,
type: 'GET',
data: arquivo,
success: function(data){
    $("#testando").html(data);
}

});
}
}

                </script>
<!-- fim resposta -->

                <!-- css foto -->
                <style>
                    .foto-coment{
                        width: 30px;
                        height: 30px;
                        border-radius: 3px;
                    }
                </style>

    </div>

    <?php

        }
    }

}

    ?>
    
</div>


</div>

        </div>
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
