<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idfundo = $_GET['idfundo'];
$club = $_GET['clube'];

$qr = "SELECT * FROM rfa_fundos WHERE clube='$club' AND id_fundo='$idfundo'";
$pegavalor = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_pegavalor = mysqli_fetch_assoc($pegavalor);
$valorpag = $row_pegavalor['valor_fundo'];
$conta = $row_pegavalor['origem_fundo'];
$status = $row_pegavalor['status_fundo'];

	$sql = "DELETE FROM rfa_fundos WHERE id_fundo='$idfundo';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua conta de fundo foi removida com sucesso!');javascript:window.location='fundos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>