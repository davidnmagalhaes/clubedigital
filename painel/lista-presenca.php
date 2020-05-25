<?php
$page = 6;
$idpauta = $_GET['id_pauta'];

include('config-header.php');

//Seleciona todos os sócios
$qr = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY nome_socio ASC";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis);

//Pega pauta
$query = "SELECT * FROM rfa_pauta WHERE cod_pauta='$idpauta' AND clube='$clube'";
$verpauta = mysqli_query($link, $query) or die(mysqli_error($link));
$row_verpauta = mysqli_fetch_assoc($verpauta);
$idreuniao = $row_verpauta['ref_reuniao'];

//Pega reuião
$qreu = "SELECT * FROM rfa_reuniao WHERE id_reuniao='$idreuniao' AND clube='$clube'";
$verreu = mysqli_query($link, $qreu) or die(mysqli_error($link));
$row_verreu = mysqli_fetch_assoc($verreu);


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

$s = "SELECT * FROM rfa_tipo_cob WHERE clube='$clube'";
$tipocob = mysqli_query($link, $s) or die(mysqli_error($link));
$row_tipocob = mysqli_fetch_assoc($tipocob);
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

@media print{
    .show-print{
        display:block !important;
    }
    .hide-check:after{
        border: solid #fff !important;
    }
}
.hide-print{
    display:none;
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
                                    
										
									
									<form action="proc_lista_presenca.php" method="post" runat="server" id="pres" onsubmit="ShowLoading()">
									<h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-balance-wallet"></i>Lista de Presença - <strong><?php echo $row_verreu['nome_reuniao'];?></strong> - <?php echo date('d/m/Y',strtotime($row_verreu['data_reuniao']));?> às <?php echo date('H:i',strtotime($row_verpauta['inicio_reuniao'])); ?><br><button type="submit" class="btn btn-success no-print" style="margin-top: 15px"><i class="fas fa-save"></i> SALVAR</button> <button type="button" class="btn btn-info no-print" onclick="window.print()" style="margin-top: 15px; margin-left: 5px "><i class="fas fa-print"></i> IMPRIMIR</button>
									</h3>

											
									<input type="hidden" name="idpauta" value="<?php echo $idpauta;?>">	
									<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
									
                                    
                                    <div class="table-responsive " style="padding: 30px;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" onClick="toggle(this)" id="select-all">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="show-print hide-print">&nbsp;</td>
                                                    <td>Sócio</td>
													<td align="center" class="show-print hide-print">Assinatura</td>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											
											<?php if($totalRows_lis <= 0){}else{?>
											<?php $count = 0; while($row_lis = mysqli_fetch_array($lis)){ ?>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                        	<?php 
                                                        		$soc = $row_lis['id_socio'];
                                                        		$sqs = "SELECT * FROM rfa_presenca WHERE id_pauta='$idpauta' AND clube='$clube' AND id_socio='$soc'";
																$status = mysqli_query($link, $sqs) or die(mysqli_error($link));
																$row_status = mysqli_fetch_array($status);
                                                        	?>
                                                            <input type="checkbox" name="checksocios[]" id="<?php echo $row_lis['id_socio'];?>" value="<?php if($row_status['status_presenca'] == 1){echo "1";}else{echo "2";}?>" <?php if($row_status['status_presenca'] == 1){echo "checked";};?> onclick="alteraValor(this)">
                                                           	<input type="hidden" name="check[]" id="check<?php echo $row_lis['id_socio'];?>" value="<?php if($row_status['status_presenca'] == 1){echo "1";}else{echo "2";}?>">
                                                            <input type="hidden" name="idsocio[]" value="<?php echo $row_lis['id_socio'];?>">
                                                            <span class="au-checkmark hide-check"></span>
                                                        </label>
                                                    </td>
                                                    <td class="show-print hide-print">
                                                        <?php echo $count += 1; ?>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?php echo $row_lis['nome_socio'];?></h6>
                                                            
                                                        </div>
                                                    </td>
                                                    <td style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
													
                                                </tr>
												
												

											<?php } ?>

                                            

											<?php } ?>
                                            </tbody>
                                        </table>

                                        <table class="table">
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="border-bottom: 1px solid #000;" class="show-print hide-print">&nbsp;</td>
                                            </tr>
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
    	function alteraValor(obj){
    		var idsoc = obj.id;
    		var id = "check"+idsoc;
    		if(obj.checked){
    			obj.value = 1;
    			document.getElementById(id).value = 1;
    		}
    		else{
    			obj.value = 2;
    			document.getElementById(id).value = 2;
    		}
    	}

    	
    	
    </script>

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