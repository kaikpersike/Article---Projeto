<?php

    include("conecta.php");


    $cod = $_GET['del'];


    $sql = "delete from tb_duvida_comentario where cd_duv_comentario='$cod' order by cd_duv_comentario desc";

    if($resposta = $mysqli->query($sql)){
        
        ?>

        <script>
        window.location.reload();
        </script>

        <?php

    }else{
        echo $mysqli->error;
    }
    
    ?>