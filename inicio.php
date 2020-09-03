<?php 

include('painel/config.php');

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

$qdados = "SELECT * FROM rfa_config_email WHERE id_config='1'";
$buscadados = mysqli_query($link, $qdados) or die(mysqli_error($link));
$row_buscadados = mysqli_fetch_assoc($buscadados);
$publickey = $row_buscadados['publickey_recaptcha'];
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- // CSS FILES // -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.1.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- OWl Carousel CSS Files -->
    <link rel="stylesheet" href="js/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="js/plugins/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="js/plugins/owl-carousel/owl.transitions.css">
    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Video Pop Up Plugin -->
    <link rel="stylesheet" href="js/plugins/YouTube_PopUp-master/YouTubePopUp.css">
    <!-- PRELOADER -->
    <link rel="stylesheet" href="css/preloader.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="modal-video/css/modal-video.min.css">
    <title>Clube Digital - Gestão de Clubes Rotarianos</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-176708721-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-176708721-1');
</script>
<script src='https://www.google.com/recaptcha/api.js'></script> 
<script src='https://llwhatsapp.blob.core.windows.net/whatschat-scripts/whatschat-cc20acfb281c4fb6b9c1a98385317aca.js'></script>
</head>

<body data-spy="scroll" data-target=".navbar">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <!-- ==============================================
    PRELOADER
    =============================================== -->

    <div class="preloader-holder">
        <div class="loading">
            <a class="navbar-brand" href="#"><img src="imgs/clube-digital.png" width="200"></a>
        </div>
    </div>

    <!-- ==============================================
    HEADER
    =============================================== -->

    <header id="home">

        <!-- /// Navbar /// -->

        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <!-- // Brand // -->

                <a class="navbar-brand" href="#"><img src="imgs/clube-digital.png" width="200"></a>
                <a class="navbar-brand2 hide" href="#"><img src="imgs/clube-digital-light.png" width="200"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><i class="material-icons">menu</i></button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- / NavLinks / -->

                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#home">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#services">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#features">Ferramentas</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link page-scroll" href="#team">Suporte</a>
                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#contact">Contato</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link page-scroll" href="#prices">Investimento</a>
                        </li>-->
                        <li>
                            <a href="painel" class="btn btn-primary">Entrar</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <!-- /// BANNER /// -->
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <!-- // Caption // -->
                        <div class="caption">
                            <h1>Torne seu clube digital</h1>
                            <p class="sub">Facilite suas tarefas, economize tempo e dinheiro com a mais nova ferramente para <strong>gestão de clubes</strong></p>
                           
                           <div id="video-popup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 video-box">
                    <div class="play-button">
                        <a class="bla-2 wow flipInY js-video-button" data-video-id='OXrVsl2wURQ' data-wow-duration=".5s" data-wow-delay=".4s" href="#" data-toggle="modal" data-target="#modalVideo"><i class="material-icons">play_arrow</i></a>
                        <div class="waves-block">
                            <div class="waves wave-1"></div>
                            <div class="waves wave-2"></div>
                            <div class="waves wave-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                            <!-- / Macbook IMG / -->
                            <img class="img-fluid mx-auto wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s" src="imgs/macbook.png" alt="macbook">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- ==============================================
    ABOUT 
    =============================================== -->

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-4 wow bounceIn" data-wow-duration=".5s" data-wow-delay=".2s">
                    <!-- /// Icon /// -->
                    <i data-vi="layers" data-vi-size="70" data-vi-primary="#1992ec" data-vi-accent="#daeffd" data-vi-prop="#CEFAFF"></i>
                    <!-- // Title // -->
                    <h4>Fácil de Usar</h4>
                    <!-- / Caption / -->
                    <p>Design intuitivo e facil de utilizar diariamente.</p>
                </div>
                <div class="col-md-4 wow bounceIn" data-wow-duration=".5s" data-wow-delay=".4s">
                    <!-- /// Icon /// -->
                    <i data-vi="website" data-vi-size="70" data-vi-primary="#1992ec" data-vi-accent="#daeffd" data-vi-prop="#CEFAFF"></i>
                    <!-- // Title // -->
                    <h4>Responsivo</h4>
                    <!-- / Caption / -->
                    <p>Utilize em qualquer dispositivo, seja smartphone, table, notebook ou desktop.</p>
                </div>
                <div class="col-md-4 wow bounceIn" data-wow-duration=".5s" data-wow-delay=".6s">
                    <!-- /// Icon /// -->
                    <i data-vi="chat" data-vi-size="70" data-vi-primary="#1992ec" data-vi-accent="#daeffd" data-vi-prop="#CEFAFF"></i>
                    <!-- // Title // -->
                    <h4>Suporte</h4>
                    <!-- / Caption / -->
                    <p>Suporte via Chat em horário comercial - Seg a Sex | 08:30 às 18:30</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==============================================
    SERVICES 
    =============================================== -->

    <section id="services">
        <div class="container">
            <!--
            <div class="row">
                <div class="col-md-5 wow fadeInLeft" data-wow-duration=".5s" data-wow-delay=".2s">
                    <h3>Poderosa ferramenta para seu clube</h3>
                    <p>Com o </p>
                    <ul class="list-unstyled">
                        <li><i data-vi="check" data-vi-size="40" data-vi-primary="#1992ec" data-vi-accent="#daeffd" data-vi-prop="#CEFAFF"></i> <span>Responsive code.</span></li>
                        <li><i data-vi="check" data-vi-size="40" data-vi-primary="#1992ec" data-vi-accent="#daeffd" data-vi-prop="#CEFAFF"></i> <span>Look good on all devices.</span></li>
                        <li><i data-vi="check" data-vi-size="40" data-vi-primary="#1992ec" data-vi-accent="#daeffd" data-vi-prop="#CEFAFF"></i> <span>Created with mobile specialists.</span></li>
                    </ul>
                </div>
                <div class="col-md-7 wow fadeInRight" data-wow-duration=".5s" data-wow-delay=".5s">
                    <div class="img-table">
                        <img src="imgs/table.png" class="img-fluid" alt="table">
                    </div>
                </div>
            </div>
            -->
            <div class="row seconde">
                <div class="col-md-7 wow fadeInLeft" data-wow-duration=".5s" data-wow-delay=".2s">
                    <img src="imgs/sobre-clube-digital.jpg" class="img-fluid" alt="update">
                </div>
                <div class="col-md-5 wow fadeInRight" data-wow-duration=".5s" data-wow-delay=".5s">
                    <div class="caption">
                        <h3>Gestão eficiente e digital</h3>
                        <p>O Clube Digital torna sua gestão mais organizada, fácil de entender e moderna.</p>
                        <p>Conte com ferramentas incríveis de planejamento, marketing, financeiro, reuniões, e muito mais.</p>
                        <p>O Clube Digital conta com uma grande novidade, o <strong>Web Clube</strong>, um site incrível para seu clube!</p>
                        <button class="btn btn-secondary" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">Conheça mais</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

   


