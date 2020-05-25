<?php
$page = 4;

include('config-header.php');

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
<link href="css/bootstrap-tagsinput.css" rel="stylesheet"/>
<script src="js/bootstrap-tagsinput.min.js"></script>

<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>
<style>
  .file-drop-area {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 100%;
    padding: 25px;
    border: 2px dashed rgb(66, 114, 215);
    border-radius: 3px;
    transition: 0.2s;
    &.is-active {: ;
    background-color: rgba(255, 255, 255, 0.05);
    }: ;
}

.fake-btn {
  flex-shrink: 0;
  background-color: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 3px;
  padding: 8px 15px;
  margin-right: 10px;
  font-size: 16px;
  text-transform: uppercase;
}

.file-msg {
  font-size: small;
  font-weight: 300;
  line-height: 1.4;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.file-input {
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  cursor: pointer;
  opacity: 0;
  &:focus {
    outline: none;
  }
}

span.tag.label.label-info {
    background: #4272d7;
    border-radius: 10px;
    padding: 1px 10px;
}
</style>


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
                                              <div class="file-drop-area">
                                                <span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px"></i> Escolha o logotipo</strong></span>
                                                <span class="file-msg">ou arraste e solte aqui...</span>
                                                <input class="file-input" type="file" name="img_logotipo">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-12 col-md-6">
                                              <label for="titulo" class="col-form-label">Título do site:</label>
                                              <input type="text" name="titulo" class="form-control" maxlength="70" placeholder="Máximo de 70 caracteres" value="<?php echo $row_lish['title_seo'];?>">
                                          </div>
                                          <div class="col-12 col-md-6">
                                              <label for="keyword" class="col-form-label">Palavras chave:</label><br>
                                              <input type="text" data-role="tagsinput" name="keyword" class="form-control"  value="<?php echo $row_lish['keyword_seo'];?>">
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
                                              <label for="titulo" class="col-form-label"><i class="fab fa-facebook"></i> URL Facebook:</label>
                                              <input type="text" name="facebook" id="facebook_url" class="form-control"  maxlength="70" placeholder="Ex.: https://facebook.com/nomedapagina" value="<?php echo $row_lish['facebook_url'];?>">
                                          </div>
                                          <div class="col-12 col-md-4">
                                              <label for="keyword" class="col-form-label"><i class="fab fa-instagram"></i> URL Instragram:</label>
                                              <input type="text" name="instagram" class="form-control" placeholder="Ex.: https://instagram.com/nomedapagina" value="<?php echo $row_lish['insta_url'];?>">
                                          </div>
                                          <div class="col-12 col-md-4">
                                              <label for="keyword" class="col-form-label"><i class="fab fa-youtube"></i> URL Youtube:</label>
                                              <input type="text" name="youtube" class="form-control" placeholder="Ex.: https://youtube.com/nomedocanal" value="<?php echo $row_lish['youtube_url'];?>">
                                          </div>
                                      </div>

                                      <div class="row">
                                          
                                          <div class="col-12">
                                              <label for="keyword" class="col-form-label">Linha de Notícia:</label>
                                              <input type="text" name="linha_noticia" class="form-control" placeholder="Digite o texto da linha de notícias superior" value="<?php echo $row_lish['linha_noticia'];?>">
                                          </div>
                                      </div>
                                      <div class="row">
                                          
                                          <div class="col-12">
                                              
                                              <div class="file-drop-area" style="margin-top: 20px">
                                                <span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px"></i> Capa de páginas secundárias</strong></span>
                                                <span class="file-msg">ou arraste e solte aqui (<strong>Tamanho indicado:</strong> 2184 x 696px)</span>
                                                <input class="file-input" type="file" name="img_capa">
                                              </div>
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
                                              
                                              <div class="file-drop-area" >
                                                <span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px"></i> Imagem do banner</strong></span>
                                                <span class="file-msg">ou arraste e solte aqui (<strong>Tamanho indicado:</strong> 1792 x 951px)</span>
                                                <input class="file-input" type="file" name="img_banner">
                                              </div>
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
                                      <div class="row">
                                          <div class="col">
                                              <label class="col-form-label">Link do botão:</label>
                                              <input type="text" name="link_botao" class="form-control" placeholder="Ex.: https://www.site.com.br/nomedapagina" value="<?php echo $row_lish['link_botao'];?>">
                                          </div>
                                      </div>

                                      
                                    </div>
                                </div>

<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
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
        $("input").tagsinput('items')
    </script>

<script>
  var $fileInput = $('.file-input');
var $droparea = $('.file-drop-area');

// highlight drag area
$fileInput.on('dragenter focus click', function() {
  $droparea.addClass('is-active');
});

// back to normal state
$fileInput.on('dragleave blur drop', function() {
  $droparea.removeClass('is-active');
});

// change inner text
$fileInput.on('change', function() {
  var filesCount = $(this)[0].files.length;
  var $textContainer = $(this).prev();

  if (filesCount === 1) {
    // if single file is selected, show file name
    var fileName = $(this).val().split('\\').pop();
    $textContainer.text(fileName);
  } else {
    // otherwise show number of files
    $textContainer.text(filesCount + ' arquivos selecionados');
  }
});
</script>

	<script type="text/javascript">
		SyntaxHighlighter.all()
	</script>
</html>
<!-- end document-->