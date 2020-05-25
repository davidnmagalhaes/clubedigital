<?php

function fundoAcum($filtromes,$filtroano,$clube){

include("config.php");

$mes = $filtromes;      // Mês desejado, pode ser por ser obtido por POST, GET, etc.
$ano = $filtroano; // Ano atual
$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!

$data = $ano."-".$mes."-".$ultimo_dia;
$dataatual = date('Y-m-d',strtotime($data));

//////////////////////////////////// Fundos Totais///////////////////////////////////////////
$sqdtfn = "SELECT SUM(valor_fundo) as valor FROM rfa_fundos WHERE clube='$clube' AND data_fundo <= '$dataatual' AND status_fundo='2'";
$fundototal = mysqli_query($link, $sqdtfn) or die(mysqli_error($link));
$row_fundototal = mysqli_fetch_assoc($fundototal);
$resultadofundo = $row_fundototal['valor'];

return $resultadofundo;

}
?>