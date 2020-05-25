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

$codeAssinatura = 'F0B1BE12A0A0DA5DD4AB1FB45A6F874A';
$response = $pagseguro->consultaAssinatura($codeAssinatura);
print_r($response);die;
