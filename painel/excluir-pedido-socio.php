<?php

     require_once('config.php');
    $idnovo = $_GET['id_novo'];
    
    $result_usuario = "DELETE FROM rfa_socios_novos WHERE id_novo='$idnovo';";
	
	$qr = "SELECT * FROM rfa_socios_novos WHERE id_novo='$idnovo'";
	$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
	$row_lis = mysqli_fetch_assoc($lis);
	
	$refsoc = $row_lis['ref_novo'];
	
	$result_usuario .= "DELETE FROM rfa_socios_novos_filhos WHERE id_socio='$refsoc';";
    

if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Pedido removido com sucesso!');javascript:window.location='novos-socios.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>