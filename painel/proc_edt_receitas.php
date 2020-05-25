<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$por = mysqli_real_escape_string($link,$_POST['por']);
$idreceitas = mysqli_real_escape_string($link,$_POST['idreceitas']);
$destino = mysqli_real_escape_string($link,$_POST['destino_receita']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao_receita']);
$data = mysqli_real_escape_string($link,$_POST['data_receita']);
$status = mysqli_real_escape_string($link,$_POST['status_receita']);
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$datacadastro = date('Y-m-d');

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_receita']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_receitas SET destino_receita='$destino', descricao_receita='$descricao', data_receita='$data', status_receita='$status', valor_receita='$valorat', por_receita='$por', user='$user', data_cadastro='$datacadastro', clube='$club' WHERE clube='$club' AND id_receitas='$idreceitas';";
	

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua receita foi modificada com sucesso!');javascript:window.location='receitas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>