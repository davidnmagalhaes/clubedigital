<?php

     require_once('config.php');
    $idservico = $_GET['id_profissional'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_servicos_profissionais WHERE id_prof='$idservico' AND clube='$clube';";


if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Serviço Profissional removido com sucesso!');javascript:window.location='servicos-profissionais.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>