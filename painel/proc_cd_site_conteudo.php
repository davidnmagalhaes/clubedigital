<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);
$titulodestaque = mysqli_real_escape_string($link,$_POST['titulo_destaque']);
$tituloequipe = mysqli_real_escape_string($link,$_POST['title_equipe']);
$subequipe = mysqli_real_escape_string($link,$_POST['sub_equipe']);
$titulovideo = mysqli_real_escape_string($link,$_POST['titulo_video']);
$sub_video = mysqli_real_escape_string($link,$_POST['sub_video']);
$urlvideo = mysqli_real_escape_string($link,$_POST['url_video']);

	
$query = "SELECT * FROM rfa_site_conteudo WHERE clube='$club'";
$vertopo = mysqli_query($link, $query) or die(mysqli_error($link));
$row_vertopo = mysqli_fetch_assoc($vertopo);
$totalRows_vertopo = mysqli_num_rows($vertopo);

if($totalRows_vertopo <= 0){

$destaque = 'img_destaque';
$background = 'img_background';
$miniatura = 'img_miniatura';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/conteudo/';

mkdir($pastaimg, 0777, true);

/*Variáveis do upload do destaque*/
	$imgdestaque = $_FILES[$destaque]['name'];
	$tempdestaque = $_FILES[$destaque]['tmp_name'];

	if($imgdestaque == NULL){
	$dirdestaque = $pastaimg."avatardestaque.jpg";	
	}else{
	$dirdestaque = $pastaimg.$data.$imgdestaque;	
	}

/*Variáveis do upload do background*/
	$imgbackground = $_FILES[$background]['name'];
	$tempbackground = $_FILES[$background]['tmp_name'];

	if($logo == NULL){
	$dirbackground = $pastaimg."avatarbackground.jpg";	
	}else{
	$dirbackground = $pastaimg.$data.$imgbackground;	
	}

/*Variáveis do upload da miniatura*/
	$imgminiatura = $_FILES[$miniatura]['name'];
	$tempminiatura = $_FILES[$miniatura]['tmp_name'];

	if($logo == NULL){
	$dirminiatura = $pastaimg."avatarminiatura.jpg";	
	}else{
	$dirminiatura = $pastaimg.$data.$imgminiatura;	
	}


	$sql = "INSERT INTO rfa_site_conteudo (img_destaque, title_destaque, title_video, sub_video,background_video, img_video, link_video,  title_equipe, sub_equipe, clube) VALUES ('$dirdestaque', '$titulodestaque', '$titulovideo', '$sub_video', '$dirbackground', '$dirminiatura', '$urlvideo', '$tituloequipe', '$subequipe', '$club');";
}else{


$destaque = 'img_destaque';
$background = 'img_background';
$miniatura = 'img_miniatura';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/conteudo/';

/*Variáveis do upload do destaque*/
	$imgdestaque = $_FILES[$destaque]['name'];
	$tempdestaque = $_FILES[$destaque]['tmp_name'];
	$imgbackground = $_FILES[$background]['name'];
	$tempbackground = $_FILES[$background]['tmp_name'];
	$imgminiatura = $_FILES[$miniatura]['name'];
	$tempminiatura = $_FILES[$miniatura]['tmp_name'];
	$dirdestaque = $pastaimg.$data.$imgdestaque;
	$dirbackground = $pastaimg.$data.$imgbackground;
	$dirminiatura = $pastaimg.$data.$imgminiatura;

	// Todos nulos
	if(empty($imgdestaque) && empty($imgbackground) && empty($imgminiatura)){
	$sql = "UPDATE rfa_site_conteudo SET title_destaque = '$titulodestaque', title_video = '$titulovideo', sub_video = '$sub_video', link_video = '$urlvideo',  title_equipe = '$tituloequipe', sub_equipe = '$subequipe' WHERE clube='$club';";
	}

	//Somente miniatura não nulo
	if(empty($imgdestaque) && empty($imgbackground) && !empty($imgminiatura)){
	$sql = "UPDATE rfa_site_conteudo SET title_destaque = '$titulodestaque', title_video = '$titulovideo', sub_video = '$sub_video', img_video = '$dirminiatura', link_video = '$urlvideo', img_video = '$dirminiatura',  title_equipe = '$tituloequipe', sub_equipe = '$subequipe' WHERE clube='$club';";
	}

	//Somente background não nulo
	if(empty($imgdestaque) && !empty($imgbackground) && empty($imgminiatura)){
	$sql = "UPDATE rfa_site_conteudo SET title_destaque = '$titulodestaque', title_video = '$titulovideo', sub_video = '$sub_video', background_video = '$dirbackground', link_video = '$urlvideo',  title_equipe = '$tituloequipe', sub_equipe = '$subequipe' WHERE clube='$club';";
	}

	//Somente Imagem destaque não nulo
	if(!empty($imgdestaque) && empty($imgbackground) && empty($imgminiatura)){
	$sql = "UPDATE rfa_site_conteudo SET img_destaque = '$dirdestaque', title_destaque = '$titulodestaque', title_video = '$titulovideo', sub_video = '$sub_video', link_video = '$urlvideo',  title_equipe = '$tituloequipe', sub_equipe = '$subequipe' WHERE clube='$club';";
	}

	//Destaque e Background não nulo
	if(!empty($imgdestaque) && !empty($imgbackground) && empty($imgminiatura)){
	$sql = "UPDATE rfa_site_conteudo SET img_destaque = '$dirdestaque', title_destaque = '$titulodestaque', title_video = '$titulovideo', sub_video = '$sub_video', link_video = '$urlvideo',  title_equipe = '$tituloequipe', background_video = '$dirbackground', sub_equipe = '$subequipe' WHERE clube='$club';";
	}

	//Destaque e Miniatura não nulo
	if(!empty($imgdestaque) && empty($imgbackground) && !empty($imgminiatura)){
	$sql = "UPDATE rfa_site_conteudo SET img_destaque = '$dirdestaque', title_destaque = '$titulodestaque', title_video = '$titulovideo', sub_video = '$sub_video', link_video = '$urlvideo', img_video = '$dirminiatura', title_equipe = '$tituloequipe', sub_equipe = '$subequipe' WHERE clube='$club';";
	}

	//Destaque, Background e Miniatura não nulo
	if(!empty($imgdestaque) && !empty($imgbackground) && !empty($imgminiatura)){
	$sql = "UPDATE rfa_site_conteudo SET img_destaque = '$dirdestaque', title_destaque = '$titulodestaque', title_video = '$titulovideo', sub_video = '$sub_video', link_video = '$urlvideo', img_video = '$dirminiatura', background_video = '$dirbackground', title_equipe = '$tituloequipe', sub_equipe = '$subequipe' WHERE clube='$club';";
	}

	//Background e Miniatura não nulo
	if(empty($imgdestaque) && !empty($imgbackground) && !empty($imgminiatura)){
	$sql = "UPDATE rfa_site_conteudo SET title_destaque = '$titulodestaque', title_video = '$titulovideo', sub_video = '$sub_video', link_video = '$urlvideo',  title_equipe = '$tituloequipe', background_video = '$dirbackground', img_video = '$dirminiatura', sub_equipe = '$subequipe' WHERE clube='$club';";
	}


}

	
	if ($link->multi_query($sql) === TRUE) {
		move_uploaded_file($tempdestaque,$dirdestaque);
		move_uploaded_file($tempbackground,$dirbackground);
		move_uploaded_file($tempminiatura,$dirminiatura);
		echo "<script>javascript:alert('Conteúdo atualizado com sucesso!');javascript:window.location='site-conteudo.php'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>