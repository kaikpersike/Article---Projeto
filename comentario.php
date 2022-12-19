
<?php

include("conecta.php");


$comentario_usuario=$_POST['comentario_usuario'];
$id_comentario=$_POST['id_comentario'];
// $mia = $_POST['mias'];

if(isset($comentario_usuario)) {
    $nome_comentario = $_SESSION['nome'];
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/Y");
    $hora = date("h:i");
    $imagem_comentario = $_SESSION['perfil'];
    $codigao = $_SESSION['codigo'];
     if($comentario_usuario == null){
        ?>
        <script>alert("você precisa digitar algo");</script>
        <?php
     }else{

        $con_comentario = "insert into tb_comentario (id_post, nm_comentario_nome, ds_comentario, ds_data, ds_hora, id_imagem, id_user_comentario) values ('$id_comentario', '$nome_comentario', '$comentario_usuario', '$data', '$hora', '$imagem_comentario', '$codigao')";

        if($resposta = $mysqli->query($con_comentario)){

                    // $voa = "insert into tb_resposta (cd_resposta, nm_usuario_resposta, ds_resposta, id_comentario) values (null, '$nome_comentario', null, '$mia')";
                    // if($resposta = $mysqli->query($voa)){
    
                    // }
                


        
        }

    }



}

?>




<script>
    $(document).ready(function(){

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
