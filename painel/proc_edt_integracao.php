<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de integracao.php*/
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);

$appkeypaghiper = mysqli_real_escape_string($link,$_POST['appkeypaghiper']);
$tokenpaghiper = mysqli_real_escape_string($link,$_POST['tokenpaghiper']);

$emailpagseguro = mysqli_real_escape_string($link,$_POST['emailpagseguro']);
$tokenpagseguro = mysqli_real_escape_string($link,$_POST['tokenpagseguro']);

$taxapaghiper = mysqli_real_escape_string($link,str_replace(',','.',$_POST['taxapaghiper']));
$percmulta = mysqli_real_escape_string($link,$_POST['percmulta']);
$juros = mysqli_real_escape_string($link,$_POST['juros']);
$hoje = date('Y-m-d');
$subdir = "inc-paghiper/";
$includeretorno = $subdir."inc-ret-".$hoje."-".$club.".php";

$descricaocob = "Mensalidade";
$pagamentoatecob = 0;
$multacob = 0;
$juroscob = 0;
$descontocob = 0;
$tipoboletocob = "boletoA4";
$parcelascb = 1;

$qr = "SELECT * FROM rfa_clubes WHERE id_clube='$club'";
$listakey = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_listakey = mysqli_fetch_assoc($listakey);
$totalRows_listakey = mysqli_num_rows($listkey);

$appk = $row_listakey['paghiper_appkey'];
$pgtoken = $row_listakey['paghiper_token'];
$pginc = $row_listakey['paghiper_include'];

$q = "SELECT * FROM rfa_tipo_cob WHERE descricao_cob='$descricaocob' AND clube='$club'";
$listmens = mysqli_query($link, $q) or die(mysqli_error($link));
$row_listmens = mysqli_fetch_assoc($listmens);
$totalRows_listmens = mysqli_num_rows($listmens);



if($pginc == ""){
	$sql = "UPDATE rfa_clubes SET paghiper_taxa = '$taxapaghiper', paghiper_include = '$includeretorno', paghiper_appkey = '$appkeypaghiper', paghiper_token = '$tokenpaghiper', pagseguro_email='$emailpagseguro', pagseguro_token='$tokenpagseguro' WHERE id_clube = '$club';";
	
	if($totalRows_listmens > 0){}else{
	$sql .= "INSERT INTO rfa_tipo_cob (descricao_cob, pagamentoate_cob, multa_cob, juros_cob, desconto_cob, tipoboleto_cob, user, data_cadastro, parcelas_cob, clube) VALUES ('$descricaocob', '$pagamentoatecob', '$multacob', '$juroscob', '$descontocob', '$tipoboletocob', '$user', '$hoje', '$parcelascb', '$club');";
	}
// START - Cria um arquivo de include para ser utilizado no retorno pegando a chave e o token do usuário
	$conteudo = '
	
	  $cha = '.$appk.';
	  $cha2 = '.$pgtoken.';

	';

	$arquivo = fopen($includeretorno, 'w');
	fwrite($arquivo, $conteudo);
	fclose($arquivo);
// END - Cria um arquivo de include para ser utilizado no retorno pegando a chave e o token do usuário
}else{
	$sql = "UPDATE rfa_clubes SET paghiper_taxa = '$taxapaghiper', paghiper_appkey = '$appkeypaghiper', paghiper_token = '$tokenpaghiper',pagseguro_email='$emailpagseguro', pagseguro_token='$tokenpagseguro' WHERE id_clube = '$club';";
	
}
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Integração realizada com sucesso!');javascript:window.location='integracao.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>