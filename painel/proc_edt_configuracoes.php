<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de integracao.php*/
$club = mysqli_real_escape_string($link,$_POST['club']);
$cep = mysqli_real_escape_string($link,$_POST['cep_clube']);
$endereco = mysqli_real_escape_string($link,$_POST['endereco_clube']);
$numero = mysqli_real_escape_string($link,$_POST['numero_clube']);
$bairro = mysqli_real_escape_string($link,$_POST['bairro_clube']);
$cidade = mysqli_real_escape_string($link,$_POST['cidade_clube']);
$estado = mysqli_real_escape_string($link,$_POST['estado_clube']);
$telefone = mysqli_real_escape_string($link,$_POST['telefone_clube']);
$email = mysqli_real_escape_string($link,$_POST['email_clube']);

$logo = 'logotipo_clube';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/logotipos_clubes/';

/*Variáveis do upload do logotipo*/
	$imglogo = $_FILES[$logo]['name'];
	$templogo = $_FILES[$logo]['tmp_name'];

	if(empty($imglogo)){
	$sql = "UPDATE rfa_clubes SET cep_clube = '$cep', endereco_clube = '$endereco', numero_clube = '$numero', bairro_clube = '$bairro', cidade_clube = '$cidade', estado_clube = '$estado', telefone_clube = '$telefone', email_clube = '$email' WHERE id_clube = '$club';";
	}else{
	$dirlogo = $pastaimg.$data.$imglogo;
	$sql = "UPDATE rfa_clubes SET cep_clube = '$cep', endereco_clube = '$endereco', numero_clube = '$numero', bairro_clube = '$bairro', cidade_clube = '$cidade', estado_clube = '$estado', telefone_clube = '$telefone', email_clube = '$email', logo_clube = '$dirlogo' WHERE id_clube = '$club';";
	}
	
	
	if ($link->multi_query($sql) === TRUE) {
		move_uploaded_file($templogo,$dirlogo);
		echo "<script>javascript:alert('Atualização de configurações realizada com sucesso!');javascript:window.location='configuracoes.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>