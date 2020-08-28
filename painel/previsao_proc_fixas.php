<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);
$md = $_POST['md'];//verificador

if($md == 1){
$valormensalidades = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor-mensalidades']));
$valorat = str_replace(',','.',$valormensalidades);

$sql = "UPDATE rfa_prev_fixas SET valor_mensalidades='$valorat' WHERE clube='$club';";
}elseif($md == 2){
$qtdrefeicoes = mysqli_real_escape_string($link,$_POST['qtd-refeicoes']);

$sql = "UPDATE rfa_prev_fixas SET qtd_refeicoes='$qtdrefeicoes' WHERE clube='$club';";
}elseif($md == 3){
$valorrefeicoes = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor-refeicoes']));
$valorat = str_replace(',','.',$valorrefeicoes);

$sql = "UPDATE rfa_prev_fixas SET valor_refeicoes='$valorat' WHERE clube='$club';";
}elseif($md == 4){
$valorri = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor-percaptari']));
$valorat = str_replace(',','.',$valorri);

$sql = "UPDATE rfa_prev_fixas SET valor_percapta_ri='$valorat' WHERE clube='$club';";
}elseif($md == 5){
$valordi = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor-percaptadi']));
$valorat = str_replace(',','.',$valordi);

$sql = "UPDATE rfa_prev_fixas SET valor_percapta_di='$valorat' WHERE clube='$club';";
}elseif($md == 6){
$qtdalmocos = mysqli_real_escape_string($link,$_POST['qtd-almocos']);

$sql = "UPDATE rfa_prev_fixas SET qtd_almocos='$qtdalmocos' WHERE clube='$club';";

}else{
$qtdsocios = mysqli_real_escape_string($link,$_POST['qtd-socios']);

$sql = "UPDATE rfa_prev_fixas SET qtd_socios='$qtdsocios' WHERE clube='$club';";
}

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:window.location='previsao.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>