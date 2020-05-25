<?php

     require_once('config.php');
    $idservico = $_GET['id_comunidade'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_servicos_comunidade WHERE id_servico='$idservico' AND clube='$clube';";


if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Serviço à comunidade removido com sucesso!');javascript:window.location='servicos-comunidade.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>