<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gestão eficiente e digital</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="caption">
         <p>O Clube Digital torna sua gestão mais organizada, fácil de entender e moderna.</p>
         <p>Conte com ferramentas incríveis de planejamento, marketing, financeiro, reuniões, e muito mais.</p>
         <p>O Clube Digital conta com uma grande novidade, o <strong>Web Clube</strong>, um site incrível para seu clube!</p>
                        
     </div>

      </div>
    
    </div>
  </div>
</div>


    <!-- ==============================================
    FEATURES 
    =============================================== -->

    <section id="features">
        <div class="container">
            <!-- /// Title /// -->
            <div class="row">
                <div class="col-md-6 col-sm-offset-2 text-center mx-auto">
                    <h2 class="section-title">Ferramentas e Diferenciais</h2>
                    <p>Descubra o que você pode fazer ao se tornar digital!</p>
                </div>
            </div>
            <!-- /// Features /// -->
            <div class="row">
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay=".2s">
                    <div class="feature-icon">
                        <img src="imgs/website.png" style="margin-top: 40px; width: 50px">
                    </div>
                    <h4>Site com Blog</h4>
                    <p>Não perca tempo e dinheiro, com Clube Digital seu clube terá um site customizável para interagir com seu público.</p>
                </div>
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay=".4s">
                    <div class="feature-icon">
                        <img src="imgs/money.png" style="margin-top: 35px; width: 50px">
                    </div>
                    <h4>Fluxo de Caixa</h4>
                    <p>Controle financeiro completo com receitas, despesas, saldos e inadimplências.</p>
                </div>
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay=".6s">
                    <div class="feature-icon">
                        <img src="imgs/barcode.png" style="margin-top: 40px; width: 50px">
                    </div>
                    <h4>Emissão de Boletos</h4>
                    <p>Emita boletos para mensalidades, títulos, etc... Com uma taxa especial de R$ 2,49 por boleto pago!</p>
                </div>
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay=".8s">
                    <div class="feature-icon">
                        <img src="imgs/transfer.png" style="margin-top: 40px; width: 50px">
                    </div>
                    <h4>Câmbio</h4>
                    <p>Configure o câmbio do mês e emita boletos com valor convertido.</p>
                </div>
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay="1s">
                    <div class="feature-icon">
                        <img src="imgs/meeting.png" style="margin-top: 40px; width: 50px">
                    </div>
                    <h4>Reuniões</h4>
                    <p>Tenha controle total de pautas, atas, frequências, recuperações e visitantes.</p>
                </div>
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay="1.2s">
                    <div class="feature-icon">
                        <img src="imgs/notification.png" style="margin-top: 40px; width: 50px">
                    </div>
                    <h4>Notificações</h4>
                    <p>É uma área exclusiva para que possa conversar com sua equipe, e até mesmo com outros clubes.</p>
                </div>
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay="1.2s">
                    <div class="feature-icon">
                        <img src="imgs/team.png" style="margin-top: 40px; width: 50px">
                    </div>
                    <h4>Equipe</h4>
                    <p>Crie usuários ilimitados para sua equipe, e trabalhe junto com todos.</p>
                </div>
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay="1.2s">
                    <div class="feature-icon">
                        <img src="imgs/goal.png" style="margin-top: 40px; width: 50px">
                    </div>
                    <h4>Gráficos</h4>
                    <p>O Clube Digital disponibiliza gráficos para melhor visualização de dados.</p>
                </div>
                <div class="col-md-4 feature wow bounceIn" data-wow-duration=".5s" data-wow-delay="1.2s">
                    <div class="feature-icon">
                        <img src="imgs/call-center.png" style="margin-top: 40px; width: 50px">
                    </div>
                    <h4>Suporte</h4>
                    <p>Chat Online diretamente com nosso suporte de Seg. a Sex. das 08:30 às 18:30</p>
                </div>
                
            </div>
        </div>
    </section>

    

    <!-- ==============================================
    PRICING 
    =============================================== -->

   <!--<section id="prices">
        <div class="container">
            <div class="row">
               
                <div class="col-md-6 col-sm-offset-2 col-md-offset-3 text-center mx-auto">
                    <h2 class="section-title">Planos Digitais:</h2>
                    <p>Seja você também Digital! Escolha o plano que mais lhe atende:</p>
                </div>
            </div>
            
            <div class="row">
               
                <div class="col-lg-4 wow fadeInLeft" data-wow-duration=".5s" data-wow-delay=".2s">
                    <div class="price-table">
                        <div class="header">
                            <h5 class="title">Basic</h5>
                            <div class="price">R$ 29,90</div>
                            <h4>Mensal</h4>
                        </div>
                        <ul>
                            <li>1 operador</li>
                            <li>Suporte e-mail</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                        </ul>
                        <a href="painel/register/index.php?plan=21#collapseOne" class="btn btn-transparent">Adquirir</a><br>
                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">Comparar</a>
                    </div>
                </div>
                
                <div class="col-lg-4 wow bounceIn" data-wow-duration=".5s" data-wow-delay=".4s">
                    <div class="price-table">
                        <div class="header">
                            <h5 class="title">Premium</h5>
                            <div class="price">R$ 59,90</div>
                            <h4>Mensal</h4>
                        </div>
                        <ul>
                            <li>Site</li>
                            
                            <li>3 operadores</li>
                            <li>Suporte e-mail e chat</li>
                            <li>Baixa automática de boletos</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                        </ul>
                        <button class="btn btn-primary" type="button">Adquirir</button><br>
                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">Comparar</a>
                    </div>
                </div>
               
                <div class="col-lg-4 wow fadeInRight" data-wow-duration=".5s" data-wow-delay=".2s">
                    <div class="price-table">
                        <div class="header">
                            <h5 class="title">Ultimate</h5>
                            <div class="price">R$ 89,90</div>
                            <h4>Mensal</h4>
                        </div>
                        <ul>
                            <li>Site + Blog</li>
                            <li>Página adicional</li>
                            <li>Câmbio</li>
                            <li>Usuários Ilimitados</li>
                            <li>Suporte e-mail, chat e whatsapp</li>
                            <li>Baixa automática de boletos</li>
                        </ul>
                        <button class="btn btn-transparent" type="button" >Adquirir</button><br>
                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">Comparar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>-->


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="row">
        <div class="col" style="padding:5px 20px 5px 20px">
        <table class="table textcenter">
          <thead class="thead-dark" >
            <tr>
              <th scope="col" style="background: #0e4380;">Funcionalidade</th>
              <th scope="col" style="background: #0e4380;">Basic</th>
              <th scope="col" style="background: #0e4380;">Premium</th>
              <th scope="col" style="background: #0e4380;">Ultimate</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Alteração de Imagens do site</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Alteração de vídeos do site</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Postagens no Blog</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Sócios integrados do sistema ao site</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Página sobre reuniões no site</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
             <tr>
              <th scope="row">Galeria de Presidentes no site</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Página adicional no site</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Emissão de Boletos</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Câmbio</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Despesas do Clube</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Receitas do Clube</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Saldo Mensal do Clube</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Saldo Acumulado do Clube</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Inadimplentes do Clube</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Mensalidades Pagas</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Gráficos</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
        
            <tr>
              <th scope="row">Financeiro por Sócio</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Bancos e Contas</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Baixa Automática de Mensalidades</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Baixa Manual de Mensalidades</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Calendário Flexível</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Pautas</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Atas</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Listas de Presenças</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Recuperação</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Serviços à Comunidade</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Serviços Profissionais</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Datas Importantes</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Chat Interno para a Equipe</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Operadores</th>
              <td>1 Operador</td>
              <td>3 Operadores</td>
              <td>Operadores Ilimitados</td>
            </tr>
            <tr>
              <th scope="row">Dados do Clube</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Envios de e-mails</th>
              <td><i class="fas fa-ban" style="color: #ff0000;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Integração com Paghiper</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Conexão Segura</th>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
              <td><i class="fas fa-check" style="color: #1ca71a;"></i></td>
            </tr>
            <tr>
              <th scope="row">Suporte</th>
              <td>E-mail</td>
              <td>Chat e e-mail</td>
              <td>Chat,e-mail e whatsapp</td>
            </tr>
            
          </tbody>
        </table>
        </div>
    </div>

    </div>
  </div>
