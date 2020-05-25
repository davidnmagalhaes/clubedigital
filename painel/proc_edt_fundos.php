<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$por = mysqli_real_escape_string($link,$_POST['por']);
$idfundo = mysqli_real_escape_string($link,$_POST['idfundo']);
$origem = mysqli_real_escape_string($link,$_POST['origem_fundo']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao_fundo']);
$data = mysqli_real_escape_string($link,$_POST['data_fundo']);
$status = mysqli_real_escape_string($link,$_POST['status_fundo']);
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$datacadastro = date('Y-m-d');

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_fundo']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_fundos SET origem_fundo='$origem', descricao_fundo='$descricao', data_fundo='$data', status_fundo='$status', valor_fundo='$valorat', por_fundo='$por', user='$user', data_cadastro='$datacadastro', clube='$club' WHERE clube='$club' AND id_fundo='$idfundo';";
	

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua conta de fundo foi modificada com sucesso!');javascript:window.location='fundos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>