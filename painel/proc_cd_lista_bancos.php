<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$nomebanco = mysqli_real_escape_string($link,$_POST['nomebanco']);
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$logobanco = 'logobanco';
$data = date("d-m-Y-H-i");

if($nomebanco == "Caixa" || $nomebanco == "CAIXA" || $nomebanco == "caixa" || $nomebanco == "CaIxA" || $nomebanco == "cAiXa" || $nomebanco == "caixA" || $nomebanco == "caiXa" || $nomebanco == "caIxa" || $nomebanco == "cAixa" || $nomebanco == "cAIXa" || $nomebanco == "caiXA" || $nomebanco == "CAixa"){
		echo "<script>javascript:alert('Você não pode criar um banco com nome Caixa ou semelhante, pois já existe um banco com este nome!');javascript:window.location='cd_banco.php'</script>";
	}else{


$codlistbanco = rand();

//Verifica se existe o código
$quer = "SELECT * FROM rfa_lista_bancos WHERE cod_lista_banco='$codlistbanco'";
$lis = mysqli_query($link, $quer) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);

if($totalRows_lis > 0){
	$codlistbanco += rand(); 
}


/*Variáveis do upload do logotipo*/
	$imagem = $_FILES[$logobanco]['name'];
	$temp = $_FILES[$logobanco]['tmp_name'];
	
/*Verifica se a imagem está vazia*/
	if($imagem == NULL){
	$dir = "images/bancos/avatar.jpg";	
	}else{
	$dir = "images/bancos/".$data.$imagem;	
	}
	
/*Finaliza inserindo o nome do banco na tabela raf_lista_bancos*/
	$sql = "INSERT INTO rfa_lista_bancos (cod_lista_banco, nome_lista_banco, imagem_lista_banco, user, clube) VALUES ('$codlistbanco','$nomebanco', '$dir', '$user', '$club');";
	
	if ($link->multi_query($sql) === TRUE) {
		move_uploaded_file($temp,$dir);
		header("Location: cd_banco.php");
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>