<?php

include("conecta.php");

// Inserindo like


$id = $_POST['id'];
$id_usuario = $_POST['id_us'];

if(isset($id)){


       // Selecionando like

       $sel_like = "select * from tb_curtir where id_post_curtir = '$id' and id_user_curtir = '$id_usuario' ";

       if($resposta = $mysqli->query($sel_like)){
           if($resposta->num_rows==0){

            $val_like = "insert into tb_curtir (nr_curtir, id_post_curtir, id_user_curtir) values (1, '$id', '$id_usuario')";



            if($resposta = $mysqli->query($val_like)){
               
       
       
            }
           }elseif($resposta->num_rows!=0){

            $mais = "delete from tb_curtir where id_post_curtir = '$id' and id_user_curtir = '$id_usuario'";

            if($resposta = $mysqli->query($mais)){
               
       
       
            }
           
               }
   
           }

           $consult = "select * from tb_curtir where id_post_curtir = '$id'";

           if($resposta = $mysqli->query($consult)){
               if($resposta->num_rows==0){
                $_SESSION['qt_like'] =$resposta->num_rows ." like";
                   
                ?>
                <i class="bi bi-hand-thumbs-up"></i> <?php echo $_SESSION['qt_like']; ?> <br>
                  
                <?php
               }else{
               if($resposta->num_rows==1){
                   $_SESSION['qt_like'] =$resposta->num_rows ." like";
                   
                   ?>
                   <i class="bi bi-hand-thumbs-up"></i> <?php echo $_SESSION['qt_like']; ?> <br>
                     
                   <?php
       
               }elseif($resposta->num_rows > 1 ){
       
                   $_SESSION['qt_like'] = $resposta->num_rows ." likes";
       
                   ?>
                  <p> <i class="bi bi-hand-thumbs-up"></i> <?php echo $_SESSION['qt_like']; ?></p>   
                 
                   <?php
       
               } 
               
                   }
       
               }

}


else{
    include_once("protect.php");
    protect();

}

 


?>