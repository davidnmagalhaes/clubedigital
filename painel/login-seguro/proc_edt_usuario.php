<?php
require "conexao.php";



$conexao = Conexao::getInstance();

$funcao = $_POST['funcao'];
$nome = $_POST['nome_usuario'];
$email = $_POST['email_usuario'];
$user = $_POST['user'];
$club = $_POST['club'];
$pass = $_POST['senha_usuario'];
//$usuario = $_POST['usuario'];
$senha = password_hash($_POST['senha_usuario'],PASSWORD_DEFAULT);
$plano = $_POST['plano'];

$formapagamento = $_POST['formapagamento'];
$clube = $_POST['clube'];

/*VariA?veis do upload de imagens*/
	$imagem = $_FILES['imagem']['name'];
	$temporario = $_FILES['imagem']['tmp_name'];
	$diretorio = "images/usuarios/".date('D-M-Y-H-i').$imagem;	


//$senha = password_hash('copadomundo94', PASSWORD_DEFAULT);

// Insere usuários no banco de dados

if($imagem == NULL){}else{
$s = "UPDATE rfa_usuario SET imagem='{$diretorio}' WHERE id_usuario='{$user}'";
$sr = $conexao->prepare($s);
$exec = $sr->execute();

move_uploaded_file($temporario,$diretorio);
}

if($pass == ""){
$sql = "UPDATE rfa_usuario SET nome='{$nome}', email='{$email}', funcao='{$funcao}', plano='{$plano}', forma_pagamento='{$formapagamento}' WHERE id_usuario='{$user}'";
$stm = $conexao->prepare($sql);
$executa = $stm->execute();
}else{
$sql = "UPDATE rfa_usuario SET nome='{$nome}', email='{$email}', senha='{$senha}', funcao='{$funcao}', plano='{$plano}', forma_pagamento='{$formapagamento}' WHERE id_usuario='{$user}'";
$stm = $conexao->prepare($sql);
$executa = $stm->execute();
}



if($clube == ""){}else{
$sq = "UPDATE rfa_clubes SET nome_clube='{$clube}' WHERE id_clube='{$club}'";
$st = $conexao->prepare($sq);
$execut = $st->execute();
}



if($stm->execute() === true){
	
		echo "<script>javascript:alert('Usu\u00e1rio atualizado com sucesso!');javascript:window.location='../administracao.php'</script>";
}else{
		echo "<script>javascript:alert('Erro! Tente novamente mais tarde');javascript:window.location='../administracao.php'</script>";
		//print_r($stm->errorInfo());
}


?>