<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$idservico = mysqli_real_escape_string($link,$_POST['idservico']);

//Informações
$diaservico = mysqli_real_escape_string($link,$_POST['dia_comunidade']);
$messervico = mysqli_real_escape_string($link,$_POST['mes_comunidade']);
$nomeservico = mysqli_real_escape_string($link,$_POST['nome_servico']);

$sql = "UPDATE rfa_servicos_comunidade SET dia_servico = '$diaservico', mes_servico='$messervico', nome_servico='$nomeservico' WHERE id_servico='$idservico' AND clube='$club';";
	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Serviço à comunidade atualizado com sucesso!');javascript:window.location='servicos-comunidade.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>