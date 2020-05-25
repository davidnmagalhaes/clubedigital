<?php 

if(empty($_POST['clube']) || empty($_POST['idconsorcio'])):

else:

include("../config.php");

$clube = $_POST['clube'];
$idconsorcio = $_POST['idconsorcio'];
$socio = mysqli_real_escape_string($link,$_POST['idsocio']);
$nome = mysqli_real_escape_string($link,$_POST['nome']);
$cpf = mysqli_real_escape_string($link,$_POST['cpf']);
$email = mysqli_real_escape_string($link,$_POST['email']);
$telefone = mysqli_real_escape_string($link,$_POST['telefone']);
$metodopagamento = mysqli_real_escape_string($link,$_POST['metodopagamento']);
$totalboleto = mysqli_real_escape_string($link,$_POST['totalboleto']);
$protocolo = mysqli_real_escape_string($link,$_POST['protocolo']);
$data = mysqli_real_escape_string($link,$_POST['data']);
$hora = mysqli_real_escape_string($link,$_POST['hora']);
$statuspedido = 0;


$codpagamento = date('ymdHis').rand(100,200);


$qcmp = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND cod_consorcio='$idconsorcio'";
$cmp = mysqli_query($link, $qcmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_array($cmp);

$mesvenc = date('m',strtotime($row_cmp['data_inicial']));
$anovenc = date('Y',strtotime($row_cmp['data_inicial']));
$diavenc = str_pad($row_cmp['dia_vencimento'],2,"0",STR_PAD_LEFT);

if(isset($_POST['mesvenc']) && isset($_POST['anovenc'])){
  $m = $_POST['mesvenc'];
  $a = $_POST['anovenc'];
}else{
  $m = $mesvenc;
  $a = $anovenc;
}

$mesatual = str_pad($m, 2, "0", STR_PAD_LEFT);
$anoatual = str_pad($a, 2, "0", STR_PAD_LEFT);

$datavencimento = $anoatual."-".$mesatual."-".$diavenc;
$datatual = date('Y-m-d');

$sql = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$listachave = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listachave = mysqli_fetch_assoc($listachave);

$chavepaghiper = $row_listachave['paghiper_appkey'];
$tokenpaghiper = $row_listachave['paghiper_token'];

$valorcampanha = $totalboleto;
$nomecampanha = $row_cmp['nome_consorcio'];


if(isset($_POST['mesvenc']) && isset($_POST['anovenc']) && $datavencimento < $datatual){
  $date = date('Y-m-d',strtotime('+5 days',strtotime($dataatual)));
}elseif(isset($_POST['mesvenc']) && isset($_POST['anovenc']) && $datavencimento >= $datatual){
  $date = $datavencimento;
}else{
  $date = date('Y-m-d',strtotime('+5 days',strtotime($dataatual)));
}
$valor1 = str_replace(',','',$valorcampanha);
$valor = str_replace('.','',$valor1);
//$desconto = ($valor * $desc) /100;
$vencimento = date('Y-m-d',strtotime($date));
$parcelas = 1;
$tipoboleto = "boletoA4";
$descricao = $nomecampanha;


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
  'order_id' => $codpagamento, // código interno do lojista para identificar a transacao.
  'payer_email' => $email,
  'payer_name' => $nome, // nome completo ou razao social
  'payer_cpf_cnpj' => $cpf, // cpf ou cnpj
  'payer_phone' => $telefone, // fixou ou móvel
  //'payer_street' => 'Av Brigadeiro Faria Lima',
  //'payer_number' => '1461',
  //'payer_complement' => 'Torre Sul 4º Andar',
  //'payer_district' => 'Jardim Paulistano',
  //'payer_city' => 'São Paulo',
  //'payer_state' => 'SP', // apenas sigla do estado
  //'payer_zip_code' => '01452002',
  'notification_url' => 'https://'.$_SERVER['HTTP_HOST'].'/painel/retorno_paghiper.php?id='.$clube,
  'discount_cents' => '0', // em centavos
  'shipping_price_cents' => '0', // em centavos
  //'shipping_methods' => 'PAC',
  'fixed_description' => true,
  'type_bank_slip' => $tipoboleto, // formato do boleto
  'days_due_date' => $vencimentoBoleto, // dias para vencimento do boleto
  //'late_payment_fine' => $multa,// Percentual de multa após vencimento.
  //'per_day_interest' => $juros, // Juros após vencimento.
  //'early_payment_discounts_cents' => $desconto,//Valor de desconto em centavos
  //'open_after_day_due' => $pagamentoate,
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
$url_slip_pdf = $json['create_request']['bank_slip']['url_slip_pdf'];

$sinal = 1;
$titulo = "Boleto emitido com sucesso!";
$resultado = "<a href='".$url_slip_pdf."/pdf' target='_blank'><strong>Clique para imprimir o boleto</strong></a>";
//echo $resulta = file_get_contents($url_slip); // comentei a linha que armazena e exibiar os boletos.
// header('Location: '.$result.'');

if(isset($_POST['mesvenc']) && isset($_POST['anovenc'])):
$sqlins = "INSERT INTO rfa_consorcio_pagamentos (data, hora, url_segunda_via, cod_consorcio, cod_inscrito, cod_pagamento, status_pagamento, data_vencimento, forma_pagamento, boleto_emitido, clube) VALUES ('$data','$hora','$url_slip_pdf','$idconsorcio', '$protocolo', '$codpagamento', '0', '$datavencimento','$metodopagamento','1','$clube');";
else:

$sqlins = "INSERT INTO rfa_consorcio_inscritos (cod_inscrito, cod_consorcio, id_socio, forma_pagamento, status_inscricao, data, hora, clube) VALUES ('$protocolo','$idconsorcio','$socio','$metodopagamento','$statuspedido','$data', '$hora', '$clube');";

$sqlins .= "INSERT INTO rfa_consorcio_pagamentos (data, hora, url_segunda_via, cod_consorcio, cod_inscrito, cod_pagamento, status_pagamento, data_vencimento, forma_pagamento, boleto_emitido, clube) VALUES ('$data','$hora','$url_slip_pdf','$idconsorcio', '$protocolo', '$codpagamento', '0', '$datavencimento','$metodopagamento','1','$clube');";

endif;
$link->multi_query($sqlins);

 $arr[] = $transaction_id; // adicionei os codigos das transações ao array $arr


else:
//Esse trecho acessa a URL do boleto e exibe o conteudo na pagina, de acordo com a quantidade de parcelas, na hora da impressão ja gera a paginação.
     //echo $result;
     //echo $protocolo;
$sinal = 0;
$titulo = "Houve um problema na emissão do boleto!";
$resultado = "Infelizmente estamos com uma instabilidade em nossa emiss&atilde;o de boletos online, tente novamente mais tarde.".$datavencimento;

endif;

$parcela ++; // incrementa a contagem de parcelas, para que assim o laço se encerre na quantidade certa de parcelas 
endwhile; // fim do laço


?>
  

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PagHiper - Último passo para gerar o boleto bancário</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
        <link rel="shortcut icon" href="https://www.paghiper.com/img/icon/ico.gif" />
        <link rel="stylesheet" href="https://www.paghiper.com/css/checkout.css" />
        <script src="https://www.paghiper.com/js/jquery-1.11.2.min.js"></script>
        <script src="https://www.paghiper.com/js/jquery-mask.js"></script>
        <script src="https://www.paghiper.com/js/config.js"></script>
        <script>
            //SCRIPT RESPONSÁVEL POR EXIBIR OU OCULTAR A PESSOA FISICA OU JURIDICA
            var Main = function(){
                var self = this;
                
                this.verificaPessoa = function(value){
                    if(value == 'pf'){
                        $('.pj').hide();
                        $('.pf').show();
                        $('.cpf').attr('required', 'required');
                        $('.cnpj').removeAttr('required');
                        $('.rsocial').removeAttr('required');
                    } else {
                        $('.pj').show();
                        $('.pf').hide();
                        $('.cpf').removeAttr('required');
                        $('.cnpj').attr('required', 'required');
                        $('.rsocial').attr('required', 'required');
                    }
                };
                
            };            
            var ctrl = new Main();
            
            $(function(){
                ctrl.verificaPessoa('pf');
            });
        </script>
    <script language="javascript">    
         document.onkeydown = function () { 
           switch (event.keyCode) {
             case 116 :  
                event.returnValue = false;
                event.keyCode = 0;           
                return false;             
              case 82 : 
                if (event.ctrlKey) {  
                   event.returnValue = false;
                  event.keyCode = 0;             
                  return false;
           }
         }
     } 
     </script>
    </head>
    <body>
        <div id="header">
            <div class="page">
                <img src="https://www.paghiper.com/img/logo.gif" alt="PagHiper - Forma facil e segura de comprar na Internet" border="0"/>
                <dl>
                    <dt></dt>
                    <dd></dd>
                </dl>
            </div>
        </div>
        <div class="page">
            <br />
            <h1 style="margin-bottom: -5px;"><?php echo $titulo; ?> <?php echo $codpagamento;?></h1>
            <hr />
            <br />
            <br />
            <fieldset>
                <legend><?php if($sinal == 1){echo "Detalhes do pagamento";}else{echo "Detalhe do erro";}?></legend>
                <div>
                    <?php if($sinal == 1){?>
                    <div class="col col-1 vertical-align-middle" style="padding: 15px">
                        <img src="https://www.paghiper.com/img/icon/boleto-bancario-ico-gray.jpg" alt="Boleto Bancário" />
                    </div>
                    <div class="col col-8 vertical-align-middle" >
                        <h3 style="margin:0 0 5px 0;">Boleto Bancário</h3>
                        <p style="margin: 0">
                           <?php echo $resultado; ?>  <strong></strong>.
                        </p>
                    </div>
                <?php }else{ ?>

                    <div class="col col-8 vertical-align-middle" >
                        <h3 style="margin:0 0 5px 0;"><?php echo $resultado;?></h3>
                        
                    </div>
                <?php } ?>
                </div>
            </fieldset>
            <br />
            <br />
            <br />
            
            <fieldset>
                <legend>Recibo</legend>
            <!--
                * INICIO DA TABELA ONDE APRESENTA A LISTAGEM DE PRODUTOS
            -->
            
           <a href="../mpdf/doc-consorcio.php?clube=<?php echo $clube; ?>&protocolo=<?php echo $codpagamento; ?>&metodopagamento=<?php echo $metodopagamento; ?>" target="_blank">Imprimir recibo</a>
            
           
            </fieldset>
            
            </div>
        </div>
        
        <div id="rodape">
            <div class="page">
                <p>Todos os direitos reservados a PagHiper Serviços Online - CNPJ: 20.110.153-0001/07 | © <?php echo date('Y');?></p>
            </div>
        </div>
    </body>
</html>
<?php 

endif;

?>