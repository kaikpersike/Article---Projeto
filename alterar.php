<?php

    include("conecta.php");

   

    $cod = $_SESSION['codigo'];
 
    $sql = "select * from tb_usuario where cd_usuario=$cod";
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
    <title>Alter</title>
</head>
<body>
   <br>
  <div id="alter">
     <input id="codigo" type="hidden" name="codigo" value=<?php echo $_SESSION['codigo']; ?>>
     <input id="email" type="text" name="email" value=<?php echo $_SESSION['login']; ?>>
     <input id="senha" type="text" name="senha" value=<?php echo $_SESSION['senha']; ?>>

     <input id="submit" type="submit" value="Salvar">
  </div>
    
            <script>

            $(document).ready(function(){
                $("#submit").click(function(){
                    $.ajax({
                    url: "alterar_item.php",
                    type: "POST",
                    dataType: "html",

                    data:{
                        login: $("#email").val(),
                        cod: $("#codigo").val(),
                        senha: $("#senha").val(),
                    },

                    success: (resposta)=>{
                        $("#exibir").html(resposta);
                    }

                });
                   $("#alter").hide();
                });
            });

            </script>

            <div id="exibir"></div>

</body>
</html>

<?php

}
    }

?>