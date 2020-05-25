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
                              <!--<li class="login-modal">
                                 <a href="../home" class="login"><i class="fas fa-file-invoice"></i>Balanço</a>
                              </li>-->
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