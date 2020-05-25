<?php 
require_once __DIR__ . '/vendor/autoload.php';
include_once("../config.php");

$filtromes = $_POST['filtromes'];//Ano de Filtro
$filtroano = $_POST['filtroano'];//Mês de Filtro

if($filtromes == "" && $filtroano == ""){
	$filtromes = date('m');//Mês atual
	$filtroano = date('Y');//Ano atual
}

$mes = $filtromes;      // Mês desejado, pode ser por ser obtido por POST, GET, etc.
$ano = $filtroano; // Ano atual
$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!

$data = $ano."-".$mes."-".$ultimo_dia;
$dataatual = date('Y-m-d',strtotime($data));

switch($filtromes){
	case 1:
	$mesextenso = "Janeiro";
	break;

	case 2:
	$mesextenso = "Fevereiro";
	break;

	case 3:
	$mesextenso = "Março";
	break;

	case 4:
	$mesextenso = "Abril";
	break;

	case 5:
	$mesextenso = "Maio";
	break;

	case 6:
	$mesextenso = "Junho";
	break;

	case 7:
	$mesextenso = "Julho";
	break;

	case 8:
	$mesextenso = "Agosto";
	break;

	case 9:
	$mesextenso = "Setembro";
	break;

	case 10:
	$mesextenso = "Outubro";
	break;

	case 11:
	$mesextenso = "Novembro";
	break;

	case 12:
	$mesextenso = "Dezembro";
	break;
}


$clube = $_POST['clube'];

//Pega informações do Clube
$sq = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$pegaclube = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_pegaclube = mysqli_fetch_assoc($pegaclube);

$datahoje = date('Y-m-d');

$scl = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$sclu = mysqli_query($link, $scl) or die(mysqli_error($link));
$row_sclu = mysqli_fetch_assoc($sclu);
$cambio = $row_sclu['cambio'];

//////////////////////////////////// Exibe todas as mensalidades do mês ///////////////////////////////////////////
$sqmsm = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND MONTH(rfa_mensalidades.data_mensalidade) = '$filtromes' AND YEAR(rfa_mensalidades.data_mensalidade) = '$filtroano' ORDER BY rfs_socios.nome_socio ASC";
$msm = mysqli_query($link, $sqmsm) or die(mysqli_error($link));
$totalRows_msm = mysqli_num_rows($msm);

//////////////////////////////////// Exibe todas as mensalidades PAGAS do mês ///////////////////////////////////////////
$sqmsmp = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND MONTH(rfa_mensalidades.data_mensalidade) = '$filtromes' AND YEAR(rfa_mensalidades.data_mensalidade) = '$filtroano' AND rfa_mensalidades.pagamento = '1' ORDER BY rfs_socios.nome_socio ASC";
$msmp = mysqli_query($link, $sqmsmp) or die(mysqli_error($link));
$totalRows_msmp = mysqli_num_rows($msmp);

//////////////////////////////////// Saldos Iniciais das Contas ///////////////////////////////////////////
$sqsld = "SELECT SUM(saldo) as valor FROM rfa_bancos WHERE clube='$clube'";
$sldtotal = mysqli_query($link, $sqsld) or die(mysqli_error($link));
$row_sldtotal = mysqli_fetch_assoc($sldtotal);

//////////////////////////////////// Despesas Totais///////////////////////////////////////////
$sqdt = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND MONTH(data_pagar) = '$filtromes' AND YEAR(data_pagar) = '$filtroano'";
$despesatotal = mysqli_query($link, $sqdt) or die(mysqli_error($link));
$row_despesatotal = mysqli_fetch_assoc($despesatotal);

//////////////////////////////////// Inadimplências Totais Acumuladas///////////////////////////////////////////
$sqinad = "SELECT SUM(rfa_mensalidades.valor_mensalidade) as valor FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio=rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND MONTH(rfa_mensalidades.data_mensalidade) <= '$filtromes' AND YEAR(rfa_mensalidades.data_mensalidade) <= '$filtroano' AND rfa_mensalidades.pagamento=0 AND rfa_mensalidades.data_mensalidade < '$datahoje' AND rfs_socios.status_socio='1' AND rfs_socios.status_cob='1'";
$inadtotal = mysqli_query($link, $sqinad) or die(mysqli_error($link));
$row_inadtotal = mysqli_fetch_assoc($inadtotal);

