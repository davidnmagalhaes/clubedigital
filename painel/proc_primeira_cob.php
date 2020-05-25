<?php 
//Conexão com banco de dados
include_once("config.php");

$idsocio = $_GET['id_socio'];
$clube = $_GET['clube'];
$codmens = $_GET['codmens'];

$q = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.cod_mensalidade='$codmens' AND rfa_mensalidades.clube='$clube'";
$buscamensa = mysqli_query($link, $q) or die(mysqli_error($link));
$row_buscamensa = mysqli_fetch_assoc($buscamensa);

$nomesocio = $row_buscamensa['nome_socio'];
$emailsocio = $row_buscamensa['email_socio'];
$valormensalidade = number_format($row_buscamensa['valor_mensalidade'],2,',','.');
$vencimento = date('d/m/Y',strtotime($row_buscamensa['data_mensalidade']));

$query = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$buscaclube = mysqli_query($link, $query) or die(mysqli_error($link));
$row_buscaclube = mysqli_fetch_assoc($buscaclube);

$nomeclube = $row_buscaclube['nome_clube'];
$emailclube = $row_buscaclube['email_clube'];

$qdados = "SELECT * FROM rfa_config_email WHERE id_config='1'";
$buscadados = mysqli_query($link, $qdados) or die(mysqli_error($link));
$row_buscadados = mysqli_fetch_assoc($buscadados);
	
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
			$mail->AddAddress($emailsocio, $nomesocio);
			$mail->AddCC($emailclube); 
			
			//$mail->AddBCC($valores);
			//$mail->AddBCC($valores2);
			//$mail->AddBCC($valores3);

			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

			$mail->Subject  = 'Lembrete para pagamento de mensalidade'; // Assunto da mensagem
			$mail->Body = '
<table cellpadding="0" cellspacing="0" border="0" width="600" style="font-family: calibri;">
	
	<tr>
		<td style="text-align:center; padding: 20px">
			<strong>Prezado(a) companheiro(a) do RC '.$nomeclube.',</strong><br>
			Ainda não identificamos em nosso sistema o pagamento de uma de suas mensalidades no clube associado.
		</td>
	</tr>
	<tr>
		<td style="padding: 30px;">
			<table cellpadding="0" cellspacing="0" style="width: 100%">
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Nome do Sócio:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$nomesocio.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Vencimento da mensalidade:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$vencimento.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Valor da mensalidade:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">R$ '.$valormensalidade.'</td>
				</tr>
			</table>

		
		</td>
	</tr>
	<tr>
		<td style="text-align:center; padding: 20px">
			<strong>Caso já tenha pago a mensalidade ignore este lembrete.</strong>
			
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

if ($mail->Send()) {
		echo "<script>javascript:alert('Primeira cobrança enviada com sucesso!');javascript:window.location='home.php'</script>";
	
	} else {
		echo "<script>javascript:alert('Não foi possível enviar a recuperação! Tente novamente mais tarde. Erro: ".$mail->ErrorInfo."');javascript:window.location='home.php'</script>";
	}

?>