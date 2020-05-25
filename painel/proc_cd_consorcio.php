<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$nomeconsorcio = mysqli_real_escape_string($link,$_POST['nomeconsorcio']);
$datainicial = mysqli_real_escape_string($link,$_POST['datainicial']);
$datafinal = mysqli_real_escape_string($link,$_POST['datafinal']);
$diavencimento = mysqli_real_escape_string($link,$_POST['diavencimento']);

$valorconsorcio = mysqli_real_escape_string($link,str_replace(',','.',$_POST['valorconsorcio']));

$codconsorcio = date('ymdHis').rand(10,99);
$clube = mysqli_real_escape_string($link,$_POST['clube']);

	$sql = "INSERT INTO rfa_consorcio (dia_vencimento, cod_consorcio, nome_consorcio, data_inicial, data_final, valor_consorcio, clube) VALUES ('$diavencimento','$codconsorcio','$nomeconsorcio', '$datainicial','$datafinal','$valorconsorcio', '$clube');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Consórcio cadastrado com sucesso!');javascript:window.location='consorcio'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>