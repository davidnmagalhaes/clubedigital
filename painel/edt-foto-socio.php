<?php
$page = 5;

include('config-header.php');
$idsocio = $_GET['id_socio'];

$qr = "SELECT * FROM rfs_socios WHERE clube='$clube' AND id_socio='$idsocio'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$refsocio = $row_lis['ref_socio'];

$q = "SELECT * FROM rfa_socios_filhos WHERE id_socio='$refsocio'";
$lisfilho = mysqli_query($link, $q) or die(mysqli_error($link));
$row_lisfilho = mysqli_fetch_assoc($lisfilho);

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
    <title>Imagens dos Sócios - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
    <script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->


 
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

	
</head>

<body class="animsition">

    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->

            
 <div class="main-content">
<?php
		
			// memory limit (nem todo server aceita)
			ini_set("memory_limit","50M");
			set_time_limit(0);
			
			// processa arquivo
			$imagem		= isset( $_FILES['imagem'] ) ? $_FILES['imagem'] : NULL;
			$tem_crop	= false;
			$img		= '';
			$diretorio = 'images/'.$imagem['name'];
			if( $imagem['tmp_name'] )
			{
				$imagesize = getimagesize( $imagem['tmp_name'] );
				if( $imagesize !== false )
				{
					if( move_uploaded_file( $imagem['tmp_name'], $diretorio ) )
					{
						include( 'm2brimagem.class.php' );
						$oImg = new m2brimagem( $diretorio );
						if( $oImg->valida() == 'OK' )
						{
							$oImg->redimensiona( '400', '', '' );
							$oImg->grava( $diretorio );
							
							$imagesize 	= getimagesize( $diretorio );
							$img		= '<img src="'.$diretorio.'" id="jcrop" '.$imagesize[3].' />';
							$preview	= '<img src="'.$diretorio.'" id="preview" '.$imagesize[3].' />';
							$tem_crop 	= true;	
						}
					}
				}
			}
		?>
		
		<?php if( $tem_crop === true ): ?>
			<h2 id="tit-jcrop">Recorte a imagem</h2>
			<div id="div-jcrop">
				
				<div id="div-preview">
					<?php echo $preview; ?>
				</div>
				
				<?php echo $img; ?>
				
				<input type="button" value="Salvar" id="btn-crop" />
			</div>
			<div id="debug">
				<p><strong>X</strong> <input type="text" id="x" size="5" disabled /> x <input type="text" id="x2" size="5" disabled /> </p>
				<p><strong>Y</strong> <input type="text" id="y" size="5" disabled /> x <input type="text" id="y2" size="5" disabled /> </p>
				<p><strong>Dimensões</strong> <input type="text" id="h" size="5" disabled /> x <input type="text" id="w" size="5" disabled /></p>
			</div>
			<script type="text/javascript">
				var img = '<?php echo $diretorio; ?>';
			
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
							$('#tit-jcrop').html('Feito!<br /><a href="crop-simples.php">enviar outra imagem</a>');
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
			<form name="frm-jcrop" id="frm-jcrop" method="post" action="edt-foto-socio.php" enctype="multipart/form-data">
				<p>
					<label>Envie uma imagem:</label>
					<input type="file" name="imagem" id="imagem" />
					<input type="submit" value="Enviar" />
				</p>
			</form>
		<?php endif; ?>
							
							
							
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	
	
	

	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->