//////////////////////////////////// Inadimplências Totais do mês///////////////////////////////////////////
$sqinadm = "SELECT SUM(rfa_mensalidades.valor_mensalidade) as valor FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio=rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND MONTH(rfa_mensalidades.data_mensalidade) = '$filtromes' AND YEAR(rfa_mensalidades.data_mensalidade) = '$filtroano' AND rfa_mensalidades.pagamento=0 AND rfa_mensalidades.data_mensalidade < '$datahoje' AND rfs_socios.status_socio='1' AND rfs_socios.status_cob='1'";
$inadtotalm = mysqli_query($link, $sqinadm) or die(mysqli_error($link));
$row_inadtotalm = mysqli_fetch_assoc($inadtotalm);

//////////////////////////////////// Lista os Inadimplentes ///////////////////////////////////////////
$sqlisinad = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND rfa_mensalidades.pagamento=0 AND rfa_mensalidades.data_mensalidade < '$datahoje' AND rfs_socios.status_socio='1' AND rfs_socios.status_cob='1'";
$lisinadtotal = mysqli_query($link, $sqlisinad) or die(mysqli_error($link));
$row_lisinadtotal = mysqli_fetch_assoc($lisinadtotal);
$totalRows_lisinadtotal = mysqli_num_rows($lisinadtotal);

//////////////////////////////////// Receitas Totais///////////////////////////////////////////
$sqrec = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND MONTH(data_receita) = '$filtromes' AND YEAR(data_receita) = '$filtroano'";
$rectotal = mysqli_query($link, $sqrec) or die(mysqli_error($link));
$row_rectotal = mysqli_fetch_assoc($rectotal);

//////////////////////////////////// Mensalidades Totais///////////////////////////////////////////
$sqmt = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_mensalidade) = '$filtromes' AND YEAR(data_mensalidade) = '$filtroano'";
$mttotal = mysqli_query($link, $sqmt) or die(mysqli_error($link));
$row_mttotal = mysqli_fetch_assoc($mttotal);

//////////////////////////////////// Taxa total do mês///////////////////////////////////////////
$sqtx = "SELECT SUM(taxa) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano' AND pagamento=1";
$txtotal = mysqli_query($link, $sqtx) or die(mysqli_error($link));
$row_txtotal = mysqli_fetch_assoc($txtotal);

//////////////////////////////////// Fundos Totais///////////////////////////////////////////
$sqdtfn = "SELECT SUM(valor_fundo) as valor FROM rfa_fundos WHERE clube='$clube' AND MONTH(data_fundo) = '$filtromes' AND YEAR(data_fundo) = '$filtroano' AND status_fundo='2'";
$fundototal = mysqli_query($link, $sqdtfn) or die(mysqli_error($link));
$row_fundototal = mysqli_fetch_assoc($fundototal);
$resultadofundo = $row_fundototal['valor'];

$resultadodespesa = $row_despesatotal['valor'] + $row_txtotal['valor'] + $row_fundototal['valor'];//Despesa com taxa
$resultadodespesastaxa = $row_despesatotal['valor'];//Despesa sem taxa

//////////////////////////////////// Taxa total do mês///////////////////////////////////////////
$sqtxg = "SELECT SUM(taxa) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) <= '$filtromes' AND YEAR(data_pagamento) <= '$filtroano' AND pagamento=1";
$txtotalg = mysqli_query($link, $sqtxg) or die(mysqli_error($link));
$row_txtotalg = mysqli_fetch_assoc($txtotalg);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////PAGOS////////////////////////////////////////////
//////////////////////////////////// Despesas Pagas///////////////////////////////////////////
$sqdtp = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND MONTH(data_pagar) = '$filtromes' AND YEAR(data_pagar) = '$filtroano' AND status_pagar=2";
$despesatotalp = mysqli_query($link, $sqdt) or die(mysqli_error($link));
$row_despesatotalp = mysqli_fetch_assoc($despesatotalp);

