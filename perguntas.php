<?php
include("conecta.php");
include("header.php");
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<!-- user tela -->
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
        <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
</head>
<body>
    <div class="cachota">

    <div>
                    
                    <br>
    
                            <?php
                            
                            $quantidade_nt = "select * from tb_notificacao where id_user_not = '".$_SESSION['codigo']."'";
    
                            if($resposta = $mysqli->query($quantidade_nt)){
                            if($resposta->num_rows==0){
                                define("qt_notificacao", $resposta->num_rows ." notificação");
                                ?>
                
                                <a href="notificacao.php"><i class="bi bi-bell"></i> <?php echo qt_notificacao; ?></a>
                                <?php
                            }else{
                    
                    
                                if($resposta->num_rows==1){
                                    define("qt_notificacao", $resposta->num_rows ." notificação");
                                    ?>
                    
                    <a href="notificacao.php"><i class="bi bi-bell"></i> <?php echo qt_notificacao; ?></a>
                                    <?php
                    
                                }elseif($resposta->num_rows > 1 ){
                    
                                    define("qt_notificacao", $resposta->num_rows ." notificações");
                    
                                    ?>
                                 <a href="notificacao.php">  <i class="bi bi-bell"></i> <?php echo qt_notificacao; ?> </a>
                                    <?php
                    
                                } 
                    
                    
                    }
                    }
                            
                            ?>
    
                    </div>

<br>
    <select name="linguagem" class="fazer_pesquisa" id="linguagem">
                    <option value="">Todos</option>
                    <option value="1">PHP</option>
                    <option value="2">HTML</option>
                    <option value="3">CSS</option>
                    <option value="4">Java Script</option>
                </select>

                <input type="text" id="bacon" name="filtro_post" class="filtro_post">   
    <input type="submit" id="btn-default" class="filtrar" value="Pesquisar">

    <div id="panel">
        <p id="questao" >Fazer pergunta</p>
    <div class="pergunta">
        <p><h3>Faça uma pergunta</h3></p>
        <br>
        <p>Titulo:</p>
        <p><span><textarea id="titulo" ></textarea></span></p>
        <br>
        <p>Duvida:</p>
        <textarea id="duvida"></textarea>
        <p>
                <select name="linguagem" class="inserir_linguagem" id="linguagem">
                    <option value="1">PHP</option>
                    <option value="2">HTML</option>
                    <option value="3">CSS</option>
                    <option value="4">Java Script</option>
                </select>
                </p>
        <p><a id="perguntar">Enviar</a></p> <p id="cancel">Cancelar</p>
        
    </div>
    </div>

    

