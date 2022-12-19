<?php

    include("conecta.php");
    include("header.php");

    $codigo = $_SESSION['codigo'];
    

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
        </head>
        <body>

        <div class="cachota">
                
        <div class="ovo">
                
                       
                   <br>
   
                           <?php
                           
                           $quantidade_nt = "select * from tb_notificacao where id_user_not = '$codigo'";
   
                           if($resposta = $mysqli->query($quantidade_nt)){
                           if($resposta->num_rows==0){
                               define("qt_notificacao", $resposta->num_rows ." notificação");
                               ?>
               
               <i class="bi bi-bell-fill"></i> <?php echo qt_notificacao; ?>
                               <?php
                           }else{
                   
                   
                               if($resposta->num_rows==1){
                                   define("qt_notificacao", $resposta->num_rows ." notificação");
                                   ?>
                   
                   <i class="bi bi-bell-fill"></i> <?php echo qt_notificacao; ?>
                                   <?php
                   
                               }elseif($resposta->num_rows > 1 ){
                   
                                   define("qt_notificacao", $resposta->num_rows ." notificações");
                   
                                   ?>
                                 <i class="bi bi-bell-fill"></i> <?php echo qt_notificacao; ?>
                                   <?php
                   
                               } 
                   
                   
                   }
                   }
                           
                           ?>
   
               
   
                   
   
               <?php
               
               $notificacao = "select * from tb_notificacao where id_user_not = '$codigo'";
           
               if($resposta = $mysqli->query($notificacao)){
                   if($resposta->num_rows==0){
                      
                   }else{
           ?>



           <p id="excluir_not">Limpar notificações</p>
           <?php
                       // pegando a quantidade de notificacao
           
                     
           
                       while($linha = $resposta->fetch_object()){
           
                           $cod_not = $linha->cd_notificacao;
                           $ds_notificacao = $linha->ds_notificacao;
                           $titulo_not = $linha->nm_titulo_not;
                           $data_not = $linha->ds_data_not;
                           $hora = $linha->ds_hora_not;
                           $codigar = $linha->id_user_not;
           
                           ?>
            <div class="panel">
                           <div id="sucesso">
                               <p>Titulo: <?php echo $titulo_not; ?></p>
                               <p>Notificação: <?php echo $ds_notificacao; ?></p>
                               <p>Às <?php echo $hora; ?> do <?php echo $data_not; ?> </p>
                               <br>
                               
                           </div>
           </div>
                           <script>
                               $("#excluir_not").click(function(){
                                   $.ajax({
                       url: "del_notificacao.php",
                       type: "GET",
                       dataType: "html",
           
                       data:{
                           del: <?php echo $codigar; ?>
                           
                       },
                       success: (resposta)=>{
                           $(".ovo").html(resposta);
                       }
           
                   }).fail(function(jqXHR, textStatus ) {
                       console.log("Request failed: " + textStatus);
           
                   }).always(function() {
                       console.log("");
                   }); 
                               });
                           </script>
           
                           <?php
           
                       }
                   }
               }
           
               
               ?>
              </div>
           </div>
        </body>
        </html>
        <?php
            }if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2){
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
                
                <div class="ovo">
                    
                <br>

                        <?php
                        
                        $quantidade_nt = "select * from tb_notificacao where id_user_not = '$codigo'";

                        if($resposta = $mysqli->query($quantidade_nt)){
                        if($resposta->num_rows==0){
                            define("qt_notificacao", $resposta->num_rows ." notificação");
                            ?>
            
                            <i class="bi bi-bell-fill"></i> <?php echo qt_notificacao; ?>
                            <?php
                        }else{
                
                
                            if($resposta->num_rows==1){
                                define("qt_notificacao", $resposta->num_rows ." notificação");
                                ?>
                
                <i class="bi bi-bell-fill"></i> <?php echo qt_notificacao; ?>
                                <?php
                
                            }elseif($resposta->num_rows > 1 ){
                
                                define("qt_notificacao", $resposta->num_rows ." notificações");
                
                                ?>
                                <i class="bi bi-bell-fill"></i> <?php echo qt_notificacao; ?>
                                <?php
                
                            } 
                
                
                }
                }
                        
                        ?>

                

            <?php
            
            $notificacao = "select * from tb_notificacao where id_user_not = '$codigo'";
        
            if($resposta = $mysqli->query($notificacao)){
                if($resposta->num_rows==0){
                   
                }else{
        ?>
        <br>

      
        
        
        <p id="excluir_not">Limpar notificações</p>

        <?php
                    // pegando a quantidade de notificacao
        
                  
        
                    while($linha = $resposta->fetch_object()){
        
                        $cod_not = $linha->cd_notificacao;
                        $ds_notificacao = $linha->ds_notificacao;
                        $titulo_not = $linha->nm_titulo_not;
                        $data_not = $linha->ds_data_not;
                        $hora = $linha->ds_hora_not;
                        $codigar = $linha->id_user_not;
        
                        ?>
         <div class="panel">
                        <div id="sucesso">
                            <p>Titulo: <?php echo $titulo_not; ?></p>
                            <p>Notificação: <?php echo $ds_notificacao; ?></p>
                            <p>Às <?php echo $hora; ?> do <?php echo $data_not; ?> </p>
                            <br>
                            
                        </div>
        </div>
                        <script>
                            $("#excluir_not").click(function(){
                                $.ajax({
                    url: "del_notificacao.php",
                    type: "GET",
                    dataType: "html",
        
                    data:{
                        del: <?php echo $codigar; ?>
                        
                    },
                    success: (resposta)=>{
                        $(".ovo").html(resposta);
                    }
        
                }).fail(function(jqXHR, textStatus ) {
                    console.log("Request failed: " + textStatus);
        
                }).always(function() {
                    console.log("");
                }); 
                            });
                        </script>
        
                        <?php
        
                    }
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

