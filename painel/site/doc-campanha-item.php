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

$scl = "SELECT * FROM rfa_campanhas_pedidos WHERE clube='$clube' AND protocolo_pedido='$protocolo'";
$sclu = mysqli_query($link, $scl) or die(mysqli_error($link));
$row_sclu = mysqli_fetch_assoc($sclu);

$codcampanha = $row_sclu['cod_campanha'];

$scmp = "SELECT * FROM rfa_campanhas WHERE clube='$clube' AND cod_campanha='$codcampanha'";
$cmp = mysqli_query($link, $scmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_assoc($cmp);

$nomecampanha = $row_cmp['nome_campanha'];

$slicmp = "SELECT * FROM rfa_campanhas_itens WHERE clube='$clube' AND cod_campanha='$codcampanha'";
$licmp = mysqli_query($link, $slicmp) or die(mysqli_error($link));
$row_licmp = mysqli_fetch_assoc($licmp);

$listaitens = "";

foreach($licmp as $item){
	$listaitens .= "<li>".$item['qtd_item']."x ".$item['nome_item']."</li>";
}

$instruction = "
	Prezado doador,<br>
	O RC ".$row_pegaclube['nome_clube']." agradece por realizar seu pedido para ser doador na campanha <strong>".$nomecampanha."</strong>! Sua doação é muito importante.<br><br>
	Agora, é importante que munido deste documento, RG e CPF compareça ao endereço abaixo para realizar a entrega do item a ser doado:<br><br>
	<strong>Endereço:</strong> ".$row_pegaclube['endereco_clube'].", ".$row_pegaclube['numero_clube'].", ".$row_pegaclube['bairro_clube'].", ".$row_pegaclube['cidade_clube'].", ".$row_pegaclube['estado_clube'].", ".$row_pegaclube['cep_clube']."<br>
	<strong>Telefone:</strong> ".$row_pegaclube['telefone_clube']."
";

 $html = "
 <fieldset>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
 <h1>Comprovante do Doador<br>RC ".$row_pegaclube['nome_clube']."</h1>

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
		<td>".$row_sclu['protocolo_pedido']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Data:</strong> </td>
		<td>".date('d/m/Y',strtotime($row_sclu['data']))." às ".date('H:i:s',strtotime($row_sclu['hora']))."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Campanha:</strong> </td>
		<td>".$nomecampanha."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Nome:</strong> </td>
		<td>".$row_sclu['nome_pedido']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>E-mail:</strong> </td>
		<td>".$row_sclu['email_pedido']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>CPF:</strong> </td>
		<td>".$row_sclu['cpf_pedido']."</td>
	</tr>

	<tr>
		<td style='text-align:center;'><strong>Telefone:</strong> </td>
		<td>".$row_sclu['telefone_pedido']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Endereço:</strong> </td>
		<td>".$row_sclu['endereco_pedido'].", ".$row_sclu['numero_pedido'].", ".$row_sclu['cidade_pedido'].", ".$row_sclu['estado_pedido'].", ".$row_sclu['cep_pedido']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Quantidade:</strong> </td>
		<td>".$row_sclu['quantidade_pedido']."</td>
	</tr>
	<tr>
		<td style='text-align:center;'><strong>Descrição do item:</strong> </td>
		<td><ul>".$listaitens."</ul></td>
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