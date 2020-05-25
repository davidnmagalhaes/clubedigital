<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);

/*Recebe as variáveis de cd_banco.php*/
$descricao = mysqli_real_escape_string($link,$_POST['descricao_pagar']);
$data = mysqli_real_escape_string($link,$_POST['data_pagar']);
$categoria = mysqli_real_escape_string($link,$_POST['categoria']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_pagar']));
$valorat = str_replace(',','.',$valor);


	$sql = "INSERT INTO rfa_prev_pagar (cat_prev_pagar, desc_prev_pagar, data_prev_pagar, valor_prev_pagar, clube) VALUES ('$categoria','$descricao', '$data', '$valorat', '$club');";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de despesa prevista realizado com sucesso!');javascript:window.location='previsao_pagar.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>