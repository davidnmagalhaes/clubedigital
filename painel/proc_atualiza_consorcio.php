<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_banco.php*/
$formapagamento = mysqli_real_escape_string($link,$_POST['formapagamento']);
$datapagamento = mysqli_real_escape_string($link,$_POST['datapagamento']);
$codinscrito = mysqli_real_escape_string($link,$_POST['codinscrito']);
$codconsorcio = mysqli_real_escape_string($link,$_POST['codconsorcio']);
$vencimento = mysqli_real_escape_string($link,$_POST['vencimento']);
$clube = mysqli_real_escape_string($link,$_POST['clube']);
$valorpagamento = mysqli_real_escape_string($link,str_replace(',','.',$_POST['valorpagamento']));
$codpagamento = date('ymdHis').rand(100,200);
$origem = 'manual';
$data = date('Y-m-d');
$hora = date('H:i:s');
$ativo = 1;

	$sql = "INSERT INTO rfa_consorcio_pagamentos (data, hora, valor_pagamento, origem_pagamento, forma_pagamento, cod_consorcio, cod_inscrito, cod_pagamento, status_pagamento, data_pagamento, data_vencimento, clube) VALUES('$data','$hora','$valorpagamento','$origem','$formapagamento','$codconsorcio', '$codinscrito', '$codpagamento','$ativo','$datapagamento','$vencimento', '$clube');";

	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Pagamento realizado com sucesso!');javascript:window.location='consorcio-inscritos.php?idconsorcio=".$codconsorcio."&clube=".$clube."'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>