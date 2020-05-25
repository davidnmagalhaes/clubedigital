<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idfundos = $_GET['idfundos'];
$club = $_GET['clube'];

$query = "SELECT * FROM rfa_prev_fundos WHERE clube='$club' AND id_prev_fundos='$idfundos'";
$lis = mysqli_query($link, $query) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);

$descricao = $row_lis['desc_prev_fundos'];
$data = $row_lis['data_prev_fundos'];
$valor = $row_lis['valor_prev_fundos'];

	$sql = "INSERT INTO rfa_prev_fundos (desc_prev_fundos, data_prev_fundos, valor_prev_fundos, clube) VALUES ('$descricao', '$data', '$valor', '$club');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='previsao_fundos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>