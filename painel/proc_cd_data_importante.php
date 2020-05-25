<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);

//Informações
$diaservico = mysqli_real_escape_string($link,$_POST['dia_importante']);
$messervico = mysqli_real_escape_string($link,$_POST['mes_importante']);
$nomeservico = mysqli_real_escape_string($link,$_POST['nome_importante']);

$sql = "INSERT INTO rfa_datas_importantes (dia_data_imp, mes_data_imp, nome_data_imp, clube) VALUES ('$diaservico', '$messervico', '$nomeservico', '$club');";

	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Data Importante cadastrada com sucesso!');javascript:window.location='datas-importantes.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>