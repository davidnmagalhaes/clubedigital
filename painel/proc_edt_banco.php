<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de banco.php*/
$idconta = mysqli_real_escape_string($link,$_POST['id_conta']);

$favorecido = mysqli_real_escape_string($link,$_POST['favorecido']);
$agencia = mysqli_real_escape_string($link,$_POST['agencia']);
$n_conta = mysqli_real_escape_string($link,$_POST['n_conta']);
$contamensalidade = mysqli_real_escape_string($link,$_POST['conta-mensalidade']);
$cnpj = mysqli_real_escape_string($link,$_POST['cnpj']);
$saldo = mysqli_real_escape_string($link,str_replace('.','',$_POST['saldo']));
$saldoat = str_replace(',','.',$saldo);
$banco = mysqli_real_escape_string($link,$_POST['banco']);
$tipoconta = mysqli_real_escape_string($link,$_POST['tipoconta']);
$club = mysqli_real_escape_string($link,$_POST['club']);

// Verifica se o tipo de pessoa é física ou jurídica para atualizar cpf ou cnpj

$sql = "SELECT * FROM rfa_bancos WHERE clube='$club' AND conta_mensalidade='1' AND cod_banco <> '$idconta'";
$vercon = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_vercon = mysqli_fetch_assoc($vercon);

if($contamensalidade == 1){
$totalRows_vercon = mysqli_num_rows($vercon);
}else{
$totalRows_vercon = 0;
}

if($totalRows_vercon > 0){
			echo "<script>javascript:alert('Outra conta já está vinculada para saques das mensalidades!');javascript:window.location='banco.php'</script>";
}else{
	$sql = "UPDATE rfa_bancos SET favorecido = '$favorecido', agencia = '$agencia', n_conta = '$n_conta', cnpj = '$cnpj', saldo = '$saldoat', banco = '$banco', tipo_conta = '$tipoconta', conta_mensalidade='$contamensalidade' WHERE cod_banco = '$idconta';";


	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Atualização de conta bancária realizada com sucesso!');javascript:window.location='banco.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>