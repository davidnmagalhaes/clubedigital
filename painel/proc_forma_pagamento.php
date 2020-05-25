<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$emailpagseguro = mysqli_real_escape_string($link,$_POST['emailpagseguro']);
$tokenpagseguro = mysqli_real_escape_string($link,$_POST['tokenpagseguro']);
$sandbox = $_POST['sandbox'];

	$sql = "UPDATE rfa_config_pagseguro SET email_pagseguro='$emailpagseguro', token_pagseguro='$tokenpagseguro', sandbox_pagseguro='$sandbox' WHERE id_pagseguro='1';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Configurações atualizadas com sucesso!');javascript:window.location='formas-de-pagamento.php'</script>";
	
	} else {
		echo "<script>javascript:alert('Erro: ".$sql." | ".$link->error.". Procure nosso suporte!');javascript:window.location='formas-de-pagamento.php'</script>";

	}

	$link->close();

?>