<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);

$qv = "SELECT * FROM rfa_bancos WHERE clube='$club' AND conta_mensalidade='1'";
$verifica = mysqli_query($link, $qv) or die(mysqli_error($link));
$row_verifica = mysqli_fetch_assoc($verifica);	
$totalRows_verifica = mysqli_num_rows($verifica);

if($totalRows_verifica <= 0){echo "<script>javascript:alert('Não há uma conta bancária principal cadastrada! Você será redirecionado para cadastrar em conta...');javascript:window.location='cd_banco.php'</script>";
}else{
/*Recebe as variáveis de cd_banco.php*/
$por = mysqli_real_escape_string($link,$_POST['por']);
$destino = mysqli_real_escape_string($link,$_POST['origem_pagar']);
$nomefuncionario = mysqli_real_escape_string($link,$_POST['nomefuncionario']);

if(empty($_POST['descricao_pagar'])){
	$descricao = "Salário de ".$nomefuncionario;
}else{
	$descricao = mysqli_real_escape_string($link,$_POST['descricao_pagar']);
}

if(empty($_POST['datapagamento'])){
	$data = mysqli_real_escape_string($link,$_POST['data_pagar']);
}else{
	$data = mysqli_real_escape_string($link,$_POST['datapagamento']);
}

if(empty($_POST['status_pagar2'])){
	$status = mysqli_real_escape_string($link,$_POST['status_pagar']);
}else{
	$status = mysqli_real_escape_string($link,$_POST['status_pagar2']);
}

$cpffuncionario = mysqli_real_escape_string($link,$_POST['cpffuncionario']);
$cargofuncionario = mysqli_real_escape_string($link,$_POST['cargofuncionario']);
$mesreferencia = mysqli_real_escape_string($link,$_POST['mesreferencia']);
$anoreferencia = mysqli_real_escape_string($link,$_POST['anoreferencia']);


$valorsalario = mysqli_real_escape_string($link,$_POST['valor_salario']);

if(empty($_POST['valor_salario'])){
	$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_pagar']));
	$valorat = str_replace(',','.',$valor);
}else{
	$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_salario']));
	$valorat = str_replace(',','.',$valor);
}

$codpagar = date('YmdHi').rand(10,99);
$descricao_vencimento = $_POST['descricao_vencimento'];
$valor_vencimento = str_replace(',','.',str_replace('.','',$_POST['valor_vencimento']));
$descontos_vencimento = str_replace(',','.',str_replace('.','',$_POST['descontos_vencimento']));
$referencia_vencimento = $_POST['referencia_vencimento'];

$descontossalario = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['descontos_salario'])));
$referenciasalario = mysqli_real_escape_string($link,$_POST['referenciasalario']); 
$contrinss = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['contrinss'])));
$basefgts = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['basefgts'])));
$fgtsmes = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['fgts_mes'])));
$baseirrf = mysqli_real_escape_string($link,str_replace(',','.',str_replace('.','',$_POST['base_irrf'])));
$faixairrf = mysqli_real_escape_string($link,$_POST['faixa_irrf']);

$datacadastro = date('Y-m-d');

	$sql = "INSERT INTO rfa_pagar (cod_pagar, nome_funcionario, cpf_funcionario, cargo_funcionario, mes_referencia, ano_referencia, descontos_salario, referencia_salario, contr_inss, base_fgts, fgts_mes, base_irrf, faixa_irrf, origem_pagar, descricao_pagar, data_pagar, status_pagar, valor_pagar, por_pagar, user, data_cadastro, clube) VALUES ('$codpagar','$nomefuncionario','$cpffuncionario', '$cargofuncionario','$mesreferencia','$anoreferencia','$descontossalario','$referenciasalario','$contrinss','$basefgts','$fgtsmes','$baseirrf','$faixairrf','$destino', '$descricao', '$data', '$status', '$valorat', '$por', '$user', '$datacadastro', '$club');";

	foreach($descricao_vencimento as $key => $desc){
	$sql .= "INSERT INTO rfa_pagar_venc (ref_pagar, descricao_venc, valor_venc, descontos_venc, referencia_venc, clube) VALUES ('$codpagar', '$desc', '$valor_vencimento[$key]', '$descontos_vencimento[$key]', '$referencia_vencimento[$key]','$club');";
	}
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Cadastro de conta a pagar realizado com sucesso!');javascript:window.location='a-pagar.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>