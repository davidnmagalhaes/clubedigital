<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idretirada = $_GET['idretirada'];
$club = $_GET['clube'];

	$sql = "DELETE FROM rfa_retirada WHERE id_retirada='$idretirada';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('A retirada foi removida e o valor foi devolvido com sucesso!');javascript:window.location='retiradas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>