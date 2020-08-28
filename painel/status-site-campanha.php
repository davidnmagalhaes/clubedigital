<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idcampanha = mysqli_real_escape_string($link,$_POST['idcampanha']);
$statussite = mysqli_real_escape_string($link,$_POST['statussite']);

$clube = mysqli_real_escape_string($link,$_POST['clube']);

$qrh = "SELECT * FROM rfa_campanhas WHERE clube='$clube' AND ativo='1'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);

	$sql = "UPDATE rfa_campanhas SET ativo='$statussite' WHERE cod_campanha='$idcampanha' AND clube='$clube';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Status atualizado com sucesso!');javascript:window.location='campanhas'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>