<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/header.css">
	 <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <script src="https://kit.fontawesome.com/e0f6b52dac.js" crossorigin="anonymous"></script>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<title>Header</title>
</head>
<body>

<div class="sidebar">
<header>
    <img class="logo" src="../img/logo.png" alt="logo">
        <i class="fa-solid fa-bars" id="btn"></i>
        <ul class="nav_links">
            <li>
                <a href="../home.php"> 
                <i class="fa-solid fa-house"></i> 
                <span class="links_name"> Home </span>
                <span class="tooltip">Home</span>
                </a>
            </li>
            <li> 
                <a href="../categorias.php"> 
                    <i class="fa-solid fa-list"></i> 
                    <span class="links_name"> Categorias </span>
                <span class="tooltip">Categorias</span>
                </a>
            </li>
            <li> 
                <a href="../duvida/perguntas.php"> 
                    <i class="fa-solid fa-question"></i> 
                    <span class="links_name"> Duvidas </span>
                <span class="tooltip">Duvias</span>
                </a>
            </li>
            <li> 
                <a href="../membros.php"> 
                    <i class="fa-solid fa-users"></i> 
                    <span class="links_name"> Membros </span>
                <span class="tooltip">Membros</span>
                </a>
            </li>
            <li> 
                <a href="../logout.php"> 
                    <i class="fa-solid fa-right-to-bracket"></i> 
                    <span class="links_name"> Sair </span>
                <span class="tooltip">Sair</span>
                </a> 
            </li>
            <li> 
                <a href="../perfil.php"> 
                    <i class="fa-solid fa-user"></i> 
                    <span class="links_name"> Perfil </span>
                    <span class="tooltip">Perfil</span>
                </a>
            </li>
        </ul>
</header>
</div>

<script>
    let btn= document.querySelector("#btn");
    let sidebar= document.querySelector(".sidebar");

    btn.onclick = function() {
        sidebar.classList.toggle("active");
    }


</script>