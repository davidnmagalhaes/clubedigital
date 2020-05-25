<?php

     require_once('config.php');
    $idusuario = $_GET['id_usuario'];
    
    $result_usuario = "DELETE FROM rfa_usuario WHERE id_usuario='$idusuario'";
    
	if (mysqli_query($link, $result_usuario)) {
		echo "<script>javascript:alert('Usuário removido com sucesso!');javascript:window.location='administracao.php'</script>";
} else {
		echo "<script>javascript:alert('Erro ao excluir! Erro: ".mysqli_error($link)." ');javascript:window.location='emitir-boleto.php'</script>";

}

mysqli_close($link);
	
	
?>