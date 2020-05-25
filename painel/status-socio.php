<?php 
//Conexão com banco de dados
include_once("config.php");

$clube = mysqli_real_escape_string($link,$_POST['clube']);
$statussocio = mysqli_real_escape_string($link,$_POST['statussocio']);
$idsocio = mysqli_real_escape_string($link,$_POST['idsocio']);

if($statussocio == 0){
	$datainativo = date('Y-m-d');
	$sql = "UPDATE rfs_socios SET status_socio = '$statussocio', data_inativo = '$datainativo' WHERE id_socio='$idsocio' AND clube='$clube';";
}else{
	$sql = "UPDATE rfs_socios SET status_socio = '$statussocio' WHERE id_socio='$idsocio' AND clube='$clube';";
}


	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Status do sócio atualizado!');javascript:window.location='socios.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>