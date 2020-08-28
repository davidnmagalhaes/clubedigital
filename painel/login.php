<?php
session_start();

// Constante com a quantidade de tentativas aceitas
define('TENTATIVAS_ACEITAS', 5); 

// Constante com a quantidade minutos para bloqueio
define('MINUTOS_BLOQUEIO', 30); 

// Require da classe de conexão
require 'conexao.php';

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {
    echo "<script>javascript:alert('Por medida de segurança você precisa confirmar o Recaptcha!');javascript:window.location='..index.php'</script>";
}else{

	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfxI-oUAAAAAJHf9arBHYIDSLWa6d9dGYGDG-AD&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

	if ($resposta.success) {
// Dica 1 - Verifica se a origem da requisição é do mesmo domínio da aplicação
/*if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "https://www.clubedigital.ong.br/painel/index.php"):
	$retorno = array('codigo' => 0, 'mensagem' => 'Origem da requisição não autorizada!');
	//echo json_encode($retorno);
	echo "<script>javascript:alert('".$retorno['mensagem']."');javascript:window.location='../index.php'</script>";
	exit();
endif;*/


// Instancia Conexão PDO
$conexao = Conexao::getInstance();

// Recebe os dados do formulário
$email = (isset($_POST['email'])) ? $_POST['email'] : '' ;
$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '' ;


// Dica 2 - Validações de preenchimento e-mail e senha se foi preenchido o e-mail
if (empty($email)):
	$retorno = array('codigo' => 0, 'mensagem' => 'Preencha seu e-mail!');
	echo json_encode($retorno);
	exit();
endif;

if (empty($senha)):
	$retorno = array('codigo' => 0, 'mensagem' => 'Preencha sua senha!');
	echo json_encode($retorno);
	exit();
endif;


// Dica 3 - Verifica se o formato do e-mail é válido
if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
    $retorno = array('codigo' => 0, 'mensagem' => 'Formato de e-mail inválido!');
	echo json_encode($retorno);
	exit();
endif;


// Dica 4 - Verifica se o usuário já excedeu a quantidade de tentativas erradas do dia
$sql = "SELECT count(*) AS tentativas, MINUTE(TIMEDIFF(NOW(), MAX(data_hora))) AS minutos ";
$sql .= "FROM rfa_log_tentativa WHERE ip = ? and DATE_FORMAT(data_hora,'%Y-%m-%d') = ? AND bloqueado = ?";
$stm = $conexao->prepare($sql);
$stm->bindValue(1, $_SERVER['SERVER_ADDR']);
$stm->bindValue(2, date('Y-m-d'));
$stm->bindValue(3, 'SIM');
$stm->execute();
$retorno = $stm->fetch(PDO::FETCH_OBJ);

if (!empty($retorno->tentativas) && intval($retorno->minutos) <= MINUTOS_BLOQUEIO):
	$_SESSION['tentativas'] = 0;
	$retorno = array('codigo' => 0, 'mensagem' => 'Você excedeu o limite de '.TENTATIVAS_ACEITAS.' tentativas, login bloqueado por '.MINUTOS_BLOQUEIO.' minutos!');
	//echo json_encode($retorno);
	echo "<script>javascript:alert('".$retorno['mensagem']."');javascript:window.location='../index.php'</script>";
	exit();
endif;


// Dica 5 - Válida os dados do usuário com o banco de dados
$sql = 'SELECT cod_usuario, nome, senha, email, funcao, imagem, clube FROM rfa_usuario WHERE email = ? AND status = ? LIMIT 1';
$stm = $conexao->prepare($sql);
$stm->bindValue(1, $email);
$stm->bindValue(2, 'A');
$stm->execute();
$retorno = $stm->fetch(PDO::FETCH_OBJ);


// Dica 6 - Válida a senha utlizando a API Password Hash
if(!empty($retorno) && password_verify($senha, $retorno->senha)):
	$_SESSION['id_usuario'] = $retorno->cod_usuario;
	$_SESSION['nome'] = $retorno->nome;
	$_SESSION['email'] = $retorno->email;
	$_SESSION['funcao'] = $retorno->funcao;
	$_SESSION['imagem'] = $retorno->imagem;
	$_SESSION['clube'] = $retorno->clube;
	$_SESSION['tentativas'] = 0;
	$_SESSION['logado'] = 'SIM';
else:
	$_SESSION['logado'] = 'NAO';
	$_SESSION['tentativas'] = (isset($_SESSION['tentativas'])) ? $_SESSION['tentativas'] += 1 : 1;
	$bloqueado = ($_SESSION['tentativas'] == TENTATIVAS_ACEITAS) ? 'SIM' : 'NAO';

	// Dica 7 - Grava a tentativa independente de falha ou não
	$sql = 'INSERT INTO rfa_log_tentativa (ip, email, senha, origem, bloqueado) VALUES (?, ?, ?, ?, ?)';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(1, $_SERVER['SERVER_ADDR']);
	$stm->bindValue(2, $email);
	$stm->bindValue(3, $senha);
	$stm->bindValue(4, $_SERVER['HTTP_REFERER']);
	$stm->bindValue(5, $bloqueado);
	$stm->execute();
endif;


// Se logado envia código 1, senão retorna mensagem de erro para o login
if ($_SESSION['logado'] == 'SIM'):
	$retorno = array('codigo' => 1, 'mensagem' => 'Parabéns, você está no sistema de gestão do Rotary!');
	//echo json_encode($retorno);
	echo "<script>javascript:window.location='../home.php'</script>";
	exit();
else:
	if ($_SESSION['tentativas'] == TENTATIVAS_ACEITAS):
		$retorno = array('codigo' => 0, 'mensagem' => 'Você excedeu o limite de '.TENTATIVAS_ACEITAS.' tentativas, login bloqueado por '.MINUTOS_BLOQUEIO.' minutos!');
		//echo json_encode($retorno);
		echo "<script>javascript:alert('".$retorno['mensagem']."');javascript:window.location='../index.php'</script>";
		exit();
	else:
		$retorno = array('codigo' => '0', 'mensagem' => 'Usuário não autorizado, você tem mais '. (TENTATIVAS_ACEITAS - $_SESSION['tentativas']) .' tentativa(s) antes do bloqueio!');
		//echo json_encode($retorno);
		echo "<script>javascript:alert('".$retorno['mensagem']."');javascript:window.location='../index.php'</script>";
		exit();
	endif;
endif;


} else {
	    echo "Usuário mal intencionado detectado. A mensagem não foi enviada.";
	    exit;
	}

}

?>