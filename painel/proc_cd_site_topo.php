<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);
$titulo = mysqli_real_escape_string($link,$_POST['titulo']);
$keyword = mysqli_real_escape_string($link,$_POST['keyword']);
$description = mysqli_real_escape_string($link,$_POST['description']);
$facebook = mysqli_real_escape_string($link,$_POST['facebook']);
$instagram = mysqli_real_escape_string($link,$_POST['instagram']);
$youtube = mysqli_real_escape_string($link,$_POST['youtube']);
$menu = mysqli_real_escape_string($link,$_POST['menu']);
$linhanoticia = mysqli_real_escape_string($link,$_POST['linha_noticia']);
$titulobanner = mysqli_real_escape_string($link,$_POST['titulo_banner']);
$subbanner = mysqli_real_escape_string($link,$_POST['sub_banner']);
$btnbanner = mysqli_real_escape_string($link,$_POST['btn_banner']);
$linkbotao = mysqli_real_escape_string($link,$_POST['link_botao']);

	
$query = "SELECT * FROM rfa_site_topo WHERE clube='$club'";
$vertopo = mysqli_query($link, $query) or die(mysqli_error($link));
$row_vertopo = mysqli_fetch_assoc($vertopo);
$totalRows_vertopo = mysqli_num_rows($vertopo);

