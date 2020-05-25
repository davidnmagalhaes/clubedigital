<?php 
//Conexão com banco de dados
include_once("../config.php");

$clube = $_POST['clube'];
$idconsorcio = $_POST['idconsorcio'];
$socio = mysqli_real_escape_string($link,$_POST['socio']);
$metodopagamento = "boleto";

$statuspedido = 0;
 
$protocolo = date('ymdHis').rand(100,200);
$data = date('Y-m-d');
$hora = date('H:i:s');

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {
    echo "<script>javascript:alert('Por medida de segurança você precisa confirmar o Recaptcha no final do formulário!');javascript:window.location='consorcio.php?clube=".$clube."'</script>";
}else{

	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfxI-oUAAAAAJHf9arBHYIDSLWa6d9dGYGDG-AD&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($resposta.success && $metodopagamento == "boleto") {

		$qinsc = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_consorcio='$idconsorcio' AND id_socio='$socio';";
		$insc = mysqli_query($link, $qinsc) or die(mysqli_error($link));
		$row_insc = mysqli_num_rows($insc);

		if($row_insc > 0){
		echo "<script>javascript:alert('Há um registro de sua solicitação para este consórcio, não é possível realizar o cadastro duas vezes!');javascript:window.location='consorcio.php?clube=".$clube."'</script>";
		}else{

			echo "<script>javascript:window.location='boleto-consorcio.php?clube=".$clube."&protocolo=".$protocolo."&data=".$data."&hora=".$hora."&idconsorcio=".$idconsorcio."&metodopagamento=".$metodopagamento."&idsocio=".$socio."'</script>";
		}
		
		}else {
	    echo "Usuário mal intencionado detectado. A mensagem não foi enviada.";
	    exit;
	}

}
?>