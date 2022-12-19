<?php



include("conecta.php");
if($_SESSION['nivel'] == 2){


    $sql = "select * from tb_usuario where nr_nivel='2'";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "nothing";
        }else{
            while($linha = $resposta->fetch_object()){
                $_SESSION['codigo'] = $linha->cd_usuario;
                $_SESSION['nome'] = $linha->nm_usuario;
                $_SESSION['login'] = $linha->ds_email;
                $_SESSION['senha'] = $linha->ds_senha;
                $_SESSION['nivel'] = $linha->nr_nivel;
                $_SESSION['perfil'] = $linha->ds_img;
                $_SESSION['banner'] = $linha->ds_banner;
            }
        }
    }


$processo = $_GET['deletar_usuario'];
$sql = "delete from tb_usuario where cd_usuario = '$processo'";

 if($lista = $mysqli->query($sql)){
    ?>
    <script>
        alert("Deletado com sucesso");
        window.location.href="perfil.php";
    </script>
    <?php

}else{
    echo $mysqli->error;
}
}else{
    ?>
    <script>
        alert("Você não tem acesso a esta página");
        window.location.href = "index.php";
    </script>
    <?php
}
?>