<?php

     require_once('config.php');
    $idblog = $_GET['id_blog'];
	$clube = $_GET['clube'];
    
    $result_usuario = "DELETE FROM rfa_site_blog WHERE id_blog='$idblog' AND clube='$clube';";


if ($link->multi_query($result_usuario) === TRUE) {
		echo "<script>javascript:alert('Post do Blog removido com sucesso!');javascript:window.location='site-blog.php'</script>";
	
	} else {
		echo "Error: " . $result_usuario . "<br>" . $link->error;
	}

	$link->close();
	
	
?>