<?php

    include("conecta.php");


    $cod = $_GET['deletando_post'];

    $sql = "delete from tb_post where cd_post = $cod";

    if($resposta = $mysqli->query($sql)){
        ?>
        <style>body{background-color:#242531;}</style>
        <body>
            
        
        <script>
            alert("Deletado com sucesso");
            window.location.href="home.php";
        </script>
        </body>
        <?php
    
    }else{
        echo $mysqli->error;
    }
    
    ?>