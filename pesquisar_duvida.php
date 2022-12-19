<?php

    include("conecta.php");

    $linguagem = $_POST['linguagem_pesquisa'];
    
    if($linguagem != null){
    $sql = "select * from tb_pergunta where ds_linguagem_duv = '$linguagem' order by cd_pergunta desc";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "sem post";
        }else{
            while($linha = $resposta->fetch_object()){
                $_SESSION['id_duvida'] = $linha->cd_pergunta;
                $_SESSION['nm_duvida_usuario'] = $linha->nm_nome;
                $_SESSION['ds_duvida'] = $linha->ds_pergunta;
                $_SESSION['ds_data_duv'] = $linha->ds_data;
                $_SESSION['ds_hora_duv'] = $linha->ds_hora;
                $_SESSION['ds_titulo_duv'] = $linha->ds_titulo;
                $_SESSION['id_cod_pergunta'] = $linha->id_user_perg;
           

            
            ?>

            <!-- Aqui esta ocorrendo a exibicao -->
           
            <div id="panel" align="center">
          <!-- Pegando link via url -->
      <p> <a href="post_pergunta.php?pergunta_post=<?php echo $_SESSION['id_duvida']; ?>" class="titulo"><?php echo $_SESSION['ds_titulo_duv']; ?></a></p>
      <p><?php echo $_SESSION['ds_duvida']; ?></p>
          <!-- outros... -->
       <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['ds_data_duv'] . " às " . $_SESSION['ds_hora_duv']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['nm_duvida_usuario'];?> </p>
  
 </div> 
       <?php
            
        }



    }
    
    
  }
    }else{
        $sql = "select * from tb_pergunta order by cd_pergunta desc";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "sem post";
        }else{
            while($linha = $resposta->fetch_object()){
                $_SESSION['id_duvida'] = $linha->cd_pergunta;
                $_SESSION['nm_duvida_usuario'] = $linha->nm_nome;
                $_SESSION['ds_duvida'] = $linha->ds_pergunta;
                $_SESSION['ds_data_duv'] = $linha->ds_data;
                $_SESSION['ds_hora_duv'] = $linha->ds_hora;
                $_SESSION['ds_titulo_duv'] = $linha->ds_titulo;
                $_SESSION['id_cod_pergunta'] = $linha->id_user_perg;
           

            
            ?>

            <!-- Aqui esta ocorrendo a exibicao -->
           
           
            <div id="panel" align="center">
          <!-- Pegando link via url -->
      <p> <a href="post_pergunta.php?pergunta_post=<?php echo $_SESSION['id_duvida']; ?>" class="titulo"><?php echo $_SESSION['ds_titulo_duv']; ?></a></p>
      <p><?php echo $_SESSION['ds_duvida']; ?></p>
          <!-- outros... -->
       <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['ds_data_duv'] . " às " . $_SESSION['ds_hora_duv']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['nm_duvida_usuario'];?> </p>
  
 </div> 
       <?php
            
        }



    }
    
    
  }
    }
?>