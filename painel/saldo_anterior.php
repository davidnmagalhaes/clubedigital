<?php

function saldoAnterior($filtromes,$filtroano,$clube){

include('config.php');

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

//////////////////////////////////// Inadimplências Totais///////////////////////////////////////////
$sqinad = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_mensalidade) <= '$filtromes' AND YEAR(data_mensalidade) <= '$filtroano' AND pagamento=0 AND data_mensalidade < '$datahoje'";
$inadtotal = mysqli_query($link, $sqinad) or die(mysqli_error($link));
$row_inadtotal = mysqli_fetch_assoc($inadtotal);

//////////////////////////////////// Lista os Inadimplentes ///////////////////////////////////////////
$sqlisinad = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND rfa_mensalidades.pagamento=0 AND rfa_mensalidades.data_mensalidade < '$datahoje'";
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
$sqdtfn = "SELECT SUM(valor_fundo) as valor FROM rfa_fundos WHERE clube='$clube' AND MONTH(data_fundo) = '$filtromes' AND YEAR(data_fundo) = '$filtroano'";
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


//////////////////////////////////// Receitas Pagas ///////////////////////////////////////////
$sqrecp = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND MONTH(data_receita) = '$filtromes' AND YEAR(data_receita) = '$filtroano' AND status_receita=2";
$recptotal = mysqli_query($link, $sqrecp) or die(mysqli_error($link));
$row_recptotal = mysqli_fetch_assoc($recptotal);

//////////////////////////////////// Mensalidades Pagas///////////////////////////////////////////
$sqmtp = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano' AND pagamento=1";
$mtptotal = mysqli_query($link, $sqmtp) or die(mysqli_error($link));
$row_mtptotal = mysqli_fetch_assoc($mtptotal);

$totalentrada = ($row_recptotal['valor'] + $row_mtptotal['valor']) - ($row_despesatotalp['valor'] + $row_txtotal['valor'] + $row_fundototal['valor']);


return $totalentrada;

}
?>