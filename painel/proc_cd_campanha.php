<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$nomecampanha = mysqli_real_escape_string($link,$_POST['nomecampanha']);
$tipocampanha = mysqli_real_escape_string($link,$_POST['tipocampanha']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao']);

$valorpagamento = mysqli_real_escape_string($link,str_replace(',','.',$_POST['valorpagamento']));
$metodopagamento = mysqli_real_escape_string($link,$_POST['metodopagamento']);

$qtd = $_POST['qtd'];
$item = $_POST['item'];

$codcampanha = date('ymdHim').rand('1,99');

$clube = mysqli_real_escape_string($link,$_POST['clube']);

if($tipocampanha == "valor"){
	$sql = "INSERT INTO rfa_campanhas (cod_campanha, nome_campanha, tipo_campanha,descricao_campanha,valor_campanha,metodo_campanha, clube) VALUES ('$codcampanha','$nomecampanha', '$tipocampanha','$descricao','$valorpagamento','$metodopagamento', '$clube');";
}elseif($tipocampanha == "item"){
	$sql = "INSERT INTO rfa_campanhas (cod_campanha, nome_campanha, tipo_campanha,descricao_campanha, clube) VALUES ('$codcampanha','$nomecampanha', '$tipocampanha','$descricao','$clube');";
	foreach($qtd as $key => $quantidade){
	$sql .= "INSERT INTO rfa_campanhas_itens (cod_campanha, qtd_item, nome_item, clube) VALUES ('$codcampanha', '$quantidade','$item[$key]', '$clube');";
	}
}else{
	$sql = "INSERT INTO rfa_campanhas (cod_campanha, nome_campanha, tipo_campanha,descricao_campanha,valor_campanha,metodo_campanha, clube) VALUES ('$codcampanha','$nomecampanha', '$tipocampanha','$descricao','$valorpagamento','$metodopagamento', '$clube');";
	foreach($qtd as $key => $quantidade){
	$sql .= "INSERT INTO rfa_campanhas_itens (cod_campanha, qtd_item, nome_item, clube) VALUES ('$codcampanha', '$quantidade','$item[$key]', '$clube');";
	}
}
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Campanha cadastrada com sucesso!');javascript:window.location='campanhas'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>