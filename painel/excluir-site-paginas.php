<?php

     require_once('config.php');
    $idblog = $_GET['id_page'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_site_menu_pages WHERE id_page='$idblog' AND clube='$clube';";


if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Páginas removida com sucesso!');javascript:window.location='paginas'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>