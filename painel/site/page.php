<?php 
//Conexão com banco de dados
include_once("../config.php");

include('verificacao.php');
$idpage = $_GET['id_page'];

$qpage = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube' AND id_page='$idpage'";
$lipage = mysqli_query($link, $qpage) or die(mysqli_error($link));
$row_lipage = mysqli_fetch_assoc($lipage);

$sql = "SELECT * FROM rfa_site_topo WHERE clube='$clube'";
$topo = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_topo = mysqli_fetch_assoc($topo);
$totalRows_top = mysqli_num_rows($topo);



$sblog = "SELECT * FROM rfa_site_blog WHERE clube='$clube' ORDER BY data_blog, hora_blog DESC LIMIT 2";
$blog = mysqli_query($link, $sblog) or die(mysqli_error($link));
$totalRows_blog = mysqli_num_rows($blog);

$sclube = "SELECT * FROM rfa_site_clube WHERE clube='$clube'";
$club = mysqli_query($link, $sclube) or die(mysqli_error($link));
$row_club = mysqli_fetch_assoc($club);
$totalRows_club = mysqli_num_rows($club);

$sconteudo = "SELECT * FROM rfa_site_conteudo WHERE clube='$clube'";
$conteudo = mysqli_query($link, $sconteudo) or die(mysqli_error($link));
$row_conteudo = mysqli_fetch_assoc($conteudo);
$totalRows_conteudo = mysqli_num_rows($conteudo);

$sblog2 = "SELECT * FROM rfa_site_blog WHERE clube='$clube' ORDER BY data_blog, hora_blog DESC LIMIT 4";
$blog2 = mysqli_query($link, $sblog2) or die(mysqli_error($link));
$totalRows_blog2 = mysqli_num_rows($blog2);


?>

<!DOCTYPE html>
<html lang="pt-br">
   <!-- Basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <!-- Site Metas -->
   <title><?php echo $row_topo['title_seo']; ?></title>
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
               <h1 class="titulo-topo" style="<?php if(strlen($row_lipage['nome_page']) >= 12){echo "font-size: 80px";}?>"><?php echo $row_lipage['nome_page'];?></h1>
            </div>
         </div>
      </section>
      <section id="contant" class="contant main-heading" style="padding-bottom:40px;margin-bottom:-1px;position:relative;">
         <div class="aboutus">
            <div class="container" >
               <div class="row" >
                  <div class="col-md-12 col-sm-12">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="full" >
                           
                           <?php if($signal == 1){echo str_replace('images/','painel/site/images/',$row_lipage['conteudo_page']);}else{echo $row_lipage['conteudo_page'];}?>
                           
                           
                           <!--<ul class="icon-list">
                              <li><i class="fa fa-angle-right"></i> Voluptate illum dolore ita ipsum</li>
                              <li><i class="fa fa-angle-right"></i> Labore admodum ita multos malis ea nam nam tamen fore amet</li>
                              <li><i class="fa fa-angle-right"></i> Voluptate illum dolore ita ipsum</li>
                           </ul>-->
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
         <!--<div class="dark-section" style="background:url(images/walle.jpg)">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12">
                     <div class="heading-main">
                        <h2>Our Testimonials</h2>
                     </div>
                     <div class="testimonial-slider">
                        <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                           
                           <div class="carousel-inner text-center">
                             
                              <div class="item active">
                                 <blockquote>
                                    <div class="row">
                                       <div class="col-sm-10 col-sm-offset-1">
                                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. !</p>
                                          <small>Someone famous</small>
                                       </div>
                                    </div>
                                 </blockquote>
                              </div>
                             
                              <div class="item">
                                 <blockquote>
                                    <div class="row">
                                       <div class="col-sm-10 col-sm-offset-1">
                                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                                          <small>Someone famous</small>
                                       </div>
                                    </div>
                                 </blockquote>
                              </div>
                             
                              <div class="item">
                                 <blockquote>
                                    <div class="row">
                                       <div class="col-sm-10 col-sm-offset-1">
                                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. .</p>
                                          <small>Someone famous</small>
                                       </div>
                                    </div>
                                 </blockquote>
                              </div>
                           </div>
                           
                           <ol class="carousel-indicators">
                              <li data-target="#quote-carousel" data-slide-to="0" class="active"><img class="img-responsive " src="https://s3.amazonaws.com/uifaces/faces/twitter/mantia/128.jpg" alt="">
                              </li>
                              <li data-target="#quote-carousel" data-slide-to="1"><img class="img-responsive" src="https://s3.amazonaws.com/uifaces/faces/twitter/adhamdannaway/128.jpg" alt="">
                              </li>
                              <li data-target="#quote-carousel" data-slide-to="2"><img class="img-responsive" src="https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg" alt="">
                              </li>
                           </ol>
                           
                           <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                           <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>-->
      </section>
      
<?php include('footer.php'); ?>

      <a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
      <!-- ALL JS FILES -->
      
   </body>
</html>