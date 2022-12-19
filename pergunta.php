<?php

include("conecta.php");
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="user.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" type="text/css" href="css/header.css">
        <script src="https://kit.fontawesome.com/e0f6b52dac.js" crossorigin="anonymous"></script>
        <!-- CSS only -->
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <title>Usuario Tela</title>
</head>
<body>
    <div class="cachota">
    <?php
    

$pergunta = $_POST['ovo'];
$titulo = $_POST['title'];
$nome = $_SESSION['nome'];
date_default_timezone_set('America/Sao_Paulo');
$data = date("d/m/Y");
$hora = date(" H:i:s");
$linguagem = $_POST['language'];


$sql = "insert into tb_pergunta value(null, '$nome', '$pergunta', '$data', '$hora', '$titulo', '".$_SESSION['codigo']."', '$linguagem')";



if($mysqli->query($sql)){

        
    $certo = "Pergunta enviada!";
    
    $desc = "Sua dúvida foi enviada. Agora, só esperar as respostas!";

    $notification = "insert into tb_notificacao (cd_notificacao, ds_notificacao, nm_titulo_not, ds_data_not, ds_hora_not, id_user_not) values (null, '$desc', '$certo', '$data', '$hora', '".$_SESSION['codigo']."')";

    if($resposta = $mysqli->query($notification)){

    }

    
    ?>
    <script>
   
        window.location.href="perguntas.php";
    </script>
    <?php
}

?>
</body>
</html>