<?php 
//Conexão com banco de dados
include_once("config.php");

$user = $_POST['user'];
$club = $_POST['club'];

$qv = "SELECT * FROM rfa_bancos WHERE clube='$club' AND conta_mensalidade='1'";
$verifica = mysqli_query($link, $qv) or die(mysqli_error($link));
$row_verifica = mysqli_fetch_assoc($verifica);	
$totalRows_verifica = mysqli_num_rows($verifica);

if($totalRows_verifica <= 0){echo "<script>javascript:alert('Não há uma conta bancária cadastrada! Você será redirecionado para cadastrar em conta...');javascript:window.location='cd_banco.php'</script>";
}else{
/*Recebe as variáveis de cd_banco.php*/
$por = $_POST['por'];
$destino = $_POST['destino_receber'];
$descricao = $_POST['descricao_receber'];
$data = $_POST['data_receber'];
$status = $_POST['status_receber'];

$datacadastro = date('Y-m-d');

$valor = str_replace('.','',$_POST['valor_receber']);
$valorat = str_replace(',','.',$valor);


	$sql = "INSERT INTO rfa_receber (destino_receber, descricao_receber, data_receber, status_receber, valor_receber, por_receber, user, data_cadastro, clube) VALUES ('$destino', '$descricao', '$data', '$status', '$valorat', '$por', '$user', '$datacadastro', '$club');";
	
	if($status == 2){
	$query = "SELECT * FROM rfa_bancos WHERE clube='$club' AND id_conta='$destino'";
	$pegasaldo = mysqli_query($link, $query) or die(mysqli_error($link));
	$row_pegasaldo = mysqli_fetch_assoc($pegasaldo);	
	$saldoatualizado = $row_pegasaldo['saldo'] + $valorat;
	
	$sql .= "UPDATE rfa_bancos SET saldo='$saldoatualizado' WHERE clube='$club' AND id_conta='$destino'";
	}

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de conta a receber realizado com sucesso!');javascript:window.location='a-receber.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>