<?php 
//Conexão com banco de dados
include_once("config.php");

$idpauta = $_POST['idpauta'];
$club = $_POST['club'];
$idsocio =$_POST['idsocio'];
$checksocios = $_POST['check'];


foreach($idsocio as $key => $socio){
	$query = "SELECT * FROM rfa_presenca WHERE id_socio='$socio' AND clube='$club' AND id_pauta='$idpauta'";
	$verpauta = mysqli_query($link, $query) or die(mysqli_error($link));
	$totalRows_verpauta = mysqli_num_rows($verpauta);

	if($totalRows_verpauta <= 0){
		$sql .= "INSERT INTO rfa_presenca (id_socio, id_pauta, status_presenca, clube) VALUES ('$socio', '$idpauta', '$checksocios[$key]', '$club');";
	}else{
		$sql .= "UPDATE rfa_presenca SET status_presenca = '$checksocios[$key]' WHERE id_socio = '$socio' AND clube='$club' AND id_pauta = '$idpauta';";
	}
}

	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Lista de presença atualizada com sucesso!');javascript:window.location='pauta.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>