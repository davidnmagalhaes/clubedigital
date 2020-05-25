<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$acao = $_POST['tipoacao'];
$club = $_POST['clube'];
$checklist = $_POST['checklist'];

if($acao == 1){

	foreach($checklist as $check){
	$sql .= "DELETE FROM rfa_prev_fundos WHERE id_prev_fundos='$check' AND clube='$club';";

	//$link->close();
	}

	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Os fundos previstos selecionadas foram removidos com sucesso!');javascript:window.location='previsao_fundos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}
}elseif($acao == 2){

	foreach($checklist as $check){
	$query = "SELECT * FROM rfa_prev_fundos WHERE clube='$club' AND id_prev_fundos='$check'";
	$lis = mysqli_query($link, $query) or die(mysqli_error($link));
	$row_lis = mysqli_fetch_assoc($lis);

	$descricao = $row_lis['desc_prev_fundos'];
	$data = $row_lis['data_prev_fundos'];
	$valor = $row_lis['valor_prev_fundos'];

	$sql .= "INSERT INTO rfa_prev_fundos (desc_prev_fundos, data_prev_fundos, valor_prev_fundos, clube) VALUES ('$descricao', '$data', '$valor', '$club');";
	}

	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='previsao_fundos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

}else{
	echo "<script>javascript:alert('Você não selecionou fundos!');javascript:window.location='previsao_fundos.php'</script>";

}
?>