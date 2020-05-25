<?php
require "conexao.php";

$funcao = $_POST['funcao'];
$nome = $_POST['nome_usuario'];
$email = $_POST['email_usuario'];

$conexao = Conexao::getInstance();
$stmt = $conexao->prepare("SELECT * FROM rfa_usuario WHERE email='$email'");
$stmt->execute();
$number_of_rows = $stmt->fetchColumn();


if($number_of_rows > 0){
	echo "<script>javascript:alert('O e-mail j\u00e1rio existe, tente cadastrar com outro e-mail.');javascript:window.location='../equipe.php'</script>";

}else{


//$usuario = $_POST['usuario'];
$senha = password_hash($_POST['senha_usuario'],PASSWORD_DEFAULT);

$clube = $_POST['club'];

/*VariA?veis do upload de imagens*/
	$imagem = $_FILES['imagem']['name'];
	$temporario = $_FILES['imagem']['tmp_name'];
	
	if($imagem == NULL){
	$diretorio = "images/usuarios/avatar.jpg";	
	}else{
	$diretorio = "images/usuarios/".date('D-M-Y-H-i').$imagem;	
	}

//$senha = password_hash('copadomundo94', PASSWORD_DEFAULT);

// Insere usuários no banco de dados
$coduser = rand();


$stmu = $conexao->prepare("SELECT * FROM rfa_usuario WHERE cod_usuario='$coduser'");
$stmu->execute();
$numberrows_user = $stmu->fetchColumn();

if($numberrows_user > 0){
	$coduser += rand();
}

$sql = "INSERT INTO rfa_usuario(cod_usuario, nome, email, senha, status, funcao, clube)VALUES('{$coduser}','{$nome}', '{$email}', '{$senha}', 'Ativo', '{$funcao}','{$clube}')";
$stm = $conexao->prepare($sql);
$executa = $stm->execute();

move_uploaded_file($temporario,$diretorio);

if($executa){
	
		echo "<script>javascript:alert('Usu\u00e1rio cadastrado com sucesso!');javascript:window.location='../crop-usuarios.php?cod_usuario=".$coduser."'</script>"; 
}else{
		echo "<script>javascript:alert('Erro! Tente novamente mais tarde');javascript:window.location='../equipe.php'</script>";
}

}
?>