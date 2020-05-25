<?php 
//Conexão com banco de dados
include_once("config.php");

$club = $_POST['club'];
$titulo = mysqli_real_escape_string($link,$_POST['titulo']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao']);

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Fortaleza');

$datadia = strftime('%F');
$hora = strftime('%R');
$por = mysqli_real_escape_string($link,$_POST['por']);

	
$query = "SELECT * FROM rfa_site_blog WHERE clube='$club'";
$vertopo = mysqli_query($link, $query) or die(mysqli_error($link));
$row_vertopo = mysqli_fetch_assoc($vertopo);
$totalRows_vertopo = mysqli_num_rows($vertopo);

if($totalRows_vertopo <= 0){

$logo = 'img_blog';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/blog/';

mkdir($pastaimg, 0777, true);

/*Variáveis do upload do logotipo*/
	$imglogo = $_FILES[$logo]['name'];
	$templogo = $_FILES[$logo]['tmp_name'];

	if($imglogo == NULL){
	$dirlogo = $pastaimg."avatarlogo.jpg";	
	}else{
	$dirlogo = $pastaimg.$data.$imglogo;	
	}

	$sql = "INSERT INTO rfa_site_blog (titulo_blog,descricao_blog, data_blog, hora_blog, por_blog, imagem_blog, clube) VALUES ('$titulo', '$descricao', '$datadia', '$hora', '$por', '$dirlogo', '$club');";
}else{


$logo = 'img_blog';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/blog/';

/*Variáveis do upload do logotipo*/
	$imglogo = $_FILES[$logo]['name'];
	$templogo = $_FILES[$logo]['tmp_name'];
	$dirlogo = $pastaimg.$data.$imglogo;	

	$sql = "INSERT INTO rfa_site_blog (titulo_blog,descricao_blog, data_blog, hora_blog, por_blog, imagem_blog, clube) VALUES ('$titulo', '$descricao', '$datadia', '$hora', '$por', '$dirlogo', '$club');";

}

	
	if ($link->multi_query($sql) === TRUE) {
		move_uploaded_file($templogo,$dirlogo);
		echo "<script>javascript:alert('Post cadastrado com sucesso!');javascript:window.location='site-blog.php'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>