</div>

<!-- ==============================================
    TESTIMONIALS 
    =============================================== -->
<!--
    <section id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-offset-2 carousel-container">
                    <div id="owl-testimonials" class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="testi-icon">
                                <i class="fas fa-quote-left" style="color: #fff; font-size: 24px; margin-top: 30px"></i>
                            </div>
                            <p class="quote">" Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. "</p>
                            <img src="imgs/1.png" class="img-fluid" alt="1">
                            <h4>John Doe</h4>
                            <span>CEO Founder</span>
                        </div>
                        <div class="item">
                            <div class="testi-icon">
                                <i data-vi="bullhorn" data-vi-primary="#cfecff" data-vi-accent="#60b6f4" data-vi-prop="#CEFAFF"></i>
                            </div>
                            <p class="quote">" Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. "</p>
                            <img src="imgs/2.png" class="img-fluid" alt="2">
                            <h4>Nadine Tores</h4>
                            <span>Project Manager</span>
                        </div>
                        <div class="item">
                            <div class="testi-icon">
                                <i data-vi="bullhorn" data-vi-primary="#cfecff" data-vi-accent="#60b6f4" data-vi-prop="#CEFAFF"></i>
                            </div>
                            <p class="quote">" Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem ".</p>
                            <img src="imgs/3.png" class="img-fluid" alt="3">
                            <h4>James Doe</h4>
                            <span>CEO Founder</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->
    <!-- ==============================================
    APP SCREENSHOTS 
    =============================================== -->

    <section id="screenshots">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-offset-2 col-md-offset-3 text-center title-container">
                    <!-- /// Title /// -->
                    <h2 class="section-title">Telas do Sistema:</h2>
                    <p>Conheça um pouco mais visualizando as telas do Clube Digital.</p>
                </div>
            </div>
            <div class="row">
                <div id="owl-screenshots">
                    <div class="item"><img src="imgs/screenshots/1.png" class="img-fluid" alt="screen-1"></div>
                    <div class="item"><img src="imgs/screenshots/2.png" class="img-fluid" alt="screen-2"></div>
                    <div class="item"><img src="imgs/screenshots/3.png" class="img-fluid" alt="screen-3"></div>
                    <div class="item"><img src="imgs/screenshots/1.png" class="img-fluid" alt="screen-1"></div>
                    <div class="item"><img src="imgs/screenshots/2.png" class="img-fluid" alt="screen-2"></div>
                    <div class="item"><img src="imgs/screenshots/3.png" class="img-fluid" alt="screen-3"></div>
                    <div class="item"><img src="imgs/screenshots/1.png" class="img-fluid" alt="screen-1"></div>
                    <div class="item"><img src="imgs/screenshots/2.png" class="img-fluid" alt="screen-2"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==============================================
    VIDEO POP UP 
    =============================================== -->

    <div id="video-popup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 video-box">
                    <img src="imgs/video-bg.png" class="img-fluid wow rotateIn" data-wow-duration=".5s" data-wow-delay=".2s" alt="popup">
                    <div class="play-button">
                        <a class="bla-2 wow flipInY js-video-button" data-video-id='OXrVsl2wURQ' data-wow-duration=".5s" data-wow-delay=".4s" href="#" data-toggle="modal" data-target="#modalVideo"><i class="material-icons">play_arrow</i></a>
                        <div class="waves-block">
                            <div class="waves wave-1"></div>
                            <div class="waves wave-2"></div>
                            <div class="waves wave-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==============================================
    TEAM
    =============================================== -->
