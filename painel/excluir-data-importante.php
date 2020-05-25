<?php

     require_once('config.php');
    $idservico = $_GET['id_data_imp'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_datas_importantes WHERE id_data_imp='$idservico' AND clube='$clube';";


if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Data Importante removida com sucesso!');javascript:window.location='datas-importantes.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>