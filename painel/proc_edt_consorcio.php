<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$clube = mysqli_real_escape_string($link,$_POST['clube']);
$idconsorcio = mysqli_real_escape_string($link,$_POST['idconsorcio']);
$nomeconsorcio = mysqli_real_escape_string($link,$_POST['nomeconsorcio']);


	$sql = "UPDATE rfa_consorcio SET nome_consorcio='$nomeconsorcio' WHERE clube='$clube' AND cod_consorcio='$idconsorcio'";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Consórcio atualizado com sucesso!');javascript:window.location='consorcio".$clube."'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>