<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$nometipobanco = mysqli_real_escape_string($link,$_POST['nometipobanco']);
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);


$codtipobanco = rand();

//Verifica se existe o código
$quer = "SELECT * FROM rfa_lista_tipo_banco WHERE cod_lista_tipo_banco='$codtipobanco'";
$lis = mysqli_query($link, $quer) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);

if($totalRows_lis > 0){
	$codtipobanco += rand(); 
}

	
/*Finaliza inserindo o nome do tipo do banco na tabela rfa_lista_tipo_banco*/
	$sql = "INSERT INTO rfa_lista_tipo_banco (cod_lista_tipo_banco, nome_lista_tipo, user, clube) VALUES ('$codtipobanco', '$nometipobanco', '$user', '$club');";
	
	if ($link->multi_query($sql) === TRUE) {
		header("Location: cd_banco.php");
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>