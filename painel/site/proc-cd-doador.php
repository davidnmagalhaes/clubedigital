<?php 
//Conexão com banco de dados
include_once("../config.php");

$clube = $_POST['clube'];
$nome = mysqli_real_escape_string($link,$_POST['nome']);
$email = mysqli_real_escape_string($link,$_POST['email']);
$cep = mysqli_real_escape_string($link,$_POST['cep']);
$estado = mysqli_real_escape_string($link,$_POST['estado']);
$endereco = mysqli_real_escape_string($link,$_POST['endereco']);
$numero = mysqli_real_escape_string($link,$_POST['numero']);
$cidade = mysqli_real_escape_string($link,$_POST['cidade']);
$cpf = mysqli_real_escape_string($link,$_POST['cpf']);
$rg = mysqli_real_escape_string($link,$_POST['rg']);
$telefone = mysqli_real_escape_string($link,$_POST['telefone']);
$celular = mysqli_real_escape_string($link,$_POST['celular']);
$tipocadeira = mysqli_real_escape_string($link,$_POST['tipocadeira']);
$tempouso = mysqli_real_escape_string($link,$_POST['tempouso']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao']);

$protocolo = date('YmdHis').rand(0,1000);
$data = date('Y-m-d');
$hora = date('H:i:s');

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {
    echo "<script>javascript:alert('Por medida de segurança você precisa confirmar o Recaptcha no final do formulário!');javascript:window.location='continua-doacoes.php?clube=".$clube."&nome=".$nome."&email=".$email."&cep=".$cep."&estado=".$estado."&endereco=".$endereco."&numero=".$numero."&cidade=".$cidade."&cpf=".$cpf."&rg=".$rg."&telefone=".$telefone."&celular=".$celular."&tempouso=".$tempouso."&descricao=".$descricao."'</script>";
}else{

	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfxI-oUAAAAAJHf9arBHYIDSLWa6d9dGYGDG-AD&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($resposta.success) {

		$sql = "INSERT INTO rfa_cr_doador (tipo_cadeira, hora_doador, data_doador, protocolo_doador, nome_doador, email_doador, cep_doador, end_doador, num_doador, uf_doador, cid_doador, cel_doador, fone_doador, cpf_doador, rg_doador, clube, tmp_uso_item, desc_item) VALUES ('$tipocadeira','$hora','$data','$protocolo','$nome', '$email', '$cep', '$endereco', '$numero', '$estado', '$cidade', '$celular', '$telefone', '$cpf', '$rg', '$clube', '$tempouso', '$descricao');";

		
		if ($link->multi_query($sql) === TRUE) {
			echo "<script>javascript:alert('Parabéns! Você acaba de registrar seu pedido para ser doador, siga as instruções no documento a seguir...');javascript:window.location='../mpdf/doc-doador.php?clube=".$clube."&protocolo=".$protocolo."'</script>";
		
		} else {
			echo "Error: " . $sql . "<br>" . $link->error;
		}

		$link->close();

	} else {
	    echo "Usuário mal intencionado detectado. A mensagem não foi enviada.";
	    exit;
	}

}
?>