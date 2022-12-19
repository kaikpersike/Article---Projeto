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
    if($resposta->num_rows==0){
        echo "Seja o primeiro a comentar";
        ?>
        <img src="https://images.vexels.com/media/users/3/208171/isolated/preview/dc977990aed9c973c49800d2ad76c129-ilustracao-de-coala-fofo-dormindo.png" alt="">
        <?php
    }else{
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
}
// so falta inserir e selecionar

?>


<p><a id="cancel">Voltar</a></p>
<a id="responder" href="javascript::" onclick="load_page('resposta.php?resposta=<?php echo $cod_comentario; ?>')" class="btn btn-button">Responder   </a> 

<script>
$("#cancel").click(function(){
    window.location.href="post.php?codigo_post=<?php $post =  $_SESSION['id']; echo $post;?>";
});
</script>
