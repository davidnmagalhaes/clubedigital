<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/

$favorecido = mysqli_real_escape_string($link, $_POST['favorecido']);
$agencia = mysqli_real_escape_string($link, $_POST['agencia']);
$n_conta = mysqli_real_escape_string($link, $_POST['n_conta']);
$contamensalidade = mysqli_real_escape_string($link,$_POST['conta-mensalidade']);

$cnpj = mysqli_real_escape_string($link,$_POST['cnpj']);
$saldo = mysqli_real_escape_string($link,str_replace('.','',$_POST['saldo']));
$saldoat = mysqli_real_escape_string($link,str_replace(',','.',$saldo));
$banco = mysqli_real_escape_string($link,$_POST['banco']);
$tipoconta = mysqli_real_escape_string($link,$_POST['tipoconta']);
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$ativo = 1;
$datacadastro = date('Y-m-d');

// Verifica se o tipo de pessoa é física ou jurídica para inserir cpf ou cnpj
$sql = "SELECT * FROM rfa_bancos WHERE clube='$club' AND conta_mensalidade='1'";
$vercon = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_vercon = mysqli_fetch_assoc($vercon);
$totalRows_vercon = mysqli_num_rows($vercon);

if($contamensalidade == 1 && $totalRows_vercon > 0){
			echo "<script>javascript:alert('Você já tem uma conta vinculada para o recebimento das mensalidades! Desvincule a outra conta para vincular esta.');javascript:window.location='cd_banco.php'</script>";
}else{
	$codbanco = rand();
	$sql = "INSERT INTO rfa_bancos (cod_banco,favorecido, agencia, n_conta, cnpj, saldo, banco, tipo_conta, ativo, user, data_cadastro, clube, conta_mensalidade) VALUES ('$codbanco','$favorecido', '$agencia', '$n_conta', '$cnpj', '$saldoat', '$banco', '$tipoconta', '$ativo', '$user','$datacadastro', '$club', '$contamensalidade');";


	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de conta bancária realizado com sucesso!');javascript:window.location='banco.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>