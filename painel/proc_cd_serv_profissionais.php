<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);

//Informações
$diaservico = mysqli_real_escape_string($link,$_POST['dia_profissionais']);
$messervico = mysqli_real_escape_string($link,$_POST['mes_profissionais']);
$nomeservico = mysqli_real_escape_string($link,$_POST['nome_profissionais']);

$sql = "INSERT INTO rfa_servicos_profissionais (dia_prof, mes_prof, nome_prof, clube) VALUES ('$diaservico', '$messervico', '$nomeservico', '$club');";

	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Serviço Profissional cadastrado com sucesso!');javascript:window.location='servicos-profissionais.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>