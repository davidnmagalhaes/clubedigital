<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$nomerecuperante = mysqli_real_escape_string($link,$_POST['nome_recuperante']);
$emailrecuperante = mysqli_real_escape_string($link,$_POST['email_recuperante']);
$emailclube = mysqli_real_escape_string($link,$_POST['email_clube']);
$cluberecuperante = mysqli_real_escape_string($link,$_POST['clube_recuperante']);

//Informações
$idpauta = mysqli_real_escape_string($link,$_POST['idpauta']);

	
foreach($nomerecuperante as $key => $nome){
$codrec = rand();
	$sql .= "INSERT INTO rfa_recuperantes (cod_recuperante,id_pauta, nome_recuperante, email_recuperante, email_clube, clube, clube_recuperante) VALUES ('$codrec','$idpauta','$nome', '$emailrecuperante[$key]','$emailclube[$key]','$club', '$cluberecuperante[$key]');";

}

if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Recuperante cadastrado com sucesso!');javascript:window.location='emitir-recuperante.php?cod_pauta=".$idpauta."&clube=".$club."'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>