//////////////////////////////////// Listar Despesas Pagas///////////////////////////////////////////
$sqdtpl = "SELECT * FROM rfa_pagar WHERE clube='$clube' AND MONTH(data_pagar) = '$filtromes' AND YEAR(data_pagar) = '$filtroano' AND status_pagar=2";
$despesatotalpl = mysqli_query($link, $sqdtpl) or die(mysqli_error($link));
$row_despesatotalpl = mysqli_fetch_assoc($despesatotalpl);
$listardespesas = "";

foreach($despesatotalpl as $ldesp){
	$listardespesas .= "<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>".$ldesp['descricao_pagar']."</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($ldesp['valor_pagar'],2,',','.')."</td>
 	</tr>";
}

//////////////////////////////////// Listar Fundos///////////////////////////////////////////
$sqfdpl = "SELECT * FROM rfa_fundos WHERE clube='$clube' AND MONTH(data_fundo) = '$filtromes' AND YEAR(data_fundo) = '$filtroano' AND status_fundo=2";
$fdtotalpl = mysqli_query($link, $sqfdpl) or die(mysqli_error($link));
$row_fdtotalpl = mysqli_fetch_assoc($fdtotalpl);
$listarfd = "";

foreach($fdtotalpl as $lfd){
	$listarfd .= "<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>".$lfd['descricao_fundo']."</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($lfd['valor_fundo'],2,',','.')."</td>
 	</tr>";
}

//////////////////////////////////// Mensalidades Agrupadas///////////////////////////////////////////
$sqmtpm = "SELECT * FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano' AND pagamento=1 GROUP BY valor_mensalidade";
$mtptotalm = mysqli_query($link, $sqmtpm) or die(mysqli_error($link));
$row_mtptotalm = mysqli_fetch_assoc($mtptotalm);

$teste = "";
foreach($mtptotalm as $key => $lmes){

	$smg = "SELECT * FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano' AND pagamento=1 AND valor_mensalidade='$lmes[valor_mensalidade]'";
	$mtmg = mysqli_query($link, $smg) or die(mysqli_error($link));
	$totalRows_mg = mysqli_num_rows($mtmg);
	$resultado = $totalRows_mg * $lmes['valor_mensalidade'];
	$teste .= "<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>".$totalRows_mg." mensalidade(s) de <br>R$ ".number_format($lmes['valor_mensalidade'],2,',','.')."</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultado,2,',','.')."</td>
 	</tr>";
}

//////////////////////////////////// Receitas Pagas ///////////////////////////////////////////
$sqrecp = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND MONTH(data_receita) = '$filtromes' AND YEAR(data_receita) = '$filtroano' AND status_receita=2";
$recptotal = mysqli_query($link, $sqrecp) or die(mysqli_error($link));
$row_recptotal = mysqli_fetch_assoc($recptotal);

//////////////////////////////////// Mensalidades Pagas///////////////////////////////////////////
$sqmtp = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano' AND pagamento=1";
$mtptotal = mysqli_query($link, $sqmtp) or die(mysqli_error($link));
$row_mtptotal = mysqli_fetch_assoc($mtptotal);

$totalentrada = ($row_recptotal['valor'] + $row_mtptotal['valor']) - ($row_despesatotalp['valor'] + $row_txtotal['valor'] + $row_fundototal['valor']);
$receitatotal = $row_mtptotal['valor'] + $row_recptotal['valor'];

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////SALDO GERAL////////////////////////////////////////////
//////////////////////////////////// Despesas Pagas no Geral ///////////////////////////////////////////
$sqdtg = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND MONTH(data_pagar) <= '$filtromes' AND YEAR(data_pagar) <= '$filtroano' AND status_pagar=2";
$despesatotalg = mysqli_query($link, $sqdtg) or die(mysqli_error($link));
$row_despesatotalg = mysqli_fetch_assoc($despesatotalg);
//////////////////////////////////// Mensalidades Pagas no Geral ///////////////////////////////////////////
$sqmtg = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) <= '$filtromes' AND YEAR(data_pagamento) <= '$filtroano' AND pagamento=1";
$mtgtotal = mysqli_query($link, $sqmtg) or die(mysqli_error($link));
$row_mtgtotal = mysqli_fetch_assoc($mtgtotal);
//////////////////////////////////// Receitas Pagas no Geral ///////////////////////////////////////////
$sqrecpg = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND MONTH(data_receita) <= '$filtromes' AND YEAR(data_receita) <= '$filtroano' AND status_receita=2";
$recpgtotal = mysqli_query($link, $sqrecpg) or die(mysqli_error($link));
$row_recpgtotal = mysqli_fetch_assoc($recpgtotal);

