<?php

include("conecta.php");

// if($_SESSION['nivel'] != 2){

    ?>
    <!-- <script>
        alert("Você não tem acesso a esta página");
        window.location.href = "index.php";
    </script> -->
    <?php

// }else{
    ?>
<div class="excluir">
                    <p>Deseja deletar essa conta?</p>
                    <a  href="" id="excluir" class="btn btn-success">Sim</a>
                    <a  href="perfil.php" id="rejeitar" class="btn btn-danger">Nao</a>
                </div>
                <?php
// }
?>