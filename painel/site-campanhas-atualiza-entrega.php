<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de integracao.php*/
$statusentrega = mysqli_real_escape_string($link,$_POST['statusentrega']);
$protocolo = mysqli_real_escape_string($link,$_POST['protocolo']);
$clube = mysqli_real_escape_string($link,$_POST['clube']);
$idcampanha = mysqli_real_escape_string($link,$_POST['idcampanha']);

	$sql = "UPDATE rfa_campanhas_pedidos SET status_pedido = '$statusentrega' WHERE clube = '$clube' AND protocolo_pedido='$protocolo';";
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Status alterado com sucesso!');javascript:window.location='site-campanhas-pedidos.php?idcampanha=".$idcampanha."&clube=".$clube."'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>