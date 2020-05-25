<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);

/*Recebe as variáveis de cd_banco.php*/
$descricao = mysqli_real_escape_string($link,$_POST['descricao_retiradas']);
$data = mysqli_real_escape_string($link,$_POST['data_retiradas']);
$categoria = mysqli_real_escape_string($link,$_POST['categoria']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_retiradas']));
$valorat = str_replace(',','.',$valor);


	$sql = "INSERT INTO rfa_prev_retiradas (desc_prev_retiradas, data_prev_retiradas, valor_prev_retiradas, clube) VALUES ('$descricao', '$data', '$valorat', '$club');";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de retiradas previstas realizado com sucesso!');javascript:window.location='previsao_retiradas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>