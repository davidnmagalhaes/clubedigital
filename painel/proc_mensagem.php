<?php 
//Conexão com banco de dados
include_once("config.php");
date_default_timezone_set('America/Fortaleza');
$tipomensagem = mysqli_real_escape_string($link, $_POST['tipo-mensagem']);
$destinatario = mysqli_real_escape_string($link,$_POST['destinatario']);
$remetente = mysqli_real_escape_string($link, $_POST['remetente']);
$mensagem = mysqli_real_escape_string($link,$_POST['mensagem']);
$data = date('Y-m-d');
$hora = date('H:i');

if($tipomensagem == 1){
$noti_inicial = 0; //Notificação inicial informando que as mensagens não foram lidas para mensagens privadas
$rmt = $destinatario;
}else{
$noti_inicial = 2; //Notificação inicial informando que as mensagens não foram lidas para mensagens compartilhadas
$rmt = $remetente;
}

$codmensagem = rand();

	$sql = "INSERT INTO rfa_mensagens (remetente, cod_mensagem, data_mensagem, hora_mensagem, tipo_mensagem, destinatario, mensagem) VALUES ('$remetente','$codmensagem', '$data', '$hora', '$tipomensagem', '$destinatario', '$mensagem');";

	$sql .= "INSERT INTO rfa_notificacao (id_mensagem, notificacao, id_usuario, tipo_message) VALUES ('$codmensagem', '$noti_inicial', '$rmt', '$tipomensagem');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='inbox.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>