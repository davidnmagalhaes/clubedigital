<?php
$page = 6;

include('config-header.php');

//Seleciona as pautas
$qrh = "SELECT * FROM rfa_pauta INNER JOIN rfa_reuniao ON rfa_pauta.ref_reuniao = rfa_reuniao.id_reuniao WHERE rfa_pauta.clube='$clube' ORDER BY rfa_pauta.id_pauta DESC";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);

$query= "SELECT * FROM rfs_socios WHERE clube='$clube'";
$versocios = mysqli_query($link, $query) or die(mysqli_error($link));
$row_versocios = mysqli_fetch_assoc($versocios);
$totalRows_versocios = mysqli_num_rows($versocios);



$hoje = date('Y-m-d');
$semana = date('Y-m-d', strtotime($hoje. ' + 7 days'));
$mes = date('Y-m-d', strtotime($hoje. ' + 1 month'));

if($_GET['hoje'] == "hoje"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.id_conta WHERE rfa_pagar.data_pagar='$hoje' AND rfa_pagar.user='$user'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "semana"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.id_conta WHERE rfa_pagar.data_pagar<'$semana' AND rfa_pagar.user='$user'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "mes"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.id_conta WHERE rfa_pagar.data_pagar<'$mes' AND rfa_pagar.user='$user'";
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

<!--Pergunta antes de ação-->
	<script language="JavaScript" type="text/javascript">

$(document).ready(function(){
    $(".remove").click(function(e){
        if(!confirm('Tem certeza que deseja emitir boleto(s)?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

<script language="JavaScript" type="text/javascript">

$(document).ready(function(){
    $("a.exclui").click(function(e){
        if(!confirm('Tem certeza que deseja excluir este socio(a)?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
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
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>

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
                                    
										
									
									<form action="emite-mens-socios-mes.php" method="post" runat="server"  onsubmit="ShowLoading()">
									<h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-assignment"></i>Pautas
									<a href="cd_pauta.php" role="button" class="btn btn-success">
                                            <i class="fas fa-plus"></i> Pauta</a>									
									 </h3>
										
<br>
<!--<div class="row">
<div class="col">
<div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border" style="margin-left: 35px">
                                            <select class="js-select2" name="mes" data-toggle="tooltip" title="Selecione o mês que deseja emitir todos os boletos dos sócios selecionados">
                                                <option value="" selected="selected">Mês</option>
                                                <option value="1">Janeiro</option>
                                                <option value="2">Fevereiro</option>
												<option value="3">Março</option>
												<option value="4">Abril</option>
												<option value="5">Maio</option>
												<option value="6">Junho</option>
												<option value="7">Julho</option>
												<option value="8">Agosto</option>
												<option value="9">Setembro</option>
												<option value="10">Outubro</option>
												<option value="11">Novembro</option>
												<option value="12">Dezembro</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
										
										
										
	
	
	

	
										<div  style="margin-left: 15px">
                                        </div>
</div>
</div>-->
											
									<input type="hidden" name="user" value="<?php echo $_SESSION['id_usuario'];?>">	
									<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
									
                                    <!--<div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">Todos</option>
                                                <option value="">Itaú</option>
                                                <option value="">Bradesco</option>
												<option value="">Banco do Brasil</option>
												<option value="">Santander</option>
												<option value="">Caixa</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <select class="js-select2 au-select-dark" name="time">
                                                <option selected="selected">Todos</option>
                                                <option value="">Corrente</option>
                                                <option value="">Poupança</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>-->
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" onClick="toggle(this)" id="select-all">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td align="center">Reunião</td>
													<td align="center">Data</td>
													
                                                    
													
													
                                                    <td align="center">Pauta</td>
                                                    <td align="center">Companheirismo</td>
                                                    <td align="center">Recuperante</td>
                                                    <td align="center">Pré-Ata</td>
                                                    <td align="center">Presença</td>
                                                    <td align="center">Pós-Ata</td>
                                                    <td align="center">Recuperar</td>
                                                    <td align="center">Editar</td>
                                                    <td align="center">Excluir</td>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if($totalRows_lish <= 0){echo "<tr><td colspan='12' align='center'>Você ainda não cadastrou pautas de reuniões!</td></tr>";}else{?>
											<?php while($row_lish = mysqli_fetch_array($lish)){ ?>
                                                <tr>
                                                    <td align="center" style="vertical-align:middle;">
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" name="checksocios[]" value="<?php echo $row_lish['doc_pauta'];?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td align="center" style="vertical-align:middle;">
                                                        <div class="table-data__info">
                                                            <h6><?php echo $row_lish['nome_reuniao'];?></h6>
                                                            
                                                        </div>
                                                    </td>
													<td align="center" style="vertical-align:middle;">
                                                        <div class="table-data__info">
                                                           
                                                            <span class="block-email">
                                                              <?php echo date("d/m/Y",strtotime($row_lish['data_reuniao']));?>
                                                            </span>
                                                        </div>
                                                    </td>
													
                                                    
                                                    
													
													
                                                    
                                                    <td align="center" style="vertical-align:middle; background:#fffedd">
                                                       <a href="mpdf/recibo-pauta-reuniao.php?cod_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" data-toggle="tooltip" data-placement="top" title="Pauta" target="_blank">
                                                            
                                                            <i class="fas fa-folder-open"></i>
                                                        </a>
                                                    </td>
                                                    <td align="center" style="vertical-align:middle; background:#fffedd">
                                                       <a href="mpdf/recibo-companheirismo-reuniao.php?cod_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" data-toggle="tooltip" data-placement="top" title="Comissão de Companheirismo" target="_blank">
                                                            <i class="fas fa-gift"></i>
                                                        </a>
                                                    </td>
                                                    <td align="center" style="vertical-align:middle; background:#fffedd">
                                                       <a href="mpdf/recibo-recuperacao.php?cod_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" data-toggle="tooltip" data-placement="top" title="Recuperação" target="_blank">
                                                            <i class="fas fa-id-card-alt"></i>
                                                        </a>
                                                    </td>
                                                    <td align="center" style="vertical-align:middle; background:#fffedd;">
                                                       <a href="mpdf/recibo-ata-reuniao.php?cod_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" data-toggle="tooltip" data-placement="top" title="Ata Pré-Reunião" target="_blank">
                                                            <i class="zmdi zmdi-assignment"></i>
                                                        </a>
                                                    </td>
                                                    <td align="center" style="vertical-align:middle; background:#ddedff;">
                                                      
                                                      <?php 
                                                            $paut = $row_lish['cod_pauta'];
                                                            $qpres= "SELECT * FROM rfa_presenca WHERE id_pauta='$paut' AND status_presenca='1' AND clube='$clube'";
                                                            $verpres = mysqli_query($link, $qpres) or die(mysqli_error($link));
                                                            $row_verpres= mysqli_fetch_array($verpres);
                                                            $totalRows_verpres = mysqli_num_rows($verpres);

                                                            $calc =  (100 - ((($totalRows_versocios - $totalRows_verpres) / $totalRows_versocios) * 100));
                                                      ?>

                                                        <div class="progress" style="margin-bottom: 0;background:#ddedff;">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated <?php if($calc <= 20){echo "bg-danger";}elseif($calc >= 21 && $calc <= 49){echo "bg-warning";}elseif($calc >= 50 && $calc <= 70){echo "bg-primary";}else{echo "bg-success";}?>" role="progressbar" aria-valuenow="<?php echo $calc; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $calc; ?>%">
                                                                <a href="lista-presenca.php?id_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" data-toggle="tooltip" data-placement="top" title="Ver lista de Presença" target="_blank" style="color:#fff">
                                                                      <?php echo $calc."%"; ?>
                                                                </a>
                                                            </div>
                                                        </div><?php if($calc <= 0){echo '<a href="lista-presenca.php?id_pauta='.$row_lish['cod_pauta'].'&clube='.$clube.'" data-toggle="tooltip" data-placement="top" title="Preencha a lista de presença da reunião"><i class="fas fa-exclamation-circle" style="color:#dc0e0e;"></i></a>';}?>
                                                    </td>
                                                    <td align="center" style="vertical-align:middle;background:#ddedff;">
                                                       <a href="edt_pos_ata.php?cod_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" data-toggle="tooltip" data-placement="top" title="Ata Pós-Reunião" target="_blank">
                                                            <i class="fas fa-file-import"></i>
                                                        </a>
                                                    </td>
                                                    <td align="center" style="vertical-align:middle;background:#ddedff;">
                                                       <a href="emitir-recuperante.php?cod_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" data-toggle="tooltip" data-placement="top" title="Emitir recuperação" target="_blank">
                                                            <i class="fas fa-user-check"></i>
                                                        </a>
                                                    </td>
                                                    <td align="center" style="vertical-align:middle;">
                                                       <a href="edt_pauta.php?id_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" data-toggle="tooltip" data-placement="top" title="Editar Pauta" target="_blank">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                    </td>
                          <td align="center" style="vertical-align:middle;">
                                                       <a href="excluir-pauta.php?id_pauta=<?php echo $row_lish['cod_pauta'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" class="exclui" data-toggle="tooltip" data-placement="top" title="Excluir Pauta" target="_blank">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </td>
													
                                                </tr>
												                        
                                                
												

											<?php }?>
											<?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
									</form>
                                    <!--<div class="user-data__footer">
                                        <button class="au-btn au-btn-load">Ver mais</button>
                                    </div>-->
                                </div>
                                <!-- END USER DATA-->
                            </div>
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>


<script>
// Para selecionar todos os checkboxes dos sócios
		$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
	</script>

<script>


		$('input[name="radios"]').change(function () {
    if ($('input[name="radios"]:checked').val() === "manual") {
       
		 $('.exibedatapagamento').show();
    } else {
        $('.exibedatapagamento').hide();
    }
});
	</script>
	
	

    <?php include("scripts-footer.php"); ?>
	
	

</body>
	<script type="text/javascript">
		SyntaxHighlighter.all()
	</script>
</html>
<!-- end document-->