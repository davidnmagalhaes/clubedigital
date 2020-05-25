<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$idconsorcio = mysqli_real_escape_string($link,$_POST['idconsorcio']);
$socio = mysqli_real_escape_string($link,$_POST['socio']);

$codinscrito = date('ymdHis').rand(100,200);
$clube = mysqli_real_escape_string($link,$_POST['clube']);
$status = 1;

$data = date('Y-m-d');
$hora = date('H:i:s');

$qcmp = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_consorcio='$idconsorcio' AND id_socio='$socio'";
$cmp = mysqli_query($link, $qcmp) or die(mysqli_error($link));
$rows_cmp = mysqli_num_rows($cmp);

$qcmp2 = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_inscrito='$codinscrito'";
$cmp2 = mysqli_query($link, $qcmp2) or die(mysqli_error($link));
$rows_cmp2 = mysqli_num_rows($cmp2);

if($rows_cmp > 0 || $rows_cmp2 > 0){
	echo "<script>javascript:alert('O sócio selecionado já está neste consórcio!');javascript:window.location='consorcio'</script>";
}else{

	$sql = "INSERT INTO rfa_consorcio_inscritos (cod_inscrito, cod_consorcio, id_socio, clube, status_inscricao, data, hora) VALUES ('$codinscrito','$idconsorcio','$socio','$clube','$status','$data','$hora');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Inscrição realizada com sucesso!');javascript:window.location='consorcio'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>