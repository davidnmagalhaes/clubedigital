<?php

     require_once('config.php');
    $iddoador = $_GET['id_doador'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_cr_doador WHERE id_doador='$iddoador' AND clube='$clube';";
    

if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('O doador foi removido com sucesso!');javascript:window.location='doadores-cr.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>