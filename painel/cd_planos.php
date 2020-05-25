<?php 
session_start();

if(!isset($_SESSION['logado']) || $_SESSION['funcao'] != 1):
	header("Location: index.php");
endif;

//Conexão com banco de dados
include_once("config.php");


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
    <title>Planos - Rotary Fortaleza Alagadiço</title>

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
			<form method="post" action="assinatura/vendor/carloswgama/php-pagseguro/examples/assinatura/criar_plano.php" name="form-planos" runat="server"  onsubmit="ShowLoading()">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Cadastro de Planos</strong>
                                        
                                    </div>
                                    <div class="card-body card-block">
                                        
												 
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Nome do Plano</label>
												<input type="text" name="nomeplano" id="nomeplano" placeholder="Digite o nome do plano" class="form-control" required>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
                                                    <label for="valor_receber" class=" form-control-label">Valor da mensalidade:</label>
													<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">R$</div>
													</div>
													<input type="text" name="valormensalidade" id="valormensalidade" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" required data-toggle="tooltip" data-placement="top" title="Este é o valor da mensalidade referente ao plano adquirido.">
													</div>
                                                    
                                                </div>
										</div>
                                        <div class="col-12 col-md-4">
                                            <label for="valor_receber" class=" form-control-label">Máximo de assinaturas no plano:</label>
                                            <input type="text" class="form-control" name="max_user" onkeypress="return somenteNumeros(event)">
                                        </div>
										</div>
                                        <div class="row">

                                            <div class="col">
                                                <label for="valor_receber" class=" form-control-label">Descrição do Plano:</label>
                                                <textarea class="form-control" name="descricao_plano"></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-12 col-md-4">
                                                <label for="valor_receber" class=" form-control-label">Periodicidade:</label>
                                                <select class="form-control" name="periodicidade">
                                                    <option value="MENSAL">Mensal</option>
                                                    <option value="BIMESTRAL">Bimestral</option>
                                                    <option value="TRIMESTRAL">Trimestral</option>
                                                    <option value="SEMESTRAL">Semestral</option>
                                                    <option value="ANUAL">Anual</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="valor_receber" class=" form-control-label">Período de Expiração:</label>
                                                <input type="text" class="form-control" name="tempo_exp" maxlength="3">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="valor_receber" class=" form-control-label">Modo de expiração:</label>
                                                
                                                <select class="form-control" name="modo_exp">
                                                    <option value="DAYS">Dias</option>
                                                    <option value="MONTHS">Meses</option>
                                                    <option value="YEARS">Anos</option>
                                                    
                                                </select>
                                            </div>
                                            
                                        </div>

                                        
										
										<div style="margin-top: 25px">
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
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
	
	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->