<!--
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-offset-2 col-md-offset-3 text-center title-container">
                    
                    <h2 class="section-title">Suporte Especializado:</h2>
                    <p>Conte com ajuda técnica para que </p>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-4 member wow fadeInLeft" data-wow-duration=".5s" data-wow-delay=".2s">
                    <div class="member-img">
                        <img src="imgs/team/team1.png" class="img-fluid" alt="team-1">
                    </div>
                    <h4>Jason Brody</h4>
                    <p>CEO Founder</p>
                    <ul class="social-media">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4 member wow bounceIn" data-wow-duration=".5s" data-wow-delay=".4s">
                    <div class="member-img">
                        <img src="imgs/team/team-2.png" class="img-fluid" alt="team-2">
                    </div>
                    <h4>Myra Johns</h4>
                    <p>web designer</p>
                    <ul class="social-media">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4 member wow fadeInRight" data-wow-duration=".5s" data-wow-delay=".2s">
                    <div class="member-img">
                        <img src="imgs/team/team-3.png" class="img-fluid" alt="team-3">
                    </div>
                    <h4>Mike Smith</h4>
                    <p>web developer</p>
                    <ul class="social-media">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
-->
    <!-- ==============================================
    BRAND
    =============================================== -->

    <section id="brands">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center title-container">
                    <!-- /// Title /// -->
                    <h2 class="section-title">Qualidade:</h2>
                    <p>O Clube Digital é atualizado com frequência utilizando o melhor com integrações essenciais.</p>
                </div>
            </div>
            <div class="row">
                <div id="owl-brands">
                    <div class="item"><img src="imgs/brands/brand-1.png" class="img-fluid" alt="brand-1"></div>
                    <div class="item"><img src="imgs/brands/brand-2.png" class="img-fluid" alt="brand-1"></div>
                    <div class="item"><img src="imgs/brands/brand-3.png" class="img-fluid" alt="brand-3"></div>
                    <div class="item"><img src="imgs/brands/brand-1.png" class="img-fluid" alt="brand-1"></div>
                    <div class="item"><img src="imgs/brands/brand-2.png" class="img-fluid" alt="brand-2"></div>
                    <div class="item"><img src="imgs/brands/brand-3.png" class="img-fluid" alt="brand-3"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==============================================
    FOOTER
    =============================================== -->

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 text-center title-container">
                    <!-- /// Title /// -->
                    <h2 class="section-title">Tire suas dúvidas:</h2>
                    <p>Se ainda tem dúvidas sobre o sistema nos envie uma mensagem, será um prazer poder lhe ajudar!</p>
                </div>
            </div>

            <!-- /// CONTACT FORMS /// -->

            <form action="painel/enviar-contato.php" method="post">
                <div class="form-row">
                    <div class="form-group col-xs-12 col-sm-4">
                        <label>Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                    <div class="form-group col-xs-12 col-sm-4">
                        <label for="inputPassword4">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group col-xs-12 col-sm-4">
                        <label>Telefone:</label>
                        <input type="text" class="form-control" id="telefone" name="telefone">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Mensagem:</label>
                    <textarea id="mensagem" cols="30" rows="5" class="form-control" name="mensagem"></textarea>
                </div>

                <div class="row">
                    <div class="col" style="display:flex; justify-content:center">
                        <div class="g-recaptcha custom-recaptcha" data-sitekey="<?php echo $publickey;?>"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="display:flex; justify-content:center">
                        <button type="submit" class="btn btn-primary">Enviar dúvida</button>
                    </div>
                </div>

                
            </form>
            <p>Clube Digital &copy; Todos os direitos reservados <?php echo date('Y');?> Desenvolvido por David Magalhães</p>
        </div>
    </section>
    <script
	src="https://code.jquery.com/jquery-2.2.4.min.js"
	integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	crossorigin="anonymous"></script>
	<script src="modal-video/js/jquery-modal-video.min.js"></script>
	<script>
		$(".js-video-button").modalVideo({
			youtube:{
				controls:0,
				nocookie: true
			}
		});
	</script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
    <!-- Icons -->
    <script src="https://cdn.jsdelivr.net/npm/vivid-icons"></script>
    <script src="https://unpkg.com/vivid-icons"></script>
    <!-- OWL Carousel -->
    <script src="js/plugins/owl-carousel/owl.carousel.js"></script>
    <!-- Video Pop Up Plugin -->
    <script src="js/plugins/YouTube_PopUp-master/YouTubePopUp.jquery.js"></script>
    <script src="js/plugins/wow/wow.min.js"></script>
    <!-- Easing -->
    <script src="js/plugins/jquery.easing.min.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>

</body>

</html>