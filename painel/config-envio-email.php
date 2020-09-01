<?php 
$page = 10;

include('config-header.php');

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.id_lista_banco ORDER BY rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);

$q = "SELECT * FROM rfa_config_email WHERE id_config='1'";
$envioemail = mysqli_query($link, $q) or die(mysqli_error($link));
$row_envioemail = mysqli_fetch_assoc($envioemail);

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
    <title>Envio de E-mails - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->
	
	
	
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
			<form method="post" action="proc_config_email.php" name="form-contabancaria">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Configurações</strong>
                                        <small>Envios de E-mails</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
												
										<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Host</label>
												<input type="text" name="host" id="host" placeholder="Digite o host do SMTP" value="<?php echo $row_envioemail['host'];?>" class="form-control" required>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Username</label>
												<input type="text" name="username" id="username" value="<?php echo $row_envioemail['username'];?>" class="form-control" required>
											</div>
										</div>
										</div>
                                        <div class="row form-group">
                                            
                                            <div class="col">
                                                <div class="form-group">
												<label for="n_conta" class=" form-control-label">Password</label>
												<input type="password" name="password" id="password" value="<?php echo $row_envioemail['password'];?>" class="form-control" required>
											</div>
												
                                            </div>
											<div class="col">
                                                 <div class="form-group">
												<label for="n_conta" class=" form-control-label">E-mail SMTP</label>
												<input type="email" name="emailsmtp" id="emailsmtp" value="<?php echo $row_envioemail['email_smtp'];?>" class="form-control" required>
											</div>
												
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h2>Recaptcha</h2>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 30px">
                                            <div class="col">
                                                <label>Public Key</label>
                                                <input type="text" class="form-control" name="publickey" value="<?php echo $row_envioemail['publickey_recaptcha'];?>">
                                            </div>
                                            <div class="col">
                                                <label>Secret Key</label>
                                                <input type="text" class="form-control" name="secretkey" value="<?php echo $row_envioemail['secretkey_recaptcha'];?>">
                                            </div>
                                        </div>
										
										
										
										
										
										<div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Atualizar</span>
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
	
	
	
	<!-- Start Script para trocar tipo de pessoa -->
<script>
		$('input[name="tipopessoa"]').change(function () {
    if ($('input[name="tipopessoa"]:checked').val() === "pj") {
        $('.exibetipopessoapj').show();
		 $('.exibetipopessoapf').hide();
    } else {
        $('.exibetipopessoapj').hide();
		$('.exibetipopessoapf').show();
    }
});
	</script>
	<!-- End Script para trocar tipo de pessoa -->
	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->