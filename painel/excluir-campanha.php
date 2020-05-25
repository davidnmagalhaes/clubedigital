<?php

     require_once('config.php');
    $idcampanha = $_GET['idcampanha'];
    $clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_campanhas WHERE id_campanha='$idcampanha' AND clube='$clube';";
	

if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Campanha removida com sucesso!');javascript:window.location='campanhas'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>