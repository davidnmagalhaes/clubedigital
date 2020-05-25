<?php

function saldoAcum($filtromes,$filtroano,$clube){

include("config.php");

$mes = $filtromes;      // Mês desejado, pode ser por ser obtido por POST, GET, etc.
$ano = $filtroano; // Ano atual
$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!

$data = $ano."-".$mes."-".$ultimo_dia;
$dataatual = date('Y-m-d',strtotime($data));

//////////////////////////////////// Saldos Iniciais das Contas ///////////////////////////////////////////
$sqsld = "SELECT SUM(saldo) as valor FROM rfa_bancos WHERE clube='$clube'";
$sldtotal = mysqli_query($link, $sqsld) or die(mysqli_error($link));
$row_sldtotal = mysqli_fetch_assoc($sldtotal);

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


return $totalgeral;

}
?>