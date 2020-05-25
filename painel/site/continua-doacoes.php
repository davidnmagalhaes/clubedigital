<?php 
//Conexão com banco de dados
include_once("../config.php");

if(isset($_POST['clube'])){
$clube = $_POST['clube'];
$nome = mysqli_real_escape_string($link,$_POST['nome']);
$email = mysqli_real_escape_string($link,$_POST['email']);
$cep = mysqli_real_escape_string($link,$_POST['cep']);
$estado = mysqli_real_escape_string($link,$_POST['estado']);
$endereco = mysqli_real_escape_string($link,$_POST['endereco']);
$numero = mysqli_real_escape_string($link,$_POST['numero']);
$cidade = mysqli_real_escape_string($link,$_POST['cidade']);
$cpf = mysqli_real_escape_string($link,$_POST['cpf']);
$rg = mysqli_real_escape_string($link,$_POST['rg']);
$telefone = mysqli_real_escape_string($link,$_POST['telefone']);
$celular = mysqli_real_escape_string($link,$_POST['celular']);
$escolaridade = mysqli_real_escape_string($link,$_POST['escolaridade']);
$renda = mysqli_real_escape_string($link,$_POST['renda']);
$deficiencia = mysqli_real_escape_string($link,$_POST['deficiencia']);
$necessidade = mysqli_real_escape_string($link,$_POST['necessidade']);
$origem = mysqli_real_escape_string($link,$_POST['origem']);
}else{
$clube = $_GET['clube'];
$nome = mysqli_real_escape_string($link,$_GET['nome']);
$email = mysqli_real_escape_string($link,$_GET['email']);
$cep = mysqli_real_escape_string($link,$_GET['cep']);
$estado = mysqli_real_escape_string($link,$_GET['estado']);
$endereco = mysqli_real_escape_string($link,$_GET['endereco']);
$numero = mysqli_real_escape_string($link,$_GET['numero']);
$cidade = mysqli_real_escape_string($link,$_GET['cidade']);
$cpf = mysqli_real_escape_string($link,$_GET['cpf']);
$rg = mysqli_real_escape_string($link,$_GET['rg']);
$telefone = mysqli_real_escape_string($link,$_GET['telefone']);
$celular = mysqli_real_escape_string($link,$_GET['celular']);
$escolaridade = mysqli_real_escape_string($link,$_GET['escolaridade']);
$renda = mysqli_real_escape_string($link,$_GET['renda']);
$deficiencia = mysqli_real_escape_string($link,$_GET['deficiencia']);
$necessidade = mysqli_real_escape_string($link,$_GET['necessidade']);
$origem = mysqli_real_escape_string($link,$_GET['origem']);
}



