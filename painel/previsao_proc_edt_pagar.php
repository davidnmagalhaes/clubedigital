<?php 
//Conexão com banco de dados
include_once("config.php");

$idpagar = $_POST['idpagar'];
$club = $_POST['club'];

/*Recebe as variáveis de cd_banco.php*/
$descricao = mysqli_real_escape_string($link,$_POST['descricao_pagar']);
$data = mysqli_real_escape_string($link,$_POST['data_pagar']);
$categoria = mysqli_real_escape_string($link,$_POST['categoria']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_pagar']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_prev_pagar SET cat_prev_pagar='$categoria', desc_prev_pagar='$descricao', data_prev_pagar='$data', valor_prev_pagar='$valorat' WHERE clube='$club' AND id_prev_pagar='$idpagar';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Atualização realizada com sucesso!');javascript:window.location='previsao_pagar.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>