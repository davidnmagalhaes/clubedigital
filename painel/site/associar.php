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

$ssoc = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY nome_socio ASC";
$socios = mysqli_query($link, $ssoc) or die(mysqli_error($link));
$row_socios = mysqli_fetch_array($socios);

$listarsocios = "";

foreach($socios as $sc){
   $listarsocios .= "<option value='".$sc['id_ri_socio']."'>".$sc['nome_socio']."</option>";
}

$sconteudo = "SELECT * FROM rfa_site_conteudo WHERE clube='$clube'";
$conteudo = mysqli_query($link, $sconteudo) or die(mysqli_error($link));
$row_conteudo = mysqli_fetch_assoc($conteudo);
$totalRows_conteudo = mysqli_num_rows($conteudo);

$sblog2 = "SELECT * FROM rfa_site_blog WHERE clube='$clube' ORDER BY data_blog, hora_blog DESC LIMIT 4";
$blog2 = mysqli_query($link, $sblog2) or die(mysqli_error($link));
$totalRows_blog2 = mysqli_num_rows($blog2);


$sblog3 = "SELECT * FROM rfa_site_blog WHERE clube='$clube' ORDER BY data_blog, hora_blog DESC LIMIT 2";
$blog3 = mysqli_query($link, $sblog3) or die(mysqli_error($link));
$totalRows_blog3 = mysqli_num_rows($blog3);

?>

<!DOCTYPE html>
<html lang="pt-br">
 
   <title><?php echo $row_topo['title_seo']." | Seja um associado"; ?></title>
   <meta name="keywords" content="<?php echo $row_topo['keyword_seo']; ?>">
   <meta name="description" content="<?php echo $row_topo['description_seo']; ?>">
   <meta name="author" content="David Magalhães">
   
<?php include('head.php');?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
   $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script type="text/javascript">
         function fMasc(objeto,mascara) {
            obj=objeto
            masc=mascara
            setTimeout("fMascEx()",1)
         }
         function fMascEx() {
            obj.value=masc(obj.value)
         }
         function mTel(tel) {
            tel=tel.replace(/\D/g,"")
            tel=tel.replace(/^(\d)/,"($1")
            tel=tel.replace(/(.{3})(\d)/,"$1)$2")
            if(tel.length == 9) {
               tel=tel.replace(/(.{1})$/,"-$1")
            } else if (tel.length == 10) {
               tel=tel.replace(/(.{2})$/,"-$1")
            } else if (tel.length == 11) {
               tel=tel.replace(/(.{3})$/,"-$1")
            } else if (tel.length == 12) {
               tel=tel.replace(/(.{4})$/,"-$1")
            } else if (tel.length > 12) {
               tel=tel.replace(/(.{4})$/,"-$1")
            }
            return tel;
         }
         function mCNPJ(cnpj){
            cnpj=cnpj.replace(/\D/g,"")
            cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
            cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
            cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
            cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
            return cnpj
         }
         function mCPF(cpf){
            cpf=cpf.replace(/\D/g,"")
            cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
            cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
            cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
            return cpf
         }
         function mCEP(cep){
            cep=cep.replace(/\D/g,"")
            cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
            cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
            return cep
         }
         function mNum(num){
            num=num.replace(/\D/g,"")
            return num
         }
         
         
         
         
      </script>
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

<style>
   @media (max-width: 768px){
   .box_noticias{display:none !important;}
}
</style>

   </head>
   <body class="game_info" data-spy="scroll" data-target=".header">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
      <section id="top">
         
<?php include('header.php'); ?>

         <div class="inner-page-banner">
            <div class="container">
