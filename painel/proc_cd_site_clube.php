<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);
$titulo = mysqli_real_escape_string($link,$_POST['titulo_clube']);
$textclube = mysqli_real_escape_string($link,$_POST['text_clube']);


$query = "SELECT * FROM rfa_site_clube WHERE clube='$club'";
$vertopo = mysqli_query($link, $query) or die(mysqli_error($link));
$row_vertopo = mysqli_fetch_assoc($vertopo);
$totalRows_vertopo = mysqli_num_rows($vertopo);

if($totalRows_vertopo <= 0){

$oclube = 'img_clube';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/o_clube/';

mkdir($pastaimg, 0777, true);

/*Variáveis do upload do logotipo*/
	$imgoclube = $_FILES[$oclube]['name'];
	$tempoclube = $_FILES[$oclube]['tmp_name'];

	if($imgoclube == NULL){
	$diroclube = $pastaimg."avataroclube.jpg";	
	}else{
	$diroclube = $pastaimg.$data.$imgoclube;	
	}

	$sql = "INSERT INTO rfa_site_clube (title_site_clube, texto_site_clube, img_clube, clube) VALUES ('$titulo', '$textclube', '$diroclube', '$club');";
}else{


$oclube = 'img_clube';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/o_clube/';

/*Variáveis do upload do logotipo*/
	$imgoclube = $_FILES[$oclube]['name'];
	$tempoclube = $_FILES[$oclube]['tmp_name'];

	if($imgoclube == NULL){
	$diroclube = $pastaimg.$data.$imgoclube;	
	$sql = "UPDATE rfa_site_clube SET title_site_clube = '$titulo', texto_site_clube = '$textclube' WHERE clube = '$club';";
	}else{
	$diroclube = $pastaimg.$data.$imgoclube;
	$sql = "UPDATE rfa_site_clube SET title_site_clube = '$titulo', texto_site_clube = '$textclube', img_clube = '$diroclube' WHERE clube = '$club';";	
	}	

	

}

	
	if ($link->multi_query($sql) === TRUE) {
		move_uploaded_file($tempoclube,$diroclube);
		echo "<script>javascript:alert('Conteúdo atualizado com sucesso!');javascript:window.location='site-conteudo.php'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>