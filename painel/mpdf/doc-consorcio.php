<?php 
require_once __DIR__ . '/vendor/autoload.php';
include_once("../config.php");

$clube = $_GET['clube'];
$protocolo = $_GET['protocolo'];
$metodopagamento = $_GET['metodopagamento'];

if($metodopagamento == 'boleto'){
$metodo = "Boleto Bancário";
}

//Pega informações do Clube
$sq = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$pegaclube = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_pegaclube = mysqli_fetch_assoc($pegaclube);

$datahoje = date('Y-m-d');

$scl = "SELECT * FROM rfa_consorcio_pagamentos WHERE clube='$clube' AND cod_pagamento='$protocolo'";
$sclu = mysqli_query($link, $scl) or die(mysqli_error($link));
$row_sclu = mysqli_fetch_assoc($sclu);

$codconsorcio = $row_sclu['cod_consorcio'];
$codinscr = $row_sclu['cod_inscrito'];

$scli = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_inscrito='$codinscr'";
$sclui = mysqli_query($link, $scli) or die(mysqli_error($link));
$row_sclui = mysqli_fetch_assoc($sclui);

$idsocio = $row_sclui['id_socio'];

$scmp = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND cod_consorcio='$codconsorcio'";
$cmp = mysqli_query($link, $scmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_assoc($cmp);

$nomeconsorcio = $row_cmp['nome_consorcio'];
$valorconsorcio = $row_cmp['valor_consorcio'];

$sqsoc = "SELECT * FROM rfs_socios WHERE clube='$clube' AND id_socio='$idsocio'";
$soc = mysqli_query($link, $sqsoc) or die(mysqli_error($link));
$row_soc = mysqli_fetch_assoc($soc);

$nomesocio = $row_soc['nome_socio'];
$emailsocio = $row_soc['email_socio'];

$instruction = "
	Prezado doador,<br>
	O RC ".$row_pegaclube['nome_clube']." agradece por realizar seu pedido para sua inscrição no Consórcio Paul Harris.<br><br>
";

 $html = "
 <fieldset>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
 <h1>Comprovante do Consórcio <br>RC ".$row_pegaclube['nome_clube']."</h1>

<table style='border: 1px solid #333'>
	<tr>
		<td style='text-align:center;'>
		<h2>INSTRUÇÕES AO DOADOR</h2>
		<p>".$instruction."</p>
		</td>
	</tr>
</table>
<br>
<table style='border: 1px solid #333'>
	<tr>
		<td colspan='2' style='text-align:center;'>
		<h2>RESUMO DO DOADOR</h2>
		</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Protocolo:</strong> </td>
		<td>".$protocolo."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Data:</strong> </td>
		<td>".date('d/m/Y',strtotime($row_sclu['data']))." às ".date('H:i:s',strtotime($row_sclu['hora']))."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Consórcio:</strong> </td>
		<td>".$nomeconsorcio."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Nome:</strong> </td>
		<td>".$nomesocio."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>E-mail:</strong> </td>
		<td>".$emailsocio."</td>
	</tr>
	
	<tr>
		<td style='text-align:center;'><strong>Valor do Consórcio:</strong> </td>
		<td>U$ ".number_format($valorconsorcio,2,',','.')."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Metódo de Pagamento:</strong> </td>
		<td>".$metodo."</td>
	</tr>
</table>

<div style='text-align:center; margin: 50px auto;'><img src='../images/clube-digital.jpg' width='200' ></div>

 </fieldset>
 
 ";


$mpdf = new \Mpdf\Mpdf();
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
$mpdf->Output();

 exit;