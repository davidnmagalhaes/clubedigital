<?php 
//Conexão com banco de dados
include_once("config.php");

session_start();

$clube = $_SESSION['clube'];
$page = mysqli_real_escape_string($link,$_POST['page']);

//Busca ativo ou não ativo via post do formulário permissoes.php
$presidente = mysqli_real_escape_string($link,$_POST['presidente']);
$secretario = mysqli_real_escape_string($link,$_POST['secretario']);
$contador = mysqli_real_escape_string($link,$_POST['contador']);
$secretarioex = mysqli_real_escape_string($link,$_POST['secretarioex']);
$tesoureiro = mysqli_real_escape_string($link,$_POST['tesoureiro']);

//Níveis
$nivel_presidente = 2;
$nivel_secretario = 3;
$nivel_contador = 4;
$nivel_secretarioex = 5;
$nivel_tesoureiro = 6;

//Queries dos níveis
$sq2 = "SELECT * FROM rfa_acesso_paginas WHERE nivel_acesso = '$nivel_presidente' AND pagina_id = '$page' AND clube = '$clube'";
$qpresidente = mysqli_query($link, $sq2) or die(mysqli_error($link));

$sq3 = "SELECT * FROM rfa_acesso_paginas WHERE nivel_acesso = '$nivel_secretario' AND pagina_id = '$page' AND clube = '$clube'";
$qsecretario = mysqli_query($link, $sq3) or die(mysqli_error($link));

$sq4 = "SELECT * FROM rfa_acesso_paginas WHERE nivel_acesso = '$nivel_contador' AND pagina_id = '$page' AND clube = '$clube'";
$qcontador = mysqli_query($link, $sq4) or die(mysqli_error($link));

$sq5 = "SELECT * FROM rfa_acesso_paginas WHERE nivel_acesso = '$nivel_secretarioex' AND pagina_id = '$page' AND clube = '$clube'";
$qsecretarioex = mysqli_query($link, $sq5) or die(mysqli_error($link));

$sq6 = "SELECT * FROM rfa_acesso_paginas WHERE nivel_acesso = '$nivel_tesoureiro' AND pagina_id = '$page' AND clube = '$clube'";
$qtesoureiro = mysqli_query($link, $sq6) or die(mysqli_error($link));

//Condição para Presidente
$totalRows_qpresidente = mysqli_num_rows($qpresidente);
if($totalRows_qpresidente <= 0){
	$sql .= "INSERT INTO rfa_acesso_paginas (nivel_acesso, pagina_id, consulta_acesso, clube) VALUES ('$nivel_presidente', '$page', '$presidente', '$clube');";
}else{
	$sql .= "UPDATE rfa_acesso_paginas SET consulta_acesso = '$presidente' WHERE clube = '$clube' AND nivel_acesso = '$nivel_presidente' AND pagina_id = '$page';";
}

//Condição para Secretário
$totalRows_qsecretario = mysqli_num_rows($qsecretario);
if($totalRows_qsecretario <= 0){
	$sql .= "INSERT INTO rfa_acesso_paginas (nivel_acesso, pagina_id, consulta_acesso, clube) VALUES ('$nivel_secretario', '$page', '$secretario', '$clube');";
}else{
	$sql .= "UPDATE rfa_acesso_paginas SET consulta_acesso = '$secretario' WHERE clube = '$clube' AND nivel_acesso = '$nivel_secretario' AND pagina_id = '$page';";
}

//Condição para Contador
$totalRows_qcontador = mysqli_num_rows($qcontador);
if($totalRows_qcontador <= 0){
	$sql .= "INSERT INTO rfa_acesso_paginas (nivel_acesso, pagina_id, consulta_acesso, clube) VALUES ('$nivel_contador', '$page', '$contador', '$clube');";
}else{
	$sql .= "UPDATE rfa_acesso_paginas SET consulta_acesso = '$contador' WHERE clube = '$clube' AND nivel_acesso = '$nivel_contador' AND pagina_id = '$page';";
}

//Condição para Secretário Executivo
$totalRows_qsecretarioex = mysqli_num_rows($qsecretarioex);
if($totalRows_qsecretarioex <= 0){
	$sql .= "INSERT INTO rfa_acesso_paginas (nivel_acesso, pagina_id, consulta_acesso, clube) VALUES ('$nivel_secretarioex', '$page', '$secretarioex', '$clube');";
}else{
	$sql .= "UPDATE rfa_acesso_paginas SET consulta_acesso = '$secretarioex' WHERE clube = '$clube' AND nivel_acesso = '$nivel_secretarioex' AND pagina_id = '$page';";
}

//Condição para Secretário Tesoureiro
$totalRows_qtesoureiro = mysqli_num_rows($qtesoureiro);
if($totalRows_qtesoureiro <= 0){
	$sql .= "INSERT INTO rfa_acesso_paginas (nivel_acesso, pagina_id, consulta_acesso, clube) VALUES ('$nivel_tesoureiro', '$page', '$tesoureiro', '$clube');";
}else{
	$sql .= "UPDATE rfa_acesso_paginas SET consulta_acesso = '$tesoureiro' WHERE clube = '$clube' AND nivel_acesso = '$nivel_tesoureiro' AND pagina_id = '$page';";
}


	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Permissões configuradas com sucesso!');javascript:window.location='permissoes.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>