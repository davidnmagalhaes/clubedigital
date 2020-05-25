<?php

     require_once('config.php');
    $idpauta = $_GET['id_pauta'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_pauta WHERE cod_pauta='$idpauta' AND clube='$clube';";

	
	$result_usuario .= "DELETE FROM rfa_mesa WHERE ref_pauta='$idpauta' AND clube='$clube';";
    

if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Pauta removida com sucesso!');javascript:window.location='pauta.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>