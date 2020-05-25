<?php
//=============================================//
//           Consultando Compra	    	       //
//=============================================//
require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroCompras;

$email = "pagseguro2@afetur.com.br";
$token = "BB6C2BFC28354EE7AF3CD3306E47E675";
$sandbox = true;

$pagseguro = new PagSeguroCompras($email, $token, $sandbox);

echo "<h2>Consulta pelo código de Transação</h2>";
//Pelo cóigo da transação
$codigoTransacao = 'CE5FA636642440228D3D633F87DC29CF'; //È o código gerado no ato da compra pelo PagSeguro
$response = $pagseguro->consultarCompra($codigoTransacao);
print_r($response);

echo "<br/><hr/>";

echo "<h2>Consulta pelo código de Referencia</h2>";
//Pelo Código da Referencia
$referencia = 'CWG004'; //È o código gerado no seu site ao criar a solicitação de compra
$response = $pagseguro->consultarCompraByReferencia($referencia);
print_r($response);

