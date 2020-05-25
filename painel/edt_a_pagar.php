<?php
session_start();

if(!isset($_SESSION['logado']) || $_SESSION['funcao'] != 1):
	header("Location: index.php");
endif;

$idpagar = $_GET['id_pagar'];

//Conexão com banco de dados
include_once("config.php");

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.id_lista_banco WHERE rfa_bancos.id_conta = '$idpagar' ORDER BY rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);


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
    <title>Cadastro de Contas a Pagar - Rotary Fortaleza Alagadiço</title>

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
			<form method="post" action="proc_cd_a_pagar.php" name="form-contabancaria">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Cadastro</strong>
                                        <small> contas a pagar</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
											<label for="origem" class=" form-control-label">Origem </label>
                                                <select name="origem_pagar" id="origem_pagar" class="form-control" required>
                                                    <option value="">Selecione uma conta...</option>
                                                    <?php do{?>
													<option value="<?php echo $row_listabancos['id_conta'];?>"><?php echo $row_listabancos['favorecido'];?> <strong>(<?php echo $row_listabancos['nome_lista_banco'];?>)</strong></option>
													<?php }while($row_listabancos = mysqli_fetch_assoc($listabancos));?>
                                                 </select>                                        </div>
										<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="descricao_pagar" class=" form-control-label">Descrição</label>
												<input type="text" name="descricao_pagar" id="descricao_pagar" value="<?php echo $row_listabancos['descricao_pagar'];?>" class="form-control" required>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="data_pagar" class=" form-control-label">Vencimento</label>
												<input type="date" name="data_pagar" id="data_pagar" class="form-control" value="<?php echo $row_listabancos['data_pagar'];?>" required>
											</div>
										</div>
										</div>
                                        <div class="row form-group">
                                            
                                            <div class="col">
                                                <div class="form-group exibetipopessoapf">
                                                    <label for="status" class="form-control-label">Status</label>
												<select name="status_pagar" class="form-control">
													<option value="1">Pendente</option>
													<option value="2">Pago</option>
												</select>
											
                                                </div>
												
                                            </div>
											<div class="col">
                                                <div class="form-group">
                                                    <label for="valor_pagar" class=" form-control-label">Valor</label>
													<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">R$</div>
													</div>
													<input type="text" name="valor_pagar" id="valor_pagar" value="<?php echo $row_listabancos['valor_pagar'];?>" class="form-control" required data-toggle="tooltip" data-placement="top" title="Este valor será debitado da conta de origem escolhida.">
													</div>
                                                    
                                                </div>
												
                                            </div>
                                        </div>
										
										
										<input type="hidden" name="por" value="<?= $_SESSION['nome'] ?>">
										<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
										
										
										<div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
                                        
                                    </div>
                                </div>
                            </div>
							</form>
							
							<!-- Start Formulário para inserir bancos -->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Adicionar Banco</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  <div class="alert alert-warning" role="alert">
										  <strong>Atenção!</strong> Ao adicionar um banco todas as alterações do formulário de cadastro de contas bancárias serão apagadas.
									  </div>
										<form method="post" action="proc_cd_lista_bancos.php" enctype="multipart/form-data">
										  <div class="form-group">
											<label for="recipient-name" class="col-form-label">Nome do Banco:</label>
											<input type="text" class="form-control" id="nomebanco" name="nomebanco" placeholder="Ex.: Itaú">
										  </div>
										  <div class="form-group">
											<label for="message-text" class="col-form-label">Logotipo do Banco:</label>
											<input type="file" class="form-control" id="logobanco" name="logobanco">
										  </div>
										
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
										<button type="submit" class="btn btn-primary">Adicionar</button>
									  </div>
									  </form>
									</div>
								  </div>
								</div>
							<!-- End Formulário para inserir bancos -->
							
							<!-- Start Formulário para inserir tipos de contas -->
								<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Adicionar Tipo de Conta</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  <div class="alert alert-warning" role="alert">
										  <strong>Atenção!</strong> Ao adicionar um tipo de conta todas as alterações do formulário de cadastro de contas bancárias serão apagadas.
									  </div>
										<form method="post" action="proc_cd_lista_tipo_conta.php">
										  <div class="form-group">
											<label for="recipient-name" class="col-form-label">Nome do Tipo de Conta:</label>
											<input type="text" class="form-control" id="nometipobanco" name="nometipobanco" placeholder="Ex.: Corrente">
										  </div>
										 
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
										<button type="submit" class="btn btn-primary">Adicionar</button>
										</form>
									  </div>
									</div>
								  </div>
								</div>
							<!-- End Formulário para inserir tipos de contas  -->
							
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