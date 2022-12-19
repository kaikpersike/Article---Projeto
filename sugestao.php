<?php include("conecta.php"); include("header.php");?>
<div class="cachota">

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="css/header.css">
            <!-- CSS only -->
            <!-- JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
            <title>Perguntas</title>

            <style>
                #opiniao{
    background-color: #242531;
    width: calc(90%);
    height: auto;
    margin-top: 20px;
    padding: 10px 10px;
    box-shadow: #17181F 0px 0px 15px;
    cursor: pointer;

}

.opiniao{
    background-color: #242531;
    width: calc(90%);
    height: auto;
    margin-top: 20px;
    padding: 10px 10px;
    box-shadow: #17181F 0px 0px 15px;

}

#opiniao:hover{
    background-color: #383A4D;
}
            </style>

</head>
<body>
<p><h1>Envie-nos propostas para melhorarmos nosso projeto!</h1></p>
<p>Com o seu feedback conseguimos fazer novas melhoras para o site. É por isso que seu comentário para a gente é tão importante.</p>

<p>Obs.: qualquer tipo de injúria não será aceita como proposta de aprimoramento do nosso conteúdo e o seu comentário será desconsiderado.</p>
<div id="opiniao">

        <p><textarea name="comentario" id="comentario" class="form form-control" placeholder="Digite uma mensagem" ></textarea></p>
        <p><input type="submit" id="comentar_botao" value="enviar" class="btn btn-button"></p>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="dist/trumbowyg.min.js"></script>
    <script type="text/javascript" src="dist/langs/pt_br.min.js"></script>
    <script src="dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
    <script src="dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>

    <script>
// Inicio caixa-texto
        $('#comentario').trumbowyg({
            lang: 'pt_br',
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['link']
    ],

    plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: 'tete.php',
            fileFieldName: 'image',
            headers: {
                'Authorization': 'Client-ID xxxxxxxxxxxx'
            },
            urlPropertyName: 'file'
        }
        
    },
    autogrow: true
});

// Fim caixa-texto

//  Inicio enviar-resposta

    $("#comentar_botao").click(function(){
        $.ajax({
                url: "enviar_sug.php",
                type: "POST",
                dataType: "html",

                data:{
                    opn: $("#comentario").val()
                    
                },
                success: (resposta)=>{
                    $("body").html(resposta);
                }

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("");
            }); 
            
    });

// Fim enviar-resposta

    </script>

</body>
</html>