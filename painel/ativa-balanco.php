<?php 
//Conexão com banco de dados
include_once("config.php");

$balanco = mysqli_real_escape_string($link,$_POST['balanco']);
$clube = mysqli_real_escape_string($link,$_POST['clube']);

if($balanco == 1){
$ativo = "Habilitado";
}else{
$ativo = "Desabilitado";
}

	$sql = "UPDATE rfa_clubes SET balanco='$balanco' WHERE id_clube='$clube';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('O balanço foi ".$ativo." no site!');javascript:window.location='home'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>