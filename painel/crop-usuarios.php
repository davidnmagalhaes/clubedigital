<?php 
include("config.php");

$codusuario = $_GET['cod_usuario'];
$coduser = $_POST['coduser'];
$data = date("d-m-Y-H-i");

if(empty($_FILES['imagem'])){}else{

$recebeimg = "images/usuarios/".$data."-".$_FILES['imagem']['name'];


$sql = "UPDATE rfa_usuario SET imagem = '$recebeimg' WHERE cod_usuario='$coduser'";
if ($link->multi_query($sql) === TRUE) {
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>

<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Imagem do Usuário</title>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="css/exemplo.css" type="text/css" />
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
		<!-- Bootstrap CSS-->
    	<link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

<script type="text/javascript">
    function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
        img.src = 'images/loading1.gif';
        div.innerHTML = "";
        div.style.cssText = 'position: fixed; top: 20%; left: 45%; z-index: 5000; width: 100px !important; text-align: center;';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
        // These 2 lines cancel form submission, so only use if needed.
        //window.event.cancelBubble = true;
        //e.stopPropagation();
    }
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
</style>
<script src="https://kit.fontawesome.com/13f03eba23.js" crossorigin="anonymous"></script>
	</head>
	<body>
		
		<section class="container">
		<div class="row">
			<div class="col" style="text-align: center; margin: 30px">
				<img src="images/clube-digital-white.png" width="300">
			</div>
		</div>
		
		
		<?php
		
			// memory limit (nem todo server aceita)
			ini_set("memory_limit","50M");
			set_time_limit(0);
			
			// processa arquivo
			$imagem		= isset( $_FILES['imagem'] ) ? $_FILES['imagem'] : NULL;
			$tem_crop	= false;
			$img		= '';
			$caminho = "login-seguro/images/usuarios/".$data."-".$imagem['name'];
			if( $imagem['tmp_name'] ) 
			{
				$imagesize = getimagesize( $imagem['tmp_name'] );
				if( $imagesize !== false )
				{
					if( move_uploaded_file( $imagem['tmp_name'], $caminho ) )
					{
						include( 'm2brimagem.class.php' );
						$oImg = new m2brimagem( $caminho );
						if( $oImg->valida() == 'OK' )
						{
							$oImg->redimensiona( '400', '', '' );
							$oImg->grava( $caminho );
							
							$imagesize 	= getimagesize( $caminho );
							$img		= '<img src="'.$caminho.'" id="jcrop" '.$imagesize[3].' />';
							$preview	= '<img src="'.$caminho.'" id="preview" '.$imagesize[3].' />';
							$tem_crop 	= true;	
						}
					}
				}
			}
		?>
		
		<?php if( $tem_crop === true ): ?>
			<h1 id="tit-jcrop">Recorte a imagem</h1>
			<div id="div-jcrop">
				
				<div id="div-preview">
					<?php echo $preview; ?>
				</div>
				
				<?php echo $img; ?>
				
				<div class="row">
					<div class="col" style="text-align: center">
						<input type="button" value="Salvar Imagem" id="btn-crop" class="btn btn-primary" style="margin: 20px"/>
					</div>
				</div>
			</div>
			<div id="debug">
				<p><strong>X</strong> <input type="text" id="x" size="5" disabled /> x <input type="text" id="x2" size="5" disabled /> </p>
				<p><strong>Y</strong> <input type="text" id="y" size="5" disabled /> x <input type="text" id="y2" size="5" disabled /> </p>
				<p><strong>Dimensões</strong> <input type="text" id="h" size="5" disabled /> x <input type="text" id="w" size="5" disabled /></p>
			</div>
			<script type="text/javascript">
				var img = '<?php echo $caminho; ?>';
			
				$(function(){
					$('#jcrop').Jcrop({
						onChange: exibePreview,
						onSelect: exibePreview,
						aspectRatio: 1
					});
					$('#btn-crop').click(function(){
						$.post( 'crop.php', {
							img:img, 
							x: $('#x').val(), 
							y: $('#y').val(), 
							w: $('#w').val(), 
							h: $('#h').val()
						}, function(){
							$('#div-jcrop').html( '<img src="' + img + '?' + Math.random() + '" width="'+$('#w').val()+'" height="'+$('#h').val()+'" />' );
							$('#debug').hide();
							$('#tit-jcrop').html('Parabéns! Você será redirecionado...');
							window.location = "https://www.clubedigital.ong.br/painel/home";
						});
						return false;
					});
				});
				
				function exibePreview(c)
				{
					var rx = 100 / c.w;
					var ry = 100 / c.h;
				
					$('#preview').css({
						width: Math.round(rx * <?php echo $imagesize[0]; ?>) + 'px',
						height: Math.round(ry * <?php echo $imagesize[1]; ?>) + 'px',
						marginLeft: '-' + Math.round(rx * c.x) + 'px',
						marginTop: '-' + Math.round(ry * c.y) + 'px'
					});
					
					$('#x').val(c.x);
					$('#y').val(c.y);
					$('#x2').val(c.x2);
					$('#y2').val(c.y2);
					$('#w').val(c.w);
					$('#h').val(c.h);
					
				};
			</script>
		<?php else: ?>
			<h1>UPLOAD DE IMAGEM DO USUÁRIO</h1>

			<form name="frm-jcrop" id="frm-jcrop" method="post" action="crop-usuarios.php" enctype="multipart/form-data" runat="server"  onsubmit="ShowLoading(); ">
				
					

										<div class="row" style="margin-bottom: 15px">
                                    		<div class="col-12">
                                    			<div class="file-drop-area">
                                                <span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px; font-size: 25px;"></i> Imagem do Usuário</strong></span>
                                                <span class="file-msg">escolhe ou arraste aqui...</span>
                                                <input class="file-input" type="file" name="imagem" id="imagem">
                                              </div>
                                    		</div>
                                    	</div>
                     <div class="row">
                     	<div class="col" style="text-align:center;">
							<input type="hidden" name="coduser" value="<?php echo $codusuario;?>">
							<input type="submit" value="Enviar" class="btn btn-primary"/>
						</div>
					</div>
			</form>
		<?php endif; ?>

	</section>
		
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
<!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
	</body>
</html>