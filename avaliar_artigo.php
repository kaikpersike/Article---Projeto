<?php

    include("conecta.php");


    $avaliar = $_GET['avaliar'];

    $sql = "update tb_post set ds_status = '2'  where cd_post = $avaliar";

    if($resposta = $mysqli->query($sql)){

        $test = "select * from tb_post where cd_post = '$avaliar' ";

        if($resposta = $mysqli->query($test)){
            if($resposta->num_rows==0){
                echo "sem post";
            }else{
                while($linha = $resposta->fetch_object()){
                $cacareco = $linha->id_user;
                }
            }
        }
            

        date_default_timezone_set('America/Sao_Paulo');
        $data = date("d/m/Y");
        $hora = date(" H:i:s");

        $certo = "Artigo aprovado!";
    
        $desc = "Seu artigo foi aprovado com sucesso! Agora todos poderão visualizar seu artigo";

        $notification = "insert into tb_notificacao (cd_notificacao, ds_notificacao, nm_titulo_not, ds_data_not, ds_hora_not, id_user_not) values (null, '$desc', '$certo', '$data', '$hora', '$cacareco')";

        if($resposta = $mysqli->query($notification)){

        }
        
        ?>
        <script>
            alert("Avaliado com sucesso");
            window.location.href="perfil.php";
        </script>
        <?php
    
    }else{
        echo $mysqli->error;
    }
    
    ?>