<?php

     require_once('config.php');
    $idcob = $_GET['id_cob'];
    
    $result_usuario = "DELETE FROM rfa_tipo_cob WHERE id_cob='$idcob'";
    
	if (mysqli_query($link, $result_usuario)) {
		echo "<script>javascript:alert('Tipo de cobrança excluída com sucesso!');javascript:window.location='emitir-boleto.php'</script>";
} else {
		echo "<script>javascript:alert('Erro ao excluir! Erro: ".mysqli_error($link)." ');javascript:window.location='emitir-boleto.php'</script>";

}

mysqli_close($link);
	
	
?>