if($totalRows_vertopo <= 0){

$logo = 'img_logotipo';
$banner = 'img_banner';
$capa = 'img_capa';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/';

mkdir($pastaimg, 0777, true);

/*Variáveis do upload do logotipo*/
	$imglogo = $_FILES[$logo]['name'];
	$templogo = $_FILES[$logo]['tmp_name'];

	if($imglogo == NULL){
	$dirlogo = "images/avatarlogo.jpg";	
	}else{
	$dirlogo = $pastaimg.$data.$imglogo;	
	}

/*Variáveis do upload do banner*/
	$imgbanner = $_FILES[$banner]['name'];
	$tempbanner = $_FILES[$banner]['tmp_name'];

	if($imgbanner == NULL){
	$dirbanner = "images/avatarbanner.jpg";	
	}else{
	$dirbanner = $pastaimg.$data.$imgbanner;	
	}

/*Variáveis do upload da capa*/
	$imgcapa = $_FILES[$capa]['name'];
	$tempcapa = $_FILES[$capa]['tmp_name'];

	if($imgcapa == NULL){
	$dircapa = $pastaimg."avatarcapa.jpg";	
	}else{
	$dircapa = $pastaimg.$data.$imgcapa;	
	}


	$sql = "INSERT INTO rfa_site_topo (link_botao, logo_topo, ref_menu, facebook_url, insta_url, youtube_url, linha_noticia, title_seo, description_seo, keyword_seo, img_banner_topo, banner_title, banner_sub,  banner_btn, capa, clube) VALUES ('$linkbotao','$dirlogo','$menu', '$facebook', '$instagram', '$youtube', '$linhanoticia', '$titulo', '$description', '$keyword', '$dirbanner', '$titulobanner', '$subbanner', '$btnbanner', '$dircapa', '$club');";
}else{


$logo = 'img_logotipo';
$banner = 'img_banner';
$capa = 'img_capa';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/';

/*Variáveis do upload do logotipo*/
	$imglogo = $_FILES[$logo]['name'];
	$templogo = $_FILES[$logo]['tmp_name'];
	$dirlogo = $pastaimg.$data.$imglogo;	


/*Variáveis do upload do banner*/
	$imgbanner = $_FILES[$banner]['name'];
	$tempbanner = $_FILES[$banner]['tmp_name'];
	$dirbanner = $pastaimg.$data.$imgbanner;	

/*Variáveis do upload da capa*/
	$imgcapa = $_FILES[$capa]['name'];
	$tempcapa = $_FILES[$capa]['tmp_name'];
	$dircapa = $pastaimg.$data.$imgcapa;


if(empty($imglogo) && empty($imgbanner) && empty($imgcapa)){
	$sql = "UPDATE rfa_site_topo SET ref_menu = '$menu', facebook_url = '$facebook', insta_url = '$instagram', youtube_url = '$youtube', linha_noticia = '$linhanoticia', title_seo = '$titulo', description_seo = '$description', keyword_seo = '$keyword', banner_title = '$titulobanner', banner_sub = '$subbanner',  banner_btn = '$btnbanner', link_botao='$linkbotao' WHERE clube='$club';";
}
if(empty($imglogo) && empty($imgbanner) && !empty($imgcapa)){
	$sql = "UPDATE rfa_site_topo SET capa = '$dircapa', ref_menu = '$menu', facebook_url = '$facebook', insta_url = '$instagram', youtube_url = '$youtube', linha_noticia = '$linhanoticia', title_seo = '$titulo', description_seo = '$description', keyword_seo = '$keyword', banner_title = '$titulobanner', banner_sub = '$subbanner',  banner_btn = '$btnbanner', link_botao='$linkbotao' WHERE clube='$club';";
}
if(empty($imglogo) && !empty($imgbanner) && empty($imgcapa)){
	$sql = "UPDATE rfa_site_topo SET img_banner_topo = '$dirbanner', ref_menu = '$menu', facebook_url = '$facebook', insta_url = '$instagram', youtube_url = '$youtube', linha_noticia = '$linhanoticia', title_seo = '$titulo', description_seo = '$description', keyword_seo = '$keyword', banner_title = '$titulobanner', banner_sub = '$subbanner',  banner_btn = '$btnbanner', link_botao='$linkbotao' WHERE clube='$club';";
}
if(!empty($imglogo) && empty($imgbanner) && empty($imgcapa)){
	$sql = "UPDATE rfa_site_topo SET logo_topo = '$dirlogo', ref_menu = '$menu', facebook_url = '$facebook', insta_url = '$instagram', youtube_url = '$youtube', linha_noticia = '$linhanoticia', title_seo = '$titulo', description_seo = '$description', keyword_seo = '$keyword', banner_title = '$titulobanner', banner_sub = '$subbanner',  banner_btn = '$btnbanner', link_botao='$linkbotao' WHERE clube='$club';";
}
if(!empty($imglogo) && !empty($imgbanner) && empty($imgcapa)){
	$sql = "UPDATE rfa_site_topo SET img_banner_topo = '$dirbanner', logo_topo = '$dirlogo', ref_menu = '$menu', facebook_url = '$facebook', insta_url = '$instagram', youtube_url = '$youtube', linha_noticia = '$linhanoticia', title_seo = '$titulo', description_seo = '$description', keyword_seo = '$keyword', banner_title = '$titulobanner', banner_sub = '$subbanner',  banner_btn = '$btnbanner', link_botao='$linkbotao' WHERE clube='$club';";
}
if(!empty($imglogo) && empty($imgbanner) && !empty($imgcapa)){
	$sql = "UPDATE rfa_site_topo SET capa = '$dircapa', logo_topo = '$dirlogo', ref_menu = '$menu', facebook_url = '$facebook', insta_url = '$instagram', youtube_url = '$youtube', linha_noticia = '$linhanoticia', title_seo = '$titulo', description_seo = '$description', keyword_seo = '$keyword', banner_title = '$titulobanner', banner_sub = '$subbanner',  banner_btn = '$btnbanner', link_botao='$linkbotao' WHERE clube='$club';";
}
if(!empty($imglogo) && !empty($imgbanner) && !empty($imgcapa)){
	$sql = "UPDATE rfa_site_topo SET img_banner_topo = '$dirbanner', capa = '$dircapa', logo_topo = '$dirlogo', ref_menu = '$menu', facebook_url = '$facebook', insta_url = '$instagram', youtube_url = '$youtube', linha_noticia = '$linhanoticia', title_seo = '$titulo', description_seo = '$description', keyword_seo = '$keyword', banner_title = '$titulobanner', banner_sub = '$subbanner',  banner_btn = '$btnbanner', link_botao='$linkbotao' WHERE clube='$club';";
}
if(empty($imglogo) && !empty($imgbanner) && !empty($imgcapa)){
	$sql = "UPDATE rfa_site_topo SET img_banner_topo = '$dirbanner', capa = '$dircapa', ref_menu = '$menu', facebook_url = '$facebook', insta_url = '$instagram', youtube_url = '$youtube', linha_noticia = '$linhanoticia', title_seo = '$titulo', description_seo = '$description', keyword_seo = '$keyword', banner_title = '$titulobanner', banner_sub = '$subbanner',  banner_btn = '$btnbanner', link_botao='$linkbotao' WHERE clube='$club';";
}





}

	
	if ($link->multi_query($sql) === TRUE) {
		move_uploaded_file($templogo,$dirlogo);
		move_uploaded_file($tempbanner,$dirbanner);
		move_uploaded_file($tempcapa,$dircapa);
		echo "<script>javascript:alert('Informações do topo atualizadas com sucesso!');javascript:window.location='site-topo.php'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>