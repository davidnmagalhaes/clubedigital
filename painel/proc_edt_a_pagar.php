<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$por = mysqli_real_escape_string($link,$_POST['por']);
$idpagar = mysqli_real_escape_string($link,$_POST['idpagar']);
$origem = mysqli_real_escape_string($link,$_POST['origem_pagar']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao_pagar']);
$data = mysqli_real_escape_string($link,$_POST['data_pagar']);
$status = mysqli_real_escape_string($link,$_POST['status_pagar']);
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$datacadastro = date('Y-m-d');

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_pagar']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_pagar SET origem_pagar='$origem', descricao_pagar='$descricao', data_pagar='$data', status_pagar='$status', valor_pagar='$valorat', por_pagar='$por', user='$user', data_cadastro='$datacadastro', clube='$club' WHERE clube='$club' AND id_pagar='$idpagar';";
	

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua conta a pagar foi modificada com sucesso!');javascript:window.location='a-pagar.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>