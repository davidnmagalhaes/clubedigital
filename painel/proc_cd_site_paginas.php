<?php 
//Conexão com banco de dados
include_once("config.php");

$club = $_POST['club'];
$titulo = mysqli_real_escape_string($link,$_POST['titulo']);
$menu = mysqli_real_escape_string($link,$_POST['menu']);
$descricao = mysqli_real_escape_string($link,str_replace('site/images/uploads/','images/uploads/',$_POST['descricao']));

	$sql = "INSERT INTO rfa_site_menu_pages (nome_page, conteudo_page, ref_menu, clube) VALUES ('$titulo', '$descricao','$menu', '$club');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Página cadastrada com sucesso!');javascript:window.location='paginas'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>