<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);

$qv = "SELECT * FROM rfa_bancos WHERE clube='$club' AND conta_mensalidade='1'";
$verifica = mysqli_query($link, $qv) or die(mysqli_error($link));
$row_verifica = mysqli_fetch_assoc($verifica);	
$totalRows_verifica = mysqli_num_rows($verifica);

if($totalRows_verifica <= 0){echo "<script>javascript:alert('Não há uma conta bancária principal cadastrada! Você será redirecionado para cadastrar em conta...');javascript:window.location='cd_banco.php'</script>";
}else{
/*Recebe as variáveis de cd_banco.php*/
$por = mysqli_real_escape_string($link,$_POST['por']);
$destino = mysqli_real_escape_string($link,$_POST['destino_receita']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao_receita']);
$data = mysqli_real_escape_string($link,$_POST['data_receita']);
$status = mysqli_real_escape_string($link,$_POST['status_receita']);

$datacadastro = date('Y-m-d');

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_receita']));
$valorat = str_replace(',','.',$valor);


	$sql = "INSERT INTO rfa_receitas (destino_receita, descricao_receita, data_receita, status_receita, valor_receita, por_receita, user, data_cadastro, clube) VALUES ('$destino', '$descricao', '$data', '$status', '$valorat', '$por', '$user', '$datacadastro', '$club');";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de receita realizado com sucesso!');javascript:window.location='receitas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>