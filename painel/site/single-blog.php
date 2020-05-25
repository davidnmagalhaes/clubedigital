<?php 
//Conexão com banco de dados
include_once("../config.php");

include('verificacao.php');
$idblog = $_GET['id_blog'];

$sql = "SELECT * FROM rfa_site_topo WHERE clube='$clube'";
$topo = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_topo = mysqli_fetch_assoc($topo);
$totalRows_top = mysqli_num_rows($topo);


$ssoc = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY nome_socio ASC";
$socios = mysqli_query($link, $ssoc) or die(mysqli_error($link));

$totalRows_socios = mysqli_num_rows($socios);

$sconteudo = "SELECT * FROM rfa_site_conteudo WHERE clube='$clube'";
$conteudo = mysqli_query($link, $sconteudo) or die(mysqli_error($link));
$row_conteudo = mysqli_fetch_assoc($conteudo);
$totalRows_conteudo = mysqli_num_rows($conteudo);

$sblog2 = "SELECT * FROM rfa_site_blog WHERE clube='$clube' ORDER BY data_blog, hora_blog DESC LIMIT 4";
$blog2 = mysqli_query($link, $sblog2) or die(mysqli_error($link));
$totalRows_blog2 = mysqli_num_rows($blog2);

$sblog3 = "SELECT * FROM rfa_site_blog WHERE clube='$clube' ORDER BY data_blog, hora_blog DESC LIMIT 6";
$blog3 = mysqli_query($link, $sblog3) or die(mysqli_error($link));
$totalRows_blog3 = mysqli_num_rows($blog3);


$sblog44 = "SELECT * FROM rfa_site_blog WHERE clube='$clube' AND id_blog='$idblog'";
$blog44 = mysqli_query($link, $sblog44) or die(mysqli_error($link));
$totalRows_blog44 = mysqli_num_rows($blog44);


?>

<!DOCTYPE html>
<html lang="pt-br">
   <title><?php echo $row_topo['title_seo']." | ".$row_blog44['titulo_blog']; ?></title>
   <meta name="keywords" content="<?php echo $row_topo['keyword_seo']; ?>">
   <meta name="description" content="<?php echo $row_topo['description_seo']; ?>">
   <meta name="author" content="David Magalhães">
   
<?php include('head.php');?>

   </head>
   <body class="game_info" data-spy="scroll" data-target=".header">
      
      <section id="top">
         
<?php include('header.php'); ?>

         <div class="inner-page-banner">
            <div class="container">
