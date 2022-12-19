<?php

    include("conecta.php");
    include_once("protect.php");
    protect();

    if(isset($_SESSION['login'])){
        session_destroy();
        header('Location:index.php');
        exit();
    }

?>