<?php

include("conecta.php");
$codigo_usuario = $_SESSION['codigo'];
$postagem = $_GET['pegando_post'];


$sql="select * from tb_post where cd_post = '$postagem' and id_user = '$codigo_usuario'";
if($resposta = $mysqli->query($sql)){
    while($linha = $resposta->fetch_object()){

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
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://kit.fontawesome.com/e0f6b52dac.js" crossorigin="anonymous"></script>
        <!-- CSS only -->
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
<title>Alterar post</title>
</head>
<body>
<div class="cachota">
<div id="well well-sm">
        <div id="panel" align="left">
            <form action="" method="post" enctype="multipart/form-data">
                <p><input type="text" name="titulo" id="titulo" class="form form-control" value=<?php echo $_SESSION['titulo'];?>></p>
                <p><textarea name="descricao" id="descricao" placeholder="Digite algo" class="form form-control" ><?php echo $_SESSION['texto'];?></textarea></p>
                <p><input type="file" name="image" id="image" class="form form-control"></p>
                
                    
                <img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/>

                <p>
                
                <select name="linguagem" id="linguagem">
                    <option value="1">PHP</option>
                    <option value="2">HTML</option>
                    <option value="3">CSS</option>
                    <option value="4">Java Script</option>
                </select>
                </p>
                <p><input type="submit" value="Alterar" class="btn btn-default"></p>
                <input type="hidden" name="enviar" value="send">
            </form>
          
          <button id="kaik" class="btn btn-default" onclick="history.back()">Cancelar</button>
          

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>

    <script>
        $('#descricao').trumbowyg({
            lang: 'pt_br',
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['link'],
        ['insertImage'],
        ['upload'],
        ['horizontalRule']
    ],

    plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: 'upload.php',
            fileFieldName: 'image',
            headers: {
                'Authorization': 'Client-ID xxxxxxxxxxxx'
            },
            urlPropertyName: 'file'
        }, 

        resizimg: {
            minSize: 64,
            step: 16,
        }
        
    },
    autogrow: true
});

    </script>

                <?php
                    if(isset($_POST['enviar']) && $_POST['enviar'] == "send"){
                        $titulo = $_POST['titulo'];
                        $descricao = $_POST['descricao'];
                        date_default_timezone_set('America/Sao_Paulo');
                        $data = date("d/m/Y");
                        $hora = date(" H:i:s");
                        $nome = $_SESSION['nome'];
                        $linguagem = $_POST['linguagem'];
                        

                        $uploaddir = 'imagens/uploads/';
                        $uploadfile = $uploaddir.basename($_FILES['image']['name']);
                        $imagename = $uploaddir.basename($_FILES['image']['name']);

                            if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)){
                                
                                // $sql = "insert into tb_post (ds_titulo, ds_texto, im_imagem, ds_data, ds_hora, nm_postador, ds_linguagem, id_user) values ('$titulo', '$descricao', '$imagename', '$data', '$hora', '$nome', '$linguagem', '$id_user')";

                                $sql = "update tb_post set ds_titulo = '".$titulo."', ds_texto = '".$descricao."', im_imagem = '".$imagename."', ds_data = '".$data."', ds_hora = '".$hora."', nm_postador = '".$nome."', ds_linguagem = '".$linguagem."' where cd_post = '$postagem' and id_user = '$codigo_usuario' ";
                                if($resposta = $mysqli->query($sql)){
                                    ?>
                                    <script>alert("Alterado com sucesso");</script>
                                    <?php
                                    header('Location:home.php');
                                }
                            }else{
                               
                                $sql = "update tb_post set ds_titulo = '".$titulo."', ds_texto = '".$descricao."', im_imagem = '".$_SESSION['imagem']."', ds_data = '".$data."', ds_hora = '".$hora."', nm_postador = '".$nome."', ds_linguagem = '".$linguagem."' where cd_post = '$postagem' and id_user = '$codigo_usuario' ";
                                if($resposta = $mysqli->query($sql)){
                                    ?>
                                    <script>alert("Alterado com sucesso");</script>
                                    <?php
                                    header('Location:home.php');
                                    
                                }

                            }
                            
                        }

                     
                    
                ?>
    
        </div>
    </div>

    <br>

</body>
</html>

<?php

}
}
