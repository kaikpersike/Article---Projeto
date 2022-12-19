<?php

include("conecta.php");

// Inserindo like


$id = $_POST['id'];
$id_usuario = $_POST['id_us'];

if(isset($id)){


       // Selecionando like

       $sel_like = "select * from tb_curtir_duv where id_post_duv = '$id' and id_user_duv = '$id_usuario' ";

       if($resposta = $mysqli->query($sel_like)){
           if($resposta->num_rows==0){

            $val_like = "insert into tb_curtir_duv (nr_curtir_duv, id_post_duv, id_user_duv) values (1, '$id', '$id_usuario')";



            if($resposta = $mysqli->query($val_like)){
               
       
       
            }
           }elseif($resposta->num_rows!=0){

            $mais = "delete from tb_curtir_duv where id_post_duv = '$id' and id_user_duv = '$id_usuario'";

            if($resposta = $mysqli->query($mais)){
               
       
       
            }
           
               }
   
           }

           $consult = "select * from tb_curtir_duv where id_post_duv = '$id'";

           if($resposta = $mysqli->query($consult)){
               if($resposta->num_rows==0){
                $_SESSION['qt_like_duv'] =$resposta->num_rows ." like";
                   
                ?>
                <i class="bi bi-hand-thumbs-up"></i> <?php echo $_SESSION['qt_like_duv']; ?> <br>
                <?php
               }else{
               if($resposta->num_rows==1){
                   $_SESSION['qt_like_duv'] =$resposta->num_rows ." like";
                   
                   ?>
                   <i class="bi bi-hand-thumbs-up"></i> <?php echo $_SESSION['qt_like_duv']; ?> <br>
                   <?php
       
               }elseif($resposta->num_rows > 1 ){
       
                   $_SESSION['qt_like_duv'] = $resposta->num_rows ." likes";
       
                   ?>
                  <p> <i class="bi bi-hand-thumbs-up"></i> <?php echo $_SESSION['qt_like_duv']; ?></p>   
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