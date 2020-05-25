<?php
//=============================================//
//           Cancelando assinatura		       //
//=============================================//
include("conexao.php");

$atv = $_POST['atv'];
$idplan = $_POST['idplan'];
$codplan = $_POST['codplan'];

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

$codePagSeguro = 'E2FF5EEC6B6B55CCC44F1F880ACB5F4B';

try {
	//$sql = "UPDATE rfa_planos SET ativo_plano = '{$atv}' WHERE id_plano = '{$idplan}'";
	//$stm = $conn->prepare($sql);
	//$executa = $stm->execute();

	$pagseguro->setHabilitarAssinatura($codePagSeguro, false);

	echo "<script>javascript:alert('Alteração realizada com sucesso!');javascript:window.location='../../../../../../planos.php'</script>";
    
} catch (Exception $e) {
    echo $e->getMessage();
}