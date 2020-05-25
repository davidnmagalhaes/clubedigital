<?php 
//Conexão com banco de dados
include_once("config.php");

$club = $_POST['club'];
$titulo = mysqli_real_escape_string($link,$_POST['titulo']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao']);
$idblog = $_POST['idblog'];

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

	if(empty($imglogo)){
	$sql = "UPDATE rfa_site_blog SET titulo_blog = '$titulo', descricao_blog = '$descricao', data_blog = '$datadia', hora_blog = '$hora', por_blog = '$por' WHERE clube='$club' AND id_blog = '$idblog';";		
	}else{
	$dirlogo = $pastaimg.$data.$imglogo;
	$sql = "UPDATE rfa_site_blog SET titulo_blog = '$titulo', descricao_blog = '$descricao', data_blog = '$datadia', hora_blog = '$hora', por_blog = '$por', imagem_blog = '$dirlogo' WHERE clube='$club' AND id_blog = '$idblog';";	
	}

	
}else{


$logo = 'img_blog';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/blog/';

/*Variáveis do upload do logotipo*/
	$imglogo = $_FILES[$logo]['name'];
	$templogo = $_FILES[$logo]['tmp_name'];

	if(empty($imglogo)){
	$sql = "UPDATE rfa_site_blog SET titulo_blog = '$titulo', descricao_blog = '$descricao', data_blog = '$datadia', hora_blog = '$hora', por_blog = '$por' WHERE clube='$club' AND id_blog = '$idblog';";
	}else{
	$dirlogo = $pastaimg.$data.$imglogo;
	$sql = "UPDATE rfa_site_blog SET titulo_blog = '$titulo', descricao_blog = '$descricao', data_blog = '$datadia', hora_blog = '$hora', por_blog = '$por', imagem_blog = '$dirlogo' WHERE clube='$club' AND id_blog = '$idblog';";	
	}	

	

}

	
	if ($link->multi_query($sql) === TRUE) {
		move_uploaded_file($templogo,$dirlogo);
		echo "<script>javascript:alert('Post atualizado com sucesso!');javascript:window.location='site-blog.php'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>