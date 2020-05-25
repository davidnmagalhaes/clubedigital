<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);

/*Recebe as variáveis de cd_banco.php*/
$descricao = mysqli_real_escape_string($link,$_POST['descricao_fundos']);
$data = mysqli_real_escape_string($link,$_POST['data_fundos']);
$categoria = mysqli_real_escape_string($link,$_POST['categoria']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_fundos']));
$valorat = str_replace(',','.',$valor);


	$sql = "INSERT INTO rfa_prev_fundos (cat_prev_fundos, desc_prev_fundos, data_prev_fundos, valor_prev_fundos, clube) VALUES ('$categoria','$descricao', '$data', '$valorat', '$club');";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de fundo previsto realizado com sucesso!');javascript:window.location='previsao_fundos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>