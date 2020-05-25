<?php 
//Conexão com banco de dados
include_once("../config.php");

include('verificacao.php');
$idcmp = $_GET['idcmp'];

$srecaptcha = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$recaptcha = mysqli_query($link, $srecaptcha) or die(mysqli_error($link));
$row_recaptcha = mysqli_fetch_assoc($recaptcha);

$sqlcmp = "SELECT * FROM rfa_campanhas WHERE clube='$clube' AND cod_campanha='$idcmp'";
$cmp = mysqli_query($link, $sqlcmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_assoc($cmp);
$totalRows_cmp = mysqli_num_rows($cmp);

$valordoacao = $row_cmp['valor_campanha'];
$tipocampanha = $row_cmp['tipo_campanha'];
$metodocampanha = $row_cmp['metodo_campanha'];

if($metodocampanha == 'boleto'){
   $metodo = "<li class='listaitem'>Boleto Bancário</li>";
}elseif($metodocampanha == 'pagseguro'){
   $metodo = "<li class='listaitem'>Pagseguro</li>";
}else{
   $metodo = "<li class='listaitem'>Boleto Bancário</li><li class='listaitem'>Pagseguro</li>";
}

$sqlcmpli = "SELECT * FROM rfa_campanhas_itens WHERE clube='$clube' AND cod_campanha='$idcmp'";
$cmpli = mysqli_query($link, $sqlcmpli) or die(mysqli_error($link));

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
<h1 class="titulo-topo" style="font-size: 70px !important;"><?php echo $row_cmp['nome_campanha'];?></h1>
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
                           <h3><?php echo $row_cmp['nome_campanha'];?></h3>
                        </div>
                        <div class="kode-forminfo">
                           <p>
                              <?php echo $row_cmp['descricao_campanha'];?>
                           </p>
                             
                        </div>
                     </div>

                     <div class="contact-info">
                        <div class="kode-section-title">
                           <h3><i class="fas fa-bars" style="margin-right: 25px"></i> <?php if($tipocampanha == 'valor'){echo "Doação em valor";}elseif($tipocampanha == 'item'){echo "Doação em Itens";}else{echo "Doação de Itens ou Valor";}?></h3>
                        </div>
                        <div class="kode-forminfo">
                           <p>
                              <?php if($tipocampanha == "ambos"){echo "Esta campanha tem disponibilidade para doação dos itens abaixo ou do valor estipulado.";}?>
                              
                              <?php 

                                 if($tipocampanha == "item" || $tipocampanha == "ambos"){
                                    echo "<ul>";
                                    while($row_cmpli = mysqli_fetch_array($cmpli)){
                                       echo "<li class='listaitem'>".$row_cmpli['qtd_item']."x ".$row_cmpli['nome_item']."<li>";
                                    }  
                                    echo "</ul>";
                                 }

                                 if($tipocampanha == "valor" || $tipocampanha == "ambos"){
                                    echo "<strong style='color: #287515;font-size: 24px;'>Valor de doação: R$ ".number_format($valordoacao,2,',','.')."</strong><br><br>

                                       <strong style='color: #1f1f1f; font-size: 18px;font-weight: 500;'>
                                       Métodos de Pagamento:</strong><br>
                                       <ul>".$metodo."</ul>
                                    ";
                                 }
                              ?>
                              
                           </p>
                              
                           
                        </div>
                     </div>

                  </div>
                  <div class="col-md-6">
                     <div class="contact-us">
                        <form method="post" action="<?php if($signal == 1){echo "processacampanhas";}else{echo "proc-cd-campanha.php";}?>">
                           <h2 style="margin-bottom: 5px">Dados do Doador</h2>
                           <ul>
                              <li><input type="text" id="nome" name="nome" required placeholder="Nome completo"></li>
                              <li><input type="text" id="cpf" name="cpf" required placeholder="CPF"></li>
                              <li><input type="email" id="email" name="email" required placeholder="E-mail"></li>
                              <li><input type="text" id="telefone" name="telefone" required placeholder="Telefone"></li>
                              <li>
                                 <input type="text" name="cep" id="cep" placeholder="CEP" style="width: 48% !important;" onkeypress="return somenteNumeros(event)" maxlength="8" required>
                                 <input type="text" name="estado" id="estado" placeholder="Estado" style="width: 48% !important; margin-left: 4%;" required>
                              </li>
                              <li><input type="text" id="endereco" name="endereco" class="required" placeholder="Endereço" required></li>
                              <li>
                                 <input type="text" name="numero" id="numero" placeholder="Número" style="width: 48% !important;" required>
                                 <input type="text" name="cidade" id="cidade" placeholder="Cidade" style="width: 48% !important; margin-left: 4%;" required>
                              </li>
                              <?php if($tipocampanha == 'ambos'){?>
                              <li>
                                 <select name="tipodoacao" class="select" id="tipodoacao">
                                    <option selected disabled>Selecione o tipo de doação</option>
                                    <option value="valor">Doação de Valor</option>
                                    <option value="item">Doação de Itens</option>
                                 </select>
                              </li>
                              <?php }elseif($tipocampanha == 'valor'){?>
                                 <input type="hidden" name="tipodoacao" value="valor">
                              <?php }else{?>
                                 <input type="hidden" name="tipodoacao" value="item">
                              <?php }?>

                              <?php if($metodocampanha == 'ambos'){?>
                              <li id="payment">
                                 <select name="metodopagamento" class="select" id="metodopagamento">
                                    <option selected disabled>Selecione o método de pagamento</option>
                                    <option value="boleto">Boleto Bancário</option>
                                    <option value="pagseguro">Pagseguro</option>
                                 </select>
                              </li>
                              <?php }elseif($metodocampanha == 'boleto'){?>
                                 <div id="mtdboleto">
                                    <input type="hidden" name="metodopagamento" value="boleto">
                                 </div>
                              <?php }else{?>
                                 <div id="mtdpagseguro">
                                    <input type="hidden" name="metodopagamento" value="pagseguro">
                                 </div>
                              <?php }?>

                              <li><input type="text" name="quantidade" onkeypress="return somenteNumeros(event)" placeholder="Quantidade"></li>

                              <li style="text-align:left;"><input type="checkbox" id="confidencial" style="width: 30px" name="confidencial"> Deseja tornar esta doação anônima?</li>
                              <li><div class="g-recaptcha custom-recaptcha" data-sitekey="<?php echo $row_recaptcha['site_key'];?>"></div></li>
                              <li><input style="border: solid #0cb309 1px; margin-bottom: 25px; background: #0cb309; color: #fff; font-size: 18px; font-weight: bold;" type="submit" value="CONTINUAR DOAÇÃO"></li>
                           </ul>
                           <input type="hidden" value="<?php echo $clube;?>" name="clube">
                           <input type="hidden" value="<?php echo $idcmp;?>" name="idcampanha">
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

if( $('#tipodoacao').val()!="valor"){
    $("#payment").hide();
    }

$('#tipodoacao').on('change',function(){
    if( $(this).val()==="valor"){
    $("#payment").show();
    }
    
});

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