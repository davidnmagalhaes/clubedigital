<?php
$page = 3;

include('config-header.php');
include('verifica-mensalidade.php');

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.cod_lista_banco WHERE rfa_bancos.clube='$clube' ORDER BY rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco WHERE clube='$clube' ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);

//Seleciona todos os tipos de contas bancárias

$qr = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND rfa_mensalidades.pagamento=1 ORDER by rfa_mensalidades.data_pagamento DESC";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);

$hoje = date('Y-m-d');
$semana = date('Y-m-d', strtotime($hoje. ' + 7 days'));
$mes = date('Y-m-d', strtotime($hoje. ' + 1 month'));

if($_GET['hoje'] == "hoje"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.cod_banco WHERE rfa_pagar.data_pagar='$hoje' AND rfa_pagar.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "semana"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.cod_banco WHERE rfa_pagar.data_pagar<'$semana' AND rfa_pagar.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "mes"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.cod_banco WHERE rfa_pagar.data_pagar<'$mes' AND rfa_pagar.clube='$clube'";
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
                                <h3 class="title-5 m-b-35">Mensalidades Pagas</h3>
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
                                   
                                </div>
<?php if($totalRows_lis == 0){echo "<div class='row'><div class='col' style='text-align:center;'>Nenhum resultado encontrado!</div></div>";}else{?>

                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <!--<th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>-->
                                                <th>Sócio</th>
                                                <th>Data de Pagamento</th>
                                                <th>Valor</th>
                                                <th>Taxa</th>
                                                <th>Mês de Vencimento</th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php do{ ?>
										
                                            <tr class="tr-shadow">
                                                <!--<td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>-->
                                                <td><?php echo $row_lis['nome_socio'];?></td>
                                                <td>
                                                    <span class="block-email"><?php echo date('d/m/Y',strtotime($row_lis['data_pagamento']));?></span>
                                                </td>
                                                <td class="desc"><?php echo "R$ ".number_format($row_lis['valor_mensalidade'],2,',','.');?></td>
                                                <td class="desc"><?php echo "R$ ".number_format($row_lis['taxa'],2,',','.');?></td>
                                                <td>
                                                    <span class="block-email"><?php echo date('d/m',strtotime($row_lis['data_mensalidade']));?></span>
                                                </td>
                                                <td>
                                                    <a href="excluir-mensalidade-paga.php?cod_mens=<?php echo $row_lis['cod_mensalidade']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                                
                                            </tr>
											
											
											
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