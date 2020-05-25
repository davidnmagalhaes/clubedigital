<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idconsorcio = mysqli_real_escape_string($link,$_POST['idconsorcio']);
$statussite = mysqli_real_escape_string($link,$_POST['statussite']);

$clube = mysqli_real_escape_string($link,$_POST['clube']);

$qrh = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND status_site='1'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);

if($totalRows_lish > 0 && $statussite == 1){
	echo "<script>javascript:alert('Não é permitido habilitar dois consórcios! Desabilite o consórcio habilitado para que possa habilitar outro.');javascript:window.location='consorcio'</script>";
}else{

	$sql = "UPDATE rfa_consorcio SET status_site='$statussite' WHERE cod_consorcio='$idconsorcio' AND clube='$clube';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Status atualizado com sucesso!');javascript:window.location='consorcio'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>