//////////////////////////////////// Queries para Saldo Geral ///////////////////////////////////////////



$sqmtg1 = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND pagamento=1 AND data_pagamento<='$dataatual'";
$mtgtotal1 = mysqli_query($link, $sqmtg1) or die(mysqli_error($link));
$row_mtgtotal1 = mysqli_fetch_assoc($mtgtotal1);

$sqrecpg1 = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND status_receita=2 AND data_receita<='$dataatual'";
$recpgtotal1 = mysqli_query($link, $sqrecpg1) or die(mysqli_error($link));
$row_recpgtotal1 = mysqli_fetch_assoc($recpgtotal1);

$sqdtg1 = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND status_pagar=2 AND data_pagar<='$dataatual'";
$despesatotalg1 = mysqli_query($link, $sqdtg1) or die(mysqli_error($link));
$row_despesatotalg1 = mysqli_fetch_assoc($despesatotalg1);

$sqtxg1 = "SELECT SUM(taxa) as valor FROM rfa_mensalidades WHERE clube='$clube' AND pagamento=1 AND data_pagamento<='$dataatual'";
$txtotalg1 = mysqli_query($link, $sqtxg1) or die(mysqli_error($link));
$row_txtotalg1 = mysqli_fetch_assoc($txtotalg1); 

$sqfng1 = "SELECT SUM(valor_fundo) as valor FROM rfa_fundos WHERE clube='$clube' AND status_fundo=2 AND data_fundo<='$dataatual'";
$fntotalg1 = mysqli_query($link, $sqfng1) or die(mysqli_error($link));
$row_fntotalg1 = mysqli_fetch_assoc($fntotalg1);
$fundogeral = $row_fntotalg1['valor'];

$totalgeral = ($row_mtgtotal1['valor'] + $row_recpgtotal1['valor'] + $row_sldtotal['valor']) - ($row_despesatotalg1['valor'] + $row_txtotalg1['valor'] + $row_fntotalg1['valor']);
$entradasgerais = ($row_mtgtotal['valor'] + $row_recpgtotal['valor'] + $row_sldtotal['valor']);
$saidasgerais = ($row_despesatotalg['valor'] + $row_txtotalg['valor']);

if($filtromes == 1){
	$mespassado = 12;
	$anopassado = $filtroano - 1;
}else{
	$mespassado = $filtromes - 1;
	$anopassado = $filtroano;
}

include('../saldo_anterior.php');
include('../saldo_acum_anterior.php');
include('../fundo_anterior.php');
include('../fundo_acum_anterior.php');

$saldoanterior = saldoAnterior($mespassado,$anopassado,$clube);//Saldo Total do Mês Passado
$fundoanterior = fundoAnterior($mespassado,$anopassado,$clube);
$saldoacumanterior = saldoAcum($mespassado,$anopassado,$clube);//Saldo Acumulado do Mês Passado
$fundoacumanterior = fundoAcum($mespassado,$anopassado,$clube);

$somasaldo = $fundogeral + $totalgeral;

 $html = "
 <fieldset>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
 <h1>Balanço Financeiro do RC ".$row_pegaclube['nome_clube']."</h1>
 <p style='text-align:center;'><strong>Mês:</strong> ".$mesextenso." - <strong>Ano:</strong> ".$filtroano."</p>


<div style='width:48%; float:left; margin: 0 5px'>

