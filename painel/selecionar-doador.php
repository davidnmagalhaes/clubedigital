<?php 
//Conexão com banco de dados
include_once("config.php");

$iddoador = $_GET['iddoador'];
$idsolicitante = $_GET['idsolicitante'];
$clube = $_GET['clube']; 

$qdados = "SELECT * FROM rfa_config_email WHERE id_config='1'";
$buscadados = mysqli_query($link, $qdados) or die(mysqli_error($link));
$row_buscadados = mysqli_fetch_assoc($buscadados);

$query = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$buscaclube = mysqli_query($link, $query) or die(mysqli_error($link));
$row_buscaclube = mysqli_fetch_assoc($buscaclube);

$nomeclube = $row_buscaclube['nome_clube'];
$emailclube = $row_buscaclube['email_clube'];
$enderecoclube = $row_buscaclube['endereco_clube'];
$numeroclube = $row_buscaclube['numero_clube'];
$bairroclube = $row_buscaclube['bairro_clube'];
$cidadeclube = $row_buscaclube['cidade_clube'];
$estadoclube = $row_buscaclube['estado_clube'];
$cepclube = $row_buscaclube['cep_clube'];

$qd = "SELECT * FROM rfa_cr_solicitante WHERE id_solicitante='$idsolicitante' AND clube='$clube'";
$buscaqd = mysqli_query($link, $qd) or die(mysqli_error($link));
$row_buscaqd = mysqli_fetch_assoc($buscaqd);

$nomesolicitante = $row_buscaqd['nome_solicitante'];
$emailsolicitante = $row_buscaqd['email_solicitante'];
$tipocadeira = $row_buscaqd['tipo_cadeira'];

$qdo = "SELECT * FROM rfa_cr_doador WHERE id_doador='$iddoador' AND clube='$clube'";
$buscaqdo = mysqli_query($link, $qdo) or die(mysqli_error($link));
$row_buscaqdo = mysqli_fetch_assoc($buscaqdo);

$nomedoador = $row_buscaqdo['nome_doador'];
$emaildoador = $row_buscaqdo['email_doador'];
$cidadedoador = $row_buscaqdo['cid_doador'];
$estadodoador = $row_buscaqdo['uf_doador'];

if($tipocadeira == "cadeira-rodas"){
	$cadeira = "Cadeira de Rodas";
}else{
	$cadeira = "Cadeira de Banho";
}

// Script para envio de e-mail referente ao pedido
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

		require("phpmailer/vendor/autoload.php");
			
			$mail = new PHPMailer(true);

			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->IsSMTP(); // Define que a mensagem será SMTP
			$mail->Host = $row_buscadados['host']; // Endereço do servidor SMTP
			$mail->SMTPAuth = true; // Autenticação
			$mail->Username = $row_buscadados['username']; // Usuário do servidor SMTP
			$mail->Password = $row_buscadados['password']; // Senha da caixa postal utilizada
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                 // Habilita criptografia TLS | 'ssl' também é possível
			$mail->Port = 587;   

			$mail->From = $row_buscadados['email_smtp']; 
			$mail->FromName = 'RC '.$nomeclube;

			//$mail->AddAddress($emailteste, $enviadopor);
			$mail->AddAddress($emailsolicitante, $nomesolicitante);
			$mail->AddCC($emailclube); 
			
			//$mail->AddBCC($valores);
			//$mail->AddBCC($valores2);
			//$mail->AddBCC($valores3);

			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

			$mail->Subject  = 'Você recebeu uma doação'; // Assunto da mensagem
			$mail->Body = '
<table cellpadding="0" cellspacing="0" border="0" width="600" style="font-family: calibri;">
	
	<tr>
		<td style="text-align:center; padding: 20px">
			<strong>Prezado(a) '.$nomesolicitante.'</strong><br>
			Você recebeu uma doação de uma '.$cadeira.' através do site do clube de Rotary '.$nomeclube.'.
		</td>
	</tr>
	<tr>
		<td style="padding: 30px;">
			<table cellpadding="0" cellspacing="0" style="width: 100%">
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Nome do Doador:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$nomedoador.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Região do doador:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$cidadedoador.' - '.$estadodoador.'</td>
				</tr>
			</table>

		
		</td>
	</tr>
	<tr>
		<td style="text-align:center; padding: 20px">
			<strong>É importante que compareça ao clube onde realizou sua solicitação com o protocolo e documentação em mãos, assim poderá realizar a retirada de sua '.$cadeira.'.</strong><br><br>
			<strong>'.$nomeclube.'</strong><br>
			<strong>Endereço:</strong> '.$enderecoclube.', '.$numeroclube.', '.$bairroclube.', '.$cidadeclube.', '.$estadoclube.', '.$cepclube.'
		</td>
	</tr>
	<tr>
		<td style="background: #3689e9; height: 7px; border:0;"></td>
	</tr>
	<tr>
		<td style="background: #d1f3fc; height: 81px; border: 0; text-align:center;">
			<a href="https://clubedigital.ong.br"><img src="https://'.$_SERVER['HTTP_HOST'].'/'.basename(__DIR__).'/images/logo-cartao-de-recuperacao.png"></a>
		</td>
	</tr>
</table>
			
			 ';
			//$mail->AltBody = 'Este é o corpo da mensagem de teste, em Texto Plano! \r\n 
			//<IMG src="http://seudominio.com.br/imagem.jpg" alt=5":)"  class="wp-smiley"> ';

			//$mail->AddAttachment("e:\home\login\web\documento.pdf", "novo_nome.pdf");

			

		// Fim script para envio de e-mail referente ao pedido

$sql = "UPDATE rfa_cr_solicitante SET id_doador='$iddoador' WHERE clube='$clube' AND id_solicitante='$idsolicitante';";
	$sql .= "UPDATE rfa_cr_doador SET id_solicitante='$idsolicitante' WHERE clube='$clube' AND id_doador='$iddoador';";
	
	if ($link->multi_query($sql) === TRUE && $mail->Send()) {
		echo "<script>javascript:alert('Pronto! A doação foi vinculada com sucesso!');javascript:window.location='solicitantes-cr.php'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();





	

?>