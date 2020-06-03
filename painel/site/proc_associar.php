<?php 
//Conexão com banco de dados
include_once("../config.php");

include('verificacao.php');

$clube = $_POST['clube'];
$nome = mysqli_real_escape_string($link,$_POST['nome']);
$idri = mysqli_real_escape_string($link,$_POST['idri']);
$email = mysqli_real_escape_string($link,$_POST['email']);
$cpf = mysqli_real_escape_string($link,$_POST['cpf']);
$rg = mysqli_real_escape_string($link,$_POST['rg']);
$nascto = mysqli_real_escape_string($link,$_POST['nascto']);
$cep = mysqli_real_escape_string($link,$_POST['cep']);
$endereco = mysqli_real_escape_string($link,$_POST['endereco']);
$numero = mysqli_real_escape_string($link,$_POST['numero']);
$bairro = mysqli_real_escape_string($link,$_POST['bairro']);
$cidade = mysqli_real_escape_string($link,$_POST['cidade']);
$estado = mysqli_real_escape_string($link,$_POST['estado']);
$telefone = mysqli_real_escape_string($link,$_POST['telefone']);
$profissao = mysqli_real_escape_string($link,$_POST['profissao']);
$nomeconjuge = mysqli_real_escape_string($link,$_POST['nomeconjuge']);
$datacasamento = mysqli_real_escape_string($link,$_POST['datacasamento']);
$nasctoconjuge = mysqli_real_escape_string($link,$_POST['nasctoconjuge']);
$nomefilho = $_POST['nomefilho'];
$nasctofilho = $_POST['nasctofilho'];

$referenciasocio = date('ymdHis').rand(0,100);
$data = date('Y-m-d');
$hora = date('H:i:s');

$srecaptcha = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$recaptcha = mysqli_query($link, $srecaptcha) or die(mysqli_error($link));
$row_recaptcha = mysqli_fetch_assoc($recaptcha);
if($signal == 1){
$secretkey = $row_recaptcha['secret_key'];
}else{
$secretkey = "6Lf6B_wUAAAAAO6w9OpYt3bgXVWs5pmC7JImzrkr";
}

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {
    echo "<script>javascript:alert('Por medida de segurança você precisa confirmar o Recaptcha no final do formulário!');javascript:window.location='associar.php?clube=".$clube."'</script>";
}else{

	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkey."&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($resposta.success) {

		$sql = "INSERT INTO rfa_socios_novos (ref_novo,nome_novo, id_padrinho, email_novo, rg_novo, cpf_novo, nascto_novo, cep_novo, endereco_novo, numero_novo, bairro_novo, cidade_novo, estado_novo, telefone_novo, profissao_novo, nomeconjuge_novo, datacasamento_novo, nasctoconjuge_novo, data_novo, hora_novo, clube) VALUES ('$referenciasocio','$nome','$idri','$email','$rg','$cpf','$nascto','$cep','$endereco','$numero','$bairro','$cidade','$estado','$telefone','$profissao','$nomeconjuge','$datacasamento','$nasctoconjuge','$data','$hora',$clube);";

		foreach($nomefilho as $key => $name){
			$namescape = mysqli_real_escape_string($link,$name);
			$nasctoscape = mysqli_real_escape_string($link,$nasctofilho['$key']);
		$sql .= "INSERT INTO rfa_socios_novos_filhos (nome_filho, nascto_filho, id_socio, clube) VALUES ('$namescape','$nasctoscape','$referenciasocio','$clube');";
		}
		
		if ($link->multi_query($sql) === TRUE) {
			echo "<script>javascript:alert('Sua solicitação foi realizada com sucesso! Nossa equipe analisará suas informações e estará entrando em contato em breve!');javascript:window.location='associar.php?clube=".$clube."'</script>";
		
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