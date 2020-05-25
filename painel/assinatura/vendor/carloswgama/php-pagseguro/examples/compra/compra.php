<?php
//=============================================//
//           Criando uma compra     	       //
//=============================================//
include("conexao.php");

require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroCompras;

$clube = $_GET['clube'];
$idcampanha = $_GET['idcampanha'];
$nome = $_GET['nome'];
$cpf = $_GET['cpf'];
$email = $_GET['email'];
$telefone = $_GET['telefone'];
$cep = $_GET['cep'];
$estado = $_GET['estado'];
$endereco = $_GET['endereco'];
$numero = $_GET['numero'];
$cidade = $_GET['cidade'];
$tipodoacao = $_GET['tipodoacao'];
$metodopagamento = $_GET['metodopagamento'];
$confidencial = $_GET['confidencial'];

$protocolo = $_GET['protocolo'];
$data = $_GET['data'];
$hora = $_GET['hora'];

/*$select = $conn->query("
SELECT *
FROM rfa_config_pagseguro
WHERE id_pagseguro = '1'");
$result = $select->fetch(PDO::FETCH_ASSOC);*/

$select = $conn->query("
SELECT *
FROM rfa_campanhas
WHERE clube = '$clube' AND cod_campanha='$idcampanha'");
$result = $select->fetch(PDO::FETCH_ASSOC);

$valorcampanha = str_replace(',','.',$result['valor_campanha']);



$email = "pagseguro2@afetur.com.br";
$token = "BB6C2BFC28354EE7AF3CD3306E47E675";
$sandbox = true;

$pagseguro = new PagSeguroCompras($email, $token, $sandbox);

//Nome do comprador (OPCIONAL)
$pagseguro->setNomeCliente($nome);	
//Email do comprovador (OPCIONAL)
$pagseguro->setEmailCliente($email);
//Código usado pelo vendedor para identificar qual é a compra (OPCIONAL)
$pagseguro->setReferencia($protocolo);	
//Adiciona os itens da compra (ID do ITEM, DESCRICAO, VALOR, QUANTIDADE)
$pagseguro->adicionarItem('0001', 'Doação', $valorcampanha, 1);
//$pagseguro->adicionarItem('ITEM0002', 'Item 2', 15.50, 1);

//URL para onde será enviado as notificações de alteração da compra (OPCIONAL)
$pagseguro->setNotificationURL('http://carloswgama.com.br/pagseguro/not/notificando.php');
//URL para onde o comprador será redicionado após a compra (OPCIONAL)
$pagseguro->setRedirectURL('http://carloswgama.com.br/');

try{
    $url = $pagseguro->gerarURLCompra();
    header("Location:".$url);
} catch (Exception $e) {
    echo $e->getMessage();
}
