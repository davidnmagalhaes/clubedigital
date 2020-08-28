<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$por = mysqli_real_escape_string($link,$_POST['por']);
$idretirada = mysqli_real_escape_string($link,$_POST['idretirada']);
$origem = mysqli_real_escape_string($link,$_POST['origem_retirada']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao_retirada']);
$data = mysqli_real_escape_string($link,$_POST['data_retirada']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$datacadastro = date('Y-m-d');

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_retirada']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_retirada SET origem_retirada='$origem', descricao_retirada='$descricao', data_retirada='$data', valor_retirada='$valorat', por_retirada='$por', data_cadastro='$datacadastro' WHERE clube='$club' AND id_retirada='$idretirada';";
	

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Retirada modificada com sucesso!');javascript:window.location='retiradas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>