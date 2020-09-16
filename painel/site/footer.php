
<?php 
$sqclub = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$clubeinfo = mysqli_query($link, $sqclub) or die(mysqli_error($link));
$row_clubeinfo = mysqli_fetch_assoc($clubeinfo);

?>

<footer id="footer" class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <div class="full">
                     <div class="footer-widget">
                        <div class="footer-logo">
                        <a href="<?php if($signal == 1){echo "/";}else{echo "clube".$clube;}?>"><img src="<?php if($signal == 1 && isset($row_topo['logo_topo'])){echo "painel/".$row_topo['logo_topo'];}elseif($signal == 0 && isset($row_topo['logo_topo'])){echo "../".$row_topo['logo_topo'];}else{echo "../images/clube-digital.png";}?>" alt="#" class="img-logo" /></a>
                        </div>
                        <p><?php if(empty($row_topo['description_seo'])){echo "Não há descrição sobre o clube ainda!";}else{echo $row_topo['description_seo'];} ?></p>
                        <ul class="social-icons style-4 pull-left">
                           <?php if($row_topo['facebook_url'] == ""){}else{ ?><li><a class="facebook" href="<?php echo $row_topo['facebook_url']; ?>"><i class="fab fa-facebook"></i></a></li><?php } ?>
                              <?php if($row_topo['insta_url'] == ""){}else{ ?><li><a class="twitter" href="<?php echo $row_topo['insta_url']; ?>"><i class="fab fa-instagram"></i></a></li><?php } ?>
                              <?php if($row_topo['youtube_url'] == ""){}else{ ?><li><a class="youtube" href="<?php echo $row_topo['youtube_url']; ?>"><i class="fab fa-youtube"></i></a></li><?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
              
               <div class="col-md-4">
                  <div class="full">
                     <div class="footer-widget">
                        <h3>Contato</h3>
                        <ul class="address-list">
                           <li><i class="fa fa-map-marker"></i> <?php echo $row_clubeinfo['endereco_clube'].", ".$row_clubeinfo['numero_clube'].", ".$row_clubeinfo['bairro_clube'].", ".$row_clubeinfo['cidade_clube'].", ".$row_clubeinfo['estado_clube'];?></li>
                           <li><i class="fa fa-phone"></i> <?php if(empty($row_clubeinfo['telefone_clube'])){echo "(xx) xxxx-xxxx";}else{echo $row_clubeinfo['telefone_clube'];} ?></li>
                           <li><i style="font-size:20px;top:5px;" class="fa fa-envelope"></i> <?php if(empty($row_clubeinfo['email_clube'])){echo "email@email.com.br";}else{echo "<a href='mailto:".$row_clubeinfo['email_clube']."' style='color: #fff;'>".$row_clubeinfo['email_clube']."</a>";} ?></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="full">
                     <div class="footer-widget">
                        <h3>Últimas notícias</h3>
                        <ul class="address-list">
                           <?php 
                           while($row_blog2 = mysqli_fetch_array($blog2)){ 
                              echo "<li><a href='single-blog.php?clube=".$clube."&id_blog=".$row_blog2['id_blog']."' style='color: #fff'>".$row_blog2['titulo_blog']."</a></li>";
                              }
                              ?>
                           
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-bottom">
            <div class="container">
               <p>Todos os direitos reservados <a href="https://www.clubedigital.ong.br/" target="_blank">Clube Digital</a> | Desenvolvido por <a href="https://github.com/davidnmagalhaes" target="_blank">David Magalhães</a></p>
            </div>
         </div>
      </footer>

      <script src="<?php if($signal == 1){echo "painel/site/";}else{}?>js/all.js"></script>
      <!-- ALL PLUGINS -->
      <script src="<?php if($signal == 1){echo "painel/site/";}else{}?>js/custom.js"></script>