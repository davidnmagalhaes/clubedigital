<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idretiradas = $_GET['idretiradas'];
$club = $_GET['clube'];

$query = "SELECT * FROM rfa_prev_retiradas WHERE clube='$club' AND id_prev_retiradas='$idretiradas'";
$lis = mysqli_query($link, $query) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);

$descricao = $row_lis['desc_prev_retiradas'];
$data = $row_lis['data_prev_retiradas'];
$valor = $row_lis['valor_prev_retiradas'];

	$sql = "INSERT INTO rfa_prev_retiradas (desc_prev_retiradas, data_prev_retiradas, valor_prev_retiradas, clube) VALUES ('$descricao', '$data', '$valor', '$club');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='previsao_retiradas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>