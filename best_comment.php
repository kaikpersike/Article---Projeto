<?php

    include("conecta.php");


    $cod = $_GET['best'];


    $sql = "update tb_duvida_comentario set ds_melhor_res = '2' where cd_duv_comentario='$cod'";

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