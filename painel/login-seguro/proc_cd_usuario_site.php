<?php
require "conexao.php";

$funcao = 2;
$nome = $_POST['nomepresidente'];
$email = $_POST['emailclube'];

$conexao = Conexao::getInstance();
$stmt = $conexao->prepare("SELECT * FROM rfa_usuario WHERE email='$email'");
$stmt->execute();
$number_of_rows = $stmt->fetchColumn();

$select = $conexao->query("
SELECT *
FROM rfa_clubes
ORDER BY id_clube DESC");
$result = $select->fetch(PDO::FETCH_ASSOC);


//Start - Gera ID e Verifica se existe
$coduser = rand();


$stmu = $conexao->prepare("SELECT * FROM rfa_usuario WHERE cod_usuario='$coduser'");
$stmu->execute();
$numberrows_user = $stmu->fetchColumn();

if($numberrows_user > 0){
	$coduser += rand();
}

//End - Gera ID e Verifica se existe

//Start - Gera ID e Verifica se existe
$codbanco = rand();

$stmb = $conexao->prepare("SELECT * FROM rfa_bancos WHERE cod_banco='$codbanco'");
$stmb->execute();
$numberrows_banco = $stmb->fetchColumn();

if($numberrows_banco > 0){
	$codbanco += rand();
}

//End - Gera ID e Verifica se existe

//Start - Gera ID e Verifica se existe
$codlisbanco = rand();


$stm = $conexao->prepare("SELECT * FROM rfa_lista_bancos WHERE cod_lista_banco='$codlisbanco'");
$stm->execute();
$numberrows_listabanco = $stm->fetchColumn();

if($numberrows_listabanco > 0){
	$codlisbanco += rand();
}

//End - Gera ID e Verifica se existe

//Start - Gera ID e Verifica se existe
$codtipobanco = rand();


$stmp = $conexao->prepare("SELECT * FROM rfa_lista_tipo_banco WHERE cod_lista_tipo_banco='$codtipobanco'");
$stmp->execute();
$numberrows_tipobanco = $stmp->fetchColumn();

if($numberrows_tipobanco > 0){
	$codtipobanco += rand();
}

$cdlisbanc = $codlisbanco;
$cdtipobanc = $codtipobanco;

//End - Gera ID e Verifica se existe


if($number_of_rows > 0){
	echo "<script>javascript:alert('O e-mail j\u00e1rio existe, tente cadastrar com outro e-mail.');javascript:window.location='../cd_usuario.php'</script>";

}else{



//$usuario = $_POST['usuario'];
$senha = password_hash($_POST['senha'],PASSWORD_DEFAULT);
$plano = $_POST['plano'];

$formapagamento = $_POST['formapagamento'];
$clube = $_POST['clube'];
$atvclube = $_POST['ativaclube'];

if($atvclube == 1){
$lastclub = $result['id_clube'] + 1;
}else{
$lastclub = $clube;
}

$cep = $_POST['cep_clube'];
$endereco = $_POST['endereco_clube'];
$numero = $_POST['numero_clube'];
$bairro = $_POST['bairro_clube'];
$cidade = $_POST['cidade_clube'];
$estado = $_POST['estado_clube'];
$telefone = $_POST['telefone_clube'];
$emailclube = $_POST['email_clube'];

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

$sql = "INSERT INTO rfa_usuario(cod_usuario, nome, email, senha, status, funcao, plano, forma_pagamento, clube)VALUES('{$coduser}','{$nome}', '{$email}', '{$senha}', 'Ativo', '{$funcao}', '{$plano}', '{$formapagamento}', '{$lastclub}')";
$stm = $conexao->prepare($sql);
$executa = $stm->execute();

if($atvclube == 1){
$sqc = "INSERT INTO rfa_clubes(nome_clube, cep_clube, endereco_clube, numero_clube, bairro_clube, cidade_clube, estado_clube, telefone_clube, email_clube)VALUES('{$clube}', '{$cep}', '{$endereco}', '{$numero}', '{$bairro}', '{$cidade}', '{$estado}', '{$telefone}', '{$emailclube}')";
$stc = $conexao->prepare($sqc);
$executc = $stc->execute();
}

$sv = "INSERT INTO rfa_lista_bancos(cod_lista_banco, nome_lista_banco, clube)VALUES('{$codlisbanco}','Caixa', '{$lastclub}')";
$stv = $conexao->prepare($sv);
$executv = $stv->execute();

$slt = "INSERT INTO rfa_lista_tipo_banco(cod_lista_tipo_banco, nome_lista_tipo, clube)VALUES('{$codtipobanco}','Caixa', '{$lastclub}')";
$stlt = $conexao->prepare($slt);
$executlt = $stlt->execute();

$datacadastro = date("Y-m-d");
$s = "INSERT INTO rfa_bancos(cod_banco, favorecido, saldo, ativo, clube, data_cadastro, banco, tipo_conta)VALUES('{$codbanco}','Caixa', '0.00', '1', '{$lastclub}', '{$datacadastro}', '{$cdlisbanc}', '{$cdtipobanc}')";
$st = $conexao->prepare($s);
$exec = $st->execute();

//Níveis
$nivel_presidente = 2;
$nivel_secretario = 3;
$nivel_contador = 4;
$nivel_secretarioex = 5;
$nivel_tesoureiro = 6;

//Páginas
$pagina1 = 1;
$pagina2 = 2;
$pagina3 = 3;
$pagina4 = 4;
$pagina5 = 5;
$pagina6 = 6;
$pagina7 = 7;
$pagina8 = 8;
$pagina9 = 9;
$pagina10 = 10;
$pagina11 = 11;

$libera = 1;

//Presidente
$sper1 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina1}', '{$libera}', '{$lastclub}')";
$spermi1 = $conexao->prepare($sper1);
$execupermi1 = $spermi1->execute();

$sper2 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina2}', '{$libera}', '{$lastclub}')";
$spermi2 = $conexao->prepare($sper2);
$execupermi2 = $spermi2->execute();

