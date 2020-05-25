<?php 
//Conexão com banco de dados
include_once("config.php");

$clube = mysqli_real_escape_string($link,$_POST['clube']);
$statuscob = mysqli_real_escape_string($link,$_POST['statuscob']);
$idsocio = mysqli_real_escape_string($link,$_POST['idsocio']);


$sql = "UPDATE rfs_socios SET status_cob = '$statuscob' WHERE id_socio='$idsocio' AND clube='$clube';";
	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Status de cobrança do sócio atualizado!');javascript:window.location='socios.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>