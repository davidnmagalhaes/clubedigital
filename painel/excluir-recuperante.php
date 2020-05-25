<?php

     require_once('config.php');
    $codrec = $_GET['cod_rec'];
	$clube = $_GET['clube'];

	$q = "SELECT * FROM rfa_recuperantes WHERE cod_recuperante='$codrec' AND clube='$clube'";
	$pegapauta = mysqli_query($link, $q) or die(mysqli_error($link));
	$row_pegapauta = mysqli_fetch_assoc($pegapauta);
	$idpauta = $row_pegapauta['id_pauta'];
    
    $result_usuario = "DELETE FROM rfa_recuperantes WHERE cod_recuperante='$codrec' AND clube='$clube';";


if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Recuperante foi removido com sucesso!');javascript:window.location='emitir-recuperante.php?cod_pauta=".$idpauta."&clube=".$clube."'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>