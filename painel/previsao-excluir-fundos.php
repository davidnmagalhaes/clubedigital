<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idfundos = $_GET['idfundos'];
$club = $_GET['clube'];

	$sql = "DELETE FROM rfa_prev_fundos WHERE id_prev_fundos='$idfundos';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('O fundo previsto foi removido com sucesso!');javascript:window.location='previsao_fundos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>