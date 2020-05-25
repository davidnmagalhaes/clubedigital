<?php

     require_once('config.php');
    $idgaleria = $_GET['id_galeria'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_site_governadores WHERE cod_governador='$idgaleria' AND clube='$clube';";


if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Governador removido da galeria com sucesso!');javascript:window.location='site-governador.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>