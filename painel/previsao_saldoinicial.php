<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['clube']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['saldoinicial']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_prev_fixas SET saldo_inicial='$valorat' WHERE clube='$club';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Saldo inicial atualizado com sucesso!');javascript:window.location='previsao.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>