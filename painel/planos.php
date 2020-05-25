<?php 
$page = 10;

include('config-header.php');

//Seleciona todas as contas bancárias
$sql = "SELECT * FROM rfa_planos";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);

$sqsand = "SELECT * FROM rfa_config_pagseguro";
$listasand = mysqli_query($link, $sqsand) or die(mysqli_error($link));
$row_listasand = mysqli_fetch_assoc($listasand);
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
    <title>Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
            <div class="col-lg-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-balance-wallet"></i>Planos
										<a class="btn btn-success" href="cd_planos.php" role="button">Adicionar</a></h3>
                                    <div class="filters m-b-45">
                                        
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <select class="js-select2 au-select-dark" name="time">
                                                <option selected="selected">Todos</option>
                                                <option value="">Ativo</option>
                                                <option value="">Inativo</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>Plano</td>
													<td>Valor/mês</td>
                                                    <td>URL de Assinatura</td>
													<td>Excluir</td>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php do {?>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            
                                                            <span>
                                                                <strong><?php echo $row_listabancos['nome_plano'];?></strong>
                                                            </span>
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="table-data__info">
                                                           
                                                            <span>
                                                                <strong>R$ <?php echo number_format($row_listabancos['valor_plano'],2,',','.');?></strong>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                      <a href="https://<?php if($row_listasand['sandbox_pagseguro'] == 1){echo "sandbox.";}?>pagseguro.uol.com.br/v2/checkout/payment.html?code=<?php echo $row_listabancos['cod_plano'];?>" target="_blank">
                                                            <i class="fas fa-link"></i>
                                                        </a>
													                           </td>
                                                    
                                                    <td>
                                                        <a href="pagseguro_assinatura/vendor/clubedigital/php-pagseguro/funcoes/assinatura/cancelando.php?codplan=<?php echo $row_listabancos['cod_plano'];?>">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </td>
                                                </tr>
												
												
											<?php }while($row_listabancos = mysqli_fetch_assoc($listabancos));?>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="user-data__footer">
                                        <button class="au-btn au-btn-load">Ver mais</button>
                                    </div>
                                </div>
                                <!-- END USER DATA-->
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