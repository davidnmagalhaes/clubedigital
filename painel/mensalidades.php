<?php
$page = 5;

include('config-header.php');

$user = $_SESSION['id_usuario'];
$idsoc = $_GET['idsoc'];

//Seleciona todos os tipos de contas bancárias
$qr = "SELECT * FROM rfs_socios WHERE clube='$clube' AND id_socio='$idsoc'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
$idsocio = $row_lis['id_socio'];
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
    <title>Gestão de mensalidades - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->
	
	<script type="text/javascript">
			function fMasc(objeto,mascara) {
				obj=objeto
				masc=mascara
				setTimeout("fMascEx()",1)
			}
			function fMascEx() {
				obj.value=masc(obj.value)
			}
			function mTel(tel) {
				tel=tel.replace(/\D/g,"")
				tel=tel.replace(/^(\d)/,"($1")
				tel=tel.replace(/(.{3})(\d)/,"$1)$2")
				if(tel.length == 9) {
					tel=tel.replace(/(.{1})$/,"-$1")
				} else if (tel.length == 10) {
					tel=tel.replace(/(.{2})$/,"-$1")
				} else if (tel.length == 11) {
					tel=tel.replace(/(.{3})$/,"-$1")
				} else if (tel.length == 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				} else if (tel.length > 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				}
				return tel;
			}
			function mCNPJ(cnpj){
				cnpj=cnpj.replace(/\D/g,"")
				cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
				cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
				cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
				cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
				return cnpj
			}
			function mCPF(cpf){
				cpf=cpf.replace(/\D/g,"")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
				return cpf
			}
			function mCEP(cep){
				cep=cep.replace(/\D/g,"")
				cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
				cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
				return cep
			}
			function mNum(num){
				num=num.replace(/\D/g,"")
				return num
			}
			
			
			
			
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

function valida_cpf(cpf)
{
  cpf = cpf.replace('.','');
  cpf = cpf.replace('-','');
  var numeros, digitos, soma, i, resultado, digitos_iguais;
  digitos_iguais = 1;
  if (cpf.length < 11)
        return false;
  for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1))
              {
              digitos_iguais = 0;
              break;
              }
  if (!digitos_iguais)
        {
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
              soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
              return false;
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
              soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
              return false;
        return true;
        }
  else
        return false;
}

function faz()
{
  document.getElementById('msgOK').style.display = 'none'; 
  document.getElementById('msgErro').style.display = 'none'; 
  var cpf = document.getElementById('cpf_socio').value;
   cpf = cpf.replace('.','');
   cpf = cpf.replace('-','');
	
  if(valida_cpf(cpf)){
    document.getElementById('msgOK').style.display = 'block'; 
  } else{
    document.getElementById('msgErro').style.display = 'block'; 
	alert("Digite um CPF válido!");
	return false;
  }
}

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
                                        <strong>Gestão</strong>
                                        <small> de Mensalidades</small>

