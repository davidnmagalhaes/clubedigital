<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$por = $_POST['por'];
$idreceber = $_POST['idreceber'];
$destino = $_POST['destino_receber'];
$descricao = $_POST['descricao_receber'];
$data = $_POST['data_receber'];
$status = $_POST['status_receber'];
$user = $_POST['user'];
$club = $_POST['club'];
$datacadastro = date('Y-m-d');

$valor = str_replace('.','',$_POST['valor_receber']);
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_receber SET destino_receber='$destino', descricao_receber='$descricao', data_receber='$data', status_receber='$status', valor_receber='$valorat', por_receber='$por', user='$user', data_cadastro='$datacadastro', clube='$club' WHERE clube='$club' AND id_receber='$idreceber';";
	
	if($status == 2){
	$query = "SELECT * FROM rfa_bancos WHERE clube='$club' AND id_conta='$destino'";
	$pegasaldo = mysqli_query($link, $query) or die(mysqli_error($link));
	$row_pegasaldo = mysqli_fetch_assoc($pegasaldo);	
	$saldoatualizado = $row_pegasaldo['saldo'] + $valorat;
	
	$sql .= "UPDATE rfa_bancos SET saldo='$saldoatualizado' WHERE clube='$club' AND id_conta='$destino'";
	}

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua conta a receber foi modificada com sucesso!');javascript:window.location='a-receber.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>