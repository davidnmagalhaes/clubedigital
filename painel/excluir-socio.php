<?php

     require_once('config.php');
    $idsocio = $_GET['id_socio'];
    
    $result_usuario = "DELETE FROM rfs_socios WHERE id_socio='$idsocio';";
	
	$qr = "SELECT * FROM rfs_socios WHERE id_socio='$idsocio'";
	$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
	$row_lis = mysqli_fetch_assoc($lis);
	
	$refsoc = $row_lis['ref_socio'];
	
	$result_usuario .= "DELETE FROM rfa_socios_filhos WHERE id_socio='$refsoc';";
    

if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('S\u00f3cio removido com sucesso!');javascript:window.location='socios.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>