<?php 
//Conexão com banco de dados
include_once("config.php");

$codrec = mysqli_real_escape_string($link,$_GET['cod_rec']);
$clube = mysqli_real_escape_string($link,$_GET['clube']);

$query = "SELECT * FROM rfa_recuperantes WHERE cod_recuperante='$codrec' AND clube='$clube'";
$buscarec = mysqli_query($link, $query) or die(mysqli_error($link));
$row_buscarec = mysqli_fetch_assoc($buscarec);

$idpauta = $row_buscarec['id_pauta'];
$nomerecuperante = $row_buscarec['nome_recuperante'];
$emailrecuperante = $row_buscarec['email_recuperante'];
$emailclube = $row_buscarec['email_clube'];
$cluberecuperante = $row_buscarec['clube_recuperante'];

$q = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$pegaclube = mysqli_query($link, $q) or die(mysqli_error($link));
$row_pegaclube = mysqli_fetch_assoc($pegaclube);
$nomeclube = $row_pegaclube['nome_clube'];
$emailclubevisitado = $row_pegaclube['email_clube'];

$qs = "SELECT * FROM rfa_usuario WHERE clube='$clube' AND funcao=2";
$pegauser = mysqli_query($link, $qs) or die(mysqli_error($link));
$row_pegauser = mysqli_fetch_assoc($pegauser);
$presidente = $row_pegauser['nome'];

$ql = "SELECT * FROM rfa_pauta WHERE clube='$clube' AND cod_pauta='$idpauta'";
$pegalocal = mysqli_query($link, $ql) or die(mysqli_error($link));
$row_pegalocal = mysqli_fetch_assoc($pegalocal);
$local = $row_pegalocal['id_local'];
$refreuniao = $row_pegalocal['ref_reuniao'];
$inicioreuniao = date('H:i',strtotime($row_pegalocal['inicio_reuniao']));

$qre = "SELECT * FROM rfa_reuniao WHERE clube='$clube' AND id_reuniao='$refreuniao'";
$pegareuniao = mysqli_query($link, $qre) or die(mysqli_error($link));
$row_pegareuniao = mysqli_fetch_assoc($pegareuniao);
$nomereuniao = $row_pegareuniao['nome_reuniao'];
$datareuniao = date('d/m/Y',strtotime($row_pegareuniao['data_reuniao']));

$qel = "SELECT * FROM rfa_local_reuniao WHERE clube='$clube' AND id_local='$local'";
$exibelocal = mysqli_query($link, $qel) or die(mysqli_error($link));
$row_exibelocal = mysqli_fetch_assoc($exibelocal);
$nomelocal = $row_exibelocal['nome_local'];
$ceplocal = $row_exibelocal['cep_local'];
$logradourolocal = $row_exibelocal['logradouro_local'];
$numerolocal = $row_exibelocal['numero_local'];
$bairrolocal = $row_exibelocal['bairro_local'];
$cidadelocal = $row_exibelocal['cidade_local'];
$uflocal = $row_exibelocal['uf_local'];

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
			$mail->AddAddress($emailrecuperante, $nomerecuperante);
			$mail->AddCC($emailclube); 
			
			//$mail->AddBCC($valores);
			//$mail->AddBCC($valores2);
			//$mail->AddBCC($valores3);

			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

			$mail->Subject  = 'Recuperação de Sócio'; // Assunto da mensagem
			$mail->Body = '
<table cellpadding="0" cellspacing="0" border="0" width="600" style="font-family: calibri;">
	<tr>
		<td><img src="https://'.$_SERVER['HTTP_HOST'].'/'.basename(__DIR__).'/images/topo-cartao-de-recuperacao.jpg"></td>
	</tr>
	<tr>
		<td style="text-align:center; padding: 20px">
			<strong>Prezados companheiros do RC Fortaleza Oeste,</strong><br>
			Um de seus sócios compareceu em nosso clube, participando de uma reunião e solicitando o <strong>cartão de recuperação</strong>.
		</td>
	</tr>
	<tr>
		<td style="padding: 30px;">
			<table cellpadding="0" cellspacing="0" style="width: 100%">
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Nome do Recuperante:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$nomerecuperante.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Clube do Recuperante:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$cluberecuperante.'</td>
				</tr>
			</table>

			<table cellpadding="0" cellspacing="0" style="width: 100%; margin-top: 20px">
				<tr>
					<td colspan="2" style="text-align:center"><h2>Informações do Clube Visitado</h2></td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Clube:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$nomeclube.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Presidente:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$presidente.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Local:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$nomelocal.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Endereço:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$logradourolocal.', '.$numerolocal.', '.$bairrolocal.', '.$cidadelocal.', '.$uflocal.', '.$ceplocal.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Reunião:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$nomereuniao.'</td>
				</tr>
				<tr>
					<th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Data e Hora:</th>
					<td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$datareuniao.' às '.$inicioreuniao.'</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center; padding: 20px">
						Este cartão de recuperação foi emitido pelo clube visitado. Caso tenha dúvidas entre em contato através do e-mail <a href="mailto:'.$emailclubevisitado.'"><strong>'.$emailclubevisitado.'</strong></a>
					</td>
				</tr>
			</table>
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
		echo "<script>javascript:alert('Recuperações enviadas com sucesso!');javascript:window.location='emitir-recuperante.php?cod_pauta=".$idpauta."&clube=".$clube."'</script>";
	
	} else {
		echo "<script>javascript:alert('Não foi possível enviar a recuperação! Tente novamente mais tarde. Erro: ".$mail->ErrorInfo."');javascript:window.location='emitir-recuperante.php?cod_pauta=".$idpauta."&clube=".$clube."'</script>";
	}

?>