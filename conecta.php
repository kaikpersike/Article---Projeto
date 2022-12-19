<?php


    // Inicio conexão...

    $mysqli = new mysqli('localhost', 'root', '', 'bd_new_article');
    if($mysqli -> connect_errno){
        echo $mysqli -> connect->error;
    }

    session_start();

        

?>


