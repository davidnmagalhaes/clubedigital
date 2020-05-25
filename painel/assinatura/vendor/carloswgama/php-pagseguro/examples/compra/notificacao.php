<?php
//=============================================//
//           Consultando uma notificação      //
//=============================================//
require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroCompras;

$email = "pagseguro2@afetur.com.br";
$token = "BB6C2BFC28354EE7AF3CD3306E47E675";
$sandbox = true;

$pagseguro = new PagSeguroCompras($email, $token, $sandbox);

//$_POST['notificationType'] = 'transaction';
$teste = $_POST['notificationCode'] = 'E8EC33314F114E2483F45CD8873802E8';

//Caso seja uma notificação de compra (transaction)
if ($_POST['notificationType'] == 'transaction') {
    $codigo = $teste; //Recebe o código da notificação e busca as informações de como está a assinatura
    $response = $pagseguro->consultarNotificacao($codigo);
    print_r($response);die;
}