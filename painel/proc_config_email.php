<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$host = mysqli_real_escape_string($link,$_POST['host']);
$username = mysqli_real_escape_string($link,$_POST['username']);
$password = mysqli_real_escape_string($link,$_POST['password']);
$emailsmtp = mysqli_real_escape_string($link,$_POST['emailsmtp']);
$publickey = mysqli_real_escape_string($link,$_POST['publickey']);
$secretkey = mysqli_real_escape_string($link,$_POST['secretkey']);

	$sql = "UPDATE rfa_config_email SET host='$host', username='$username', password='$password', email_smtp='$emailsmtp', publickey_recaptcha='$publickey', secretkey_recaptcha='$secretkey' WHERE id_config='1';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Configurações atualizadas com sucesso!');javascript:window.location='config-envio-email.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>