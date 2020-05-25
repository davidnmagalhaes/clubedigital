<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idretiradas = $_GET['idretiradas'];
$club = $_GET['clube'];

	$sql = "DELETE FROM rfa_prev_retiradas WHERE id_prev_retiradas='$idretiradas';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('A retirada prevista foi removida com sucesso!');javascript:window.location='previsao_retiradas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>