<h1 class="titulo-topo">Blog</h1>
            </div>

         </div>

      </section>
      <section id="contant" class="contant main-heading single-blog">
         <div class="row">
            <div class="container">
               <div class="col-md-9">
                  <div class="feature-post">
                     <?php while($row_blog44 = mysqli_fetch_array($blog44)){?>
                     <div class="feature-img">
                        <img src="<?php if($signal == 1){echo "painel/";}else{echo "../";}?><?php echo $row_blog44['imagem_blog'];?>" class="img-responsive" alt="#" />
                     </div>
                     <div class="feature-cont">
                        <div class="post-people">
                           <div class="left-profile">
                              <div class="post-info">
                                 <?php 
                                       $por = $row_blog44['por_blog'];
                                       $sb = "SELECT * FROM rfa_usuario WHERE clube='$clube' AND cod_usuario = '$por'";
                                       $bl = mysqli_query($link, $sb) or die(mysqli_error($link));
                                       $row_bl = mysqli_fetch_array($bl);
                                       
                                    ?>
                                 <img src="<?php if($signal == 1){echo "painel/login-seguro/";}else{echo "../login-seguro/";}?><?php echo $row_bl['imagem']; ?>" alt="#" />
                                 <span>
                                    
                                    <?php echo "<h4>Por ".$row_bl['nome']."</h4>"; ?>
                                    <h5>em <?php echo date('d/m/Y',strtotime($row_blog44['data_blog']));?></h5>
                                 </span>
                              </div>
                              <span class="share"></span>
                           </div>
                        </div>
                        <div class="post-heading">
                           <h3><?php echo $row_blog44['titulo_blog'];?></h3>
                           <p><?php echo $row_blog44['descricao_blog'];?>
                           </p>
                           
                        </div>
                     </div>
                  <?php } ?>

                     <!--<div class="commant-section">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <h3>COMMENTS: (5)</h3>
                           <div class="commant-text row">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-hidden">
                                 <div class="profile">
                                    <img class="img-responsive" src="images/client.png" alt="#">
                                 </div>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-hidden">
                                 <h5>David</h5>
                                 <p><span class="c_date">May 31, 2018</span> | <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span></p>
                                 <p class="msg">ThisThis book is a treatise on the theory of ethics, very popular during the Renaissance. 
                                    The first line of Lorem Ipsum, “Lorem ipsum dolor sit amet..
                                 </p>
                              </div>
                           </div>
                           <div class="commant-text row">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-hidden">
                                 <div class="profile">
                                    <img class="img-responsive" src="images/client.png" alt="#">
                                 </div>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-hidden">
                                 <h5>Jack</h5>
                                 <p><span class="c_date">May 31, 2018</span> | <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span></p>
                                 <p class="msg">Lorem ipsum dolor sit amet, consect etur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna ali qua. Ut enim.</p>
                              </div>
                              <div class="col-lg-1 col-md-1 col-sm-1"></div>
                              <div class="col-lg-11 col-md-11 col-sm-11">
                                 <div class="commant-text row">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-hidden">
                                       <div class="profile">
                                          <img class="img-responsive" src="images/client.png" alt="#">
                                       </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-hidden">
                                       <h5>Romy</h5>
                                       <p><span class="c_date">May 31, 2018</span> | <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span></p>
                                       <p class="msg">ThisThis book is a treatise on the theory of ethics, very popular during the Renaissance. 
                                          The first line of Lorem Ipsum, “Lorem ipsum dolor sit amet..”, comes from a line in section 1.10.32.
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-1"></div>
                                 <div class="col-lg-11 col-md-11 col-sm-11">
                                    <div class="commant-text row">
                                       <div class="col-lg-2 col-md-2 col-sm-4 col-xs-hidden">
                                          <div class="profile">
                                             <img class="img-responsive" src="images/client.png" alt="#">
                                          </div>
                                       </div>
                                       <div class="col-lg-10 col-md-10 col-sm-8 col-xs-hidden">
                                          <h5>Gerhard</h5>
                                          <p><span class="c_date">May 31, 2018</span> | <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span></p>
                                          <p class="msg">Lorem ipsum dolor sit amet, consect etur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna ali qua. Ut enim.</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="commant-text row">
                              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-hidden">
                                 <div class="profile">
                                    <img class="img-responsive" src="images/client.png" alt="#">
                                 </div>
                              </div>
                              <div class="col-lg-10 col-md-10 col-sm-8 col-xs-hidden">
                                 <h5>Gerhard</h5>
                                 <p><span class="c_date">May 31, 2018</span> | <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span></p>
                                 <p class="msg">ThisThis book is a treatise on the theory of ethics..</p>
                              </div>
                           </div>
                        </div>
                     </div>-->
                     <!--<div class="commant-section">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <h3>Leave a comment</h3>
                           <div class="form-command row">
                              <form action="#" method="post" id="comments_form" class="form-horizontal1">
                                 <div class="comment-box-field">
                                    <p class="col-md-12 col-sm-12">Your email address will not be published. Required fields are marked <span class="required">*</span></p>
                                    <div class="col-lg-6">
                                       <div class="comment-box-half"><input id="name" class="form-control1" name="author" placeholder="Name" value="" size="30" aria-required="true" type="text"></div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="comment-box-half"><input id="subject" class="form-control2" name="email" value="" placeholder="Subject" size="30" aria-required="true" type="email"></div>
                                    </div>
                                    <div class=" col-sm-12 col-xs-12">
                                       <div class="comment-box-full"><textarea id="comments" class="form-control4" placeholder="Comments" name="comment" cols="45" rows="3" aria-required="true"></textarea></div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="comment-box-submit">
                                          <input id="submit" value="Submit " type="submit">
                                       </div>
                                    </div>
                                    <input name="comment_post_ID" value="348" id="comment_post_ID" type="hidden">
                                    <input name="comment_parent" id="comment_parent" value="0" type="hidden">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>-->

                  </div>
                
                  <div class="feature-contant">
                  </div>
               </div>
               <div class="col-md-3">
                  <!--<div class="blog-sidebar">
                     <div class="search-bar-blog">
                        <form>
                           <input type="text" placeholder="search" />
                           <button><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                     </div>
                  </div>-->
                  <!--<div class="blog-sidebar">
                     <h4 class="heading">Top Categories</h4>
                     <div class="category-menu">
                        <ul>
                           <li><a href="#">Cricket</a></li>
                           <li><a href="#">Football</a></li>
                           <li><a href="#">Hockey</a></li>
                           <li><a href="#">Tennis</a></li>
                           <li><a href="#">Basketball</a></li>
                           <li><a href="#">Golf</a></li>
                           <li><a href="#">Cycling</a></li>
                           <li><a href="#">Motorsports</a></li>
                        </ul>
                     </div>
                  </div>-->
                  <!--<div class="blog-sidebar">
                     <h4 class="heading">Popular News</h4>
                     <div class="category-menu">
                        <ul>
                           <li>
                              <span><img src="images/profile-img2.png" alt="#"></span>
                              <span>
                                 <p>Two touch penalties, imaginary cards</p>
                                 <p class="date">22 Feb, 2016</p>
                              </span>
                           </li>
                        </ul>
                     </div>
                  </div>-->
                  <!--<aside id="sidebar" class="left-bar">
                     <div class="feature-matchs">
                        <div class="team-btw-match">
                           <ul>
                              <li>
                                 <img src="images/img-01_002.png" alt="">
                                 <span>Portugal</span>
                              </li>
                              <li class="vs"><span>vs</span></li>
                              <li>
                                 <img src="images/img-02.png" alt="">
                                 <span>Germany</span>
                              </li>
                           </ul>
                           <ul>
                              <li>
                                 <img src="images/img-03_002.png" alt="">
                                 <span>Portugal</span>
                              </li>
                              <li class="vs"><span>vs</span></li>
                              <li>
                                 <img src="images/img-04_003.png" alt="">
                                 <span>Germany</span>
                              </li>
                           </ul>
                           <ul>
                              <li>
                                 <img src="images/img-05_002.png" alt="">
                                 <span>Portugal</span>
                              </li>
                              <li class="vs"><span>vs</span></li>
                              <li>
                                 <img src="images/img-06.png" alt="">
                                 <span>Germany</span>
                              </li>
                           </ul>
                           <ul>
                              <li>
                                 <img src="images/img-07_002.png" alt="">
                                 <span>Portugal</span>
                              </li>
                              <li class="vs"><span>vs</span></li>
                              <li>
                                 <img src="images/img-08.png" alt="">
                                 <span>Germany</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </aside>-->
                  
                     <div class="banner-sidebar">
                        
                        <h3><strong>Últimas notícias</strong></h3>
                     </div>
                 
                 <?php while($row_blog3 = mysqli_fetch_array($blog3)){?>
                  <aside id="sidebar" class="left-bar">
                     <div class="banner-sidebar">
                        <img class="img-responsive" src="<?php if($signal == 1){echo "painel/";}else{echo "../";}?><?php echo $row_blog3['imagem_blog'];?>" alt="#" />
                        <h3>
                           <?php if($signal == 1){?>
                              <a href="post?id_blog=<?php echo $row_blog3['id_blog']; ?>"><?php echo $row_blog3['titulo_blog']; ?></a>
                           <?php }else{?>
                              <a href="single-blog.php?clube=<?php echo $clube; ?>&id_blog=<?php echo $row_blog3['id_blog']; ?>"><?php echo $row_blog3['titulo_blog']; ?></a>
                           <?php }?>
                        </h3>
                     </div>
                  </aside>
                  <?php } ?>
                  <!--<aside id="sidebar" class="left-bar">
                     <div class="feature-matchs">
                        <table class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Team</th>
                                 <th>P</th>
                                 <th>W</th>
                                 <th>L</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1</td>
                                 <td><img src="images/img-01_004.png" alt="">Liverpool</td>
                                 <td>10</td>
                                 <td>12</td>
                                 <td>20</td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td><img src="images/img-02_002.png" alt="">Chelsea</td>
                                 <td>10</td>
                                 <td>12</td>
                                 <td>20</td>
                              </tr>
                              <tr>
                                 <td>3</td>
                                 <td><img src="images/img-03_003.png" alt="">Norwich City</td>
                                 <td>20</td>
                                 <td>15</td>
                                 <td>20</td>
                              </tr>
                              <tr>
                                 <td>4</td>
                                 <td><img src="images/img-04_002.png" alt="">West Brom</td>
                                 <td>60</td>
                                 <td>10</td>
                                 <td>60</td>
                              </tr>
                              <tr>
                                 <td>5</td>
                                 <td><img src="images/img-05.png" alt="">sunderland</td>
                                 <td>30</td>
                                 <td>06</td>
                                 <td>30</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </aside>-->
               </div>
            </div>
         </div>
      </section>
      
<?php include('footer.php'); ?>

      <a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
      <!-- ALL JS FILES -->
      <script src="js/all.js"></script>
      <!-- ALL PLUGINS -->
      <script src="js/custom.js"></script>
   </body>
</html>