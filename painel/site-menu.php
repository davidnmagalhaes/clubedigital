<?php
include_once("config.php");

session_start();

if(!isset($_SESSION['logado']) || $_SESSION['funcao'] != 1  && $_SESSION['funcao'] != 3):
	header("Location: index.php");
endif;

$user = $_SESSION['id_usuario'];
$clube = $_SESSION['clube'];

//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfa_site_topo WHERE clube='$clube'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$row_lish = mysqli_fetch_assoc($lish);
$totalRows_lish = mysqli_num_rows($lish);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestão do Rotary Fortaleza Alagadiço">
    <meta name="author" content="David Magalhães">
    <meta name="keywords" content="rotary alagadiço, rotary fortaleza alagadiço, fortaleza alagadiço">

    <!-- Title Page-->
    <title>Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


 <script type="text/javascript">
    function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
        img.src = 'http://granjasaojorge.com.br/img/loading1.gif';
        div.innerHTML = "";
        div.style.cssText = 'position: fixed; top: 20%; left: 40%; z-index: 5000; width: 200px; text-align: center;';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
        // These 2 lines cancel form submission, so only use if needed.
        //window.event.cancelBubble = true;
        //e.stopPropagation();
    }
</script>

<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>

</head>

<body class="animsition">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->


            
 <div class="main-content">
  <form action="proc_cd_site_topo.php" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
               <!-- USER DATA-->
                <div class="card">
                                    <div class="card-header">
                                        <strong>Topo</strong>
                                        <small> Configuração geral do site</small>
                                    </div>
                                    <div class="card-body card-block">
                  
                                      <div class="row">
                                          
                                          <div class="col-12">
                                              <label for="titulo" class="col-form-label">Logotipo:</label>
                                              <input type="file" name="img_logotipo" class="form-control">
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-12 col-md-6">
                                              <label for="titulo" class="col-form-label">Título do site:</label>
                                              <input type="text" name="titulo" class="form-control" maxlength="70" placeholder="Máximo de 70 caracteres" value="<?php echo $row_lish['title_seo'];?>">
                                          </div>
                                          <div class="col-12 col-md-6">
                                              <label for="keyword" class="col-form-label">Palavras chave:</label>
                                              <input type="text" name="keyword" class="form-control" placeholder="Palavras separadas por vírgula" value="<?php echo $row_lish['keyword_seo'];?>">
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-12">
                                              <label for="titulo" class="col-form-label">Descrição:</label>
                                              <textarea class="form-control" name="description" placeholder="Digite a descrição do site com no máximo 140 caracteres" maxlength="140" ><?php echo $row_lish['description_seo'];?></textarea>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-12 col-md-4">
                                              <label for="titulo" class="col-form-label">URL Facebook:</label>
                                              <input type="text" name="facebook" class="form-control" maxlength="70" placeholder="Ex.: https://facebook.com/nomedapagina" value="<?php echo $row_lish['facebook_url'];?>">
                                          </div>
                                          <div class="col-12 col-md-4">
                                              <label for="keyword" class="col-form-label">URL Instragram:</label>
                                              <input type="text" name="instagram" class="form-control" placeholder="Ex.: https://instagram.com/nomedapagina" value="<?php echo $row_lish['insta_url'];?>">
                                          </div>
                                          <div class="col-12 col-md-4">
                                              <label for="keyword" class="col-form-label">URL Youtube:</label>
                                              <input type="text" name="youtube" class="form-control" placeholder="Ex.: https://youtube.com/nomedocanal" value="<?php echo $row_lish['youtube_url'];?>">
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-12 col-md-6">
                                              <label for="titulo" class="col-form-label">Menu:</label>
                                              <select name="menu" class="form-control">
                                                  <option>Selecione o menu...</option>
                                              </select>
                                          </div>
                                          <div class="col-12 col-md-6">
                                              <label for="keyword" class="col-form-label">Linha de Notícia:</label>
                                              <input type="text" name="linha_noticia" class="form-control" placeholder="Digite o texto da linha de notícias superior" value="<?php echo $row_lish['linha_noticia'];?>">
                                          </div>
                                      </div>
                                          
                                        
                                    </div>
                                </div>

<div class="card">
                                    <div class="card-header">
                                        <strong>Banner</strong>
                                        <small> Configuração do Banner no Topo</small>
                                    </div>
                                    <div class="card-body card-block">
                  
                                      <div class="row">
                                          <div class="col-12">
                                              <label for="titulo" class="col-form-label">Imagem do banner <strong>(1792 x 951 pixels)</strong>:</label>
                                              <input type="file" name="img_banner" class="form-control">
                                          </div>
                                          
                                      </div>

                                      <div class="row">
                                          <div class="col-12 col-md-4">
                                              <label for="titulo" class="col-form-label">Título do Banner:</label>
                                              <input type="text" name="titulo_banner" class="form-control" maxlength="60" placeholder="Máximo de 60 caracteres" value="<?php echo $row_lish['banner_title'];?>">
                                          </div>
                                          <div class="col-12 col-md-4">
                                              <label for="keyword" class="col-form-label">Subtítulo do Banner:</label>
                                              <input type="text" name="sub_banner" class="form-control" maxlength="130" placeholder="Máximo de 130 caracteres" value="<?php echo $row_lish['banner_sub'];?>">
                                          </div>
                                          <div class="col-12 col-md-4">
                                              <label for="keyword" class="col-form-label">Texto do Botão:</label>
                                              <input type="text" name="btn_banner" class="form-control" maxlength="20" placeholder="Máximo de 20 caracteres" value="<?php echo $row_lish['banner_btn'];?>">
                                          </div>
                                      </div>

                                      
                                    </div>
                                </div>

<input type="hidden" name="club" value="<?= $_SESSION['clube'] ?>">
                                <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
                                <!-- END USER DATA-->
                </div>
              </form>
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>



	

    <?php include("scripts-footer.php"); ?>
	
	

</body>
	<script type="text/javascript">
		SyntaxHighlighter.all()
	</script>
</html>
<!-- end document-->