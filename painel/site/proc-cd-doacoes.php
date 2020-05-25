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
$escolaridade = mysqli_real_escape_string($link,$_POST['escolaridade']);
$renda = mysqli_real_escape_string($link,$_POST['renda']);
$deficiencia = mysqli_real_escape_string($link,$_POST['deficiencia']);
$necessidade = mysqli_real_escape_string($link,$_POST['necessidade']);
$origem = mysqli_real_escape_string($link,$_POST['origem']);

$protocolo = date('YmdHis').rand(0,1000);
$data = date('Y-m-d');
$hora = date('H:i:s');

$srecaptcha = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$recaptcha = mysqli_query($link, $srecaptcha) or die(mysqli_error($link));
$row_recaptcha = mysqli_fetch_assoc($recaptcha);
$secretkey = $row_recaptcha['secret_key'];

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {
    echo "<script>javascript:alert('Por medida de segurança você precisa confirmar o Recaptcha no final do formulário!');javascript:window.location='continua-doacoes.php?clube=".$clube."&nome=".$nome."&email=".$email."&cep=".$cep."&estado=".$estado."&endereco=".$endereco."&numero=".$numero."&cidade=".$cidade."&cpf=".$cpf."&rg=".$rg."&telefone=".$telefone."&celular=".$celular."&deficiencia=".$deficiencia."&escolaridade=".$escolaridade."&renda=".$renda."&deficiencia=".$deficiencia."&necessidade=".$necessidade."&origem=".$origem."'</script>";
}else{

	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkey."&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($resposta.success) {

		$sql = "INSERT INTO rfa_cr_solicitante (hora_solicitante, data_solicitante, protocolo_solicitante, nome_solicitante, email_solicitante, cep_solicitante, end_solicitante, num_solicitante, uf_solicitante, cid_solicitante, cel_solicitante, fone_solicitante, cpf_solicitante, rg_solicitante, clube, escol_solicitante, renda_solicitante, def_solicitante, neces_solicitante, orig_solicitante) VALUES ('$hora','$data','$protocolo','$nome', '$email', '$cep', '$endereco', '$numero', '$estado', '$cidade', '$celular', '$telefone', '$cpf', '$rg', '$clube', '$escolaridade', '$renda', '$deficiencia', '$necessidade', '$origem');";

		
		if ($link->multi_query($sql) === TRUE) {
			echo "<script>javascript:alert('Sua solicitação foi realizada com sucesso! Nossa equipe analisará suas informações e estará entrando em contato em breve!');javascript:window.location='../mpdf/doc-solicitante.php?clube=".$clube."&protocolo=".$protocolo."'</script>";
		
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