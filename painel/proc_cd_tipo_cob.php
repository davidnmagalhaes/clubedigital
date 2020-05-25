<?php 
//Conexão com banco de dados
include_once("config.php");

if($_POST['descricao'] == "Mensalidade" || $_POST['descricao'] == "mensalidade" || $_POST['descricao'] == "MENSALIDADE"){
			echo "<script>javascript:alert('Você não pode cadastrar uma cobrança de mensalidade, pois a mesma já existe!');javascript:window.location='socios.php'</script>";
}else{
/*Recebe as variáveis de emitir-boleto.php*/
$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao']);
$tipoboleto = mysqli_real_escape_string($link,$_POST['tipoboleto']);
$pagamentoate = mysqli_real_escape_string($link,$_POST['pagamentoate']);
$parcelas = mysqli_real_escape_string($link,$_POST['parcelas']);
$vencimento = mysqli_real_escape_string($link,$_POST['vencimento']);
$valor = mysqli_real_escape_string($link,$_POST['valor']);
$multa = mysqli_real_escape_string($link,$_POST['multa']);
$juros = mysqli_real_escape_string($link,$_POST['juros']);
$desconto = mysqli_real_escape_string($link,$_POST['desconto']);
$converter = mysqli_real_escape_string($link,$_POST['converter']);
$datacadastro = date('Y-m-d');

	$sql = "INSERT INTO rfa_tipo_cob (converter,descricao_cob, pagamentoate_cob, parcelas_cob, vencimento_cob, valor_cob, multa_cob, juros_cob, desconto_cob, tipoboleto_cob, user, data_cadastro, clube) VALUES ('$converter','$descricao', '$pagamentoate', '$parcelas', '$vencimento', '$valor', '$multa', '$juros', '$desconto', '$tipoboleto', '$user', '$datacadastro', '$club');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Tipo de cobrança cadastrada com sucesso!');javascript:window.location='edt-tipo-cob.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>