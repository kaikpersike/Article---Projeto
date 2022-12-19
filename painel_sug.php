<?php include("conecta.php"); if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 3){?>

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
        <title>Painel de sugestões</title>
    </head>
<body>
    
    <p>
        <a href="logout.php"> 
            <i class="fa-solid fa-right-to-bracket"></i> Sair
        </a>
    </p>
    <?php
    
        $sql = "select * from tb_corporacao order by cd_corporacao desc";

        if($resposta = $mysqli->query($sql)){
            if($resposta->num_rows==0){
                echo "Sem sugestões";
            }else{
                while($linha = $resposta->fetch_object()){
                    $cd_sug = $linha->cd_corporacao;
                    $ds_sug = $linha->ds_sugestao;
                    $nm_user = $linha->nm_us_corp;
                    $ds_hora = $linha->ds_hora_corp;
                    $ds_data = $linha->ds_data_corp;
                    $ds_visto = $linha->ds_visto;

                    ?>
                        <div class="cachota">
                            <div id="panel">
                                <?php
                                if($ds_visto == 1){
                                    ?>
                          
                                    <p> <i> Publicado por: </i> <?php echo $nm_user; ?> <i> às </i> <?php echo $ds_hora; ?> <i> do </i> <?php echo $ds_data; ?> </p>
                                    <p> <i> Sugestão:</i> <?php echo $ds_sug; ?></p>
                                    <p id="marcar"><a onclick="ver()"><i class="fa-solid fa-eye-slash"></i> Marcar como visto</a></p>
                                    <p><a onclick="del()"><i class="fa-solid fa-trash"></i> Excluir</a></p>
                       
                                <?php
                                }else{
                                    ?>
                              
                                    <p> <i> Publicado por: </i> <?php echo $nm_user; ?> <i> às </i> <?php echo $ds_hora; ?> <i> do </i> <?php echo $ds_data; ?> </p>
                                    <p> <i> Sugestão:</i> <?php echo $ds_sug; ?></p>
                                    <p><a><i class="fa-solid fa-eye"></i> Visto</a></p>
                                    <p><a onclick="del()"><i class="fa-solid fa-trash"></i> Excluir</a></p>
                          
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                }
            }
        }
    
    ?>

                <script>
                         function del(){
                                   $.ajax({
                       url: "del_sugestao.php",
                       type: "GET",
                       dataType: "html",
           
                       data:{
                           del: <?php echo $cd_sug; ?>
                           
                       },
                       success: (resposta)=>{
                           $("#panel").html(resposta);
                       }
           
                   }).fail(function(jqXHR, textStatus ) {
                       console.log("Request failed: " + textStatus);
           
                   }).always(function() {
                       console.log("");
                   }); 
                               }

                               function ver(){
                                   $.ajax({
                       url: "vistar_sugestao.php",
                       type: "GET",
                       dataType: "html",
           
                       data:{
                           ver: <?php echo $cd_sug; ?>
                           
                       },
                       success: (resposta)=>{
                           $("#marcar").html(resposta);
                       }
           
                   }).fail(function(jqXHR, textStatus ) {
                       console.log("Request failed: " + textStatus);
           
                   }).always(function() {
                       console.log("");
                   }); 
                               }

                </script>

</body>
</html>
<?php
}else{
?>
    <script>
        alert("Você não tem acesso a essa página");
        window.location.href="index.php";
    </script>

<?php
}