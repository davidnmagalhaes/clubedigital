<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$statusentrega = mysqli_real_escape_string($link,$_POST['statusentrega']);
$iddoador = mysqli_real_escape_string($link,$_POST['iddoador']);
$clube = mysqli_real_escape_string($link,$_POST['clube']);

$qrh = "SELECT * FROM rfa_cr_doador WHERE id_doador='$iddoador' AND clube='$clube' AND entrega_doador=1 AND id_solicitante>0";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);

if($totalRows_lish > 0){
	echo "<script>javascript:alert('Este doador já realizou uma doação!');javascript:window.location='doadores-cr.php'</script>";
}else{
	$sql = "UPDATE rfa_cr_doador SET entrega_doador='$statusentrega' WHERE clube='$clube' AND id_doador='$iddoador';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='doadores-cr.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>