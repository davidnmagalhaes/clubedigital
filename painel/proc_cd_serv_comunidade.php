<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);

//Informações
$diaservico = mysqli_real_escape_string($link,$_POST['dia_comunidade']);
$messervico = mysqli_real_escape_string($link,$_POST['mes_comunidade']);
$nomeservico = mysqli_real_escape_string($link,$_POST['nome_servico']);

$sql = "INSERT INTO rfa_servicos_comunidade (teste,dia_servico, mes_servico, nome_servico, clube) VALUES (now(),'$diaservico', '$messervico', '$nomeservico', '$club');";

	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Serviço à comunidade cadastrado com sucesso!');javascript:window.location='servicos-comunidade.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>