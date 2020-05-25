<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$clube = mysqli_real_escape_string($link,$_GET['clube']);
$codconsorcio = mysqli_real_escape_string($link,$_GET['codconsorcio']);
$mes = mysqli_real_escape_string($link,$_GET['mes']);
$ano = mysqli_real_escape_string($link,$_GET['ano']);

$data = date('Y-m-d');
$hora = date('H:i:s');

$qsorteio = "SELECT * FROM rfa_consorcio_sorteio WHERE clube='$clube' AND cod_consorcio='$codconsorcio' AND mes_sorteio='$mes' AND ano_sorteio='$ano'";
$sorteio = mysqli_query($link, $qsorteio) or die(mysqli_error($link));
$row_sorteio = mysqli_fetch_array($sorteio);
$totalrow_sorteio = mysqli_num_rows($sorteio);
$inscrito = $row_sorteio['cod_inscrito'];

$qnomp = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_consorcio='$codconsorcio' AND cod_inscrito='$inscrito'";
$nomp = mysqli_query($link, $qnomp) or die(mysqli_error($link));
$row_nomp = mysqli_fetch_array($nomp);
$idsc = $row_nomp['id_socio'];

$qnomsc = "SELECT * FROM rfs_socios WHERE clube='$clube' AND id_socio='$idsc'";
$nomsc = mysqli_query($link, $qnomsc) or die(mysqli_error($link));
$row_nomsc = mysqli_fetch_array($nomsc);
$nomesc = $row_nomsc['nome_socio'];

if($totalrow_sorteio > 0){
	echo "<script>javascript:alert('O sorteio do período selecionado já foi realizado, e o premiado foi: ".$nomesc."');javascript:window.location='consorcio.php?clube=".$clube."'</script>";
}else{

$qcon = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND cod_consorcio='$codconsorcio'";
$con = mysqli_query($link, $qcon) or die(mysqli_error($link));
$row_con = mysqli_fetch_array($con);


$qcmp = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_consorcio='$codconsorcio' ORDER BY rand() LIMIT 1";
$cmp = mysqli_query($link, $qcmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_array($cmp);

$codsorteado = $row_cmp['cod_inscrito'];
$idsocio = $row_cmp['id_socio'];

$datainicial = $row_con['data_inicial'];
$datafinal = $row_con['data_final'];

$data1 = new DateTime($datainicial);
$data2 = new DateTime($datafinal);

$intervalo = $data1->diff( $data2 );// Número de meses entre as duas datas

$qcmps = "SELECT * FROM rfs_socios WHERE clube='$clube' AND id_socio='$idsocio'";
$cmps = mysqli_query($link, $qcmps) or die(mysqli_error($link));
$row_cmps = mysqli_fetch_array($cmps);

$nomesocio = $row_cmps['nome_socio'];

	$qvr = "SELECT * FROM rfa_consorcio_pagamentos WHERE clube='$clube' AND cod_inscrito='$codsorteado' AND status_pagamento='1' AND cod_consorcio='$codconsorcio'";
	$vr = mysqli_query($link, $qvr) or die(mysqli_error($link));
	$row_vr = mysqli_num_rows($vr);

if($intervalo != $row_vr){

$qbusc = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_consorcio='$codconsorcio' AND cod_inscrito!='$codsorteado' ORDER BY rand() LIMIT 1";
$busc = mysqli_query($link, $qbusc) or die(mysqli_error($link));
$row_busc = mysqli_fetch_array($busc);

$codsorteio = $row_busc['cod_inscrito'];

}else{

$codsorteio = $codsorteado;

}


	$sql = "INSERT INTO rfa_consorcio_sorteio (cod_consorcio, cod_inscrito, mes_sorteio, ano_sorteio, data, hora, clube) VALUES('$codconsorcio', '$codsorteio','$mes','$ano','$data','$hora','$clube');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sorteio realizado com sucesso! O sorteado do período ".$mes."/".$ano." é ".$nomesocio."!');javascript:window.location='consorcio.php?clube=".$clube."'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>