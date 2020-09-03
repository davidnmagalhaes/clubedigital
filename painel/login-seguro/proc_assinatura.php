<?php
require "conexao.php";

$funcao = 2;
$nome = $_POST['primeiro_nome'];
$ultnome = $_POST['ultimo_nome'];
$nomecompleto = $nome." ".$ultnome;
$email = $_POST['email'];
$datanascimento = $_POST['datanascimento'];
$nomeclube = $_POST['clube'];
$distrito = $_POST['distrito'];
$cep = $_POST['cep'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$telefone = $_POST['telefone'];
$whatsapp = $_POST['whatsapp'];
$cnpj = $_POST['cnpj'];

$conexao = Conexao::getInstance();
$stmt = $conexao->prepare("SELECT * FROM rfa_usuario WHERE email='$email'");
$stmt->execute();
$number_of_rows = $stmt->fetchColumn();

if($number_of_rows > 0){
	echo "<script>javascript:alert('O e-mail j\u00e1rio existe, tente cadastrar com outro e-mail.');javascript:window.location='../../register'</script>";

}else{


	/*$select = $conexao->query("
	SELECT *
	FROM rfa_clubes
	ORDER BY id_clube DESC");
	$result = $select->fetch(PDO::FETCH_ASSOC);*/
	
	
	//Start - Gera ID e Verifica se existe
	$coduser = date('YmdHi').rand(10,99);
	//End - Gera ID e Verifica se existe
	
	//Start - Gera ID e Verifica se existe
	$codbanco = date('YmdHi').rand(10,99);
	//End - Gera ID e Verifica se existe
	
	//Start - Gera ID e Verifica se existe
	$codlisbanco = date('YmdHi').rand(10,99);
	//End - Gera ID e Verifica se existe
	
	//Start - Gera ID e Verifica se existe
	$codtipobanco = date('YmdHi').rand(10,99);

	
	$cdlisbanc = $codlisbanco;
	$cdtipobanc = $codtipobanco;


//$usuario = $_POST['usuario'];
$senha = password_hash($_POST['senha'],PASSWORD_DEFAULT);

/*$select2 = $conexao->query("
SELECT *
FROM rfa_planos
WHERE id_plano = '$plano'");
$result2 = $select2->fetch(PDO::FETCH_ASSOC);
$codplano = $result2['cod_plano'];*/

//$formapagamento = $_POST['formapagamento'];

$lastclub = date('YmdHi').rand(10,99);
$datacadastro = date("Y-m-d");

// Insere usuários no banco de dados

$sql = "INSERT INTO rfa_usuario(datanascimento, cod_usuario, nome, email, senha, funcao, plano, clube, status, ativo, data_cadastro)VALUES('{$datanascimento}','{$coduser}','{$nomecompleto}', '{$email}', '{$senha}', '{$funcao}', '{$plano}', '{$lastclub}', 'A', 1, '{$datacadastro}')";
$stm = $conexao->prepare($sql);
$executa = $stm->execute();

$sqc = "INSERT INTO rfa_clubes(data_cadastro, id_clube, nome_clube, cep_clube, endereco_clube, numero_clube, bairro_clube, cidade_clube, estado_clube, telefone_clube, email_clube, whatsapp, distrito, cnpj_clube)VALUES('{$datacadastro}','{$lastclub}','{$nomeclube}', '{$cep}', '{$endereco}', '{$numero}', '{$bairro}', '{$cidade}', '{$estado}', '{$telefone}', '{$email}','{$whatsapp}', '{$distrito}', '{$cnpj}')";
$stc = $conexao->prepare($sqc);
$executc = $stc->execute();

$sv = "INSERT INTO rfa_lista_bancos(cod_lista_banco, nome_lista_banco, clube)VALUES('{$codlisbanco}','Caixa', '{$lastclub}')";
$stv = $conexao->prepare($sv);
$executv = $stv->execute();

$slt = "INSERT INTO rfa_lista_tipo_banco(cod_lista_tipo_banco, nome_lista_tipo, clube)VALUES('{$codtipobanco}','Caixa', '{$lastclub}')";
$stlt = $conexao->prepare($slt);
$executlt = $stlt->execute();

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


if($executa){
		//echo "<script>javascript:window.location='https://sandbox.pagseguro.uol.com.br/v2/pre-approvals/request.html?code=".$codplano."'</script>";
		echo "<script>javascript:alert('Sucesso!');javascript:window.location='../../register/index.php'</script>";
}else{
		echo "<script>javascript:alert('Erro! Tente novamente mais tarde');javascript:window.location='../../register/index.php'</script>";
}

}
?>