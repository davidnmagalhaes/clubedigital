<?php 
$page = 5;

include('config-header.php');
$idcob = $_GET['idcob'];

$sql = "SELECT * FROM rfa_tipo_cob WHERE clube='$clube'";
$tipocob = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_tipocob = mysqli_fetch_assoc($tipocob);

$sq = "SELECT * FROM rfa_tipo_cob WHERE clube='$clube' AND id_cob='$idcob'";
$tipocb = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_tipocb = mysqli_fetch_assoc($tipocb);

$scambio = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$cmb = mysqli_query($link, $scambio) or die(mysqli_error($link));
$row_cmb = mysqli_fetch_assoc($cmb);

$scamb = "SELECT * FROM rfa_config_cambio WHERE id_cambio='1'";
$camb = mysqli_query($link, $scamb) or die(mysqli_error($link));
$row_camb = mysqli_fetch_assoc($camb);

$cambio = $row_camb['valor_cambio'];

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
    <title>Editar Tipo de Cobrança - Rotary Fortaleza Alagadiço</title>

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
			
							
							
			
			
			
			
			
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Lista de Cobranças</strong>
                                        <small>PagHiper</small>
                                    </div>
                                    <div class="card-body card-block">
									
									<div class="row">
										<div class="col">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<th style="text-align:center;">Cobrança</th>
														<th style="text-align:center;">Editar</th>
														<th style="text-align:center;">Excluir</th>
													</thead>
													<tbody>
													<?php do{ ?>
														<tr>
															<td style="text-align:center;"><?php echo $row_tipocob['descricao_cob'];?></td>
															<td style="text-align:center;"><a href="edt-tipo-cob.php?idcob=<?php echo $row_tipocob['id_cob'];?><?php if($_GET['clube']){echo '&clube='.$clube;}?>"><i class="fas fa-arrow-right"></i></a></td>
															<td style="text-align:center;"><?php if($row_tipocob['descricao_cob'] == "Mensalidade"){}else{?><a href=""><i class="fas fa-trash-alt"></i></a><?php }?></td>
														</tr>
													<?php }while($row_tipocob = mysqli_fetch_assoc($tipocob));?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
                                        
										
		
										
										
										
										
                                        
                                    </div>
									<div>
                                                
                                         </div>
                                </div>
                            </div>
						<form method="post" action="proc-edt-tipo-cob.php" name="form-contabancaria">	
							
							<input type="hidden" name="id_cob" value="<?php echo $row_tipocb['id_cob'];?>">	
			<input type="hidden" name="user" value="<?php echo $_SESSION['id_usuario'];?>">	
						<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">	
						<?php if(empty($idcob)){}else{?>
							  <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Editar Cobranças</strong>
                                        <small>PagHiper</small>
                                    </div>
                                    <div class="card-body card-block">
							
                                    	<div class="row">
					                      <div class="col">
					                        <div class="alert alert-primary" role="alert">
					                          Deseja que esta cobrança tenha conversão de <strong>DÓLAR(U$)</strong> para <strong>REAL(R$)</strong>?<br>
					                          <div class="form-check">
					                          <input class="form-check-input" type="radio" name="converter" id="converter1" onchange="trocaMoeda();" value="0" <?php if($row_tipocb['converter'] == 0){echo "checked";}?>>
					                          <label class="form-check-label" for="exampleRadios1">
					                            <strong>Não</strong>, continuar em real sem a conversão.
					                          </label>
					                        </div>
					                        <div class="form-check">
					                          <input class="form-check-input" type="radio" name="converter" id="converter2" onchange="trocaMoeda();" value="1" <?php if($row_tipocb['converter'] == 1){echo "checked";}?>>
					                          <label class="form-check-label" for="exampleRadios2">
					                            <strong>Sim</strong>, converter em real com base no <span style="text-decoration: underline;" data-toggle="tooltip"  title="Câmbio atual de R$ <?php echo number_format($cambio,2,',','.'); ?>">câmbio</span>.
					                          </label>
					                        </div>

					                        </div>
					                      </div>
					                    </div>

							<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao" class=" form-control-label">Descrição:</label>
												<input type="text" name="descricao" id="descricao" <?php if($row_tipocb['descricao_cob'] == "Mensalidade"){echo "readonly";}?> class="form-control" required value="<?php echo $row_tipocb['descricao_cob'];?>">
											
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="email" class=" form-control-label">Tipo de Boleto:</label>
												<select name="tipoboleto" class="form-control">
												<?php if($row_tipocb['tipoboleto_cob'] == 'boletoCarne'){?>
													<option value="boletoCarne" selected>Carnê</option>
													<option value="boletoA4">A4</option>
												<?php }else{?>
													<option value="boletoCarne">Carnê</option>
													<option value="boletoA4" selected>A4</option>
												<?php } ?>
												</select>
											
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="email" class=" form-control-label">Aceitar pagamento até:</label>
												<select name="pagamentoate" class="form-control">
												<?php if($row_tipocb['pagamentoate_cob'] == '0'){?>
													<option value="0" selected>Nenhum</option>
													<option value="5">5 dias após vencimento</option>
													<option value="10">10 dias após vencimento</option>
													<option value="15">15 dias após vencimento</option>
													<option value="20">20 dias após vencimento</option>
													<option value="25">25 dias após vencimento</option>
													<option value="30">30 dias após vencimento</option>
												<?php }elseif($row_tipocb['pagamentoate_cob'] == '5'){ ?>
													<option value="0" >Nenhum</option>
													<option value="5" selected>5 dias após vencimento</option>
													<option value="10">10 dias após vencimento</option>
													<option value="15">15 dias após vencimento</option>
													<option value="20">20 dias após vencimento</option>
													<option value="25">25 dias após vencimento</option>
													<option value="30">30 dias após vencimento</option>
												<?php }elseif($row_tipocb['pagamentoate_cob'] == '10'){ ?>
													<option value="0" >Nenhum</option>
													<option value="5" >5 dias após vencimento</option>
													<option value="10" selected>10 dias após vencimento</option>
													<option value="15">15 dias após vencimento</option>
													<option value="20">20 dias após vencimento</option>
													<option value="25">25 dias após vencimento</option>
													<option value="30">30 dias após vencimento</option>
												<?php }elseif($row_tipocb['pagamentoate_cob'] == '15'){ ?>
													<option value="0" >Nenhum</option>
													<option value="5" >5 dias após vencimento</option>
													<option value="10" >10 dias após vencimento</option>
													<option value="15" selected>15 dias após vencimento</option>
													<option value="20">20 dias após vencimento</option>
													<option value="25">25 dias após vencimento</option>
													<option value="30">30 dias após vencimento</option>
												<?php }elseif($row_tipocb['pagamentoate_cob'] == '20'){?>
													<option value="0" >Nenhum</option>
													<option value="5" >5 dias após vencimento</option>
													<option value="10" >10 dias após vencimento</option>
													<option value="15" >15 dias após vencimento</option>
													<option value="20" selected>20 dias após vencimento</option>
													<option value="25">25 dias após vencimento</option>
													<option value="30">30 dias após vencimento</option>
												<?php }elseif($row_tipocb['pagamentoate_cob'] == '25'){?>
													<option value="0" >Nenhum</option>
													<option value="5" >5 dias após vencimento</option>
													<option value="10" >10 dias após vencimento</option>
													<option value="15" >15 dias após vencimento</option>
													<option value="20" >20 dias após vencimento</option>
													<option value="25" selected>25 dias após vencimento</option>
													<option value="30">30 dias após vencimento</option>
												<?php }else{?>
													<option value="0" >Nenhum</option>
													<option value="5" >5 dias após vencimento</option>
													<option value="10" >10 dias após vencimento</option>
													<option value="15" >15 dias após vencimento</option>
													<option value="20" >20 dias após vencimento</option>
													<option value="25" >25 dias após vencimento</option>
													<option value="30" selected>30 dias após vencimento</option>
												<?php }?>
												</select>
											
											</div>
										</div>
							
										</div>
										
										<div class="row">
										<div <?php if($row_tipocb['descricao_cob'] == "Mensalidade"){echo "class='col-12 col-md-6'";}else{echo "class='col-12 col-md-4'";}?>>
											<div class="form-group">
												<label for="parcelas" class="form-control-label">Número de parcelas:</label>
												<select name="parcelas" class="form-control" <?php if($row_tipocb['descricao_cob'] == "Mensalidade"){echo "readonly";}?>>
												<?php if($row_tipocb['parcelas_cob'] == '1'){?>
													<option value="1" selected>1 parcela</option>
													
													<?php for($i = 2; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>

												<?php }elseif($row_tipocb['parcelas_cob'] == '2'){ ?>
													<?php for($i = 1; $i < 2; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="2" selected>2 parcelas</option>
													<?php for($i = 3; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '3'){ ?>
													<?php for($i = 1; $i < 3; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="3" selected>3 parcelas</option>
													<?php for($i = 4; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '4'){ ?>
													<?php for($i = 1; $i < 4; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="4" selected>4 parcelas</option>
													<?php for($i = 5; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '5'){?>
													<?php for($i = 1; $i < 5; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="5" selected>5 parcelas</option>
													<?php for($i = 6; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '6'){ ?>
													<?php for($i = 1; $i < 6; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="6" selected>6 parcelas</option>
													<?php for($i = 7; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '7'){?>
													<?php for($i = 1; $i < 7; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="7" selected>7 parcelas</option>
													<?php for($i = 8; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '8'){?>
													<?php for($i = 1; $i < 8; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="8" selected>8 parcelas</option>
													<?php for($i = 9; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '9'){?>
													<?php for($i = 1; $i < 9; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="9" selected>9 parcelas</option>
													<?php for($i = 10; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '10'){?>
													<?php for($i = 1; $i < 10; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="10" selected>10 parcelas</option>
													<?php for($i = 11; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }elseif($row_tipocb['parcelas_cob'] == '11'){?>
													<?php for($i = 1; $i < 11; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="11" selected>11 parcelas</option>
													<?php for($i = 12; $i < 13; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
												<?php }else{?>
													<?php for($i = 1; $i < 12; $i++){
														echo "<option value=".$i.">".$i." parcelas</option>";
														
													}?>
													<option value="12" selected>12 parcelas</option>
													
												<?php } ?>
												</select>
											</div>
										</div>
										
										<?php if($row_tipocb['descricao_cob'] == "Mensalidade"){}else{?>
										<div class="col-12 col-md-4">
											<label for="form-control-label">Valor da parcela:</label>
										  <div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text"><input type="text" id="md" value="<?php if($row_tipocb['converter'] == 1){echo "U$";}else{echo "R$";};?>" style="width: 30px; background: none;"></div>
											</div>
											<input type="text" class="form-control" name="valor" value="<?php echo number_format($row_tipocb['valor_cob'],2,',','.');?>">
										  </div>
										</div>
										<?php }?>
										<div <?php if($row_tipocb['descricao_cob'] == "Mensalidade"){echo "class='col-12 col-md-6'";}else{echo "class='col-12 col-md-4'";}?>>
											<label for="form-control-label">Desconto até o vencimento:</label>
										  <div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">%</div>
											</div>
											<input type="text" class="form-control" name="desconto" value="<?php echo $row_tipocb['desconto_cob'];?>">
										  </div>
										</div>
							
										</div>
										
										
										<div class="row">
										<div <?php if($row_tipocb['descricao_cob'] == "Mensalidade"){echo "class='col-12 col-md-6'";}else{echo "class='col-12 col-md-6'";}?>>
											<div class="form-group">
												<label for="multa" class="form-control-label">Aplicar multa:</label>
												<select name="multa" class="form-control">
												<?php if($row_tipocb['multa_cob'] == 0){?>
													<option value="0" selected>Não</option>
													<option value="1">1%</option>
													<option value="2">2% (Limite máximo de acordo com o artigo 52 do CDC)</option>
												<?php }elseif($row_tipocb['multa_cob'] == 1){?>
													<option value="0">Não</option>
													<option value="1" selected>1%</option>
													<option value="2">2% (Limite máximo de acordo com o artigo 52 do CDC)</option>
												<?php }else{?>
													<option value="0">Não</option>
													<option value="1" >1%</option>
													<option value="2" selected>2% (Limite máximo de acordo com o artigo 52 do CDC)</option>
												<?php }?>
												</select>
											</div>
										</div>
										<div <?php if($row_tipocb['descricao_cob'] == "Mensalidade"){echo "class='col-12 col-md-6'";}else{echo "class='col-12 col-md-6'";}?>>
											<div class="form-group">
												<label for="juros" class=" form-control-label">Aplicar juros:</label>
												<select name="juros" class="form-control">
												<?php if($row_tipocb['juros_cob'] == "0"){?>
													<option value="0" selected>Não</option>
													<option value="true">1% de juros máximo ao mês</option>
												<?php }else{?>
													<option value="0">Não</option>
													<option value="true" selected>1% de juros máximo ao mês</option>
												<?php }?>
													
												</select>
											
											</div>
										</div>
										
							
										</div>

										
										
										
										
							   </div>
									<div>
                                                
                                         </div>
                                </div>
                            </div>
							
							
							<button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Atualizar</span>
                                                    <span id="payment-button-sending" style="display:none;">Enviando…</span>
                                                </button>
                                            <?php }?>
							</form>
							
							
							




							
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	<!-- Start Script para trocar tipo de pessoa -->
	<script>
  function trocaMoeda(){
      var naoconverte = document.querySelector("#converter1");
      var converte = document.querySelector("#converter2");
      var moeda = document.querySelector("#md");
      var valor = document.querySelector("#valor");
      if(converte.checked){
        moeda.value = "U$";
        valor.placeholder = "Em dólar"
      }else{
        moeda.value = "R$";
        valor.placeholder = "Em real"
      }
  }

</script>
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