$sql = "SELECT * FROM rfa_site_topo WHERE clube='$clube'";
$topo = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_topo = mysqli_fetch_assoc($topo);
$totalRows_top = mysqli_num_rows($topo);


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

  <script src='https://www.google.com/recaptcha/api.js'></script>
  
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
      
    </script>

   </head>
   <body class="game_info" data-spy="scroll" data-target=".header">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
      <section id="top">
         


      </section>
      <section id="contant" class="contant main-heading team">

         <div class="row">
            <div class="col">
               <h2 style="font-size: 45px; line-height: 45px;">Questionário de Doação</h2>
            </div>
         </div>

         <div class="row">
            <div class="container">
               <div class="contact">
                  
                  
                  <div class="col-md-12">
                     <div class="contact-us">
                        <form method="post" action="proc-cd-doacoes.php">

                          <input type="hidden" name="nome" value="<?php echo $nome; ?>">
                          <input type="hidden" name="email" value="<?php echo $email; ?>">
                          <input type="hidden" name="cep" value="<?php echo $cep; ?>">
                          <input type="hidden" name="estado" value="<?php echo $estado; ?>">
                          <input type="hidden" name="endereco" value="<?php echo $endereco; ?>">
                          <input type="hidden" name="numero" value="<?php echo $numero; ?>">
                          <input type="hidden" name="cidade" value="<?php echo $cidade; ?>">
                          <input type="hidden" name="clube" value="<?php echo $clube; ?>">

                           <ul>
                              <li><input type="text" id="cpf" name="cpf" class="required" placeholder="Qual é o seu CPF?" value="<?php echo $cpf; ?>" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );" required></li>
                              <li><input type="text" id="rg" name="rg" class="required" placeholder="Qual é o seu RG?" value="<?php echo $rg; ?>" required></li>
                              <li><input type="text" id="telefone" name="telefone" class="required" placeholder="Qual é o seu Telefone?" value="<?php echo $telefone; ?>" maxlength="14" onkeydown="javascript: fMasc( this, mTel );" required></li>
                              <li><input type="text" id="celular" name="celular" class="required" placeholder="Qual é o seu Celular?" value="<?php echo $celular; ?>" maxlength="14" onkeydown="javascript: fMasc( this, mTel );" required></li>
                              <li>
                                 <select class="form-control required" style="margin-bottom: 25px; height: 42px;" name="escolaridade" required>

                                    <option>Qual é a sua escolaridade?</option>
                                     <option value="ensino-fundamental" <?php if($escolaridade == "ensino-fundamental"){echo "selected";}?>>Ensino fundamental</option>
                                     <option value="ensino-fundamental-incompleto" <?php if($escolaridade == "ensino-fundamental-incompleto"){echo "selected";}?>>Ensino fundamental incompleto</option>
                                     <option value="ensino-medio" <?php if($escolaridade == "ensino-medio"){echo "selected";}?>>Ensino médio</option>
                                     <option value="ensino-medio-incompleto" <?php if($escolaridade == "ensino-medio-incompleto"){echo "selected";}?>>Ensino médio incompleto</option>
                                     <option value="ensino-superior" <?php if($escolaridade == "ensino-superior"){echo "selected";}?>>Ensino superior</option>
                                     <option value="ensino-superior-incompleto" <?php if($escolaridade == "ensino-superior-incompleto"){echo "selected";}?>>Ensino superior incompleto</option>
                                 </select>
                              </li>
                              <li>
                                 <select class="form-control required" style="margin-bottom: 25px; height: 42px;" name="renda" required>
                                    <option>Qual é a renda familiar?</option>
                                     <option value="menos-baixa" <?php if($renda == "menos-baixa"){echo "selected";}?>>Abaixo de 1 salário mínimo</option>
                                     <option value="baixa" <?php if($renda == "baixa"){echo "selected";}?>>De 1 a 2 salários</option>
                                     <option value="media-baixa" <?php if($renda == "media-baixa"){echo "selected";}?>>De 5 a 10 salários</option>
                                     <option value="media" <?php if($renda == "media"){echo "selected";}?>>De 10 a 15 salários</option>
                                     <option value="alta-media" <?php if($renda == "alta-media"){echo "selected";}?>>De 15 a 20 salários</option>
                                     <option value="alta" <?php if($renda == "alta"){echo "selected";}?>>Acima de 20 salários</option>
                                 </select>
                              </li>
                              <li>
                                 <input type="text" name="deficiencia" placeholder="Qual é a sua deficiência? Ex.: Paraplégico" value="<?php echo $deficiencia; ?>" required>
                              </li>
                              <li style="text-align:left;">
                                 <label>Qual é a sua necessidade?</label><br>
                                 <ul>
                                    <li>
                                      <input type="radio" name="necessidade" style="width: 5%" value="cadeira-rodas" <?php if($necessidade == "cadeira-rodas"){echo "checked";}?>> Cadeira de Rodas
                                    </li>
                                 </ul>
                                 <ul>
                                    <li>
                                      <input type="radio" name="necessidade" style="width: 5%" value="cadeira-banho" <?php if($necessidade == "cadeira-banho"){echo "checked";}?>> Cadeira de Banho
                                    </li>
                                 </ul>
                              </li>
                              <li>
                                 <select class="form-control required" style="margin-bottom: 25px; height: 42px;" name="origem" required>
                                    <option>Como soube do banco de cadeiras de rodas?</option>
                                     <option value="google" <?php if($origem == "google"){echo "selected";}?>>Google</option>
                                     <option value="amigo" <?php if($origem == "amigo"){echo "selected";}?>>Amigo</option>
                                     <option value="folder" <?php if($origem == "folder"){echo "selected";}?>>Folder</option>
                                     <option value="facebook" <?php if($origem == "facebook"){echo "selected";}?>>Facebook</option>
                                     <option value="instagram" <?php if($origem == "instagram"){echo "selected";}?>>Instagram</option>
                                     <option value="email" <?php if($origem == "email"){echo "selected";}?>>E-mail</option>
                                     <option value="outdoor" <?php if($origem == "outdoor"){echo "selected";}?>>Outdoor</option>
                                 </select>
                              </li>
                              <li>
                                <div class="g-recaptcha custom-recaptcha" data-sitekey="6LfPJOoUAAAAAP_Z6aYEp7sbzZbWInoG-2-7JzTs"></div>
                              </li>
                              <li><input style="border: solid #0cb309 1px; margin-bottom: 25px; background: #0cb309; color: #fff; font-size: 18px; font-weight: bold;" type="submit" value="FINALIZAR SOLICITAÇÃO"></li>
                           </ul>
                           
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
<?php include('footer.php'); ?>

      <!-- ALL JS FILES -->
      <script src="js/all.js"></script>
      <!-- ALL PLUGINS -->
      <script src="js/custom.js"></script>
   </body>
</html>