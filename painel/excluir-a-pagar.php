<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idpagar = $_GET['idpagar'];
$club = $_GET['clube'];

$qr = "SELECT * FROM rfa_pagar WHERE clube='$club' AND id_pagar='$idpagar'";
$pegavalor = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_pegavalor = mysqli_fetch_assoc($pegavalor);
$valorpag = $row_pegavalor['valor_pagar'];
$conta = $row_pegavalor['origem_pagar'];
$status = $row_pegavalor['status_pagar'];

	$sql = "DELETE FROM rfa_pagar WHERE id_pagar='$idpagar';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua conta a pagar foi removida com sucesso!');javascript:window.location='a-pagar.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>