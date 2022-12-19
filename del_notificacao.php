<?php

    include("conecta.php");


    $cod = $_GET['del'];


    $sql = "delete from tb_notificacao where id_user_not='$cod'";

    if($resposta = $mysqli->query($sql)){
        $quantidade_nt = "select * from tb_notificacao where id_user_not = '".$_SESSION['codigo']."'";
   
        if($resposta = $mysqli->query($quantidade_nt)){
        if($resposta->num_rows==0){
            define("qt_notificacao", $resposta->num_rows ." notificação");
            ?>
<br>
<i class="bi bi-bell-fill"></i> <?php echo qt_notificacao; ?>
            <?php

        }
    }
    
    }else{
        echo $mysqli->error;
    }
    
    ?>