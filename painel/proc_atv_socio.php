<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$atv = mysqli_real_escape_string($link,$_POST['atv']);
$idsoc = mysqli_real_escape_string($link,$_POST['idsoc']);

	$sql = "UPDATE rfs_socios SET ativo = '$atv' WHERE id_socio = '$idsoc';";


	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='socios.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>