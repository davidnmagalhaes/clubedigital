<?php 
//Conexão com banco de dados
include_once("../config.php");

include('verificacao.php');
$idcmp = $_GET['idcmp'];

$srecaptcha = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$recaptcha = mysqli_query($link, $srecaptcha) or die(mysqli_error($link));
$row_recaptcha = mysqli_fetch_assoc($recaptcha);

$sqlcmp = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND status_site='1'";
$cmp = mysqli_query($link, $sqlcmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_assoc($cmp);
$totalRows_cmp = mysqli_num_rows($cmp);

$codconsativo = $row_cmp['cod_consorcio']; //Código do consórcio ativo

$sqlcatv = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_consorcio='$codconsativo'";
$catv = mysqli_query($link, $sqlcatv) or die(mysqli_error($link));
$row_catv = mysqli_fetch_assoc($catv);
$totalRows_catv = mysqli_num_rows($catv);

$sqlsc = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY nome_socio ASC";
$csc = mysqli_query($link, $sqlsc) or die(mysqli_error($link));

$listasocio = "";
foreach($csc as $sc){
   $listasocio .= "<option value='".$sc['id_socio']."'>".$sc['nome_socio']."</option>";
}

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
 <script src='https://www.google.com/recaptcha/api.js'></script>
<style>
  .listaitem{list-style: circle;color: #4a78ce;margin-left: 20px;font-size: 18px;}
  .select{float: left;
    width: 100%;
    padding: 8px 15px;
    border: solid #ccc 1px;
    margin-bottom: 25px;}
</style>
   </head>
   <body class="game_info" data-spy="scroll" data-target=".header">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
      <section id="top">
         
<?php include('header.php'); ?>

         <div class="inner-page-banner">
            <div class="container">
<h1 class="titulo-topo" style="font-size: 70px !important;"><?php if(isset($row_cmp['nome_consorcio'])){echo $row_cmp['nome_consorcio'];}else{echo "Consórcio Paul Harris";}?></h1>
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
                           <h3>Consórcio Paul Harris</h3>
                        </div>
                        <div class="kode-forminfo">
                           <p>
                              O consórcio de reconhecimento Companheiro Paul Harris é uma das formas mais eficientes de manter as  doações do clube para a Fundação Rotária e homenagear as pessoas que contribuíram com U$ 1,000.00 à Fundação Rotária. O Consórcio de Título Paul Harris é um grupo formado de 10 em 10 sócios do clube, que se reúnem  durante dez meses e contribuem com U$ 100.00 totalizando U$ 1,000.00  por mês. Então mensalmente é emitido um Título Paul Harris e realizado um sorteio mensal entre os participantes do consórcio, onde todo mês um dos participantes é contemplado. O Título é emitido no nome indicado pelo contemplado e o reconhecimento vai para o sócio sorteado.  O Título de companheiro Paul Harris foi criado em 1957 para demonstrar apreço e motivar contribuições substanciais ao programa hoje conhecido como Bolsas Educacionais.
                           </p>
                             
                        </div>
                     </div>

                    

                  </div>
                  <div class="col-md-6">
                     <?php if($totalRows_catv >= 10 || $totalRows_cmp < 1){?>
                     <div class="contact-info" style="background: #ffe8e8;">
                        <div class="kode-section-title">
                           <h3>Aguardando liberação de consórcio</h3>
                        </div>
                        <div class="kode-forminfo">
                           <p>
                              Os consórcios disponibilizados pelo Clube estão esgotados. Aguarde a liberação de outro consórcio pelo Clube para que possa realizar sua inscrição.
                           </p>
                             
                        </div>
                     </div>
                  <?php }else{ ?>
                     <div class="contact-us">
                        <form method="post" action="<?php if($signal == 1){echo "processaconsorcio";}else{echo "proc-cd-consorcio.php";}?>">
                           <h2 style="margin-bottom: 5px">Selecione um doador</h2>
                           <ul>
                              
                              <li>
                                 <select name="socio" class="select" id="socio">
                                    <option selected disabled>Selecione o sócio</option>
                                    <?php echo $listasocio;?>
                                 </select>
                              </li>
                              
                           
                              
                              <li style="width: 100%; height: 240px"><div class="g-recaptcha custom-recaptcha" data-sitekey="<?php echo $row_recaptcha['site_key'];?>"></div></li>
                              <li><input style="border: solid #0cb309 1px; margin-bottom: 25px; background: #0cb309; color: #fff; font-size: 18px; font-weight: bold;" type="submit" value="CONTINUAR"></li>
                           </ul>
                           <input type="hidden" value="<?php echo $clube;?>" name="clube">
                           <input type="hidden" value="<?php echo $codconsativo;?>" name="idconsorcio">
                        </form>
                     </div>
                  <?php }?>
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