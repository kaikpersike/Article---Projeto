<?php

    include("conecta.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Publicar</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div id="well well-sm">
        <div id="panel">
            <form action="" method="post" enctype="multipart/form-data">
                <p><input type="text" name="titulo" id="titulo" placeholder="Isira um titulo" class="form form-control"></p>
                <p><textarea name="descricao" id="descricao" placeholder="Digite algo" class="form form-control"></textarea></p>
                <p><input type="file" name="image" id="image" class="form form-control"></p>
                <p>
                <select name="linguagem" id="linguagem">
                    <option value="1">PHP</option>
                    <option value="2">HTML</option>
                    <option value="3">CSS</option>
                    <option value="4">Java Script</option>
                </select>
                </p>
                <p><input type="submit" value="Publicar" class="btn btn-default"></p>
                <input type="hidden" name="enviar" value="send">
            </form>

                <?php
                    if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){
                        $titulo = $_POST['titulo'];
                        $descricao = $_POST['descricao'];
                        date_default_timezone_set('America/Sao_Paulo');
                        $data = date("d/m/Y");
                        $hora = date(" H:i:s");
                        $nome = $_SESSION['nome'];
                        $linguagem = $_POST['linguagem'];
                        $id_user = $_SESSION['codigo'];
                        

                        $uploaddir = 'imagens/uploads/';
                        $uploadfile = $uploaddir.basename($_FILES['image']['name']);
                        $imagename = $uploaddir.basename($_FILES['image']['name']);

                            if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)){
                                
                                $sql = "insert into tb_post (ds_titulo, ds_texto, im_imagem, ds_data, ds_hora, nm_postador, ds_linguagem, id_user) values ('$titulo', '$descricao', '$imagename', '$data', '$hora', '$nome', '$linguagem', '$id_user')";
                                if($resposta = $mysqli->query($sql)){
                                    header('Location:administrador.php');
                                }
                            }else{
                                echo "erro ao enviar";
                            }
                            
                        }

                     
                    
                ?>
    
        </div>
    </div>
</body>
</html>