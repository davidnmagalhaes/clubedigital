<?php 
$sshowbal = "SELECT balanco FROM rfa_clubes WHERE id_clube='$clube'";
$showbal = mysqli_query($link, $sshowbal) or die(mysqli_error($link));
$row_showbal = mysqli_fetch_assoc($showbal);
$ativabal = $row_showbal['balanco'];
?>

<!-- Modal -->
<div class="modal fade" id="balanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Selecione a data do balanço financeiro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php if($signal == 1){echo "balanco";}else{echo "../mpdf/balanco-financeiro.php";}?>" method="post" target="_blank">
      <div class="modal-body">
        <div class="row">
            <div class="col">
                <select class="form-control" name="filtroano" style="width: 80%; margin: 10px auto;" required>
                     <option value="" selected="selected">Selecione o ano</option>
                     <option value="<?php echo date("Y");?>"><?php echo date("Y");?></option>
                     <option value="<?php echo (date("Y")-1);?>"><?php echo (date("Y")-1);?></option>
                     <option value="<?php echo (date("Y")-2);?>"><?php echo (date("Y")-2);?></option>
                     <option value="<?php echo (date("Y")-3);?>"><?php echo (date("Y")-3);?></option>
                </select>
            </div>
            <div class="col">
                <select class="form-control" name="filtromes" style="width: 80%; margin: 10px auto;" required>
                     <option value="" selected="selected">Selecione o mês</option>
                     <option value="1">Janeiro</option>
                     <option value="2">Fevereiro</option>
                     <option value="3">Março</option>
                     <option value="4">Abril</option>
                     <option value="5">Maio</option>
                     <option value="6">Junho</option>
                     <option value="7">Julho</option>
                     <option value="8">Agosto</option>
                     <option value="9">Setembro</option>
                     <option value="10">Outubro</option>
                     <option value="11">Novembro</option>
                     <option value="12">Dezembro</option>
                </select>
            </div>
        </div>
      </div>
      <input type="hidden" name="clube" value="<?php echo $clube;?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Gerar balanço</button>
      </div>
      </form>
    </div>
  </div>
</div>
<header>


            <div class="container">
               <div class="header-top">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="full">
                           <div class="logo">
                              <a href="<?php if($signal == 1){echo "/";}else{echo "clube".$clube;}?>"><img src="<?php if($signal == 1){echo "painel/";}else{echo "../";}?><?php echo $row_topo['logo_topo']; ?>" alt="#" class="img-logo" /></a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="right_top_section">
                           
                           <ul class="social-icons pull-left">
                              
                              <?php if($row_topo['facebook_url'] == ""){}else{ ?><li><a class="facebook" href="<?php echo $row_topo['facebook_url']; ?>"><i class="fab fa-facebook"></i></a></li><?php } ?>
                              <?php if($row_topo['insta_url'] == ""){}else{ ?><li><a class="twitter" href="<?php echo $row_topo['insta_url']; ?>"><i class="fab fa-instagram"></i></a></li><?php } ?>
                              <?php if($row_topo['youtube_url'] == ""){}else{ ?><li><a class="youtube" href="<?php echo $row_topo['youtube_url']; ?>"><i class="fab fa-youtube"></i></a></li><?php } ?>
                              
                           </ul>
                           <!-- end social icon -->
                           <!-- button section -->
                           <ul class="login">
                              <?php if($ativabal==1){?>
                              <li class="login-modal">
                                 <a href="#" class="login" data-toggle="modal" data-target="#balanco"><i class="fas fa-file-invoice"></i>Balanço</a>
                              </li>
                              <?php }else{}?>
                              
                              <li class="login-modal">
                                 <a href="https://www.clubedigital.ong.br/painel" class="login" target="_blank"><i class="fa fa-user"></i>Painel do Clube</a>
                              </li>
                              <!--<li>
                                 <div class="cart-option">
                                    <a href="#"><i class="fa fa-shopping-cart"></i>Register</a>
                                 </div>
                              </li>-->
                           </ul>
                           <!-- end button section -->
                        </div>
                     </div>
                  </div>
               </div>

               <div class="header-bottom">
                  <div class="row">
                     <div class="col-md-12">

                        <div class="full">
                           <div class="main-menu-section">
                              <div class="menu">

                                 

                                 <nav class="navbar navbar-inverse">
                                    <div class="navbar-header">
                                       <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                                       <span class="sr-only">Navegação</span>
                                       <span class="icon-bar"></span>
                                       <span class="icon-bar"></span>
                                       <span class="icon-bar"></span>
                                       </button>
                                       <a class="navbar-brand" href="#">Menu</a>
                                    </div>
                                    <div class="collapse navbar-collapse js-navbar-collapse">
                                       <ul class="nav navbar-nav">
                                          
                                          <?php include('menu.php'); ?>

                                          <!--<li class="dropdown mega-dropdown">
                                             <a href="match" class="dropdown-toggle" data-toggle="dropdown">Match<span class="caret"></span></a>				
                                             <ul class="dropdown-menu mega-dropdown-menu">
                                                <li class="col-sm-8">
                                                   <ul>
                                                      <li class="dropdown-header">Men Collection</li>
                                                      <div id="menCollection" class="carousel slide" data-ride="carousel">
                                                         <div class="carousel-inner">
                                                            <div class="item active">
                                                               <div class="banner-for-match"><a href="#"><img class="img-responsive" src="images/match-banner1.jpg" alt="#" /></a></div>
                                                            </div>
                                                          
                                                            <div class="item">
                                                               <div class="banner-for-match"><a href="#"><img class="img-responsive" src="images/match-banner1.jpg" alt="#" /></a></div>
                                                            </div>
                                                           
                                                            <div class="item">
                                                               <div class="banner-for-match"><a href="#"><img class="img-responsive" src="images/match-banner1.jpg" alt="#" /></a></div>
                                                            </div>
                                                                                         
                                                         </div>
                                                         
                                                         <a class="left carousel-control" href="#menCollection" role="button" data-slide="prev">
                                                         <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                         <span class="sr-only">Previous</span>
                                                         </a>
                                                         <a class="right carousel-control" href="#menCollection" role="button" data-slide="next">
                                                         <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                         <span class="sr-only">Next</span>
                                                         </a>
                                                      </div>
                                                     
                                                   </ul>
                                                </li>
                                                <li class="col-sm-4">
                                                   <ul class="menu-inner">
                                                      <li class="dropdown-header">Next Matchs</li>
                                                      <li><a href="#">Contrary vs classical</a></li>
                                                      <li><a href="#">Discovered vs undoubtable</a></li>
                                                      <li><a href="#">Contrary vs classical</a></li>
                                                      <li><a href="#">Discovered vs undoubtable</a></li>
                                                      <li><a href="#">Contrary vs classical</a></li>
                                                      <li><a href="#">Discovered vs undoubtable</a></li>
                                                      <li><a href="#">Contrary vs classical</a></li>
                                                      <li><a href="#">Discovered vs undoubtable</a></li>
                                                   </ul>
                                                </li>
                                             </ul>
                                          </li>-->
                                          
                                       </ul>
                                    </div>
                                    <!-- /.nav-collapse -->
                                 </nav>
                                 <!--<div class="search-bar">
                                    <div id="imaginary_container">
                                       <div class="input-group stylish-input-group">
                                          <input type="text" class="form-control"  placeholder="Search" >
                                          <span class="input-group-addon">
                                          <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>  
                                          </span>
                                       </div>
                                    </div>
                                 </div>-->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>