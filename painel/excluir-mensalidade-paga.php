<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$codmens = $_GET['cod_mens'];
$club = $_GET['clube'];
$status = 0;

$q = "SELECT * FROM rfa_bancos WHERE clube='$club' AND conta_mensalidade='1'";
$pegacp = mysqli_query($link, $q) or die(mysqli_error($link));
$row_pegacp = mysqli_fetch_assoc($pegacp);	
$totalRows_pegacp = mysqli_num_rows($pegacp);

if($totalRows_pegacp <= 0){
		echo "<script>javascript:alert('Não há uma conta principal cadastrada! Você será redirecionado para criar uma conta...');javascript:window.location='banco.php'</script>";
}else{

	$sql = "UPDATE rfa_mensalidades SET pagamento = '$status' WHERE cod_mensalidade='$codmens' AND clube='$club';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Esta mensalidade paga foi removida com sucesso!');javascript:window.location='mensalidades-pagas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

}
?>