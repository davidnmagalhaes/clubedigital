<?php
//=============================================//
//           Consultando Compra	    	       //
//=============================================//
include("conexao.php");

require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroCompras;

$clube = $_GET['clube'];

$chaves = $conn->query("
SELECT *
FROM rfa_clubes
WHERE id_clube = '$clube'");
$resultchaves = $chaves->fetch(PDO::FETCH_ASSOC);

$email = $resultchaves['pagseguro_email'];
$token = $resultchaves['pagseguro_token'];
$sandbox = true;

$pagseguro = new PagSeguroCompras($email, $token, $sandbox);

echo "<h2>Consulta pelo código de Transação</h2>";
//Pelo cóigo da transação
$codigoTransacao = '3B30CF1BCE7F46CD94166BD51F38BE98'; //È o código gerado no ato da compra pelo PagSeguro
$response = $pagseguro->consultarCompra($codigoTransacao);
print_r($response);

echo "<br/><hr/>";

echo "<h2>Consulta pelo código de Referencia</h2>";


$exibejson = '{"date":"2020-05-13T17:40:55.000-03:00","code":"CE5FA636-6424-4022-8D3D-633F87DC29CF","reference":"teste","type":"1","status":"3","lastEventDate":"2020-05-14T09:55:38.000-03:00","paymentMethod":{"type":"1","code":"101"},"grossAmount":"50.00","discountAmount":"0.00","feeAmount":"2.90","netAmount":"47.10","extraAmount":"0.00","escrowEndDate":"2020-05-28T09:55:37.000-03:00","installmentCount":"1","itemCount":"1","items":{"item":{"id":"0001","description":"Doau00c3u00c3o","quantity":"1","amount":"50.00"}},"sender":{"email":"c60008649220176109167@sandbox.pagseguro.com.br","phone":{"areaCode":"11","number":"99999999"},"documents":{"document":{"type":"CPF","value":"22952655847"}}},"shipping":{"address":{"street":"AVENIDA PAULISTA","number":"1578","complement":{},"district":"Bela Vista","city":"SAO PAULO","state":"SP","country":"BRA","postalCode":"01310200"},"type":"3","cost":"0.00"},"gatewaySystem":{"type":"cielo","rawCode":{},"rawMessage":{},"normalizedCode":{},"normalizedMessage":{},"authorizationCode":"0","nsu":"0","tid":"0","establishmentCode":"1056784170","acquirerName":"CIELO"},"info":{"estado":"Paga","descricao":"a transau00e7u00e3o foi paga pelo comprador e o PagSeguro ju00e1 recebeu uma confirmau00e7u00e3o da instituiu00e7u00e3o financeira responsu00e1vel pelo processamento..","status":"3"}}';
$tirajson = json_decode($exibejson,true);



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

echo $cpfcomprador;

//Pelo Código da Referencia
$referencia = 'CWG004'; //È o código gerado no seu site ao criar a solicitação de compra
$response = $pagseguro->consultarCompraByReferencia($referencia);
print_r($response);

