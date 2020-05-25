<?php 


include("config.php");

$checksocios = explode(',',$_POST['checksocios']);
$m = $_POST['mes'];
$tpcobr = $_POST['tipo-cobranca'];
$valordif = $_POST['valordif'];
$des = $_POST['descdif'];
$des1 = str_replace(',','',$des);
$descdif = str_replace('.','',$des1);
$vencdif = $_POST['vencdif'];
$ano = $_POST['ano'];
$club = $_POST['club'];

$sqto = "SELECT * FROM rfa_tipo_cob WHERE id_cob='$tpcobr' AND clube='$club'";
$tcobto = mysqli_query($link, $sqto) or die(mysqli_error($link));
$row_tcobto = mysqli_fetch_assoc($tcobto);

//if($checksocios == "" || $m == "" || $tpcobr == ""){

if($checksocios == ""){ 
	echo "<script>javascript:alert('Não foi possível prosseguir! Você pode não ter marcado algum sócio, mês de vencimento ou tipo de cobrança.');javascript:window.location='socios.php'</script>";
}elseif($row_tcobto['descricao_cob'] == "Mensalidade" && $m == ""){
  echo "<script>javascript:alert('Não foi possível prosseguir! Você não marcou o mês de vencimento.');javascript:window.location='socios.php'</script>";
}elseif($row_tcobto['descricao_cob'] == "Mensalidade" && $ano == ""){
  echo "<script>javascript:alert('Não foi possível prosseguir! Você não marcou o ano de vencimento.');javascript:window.location='socios.php'</script>";
}else{

$user = $_POST['user'];

$sql = "SELECT * FROM rfa_clubes WHERE id_clube='$club'";
$listachave = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listachave = mysqli_fetch_assoc($listachave);

$chavepaghiper = $row_listachave['paghiper_appkey'];
$tokenpaghiper = $row_listachave['paghiper_token'];

$scamb = "SELECT * FROM rfa_config_cambio WHERE id_cambio='1'";
$camb = mysqli_query($link, $scamb) or die(mysqli_error($link));
$row_camb = mysqli_fetch_assoc($camb);

$cmb = str_replace(',','',$row_camb['valor_cambio']);

$mesatual = str_pad($m, 2, "0", STR_PAD_LEFT);
$anoatual = str_pad($_POST['ano'], 2, "0", STR_PAD_LEFT);

foreach($checksocios as $key){

$sq = "SELECT * FROM rfa_tipo_cob WHERE id_cob='$tpcobr' AND clube='$club'";
$tcob = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_tcob = mysqli_fetch_assoc($tcob);

$svms = "SELECT * FROM rfa_mensalidades WHERE id_socio='$key' AND clube='$club' AND MONTH(data_mensalidade)='$m' AND YEAR(data_mensalidade)='$ano' AND boleto_emitido='1'";
$vms = mysqli_query($link, $svms) or die(mysqli_error($link));
$rows_tcob = mysqli_num_rows($vms);

if($rows_tcob > 0){
  echo "<script>javascript:alert('Este boleto já foi emitido para esta data e sócio!');javascript:window.location='socios.php'</script>";
}else{

$satualiza = "UPDATE rfa_mensalidades SET boleto_emitido='1' WHERE clube='$club' AND id_socio='$key' AND MONTH(data_mensalidade)='$m' AND YEAR(data_mensalidade)='$ano';";
$link->multi_query($satualiza);

$descricao = $row_tcob['descricao_cob'];
$multa = $row_tcob['multa_cob'];
$juros = $row_tcob['juros_cob'];
$tipoboleto = $row_tcob['tipoboleto_cob'];
$desconto = $row_tcob['desconto_cob'];
$valorcb = $row_tcob['valor_cob'];
$parcelacb = $row_tcob['parcelas_cob'];
$desc = $row_tcob['desconto_cob'];
$pagamentoate = $row_tcob['pagamentoate_cob'];
$vencimentocb = $row_tcob['vencimento_cob'];
$converter = $row_tcob['converter'];

if($converter == 1){
  $cambio = str_replace('.','',$cmb);
}else{
  $cambio = 1;
}

$query = "SELECT * FROM rfs_socios WHERE id_socio='$key' AND clube='$club'";
$soc = mysqli_query($link, $query) or die(mysqli_error($link));
$row_soc = mysqli_fetch_assoc($soc);
$diavenc = str_pad($row_soc['mensalidade_diavenc'], 2, "0", STR_PAD_LEFT);


$idsocio = $row_soc['id_socio'];
$nomesocio = $row_soc['nome_socio'];
$email = $row_soc['email_socio'];
$cpf = $row_soc['cpf_socio'];
$telefone = $row_soc['telefone_socio'];

if($descricao == "Mensalidade"){

      if($valordif != "" && $descdif != "" && $vencdif != "" ){
      $valor1 = str_replace(',','',$valordif);
      $valor = str_replace('.','',$valor1);
      $desconto = $descdif;
      $vencimento = $vencdif;
      }elseif($valordif != ""){
      $date = $anoatual . "-" . $mesatual . "-" . $diavenc;
      $valor1 = str_replace(',','',$valordif);
      $valor = str_replace('.','',$valor1);
      $desconto = ($valor * $desc) /100;
      $vencimento = date('Y-m-d',strtotime($date));
      }elseif($descdif != ""){
      $date = $anoatual . "-" . $mesatual . "-" . $diavenc;
      $valor1 = str_replace(',','',$row_soc['mensalidade_valor']);
      $valor = str_replace('.','',$valor1);
      $desconto = $descdif;
      $vencimento = date('Y-m-d',strtotime($date));
      }elseif($vencdif != ""){
      $valor1 = str_replace(',','',$row_soc['mensalidade_valor']);
      $valor = str_replace('.','',$valor1);
      $desconto = ($valor * $desc) /100;
      $vencimento = $vencdif;
      }else{
      $date = $anoatual . "-" . $mesatual . "-" . $diavenc;
      $valor1 = str_replace(',','',$row_soc['mensalidade_valor']);
      $valor = str_replace('.','',$valor1);
      $desconto = ($valor * $desc) /100;
      $vencimento = date('Y-m-d',strtotime($date));
      }
  $parcelas = 1;
}else{
  
        if($valordif != "" && $descdif != "" && $vencdif != ""){
        $valor1 = str_replace(',','',$valordif);
        $vlr = str_replace('.','',$valor1);
        $valor = ($vlr * $cambio);
        $desconto = $descdif;
        $vencimento = $vencdif;
        }elseif($valordif != ""){
        $valor1 = str_replace(',','',$valordif);
        $vlr = str_replace('.','',$valor1);
        $valor = ($vlr * $cambio);
        $desconto = ($valor * $desc) /100;
        $vencimento = date('Y-m-d',strtotime($vencimentocb));
        }elseif($descdif != ""){
        $valor1 = str_replace(',','',$valorcb);
        $vlr = str_replace('.','',$valor1);
        $valor = ($vlr * $cambio);
        $desconto = $descdif;
        $vencimento = date('Y-m-d',strtotime($vencimentocb));
      }elseif($vencdif != ""){
        $valor1 = str_replace(',','',$valorcb);
        $vlr = str_replace('.','',$valor1);
        $valor = ($vlr * $cambio);
        $desconto = $descdif;
        $vencimento = $vencdif;
        }else{
        $valor1 = str_replace(',','',$valorcb);
        $vlr = str_replace('.','',$valor1);
        $valor = $vlr * $cambio;
        $desconto = ($valor * $desc) /100;
        $vencimento = date('Y-m-d',strtotime($vencimentocb));
        }
  $parcelas = $parcelacb;
}

$numeroboleto = rand();

// Código para emitir boleto no Paghiper
$qtdparcelas = $parcelas; 
$divideparcela = $valor / $qtdparcelas;

$parcela = 0; // Não Alterar DEVE SEMPRE INICIAR EM 0 
$parcelaf = $qtdparcelas; // numero de parcelas que deseja o carne
$dataHoje = date('Y-m-d'); //não alterar, busca a data atual
$diavencimento = date('Y-m-d', strtotime($vencimento)); // Data do vencimento da primeira parcela, em formato Universal Y-M-D
while ($parcela < $parcelaf): // laço que calcula a quantidade de vezes que deve requisitar os boletos.
    if ($parcela > 0):
        $novovencimento = date('Y-m-d', strtotime('+ ' . $parcela . ' months', strtotime($diavencimento)));
    else:
        $novovencimento = $diavencimento;
    endif;
    $parcelan = $parcela + 1; // $parcelan serve para exibir corretamente o numero de parcelas do carne.
    $data1 = new DateTime($novovencimento);
    $data2 = new DateTime($dataHoje);

    $intervalo = $data1->diff($data2); // CALCULA A DIFERENÇA DE DATAS, PARA TRAZER O RESULTADOS EM DIAS CORRIDOS
    $vencimentoBoleto = $intervalo->days;

$data = array(
  'apiKey' => $chavepaghiper,
  'order_id' => $idsocio.'-'.$mesatual.'-'.$anoatual.'-'.$club, // código interno do lojista para identificar a transacao.
  'payer_email' => $email,
  'payer_name' => $nomesocio, // nome completo ou razao social
  'payer_cpf_cnpj' => $cpf, // cpf ou cnpj
  'payer_phone' => $telefone, // fixou ou móvel
  //'payer_street' => 'Av Brigadeiro Faria Lima',
  //'payer_number' => '1461',
  //'payer_complement' => 'Torre Sul 4º Andar',
  //'payer_district' => 'Jardim Paulistano',
  //'payer_city' => 'São Paulo',
  //'payer_state' => 'SP', // apenas sigla do estado
  //'payer_zip_code' => '01452002',
  'notification_url' => 'https://'.$_SERVER['HTTP_HOST'].'/'.basename(__DIR__).'/retorno_paghiper.php?id='.$club,
  'discount_cents' => '0', // em centavos
  'shipping_price_cents' => '0', // em centavos
  //'shipping_methods' => 'PAC',
  'fixed_description' => true,
  'type_bank_slip' => $tipoboleto, // formato do boleto
  'days_due_date' => $vencimentoBoleto, // dias para vencimento do boleto
  'late_payment_fine' => $multa,// Percentual de multa após vencimento.
  'per_day_interest' => $juros, // Juros após vencimento.
  'early_payment_discounts_cents' => $desconto,//Valor de desconto em centavos
  'open_after_day_due' => $pagamentoate,
  'items' => array(
      array ('description' => $descricao,
      'quantity' => '1',
'item_id' => '1',
'price_cents' => $divideparcela), // em centavos

),
);
$data_post = json_encode( $data );
$url = "http://api.paghiper.com/transaction/create/";
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
// captura o http code
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($httpCode == 201):
// CÓDIGO 201 SIGNIFICA QUE O BOLETO FOI GERADO COM SUCESSO
//echo $result;

// Exemplo de como capturar a resposta json
$transaction_id = $json['create_request']['transaction_id'];
$url_slip = $json['create_request']['bank_slip']['url_slip'];
$digitable_line = $json['create_request']['bank_slip']['digitable_line'];
$url_slip_pdf = $json['create_request']['bank_slip']['url_slip'];
//echo "<a href='".$url_slip_pdf."/pdf' target='_blank'><strong>Visualizar PDF</strong></a>";
//echo $resulta = file_get_contents($url_slip); // comentei a linha que armazena e exibiar os boletos.
 

 $arr[] = $transaction_id; // adicionei os codigos das transações ao array $arr



else:
//Esse trecho acessa a URL do boleto e exibe o conteudo na pagina, de acordo com a quantidade de parcelas, na hora da impressão ja gera a paginação.
     //echo $result;
	 echo "Infelizmente estamos com uma instabilidade em nossa emiss&atilde;o de boletos online, tente novamente mais tarde.";
endif;

$parcela ++; // incrementa a contagem de parcelas, para que assim o laço se encerre na quantidade certa de parcelas 
endwhile; // fim do laço



// inicio da requisição que juta PDF
$data = array (
  'apiKey' => $chavepaghiper,		 
  'token' => $tokenpaghiper, // AQUI VAI PRECISAR DO TOKEN DO COMERCIO
   'type_bank_slip' => $tipoboleto,
  'transactions' => $arr, // o array $arr é composto pelas transações emitidas no laço acima

);

$data;


$data_post = json_encode( $data );
$url = "https://api.paghiper.com/transaction/multiple_bank_slip/";
$mediaType = "application/json"; // formato da requisição
$origin = "*";
$charSet = "UTF-8";
$headers = array();
$headers[] = "Accept: ".$mediaType;
$headers[] = "Accept-Charset: ".$charSet;
$headers[] = "Accept-Encoding: ".$mediaType;
$headers[] = "Access-Control-Allow-Origin: ".$origin;
$headers[] = "Access-Control-Allow-Headers: content-type";
$headers[] = "Access-Control-Allow-Methods: POST";

$headers[] = "Content-Type: ".$mediaType.";charset=".$charSet;

//var_dump ($headers);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
$json = json_decode($result, true);
// captura o http code
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($httpCode == 201):
// CÓDIGO 201 SIGNIFICA QUE O PDF FOI GERADO COM SUCESSO
$result =  $json['status_request']['bank_slip_group'];

//echo "<script>javascript:window.open('".$result."','_blank');javascript:window.location='socios.php'</script>";

header('Location: '.$result.''); //redireciona para a pagina do pdf pronto para impressao
//echo '<a href="'.$result.'" target="_blank" >PDF</a>' // caso não queira redirecionar o cliente, e simplemente deixar um botão para abrir o pdf, descomente essa linha e comente a de cima.
;
else:

endif;

// Final da requisição que juta PDF
}// Finaliza o If que verifica se o boleto já foi emitido

}// Finaliza foreach

}// Finaliza If 
?>