<table cellpadding='0' cellspacing='0'>
 	<tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>ENTRADAS</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Receitas Adicionais:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($row_recptotal['valor'],2,',','.')."</td>
 	</tr>
 	".$teste."
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Mensalidades previstas:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($row_mttotal['valor'],2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Mensalidades Pagas:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($row_mtptotal['valor'],2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Total de Receitas:</td>
 		<td style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($receitatotal,2,',','.')."</td>
 	</tr>
 	
</table>
<br>
<table cellpadding='0' cellspacing='0'>
 	 <tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>INADIMPLÊNCIAS</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Inadimplêntes do mês:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($row_inadtotalm['valor'], 2, ',', '.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Inadimplêntes Acumulados:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($row_inadtotal['valor'], 2, ',', '.')."</td>
 	</tr>
</table>
<br>
<table cellpadding='0' cellspacing='0'>
 	 <tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>MENSALIDADES</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Qtd. de sócios:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>".$totalRows_msm." sócios</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Qtd. de mensalidades abertas:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>".$totalRows_msm." mensalidades</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Qtd. de mensalidades pagas:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>".$totalRows_msmp." mensalidades</td>
 	</tr>
</table>



</div>

 <div style='width:48%; float:left; margin: 0 5px'>
 <table cellpadding='0' cellspacing='0'>
 <tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>SAÍDAS</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Despesas Ordinárias:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultadodespesastaxa,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Despesas extraordinárias (fundos):</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultadofundo,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Taxas de boletos:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($row_txtotal['valor'],2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Total de despesas:</td>
 		<td style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultadodespesa,2,',','.')."</td>
 	</tr>
 </table>
<br>
<table cellpadding='0' cellspacing='0'>
 <tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>LANÇAMENTOS</td>
 	</tr>
 	<tr>
 		<td width='200' style='color: #fff;background: #a7a7a7;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>DESPESAS ORDINÁRIAS</td>
 		<td style='color: #fff;background: #a7a7a7;text-align:center;border: 1px solid #000; border-collapsed: collapsed; padding: 2px;font-weight: bold;'>VALOR</td>
 	</tr>
 	".$listardespesas."
 	<tr>
 		<td width='200' style='background: #e4e4e4;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Despesa total:</td>
 		<td style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultadodespesastaxa,2,',','.')."</td>
 	</tr>
 </table>
<br>
<table cellpadding='0' cellspacing='0'>
 	 <tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>DESPESAS EXTRAORDINÁRIAS<br>FUNDO DE RESERVA</td>
 	</tr>
 	<tr>
 		<td width='200' style='color: #fff;background: #a7a7a7;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>DESCRIÇÃO</td>
 		<td style='color: #fff;background: #a7a7a7;text-align:center;border: 1px solid #000; border-collapsed: collapsed; padding: 2px;font-weight: bold;'>VALOR</td>
 	</tr>
 	".$listarfd."
 	<tr>
 		<td width='200' style='background: #e4e4e4;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Fundo total:</td>
 		<td style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultadofundo,2,',','.')."</td>
 	</tr>

</table>
 
<br>
 <table cellpadding='0' cellspacing='0'>
 	 <tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>SALDOS DO MÊS</td>
 	</tr>
 	<tr>
 		<td width='200' style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>(+) Entradas:</td>
 		<td style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($receitatotal,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>(-) Taxas de boletos:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($row_txtotal['valor'],2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>(-) Despesas Ordinárias:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultadodespesastaxa,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>(-) Fundo de reserva do mês:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultadofundo,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='background: #e4e4e4;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Saldo do mês:</td>
 		<td style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($totalentrada,2,',','.')."</td>
 	</tr>
</table>

<br>
 <table cellpadding='0' cellspacing='0'>
 	 <tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>SALDOS GERAIS</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>(=) Acumulado mês passado:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($saldoacumanterior,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>(+) Acumulado deste mês:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($totalgeral,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>(+) Acumulado Fundo de Reserva:</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($fundogeral,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='background: #e4e4e4;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Saldo total:</td>
 		<td style='background:#e4e4e4;border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($somasaldo,2,',','.')."</td>
 	</tr>
 	
</table>
 <br>
<table cellpadding='0' cellspacing='0'>
 	 <tr>
 		<td colspan='2' style='background: #666; color: #fff;text-align:center;border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>FUNDO DE RESERVA</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Fundo (mês anterior):</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($fundoanterior,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Fundo (mês):</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($resultadofundo,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Fundo (acumulado anterior):</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($fundoacumanterior,2,',','.')."</td>
 	</tr>
 	<tr>
 		<td width='200' style='border: 1px solid #000; border-collapsed: collapsed; font-weight: bold; padding: 2px'>Fundo (acumulado atual):</td>
 		<td style='border: 1px solid #000; border-collapsed: collapsed; padding: 2px'>R$ ".number_format($fundogeral,2,',','.')."</td>
 	</tr>



</table>

</div>
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