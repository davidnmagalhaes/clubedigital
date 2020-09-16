<?php
$page = 4;

include('config-header.php');

//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfa_site_slides WHERE clube='$clube'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
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
    <title><?php echo $nomeclube; ?></title>

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
  <form action="proc_cd_site_slide.php" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
               <!-- USER DATA-->
                

<div class="card">
                                    <div class="card-header">
                                        <strong>Slides</strong>
                                        <small> Configuração do Slides do Site</small>
                                        <button class="btn btn-primary" id="add" type="button"><i class="fas fa-plus"></i> Adicionar slide</button>
                                    </div>
                                    <div class="card-body card-block" id="linhas">

                                        <?php if($totalRows_lish==0){?>
                                            <div class="alert alert-info" id="noslide" style="text-align:center; font-weight: bold">Ainda não há slides criados!</div>
                                        <?php }?>

                                        <?php while($row_lish = mysqli_fetch_assoc($lish)){ ?>
                                    <div id="bloco-<?php echo $row_lish['id_slide'];?>">
                                            <!-- Modal -->
                                    <div class="modal fade" id="modalImg<?php echo $row_lish['id_slide'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body" style="text-align:center">

                                        <div class="row">
                                          <div class="col-12" style="margin: 15px 0">
                                            <h2><i class="fas fa-desktop" style="margin-right: 15px"></i> Desktop:</h2>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-12">
                                            <img src="<?php 
                                            if($row_lish['img_banner_topo']==""){
                                              echo "images/desktop-sem-imagem.jpg";
                                            }else{
                                              echo $row_lish['img_banner_topo'];
                                            }
                                            ?>" width="500">
                                          </div>
                                        </div>
                                        
                                        <div class="row">
                                          <div class="col-12" style="margin: 15px 0">
                                            <h2><i class="fas fa-mobile-alt" style="margin-right: 15px"></i> Mobile:</h2>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-12">
                                            <img src="<?php 
                                            if($row_lish['img_mobile_topo']==""){
                                              echo "images/mobile-sem-imagem.jpg";
                                            }else{
                                              echo $row_lish['img_mobile_topo'];
                                            }
                                            ?>" width="500">
                                          </div>
                                        </div>
                                            
                                            
                                            
                                            
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>


                                        <div class="alert alert-info" id="linha">
                                      <div class="row">
                                          <div class="col-12 col-md-2" style="text-align:center">
                                            <a href="#" data-toggle="modal" data-target="#modalImg<?php echo $row_lish['id_slide'];?>"><i class="fas fa-image" style="font-size: 100px"></i></a>
                                          </div>
                                          <div class="col-12 col-md-4">
                                              
                                              <div class="file-drop-area" >
                                                <span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px"></i> Imagem Desktop</strong></span>
                                                <span class="file-msg"><strong>Tamanho:</strong> 1792 x 951px</span>
                                                <input class="file-input" type="file" name="img_banner[]">
                                              </div>
                                          </div>
                                          <div class="col-12 col-md-4">
                                              
                                              <div class="file-drop-area" >
                                                <span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px"></i> Imagem Mobile</strong></span>
                                                <span class="file-msg"><strong>Tamanho:</strong> 495 x 840px</span>
                                                <input class="file-input" type="file" name="img_mobile[]">
                                              </div>
                                          </div>
                                          <div class="ol-12 col-md-2">
                                                <button class="btn btn-danger" id="exc-<?php echo $row_lish['id_slide'];?>" type="button" style="width: 100%; height: 100px" onclick="excluirSlide(this)"><i class="fas fa-trash-alt" style="font-size:25px"></i></button>
                                          </div>
                                          
                                      </div>

                                      <div class="row">
                                          <div class="col-12 col-md-3">
                                              <label for="titulo" class="col-form-label">Título do Banner:</label>
                                              <input type="text" name="titulo_banner[]" class="form-control" maxlength="60" placeholder="Máximo de 60 caracteres" value="<?php echo $row_lish['banner_title'];?>">
                                          </div>
                                          <div class="col-12 col-md-3">
                                              <label for="keyword" class="col-form-label">Subtítulo do Banner:</label>
                                              <input type="text" name="sub_banner[]" class="form-control" maxlength="130" placeholder="Máximo de 130 caracteres" value="<?php echo $row_lish['banner_sub'];?>">
                                          </div>
                                          <div class="col-12 col-md-3">
                                              <label for="keyword" class="col-form-label">Texto do Botão:</label>
                                              <input type="text" name="btn_banner[]" class="form-control" maxlength="20" placeholder="Máximo de 20 caracteres" value="<?php echo $row_lish['banner_btn'];?>">
                                          </div>
                                          <div class="col-12 col-md-3">
                                                <label>Posição</label>
                                                <select class="form-control" name="posicao[]">
                                                    <option value="left" <?php if($row_lish['lado']=="left"){echo "selected";}?>>Esquerdo</option>
                                                    <option value="right" <?php if($row_lish['lado']=="right"){echo "selected";}?>>Direito</option>
                                                </select>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-12 col-md-10">
                                              <label class="col-form-label">Link do botão:</label>
                                              <input type="text" name="link_botao[]" class="form-control" placeholder="Ex.: https://www.site.com.br/nomedapagina" value="<?php echo $row_lish['link_botao'];?>">
                                          </div>
                                          <div class="col-12 col-md-2">
                                                <label style="margin-top: 43px;">Ativo?</label>
                                                <input type="radio" name="ativo[]" class="ativos" onclick="mudaAtivo(this)" id="ativo-<?php echo $row_lish['id_slide'];?>" <?php if($row_lish['ativo']=="active"){echo "checked";}?> value="<?php if($row_lish['ativo']=="active"){echo $row_lish['id_slide'];}else{} ?>" >
                                          </div>
                                      </div>
                                        </div>
                                        <input type="hidden" name="updateslide[]" value="1">
                                        <input type="hidden" name="delslide[]" id="deleteslide-<?php echo $row_lish['id_slide'];?>" value="0">
                                        <input type="hidden" name="idslide[]" value="<?php echo $row_lish['id_slide'];?>">
                                              
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
                                <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Atualizar</span>
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
	
	<script>

function mudaAtivo(elem) {
            var botao = document.getElementById(elem.id).id;
            var res = botao.split("-");
            var rs = res[1];
            $('.ativos').val('');
            document.getElementById("ativo-" + rs).value = rs;
        }

function excluirSlide(elem) {
            var botao = document.getElementById(elem.id).id;
            var res = botao.split("-");
            var rs = res[1];
            document.getElementById("bloco-" + rs).style.display = "none";
            document.getElementById("deleteslide-" + rs).value = "1";
        }

$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#linhas').append('<div class="alert alert-info" id="linha'+i+'" style="margin-top: 40px"><input type="hidden" name="idslide[]" value="0"><input type="hidden" name="delslide[]" value="0"><input type="hidden" name="updateslide[]" value="0"><div class="row"><div class="col-5"><div class="file-drop-area" ><span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px"></i> Imagem Desktop</strong></span><span class="file-msg"><strong>Tamanho:</strong> 1792 x 951px</span><input class="file-input" type="file" name="img_banner[]"></div></div><div class="col-5"><div class="file-drop-area" ><span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px"></i> Imagem Mobile</strong></span><span class="file-msg"><strong>Tamanho:</strong> 495 x 840px</span><input class="file-input" type="file" name="img_mobile[]"></div></div><div class="col-12 col-md-2"><button class="btn btn-danger btn_remove" id="'+i+'" style="width: 100%; height: 96px" type="button"><i class="fas fa-trash-alt" style="font-size: 24px"></i></button></div></div><div class="row"><div class="col-12 col-md-3"><label for="titulo" class="col-form-label">Título do Banner:</label><input type="text" name="titulo_banner[]" class="form-control" maxlength="60" placeholder="Máximo de 60 caracteres"></div><div class="col-12 col-md-3"><label for="keyword" class="col-form-label">Subtítulo do Banner:</label><input type="text" name="sub_banner[]" class="form-control" maxlength="130" placeholder="Máximo de 130 caracteres"></div><div class="col-12 col-md-3"><label for="keyword" class="col-form-label">Texto do Botão:</label><input type="text" name="btn_banner[]" class="form-control" maxlength="20" placeholder="Máximo de 20 caracteres"></div><div class="col-12 col-md-3"><label>Posição</label><select class="form-control" name="posicao[]"><option value="left">Esquerdo</option><option value="right">Direito</option></select></div></div><div class="row"><div class="col-12 col-md-10"><label class="col-form-label">Link do botão:</label><input type="text" name="link_botao[]" class="form-control" placeholder="Ex.: https://www.site.com.br/nomedapagina"></div><div class="col-12 col-md-2"><label style="margin-top: 43px;">Ativo?</label><input type="radio" name="ativo[]" class="ativos" onclick="mudaAtivo(this)" id="ativo-b'+i+'" value="0"></div></div></div>');
        $('#noslide').hide();
	});

	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#linha'+button_id+'').remove();
	});
	
	
	
});
</script>
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
</body>
</html>
<!-- end document-->