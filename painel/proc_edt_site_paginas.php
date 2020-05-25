<?php 
//Conexão com banco de dados
include_once("config.php");

$idpage = $_POST['id_page'];

$club = $_POST['club'];
$titulo = mysqli_real_escape_string($link,$_POST['titulo']);
$menu = mysqli_real_escape_string($link,$_POST['menu']);
$descricao = mysqli_real_escape_string($link,str_replace('site/images/uploads/','images/uploads/',$_POST['descricao']));

	$sql = "UPDATE rfa_site_menu_pages SET nome_page='$titulo', conteudo_page='$descricao', ref_menu='$menu' WHERE clube='$club' AND id_page='$idpage';";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Página atualizada com sucesso!');javascript:window.location='paginas'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>