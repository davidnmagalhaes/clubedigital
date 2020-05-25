<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$atv = mysqli_real_escape_string($link,$_POST['atv']);
$idplan = mysqli_real_escape_string($link,$_POST['idplan']);

	$sql = "UPDATE rfa_planos SET ativo_plano = '$atv' WHERE id_plano = '$idplan';";


	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='planos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>