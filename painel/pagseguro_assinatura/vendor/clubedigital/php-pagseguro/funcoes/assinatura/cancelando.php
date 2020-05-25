<?php
//=============================================//
//           Cancelando assinatura		       //
//=============================================//
include("conexao.php");
$idplano = $_GET['id_plano'];
$codplan = $_GET['codplan'];

$select = $conn->query("
SELECT *
FROM rfa_config_pagseguro
WHERE id_pagseguro = '1'");
$result = $select->fetch(PDO::FETCH_ASSOC);

require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroAssinaturas;

$email = $result['email_pagseguro'];
$token = $result['token_pagseguro'];
if($result['sandbox_pagseguro'] == 1){
$sandbox = true;
}else{
$sandbox = false;
}

$pagseguro = new PagSeguroAssinaturas($email, $token, $sandbox);

$codePagSeguro = $codplan;

try {
	$sql = "DELETE FROM rfa_planos WHERE cod_plano='$codplan'";
	$stm = $conn->prepare($sql);
	$executa = $stm->execute();

    print_r($pagseguro->cancelarAssinatura($codePagSeguro));
} catch (Exception $e) {
    echo $e->getMessage();
}