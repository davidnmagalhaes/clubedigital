<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$nomeplan = mysqli_real_escape_string($link,$_POST['nomeplano']);
$valormens = mysqli_real_escape_string($link,str_replace('.','',$_POST['valormensalidade']));
$valormes = str_replace(',','.',$valormens);
$ativo = 1;

	$sql = "INSERT INTO rfa_planos (nome_plano, valor_plano, ativo_plano) VALUES ('$nomeplan', '$valormes', '$ativo');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de Plano realizado com sucesso!');javascript:window.location='planos.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>