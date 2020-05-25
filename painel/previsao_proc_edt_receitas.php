<?php 
//Conexão com banco de dados
include_once("config.php");

$idreceitas = $_POST['idreceitas'];
$club = $_POST['club'];

/*Recebe as variáveis de cd_banco.php*/
$descricao = mysqli_real_escape_string($link,$_POST['descricao_receita']);
$data = mysqli_real_escape_string($link,$_POST['data_receita']);
$categoria = mysqli_real_escape_string($link,$_POST['categoria']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_receita']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_prev_receitas SET cat_prev_receitas='$categoria', desc_prev_receitas='$descricao', data_prev_receitas='$data', valor_prev_receitas='$valorat' WHERE clube='$club' AND id_prev_receitas='$idreceitas';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Atualização realizada com sucesso!');javascript:window.location='previsao_receitas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>