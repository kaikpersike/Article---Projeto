<?php

    include("conecta.php");


    $cod = $_GET['ver'];


    $sql = "update tb_corporacao set ds_visto = '2' where cd_corporacao = $cod";

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