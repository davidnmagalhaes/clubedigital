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
$emailcliente = $_GET['email'];
$telefone = $_GET['telefone'];
$cep = $_GET['cep'];
$estado = $_GET['estado'];
$endereco = $_GET['endereco'];
$numero = $_GET['numero'];
$cidade = $_GET['cidade'];
$tipodoacao = $_GET['tipodoacao'];
$metodopagamento = $_GET['metodopagamento'];
$confidencial = $_GET['confidencial'];
$quantidade = $_GET['quantidade'];

$protocolo = $_GET['protocolo'];
$data = $_GET['data'];
$hora = $_GET['hora'];

$select = $conn->query("
SELECT *
FROM rfa_campanhas
WHERE clube = '$clube' AND cod_campanha='$idcampanha'");
$result = $select->fetch(PDO::FETCH_ASSOC);

$valorcampanha = str_replace(',','.',$result['valor_campanha']);
$nomecampanha = $result['nome_campanha'];

$chaves = $conn->query("
SELECT *
FROM rfa_clubes
WHERE id_clube = '$clube'");
$resultchaves = $chaves->fetch(PDO::FETCH_ASSOC);

$email = $resultchaves['pagseguro_email'];
$token = $resultchaves['pagseguro_token'];
$sandbox = false;


$pagseguro = new PagSeguroCompras($email, $token, $sandbox);

//Nome do comprador (OPCIONAL)
$pagseguro->setNomeCliente($nome);	
//Email do comprovador (OPCIONAL)
$pagseguro->setEmailCliente($email);
//Código usado pelo vendedor para identificar qual é a compra (OPCIONAL)
$pagseguro->setReferencia($protocolo);	
//Adiciona os itens da compra (ID do ITEM, DESCRICAO, VALOR, QUANTIDADE)
$pagseguro->adicionarItem('0001', $nomecampanha, $valorcampanha, $quantidade);
//$pagseguro->adicionarItem('ITEM0002', 'Item 2', 15.50, 1);

//URL para onde será enviado as notificações de alteração da compra (OPCIONAL)
$pagseguro->setNotificationURL("https://".$_SERVER['HTTP_HOST']."/integracao_pagseguro/integracao/pagseguro/clubedigital/compra/notificacao.php?id=".$clube);
//URL para onde o comprador será redicionado após a compra (OPCIONAL)
$pagseguro->setRedirectURL("https://".$_SERVER['HTTP_HOST']);


try {

	$sql = "INSERT INTO rfa_campanhas_pedidos (quantidade_pedido, metodopgto_pedido, status_pedido, cod_campanha, hora, data, protocolo_pedido, nome_pedido, cpf_pedido, email_pedido, telefone_pedido, cep_pedido, estado_pedido, endereco_pedido, numero_pedido, cidade_pedido, tipodoacao_pedido, anonimo_pedido, clube) VALUES ('{$quantidade}','{$metodopagamento}','{$statuspedido}','{$idcampanha}','{$hora}','{$data}','{$protocolo}','{$nome}', '{$cpf}', '{$emailcliente}', '{$telefone}', '{$cep}', '{$estado}', '{$endereco}', '{$numero}', '{$cidade}', '{$tipodoacao}', '{$confidencial}', '{$clube}');";
	$stm = $conn->prepare($sql);
	$executa = $stm->execute();

	$url = $pagseguro->gerarURLCompra();
    header("Location:".$url);

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}



