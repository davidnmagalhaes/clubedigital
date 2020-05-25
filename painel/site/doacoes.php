<?php 
//Conexão com banco de dados
include_once("../config.php");

include('verificacao.php');

$sql = "SELECT * FROM rfa_site_topo WHERE clube='$clube'";
$topo = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_topo = mysqli_fetch_assoc($topo);
$totalRows_top = mysqli_num_rows($topo);

$sblog = "SELECT * FROM rfa_site_blog WHERE clube='$clube' ORDER BY data_blog, hora_blog DESC LIMIT 2";
$blog = mysqli_query($link, $sblog) or die(mysqli_error($link));
$totalRows_blog = mysqli_num_rows($blog);

$ssoc = "SELECT * FROM rfa_site_galeria WHERE clube='$clube' ORDER BY ano_rotario_i DESC";
$socios = mysqli_query($link, $ssoc) or die(mysqli_error($link));

$totalRows_socios = mysqli_num_rows($socios);

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
   <title><?php echo $row_topo['title_seo']." | Receba doação de Cadeira de Rodas"; ?></title>
   <meta name="keywords" content="<?php echo $row_topo['keyword_seo']; ?>">
   <meta name="description" content="<?php echo $row_topo['description_seo']; ?>">
   <meta name="author" content="David Magalhães">
   
<?php include('head.php');?>
<script>
function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        // charCode 8 = backspace   
        // charCode 9 = tab
        if (charCode != 8 && charCode != 9) {
            // charCode 48 equivale a 0   
            // charCode 57 equivale a 9
            if (charCode < 48 || charCode > 57) {
                return false;
            }
        }
    }
</script>
   </head>
   <body class="game_info" data-spy="scroll" data-target=".header">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
      <section id="top">
         
<?php include('header.php'); ?>

         <div class="inner-page-banner">
            <div class="container">
<h1 class="titulo-topo" style="font-size: 70px !important;">Solicitar doação</h1>
            </div>

         </div>

      </section>
      <section id="contant" class="contant main-heading team">
         <div class="row">
            <div class="container">
               <div class="contact">
                  
                  <div class="col-md-6">
                     <div class="contact-info">
                        <div class="kode-section-title">
                           <h3>Doações de Cadeiras de Rodas</h3>
                        </div>
                        <div class="kode-forminfo">
                           <p>Este site tem um banco de cadeiras de rodas, contando com a <strong>vinculação do doador á pessoa necessitada</strong>.</p>
                           <p>O formulário ao lado permite a pessoa que necessita de cadeiras de rodas preencher os dados com informações verídicas, estas que serão analisadas pelo clube afim de que a doação seja realizada a pessoas que estejam no quadro de pré-requisitos.</p>
                           <p>Qualquer solicitação entrará numa <strong>fila de espera</strong> gerenciada pelo próprio clube, tendo em vista que as doações serão realizadas somente com a aprovação do mesmo.</p>
                           <ul class="kode-form-list">
                              <!--<li>
                                 <i class="fa fa-home"></i> 
                                 <p><strong>Address:</strong> 805 consectetur adipiscing elit, sed do eiusmod tempor</p>
                              </li>
                              <li>
                                 <i class="fa fa-phone"></i> 
                                 <p><strong>Phone:</strong>  123 456 7890</p>
                              </li>
                              <li>
                                 <i class="fa fa-envelope-o"></i> 
                                 <p><strong>Email:</strong> Info@sportyleague.com</p>
                              </li>-->
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="contact-us">
                        <form method="post" action="<?php if($signal == 1){echo "continuadoacoes";}else{echo "continua-doacoes.php";}?>">
                           <ul>
                              <li><input type="text" id="nome" name="nome" required placeholder="Nome completo..."></li>
                              <li><input type="email" id="email" name="email" required placeholder="E-mail..."></li>
                              <li>
                                 <input type="text" name="cep" id="cep" placeholder="CEP..." style="width: 48% !important;" onkeypress="return somenteNumeros(event)" maxlength="8" required>
                                 <input type="text" name="estado" id="estado" placeholder="Estado..." style="width: 48% !important; margin-left: 4%;" required>
                              </li>
                              <li><input type="text" id="endereco" name="endereco" class="required" placeholder="Endereço..." required></li>
                              <li>
                                 <input type="text" name="numero" id="numero" placeholder="Número..." style="width: 48% !important;" required>
                                 <input type="text" name="cidade" id="cidade" placeholder="Cidade..." style="width: 48% !important; margin-left: 4%;" required>
                              </li>

                              <li><input style="border: solid #0cb309 1px; margin-bottom: 25px; background: #0cb309; color: #fff; font-size: 18px; font-weight: bold;" type="submit" value="CONTINUAR SOLICITAÇÃO"></li>
                           </ul>
                           <input type="hidden" value="<?php echo $clube;?>" name="clube">
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
<?php include('footer.php'); ?>

      <a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

      <script type="text/javascript">
      
      $("#cep").focusout(function(){
         $.ajax({
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
            dataType: 'json',
            success: function(resposta){
               $("#endereco").val(resposta.logradouro);
               $("#cidade").val(resposta.localidade);
               $("#estado").val(resposta.uf);
               $("#numero").focus();
               
            }
         });
      });
   </script>
      <!-- ALL JS FILES -->
      <script src="js/all.js"></script>
      <!-- ALL PLUGINS -->
      <script src="js/custom.js"></script>
   </body>
</html>