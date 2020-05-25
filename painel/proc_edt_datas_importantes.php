<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$idservico = mysqli_real_escape_string($link,$_POST['idservico']);

//Informações
$diaservico = mysqli_real_escape_string($link,$_POST['dia_importante']);
$messervico = mysqli_real_escape_string($link,$_POST['mes_importante']);
$nomeservico = mysqli_real_escape_string($link,$_POST['nome_servico']);

$sql = "UPDATE rfa_datas_importantes SET dia_data_imp = '$diaservico', mes_data_imp='$messervico', nome_data_imp='$nomeservico' WHERE id_data_imp='$idservico' AND clube='$club';";
	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Data Importante atualizada com sucesso!');javascript:window.location='datas-importantes.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>