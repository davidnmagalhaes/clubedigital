<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$idservico = mysqli_real_escape_string($link,$_POST['idservico']);

//Informações
$diaservico = mysqli_real_escape_string($link,$_POST['dia_profissional']);
$messervico = mysqli_real_escape_string($link,$_POST['mes_profissional']);
$nomeservico = mysqli_real_escape_string($link,$_POST['nome_servico']);

$sql = "UPDATE rfa_servicos_profissionais SET dia_prof = '$diaservico', mes_prof='$messervico', nome_prof='$nomeservico' WHERE id_prof='$idservico' AND clube='$club';";
	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Serviço Profissional atualizado com sucesso!');javascript:window.location='servicos-profissionais.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>