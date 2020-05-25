<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);
$nomepresidente = mysqli_real_escape_string($link,$_POST['nome_presidente']);
$anorotarioi = mysqli_real_escape_string($link,$_POST['ano_rotario_i']);
$anorotariof = mysqli_real_escape_string($link,$_POST['ano_rotario_f']);
$sexo = mysqli_real_escape_string($link,$_POST['sexo']);
	
$query = "SELECT * FROM rfa_site_galeria WHERE clube='$club'";
$vertopo = mysqli_query($link, $query) or die(mysqli_error($link));
$row_vertopo = mysqli_fetch_assoc($vertopo);
$totalRows_vertopo = mysqli_num_rows($vertopo);

if($totalRows_vertopo <= 0){

$codgaleria = rand();
$presidente = 'img_presidente';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/galeria/';

mkdir($pastaimg, 0777, true);

/*Variáveis do upload do logotipo*/
	$imgpresidente = $_FILES[$presidente]['name'];
	$temppresidente = $_FILES[$presidente]['tmp_name'];

	if($imgpresidente == NULL){
	$dirpresidente = $pastaimg."avatarpresidente.jpg";	
	}else{
	$dirpresidente = $pastaimg.$data.$imgpresidente;	
	}

	$sql = "INSERT INTO rfa_site_galeria (cod_galeria, nome_presidente, ano_rotario_i, ano_rotario_f, sexo, clube) VALUES ('$codgaleria','$nomepresidente', '$anorotarioi', '$anorotariof', '$sexo', '$club');";
}else{


$presidente = 'img_presidente';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/galeria/';

/*Variáveis do upload do logotipo*/
	$imgpresidente = $_FILES[$presidente]['name'];
	$temppresidente = $_FILES[$presidente]['tmp_name'];
	$dirpresidente = $pastaimg.$data.$imgpresidente;	

	$sql = "INSERT INTO rfa_site_galeria (cod_galeria, nome_presidente, ano_rotario_i, ano_rotario_f, sexo, clube) VALUES ('$codgaleria','$nomepresidente', '$anorotarioi', '$anorotariof', '$sexo', '$club');";

}

	
	if ($link->multi_query($sql) === TRUE) {
		//move_uploaded_file($temppresidente,$dirpresidente);
		echo "<script>javascript:window.location='crop-galeria.php?cod_usuario=".$codgaleria."&clube=".$club."'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>