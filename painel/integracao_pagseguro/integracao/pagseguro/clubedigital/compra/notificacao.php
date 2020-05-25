<?php
//=============================================//
//           Consultando uma notificação      //
//=============================================//
include("conexao.php");

require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroCompras;

$clube = $_GET['id'];

$chaves = $conn->query("
SELECT *
FROM rfa_clubes
WHERE id_clube = '$clube'");
$resultchaves = $chaves->fetch(PDO::FETCH_ASSOC);

$email = $resultchaves['pagseguro_email'];
$token = $resultchaves['pagseguro_token'];
$sandbox = false;

$pagseguro = new PagSeguroCompras($email, $token, $sandbox);

//$_POST['notificationType'] = 'transaction';
//$teste = $_POST['notificationCode'] = 'E8EC33314F114E2483F45CD8873802E8';

//Caso seja uma notificação de compra (transaction)
if ($_POST['notificationType'] == 'transaction') {
    $codigo = $_POST['notificationCode']; //Recebe o código da notificação e busca as informações de como está a assinatura
    $response = $pagseguro->consultarNotificacao($codigo);
    //print_r($response);die;
    $resposta = json_encode($response);
    $tirajson = json_decode($resposta,true);

	$date = $tirajson['date']; //Data do pedido
	$code = $tirajson['code']; //Código de Transação
	$reference = $tirajson['reference']; //Número do pedido
	$grossAmount = $tirajson['grossAmount']; //Valor do pedido
	$campanha = $tirajson['items']['item']['description'];
	$emailcomprador = $tirajson['sender']['email'];
	$dddcomprador = $tirajson['sender']['phone']['areaCode'];
	$phonecomprador = $tirajson['sender']['phone']['number'];
	$cpfcomprador = $tirajson['sender']['documents']['document']['value'];
	$statuspgto = $tirajson['info']['status']; //3: Pago | 5: Em disputa | 4: Disponível | 6: Devolvida

    try {

	$sql = "UPDATE rfa_campanhas_pedidos SET status_pedido='{$statuspgto}' WHERE clube='{$clube}' AND protocolo_pedido='{$reference}';";
	$stm = $conn->prepare($sql);
	$executa = $stm->execute();

	} catch (Exception $e) {
	    echo "Erro: " . $e->getMessage();
	}



}