<?php
$page = 6;

include('config-header.php');

$sql = "SELECT * FROM rfa_reuniao WHERE clube='$clube'";
$reuniao = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_reuniao = mysqli_fetch_assoc($reuniao);
$totalRows_reuniao = mysqli_num_rows($reuniao);

$sq = "SELECT * FROM rfa_local_reuniao WHERE clube='$clube'";
$local = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_local = mysqli_fetch_assoc($local);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestão do Rotary Fortaleza Alagadiço">
    <meta name="author" content="David Magalhães">
    <meta name="keywords" content="rotary alagadiço, rotary fortaleza alagadiço, fortaleza alagadiço">

    <!-- Title Page-->
    <title>Cadastro de Serviços Profissionais - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
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



<script>
function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        // charCode 8 = backspace   
        // charCode 9 = tab
        if (charCode != 8 && charCode != 9) {
            // charCode 48 equivale a 0   
            // charCode 57 equivale a 9
            if (charCode < 48 || charCode > 57) {
                return false;
            }
        }
    }
</script>
	


<script src="moment/moment.js"></script>

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
			<form method="post" action="proc_cd_serv_profissionais.php" id="formsocios" name="form-socios" runat="server"  onsubmit="ShowLoading(); ">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Cadastro</strong>
                                        <small> de Serviços Profissionais</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="classif_socio" class=" form-control-label">Dia</label>
												<select name="dia_profissionais" id="dia_profissionais" class="form-control" required>
													<option>Selecione o dia...</option>
													<?php 
													for($i=1; $i < 32; $i++){
														echo "<option value='".$i."'>".$i."</option>";
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="nome_socio" class=" form-control-label">Mês</label>
												<select name="mes_profissionais" id="mes_profissionais" class="form-control" required>
													<option>Selecione o mês...</option>
													<?php 
													setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
													date_default_timezone_set('America/Sao_Paulo');
													for($i=1; $i < 13; $i++){
														$nomemes = date("Y")."-".$i."-"."01";
														echo "<option value='".$i."'>".strtoupper(strftime('%b',strtotime($nomemes)))."</option>";
													}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">Nome do Serviço</label>
												<input type="text" name="nome_profissionais" id="nome_profissionais" class="form-control">
											</div>
										</div>
										
										
										
										
										</div>
										
                                        
                                    </div>
                                </div>
								
								
									<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
									<input type="hidden" name="club" value="<?php echo $clube; ?>">
								
								<div>
                                                <button id="payment-button" type="submit" onClick="return faz()" class="btn btn-lg btn-success btn-block vld">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
								
                            </div>
							</form>
							
							
							
							
</div>
            

            <?php include("footer.php"); ?>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	

    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->