$sper3 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina3}', '{$libera}', '{$lastclub}')";
$spermi3 = $conexao->prepare($sper3);
$execupermi3 = $spermi3->execute();

$sper4 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina4}', '{$libera}', '{$lastclub}')";
$spermi4 = $conexao->prepare($sper4);
$execupermi4 = $spermi4->execute();

$sper5 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina5}', '{$libera}', '{$lastclub}')";
$spermi5 = $conexao->prepare($sper5);
$execupermi5 = $spermi5->execute();

$sper6 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina6}', '{$libera}', '{$lastclub}')";
$spermi6 = $conexao->prepare($sper6);
$execupermi6 = $spermi6->execute();

$sper7 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina7}', '{$libera}', '{$lastclub}')";
$spermi7 = $conexao->prepare($sper7);
$execupermi7 = $spermi7->execute();

$sper8 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina8}', '{$libera}', '{$lastclub}')";
$spermi8 = $conexao->prepare($sper8);
$execupermi8 = $spermi8->execute();

$sper9 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina9}', '{$libera}', '{$lastclub}')";
$spermi9 = $conexao->prepare($sper9);
$execupermi9 = $spermi9->execute();

$sper10 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina10}', '{$libera}', '{$lastclub}')";
$spermi10 = $conexao->prepare($sper10);
$execupermi10 = $spermi10->execute();

$sper11 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_presidente}','{$pagina11}', '{$libera}', '{$lastclub}')";
$spermi11 = $conexao->prepare($sper11);
$execupermi11 = $spermi11->execute();

//Página principal para demais funções
$sper12 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_secretario}','{$pagina1}', '{$libera}', '{$lastclub}')";
$spermi12 = $conexao->prepare($sper12);
$execupermi12 = $spermi12->execute();

$sper13 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_contador}','{$pagina1}', '{$libera}', '{$lastclub}')";
$spermi13 = $conexao->prepare($sper13);
$execupermi13 = $spermi13->execute();

$sper14 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_secretarioex}','{$pagina1}', '{$libera}', '{$lastclub}')";
$spermi14 = $conexao->prepare($sper14);
$execupermi14 = $spermi14->execute();

$sper15 = "INSERT INTO rfa_acesso_paginas(nivel_acesso, pagina_id, consulta_acesso, clube)VALUES('{$nivel_tesoureiro}','{$pagina1}', '{$libera}', '{$lastclub}')";
$spermi15 = $conexao->prepare($sper15);
$execupermi15 = $spermi15->execute();




move_uploaded_file($temporario,$diretorio);

if($executa){
	
		echo "<script>javascript:window.location='../crop-usuarios.php?cod_usuario=".$coduser."'</script>";
}else{
		echo "<script>javascript:alert('Erro! Tente novamente mais tarde');javascript:window.location='../administracao.php'</script>";
}

}
?>