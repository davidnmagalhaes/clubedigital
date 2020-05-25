<?php

function fundoAnterior($filtromes,$filtroano,$clube){

include('config.php');


//////////////////////////////////// Fundos Totais///////////////////////////////////////////
$sqdtfn = "SELECT SUM(valor_fundo) as valor FROM rfa_fundos WHERE clube='$clube' AND MONTH(data_fundo) = '$filtromes' AND YEAR(data_fundo) = '$filtroano' AND status_fundo='2'";
$fundototal = mysqli_query($link, $sqdtfn) or die(mysqli_error($link));
$row_fundototal = mysqli_fetch_assoc($fundototal);
$resultadofundo = $row_fundototal['valor'];

return $resultadofundo;

}
?>