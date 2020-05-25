<?php
//=============================================//
//           Cancelando assinatura		       //
//=============================================//
include("conexao.php");

require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroAssinaturas;

$select = $conn->query("
SELECT *
FROM rfa_config_pagseguro
WHERE id_pagseguro = '1'");
$result = $select->fetch(PDO::FETCH_ASSOC);

$email = $result['email_pagseguro'];
$token = $result['token_pagseguro'];
if($result['sandbox_pagseguro'] == 1){
$sandbox = true;
}else{ 
$sandbox = false;
}

$pagseguro = new PagSeguroAssinaturas($email, $token, $sandbox);

//$_POST['notificationType'] = 'preApproval';
//$_POST['notificationCode'] = '144F13-CC5C135C13CE-FBB4906F9375-850AB5';

//Caso seja uma notificação de uma assinatura (preApproval)


/*{"name":"Teste produu00e7u00e3o 3","code":"1F3ACA015555397004E71F98A164C936","date":"2019-12-30T15:32:56-03:00","tracker":"E87EB3","status":"ACTIVE","reference":"CWG004","lastEventDate":"2019-12-30T15:32:57-03:00","charge":"AUTO",
"sender":
{"name":"CARLOS W GAMA","email":"c60008649220176109167@sandbox.pagseguro.com.br",
"phone":
{"number":"999999999","areaCode":"11"},
"address":
{"state":"SP","number":"99","country":"BRA","complete":true,"district":"BAIRRO","city":"Su00e3o Paulo","federationUnit":"SP","postalCode":"57000000","street":"Rua C","complement":"COMPLEMENTO","addressRequired":true}}}*/

if ($_POST['notificationType'] == 'preApproval') {
    $codigoNotificacao = $_POST['notificationCode']; //Recebe o código da notificação e busca as informações de como está a assinatura
    $response = $pagseguro->consultarNotificacao($codigoNotificacao);
    //print_r($response); //Aqui é possível obter informações como se a assinatura está ativa ou não

    
    $encode = json_encode($response);
    $decode = json_decode($encode, true);

    $codigo = $decode['code'];
    $identificador = $decode['tracker'];

    try {
	$sql = "INSERT INTO rfa_assinaturas (cod_assinatura, identificador) VALUES ('{$codigo}','{$identificador}')";
	$stm = $conn->prepare($sql);
	$executa = $stm->execute();

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
}