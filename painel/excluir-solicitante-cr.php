<?php

     require_once('config.php');
    $idsolicitante = $_GET['id_solicitante'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_cr_solicitante WHERE id_solicitante='$idsolicitante' AND clube='$clube';";
    

if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Solicitação de doação removida com sucesso!');javascript:window.location='solicitantes-cr.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>