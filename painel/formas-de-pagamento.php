<?php 
$page = 10;

include('config-header.php');

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_config_pagseguro WHERE id_pagseguro='1'";
$listapagseguro = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listapagseguro = mysqli_fetch_assoc($listapagseguro);


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
			<form method="post" action="proc_forma_pagamento.php" name="form-contabancaria">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Formas de Pagamento</strong>
                                        <small>Pagseguro</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
												
										<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">E-mail Pagseguro</label>
												<input type="email" name="emailpagseguro" id="emailpagseguro" placeholder="Digite o e-mail Pagseguro" class="form-control" value="<?php echo $row_listapagseguro['email_pagseguro'];?>" required>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Token Pagseguro</label>
												<input type="password" name="tokenpagseguro" id="tokenpagseguro" class="form-control" value="<?php echo $row_listapagseguro['token_pagseguro'];?>" required>
											</div>
										</div>

										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Sandbox</label>
												<select class="form-control" name="sandbox">
												<?php if($row_listapagseguro['sandbox_pagseguro'] == 1){?>
													<option value="1" selected>Ativar</option>
													<option value="0">Desativar</option>
												<?php }else{ ?>
													<option value="1">Ativar</option>
													<option value="0" selected>Desativar</option>
												<?php } ?>
												</select>
											</div>
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