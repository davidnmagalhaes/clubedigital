<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idpagar = $_GET['idpagar'];
$club = $_GET['clube'];

	$sql = "DELETE FROM rfa_prev_pagar WHERE id_prev_pagar='$idpagar';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua despesa prevista foi removida com sucesso!');javascript:window.location='previsao_pagar.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>