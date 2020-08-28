<?php 
$sqliclub = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$iclub = mysqli_query($link, $sqliclub) or die(mysqli_error($link));
$row_iclub = mysqli_fetch_assoc($iclub);
$totalRows_iclub = mysqli_num_rows($iclub);
?>

<li class="active"><a href="<?php if($signal == 1){echo "/";}else{echo "clube".$clube;}?>">Início</a></li>


<!-- Menu Quem Somos -->
        <?php 
              $query1 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='2'";
              $li1 = mysqli_query($link, $query1) or die(mysqli_error($link));
              $totalRows_li1 = mysqli_num_rows($li1);

              if($totalRows_li1 <= 0){
         ?>
                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Quem somos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <a class="dropdown-item" href="<?php if($signal == 1){echo "sobreclube";}else{echo "sobreclube".$clube;}?>" style="width: 100%; padding: 10px 10px;"><?php echo $row_iclub['nome_clube'];?></a>

        </div>
      </li>

          <?php
              }else{
          ?>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Quem somos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <a class="dropdown-item" href="<?php if($signal == 1){echo "sobreclube";}else{echo "sobreclube".$clube;}?>" style="width: 100%; padding: 10px 10px;"><?php echo $row_iclub['nome_clube'];?></a>

          <?php

              while($row_li1 = mysqli_fetch_array($li1)){
                if($signal == 1){echo '<a class="dropdown-item" href="page?id_page='.$row_li1['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li1['nome_page'].'</a>';
                }else{
                echo '<a class="dropdown-item" href="page.php?id_page='.$row_li1['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li1['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

      <?php } ?>
<!-- Menu Quem Somos -->


<!-- Menu Membros -->
        <?php 
              $query2 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='3'";
              $li2 = mysqli_query($link, $query2) or die(mysqli_error($link));
              $totalRows_li2 = mysqli_num_rows($li2);

              if($totalRows_li2 <= 0){
         ?>
                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Membros
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <a class="dropdown-item" href="<?php if($signal == 1){echo "socios";}else{echo "socios".$clube;}?>" style="width: 100%; padding: 10px 10px;">Sócios</a>
          <a class="dropdown-item" href="<?php if($signal == 1){echo "galeriapresidentes";}else{echo "galeriapresidentes".$clube;}?>" style="width: 100%; padding: 10px 10px;">Presidentes</a>
          <a class="dropdown-item" href="<?php if($signal == 1){echo "galeriagovernadores";}else{echo "galeriagovernadores".$clube;}?>" style="width: 100%; padding: 10px 10px;">Governadores</a>
          <a class="dropdown-item" href="<?php if($signal == 1){echo "associar";}else{echo "associar".$clube;}?>" style="width: 100%; padding: 10px 10px;">Indique um sócio</a>

        </div>
      </li>

          <?php
              }else{
          ?>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Membros
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <a class="dropdown-item" href="socios<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Sócios</a>
          <a class="dropdown-item" href="galeriapresidentes<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Presidentes</a>
          <a class="dropdown-item" href="galeriagovernadores<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Governadores</a>
          <a class="dropdown-item" href="associar<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Indique um sócio</a>

          <?php

              while($row_li2 = mysqli_fetch_array($li2)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="page?id_page='.$row_li2['id_page'].'" style="width: 100%; padding: 10px 10px;">'.$row_li2['nome_page'].'</a>';
                }else{
                echo '<a class="dropdown-item" href="page.php?id_page='.$row_li2['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li2['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

      <?php } ?>
<!-- Menu Membros -->


<!-- Menu Rotary -->
        <?php 
              $query3 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='4'";
              $li3 = mysqli_query($link, $query3) or die(mysqli_error($link));
              $totalRows_li3 = mysqli_num_rows($li3);

              if($totalRows_li3 <= 0){
                echo '<li><a href="#">Rotary</a></li>';

              }else{
          ?>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Rotary
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

            <!--
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">O que é</a> 
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">Doações</a> 
          -->

          <?php

              while($row_li3 = mysqli_fetch_array($li3)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="page?id_page='.$row_li3['id_page'].'" style="width: 100%; padding: 10px 10px;">'.$row_li3['nome_page'].'</a>';
                }else{
                echo '<a class="dropdown-item" href="page.php?id_page='.$row_li3['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li3['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

      <?php } ?>
<!-- Menu Rotary -->


<!-- Menu Ações e Projetos -->
<?php 
              $query4 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='5'";
              $li4 = mysqli_query($link, $query4) or die(mysqli_error($link));
              $totalRows_li4 = mysqli_num_rows($li4);

              if($totalRows_li4 <= 0){
                echo '<li><a href="#">Ações e Projetos</a></li>';
              }else{
        ?>

                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ações e Projetos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <!--
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">Ações</a> 
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">Projetos</a> 
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">Galeria</a> 
          -->

          <?php

              while($row_li4 = mysqli_fetch_array($li4)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="page?id_page='.$row_li4['id_page'].'" style="width: 100%; padding: 10px 10px;">'.$row_li4['nome_page'].'</a>';
                }else{
                  echo '<a class="dropdown-item" href="page.php?id_page='.$row_li4['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li4['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

             <?php } ?>
<!-- Menu Ações e Projetos -->

<!-- Menu ABTRF -->
        <?php 
              $query5 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='6'";
              $li5 = mysqli_query($link, $query5) or die(mysqli_error($link));
              $totalRows_li5 = mysqli_num_rows($li5);

              if($totalRows_li5 <= 0){
              ?>
                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ABTRF
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <?php if($signal == 1){?>
          <a class="dropdown-item" href="consorcio" style="width: 100%; padding: 10px 10px;">Consórcio Paul Harris</a>
        <?php }else{?>
          <a class="dropdown-item" href="consorcio.php?clube=<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Consórcio Paul Harris</a>
        <?php }?>
          
        </div>
      </li>
            <?php
              }else{
          ?>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ABTRF
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <?php if($signal == 1){?>
          <a class="dropdown-item" href="consorcio" style="width: 100%; padding: 10px 10px;">Consórcio Paul Harris</a>
        <?php }else{?>
          <a class="dropdown-item" href="consorcio.php?clube=<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Consórcio Paul Harris</a>
        <?php }?>

          <?php

              while($row_li5 = mysqli_fetch_array($li5)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="page?id_page='.$row_li5['id_page'].'" style="width: 100%; padding: 10px 10px;">'.$row_li5['nome_page'].'</a>';
                }else{
                echo '<a class="dropdown-item" href="page.php?id_page='.$row_li5['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li5['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

      <?php } ?>
<!-- Menu ABTRF -->


<!-- Menu Galeria -->
        <?php 
              $query6 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='7'";
              $li6 = mysqli_query($link, $query6) or die(mysqli_error($link));
              $totalRows_li6 = mysqli_num_rows($li6);

              if($totalRows_li6 <= 0){
                ?>
                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Campanhas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <?php 
            $querycmp = "SELECT * FROM rfa_campanhas WHERE clube='$clube' AND ativo='1'";
            $licmp = mysqli_query($link, $querycmp) or die(mysqli_error($link));
            while($row_licmp = mysqli_fetch_array($licmp)){
              if($signal == 1){
                echo '<a class="dropdown-item" href="campanha?idcmp='.$row_licmp['cod_campanha'].'" style="width: 100%; padding: 10px 10px;">'.$row_licmp['nome_campanha'].'</a>';
              }else{
                echo '<a class="dropdown-item" href="campanha.php?idcmp='.$row_licmp['cod_campanha'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_licmp['nome_campanha'].'</a>';
              }
              }
          ?>
          
        </div>
      </li>
            <?php
              }else{
          ?>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Campanhas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <?php 
            $querycmp = "SELECT * FROM rfa_campanhas WHERE clube='$clube' AND ativo='1'";
            $licmp = mysqli_query($link, $querycmp) or die(mysqli_error($link));
            while($row_licmp = mysqli_fetch_array($licmp)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="campanha?idcmp='.$row_licmp['cod_campanha'].'" style="width: 100%; padding: 10px 10px;">'.$row_licmp['nome_campanha'].'</a>';
              }else{
                echo '<a class="dropdown-item" href="campanha.php?idcmp='.$row_licmp['cod_campanha'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_licmp['nome_campanha'].'</a>';
              }
              }
          ?>
          
          <?php

              while($row_li6 = mysqli_fetch_array($li6)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="page?id_page='.$row_li6['id_page'].'" style="width: 100%; padding: 10px 10px;">'.$row_li6['nome_page'].'</a>';
                }else{
                echo '<a class="dropdown-item" href="page.php?id_page='.$row_li6['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li6['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

      <?php } ?>
<!-- Menu Galeria -->

<!-- Menu Banco C.R. -->
        <?php 
              $query7 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='8'";
              $li7 = mysqli_query($link, $query7) or die(mysqli_error($link));
              $totalRows_li7 = mysqli_num_rows($li7);

              if($totalRows_li7 <= 0){
          ?>
                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          Banco Cadeira<br> de Rodas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <!--
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">O que é</a> 
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">Cadastre-se</a> 
          -->
          <?php if($signal == 1){?>
          <a class="dropdown-item" href="doacoes" style="width: 100%; padding: 10px 10px;">Solicitar doação</a> 
          <?php }else{?>
          <a class="dropdown-item" href="doacoes.php?clube=<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Solicitar doação</a> 
          <?php }?>
          
          <?php if($signal == 1){?>
          <a class="dropdown-item" href="sejadoador" style="width: 100%; padding: 10px 10px;">Seja doador</a>
          <?php }else{?>
          <a class="dropdown-item" href="seja-doador.php?clube=<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Seja doador</a>
          <?php }?>
          
        </div>
      </li>

          <?php
              }else{
          ?>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          Banco Cadeira<br> de Rodas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <!--
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">O que é</a> 
          <a class="dropdown-item" href="#" style="width: 100%; padding: 10px 10px;">Cadastre-se</a> 
          -->

          <?php if($signal == 1){?>
          <a class="dropdown-item" href="doacoes" style="width: 100%; padding: 10px 10px;">Solicitar doação</a> 
          <?php }else{?>
          <a class="dropdown-item" href="doacoes.php?clube=<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Solicitar doação</a> 
          <?php }?>

          <?php if($signal == 1){?>
          <a class="dropdown-item" href="sejadoador" style="width: 100%; padding: 10px 10px;">Seja doador</a>
          <?php }else{?>
          <a class="dropdown-item" href="seja-doador.php?clube=<?php echo $clube; ?>" style="width: 100%; padding: 10px 10px;">Seja doador</a>
          <?php }?>
          
          <?php

              while($row_li7 = mysqli_fetch_array($li7)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="page?id_page='.$row_li7['id_page'].'" style="width: 100%; padding: 10px 10px;">'.$row_li7['nome_page'].'</a>';
                }else{
                echo '<a class="dropdown-item" href="page.php?id_page='.$row_li7['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li7['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

      <?php } ?>
<!-- Menu Banco C.R. -->

<!-- Menu Blog -->
        <?php 
              $query8 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='9'";
              $li8 = mysqli_query($link, $query8) or die(mysqli_error($link));
              $totalRows_li8 = mysqli_num_rows($li8);

              if($totalRows_li8 <= 0){
                if($signal == 1){
                echo '<li><a href="blog">Blog</a></li>';
                }else{
                echo '<li><a href="blog'.$clube.'">Blog</a></li>';
                }
              }else{
          ?>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Blog
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">
          <?php if($signal == 1){?>
         <a href="blog">Acessar Blog</a>
          <?php }else{?>
          <a href="blog<?php echo $clube; ?>">Acessar Blog</a> 
          <?php }?>
          <?php

              while($row_li8 = mysqli_fetch_array($li8)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="page?id_page='.$row_li8['id_page'].'" style="width: 100%; padding: 10px 10px;">'.$row_li8['nome_page'].'</a>';
                }else{
                echo '<a class="dropdown-item" href="page.php?id_page='.$row_li8['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li8['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

      <?php } ?>
<!-- Menu Blog -->

<!-- Menu Rotaract -->
        <?php 
              $query9 = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND ref_menu='10'";
              $li9 = mysqli_query($link, $query9) or die(mysqli_error($link));
              $totalRows_li9 = mysqli_num_rows($li9);

              if($totalRows_li9 <= 0){
                echo '<li><a href="#">Rotaract</a></li>';
              }else{
          ?>

          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Rotaract
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="min-height: 20px !important;  width: 300px">

          <?php

              while($row_li9 = mysqli_fetch_array($li9)){
                if($signal == 1){
                echo '<a class="dropdown-item" href="page?id_page='.$row_li9['id_page'].'" style="width: 100%; padding: 10px 10px;">'.$row_li9['nome_page'].'</a>';
                }else{
                echo '<a class="dropdown-item" href="page.php?id_page='.$row_li9['id_page'].'&clube='.$clube.'" style="width: 100%; padding: 10px 10px;">'.$row_li9['nome_page'].'</a>';
                }
              }
          ?>
          
        </div>
      </li>

      <?php } ?>
<!-- Menu Rotaract -->