<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$cambio = mysqli_real_escape_string($link,str_replace(',','.',$_POST['cambio']));

$data = date('Y-m-d');
$hora = date('H:i:s');

	$sql = "UPDATE rfa_config_cambio SET valor_cambio='$cambio', data_atualizacao='$data', hora_atualizacao='$hora' WHERE id_cambio='1';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Câmbio atualizado com sucesso!');javascript:window.location='home.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>