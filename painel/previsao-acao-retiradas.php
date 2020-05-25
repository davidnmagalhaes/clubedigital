<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$acao = $_POST['tipoacao'];
$club = $_POST['clube'];
$checklist = $_POST['checklist'];

if($acao == 1){

	foreach($checklist as $check){
	$sql .= "DELETE FROM rfa_prev_retiradas WHERE id_prev_retiradas='$check' AND clube='$club';";

	//$link->close();
	}

	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('As retiradas previstas selecionadas foram removidos com sucesso!');javascript:window.location='previsao_retiradas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}
}elseif($acao == 2){

	foreach($checklist as $check){
	$query = "SELECT * FROM rfa_prev_retiradas WHERE clube='$club' AND id_prev_retiradas='$check'";
	$lis = mysqli_query($link, $query) or die(mysqli_error($link));
	$row_lis = mysqli_fetch_assoc($lis);

	$descricao = $row_lis['desc_prev_retiradas'];
	$data = $row_lis['data_prev_retiradas'];
	$valor = $row_lis['valor_prev_retiradas'];

	$sql .= "INSERT INTO rfa_prev_retiradas (desc_prev_retiradas, data_prev_retiradas, valor_prev_retiradas, clube) VALUES ('$descricao', '$data', '$valor', '$club');";
	}

	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='previsao_retiradas.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

}else{
	echo "<script>javascript:alert('Você não selecionou retiradas!');javascript:window.location='previsao_retiradas.php'</script>";

}
?>