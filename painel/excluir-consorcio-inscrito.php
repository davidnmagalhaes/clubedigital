<?php

     require_once('config.php');
    $idconsorcio = $_GET['idconsorcio'];
    $codinscrito = $_GET['codinscrito'];
    $clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_consorcio_inscritos WHERE cod_inscrito='$codinscrito' AND clube='$clube' AND cod_consorcio='$idconsorcio';";
	

if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Participante removido com sucesso!');javascript:window.location='consorcio-inscritos.phpidconsorcio=".$idconsorcio."&clube=".$clube."'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>