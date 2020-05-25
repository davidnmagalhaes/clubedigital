<?php 
//Conexão com banco de dados
include_once("config.php");

$idretiradas = $_POST['idretiradas'];
$club = $_POST['club'];

/*Recebe as variáveis de cd_banco.php*/
$descricao = mysqli_real_escape_string($link,$_POST['descricao_retiradas']);
$data = mysqli_real_escape_string($link,$_POST['data_retiradas']);
$categoria = mysqli_real_escape_string($link,$_POST['categoria']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_retiradas']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_prev_retiradas SET desc_prev_retiradas='$descricao', data_prev_retiradas='$data', valor_prev_retiradas='$valorat' WHERE clube='$club' AND id_prev_retiradas='$idretiradas';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Atualização realizada com sucesso!');javascript:window.location='previsao_retiradas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>