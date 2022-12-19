<?php

    include("conecta.php");
    include("header.php");
    if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
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
        <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">

        <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/> -->

</head>
<body>

<!-- <script>
    $(document).ready(function(){
        alertify.alert('Alert Title', 'Alert Message!', function(){ alertify.success('Ok');
});          });
</script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script> -->


<div class="cachota">
    <div id="well well-sm">
        <div id="panel">
            <form action="" method="post" enctype="multipart/form-data">
                <p><input type="text" name="titulo" id="titulo" placeholder="Insira um titulo" class="form form-control"></p>
                <p><textarea name="descricao" id="trumbowyg-editor" placeholder="Digite algo" class="form form-control"> </textarea></p>
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


                                
                                $sql = "insert into tb_post (ds_titulo, ds_texto, im_imagem, ds_data, ds_hora, nm_postador, ds_linguagem, id_user, ds_status) values ('$titulo', '$descricao', '$imagename', '$data', '$hora', '$nome', '$linguagem', '$id_user', '1')";
                                if($resposta = $mysqli->query($sql)){

    
                                    $certo = "Post enviado!";
    
                                    $desc = "Uma publicação foi enviada com sucesso! Ela entrará em análise por um admnistrador e retornará sua resposta em breve.";
    
                                    $notification = "insert into tb_notificacao (cd_notificacao, ds_notificacao, nm_titulo_not, ds_data_not, ds_hora_not, id_user_not) values (null, '$desc', '$certo', '$data', '$hora', '".$_SESSION['codigo']."')";
    
                                    if($resposta = $mysqli->query($notification)){
    
                                    }

                                    ?>
                                    <script>
                                    window.location.href="home.php";
                                    </script>
                                    <?php
                                }
                            }else{
                                echo "erro ao enviar";
                            }
                            
                        }

                     
                    
                ?>
    
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
    <script>
        $('#trumbowyg-editor').trumbowyg({
            lang: 'pt_br',
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['upload'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
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
</body>
</html>
<?php
    }
    if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2){
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
        <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
</head>
<body>

        <div class="cachota">
        <div id="well well-sm">
        <div id="panel">
            <form action="" method="post" enctype="multipart/form-data">
                <p><input type="text" name="titulo" id="titulo" placeholder="Isira um titulo" class="form form-control"></p>
                <p><textarea name="descricao" id="trumbowyg-editor" placeholder="Digite algo" class="form form-control"></textarea></p>
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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
    <script>
        $('#trumbowyg-editor').trumbowyg({
            lang: 'pt_br',
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['upload'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
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
                                
                                $sql = "insert into tb_post (ds_titulo, ds_texto, im_imagem, ds_data, ds_hora, nm_postador, ds_linguagem, id_user, ds_status) values ('$titulo', '$descricao', '$imagename', '$data', '$hora', '$nome', '$linguagem', '$id_user', '2')";
                                if($resposta = $mysqli->query($sql)){

                                    $certo = "Post enviado!";
    
                                    $desc = "Uma publicação foi enviada com sucesso!";
    
                                    $notification = "insert into tb_notificacao (cd_notificacao, ds_notificacao, nm_titulo_not, ds_data_not, ds_hora_not, id_user_not) values (null, '$desc', '$certo', '$data', '$hora', '".$_SESSION['codigo']."')";
    
                                    if($resposta = $mysqli->query($notification)){
    
                                    }

                                    ?>
                                    <script>
                                    window.location.href="home.php";
                                    </script>
                                    <?php
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
        <?php
    }elseif($_SESSION['nivel'] !=1 && $_SESSION['nivel'] !=2){
        ?>
        <script>
            alert("Voce precisa estar logado");
            window.location.href="index.php";
        </script>
        <?php
    }

    ?>