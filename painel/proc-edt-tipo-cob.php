<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de emitir-boleto.php*/
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$idcob = mysqli_real_escape_string($link,$_POST['id_cob']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao']);
$tipoboleto = mysqli_real_escape_string($link,$_POST['tipoboleto']);
$pagamentoate = mysqli_real_escape_string($link,$_POST['pagamentoate']);
$parcelas = mysqli_real_escape_string($link,$_POST['parcelas']);
$vencimento = mysqli_real_escape_string($link,$_POST['vencimento']);
$valorrec = mysqli_real_escape_string($link,str_replace(',','.',$_POST['valor']));
$valor = $valorrec;
$multa = mysqli_real_escape_string($link,$_POST['multa']);
$juros = mysqli_real_escape_string($link,$_POST['juros']);
$desconto = mysqli_real_escape_string($link,$_POST['desconto']);
$converter = mysqli_real_escape_string($link,$_POST['converter']);
$datacadastro = date('Y-m-d');

	$sql = "UPDATE rfa_tipo_cob SET converter = '$converter', descricao_cob = '$descricao', pagamentoate_cob = '$pagamentoate', parcelas_cob = '$parcelas', vencimento_cob = '$vencimento', valor_cob = '$valor', multa_cob = '$multa', juros_cob = '$juros', desconto_cob = '$desconto', tipoboleto_cob = '$tipoboleto', data_cadastro = '$datacadastro' WHERE clube = '$club' AND id_cob = '$idcob'";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Tipo de cobrança atualizada com sucesso!');javascript:window.location='edt-tipo-cob.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>