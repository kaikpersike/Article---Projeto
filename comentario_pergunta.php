
<?php

include("conecta.php");

$comentario_usuario=$_POST['comentario_usuario'];
$id_comentario=$_POST['id_comentario'];

if(isset($comentario_usuario)) {
    $nome_comentario = $_SESSION['nome'];
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/Y");
    $hora = date("h:i");
    $imagem_comentario = $_SESSION['perfil'];
    $play = $_SESSION['codigo'];
     if($comentario_usuario == null){
        echo "Voce precisa digitar algo antes de enviar";
     }else{

        $con_comentario = "insert into tb_duvida_comentario (id_post_duv, nm_nome_duv, ds_comentario_duv, ds_data_duv, ds_hora_duv, id_img_duvida, id_duv_user, ds_melhor_res) values ('$id_comentario', '$nome_comentario', '$comentario_usuario', '$data', '$hora', '$imagem_comentario', '$play', '1')";

        if($resposta = $mysqli->query($con_comentario)){
            
        }

     }
     ?>

    <script>
        $(document).ready(function(){


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
}
