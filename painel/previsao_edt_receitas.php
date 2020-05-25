<?php
$page = 3;

include('config-header.php');

$idreceitas = $_GET['idreceitas'];
$club = $_GET['clube'];

$qr = "SELECT * FROM rfa_prev_receitas WHERE clube='$clube' AND id_prev_receitas='$idreceitas'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);

$sc = "SELECT * FROM rfa_prev_categorias WHERE clube='$clube'";
$vercat = mysqli_query($link, $sc) or die(mysqli_error($link));

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
    <title>Cadastro de Receitas - Rotary Fortaleza Alagadiço</title>

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
			<form method="post" action="previsao_proc_edt_receitas.php" name="form-contabancaria">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Atualização</strong>
                                        <small> Receitas Previstas</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
										<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="descricao_receita" class=" form-control-label">Descrição</label>
												<input type="text" name="descricao_receita" id="descricao_receita" placeholder="Ex.: Valor referente ao pagamento de José" value="<?php echo $row_lis['desc_prev_receitas'];?>" class="form-control" required>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="data_receita" class=" form-control-label">Data de Recebimento</label>
												<input type="date" name="data_receita" id="data_receita" value="<?php echo $row_lis['data_prev_receitas'];?>" class="form-control" required>
											</div>
										</div>
										</div>
                                        <div class="row form-group">
                                            
                                        
											<div class="col">
                                                <div class="form-group">
                                                    <label for="valor_receita" class=" form-control-label">Valor</label>
													<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">R$</div>
													</div>
													<input type="text" name="valor_receita" onKeyPress="return(moeda(this,'.',',',event))" id="valor_receita" class="form-control" value="<?php echo number_format($row_lis['valor_prev_receitas'],2,',','.');?>" required>
													</div>
                                                    
                                                </div>
												
                                            </div>
                                            <div class="col">
                                                <label class=" form-control-label">Categoria</label>
                                                <select class="form-control" name="categoria">
                                                    <?php while($row_vercat = mysqli_fetch_array($vercat)){?>
                                                        <option value="<?php echo $row_vercat['id_categoria']; ?>" <?php if($row_vercat['id_categoria'] == $row_lis['cat_prev_receitas']){echo "selected";}?>><?php echo $row_vercat['nome_categoria'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
										
										
										<input type="hidden" name="idreceitas" value="<?php echo $row_lis['id_prev_receitas'];?>">
										<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
										<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
										
										
										<div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
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