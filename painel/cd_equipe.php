<?php 
$page = 9;

include('config-header.php');

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.id_lista_banco ORDER BY rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);

//Seleciona todos os planos
$qry = "SELECT * FROM rfa_planos";
$lisy = mysqli_query($link, $qry) or die(mysqli_error($link));
$row_lisy = mysqli_fetch_assoc($lisy);

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
    <title>Cadastro de Usuários - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->
	
	<!--Mask Money-->
<script language="javascript">   
function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
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
			<form method="post" action="login-seguro/proc_cd_equipe.php" name="form-contabancaria" enctype="multipart/form-data">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Cadastro</strong>
                                        <small> Equipe</small>
                                    </div>
                                    <div class="card-body card-block">
									
									
									
									
									
                                        
												 
												 <div class="row">
										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Nome completo</label>
												<input type="text" name="nome_usuario" id="nome_usuario" placeholder="Digite o nome do usuário" class="form-control" required>
											</div>
										</div>
										
										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">E-mail</label>
												<input type="email" name="email_usuario" id="email_usuario" placeholder="Digite o e-mail do usuário" class="form-control" required>
											</div>
										</div>
										
										</div>
										<div class="row">
										<div class="col">
                                                <div class="form-group">
											<label for="destino" class=" form-control-label">Tipo de Usuário </label>
                                                <select name="funcao" id="funcao" class="form-control" required>
                                                    <option value="">Selecione a função do usuário...</option>
                                                    <!--<option value="1">Administrador</option>
													<option value="2">Presidente de Clube</option>-->
													<option value="3">Secretário de Clube</option>
													<option value="4">Contador de Clube</option>
													<option value="5">Secretário Executivo de Clube</option>
													<option value="6">Tesoureiro</option>
                                                 </select>                                        
												 </div>
												
                                            </div>
										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Senha do Usuário</label>
												<input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required>
											</div>
										</div>
										</div>
                                       
										
										<input type="hidden"name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
										
										
										<div id="btn1">
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
										 <div id="btn2" style="display:none">
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Continuar...</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
                                        
                                    </div>
                                </div>
                            </div>
							</form>
							
							
							
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
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
	<script>
document.getElementById('funcao').addEventListener('change', function () {
if(document.getElementById('funcao').value == 1){
    document.getElementById('plan2').style.display = 'block';
	document.getElementById('plan1').style.display = 'none';
	document.getElementById('pgto2').style.display = 'block';
	document.getElementById('pgto1').style.display = 'none';
	document.getElementById('btn2').style.display = 'none';
	document.getElementById('btn1').style.display = 'block';
}else{
	document.getElementById('plan2').style.display = 'none';
	document.getElementById('plan1').style.display = 'block';
	document.getElementById('pgto2').style.display = 'none';
	document.getElementById('pgto1').style.display = 'block';
	document.getElementById('btn2').style.display = 'block';
	document.getElementById('btn1').style.display = 'none';
}

});
	</script>
	
	<!-- Start Script para trocar tipo de pessoa -->

	<!-- End Script para trocar tipo de pessoa -->
	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->