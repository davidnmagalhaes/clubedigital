<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);

/*Recebe as variáveis de cd_banco.php*/
$descricao = mysqli_real_escape_string($link,$_POST['descricao_receita']);
$data = mysqli_real_escape_string($link,$_POST['data_receita']);
$categoria = mysqli_real_escape_string($link,$_POST['categoria']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_receita']));
$valorat = str_replace(',','.',$valor);


	$sql = "INSERT INTO rfa_prev_receitas (cat_prev_receitas, desc_prev_receitas, data_prev_receitas, valor_prev_receitas, clube) VALUES ('$categoria','$descricao', '$data', '$valorat', '$club');";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de receita prevista realizado com sucesso!');javascript:window.location='previsao_receitas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>