<?php

    include("conecta.php");

    $linguagem = $_POST['linguagem'];
    
    if($linguagem != null){
    $sql = "select * from tb_post where ds_linguagem = '$linguagem' and ds_status='2' order by cd_post desc";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "sem post";
        }else{
            while($linha = $resposta->fetch_object()){
            $_SESSION['id'] = $linha->cd_post;
            $_SESSION['titulo'] = $linha->ds_titulo;
            $_SESSION['texto'] = $linha->ds_texto;
            $_SESSION['imagem'] = $linha->im_imagem;
            $_SESSION['data'] = $linha->ds_data;
            $_SESSION['hora'] = $linha->ds_hora;
            $_SESSION['postador'] = $linha->nm_postador;
            $_SESSION['linguagem'] = $linha->ds_linguagem;
           

            
            ?>

            <!-- Aqui esta ocorrendo a exibicao -->
           
            <div id="panel" align="center">
                <!-- Pegando link via url -->
            <p> <a href="post.php?codigo_post=<?php  echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                <!-- outros... -->
             <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
             <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>
                
             <p>
                  <i class="bi bi-hand-thumbs-up"></i> <i class="bi bi-chat-dots"></i>
             </p>
        
       </div> 
       <?php
            
        }



    }
    
    
  }
    }else{
        $sql = "select * from tb_post where ds_status= '2' order by cd_post desc";

    if($resposta = $mysqli->query($sql)){
        if($resposta->num_rows==0){
            echo "sem post";
        }else{
            while($linha = $resposta->fetch_object()){
            $_SESSION['id'] = $linha->cd_post;
            $_SESSION['titulo'] = $linha->ds_titulo;
            $_SESSION['texto'] = $linha->ds_texto;
            $_SESSION['imagem'] = $linha->im_imagem;
            $_SESSION['data'] = $linha->ds_data;
            $_SESSION['hora'] = $linha->ds_hora;
            $_SESSION['postador'] = $linha->nm_postador;
            $_SESSION['linguagem'] = $linha->ds_linguagem;
           

            
            ?>

            <!-- Aqui esta ocorrendo a exibicao -->
           
            <div id="panel" align="center">
                <!-- Pegando link via url -->
            <p> <a href="post.php?codigo_post=<?php  echo $_SESSION['id'];?>" class="titulo"><?php echo $_SESSION['titulo'];?></a></p>
                <!-- outros... -->
             <?php if($_SESSION['imagem']!=null){?><p><img src="<?php echo $_SESSION['imagem']; ?>" class="foto"/></p><?php }?>
             <p><i class="bi bi-clock"></i> Postado em: <?php echo $_SESSION['data'] . " às " . $_SESSION['hora']; ?><br><i class="bi bi-person-circle"></i> Postado por: <?php echo $_SESSION['postador'];?> </p>
                
             <p>
                  <i class="bi bi-hand-thumbs-up"></i> <i class="bi bi-chat-dots"></i>
             </p>
        
       </div> 
       <?php
            
        }



    }
    
    
  }
    }
?>