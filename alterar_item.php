<?php

    include("conecta.php");


    $cod = $_POST['cod'];
    $email = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "update tb_usuario set ds_email = '".$email."', ds_senha = '".$senha."' where cd_usuario = $cod";

    if($resposta = $mysqli->query($sql)){
        ?>
        <script>
            alert("Alterado com sucesso");
        </script>
        <?php
    
    }else{
        echo $mysqli->error;
    }
    
    ?>