<h1 class="titulo-topo">Indique um sócio</h1>
            </div>

         </div>

      </section>
      
      <section id="contant" class="contant main-heading team">
         <div class="row">
            <div class="container">
               <div class="contact">
                  
                  <div class="col-md-6">
                     <div class="contact-info" style="margin-bottom: 15px">
                        <div class="kode-section-title">
                           <h3 >Associe-se á <?php echo $row_topo['title_seo']; ?></h3>
                        </div>
                        <div class="kode-forminfo">
                           <p>
                              Preencha o formulário a seguir para enviar uma solicitação ao clube e se tornar um sócio.
                           </p>
                           
                        </div>
                     </div>

                     <div class="box_noticias">
                      <div class="banner-sidebar" >
                        
                        <h3 ><strong >Últimas notícias</strong></h3>
                     </div> 
                 
                 <?php while($row_blog3 = mysqli_fetch_array($blog3)){?>
                  <aside id="sidebar" class="left-bar">
                     <div class="banner-sidebar">
                        <img class="img-responsive" src="<?php if($signal == 1){echo "painel/";}else{echo "../";}?><?php echo $row_blog3['imagem_blog'];?>" alt="#" />
                        <h3><a href="single-blog.php?clube=<?php echo $clube; ?>&id_blog=<?php echo $row_blog3['id_blog']; ?>"><?php echo $row_blog3['titulo_blog']; ?></a></h3>
                     </div>
                  </aside>
                  <?php } ?>
                     </div>

                  </div>
                  <div class="col-md-6">
                     <div class="contact-us">
                        <form method="post" action="proc_associar.php">
                           <ul>
                              <li><input type="text" autofocus id="nome" name="nome" class="required" placeholder="Nome completo" required></li>
                              <li>
                                 <select name="idri" class="select" required>
                                    <option selected disabled>Selecione um sócio padrinho</option>
                                    <?php echo $listarsocios; ?>
                                 </select>
                              </li>
                              <li><input type="text" id="email" name="email" class="required email" placeholder="E-mail" required></li>
                              <li><input type="text" name="rg" id="rg" placeholder="RG" style="width: 48%; float:left;" required><input type="text" name="cpf" id="cpf" placeholder="CPF" style="width: 48%; float:left; margin-left: 4%;" onkeydown="javascript: fMasc( this, mCPF );" required></li>
                              
                              <li>
                                 <input type="date" name="nascto" id="nascto" placeholder="Data de Nascimento" style="width: 48%; float:left;" data-toggle="tooltip" data-placement="top" title="Data de Nascimento" required>
                                 <input type="text" name="cep" id="cep" placeholder="CEP" maxlength="8" onkeypress="return somenteNumeros(event)" style="width: 48%; float:left; margin-left: 4%;" required>
                              </li>
                              <li><input type="text" name="endereco" id="endereco" placeholder="Endereço" required></li>
                              <li>
                                 <input type="text" name="numero" id="numero" placeholder="Número" style="width: 48%; float:left;" required>
                                 <input type="text" name="bairro" id="bairro" placeholder="Bairro" style="width: 48%; float:left; margin-left: 4%;" required>
                              </li>
                              <li>
                                 <input type="text" name="cidade" id="cidade" placeholder="Cidade" style="width: 48%; float:left;" required>
                                 <input type="text" name="estado" id="estado" placeholder="Estado" style="width: 48%; float:left; margin-left: 4%;" required>
                              </li>
                              <li><input type="text" name="telefone" id="telefone" placeholder="Telefone" onkeydown="javascript: fMasc( this, mTel );" required></li>

                              <li><input type="text" name="profissao" id="profissao" placeholder="Profissão" required></li>
                              <p><strong style="text-align:center; font-size: 18px">Cônjuge do sócio</strong></p>
                              <li><input type="text" name="nomeconjuge" id="nomeconjuge" placeholder="Nome do cônjuge" required></li>
                              <li>
                                 <label>Data do casamento:</label>
                                 <input type="date" name="datacasamento" id="datacasamento" placeholder="Data do Casamento" required>
                              </li>
                              <li>
                                 <label>Data de Nascimento do Cônjuge:</label>
                                 <input type="date" name="nasctoconjuge" id="nasctoconjuge" placeholder="Nascimento do Cônjuge" required>
                              </li>
                              <p><strong style="text-align:center; font-size: 18px">Filho(s) do Sócio </strong></p>
                              <p style="text-align:center"><button class="btn btn-primary" type="button" name="add" id="add" style="float:none !important"><span style="font-size: 16px; font-weight: bold;">+</span> Adicionar mais filhos</button></p>
                              <div id="dynamic_field">
                                 <div id="row">
                              <li><input type="text" name="nomefilho[]" placeholder="Nome do filho" required></li>
                              <li>
                                 <label>Data de Nascimento do Filho:</label>
                                 <input type="date" name="nasctofilho[]" placeholder="Nascimento do Filho" required>
                              </li>
                              </div>
                              </div>
                              <input type="hidden" name="clube" value="<?php echo $clube;?>"> 
                              <div class="g-recaptcha" style="height: 180px; margin: 15px 0" data-sitekey="6LfPJOoUAAAAAP_Z6aYEp7sbzZbWInoG-2-7JzTs"></div>
                              <li><input class="thbg-color" type="submit" value="Solicitar" style="background: #40a02e; color: #fff"></li>
                           </ul>
                           
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php include('footer.php'); ?>

      <a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

<script>

  

$(document).ready(function(){
   var i=1;
   $('#add').click(function(){
      i++;
      $('#dynamic_field').append('<div id="row'+i+'"><li style="border-top: 1px solid #000">&nbsp</li><li><input type="text" name="nomefilho[]" placeholder="Nome do filho" required></li><li><label>Data de Nascimento do Filho:</label><input type="date" name="nasctofilho[]" placeholder="Nascimento do Filho" required> </li><li><button type="button" name="remove" id="'+i+'" style="width: 100%; margin: 10px 0; background: #ff0000" class="btn btn-danger btn_remove">X</button></li></div> ');
   
   });

   
   $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id"); 
      $('#row'+button_id+'').remove();
   });
   
   
   
});
</script>

      <!-- ALL JS FILES -->
      <script src="js/all.js"></script>
      <!-- ALL PLUGINS -->
      <script src="js/custom.js"></script>

<script type="text/javascript">
      
      $("#cep").focusout(function(){
         $.ajax({
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
            dataType: 'json',
            success: function(resposta){
               $("#endereco").val(resposta.logradouro);
               $("#bairro").val(resposta.bairro);
               $("#cidade").val(resposta.localidade);
               $("#estado").val(resposta.uf);
               $("#numero").focus();
               
            }
         });
      });
   </script>

   </body>
</html>