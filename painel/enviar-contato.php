<?php 
//Conexão com banco de dados
include_once("config.php");

// Script para envio de e-mail referente ao pedido
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("phpmailer/vendor/autoload.php");

$nome = $_POST['nome'];
$email= $_POST['email'];
$telefone= $_POST['telefone'];
$mensagem= $_POST['mensagem'];

$qdados = "SELECT * FROM rfa_config_email WHERE id_config='1'";
$buscadados = mysqli_query($link, $qdados) or die(mysqli_error($link));
$row_buscadados = mysqli_fetch_assoc($buscadados);

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data):
    echo "<script>javascript:alert('Por medida de segurança você precisa confirmar o Recaptcha no final do formulário!');javascript:window.location='../inicio'</script>";
else:

	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$row_buscadados['secretkey_recaptcha']."&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($resposta.success):
			
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
			$mail->FromName = 'Clube Digital';

			//$mail->AddAddress($emailteste, $enviadopor);
			$mail->AddAddress($email, $nome);
			$mail->AddCC('social@afetur.com.br'); 
			
			//$mail->AddBCC($valores);
			//$mail->AddBCC($valores2);
			//$mail->AddBCC($valores3);

			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

			$mail->Subject  = 'Contato - Clube Digital'; // Assunto da mensagem
			$mail->Body = '
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="font-family: calibri;">
	
            <tr>
                <td style="text-align:center; padding: 20px">
                    <strong>Prezado(a) '.$nome.',</strong><br>
                    Recebemos seu contato! Em breve entraremos em contato.
                </td>
            </tr>
            <tr>
                <td style="padding: 30px;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%">
                        <tr>
                            <th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Nome:</th>
                            <td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$nome.'</td>
                        </tr>
                        <tr>
                            <th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">E-mail:</th>
                            <td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$email.'</td>
                        </tr>
                        <tr>
                            <th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Telefone:</th>
                            <td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$telefone.'</td>
                        </tr>
                        <tr>
                            <th style="width: 30%; padding: 3px; background: #7d7d7d; color: #fff; border: 2px solid #fff;">Mensagem:</th>
                            <td style="width: 65%; padding: 3px 3px 3px 6px; background: #e6e6e6; border: 2px solid #fff;">'.$mensagem.'</td>
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
		echo "<script>javascript:alert('Obrigado por entrar em contato! Em breve retornaremos.');javascript:window.location='../inicio'</script>";
	
	} else {
		echo "<script>javascript:alert('Não foi possível enviar sua mensagem! Tente novamente mais tarde. Erro: ".$mail->ErrorInfo."');javascript:window.location='../inicio'</script>";
	}


endif;
endif;
?>