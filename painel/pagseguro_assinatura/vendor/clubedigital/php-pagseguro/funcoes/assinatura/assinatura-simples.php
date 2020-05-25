<?php
//=============================================//
//           Criando uma assinatura		       //
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

$codigoPlano = '1AB37063A3A3118554A4AF8A85431C75';
$url = $pagseguro->assinarPlanoCheckout($codigoPlano);

echo 'URL para o Checkout: ' . $url;