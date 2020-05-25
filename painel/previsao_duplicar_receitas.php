<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idreceitas = $_GET['idreceitas'];
$club = $_GET['clube'];

$query = "SELECT * FROM rfa_prev_receitas WHERE clube='$club' AND id_prev_receitas='$idreceitas'";
$lis = mysqli_query($link, $query) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);

$descricao = $row_lis['desc_prev_receitas'];
$data = $row_lis['data_prev_receitas'];
$valor = $row_lis['valor_prev_receitas'];

	$sql = "INSERT INTO rfa_prev_receitas (desc_prev_receitas, data_prev_receitas, valor_prev_receitas, clube) VALUES ('$descricao', '$data', '$valor', '$club');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='previsao_receitas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>