<?php 
//Conexão com banco de dados
include_once("../config.php");

$clube = $_POST['clube'];
$idcampanha = $_POST['idcampanha'];
$nome = mysqli_real_escape_string($link,$_POST['nome']);
$cpf = mysqli_real_escape_string($link,$_POST['cpf']);
$email = mysqli_real_escape_string($link,$_POST['email']);
$telefone = mysqli_real_escape_string($link,$_POST['telefone']);
$cep = mysqli_real_escape_string($link,$_POST['cep']);
$estado = mysqli_real_escape_string($link,$_POST['estado']);
$endereco = mysqli_real_escape_string($link,$_POST['endereco']);
$numero = mysqli_real_escape_string($link,$_POST['numero']);
$cidade = mysqli_real_escape_string($link,$_POST['cidade']);
$tipodoacao = mysqli_real_escape_string($link,$_POST['tipodoacao']);
$metodopagamento = mysqli_real_escape_string($link,$_POST['metodopagamento']);
$confidencial = mysqli_real_escape_string($link,$_POST['confidencial']);
$quantidade = mysqli_real_escape_string($link,$_POST['quantidade']);
$statuspedido = 0;

$protocolo = date('ymdHis').rand(10,99);
$data = date('Y-m-d');
$hora = date('H:i:s');

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {
    echo "<script>javascript:alert('Por medida de segurança você precisa confirmar o Recaptcha no final do formulário!');javascript:window.location='campanha.php?idcmp=".$idcampanha."&clube=".$clube."'</script>";
}else{

	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfxI-oUAAAAAJHf9arBHYIDSLWa6d9dGYGDG-AD&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($resposta.success && $metodopagamento == "boleto" && $tipodoacao == "valor") {

			echo "<script>javascript:window.location='boleto.php?clube=".$clube."&protocolo=".$protocolo."&data=".$data."&hora=".$hora."&nome=".$nome."&idcampanha=".$idcampanha."&cpf=".$cpf."&email=".$email."&telefone=".$telefone."&cep=".$cep."&estado=".$estado."&endereco=".$endereco."&endereco=".$endereco."&numero=".$numero."&cidade=".$cidade."&tipodoacao=".$tipodoacao."&metodopagamento=".$metodopagamento."&confidencial=".$confidencial."&quantidade=".$quantidade."'</script>";
		}elseif($resposta.success && $metodopagamento == "pagseguro" && $tipodoacao == "valor"){
			echo "<script>javascript:window.location='../integracao_pagseguro/integracao/pagseguro/clubedigital/compra/compra.php?clube=".$clube."&protocolo=".$protocolo."&data=".$data."&hora=".$hora."&nome=".$nome."&idcampanha=".$idcampanha."&cpf=".$cpf."&email=".$email."&telefone=".$telefone."&cep=".$cep."&estado=".$estado."&endereco=".$endereco."&endereco=".$endereco."&numero=".$numero."&cidade=".$cidade."&tipodoacao=".$tipodoacao."&metodopagamento=".$metodopagamento."&confidencial=".$confidencial."&quantidade=".$quantidade."'</script>";
		}elseif($resposta.success && $tipodoacao == "item"){

		$sql = "INSERT INTO rfa_campanhas_pedidos (quantidade_pedido, status_pedido, cod_campanha, hora, data, protocolo_pedido, nome_pedido, cpf_pedido, email_pedido, telefone_pedido, cep_pedido, estado_pedido, endereco_pedido, numero_pedido, cidade_pedido, tipodoacao_pedido, anonimo_pedido, clube) VALUES ('$quantidade','$statuspedido','$idcampanha','$hora','$data','$protocolo','$nome', '$cpf', '$email', '$telefone', '$cep', '$estado', '$endereco', '$numero', '$cidade', '$tipodoacao', '$confidencial', '$clube');";

		
		if ($link->multi_query($sql) === TRUE) {
			echo "<script>javascript:alert('Sua solicitação foi realizada com sucesso! Nossa equipe analisará suas informações e estará entrando em contato em breve!');javascript:window.location='../mpdf/doc-campanha-item.php?clube=".$clube."&protocolo=".$protocolo."'</script>";
		
		} else {
			echo "Error: " . $sql . "<br>" . $link->error;
		}

		$link->close();

		}else {
	    echo "Usuário mal intencionado detectado. A mensagem não foi enviada.";
	    exit;
	}

}
?>