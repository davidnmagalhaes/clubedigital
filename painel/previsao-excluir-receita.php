<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idreceitas = $_GET['idreceitas'];
$club = $_GET['clube'];

	$sql = "DELETE FROM rfa_prev_receitas WHERE id_prev_receitas='$idreceitas';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua receita prevista foi removida com sucesso!');javascript:window.location='previsao_receitas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>