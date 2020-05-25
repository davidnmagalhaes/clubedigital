<?php 
//Conexão com banco de dados
include_once("config.php");

$club = mysqli_real_escape_string($link,$_POST['club']);
$idsocio = mysqli_real_escape_string($link,$_POST['idsocio']);
$tipopgto = mysqli_real_escape_string($link,$_POST['tipo-pgto']);

//Pega taxa do clube
$sqcl = "SELECT * FROM rfa_clubes WHERE id_clube='$club'";
$exbtx = mysqli_query($link, $sqcl) or die(mysqli_error($link));
$row_exbtx = mysqli_fetch_array($exbtx);
$txph = $row_exbtx['paghiper_taxa'];

if($tipopgto == 0){
		echo "<script>javascript:alert('Selecione um tipo de pagamento!');javascript:window.location='mensalidades.php?idsoc=".$idsocio."'</script>";
}else{

if($tipopgto == 1){
$txnew = $row_exbtx['paghiper_taxa'];
}else{}

if($tipopgto > 1){
$txnew = 0;
}else{}

/*Recebe as variáveis de socios.php*/

$datapagamento = mysqli_real_escape_string($link,$_POST['datapagamento']);
$statuspagamento = 1;

$diaref = mysqli_real_escape_string($link,$_POST['diaref']);
$mesref = mysqli_real_escape_string($link,$_POST['mesref']);
$anoref = mysqli_real_escape_string($link,$_POST['anoref']);
$valormensalidade = str_replace('.','',$_POST['valormens']);
$valormens = str_replace(',','.',$valormensalidade);
$datamensalidade = date('Y-m-d',strtotime($anoref."-".$mesref."-".$diaref));



$sqms = "SELECT * FROM rfa_mensalidades WHERE id_socio='$idsocio' AND clube='$club' AND MONTH(data_mensalidade)='$mesref' AND YEAR(data_mensalidade)='$anoref'";
$verms = mysqli_query($link, $sqms) or die(mysqli_error($link));
$row_verms = mysqli_fetch_assoc($verms);
$totalRows_verms = mysqli_num_rows($verms);

if($totalRows_verms > 0){
	$sql = "UPDATE rfa_mensalidades SET tipo_pagamento = '$tipopgto', taxa = '$txnew', data_pagamento='$datapagamento',  pagamento='$statuspagamento', valor_mensalidade='$valormens' WHERE id_socio = '$idsocio' AND clube='$club' AND data_mensalidade = '$datamensalidade';";
}else{
	$codmens = rand();

    //Faz verificação do código, caso exista gera outro
    $sqcd = "SELECT * FROM rfa_mensalidades WHERE cod_mensalidade='$codmens'";
    $vercode = mysqli_query($link, $sqcd) or die(mysqli_error($link));
    $totalRows_vercode = mysqli_num_rows($vercode);

    if($totalRows_vercode > 0){
        $codmens = rand();
    }

    $sql = "INSERT INTO rfa_mensalidades (tipo_pagamento, cod_mensalidade, id_socio, data_mensalidade, valor_mensalidade, taxa, pagamento, clube, data_pagamento) VALUES ('$tipopgto','$codmens', '$idsocio', '$datamensalidade', '$valormens', '$txph', '$statuspagamento', '$club', '$datapagamento');";
}
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Pagamento realizado com sucesso!');javascript:window.location='mensalidades.php?idsoc=".$idsocio."'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
	
}

?>