<script>

                        //filtro
                        $(".filtrar").click(function(){
                    $.ajax({
                url: "filtro_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    filtro_post: $(".filtro_post").val()
                    
                },
                success: (resposta)=>{
                    $("#publicacao").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
                });

                // else 

                $(".filtro_post").change(function(){
                    $.ajax({
                url: "filtro_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    filtro_post: $(".filtro_post").val()
                    
                },
                success: (resposta)=>{
                    $("#publicacao").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
                });


                    // Pesquisa

                    $("#linguagem").change(function(){
                    $.ajax({
                url: "pesquisar_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    linguagem_pesquisa: $(".fazer_pesquisa").val()
                    
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

    // painel pergunta
    $(".pergunta").hide();
    $("#questao").click(function(){
        $(".pergunta").show();
        $("#questao").hide();
    });
    $("#cancel").click(function(){
        $(".pergunta").hide();
        $("#questao").show();
    });

    // perguntando

                $("#perguntar").click(function(){
                $.ajax({
            url: "pergunta.php",
            type: "POST",
            dataType: "html",

            data:{
                ovo: $("#duvida").val(),
                title: $("#titulo").val(),
                language: $(".inserir_linguagem").val()
                
            },
            success: (resposta)=>{
                $("body").html(resposta);
            }

        }).fail(function(jqXHR, textStatus ) {
            console.log("Request failed: " + textStatus);

        }).always(function() {
            console.log("");
        }); 
            });

</script>
    <div id="publicacao">
  <?php  

$duvida = "select * from tb_pergunta order by cd_pergunta desc";

if($resposta = $mysqli->query($duvida)){
  if($resposta->num_rows==0){
    echo "hmm... ainda não há post";
    ?>
            <img src="https://i.pinimg.com/originals/15/9e/35/159e35262eb699c6ca6fcce9a82e2861.png" alt="">

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
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
    <script>
        $('#duvida').trumbowyg({
            lang: 'pt_br',
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['upload'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ],

    plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: 'upload_pergunta.php',
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
</body>
</html>
<?php
}
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2){
    ?>
    <!-- adm tela -->
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
        <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
</head>
<body>
    <div class="cachota">
<br>
    <select name="linguagem" class="fazer_pesquisa" id="linguagem">
                    <option value="">Todos</option>
                    <option value="1">PHP</option>
                    <option value="2">HTML</option>
                    <option value="3">CSS</option>
                    <option value="4">Java Script</option>
                </select>

                <input type="text" id="bacon" name="filtro_post" class="filtro_post">   
    <input type="submit" id="btn-default" class="filtrar" value="Pesquisar">

    <div id="panel">
        <p id="questao" >Fazer pergunta</p>
    <div class="pergunta">
        <p><h3>Faça uma pergunta</h3></p>
        <br>
        <p>Titulo:</p>
        <textarea id="titulo" ></textarea>
        <br>
        <p>Duvida:</p>
        <textarea id="duvida" ></textarea>
        <p>
                <select name="linguagem" class="inserir_linguagem" id="linguagem">
                    <option value="1">PHP</option>
                    <option value="2">HTML</option>
                    <option value="3">CSS</option>
                    <option value="4">Java Script</option>
                </select>
                </p>
        <p><a id="perguntar">Enviar</a></p> <p id="cancel">Cancelar</p>
        
    </div>
    </div>

    

<script>

                        //filtro
                        $(".filtrar").click(function(){
                    $.ajax({
                url: "filtro_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    filtro_post: $(".filtro_post").val()
                    
                },
                success: (resposta)=>{
                    $("#publicacao").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
                });

                // else 

                $(".filtro_post").change(function(){
                    $.ajax({
                url: "filtro_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    filtro_post: $(".filtro_post").val()
                    
                },
                success: (resposta)=>{
                    $("#publicacao").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
                });

                    // Pesquisa

                    $("#linguagem").change(function(){
                    $.ajax({
                url: "pesquisar_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    linguagem_pesquisa: $(".fazer_pesquisa").val()
                    
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

    // painel pergunta
    $(".pergunta").hide();
    $("#questao").click(function(){
        $(".pergunta").show();
        $("#questao").hide();
    });
    $("#cancel").click(function(){
        $(".pergunta").hide();
        $("#questao").show();
    });

    // perguntando

                $("#perguntar").click(function(){
                $.ajax({
            url: "pergunta.php",
            type: "POST",
            dataType: "html",

            data:{
                ovo: $("#duvida").val(),
                title: $("#titulo").val(),
                language: $(".inserir_linguagem").val()
                
            },
            success: (resposta)=>{
                $("body").html(resposta);
            }

        }).fail(function(jqXHR, textStatus ) {
            console.log("Request failed: " + textStatus);

        }).always(function() {
            console.log("");
        }); 
            });

</script>
<div id="publicacao">
  <?php  

$duvida = "select * from tb_pergunta order by cd_pergunta desc";

if($resposta = $mysqli->query($duvida)){
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
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>

    <script>
        $('#duvida').trumbowyg({
            lang: 'pt_br',
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['upload'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ],

    plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: 'upload_pergunta.php',
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
</body>
</html>
<?php
}elseif(!isset($_SESSION['nivel'])){
    ?>
    <!-- visitante tela -->
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
</head>
<body>
    <div class="cachota">

    <div>
                    
                    <br>
    
                            <?php
                            
                            $quantidade_nt = "select * from tb_notificacao where id_user_not = '".$_SESSION['codigo']."'";
    
                            if($resposta = $mysqli->query($quantidade_nt)){
                            if($resposta->num_rows==0){
                                define("qt_notificacao", $resposta->num_rows ." notificação");
                                ?>
                
                                <a href="notificacao.php"><i class="bi bi-bell"></i> <?php echo qt_notificacao; ?></a>
                                <?php
                            }else{
                    
                    
                                if($resposta->num_rows==1){
                                    define("qt_notificacao", $resposta->num_rows ." notificação");
                                    ?>
                    
                    <a href="notificacao.php"><i class="bi bi-bell"></i> <?php echo qt_notificacao; ?></a>
                                    <?php
                    
                                }elseif($resposta->num_rows > 1 ){
                    
                                    define("qt_notificacao", $resposta->num_rows ." notificações");
                    
                                    ?>
                                 <a href="notificacao.php">  <i class="bi bi-bell"></i> <?php echo qt_notificacao; ?> </a>
                                    <?php
                    
                                } 
                    
                    
                    }
                    }
                            
                            ?>
    
                    </div>

    <br>
    <select name="linguagem" class="fazer_pesquisa" id="linguagem">
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
                url: "pesquisar_duvida.php",
                type: "POST",
                dataType: "html",

                data:{
                    linguagem_pesquisa: $(".fazer_pesquisa").val()
                    
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
   <div id="publicacao"> 
  <?php  

$duvida = "select * from tb_pergunta order by cd_pergunta desc";

if($resposta = $mysqli->query($duvida)){
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


      ?>

      <!-- Aqui esta ocorrendo a exibicao -->
     
      <div id="panel" align="center">
          <!-- Pegando link via url -->
          <p> <a href="post_pergunta.php?pergunta_post=<?php echo $_SESSION['id_duvida']; ?>" class="titulo"><?php echo $_SESSION['ds_titulo_duv']; ?></a></p>
  
      <p><?php echo $_SESSION['ds_duvida']; ?></p>
          <!-- outros... -->
       <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['ds_data_duv'] . " às " . $_SESSION['ds_hora_duv']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['nm_duvida_usuario'];?> </p>
  
 </div> 
 <?php

 }



}


}

?>
</div>
</body>
</html>
<?php
}
