<?php

include("conecta.php");
include("header.php");
// usuario tela
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){

    $_SESSION['ident_pergunta'] = $_GET['pergunta_post'];


$sql = "select * from tb_pergunta where cd_pergunta = '".$_SESSION['ident_pergunta']."'";

// selecionando dados do post

if($resposta = $mysqli->query($sql)){
    if($resposta->num_rows==0){
        echo "sem post";
    }else{
        while($linha = $resposta->fetch_object()){
            $_SESSION['id_duvida'] = $linha->cd_pergunta;
            $_SESSION['nm_duvida_usuario'] = $linha->nm_nome;
            $_SESSION['ds_duvida'] = $linha->ds_pergunta;
            $_SESSION['ds_data_duv'] = $linha->ds_data;
            $_SESSION['ds_hora_duv'] = $linha->ds_hora;
            $_SESSION['ds_titulo_duv'] = $linha->ds_titulo;
            $_SESSION['ds_linguagem_duv'] = $linha->ds_linguagem_duv;
            $_SESSION['id_cod_pergunta'] = $linha->id_user_perg;

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
            <title>Perguntas</title>
</head>
<body>

<?php

           if($_SESSION['id_cod_pergunta'] == $_SESSION['codigo']){
            
                
          
                

        ?>


<div id="panel" align="left">
                <p> <a href="post_pergunta.php?pergunta_post=<?php echo $_SESSION['id_duvida']; ?>" class="titulo"><?php echo $_SESSION['ds_titulo_duv']; ?></a></p>
            
                 <?php if($_SESSION['ds_duvida']!=null){?><p class="descricao"><?php echo $_SESSION['ds_duvida'];?></p><?php }?>
                 <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['ds_data_duv'] . " às " . $_SESSION['ds_hora_duv']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['nm_duvida_usuario'];?> </p>

                 <p> <a href="alterar_post_pergunta.php?pegando_post=<?php  echo $_SESSION['id_duvida'];?>" class="titulo">Editar</a></p>
                 <p> <a id="deleting">Deletar</a></p>

                    <div class="burocracia">
                        <p>Deseja deletar esse post?</p>
                        <p> <a href="deletar_duvida.php?deletando_duvida=<?php  echo $_SESSION['id_duvida'];?>" >Sim</a></p>
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

            <p> <a href="post_pergunta.php?pergunta_post=<?php echo $_SESSION['id_duvida']; ?>" class="titulo"><?php echo $_SESSION['ds_titulo_duv']; ?></a></p>
            
            <?php if($_SESSION['ds_duvida']!=null){?><p class="descricao"><?php echo $_SESSION['ds_duvida'];?></p><?php }?>
            <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['ds_data_duv'] . " às " . $_SESSION['ds_hora_duv']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>

               
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
                url: "curtir_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    id: <?php echo $_SESSION['ident_pergunta']; ?>,
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
                url: "comentario_pergunta.php",
                type: "POST",
                dataType: "html",

                data:{
                    comentario_usuario: $("#comentario").val(),
                    id_comentario: <?php echo $_SESSION['ident_pergunta']; ?>
                    
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

         $sel_like = "select * from tb_curtir_duv where id_post_duv = '".$_SESSION['ident_pergunta']."'";

    if($resposta = $mysqli->query($sel_like)){
        if($resposta->num_rows==0){
            $_SESSION['qt_like_duv'] =$resposta->num_rows ." like";
            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like_duv']; ?> 
            <?php
        }else{
        if($resposta->num_rows==1){
            $_SESSION['qt_like_duv'] =$resposta->num_rows ." like";
            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like_duv']; ?> 
            <?php
        }elseif($resposta->num_rows > 1 ){

            $_SESSION['qt_like_duv'] = $resposta->num_rows ." likes";

            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like_duv']; ?> 
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

    $coment = "select * from tb_duvida_comentario where id_post_duv = '".$_SESSION['ident_pergunta']."' order by cd_duv_comentario desc";

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
            serverPath: 'tete.php',
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
$coment = "select * from tb_duvida_comentario where id_post_duv = '".$_SESSION['ident_pergunta']."' order by cd_duv_comentario desc";
    
    if($resposta = $mysqli->query($coment)){
        if($resposta->num_rows==0){
            echo "sem comentario";
        }else{

            // pegando a quantidade de comentario

          

            while($linha = $resposta->fetch_object()){
                $cod_duv = $linha->cd_duv_comentario;
                $_SESSION['nome_comentario_duv'] = $linha->nm_nome_duv;
                $_SESSION['desc_coment_duv'] = $linha->ds_comentario_duv;
                $_SESSION['data_coment_duv'] = $linha->ds_data_duv;
                $_SESSION['hora_coment_duv'] = $linha->ds_hora_duv;    
                $_SESSION['comentario_perfil_duv'] = $linha->id_img_duvida;    
                $id_duv_user = $linha->id_duv_user;
                $chiclete = $linha->ds_melhor_res;

                if($_SESSION['id_cod_pergunta'] == $_SESSION['codigo']){

                    ?>
                    <!-- exibicao comentario -->
                
                    <?php
                    if($_SESSION['nome_comentario_duv'] == $_SESSION['nome']){
                    ?>
                    <div id="comentario_exibir">
                    <div id="resposta_comm">
                             
                    <p><img src="<?php echo $_SESSION['comentario_perfil_duv']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $id_duv_user;?>"><?php echo " " . $_SESSION['nome_comentario_duv']; ?></a></b></p>
                                <p class="list-group-item"><?php if($chiclete==2){echo "melhor resposta: " . $_SESSION['desc_coment_duv']; }else{echo $_SESSION['desc_coment_duv'];}?></p>
                                <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment_duv'] . " às " . $_SESSION['hora_coment_duv'] . " ";?>
                                </p>
                
                                <!-- --------------------------------inicio------------------------------------ -->
                
                <div class="dropdown">
                  <span><i class="bi bi-three-dots-vertical"></i></span>
                  <div class="dropdown-content">
                  
                  <a onclick="best()"><i class="bi bi-fire"></i></a> 
                  <a onclick="exclusao()" ><i class="bi bi-trash"></i></a> 
                  <i class="bi bi-pencil"></i>
                  </div>
                </div>
                
                <!-- --------------------------------fim--------------------------------------- -->
                                
                    </div>
                      </div>
                      <style>
                        .resposta_comm{
                            background-color: green;
                        }
                      </style>
                      <script>
                              function exclusao(){
                                   $.ajax({
                       url: "del_comentario_duv.php",
                       type: "GET",
                       dataType: "html",
                
                       data:{
                           del: <?php echo $cod_duv; ?>
                           
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
                
                               function best(){
                                   $.ajax({
                       url: "best_comment.php",
                       type: "GET",
                       dataType: "html",
                
                       data:{
                           best: <?php echo $cod_duv; ?>
                           
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
                            <p><img src="<?php echo $_SESSION['comentario_perfil_duv']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $id_duv_user;?>"><?php echo " " . $_SESSION['nome_comentario_duv']; ?></a></b></p>
                    <p class="list-group-item"><?php echo $_SESSION['desc_coment_duv']; ?></p>
                    <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment_duv'] . " às " . $_SESSION['hora_coment_duv'];?></p>
                    
                
                <!-- --------------------------------inicio------------------------------------ -->
                
                <div class="dropdown">
                  <span><i class="bi bi-three-dots-vertical"></i></span>
                  <div class="dropdown-content">
                  
                  <a onclick="best()"><i class="bi bi-fire"></i></a> 
                  <a onclick="exclusao()" ><i class="bi bi-trash"></i></a> 
                  </div>
                </div>
                
                
                
                <!-- --------------------------------fim--------------------------------------- -->
                
                    </div>
                </div>
                <script>
                              function exclusao(){
                                   $.ajax({
                       url: "del_comentario_duv.php",
                       type: "GET",
                       dataType: "html",
                
                       data:{
                           del: <?php echo $cod_duv; ?>
                           
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
                
                               function best(){
                                   $.ajax({
                       url: "best_comment.php",
                       type: "GET",
                       dataType: "html",
                
                       data:{
                           best: <?php echo $cod_duv; ?>
                           
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
                    }
                      ?>
                <!-- fim resposta -->
                
                                <!-- css foto -->
                                <style>
                                    .foto-coment{
                                        width: 30px;
                                        height: 30px;
                                        border-radius: 3px;
                                    }
                                </style>
                
                    
                
                    <?php
                            }else{
                
                                if($_SESSION['nome_comentario_duv'] == $_SESSION['nome']){
                                    ?>
                                    <div id="comentario_exibir">
                                    <div id="resposta_comm">
                                             
                                    <p><img src="<?php echo $_SESSION['comentario_perfil_duv']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $id_duv_user;?>"><?php echo " " . $_SESSION['nome_comentario_duv']; ?></a></b></p>
                                                <p class="list-group-item"><?php echo $_SESSION['desc_coment_duv']; ?></p>
                                                <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment_duv'] . " às " . $_SESSION['hora_coment_duv'] . " ";?></p>
                
                                <!-- --------------------------------inicio------------------------------------ -->
                
                                <div class="dropdown">
                  <span><i class="bi bi-three-dots-vertical"></i></span>
                  <div class="dropdown-content">
                  <a onclick="exclusao()" ><i class="bi bi-trash"></i></a> 
                  <i class="bi bi-pencil"></i>
                  </div>
                </div>
                
                                <!-- --------------------------------fim--------------------------------------- -->
                
                                    </div>
                                      </div>
                      <script>
                              function exclusao(){
                                   $.ajax({
                       url: "del_comentario_duv.php",
                       type: "GET",
                       dataType: "html",
                
                       data:{
                           del: <?php echo $cod_duv; ?>
                           
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
                                            <p><img src="<?php echo $_SESSION['comentario_perfil_duv']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $id_duv_user;?>"><?php echo " " . $_SESSION['nome_comentario_duv']; ?></a></b></p>
                                    <p class="list-group-item"><?php echo $_SESSION['desc_coment_duv']; ?></p>
                                    <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment_duv'] . " às " . $_SESSION['hora_coment_duv'];?></p>
                
                                    </div>
                                </div>
                
                                        <?php
                                    }
                                      ?>
                                <!-- fim resposta -->
                                
                                                <!-- css foto -->
                                                <style>
                                                    .foto-coment{
                                                        width: 30px;
                                                        height: 30px;
                                                        border-radius: 3px;
                                                    }
                                                </style>

                                                
                                                <?php
                
                            }

        }
    }

}

    ?>
    
</div>


</div>

        </div>
        <style>
.dropdown {
  position: relative;
  display: inline-block;  
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
        <?php
}if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2){
    $_SESSION['ident_pergunta'] = $_GET['pergunta_post'];


$sql = "select * from tb_pergunta where cd_pergunta = '".$_SESSION['ident_pergunta']."'";

// selecionando dados do post

if($resposta = $mysqli->query($sql)){
    if($resposta->num_rows==0){
        echo "sem post";
    }else{
        while($linha = $resposta->fetch_object()){
            $_SESSION['id_duvida'] = $linha->cd_pergunta;
            $_SESSION['nm_duvida_usuario'] = $linha->nm_nome;
            $_SESSION['ds_duvida'] = $linha->ds_pergunta;
            $_SESSION['ds_data_duv'] = $linha->ds_data;
            $_SESSION['ds_hora_duv'] = $linha->ds_hora;
            $_SESSION['ds_titulo_duv'] = $linha->ds_titulo;
            $_SESSION['id_cod_pergunta'] = $linha->id_user_perg;
            $_SESSION['ds_linguagem_duv'] = $linha->ds_linguagem_duv;

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
            <title>Perguntas</title>
</head>
<body>

<?php

           if($_SESSION['id_cod_pergunta'] == $_SESSION['codigo']){
            
                
          
                

        ?>

<div id="panel" align="left">
   
                <p> <a href="post_pergunta.php?pergunta_post=<?php echo $_SESSION['id_duvida']; ?>" class="titulo"><?php echo $_SESSION['ds_titulo_duv']; ?></a></p>
            
                 <?php if($_SESSION['ds_duvida']!=null){?><p class="descricao"><?php echo $_SESSION['ds_duvida'];?></p><?php }?>
                 <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['ds_data_duv'] . " às " . $_SESSION['ds_hora_duv']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['nm_duvida_usuario'];?> </p>
                 <p> <a href="alterar_post_pergunta.php?pegando_post=<?php  echo $_SESSION['id_duvida'];?>" class="titulo">Editar</a></p>

                 <p> <a id="deleting">Deletar</a></p>

                    <div class="burocracia">
                        <p>Deseja deletar esse post?</p>
                        <p> <a href="deletar_duvida.php?deletando_duvida=<?php  echo $_SESSION['id_duvida'];?>" >Sim</a></p>
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
   
   <p> <a href="post_pergunta.php?pergunta_post=<?php echo $_SESSION['id_duvida']; ?>" class="titulo"><?php echo $_SESSION['ds_titulo_duv']; ?></a></p>

    <?php if($_SESSION['ds_duvida']!=null){?><p class="descricao"><?php echo $_SESSION['ds_duvida'];?></p><?php }?>
    <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['ds_data_duv'] . " às " . $_SESSION['ds_hora_duv']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['nm_duvida_usuario'];?> </p>

    <p> <a id="deleting">Deletar</a></p>

       <div class="burocracia">
           <p>Deseja deletar esse post?</p>
           <p> <a href="deletar_duvida.php?deletando_duvida=<?php  echo $_SESSION['id_duvida'];?>" >Sim</a></p>
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
                url: "curtir_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    id: <?php echo $_SESSION['ident_pergunta']; ?>,
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
                url: "comentario_pergunta.php",
                type: "POST",
                dataType: "html",

                data:{
                    comentario_usuario: $("#comentario").val(),
                    id_comentario: <?php echo $_SESSION['ident_pergunta']; ?>
                    
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

         $sel_like = "select * from tb_curtir_duv where id_post_duv = '".$_SESSION['ident_pergunta']."'";

    if($resposta = $mysqli->query($sel_like)){
        if($resposta->num_rows==0){
            $_SESSION['qt_like_duv'] =$resposta->num_rows ." like";
            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like_duv']; ?> 
            <?php
        }else{
        if($resposta->num_rows==1){
            $_SESSION['qt_like_duv'] =$resposta->num_rows ." like";
            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like_duv']; ?> 
            <?php
        }elseif($resposta->num_rows > 1 ){

            $_SESSION['qt_like_duv'] = $resposta->num_rows ." likes";

            ?>
            <i class="fa-regular fa-heart"></i> <?php echo $_SESSION['qt_like_duv']; ?> 
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

    $coment = "select * from tb_duvida_comentario where id_post_duv = '".$_SESSION['ident_pergunta']."' order by cd_duv_comentario desc";

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
            serverPath: 'tete.php',
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
$coment = "select * from tb_duvida_comentario where id_post_duv = '".$_SESSION['ident_pergunta']."' order by cd_duv_comentario desc";
    
    if($resposta = $mysqli->query($coment)){
        if($resposta->num_rows==0){
            echo "sem comentario";
        }else{

            // pegando a quantidade de comentario

          

            while($linha = $resposta->fetch_object()){
                $cod_duv = $linha->cd_duv_comentario;
                $_SESSION['nome_comentario_duv'] = $linha->nm_nome_duv;
                $_SESSION['desc_coment_duv'] = $linha->ds_comentario_duv;
                $_SESSION['data_coment_duv'] = $linha->ds_data_duv;
                $_SESSION['hora_coment_duv'] = $linha->ds_hora_duv;    
                $_SESSION['comentario_perfil_duv'] = $linha->id_img_duvida;    
                $id_duv_user = $linha->id_duv_user;

                if($_SESSION['id_cod_pergunta'] == $_SESSION['codigo']){

    ?>
    <!-- exibicao comentario -->

    <?php
    if($_SESSION['nome_comentario_duv'] == $_SESSION['nome']){
    ?>
    <div id="comentario_exibir">
    <div id="resposta_comm">
             
    <p><img src="<?php echo $_SESSION['comentario_perfil_duv']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $id_duv_user;?>"><?php echo " " . $_SESSION['nome_comentario_duv']; ?></a></b></p>
                <p class="list-group-item"><?php echo $_SESSION['desc_coment_duv']; ?></p>
                <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment_duv'] . " às " . $_SESSION['hora_coment_duv'] . " ";?>
                </p>

                <!-- --------------------------------inicio------------------------------------ -->

<div class="dropdown">
  <span><i class="bi bi-three-dots-vertical"></i></span>
  <div class="dropdown-content">
  
  <a onclick="best()"><i class="bi bi-fire"></i></a> 
  <a onclick="exclusao()" ><i class="bi bi-trash"></i></a> 
  <i class="bi bi-pencil"></i>
  </div>
</div>

<!-- --------------------------------fim--------------------------------------- -->
                
    </div>
      </div>
      <script>
              function exclusao(){
                   $.ajax({
       url: "del_comentario_duv.php",
       type: "GET",
       dataType: "html",

       data:{
           del: <?php echo $cod_duv; ?>
           
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

               function best(){
                   $.ajax({
       url: "best_comment.php",
       type: "GET",
       dataType: "html",

       data:{
           best: <?php echo $cod_duv; ?>
           
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
            <p><img src="<?php echo $_SESSION['comentario_perfil_duv']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $id_duv_user;?>"><?php echo " " . $_SESSION['nome_comentario_duv']; ?></a></b></p>
    <p class="list-group-item"><?php echo $_SESSION['desc_coment_duv']; ?></p>
    <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment_duv'] . " às " . $_SESSION['hora_coment_duv'];?></p>
    

<!-- --------------------------------inicio------------------------------------ -->

<div class="dropdown">
  <span><i class="bi bi-three-dots-vertical"></i></span>
  <div class="dropdown-content">
  
  <a onclick="best()"><i class="bi bi-fire"></i></a> 
  <a onclick="exclusao()" ><i class="bi bi-trash"></i></a> 
  </div>
</div>



<!-- --------------------------------fim--------------------------------------- -->

    </div>
</div>
<script>
              function exclusao(){
                   $.ajax({
       url: "del_comentario_duv.php",
       type: "GET",
       dataType: "html",

       data:{
           del: <?php echo $cod_duv; ?>
           
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

               function best(){
                   $.ajax({
       url: "best_comment.php",
       type: "GET",
       dataType: "html",

       data:{
           best: <?php echo $cod_duv; ?>
           
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
    }
      ?>
<!-- fim resposta -->

                <!-- css foto -->
                <style>
                    .foto-coment{
                        width: 30px;
                        height: 30px;
                        border-radius: 3px;
                    }
                </style>

    

    <?php
            }else{

                if($_SESSION['nome_comentario_duv'] == $_SESSION['nome']){
                    ?>
                    <div id="comentario_exibir">
                    <div id="resposta_comm">
                             
                    <p><img src="<?php echo $_SESSION['comentario_perfil_duv']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $id_duv_user;?>"><?php echo " " . $_SESSION['nome_comentario_duv']; ?></a></b></p>
                                <p class="list-group-item"><?php echo $_SESSION['desc_coment_duv']; ?></p>
                                <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment_duv'] . " às " . $_SESSION['hora_coment_duv'] . " ";?></p>

                <!-- --------------------------------inicio------------------------------------ -->

                <div class="dropdown">
  <span><i class="bi bi-three-dots-vertical"></i></span>
  <div class="dropdown-content">
  <a onclick="exclusao()" ><i class="bi bi-trash"></i></a> 
  <i class="bi bi-pencil"></i>
  </div>
</div>

                <!-- --------------------------------fim--------------------------------------- -->

                    </div>
                      </div>
      <script>
              function exclusao(){
                   $.ajax({
       url: "del_comentario_duv.php",
       type: "GET",
       dataType: "html",

       data:{
           del: <?php echo $cod_duv; ?>
           
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
                            <p><img src="<?php echo $_SESSION['comentario_perfil_duv']; ?>" class="foto-coment"><b><a style="color: black;" href="perfil_visita.php?cd=<?php echo $id_duv_user;?>"><?php echo " " . $_SESSION['nome_comentario_duv']; ?></a></b></p>
                    <p class="list-group-item"><?php echo $_SESSION['desc_coment_duv']; ?></p>
                    <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment_duv'] . " às " . $_SESSION['hora_coment_duv'];?></p>

                <!-- --------------------------------inicio------------------------------------ -->

                <div class="dropdown">
  <span><i class="bi bi-three-dots-vertical"></i></span>
  <div class="dropdown-content">
  <a onclick="exclusao()" ><i class="bi bi-trash"></i></a> 

  </div>
</div>

                <!-- --------------------------------fim--------------------------------------- -->


                    </div>
                </div>

                <script>
              function exclusao(){
                   $.ajax({
       url: "del_comentario_duv.php",
       type: "GET",
       dataType: "html",

       data:{
           del: <?php echo $cod_duv; ?>
           
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
                    }
                      ?>
                <!-- fim resposta -->
                
                                <!-- css foto -->
                                <style>
                                    .foto-coment{
                                        width: 30px;
                                        height: 30px;
                                        border-radius: 3px;
                                    }
                                </style>
                                <?php

            }

        }
    }

}

    ?>
    
</div>


</div>

        </div>

        <style>
.dropdown {
  position: relative;
  display: inline-block;  
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>

        <?php
}elseif($_SESSION['nivel'] !=1 && $_SESSION['nivel'] !=2){
    ?>
    <script>
        alert("Voce precisa estar logado");
        window.location.href="index.php";
    </script>
    <?php
}
