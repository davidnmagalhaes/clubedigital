<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idreceber = $_GET['idreceber'];
$club = $_GET['clube'];

$qr = "SELECT * FROM rfa_receber WHERE clube='$club' AND id_receber='$idreceber'";
$pegavalor = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_pegavalor = mysqli_fetch_assoc($pegavalor);
$valorrec = $row_pegavalor['valor_receber'];
$conta = $row_pegavalor['destino_receber'];
$status = $row_pegavalor['status_receber'];

	$sql = "DELETE FROM rfa_receber WHERE id_receber='$idreceber';";
	
	if($status == 2){
	$query = "SELECT * FROM rfa_bancos WHERE clube='$club' AND id_conta='$conta'";
	$pegasaldo = mysqli_query($link, $query) or die(mysqli_error($link));
	$row_pegasaldo = mysqli_fetch_assoc($pegasaldo);	
	$saldoatualizado = $row_pegasaldo['saldo'] - $valorrec;
	
	$sql .= "UPDATE rfa_bancos SET saldo='$saldoatualizado' WHERE clube='$club' AND id_conta='$conta';";
	}

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua conta a receber foi removida com sucesso!');javascript:window.location='a-receber.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>