<div class="rs-select2--dark rs-select2--md m-r-10">
						
										   <form action="" method="get" >
										   		<input type="hidden" name="idsoc" value="<?php echo $idsocio;?>">
                                                <select class="js-select2" name="filtroano" onChange="this.form.submit()">
												<option value="" selected="selected">Selecione o ano</option>
                                                    <option value="<?php echo date("Y");?>"><?php echo date("Y");?></option>
                                                    <option value="<?php echo (date("Y")-1);?>"><?php echo (date("Y")-1);?></option>
													 <option value="<?php echo (date("Y")-2);?>"><?php echo (date("Y")-2);?></option>
													  <option value="<?php echo (date("Y")-3);?>"><?php echo (date("Y")-3);?></option>
                                                </select>
												
                                                <div class="dropDownSelect2"></div>
												
												<?php if($_GET['clube']){?>
												<input type="hidden" name="clube" value="<?php echo $clube;?>">
												<?php } ?>
												
											
                                            </div>
												
											</form>
                                           

                                    </div>
                                    <div class="card-body card-block">
                                       
                                        
									


	  
	  <?php 
		
		$mescadastro = date('m',strtotime($row_lis['data_cadastro']));
		$anocadastro = date('Y',strtotime($row_lis['data_cadastro']));
		$datacadastro = date('Y-m-d',strtotime($row_lis['data_cadastro']));

		$filtroano = $_GET['filtroano'];//Mês de Filtro

		if($filtroano == ""){
			$filtroano = date('Y');//Ano atual
		}

		$mesatual = date('m');
		$datahoje = date('Y-m-d');
		
		$mesjan = 1;
		$mjan = date('Y-m-d',strtotime($filtroano."-".$mesjan."-".(date('d',strtotime($datacadastro)))));
		$mesfev = 2;
		$mfev = date('Y-m-d',strtotime($filtroano."-".$mesfev."-".(date('d',strtotime($datacadastro)))));
		$mesmar = 3;
		$mmar = date('Y-m-d',strtotime($filtroano."-".$mesmar."-".(date('d',strtotime($datacadastro)))));
		$mesabr = 4;
		$mabr = date('Y-m-d',strtotime($filtroano."-".$mesabr."-".(date('d',strtotime($datacadastro)))));
		$mesmai = 5;
		$mmai = date('Y-m-d',strtotime($filtroano."-".$mesmai."-".(date('d',strtotime($datacadastro)))));
		$mesjun = 6;
		$mjun = date('Y-m-d',strtotime($filtroano."-".$mesjun."-".(date('d',strtotime($datacadastro)))));
		$mesjul = 7;
		$mjul = date('Y-m-d',strtotime($filtroano."-".$mesjul."-".(date('d',strtotime($datacadastro)))));
		$mesago = 8;
		$mago = date('Y-m-d',strtotime($filtroano."-".$mesago."-".(date('d',strtotime($datacadastro)))));
		$messet = 9;
		$mset = date('Y-m-d',strtotime($filtroano."-".$messet."-".(date('d',strtotime($datacadastro)))));
		$mesout = 10;
		$mout = date('Y-m-d',strtotime($filtroano."-".$mesout."-".(date('d',strtotime($datacadastro)))));
		$mesnov = 11;
		$mnov = date('Y-m-d',strtotime($filtroano."-".$mesnov."-".(date('d',strtotime($datacadastro)))));
		$mesdez = 12;
		$mdez = date('Y-m-d',strtotime($filtroano."-".$mesdez."-".(date('d',strtotime($datacadastro)))));
		
		
		$hoje = date('Y-m-d');
		
		//Query de Janeiro
	    $queryjan = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesjan' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$jan = mysqli_query($link, $queryjan) or die(mysqli_error($link));
		$row_jan = mysqli_fetch_assoc($jan);
		$totalRows_jan = mysqli_num_rows($jan);
		
		//Query de Fevereiro
	    $queryfev = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesfev' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$fev = mysqli_query($link, $queryfev) or die(mysqli_error($link));
		$totalRows_fev = mysqli_num_rows($fev);
		
		//Query de Março
	    $querymar = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesmar' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$mar = mysqli_query($link, $querymar) or die(mysqli_error($link));
		$totalRows_mar = mysqli_num_rows($mar);
		
		//Query de Abril
	    $queryabr = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesabr' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$abr = mysqli_query($link, $queryabr) or die(mysqli_error($link));
		$totalRows_abr = mysqli_num_rows($abr);
		
		//Query de Maio
	    $querymai = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesmai' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$mai = mysqli_query($link, $querymai) or die(mysqli_error($link));
		$totalRows_mai = mysqli_num_rows($mai);
		
		//Query de Junho
	    $queryjun = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesjun' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$jun = mysqli_query($link, $queryjun) or die(mysqli_error($link));
		$totalRows_jun = mysqli_num_rows($jun);
		
		//Query de Julho
	    $queryjul = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesjul' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$jul = mysqli_query($link, $queryjul) or die(mysqli_error($link));
		$totalRows_jul = mysqli_num_rows($jul);
		
		//Query de Agosto
	    $queryago = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesago' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$ago = mysqli_query($link, $queryago) or die(mysqli_error($link));
		$totalRows_ago = mysqli_num_rows($ago);
		
		//Query de Setembro
	    $queryset = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$messet' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$set = mysqli_query($link, $queryset) or die(mysqli_error($link));
		$totalRows_set = mysqli_num_rows($set);
		
		//Query de Outubro
	    $queryout = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesout' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$out = mysqli_query($link, $queryout) or die(mysqli_error($link));
		$totalRows_out = mysqli_num_rows($out);
		
		//Query de Novembro
	    $querynov = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesnov' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$nov = mysqli_query($link, $querynov) or die(mysqli_error($link));
		$totalRows_nov = mysqli_num_rows($nov);
		
		//Query de Dezembro
	    $querydez = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesdez' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$dez = mysqli_query($link, $querydez) or die(mysqli_error($link));
		$totalRows_dez = mysqli_num_rows($dez);
		
		//Query de consulta do status do pagamento do mês
	    $querypg = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND MONTH(data_mensalidade) = '$mesatual' AND YEAR(data_mensalidade) = '$filtroano' AND clube='$clube' AND pagamento=1";
		$pg = mysqli_query($link, $querypg) or die(mysqli_error($link));
		$totalRows_pg = mysqli_num_rows($pg);
		
	  ?>
	  
	  <div class="row">
	  <div class="col-12">
	  <p><strong>Sócio:</strong> <?php echo $row_lis['nome_socio'];?></p>
	  <p><strong>Dia do vencimento:</strong> <?php echo $row_lis['mensalidade_diavenc'];?></p>
	  <p><strong>Pagamento do mês:</strong> 
	  
	  		<?php if($totalRows_pg == 0){echo "<strong style='color: #ff0000;'>Pagamento não identificado</strong>";}else{echo "<strong style='color: #21b342;'>Pagamento identificado</strong>";}?>
	  
	  </p><br>
	  </div>
	  
	  </div>
	  
	  <div class="row alert alert-primary" role="alert">
		<div class="col">
		<strong>Jan</strong><br>
		<?php if($mjan < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_jan == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Fev</strong><br>
		<?php if($mfev < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_fev == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Mar</strong><br>
		<?php if($mmar < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_mar == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Abr</strong><br>
		<?php if($mabr < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_abr == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Mai</strong><br>
		<?php if($mmai < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_mai == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Jun</strong><br>
		<?php if($mjun < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_jun == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Jul</strong><br>
		<?php if($mjul < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_jul == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Ago</strong><br>
		<?php if($mago < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_ago == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Set</strong><br>
		<?php if($mset < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_set == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Out</strong><br>
		<?php if($mout < $datacadastro ){echo "-";}else{?>
		<?php if($totalRows_out == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Nov</strong><br>
		<?php if($mnov < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_nov == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Dez</strong><br>
		<?php if($mdez < $datacadastro){echo "-";}else{?>
		<?php if($totalRows_dez == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		
		
	  </div>
	  
        <form action="proc_pgto_mensalidade.php" method="post" name="formsocio" id="formsocio">
		<label for="message-text" class="col-form-label">Valor da parcela:</label>
		<div class="input-group mb-2">
		 
        <div class="input-group-prepend">
          <div class="input-group-text">R$</div>
        </div>
        <input type="text" class="form-control" onKeyPress="return(moeda(this,'.',',',event))" name="valormens" id="recipient-name" value="<?php echo number_format($row_lis['mensalidade_valor'],2,',', '.');?>" tabindex="0" data-toggle="tooltip" title="A alteração deste valor não modificará a mensalidade base definida. Somente o valor do mês será alterado.">
      </div>
          
		 
		  <div class="row">
		  	<div class="col">
	          <div class="form-group exibedatapagamento">
	            <label for="message-text" class="col-form-label">Data do Recebimento da Mensalidade:</label>
	            <input type="date" name="datapagamento" class="form-control" tabindex="0" data-toggle="tooltip" value="<?php echo date("d-m-Y"); ?>">
	          </div>
	        </div>
	        <div class="col">
	          <div class="form-group exibedatapagamento">
	            <label for="message-text" class="col-form-label">Tipo de Pagamento:</label>
	            <select name="tipo-pgto" class="form-control" required>
	            	<option value="0">Selecione um tipo de pagamento...</option>
	            	<option value="1">Boleto</option>
	            	<option value="2">Dinheiro</option>
	            	<option value="3">Transferência</option>
	            	<option value="4">Cheque</option>
	            </select>
	          </div>
	        </div>
      	 </div>
		  
		  <div class="form-group">
            <label for="message-text" class="col-form-label">Referente ao vencimento:</label>
			<div class="row">
			<div class="col">
            <input type="text" name="diaref" readonly class="form-control" placeholder="Dia (05)" tabindex="0" data-toggle="tooltip" title="Dia do Vencimento" value="<?php echo $row_lis['mensalidade_diavenc'];?>">
			</div>
			<div class="col">
			<select name="mesref" class="form-control" tabindex="0" data-toggle="tooltip" title="Mês do Vencimento">
				<option>Selecione o mês...</option>
				<option value="01">Janeiro</option>
				<option value="02">Fevereiro</option>
				<option value="03">Março</option>
				<option value="04">Abril</option>
				<option value="05">Maio</option>
				<option value="06">Junho</option>
				<option value="07">Julho</option>
				<option value="08">Agosto</option>
				<option value="09">Setembro</option>
				<option value="10">Outubro</option>
				<option value="11">Novembro</option>
				<option value="12">Dezembro</option>
			</select>
			</div>
			<div class="col">
			<select name="anoref" class="form-control" tabindex="0" data-toggle="tooltip" title="Ano do Vencimento">
				<option>Selecione o ano...</option>
				<option value="<?php echo date('Y')-1; ?>"><?php echo date('Y')-1; ?></option>
				<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
				<option value="<?php echo date('Y')+1; ?>"><?php echo date('Y')+1; ?></option>
				
			</select>
			
			</div>
			</div>
		  </div>
		  
        <input type="hidden" name="idsocio" class="form-control" value="<?php echo $idsocio;?>">
		<input type="hidden" name="club" class="form-control" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
     
	  


										<button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block " style="margin-top: 40px">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Efetuar baixa</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                        </form>
                                    </div>
                                </div>
								
								
								
                            </div>
							
							
							
							
							
</div>
            

            <?php include("footer.php"); ?>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	
	
	
<script>

  

$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<div class="row form-group" id="row'+i+'"><div class="col-12 col-md-4"><div class="form-group"><label for="nome_filho" class=" form-control-label">Nome do Filho</label><input type="text" name="nome_filho[]" id="nome_filho" class="form-control" required></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="data_nascto_filho" class=" form-control-label">Data de Nascto. Filho</label><input type="date" name="data_nascto_filho[]" id="data_nascto_filho" class="form-control" required></div></div><div class="col-12 col-md-4" ><div class="form-group"><br><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button> REMOVER</div></div></div>');
	
	});

	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	
	
});
</script>
	
	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->