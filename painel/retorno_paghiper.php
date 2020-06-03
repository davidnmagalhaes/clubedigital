<?php
include_once("config.php");
//include($arquivo);
$id = $_GET['id'];

$sql = "SELECT * FROM rfa_clubes WHERE id_clube='$id'";
$listainfo = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listainfo = mysqli_fetch_assoc($listainfo);
$apikeyclub = $row_listainfo['paghiper_appkey'];
$tokenclub = $row_listainfo['paghiper_token'];
$taxaclub = $row_listainfo['paghiper_taxa'];

$data = array (
	  'transaction_id' => $_POST['transaction_id'],
	  'notification_id' => $_POST['notification_id'],
	  'apiKey' => $apikeyclub, // aqui voce insere sua ApiKey
	  'token' => $tokenclub,  // aqui voce insere seu token
	);
	

$data;

$data_post = json_encode( $data );
$url = "https://api.paghiper.com/transaction/notification/";
$mediaType = "application/json"; // formato da requisição
$charSet = "UTF-8";
$headers = array();
$headers[] = "Accept: ".$mediaType;
$headers[] = "Accept-Charset: ".$charSet;
$headers[] = "Accept-Encoding: ".$mediaType;
$headers[] = "Content-Type: ".$mediaType.";charset=".$charSet;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
$json = json_decode($result, true);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$vr = $json['status_request']['value_cents_paid']; //Valor do pedido
$valorpedido = number_format($vr/100,2,",", ".");
$npedido = $json['status_request']['order_id']; //número do pedido

$contarpedido = strlen($npedido);

$pd = explode('-',$npedido); // separa número do pedido tirando o hífen

$soc =  $pd[0]; //Sócio
$month = $pd[1]; //Mês
$year = $pd[2]; //Ano
$us = $pd[3]; //Clube
$diasuteispgto = 2;//Dias úteis para receber o pagamento após o sucesso do mesmo

$query = "SELECT * FROM rfs_socios WHERE clube='$us' AND id_socio='$soc'";			
$pegasocio = mysqli_query($link, $query) or die(mysqli_error($link));
$row_pegasocio = mysqli_fetch_assoc($pegasocio);	

$diavenc = $row_pegasocio['mensalidade_diavenc'];

$q = "SELECT * FROM rfa_clubes WHERE id_clube='$us'";			
$pegaclube = mysqli_query($link, $q) or die(mysqli_error($link)); 
$row_pegaclube = mysqli_fetch_assoc($pegaclube);

$tx = $row_pegaclube['paghiper_taxa'];	

//include('dias-uteis.php');
//$datapgto = SomaDiasUteis(date("Y-m-d"),2);

$datapg = date('Y-m-d');
$datapgto = date('Y-m-d', strtotime("+3 days",strtotime($datapg))); 

$mesref = date('Y-m-d',strtotime($year."-".$month."-".$diavenc)); //mês de referencia da mensalidade

var_dump($json);
	if($json['status_request']['result'] == 'success'):

					if($json['status_request']['status'] == 'pending'):

					// aqui voce ira colocar o codigo PHP que deseja executar assim que o boleto é gerado, caso ja salve os dados na hora de criar o boleto nao precisa executar nada aqui

					
					elseif($json['status_request']['status'] == 'paid'):

							if($contarpedido == 14):
							//Codigo que sera executado assim que ocorrer a alteração de status para pago.
							$result = "UPDATE rfa_campanhas_pedidos SET status_pedido = '1', data_pagamento='$datapgto' WHERE protocolo_pedido = '$npedido'";
							
							mysqli_multi_query($link, $result);
							elseif($contarpedido == 15):

							$result = "UPDATE rfa_consorcio_pagamentos SET valor_pagamento = '$valorpedido', status_pagamento = '1', data_pagamento = '$datapgto' WHERE cod_pagamento='$npedido'";
							
							mysqli_multi_query($link, $result);

							else:	
							//Codigo que sera executado assim que ocorrer a alteração de status para pago.
							$result = "UPDATE rfa_mensalidades SET valor_mensalidade = '$valorpedido', pagamento = '1', data_pagamento = '$datapgto' WHERE id_socio = '$soc' AND data_mensalidade = '$mesref' AND clube = '$us'";
							
							mysqli_multi_query($link, $result);
							endif;


					elseif($json['status_request']['status'] == 'completed'):

							if($contarpedido >= 14):
							//Codigo que sera executado assim que ocorrer a alteração de status para pago.
							$result = "UPDATE rfa_campanhas_pedidos SET status_pedido = '1' WHERE protocolo_pedido = '$npedido'";
									
							mysqli_multi_query($link, $result);
							elseif($contarpedido == 15):

							$result = "UPDATE rfa_consorcio_pagamentos SET valor_pagamento = '$valorpedido', status_pagamento = '1', data_pagamento = '$datapgto' WHERE cod_pagamento='$npedido'";
							
							mysqli_multi_query($link, $result);
							else:	
							$result = "UPDATE rfa_mensalidades SET valor_mensalidade = '$valorpedido', pagamento = '1', data_pagamento = '$datapgto' WHERE id_socio = '$soc' AND data_mensalidade = '$mesref' AND clube = '$us'";
							
							mysqli_multi_query($link, $result);
							endif;

					elseif($json['status_request']['status'] == 'canceled'):
					
					
					
					else:
					
				
					
					endif;

	else:
					
		// no caso de não encontrar a notificação		
					
	endif;
?>