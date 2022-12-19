<?php

include("conecta.php");


$codigo_resposta = $_GET['resposta'];
// $texto_resposta = $_GET['respondido'];


// $coment = "SELECT * FROM tb_comentario RIGHT JOIN tb_usuario ON tb_comentario.id_imagem = tb_usuario.ds_img";
$coment = "select * from tb_comentario where cd_comentario = '$codigo_resposta'";
    
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
     
    ?>
    <!-- exibicao comentario -->
    <div id="panel">
    <div id="comentario_exibir">
             
                <p><img src="<?php echo $_SESSION['comentario_perfil']; ?>" class="foto-coment"><b><?php echo " " . $_SESSION['nome_comentario']; ?></b></p>
                <p class="list-group-item"><?php echo $_SESSION['desc_coment']; ?></p>
                <p class="list-group-item"><i class="bi bi-clock"></i> <?php echo "Postado em " . $_SESSION['data_coment'] . " às " . $_SESSION['hora_coment'];?></p>



                

                

                <script>

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
    <?php

        }
    }

}


$consulta = "select * from tb_resposta where id_comentario = '$codigo_resposta' ";

if($resposta = $mysqli->query($consulta)){

        while($linha = $resposta->fetch_object()){
            $nome_resposta = $linha->nm_usuario_resposta;
            $texto = $linha->ds_resposta;
            ?>
            <div id="corpinho">
                
            
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
// so falta inserir e selecionar

?>




<p><?php $nome_res = $_SESSION['nome']; echo "Digite algo, " . $nome_res. ":";?></p>

<p><textarea name="comentario_res" id="comentario_res_enviar" class="form form-control" placeholder="Digite uma mensagem" ></textarea></p>



<p><a href="javascript::" onclick="load_page('resposta_inserir.php?inserindo=<?php echo $codigo_resposta; ?>')">Enviar</a></p> <p><a id="cancel">Cancelar</a></p>





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
