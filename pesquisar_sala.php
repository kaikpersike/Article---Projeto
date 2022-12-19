<?php

include("conecta.php");

if($_SESSION['nivel'] != 2){

    ?>
    <script>
        alert("Você não tem acesso a esta página");
        window.location.href = "index.php";
    </script>
    <?php
}else{



    $sql = "select * from tb_usuario where nr_nivel='2' and cd_usuario='".$_SESSION['codigo']."'";

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


$sala = $_POST['sala'];


if($sala != null){
    ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
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
            <title>ADM Tela</title>
    </head>
    <body>
        <?php
    $sql = "select * from tb_usuario where nr_serie = '$sala'";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "sem aluno";
        }else{
            while($linha = $resposta->fetch_object()){
                $cod_usuario = $linha->cd_usuario;
                $nome_aluno = $linha->nm_usuario;
                $_SESSION['serie'] = $linha->nr_serie;
                $_SESSION['login'] = $linha->ds_email;
                $_SESSION['senha'] = $linha->ds_senha;
                $nivel = $linha->nr_nivel;
                $_SESSION['perfil'] = $linha->ds_img;
                $_SESSION['banner'] = $linha->ds_banner;
                ?>

        
<?php if($nivel!=2){?><p><?php echo $nome_aluno; ?> <a  href="deletar.php?deletar_usuario=<?php echo $cod_usuario; ?>" onClick="return confirm('Deseja deletar este usuario?')" id="excluir">Deletar</a></p><?php }?>
            
                
                  
              <?php
            }
           
                          
                
        }
    }

}else{
    $sql = "select * from tb_usuario";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "sem aluno";
        }else{
            while($linha = $resposta->fetch_object()){
                $cod_usuario = $linha->cd_usuario;
                $nome = $linha->nm_usuario;
                $_SESSION['serie'] = $linha->nr_serie;
                $_SESSION['login'] = $linha->ds_email;
                $_SESSION['senha'] = $linha->ds_senha;
                $nivel_aluno = $linha->nr_nivel;
                $_SESSION['perfil'] = $linha->ds_img;
                $_SESSION['banner'] = $linha->ds_banner;
                ?>

        
<?php if($nivel_aluno!=2){?><p><?php echo $nome; ?> <a  href="deletar.php?deletar_usuario=<?php echo $cod_usuario; ?>" onClick="return confirm('Deseja deletar este usuario?')" id="excluir">Deletar</a></p><?php }?>
            

                <?php
            }
            
        }
    }
?>
    </body>
    </html>
    <?php

}

}
?>