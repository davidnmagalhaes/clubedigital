<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$atv = mysqli_real_escape_string($link,$_POST['atv']);
$iduser = mysqli_real_escape_string($link,$_POST['iduser']);

	$sql = "UPDATE rfa_usuario SET status = '$atv' WHERE id_usuario = '$iduser';";


	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='equipe'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>