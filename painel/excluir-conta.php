<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idconta = $_GET['id_conta'];
$club = $_GET['clube'];


	$sql = "DELETE FROM rfa_bancos WHERE cod_banco='$idconta';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Conta removida com sucesso!');javascript:window.location='banco.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>