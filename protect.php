<?php


    if(!function_exists("protect")){
        function protect(){
            if(!isset($_SESSION))
            session_start;

            if(!isset($_SESSION['login']) || !is_numeric($_SESSION['login'])){
                header("Location: index.php");
            }
        }
    }

?>