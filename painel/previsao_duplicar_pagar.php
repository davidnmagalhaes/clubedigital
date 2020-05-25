<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idpagar = $_GET['idpagar'];
$club = $_GET['clube'];

$query = "SELECT * FROM rfa_prev_pagar WHERE clube='$club' AND id_prev_pagar='$idpagar'";
$lis = mysqli_query($link, $query) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);

$descricao = $row_lis['desc_prev_pagar'];
$data = $row_lis['data_prev_pagar'];
$valor = $row_lis['valor_prev_pagar'];

	$sql = "INSERT INTO rfa_prev_pagar (desc_prev_pagar, data_prev_pagar, valor_prev_pagar, clube) VALUES ('$descricao', '$data', '$valor', '$club');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='previsao_pagar.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>