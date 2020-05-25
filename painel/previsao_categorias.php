<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['clube']);

$nomecategoria = mysqli_real_escape_string($link,$_POST['nomecategoria']);
$corcategoria = mysqli_real_escape_string($link,$_POST['corcategoria']);


	$sql = "INSERT INTO rfa_prev_categorias (nome_categoria, cor_categoria, clube) VALUES ('$nomecategoria','$corcategoria', '$club');";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Categoria inserida com sucesso!');javascript:window.location='previsao.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>