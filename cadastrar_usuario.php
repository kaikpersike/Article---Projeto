<?php
  
    include("conecta.php");
    ?>
    <style>body{background-color: #1D1E26;}</style>
    <body>
    <?php

if(isset($_POST['cadastrar_email'])){

    $nome = $_POST['cadastrar_nome'];
    $rm = $_POST['cadastrar_rm'];
    $email = $_POST['cadastrar_email'];
    $serie = $_POST['cadastrar_curso'];
    $senha = $_POST['cadastrar_senha'];
// Pegando dados


    $verifica = "select * from tb_usuario where ds_email = '$email' or nm_usuario='$nome'";

    if($resposta = $mysqli->query($verifica)){
        if($resposta->num_rows>0){
            echo "Email ou nome já existem";
        }else{
            
                    $sql = "insert into tb_usuario value(null, '".$nome."', '".$rm."', '".$email."', '".$senha."', '".$serie."', 1, 'imagens/semfoto.png', 'imagens/test.png') ";


                    if($mysqli->query($sql)){

                        ?>
                        <script>
                            alert("Foi");
                            window.location.href="index.php";
                        </script>
                        <?php
                    }
                
            
        }
    }

}else{
    ?>
    <script>
        alert("Saindo...");
        window.location.href="index.php";
    </script>
    <?php
}

?>

</body>