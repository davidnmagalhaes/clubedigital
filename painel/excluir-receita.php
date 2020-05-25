<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idreceitas = $_GET['idreceitas'];
$club = $_GET['clube'];

$qr = "SELECT * FROM rfa_receitas WHERE clube='$club' AND id_receitas='$idreceitas'";
$pegavalor = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_pegavalor = mysqli_fetch_assoc($pegavalor);
$valorrec = $row_pegavalor['valor_receita'];
$conta = $row_pegavalor['destino_receita'];
$status = $row_pegavalor['status_receita'];

	$sql = "DELETE FROM rfa_receitas WHERE id_receitas='$idreceitas';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua receita foi removida com sucesso!');javascript:window.location='receitas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>