<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$nomecampanha = mysqli_real_escape_string($link,$_POST['nomecampanha']);
$tipocampanha = mysqli_real_escape_string($link,$_POST['tipocampanha']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao']);

$valorpagamento = mysqli_real_escape_string($link,str_replace(',','.',$_POST['valorpagamento']));
$metodopagamento = mysqli_real_escape_string($link,$_POST['metodopagamento']);

$iditem = $_POST['iditem'];
$qtd = $_POST['qtd'];
$item = $_POST['item'];
$excluir = $_POST['excluir'];

$qtd2 = $_POST['qtd2'];
$item2 = $_POST['item2'];

$codcampanha = mysqli_real_escape_string($link,$_POST['idcampanha']);

$clube = mysqli_real_escape_string($link,$_POST['clube']);


	$sql = "UPDATE rfa_campanhas SET nome_campanha='$nomecampanha', tipo_campanha='$tipocampanha',descricao_campanha='$descricao',valor_campanha='$valorpagamento',metodo_campanha='$metodopagamento' WHERE cod_campanha='$codcampanha' AND clube='$clube';";

	foreach($iditem as $key => $iddoitem){
		if($excluir[$key] == 0){
			$sql .= "UPDATE rfa_campanhas_itens SET qtd_item='$qtd[$key]', nome_item='$item[$key]' WHERE id_item='$iddoitem' AND cod_campanha='$codcampanha' AND clube='$clube';";
		}else{
			$sql .= "DELETE FROM rfa_campanhas_itens WHERE id_item='$iddoitem' AND cod_campanha='$codcampanha' AND clube='$clube';";
		}
	}

	foreach($qtd2 as $chave => $quantidade){
	$sql .= "INSERT INTO rfa_campanhas_itens (cod_campanha, qtd_item, nome_item, clube) VALUES ('$codcampanha', '$quantidade','$item2[$chave]', '$clube');";
	}

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Campanha atualizada com sucesso!');javascript:window.location='campanhas'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>