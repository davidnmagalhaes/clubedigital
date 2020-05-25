<?php 
require_once __DIR__ . '/vendor/autoload.php';
include_once("../config.php");

$clube = $_GET['clube'];
$protocolo = $_GET['protocolo'];

//Pega informações do Clube
$sq = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$pegaclube = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_pegaclube = mysqli_fetch_assoc($pegaclube);

$datahoje = date('Y-m-d');

$scl = "SELECT * FROM rfa_cr_solicitante WHERE clube='$clube' AND protocolo_solicitante='$protocolo'";
$sclu = mysqli_query($link, $scl) or die(mysqli_error($link));
$row_sclu = mysqli_fetch_assoc($sclu);

$instruction = "
	Prezado solicitante,<br>
	O RC ".$row_pegaclube['nome_clube']." agradece por realizar seu pedido de doação! Suas informações serão analisadas pela equipe do clube e em breve o clube entrará em contato.
";

switch($row_sclu['escol_solicitante']){
	case "ensino-fundamental":
	$escolaridade = "Ensino Fundamental";
	break;

	case "ensino-fundamental-incompleto":
	$escolaridade = "Ensino Fundamental Incompleto";
	break;

	case "ensino-medio":
	$escolaridade = "Ensino Médio";
	break;

	case "ensino-medio-incompleto":
	$escolaridade = "Ensino Médio Incompleto";
	break;

	case "ensino-superior":
	$escolaridade = "Ensino Superior";
	break;

	case "ensino-superior-incompleto":
	$escolaridade = "Ensino Superior Incompleto";
	break;
}

switch($row_sclu['renda_solicitante']){
	case "menos-baixa":
	$renda = "Abaixo de 1 salário mínimo";
	break;

	case "baixa":
	$renda = "De 1 a 2 salários";
	break;

	case "media-baixa":
	$renda = "De 5 a 10 salários";
	break;

	case "media":
	$renda = "De 10 a 15 salários";
	break;

	case "alta-media":
	$renda = "De 15 a 20 salários";
	break;

	case "alta":
	$renda = "Acima de 20 salários";
	break;
}

switch($row_sclu['neces_solicitante']){
	case "cadeira-rodas":
	$necessidade = "Cadeira de Rodas";
	break;

	case "cadeira-banho":
	$necessidade = "Cadeira de Banho";
	break;

}



 $html = "
 <fieldset>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
 <h1>Comprovante de Solicitação de doação
 <br>RC ".$row_pegaclube['nome_clube']."</h1>

<table style='border: 1px solid #333'>
	<tr>
		<td style='text-align:center;'>
		<h2>INSTRUÇÕES AO SOLICITANTE</h2>
		<p>".$instruction."</p>
		</td>
	</tr>
</table>
<br>
<table style='border: 1px solid #333'>
	<tr>
		<td colspan='2' style='text-align:center;'>
		<h2>RESUMO DO SOLICITANTE</h2>
		</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Protocolo:</strong> </td>
		<td>".$row_sclu['protocolo_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Data:</strong> </td>
		<td>".date('d/m/Y',strtotime($row_sclu['data_solicitante']))." às ".date('H:i:s',strtotime($row_sclu['hora_solicitante']))."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Nome:</strong> </td>
		<td>".$row_sclu['nome_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>E-mail:</strong> </td>
		<td>".$row_sclu['email_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>CPF:</strong> </td>
		<td>".$row_sclu['cpf_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>RG:</strong> </td>
		<td>".$row_sclu['rg_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Telefone:</strong> </td>
		<td>".$row_sclu['fone_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Celular:</strong> </td>
		<td>".$row_sclu['cel_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Endereço:</strong> </td>
		<td>".$row_sclu['end_solicitante'].", ".$row_sclu['num_solicitante'].", ".$row_sclu['cid_solicitante'].", ".$row_sclu['uf_solicitante'].", ".$row_sclu['cep_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Escolaridade:</strong> </td>
		<td>".$escolaridade."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Renda Solicitante:</strong> </td>
		<td>".$renda."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Deficiência do Solicitante:</strong> </td>
		<td>".$row_sclu['def_solicitante']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Necessidade do Solicitante:</strong> </td>
		<td>".$necessidade."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Origem do Solicitante:</strong> </td>
		<td>".$row_sclu['orig_solicitante']."</td>
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