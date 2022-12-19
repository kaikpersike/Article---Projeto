<?php

    include("conecta.php");


    $cod = $_GET['del'];


    $sql = "delete from tb_corporacao where cd_corporacao='$cod'";

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