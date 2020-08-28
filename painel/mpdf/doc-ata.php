<?php 
require_once __DIR__ . '/vendor/autoload.php';
include_once("../config.php");

$clube = $_GET['clube'];
$idata = $_GET['cod_ata'];

$sq = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$pegaclube = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_pegaclube = mysqli_fetch_assoc($pegaclube);

//Pega ATA
$sqata = "SELECT * FROM rfa_ata WHERE cod_ata='$idata' AND clube='$clube'";
$pegaata = mysqli_query($link, $sqata) or die(mysqli_error($link));
$row_pegaata = mysqli_fetch_assoc($pegaata);
$idpauta = $row_pegaata['id_pauta'];

$sqpauta = "SELECT * FROM rfa_pauta WHERE cod_pauta='$idpauta' AND clube='$clube'";
$pegapauta = mysqli_query($link, $sqpauta) or die(mysqli_error($link));
$row_pegapauta = mysqli_fetch_assoc($pegapauta);
$idreuniao = $row_pegapauta['ref_reuniao'];
$idlocal = $row_pegapauta['id_local'];

$sqreun = "SELECT * FROM rfa_reuniao WHERE id_reuniao='$idreuniao' AND clube='$clube'";
$pegareun = mysqli_query($link, $sqreun) or die(mysqli_error($link));
$row_pegareun = mysqli_fetch_assoc($pegareun);

$sqlocal = "SELECT * FROM rfa_local_reuniao WHERE id_local='$idlocal' AND clube='$clube'";
$pegalocal = mysqli_query($link, $sqlocal) or die(mysqli_error($link));
$row_pegalocal = mysqli_fetch_assoc($pegalocal);

$sqmesa = "SELECT * FROM rfa_mesa WHERE ref_pauta='$idpauta' AND clube='$clube'";
$pegamesa = mysqli_query($link, $sqmesa) or die(mysqli_error($link));
$row_pegamesa = mysqli_fetch_assoc($pegamesa);

$listamesa = "";
foreach($pegamesa as $mesa){
	$listamesa .= "<strong>".$mesa['cargo_mesa'].":</strong>".$mesa['nome_mesa']."<br>";
}

 $html = "
 <fieldset>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
<h1>Ata Pós-Reunião<br>RC ".$row_pegaclube['nome_clube']."</h1>

<table style='margin-bottom: 30px'>
	<tr>
		<td>
			<strong>Ano rotário:</strong> ".$row_pegapauta['ano_rotario']."<br>
			<strong>Reunião:</strong> ".$row_pegareun['nome_reuniao']."<br> 
			<strong>Presidente:</strong> ".$row_pegapauta['pres_reuniao']."<br> 
			<strong>Secretário:</strong> ".$row_pegapauta['sec_reuniao']."<br>
			<strong>Protocolo:</strong> ".$row_pegapauta['user_protocolo']."<br>
		</td>
		<td>
			<strong>Data da Reunião:</strong> ".date('d/m/Y',strtotime($row_pegareun['data_reuniao']))."<br>
			<strong>Início da Reunião:</strong> ".$row_pegapauta['inicio_reuniao']."<br>
			<strong>Local da Reunião:</strong> ".$row_pegalocal['nome_local']."<br>
			<strong>Abertura por:</strong> ".$row_pegapauta['nome_abertura']."<br>
		</td>
	</tr>
</table>

<table style='margin-bottom: 30px'>
	<tr>
		<td>
			<h2>Protocolo / Composição da Mesa Diretora</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$listamesa."<br>
			".$row_pegaata['adicional_mesa']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Convidados/Recuperantes</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['convi_recup']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Tempo da Secretaria</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['secretaria']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Comissão de Administração</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['com_admin']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Subcomissão de Companheirismo</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['sub_comp']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Comissão de Projetos</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['com_proj']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Comissão da Fundação Rotária</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['com_fund_rot']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Comissão de Relações Públicas</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['com_rel_publi']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Pequenas Comunicações</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['peq_com']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Apresentação do Palestrante</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['apres_pales']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Tema</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['tema']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Tempo do(a) Presidente</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['presid']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
    </tr>
	<tr>
		<td>
			<h2>Encerramento</h2>
		</td>
	</tr>
	<tr>
		<td style='margin-bottom: 30px'>
			".$row_pegaata['encerramento']."
		</td>
    </tr>
    <tr>
        <td style='height: 30px'></td>
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