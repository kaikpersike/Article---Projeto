<?php

    include("conecta.php");
    


    $cod = $_GET['deletando_duvida'];

    $sql = "delete from tb_pergunta where cd_pergunta = $cod";

    if($resposta = $mysqli->query($sql)){
        ?>
        <style>body{background-color:#242531;}</style>
        <body>
            
        
        <script>
            alert("Deletado com sucesso");
            window.location.href="perguntas.php";
        </script>
        </body>
        <?php
    
    }else{
        echo $mysqli->error;
    }
    
    ?>