<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$por = mysqli_real_escape_string($link,$_POST['por']);
$idpagar = mysqli_real_escape_string($link,$_POST['idpagar']);
$codpagar = mysqli_real_escape_string($link,$_POST['codpagar']);
$origem = mysqli_real_escape_string($link,$_POST['origem_pagar']);
$nomefuncionario = mysqli_real_escape_string($link,$_POST['nomefuncionario']);
$atvfuncion = mysqli_real_escape_string($link,$_POST['atvfuncion']);

if($atvfuncion!=1){
	$descricao = mysqli_real_escape_string($link,$_POST['descricao_pagar']);
}else{
	$descricao = "Salário de ".$nomefuncionario;
}

if($atvfuncion!=1){
	$data = mysqli_real_escape_string($link,$_POST['data_pagar']);
}else{
	$data = mysqli_real_escape_string($link,$_POST['datapagamento']);
}

if($atvfuncion!=1){
	$status = mysqli_real_escape_string($link,$_POST['status_pagar']);
}else{
	$status = mysqli_real_escape_string($link,$_POST['status_pagar2']);
}

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$datacadastro = date('Y-m-d');


$cpffuncionario = mysqli_real_escape_string($link,$_POST['cpffuncionario']);
$cargofuncionario = mysqli_real_escape_string($link,$_POST['cargofuncionario']);
$mesreferencia = mysqli_real_escape_string($link,$_POST['mesreferencia']);
$anoreferencia = mysqli_real_escape_string($link,$_POST['anoreferencia']);
$datapagamento = mysqli_real_escape_string($link,$_POST['datapagamento']);
$descontossalario = mysqli_real_escape_string($link,$_POST['descontos_salario']);
$referenciasalario = mysqli_real_escape_string($link,$_POST['referenciasalario']);

$idvenc = $_POST['idvenc'];
$excluirvenc = $_POST['excluir_venc'];
$descricaovencimento = $_POST['descricao_vencimento'];
$valor_vencimento = str_replace(',','.',str_replace('.','',$_POST['valor_vencimento']));
$descontos_vencimento = str_replace(',','.',str_replace('.','',$_POST['descontos_vencimento']));
$referenciavencimento = $_POST['referencia_vencimento'];

$descricaovencimento2 = $_POST['descricao_vencimento2'];
$valor_vencimento2 = str_replace(',','.',str_replace('.','',$_POST['valor_vencimento2']));
$descontos_vencimento2 = str_replace(',','.',str_replace('.','',$_POST['descontos_vencimento2']));
$referenciavencimento2 = $_POST['referencia_vencimento2'];

$contrinss = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['contrinss'])));
$basefgts = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['basefgts'])));
$fgtsmes = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['fgts_mes'])));
$baseirrf = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['base_irrf'])));
$faixairrf = mysqli_real_escape_string($link,$_POST['faixa_irrf']);

if($atvfuncion!=1){
	$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_pagar']));
	$valorat = str_replace(',','.',$valor);
}else{
	$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_salario']));
	$valorat = str_replace(',','.',$valor);
}

	if($atvfuncion!=1){
		$sql = "UPDATE rfa_pagar SET origem_pagar='$origem', descricao_pagar='$descricao', data_pagar='$data', status_pagar='$status', valor_pagar='$valorat', por_pagar='$por', user='$user', data_cadastro='$datacadastro' WHERE clube='$club' AND id_pagar='$idpagar';";
	}else{
		$sql = "UPDATE rfa_pagar SET faixa_irrf='$faixairrf', base_irrf='$baseirrf', fgts_mes='$fgtsmes', base_fgts='$basefgts', contr_inss='$contrinss', referencia_salario='$referenciasalario', descontos_salario='$descontossalario', ano_referencia='$anoreferencia', mes_referencia='$mesreferencia', cargo_funcionario='$cargofuncionario', cpf_funcionario='$cpffuncionario', nome_funcionario='$nomefuncionario', origem_pagar='$origem', descricao_pagar='$descricao', data_pagar='$data', status_pagar='$status', valor_pagar='$valorat', por_pagar='$por', user='$user', data_cadastro='$datacadastro' WHERE clube='$club' AND id_pagar='$idpagar';";	
	}

	foreach($idvenc as $key => $idvencimento){
		if($excluirvenc[$key]==0){
			$sql .= "UPDATE rfa_pagar_venc SET descricao_venc='$descricaovencimento[$key]', valor_venc='$valor_vencimento[$key]', descontos_venc='$descontos_vencimento[$key]', referencia_venc='$referenciavencimento[$key]' WHERE clube='$club' AND id_venc='$idvencimento';";
		}else{
			$sql .= "DELETE FROM rfa_pagar_venc WHERE id_venc='$idvencimento';";
		}
	}

	foreach($descricaovencimento2 as $keyf => $descvenc2){
		$sql .= "INSERT INTO rfa_pagar_venc (ref_pagar, descricao_venc, valor_venc, descontos_venc, referencia_venc, clube) VALUES ('$codpagar','$descvenc2', '$valor_vencimento2[$keyf]', '$descontos_vencimento2[$keyf]', '$referenciavencimento2[$keyf]', '$club');";
	}

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Sua conta a pagar foi modificada com sucesso!');javascript:window.location='a-pagar.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>