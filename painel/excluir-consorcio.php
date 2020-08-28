<?php

     require_once('config.php');
    $idconsorcio = $_GET['idconsorcio'];
    $clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_consorcio WHERE cod_consorcio='$idconsorcio' AND clube='$clube';";
	

if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Consórcio removido com sucesso!');javascript:window.location='consorcio'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>