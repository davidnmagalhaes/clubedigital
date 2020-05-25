<?php
//=============================================//
//           Criando Plano	        	       //
//=============================================//
include("conexao.php");

require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroAssinaturas;

$nomeplan = $_POST['nomeplano'];
$maxuser = $_POST['max_user'];
$descricaoplano = $_POST['descricao_plano'];
$periodicidade = $_POST['periodicidade'];
$tempoexp = intval($_POST['tempo_exp']);
$modoexp = strval($_POST['modo_exp']);
$valormens = str_replace('.','',$_POST['valormensalidade']);
$valormes = str_replace(',','.',$valormens); 
$ativo = 1;

$email = "pagseguro2@afetur.com.br";
$token = "BB6C2BFC28354EE7AF3CD3306E47E675";
$sandbox = true;

$pagseguro = new PagSeguroAssinaturas($email, $token, $sandbox);

//Cria um nome para o plano
$pagseguro->setReferencia($nomeplan);

//Cria uma descrição para o plano
$pagseguro->setDescricao($descricaoplano);

//Valor a ser cobrado a cada renovação
$pagseguro->setValor($valormes);

//De quanto em quanto tempo será realizado uma nova cobrança (MENSAL, BIMESTRAL, TRIMESTRAL, SEMESTRAL, ANUAL)
if($periodicidade == "MENSAL"){
$pagseguro->setPeriodicidade(PagSeguroAssinaturas::MENSAL);
}elseif($periodicidade == "BIMESTRAL"){
$pagseguro->setPeriodicidade(PagSeguroAssinaturas::BIMESTRAL);
}elseif($periodicidade == "TRIMESTRAL"){
$pagseguro->setPeriodicidade(PagSeguroAssinaturas::TRIMESTRAL);
}elseif($periodicidade == "SEMESTRAL"){
$pagseguro->setPeriodicidade(PagSeguroAssinaturas::SEMESTRAL);	
}else{
$pagseguro->setPeriodicidade(PagSeguroAssinaturas::ANUAL);	
}

//=== Campos Opcionais ===//
//Após quanto tempo a assinatura irá expirar após a contratação = valor inteiro + (DAYS||MONTHS||YEARS). Exemplo, após 5 anos
$pagseguro->setExpiracao($tempoexp, '$modoexp');

//URL para redicionar a pessoa do portal PagSeguro para uma página de cancelamento no portal
//$pagseguro->setURLCancelamento('http://carloswgama.com.br/pagseguro/not/cancelando.php');

//Local para o comprador será redicionado após a compra com o código (code) identificador da assinatura
//$pagseguro->setRedirectURL('http://carloswgama.com.br/pagseguro/not/assinando.php');		

//Máximo de pessoas que podem usar esse plano. Exemplo 10.000 pessoas podem usar esse plano
$pagseguro->setMaximoUsuariosNoPlano($maxuser);

//=== Cria o plano ===//
try {
	$codigoPlano = $pagseguro->criarPlano();

	$sql = "INSERT INTO rfa_planos (nome_plano, valor_plano, ativo_plano, descricao_plano, periodicidade, tempo_exp, modo_exp, url_cancelamento, url_redirect, max_users, cod_plano) VALUES ('{$nomeplan}', '{$valormes}', '{$ativo}', '{$descricaoplano}','{$periodicidade}','{$tempoexp}','{$modoexp}','{$urlcancelamento}','{$urlredirect}','{$maxuser}','{$codigoPlano}')";
	$stm = $conn->prepare($sql);
	$executa = $stm->execute();
			echo "<script>javascript:alert('Cadastro de Plano realizado com sucesso!');javascript:window.location='../../../../../../planos.php'</script>";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

