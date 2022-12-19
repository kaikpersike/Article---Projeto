<?php
include("conecta.php");

$resposta_cod = $_GET['inserindo'];
$otexto = $_GET['ovo'];

if(isset($resposta_cod)){
$sql = "insert into tb_resposta values(null, '".$_SESSION['nome']."', '$otexto', '$resposta_cod')";

if($mysqli->query($sql)){


    $consulta = "select * from tb_resposta where id_comentario = '$resposta_cod' ";

    if($resposta = $mysqli->query($consulta)){
        
            while($linha = $resposta->fetch_object()){
                $nome_resposta = $linha->nm_usuario_resposta;
                $texto = $linha->ds_resposta;
                ?>
          <fieldset>  
            <p>
            Publicado por: <br>

            <?php echo $nome_resposta; ?>
                
            </p> 
            <p>Comentario: <br> <?php echo $texto; ?></p> 
        </fieldset>
            
                <?php
            }
        
    }
    ?>

<div id="resposta_comm">
<p><?php $nome_res = $_SESSION['nome']; echo "Digite algo, " . $nome_res. ":";?></p>
<p><textarea name="comentario_res" id="comentario_res_enviar" class="form form-control" placeholder="Digite uma mensagem" ></textarea></p>

<p><a href="javascript::" onclick="load_page('resposta_inserir.php?inserindo=<?php echo $resposta_cod; ?>')" class="btn btn-button">Enviar</a></p> <p><a id="cancel">Cancelar</a></p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>

    <script>
        $('#comentario_res_enviar').trumbowyg({
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

</div>

<script>
$("#cancel").click(function(){
    window.location.href="post.php?codigo_post=<?php $post =  $_SESSION['id']; echo $post;?>";
});

function load_page(arquivo){
    if(arquivo){
    $.ajax({
    url: arquivo,
    type: 'GET',
    data:{
        arquivo,
        ovo: $("#comentario_res_enviar").val()
    },
    success: function(data){
        $("#corpinho").html(data);
    }

});
    }
}


       


</script>

<?php
}
}
?>
