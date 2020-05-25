<?php 
//Conexão com banco de dados
include_once("config.php");

$idfundos = $_POST['idfundos'];
$club = $_POST['club'];

/*Recebe as variáveis de cd_banco.php*/
$descricao = mysqli_real_escape_string($link,$_POST['descricao_fundos']);
$data = mysqli_real_escape_string($link,$_POST['data_fundos']);
$categoria = mysqli_real_escape_string($link,$_POST['categoria']);

$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_fundos']));
$valorat = str_replace(',','.',$valor);


	$sql = "UPDATE rfa_prev_fundos SET cat_prev_fundos='$categoria', desc_prev_fundos='$descricao', data_prev_fundos='$data', valor_prev_fundos='$valorat' WHERE clube='$club' AND id_prev_fundos='$idfundos';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Atualização realizada com sucesso!');javascript:window.location='previsao_fundos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>