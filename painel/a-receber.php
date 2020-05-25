<?php
session_start();

if(!isset($_SESSION['logado']) || ($_SESSION['funcao'] != 1 && $_SESSION['funcao'] != 3)):
	header("Location: index.php");
endif;

$user = $_SESSION['id_usuario'];
$clube = $_SESSION['clube'];

//Conexão com banco de dados
include_once("config.php");

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.id_lista_banco WHERE rfa_bancos.clube='$clube' ORDER BY rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco WHERE clube='$clube' ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);

//Seleciona todos os tipos de contas bancárias
$qr = "SELECT * FROM rfa_receber INNER JOIN rfa_bancos ON rfa_receber.destino_receber = rfa_bancos.id_conta WHERE rfa_receber.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);

$hoje = date('Y-m-d');
$semana = date('Y-m-d', strtotime($hoje. ' + 7 days'));
$mes = date('Y-m-d', strtotime($hoje. ' + 1 month'));

if($_GET['hoje'] == "hoje"){
$qr = "SELECT * FROM rfa_receber INNER JOIN rfa_bancos ON rfa_receber.destino_receber = rfa_bancos.id_conta WHERE rfa_receber.data_receber='$hoje' AND rfa_receber.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "semana"){
$qr = "SELECT * FROM rfa_receber INNER JOIN rfa_bancos ON rfa_receber.destino_receber = rfa_bancos.id_conta WHERE rfa_receber.data_receber<'$semana' AND rfa_receber.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "mes"){
$qr = "SELECT * FROM rfa_receber INNER JOIN rfa_bancos ON rfa_receber.destino_receber = rfa_bancos.id_conta WHERE rfa_receber.data_receber<'$mes' AND rfa_receber.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<!--Pergunta antes de ação-->
	<script language="JavaScript" type="text/javascript">

$(document).ready(function(){
    $("a.remove").click(function(e){
        if(!confirm('Tem certeza que deseja excluir esta conta?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

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

    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->

            
 <div class="main-content">
            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">A Receber</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <!--<div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">All Properties</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>-->
                                        <div class="rs-select2--light rs-select2--sm">
										<form method="get" action="">
                                            <select class="js-select2" name="hoje" onChange="this.form.submit()">
											<option value="">Filtar</option>
                                                <option value="hoje">Hoje</option>
                                                <option value="semana">7 dias</option>
                                                <option value="mes">1 mês</option>
                                            </select>
										
                                            <div class="dropDownSelect2"></div>
											</form>
                                        </div>
                                        
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="cd_a_receber.php" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Adicionar</a>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Exportar</option>
                                                <option value="">Opção 1</option>
                                                <option value="">Opção 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
								<?php if($totalRows_lis == 0){echo "<div class='row'><div class='col' style='text-align:center;'>Nenhum resultado encontrado!</div></div>";}else{?>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th>Destino</th>
                                                <th>Por</th>
                                                <th>Descrição</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                                <th>Valor</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php do{ ?>
                                            <tr class="tr-shadow">
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td><?php echo $row_lis['favorecido'];?></strong></td>
                                                <td>
                                                    <span class="block-email"><?php echo $row_lis['por_receber'];?></span>
                                                </td>
                                                <td class="desc"><?php echo $row_lis['descricao_receber'];?></td>
                                                <td><?php echo date("d/m/Y",strtotime($row_lis['data_receber']));?></td>
                                                <td>
                                                    <span class="status--<?php if($row_lis['status_receber'] == 1){echo "denied";}else{echo "process";};?>"><?php if($row_lis['status_receber'] == 1){echo "Pendente";}else{echo "Recebido";};?></span>
                                                </td>
                                                <td>R$ <?php echo number_format($row_lis['valor_receber'], 2, ',', '.');?></td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <!--<button class="item" data-toggle="tooltip" data-placement="top" title="Enviar">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>-->
                                                        <a href="#" class="item" data-toggle="modal" data-target="#Modal<?php echo $row_lis['id_receber'];?>" title="Editar">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                        <a href="excluir-a-receber.php?idreceber=<?php echo $row_lis['id_receber'];?>&clube=<?= $_SESSION['clube'] ?>" class="item remove" data-toggle="tooltip" data-placement="top" title="Deletar">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                        <!--<button class="item" data-toggle="tooltip" data-placement="top" title="Mais">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>-->
                                                    </div>
                                                </td>
                                            </tr>
											
											<div class="modal fade" id="Modal<?php echo $row_lis['id_receber'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog" role="document">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Modificar recebimento</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
													  <span aria-hidden="true">&times;</span>
													</button>
												  </div>
												  <div class="modal-body">
													<form method="post" action="proc_edt_a_receber.php">
													<?php if($row_lis['status_receber'] == 2){echo "<div class='row'><div class='col'>Parabéns! Você já recebeu este valor.</div></div>";}else{?>
													  <div class="form-group">
											<label for="destino" class=" form-control-label">Destino </label>
                                                <select name="destino_receber" id="destino_receber" class="form-control" required>
                                                    <option value="">Selecione uma conta...</option>
                                                    <?php do{?>
													<option value="<?php echo $row_listabancos['id_conta'];?>"><?php echo $row_listabancos['favorecido'];?> <strong>(<?php echo $row_listabancos['nome_lista_banco'];?>)</strong></option>
													<?php }while($row_listabancos = mysqli_fetch_assoc($listabancos));?>
                                                 </select>                                        </div>
										<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Descrição</label>
												<input type="text" name="descricao_receber" id="descricao_receber" value="<?php echo $row_lis['descricao_receber'];?>" placeholder="Ex.: Valor referente ao pagamento de José" class="form-control" required>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Data de Recebimento</label>
												<input type="date" name="data_receber" id="data_receber" class="form-control" value="<?php echo $row_lis['data_receber'];?>" required>
											</div>
										</div>
										</div>
                                        <div class="row form-group">
                                            
                                            <div class="col">
                                                <div class="form-group exibetipopessoapf">
                                                    <label for="status" class="form-control-label">Status</label>
												<select name="status_receber" class="form-control">
													
													<option value="2" selected>Recebido</option>
													
												</select>
											
                                                </div>
												
                                            </div>
											
											<div class="col">
                                                <div class="form-group">
                                                    <label for="valor_receber" class=" form-control-label">Valor</label>
													<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">R$</div>
													</div>
													<input type="text" name="valor_receber" onKeyPress="return(moeda(this,'.',',',event))" id="valor_receber" class="form-control" value="<?php echo number_format($row_lis['valor_receber'],2,',','.');?>" required data-toggle="tooltip" data-placement="top" title="Este valor será creditado na conta de destino escolhida.">
													</div>
                                                    
                                                </div>
												
                                            </div>
											
                                        </div>
										<?php } ?>
										<input type="hidden" name="por" value="<?= $_SESSION['nome'] ?>">
										<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
										<input type="hidden" name="club" value="<?= $_SESSION['clube'] ?>">
										<input type="hidden" name="idreceber" value="<?php echo $row_lis['id_receber']; ?>">
													
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
													<?php if($row_lis['status_receber'] == 2){}else{echo "<button type='submit' class='btn btn-primary'>Continuar...</button>";} ?>
												  </div>
												  </form>
												</div>
											  </div>
											</div>
											
											<tr class="spacer"></tr>
										<?php }while($row_lis = mysqli_fetch_assoc($lis));?>
											
											
                                            
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
								<?php } ?>
                                <!-- END DATA TABLE -->
                            </div>
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->