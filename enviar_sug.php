<?php

    include("conecta.php");


    $sugg = $_POST['opn'];
    $nome = $_SESSION['nome'];
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/Y");
    $hora = date("h:i");
    $sql = "insert into tb_corporacao (cd_corporacao, ds_sugestao, nm_us_corp, ds_data_corp, ds_hora_corp, ds_visto) values (null, '$sugg', '$nome', '$data', '$hora', '1')";

    if($resposta = $mysqli->query($sql)){
        
        ?>

        <script>
        window.location.href="home.php";
        </script>

        <?php

    }else{
        echo $mysqli->error;
    }
    
    ?>