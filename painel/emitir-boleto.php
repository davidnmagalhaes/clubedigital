<?php 
//Conexão com banco de dados
include_once("config.php");

session_start();

if(!isset($_SESSION['logado']) || $_SESSION['funcao'] != 1 && $_SESSION['funcao'] != 3):
	header("Location: index.php");
endif;

$user = $_SESSION['id_usuario'];

$sql = "SELECT * FROM rfa_usuario WHERE id_usuario='$user'";
$paghiper = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_paghiper = mysqli_fetch_assoc($paghiper);

$sq = "SELECT * FROM rfs_socios WHERE user='$user' ORDER BY nome_socio ASC";
$socios = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_socios = mysqli_fetch_assoc($socios);

$s = "SELECT * FROM rfa_tipo_cob WHERE user='$user'";
$tipocob = mysqli_query($link, $s) or die(mysqli_error($link));
$row_tipocob = mysqli_fetch_assoc($tipocob);

$qr = "SELECT * FROM rfa_tipo_cob WHERE user='$user'";
$tipocob2 = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_tipocob2 = mysqli_fetch_assoc($tipocob2);

$numeroboleto = rand();

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
    <title>Emitir Boleto - Rotary Fortaleza Alagadiço</title>

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
			
							
							<form method="post" action="paghiper.php" name="form-contabancaria">
			
			<div class="row">
				<div class="col">
					<img src="images/logo-paghiper.png" style="margin-left: 20px"/>
			<?php if(empty($row_paghiper['paghiper_appkey']) || empty($row_paghiper['paghiper_token'])){?>
					<div class="alert alert-danger" role="alert" style="margin: 10px 16px">
							<p>
							<strong>Atenção:</strong><br>
							Para emitir boletos é necessário que antes faça a integração <a href="integracao.php">clicando aqui</a>...
							</p>
					</div>
			<?php }else{} ?>
				</div>
			</div>
			
			<div class="row" style="margin: 0 3px">
				<div class="col">
					<div class="alert alert-primary" role="alert">
					 <strong> Número do boleto:</strong> # <?php echo $numeroboleto;?>
					</div>
				</div>
			</div>
			
			<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 0px 15px 20px 15px;">
  <strong>Atenção: </strong> Não utilize esta modalidade para emitir boletos de mensalidades. Utilize apenas para emissão de boletos avulsos, por exemplo, cobranças diversas, segunda via de mensalidades cujo boleto foi cancelado por falta de pagamento, etc. Para emitir boletos de mensalidades <a href="socios.php">clique aqui</a>... 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
			
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Emissão de Boletos</strong>
                                        <small>PagHiper</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
										<input type="hidden" name="user" value="<?php echo $_SESSION['id_usuario'];?>">	
										<input type="hidden" name="numeroboleto" value="<?php echo $numeroboleto;?>"/>
										
										<div class="row">
										<div class="col-12 col-md-12">
											<div class="form-group">
												<label for="nome" class=" form-control-label">Nome:</label>
											<select name="nome" class="form-control">
											<option value="">Selecione o sócio</option>
											<?php do{?>
												<option value="<?php echo $row_socios['id_socio'];?>"><?php echo $row_socios['nome_socio'];?></option>
											<?php }while($row_socios = mysqli_fetch_assoc($socios));?>
												
											</select>
											</div>
										</div>
										
							
										</div>
										
										
										
										
										
										
										
                                        
                                    </div>
									<div>
                                                
                                         </div>
                                </div>
                            </div>
							
							<div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Informações do Boleto</strong>
                                        <small>PagHiper</small> 
                                    </div>
                                    <div class="card-body card-block">
                                        
											
									<div class="row">
										<div class="col">
										<label for="vencimento" class=" form-control-label">Tipo de cobrança: <a href="#" data-toggle="modal" data-target="#exampleModal" class="badge badge-primary">Adicionar</a> <a href="#" data-toggle="modal" data-target="#exampleModal2" class="badge badge-danger">Editar</a></label>
											<select name="tipo-cobranca" class="form-control">
											<option value="">Selecione o tipo de cobrança</option>
											<?php do{?>
												<option value="<?php echo $row_tipocob['id_cob'];?>" ><?php echo $row_tipocob['descricao_cob'];?></option>
											<?php }while($row_tipocob = mysqli_fetch_assoc($tipocob));?>
												
											</select>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="vencimento" class=" form-control-label">Vencimento do Boleto:</label>
												<input type="date" name="vencimento" class="form-control" required />
											
											</div>
										</div>
									</div>
										

                                    </div>
									<div>
                                                
                                         </div>
                                </div>
                            </div>
							
							
							
							<button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Emitir</span>
                                                    <span id="payment-button-sending" style="display:none;">Enviando…</span>
                                                </button>
							</form>
							
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form action="proc_cd_tipo_cob.php" method="post">
  <input type="hidden" name="user" value="<?php echo $_SESSION['id_usuario'];?>">	
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar tipo de cobrança</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao" class=" form-control-label">Descrição:</label>
												<input type="text" name="descricao" id="descricao" class="form-control" required placeholder="Digite a descrição. Max 200 caractéres">
											
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="email" class=" form-control-label">Tipo de Boleto:</label>
												<select name="tipoboleto" class="form-control">
													<option value="boletoCarne">Carnê</option>
													<option value="boletoA4">A4</option>
												</select>
											
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="email" class=" form-control-label">Aceitar pagamento até:</label>
												<select name="pagamentoate" class="form-control">
													<option value="0">Nenhum</option>
													<option value="5">5 dias após vencimento</option>
													<option value="10">10 dias após vencimento</option>
													<option value="15">15 dias após vencimento</option>
													<option value="20">20 dias após vencimento</option>
													<option value="25">25 dias após vencimento</option>
													<option value="30">30 dias após vencimento</option>
												</select>
											
											</div>
										</div>
							
										</div>
										
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="parcelas" class="form-control-label">Número de parcelas:</label>
												<select name="parcelas" class="form-control">
													<option value="1">1 parcela</option>
													<option value="2">2 parcelas</option>
													<option value="3">3 parcelas</option>
													<option value="4">4 parcelas</option>
													<option value="5">5 parcelas</option>
													<option value="6">6 parcelas</option>
													<option value="7">7 parcelas</option>
													<option value="8">8 parcelas</option>
													<option value="9">9 parcelas</option>
													<option value="10">10 parcelas</option>
													<option value="11">11 parcelas</option>
													<option value="12">12 parcelas</option>
												</select>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<label for="form-control-label">Valor da parcela:</label>
										  <div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">R$</div>
											</div>
											<input type="text" class="form-control" name="valor" placeholder="">
										  </div>
										</div>
										
										<div class="col-12 col-md-4">
											<label for="form-control-label">Desconto até o vencimento:</label>
										  <div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">%</div>
											</div>
											<input type="text" class="form-control" name="desconto" placeholder="">
										  </div>
										</div>
							
										</div>
										
										
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="multa" class="form-control-label">Aplicar multa:</label>
												<select name="multa" class="form-control">
													<option value="0">Não</option>
													<option value="1">1%</option>
													<option value="2">2% (Limite máximo de acordo com o artigo 52 do CDC)</option>
													
												</select>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="juros" class=" form-control-label">Aplicar juros:</label>
												<select name="juros" class="form-control">
													<option value="0">Não</option>
													<option value="true">1% de juros máximo ao mês</option>
													
													
												</select>
											
											</div>
										</div>
										
							
										</div>
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
	</form>
  </div>
</div>
							


<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form action="proc_cd_tipo_cob.php" method="post">
  <input type="hidden" name="user" value="<?php echo $_SESSION['id_usuario'];?>">	
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tipos de cobranças</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		
		<div class="row">
			<div class="col">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<th>Cobrança</th>
							<th></th>
							<th></th>
						</thead>
						<tbody>
						<?php do{ ?>
							<tr>
								<td><?php echo $row_tipocob2['descricao_cob'];?></td>
								<td><a href="edt-tipo-cob.php?id_cob=<?php echo $row_tipocob2['id_cob'];?>"><i class="fas fa-pencil-alt"></i></a></td>
								<td><a href="exc-tipo-cob.php?id_cob=<?php echo $row_tipocob2['id_cob'];?>"><i class="fas fa-trash-alt"></i></a></td>
							</tr>
						<?php }while($row_tipocob2 = mysqli_fetch_assoc($tipocob2));?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Atualizar</button>
      </div>
    </div>
	</form>
  </div>
</div>


							
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