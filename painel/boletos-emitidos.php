<?php 
$page = 3;

include('config-header.php');
$page = $_GET['page'];

$sql = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$paghiper = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_paghiper = mysqli_fetch_assoc($paghiper);
$pagtoken = $row_paghiper['paghiper_token'];
$pagappkey = $row_paghiper['paghiper_appkey'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestão do Rotary Fortaleza Alagadiço">
    <meta name="author" content="David Magalhães">
    <meta name="keywords" content="rotary alagadiço, rotary fortaleza alagadiço, fortaleza alagadiço">

    <!-- Title Page-->
    <title>Emitir Boleto - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->
	
	
	
</head>

<body class="animsition">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->

            
 <div class="main-content">
			
							
							<form method="get" action="boletos-emitidos.php" name="form-contabancaria">
			
			<div class="row">
				<div class="col">
					<img src="images/logo-paghiper.png" style="margin-left: 20px"/>
			<?php if(empty($row_paghiper['paghiper_appkey']) || empty($row_paghiper['paghiper_token'])){?>
					<div class="alert alert-danger" role="alert" style="margin: 10px 16px">
							<p>
							<strong>Atenção:</strong><br>
							Para emitir boletos é necessário que antes faça a integração <a href="integracao.php">clicando aqui</a>...
							</p>
					</div>
			<?php }else{} ?>
				</div>
			</div>
			
			
			
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Boletos emitidos</strong>
                                        <small>PagHiper</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
										
										
										
										<?php 





$data = array(
  'token' => $pagtoken,
  'apiKey' => $pagappkey,
  //'initial_date' => '2019-05-17',
  //'final_date' => '2019-06-25',
  //'filter_date' => 'paid_date',
  //'status' => 'paid',
  'page' => $page,
);
$data_post = json_encode( $data );
$url = "http://api.paghiper.com/transaction/list/";
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
$pedido = $json['transaction_list_request']['transaction_list'];
$url_slip = $json['create_request']['bank_slip']['url_slip'];
$digitable_line = $json['transaction_list_request']['bank_slip']['digitable_line'];


$resulta = $pedido;



foreach($resulta as $key => $rs){
	
	//$pd = explode(' ',$rs["order_id"]);

//echo $pd[0]; //pedido
//echo $pd[3]; //parcela
//echo $pd[5]; //parcela final
	
	echo '<div class="accordion" id="accordionExample">';
	echo '<div class="card">
    <div class="card-header" id="heading'.$key.'">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$key.'" aria-expanded="false" aria-controls="collapse'.$key.'">
		<strong>Pedido:</strong> '.$rs["order_id"];
	if($rs['status'] == 'refunded'){ echo '<span style="margin-left: 30px; color: #3d3abb; font-weight: bold;">Estornado</span>';};
	if($rs['status'] == 'pending'){ echo '<span style="margin-left: 30px;color: #ea7722; font-weight: bold;">Aguardando</span>';}; 
	if($rs['status'] == 'reserved'){ echo '<span style="margin-left: 30px;color: #ef2cd5; font-weight: bold;">Reservado</span>';};
	if($rs['status'] == 'canceled'){ echo '<span style="margin-left: 30px;color: #e21d1d; font-weight: bold;">Cancelado</span>';};
	if($rs['status'] == 'paid'){ echo '<span style="margin-left: 30px;color: #17a51c; font-weight: bold;">Aprovado</span>';};
	if($rs['status'] == 'completed'){ echo '<span style="margin-left: 30px;color: #17a51c; font-weight: bold;">Completo</span>';};
	if($rs['status'] == 'processing'){ echo '<span style="margin-left: 30px;color: #d6b610; font-weight: bold;">Em análise</span>';};
	echo '<strong style="margin-left: 15px">'.$rs['payer_name'].'</strong>';
	echo '
	</button>
      </h5>
    </div>
	
	<div id="collapse'.$key.'" class="collapse" aria-labelledby="heading'.$key.'" data-parent="#accordionExample">
      <div class="card-body">
		';
	
	echo "<table class='table table-striped'>";
	echo "<thead class='thead-dark'><tr><th colspan='2'><strong>Pedido:</strong> ".$rs['order_id']."<br></th></tr></thead>";
	echo "<tr><td><strong>ID da Transação:</strong></td><td> ".$rs['transaction_id']."<br></td></tr>";
	echo "<tr><td><strong>Data do pedido:</strong> </td><td>".date("d/m/Y",strtotime($rs['create_date']))."<br></td></tr>";
	echo "<tr><td><strong>Status:</strong> </td><td>"; 
	if($rs['status'] == 'refunded'){ echo '<span style="color: #3d3abb; font-weight: bold;">Estornado</span>';};
	if($rs['status'] == 'pending'){ echo '<span style="color: #ea7722; font-weight: bold;">Aguardando</span>';}; 
	if($rs['status'] == 'reserved'){ echo '<span style="color: #ef2cd5; font-weight: bold;">Reservado</span>';};
	if($rs['status'] == 'canceled'){ echo '<span style="color: #e21d1d; font-weight: bold;">Cancelado</span>';};
	if($rs['status'] == 'paid'){ echo '<span style="color: #17a51c; font-weight: bold;">Aprovado</span>';};
	if($rs['status'] == 'completed'){ echo '<span style="color: #17a51c; font-weight: bold;">Completo</span>';};
	if($rs['status'] == 'processing'){ echo '<span style="color: #d6b610; font-weight: bold;">Em análise</span>';}; echo "<br></td></tr>";
	echo "<tr><td><strong>Último status:</strong> </td><td>".date("d/m/Y H:i",strtotime($rs['status_date']))."<br></td></tr>";
	echo "<tr><td><strong>Vencimento do Boleto:</strong> </td><td>".date("d/m/Y",strtotime($rs['due_date']))."<br></td></tr>";
	echo "<tr><td><strong>E-mail do cliente:</strong> </td><td>".$rs['payer_email']."<br></td></tr>";
	echo "<tr><td><strong>Nome do Pagador:</strong> </td><td>".$rs['payer_name']."<br></td></tr>";
	echo "<tr><td><strong>CPF/CNPJ:</strong> </td><td>".$rs['payer_cpf_cnpj']."<br></td></tr>";
	echo "<tr><td><strong>Telefone:</strong> </td><td>".$rs['payer_phone']."<br></td></tr>";
	echo "<tr><td><strong>Data de Aprovação:</strong> </td><td>".date("d/m/Y H:i",strtotime($rs['paid_date']))."<br></td></tr>";
	echo "<tr><td><strong>Valor:</strong></td><td> R$ ".number_format($rs['value_cents']/100, 2 ,',','')."<br></td></tr>";
	echo "<tr><td><strong>Código de Barras:</strong> </td><td><input class='form-control' value='".$rs['bank_slip']['digitable_line']."'/><br></td></tr>";
	echo "<tr><td colspan='2'><strong>Boleto PDF:</strong> <a href='".$rs['bank_slip']['url_slip_pdf']."' target='_blank'><img src='img/icone_boleto.png' width='100'/></a><br><br></td></tr>";
	echo "</table>";
	echo '</div>
    </div>
  </div>';
}
echo '<div class="row justify-content-md-center" style="margin: 30px 0;"><div class="col-2" style="text-align:center;"><label><strong>Página:</strong></label><input type="number" name="page" class="form-control" style="text-align:center" onChange="this.form.submit()" placeholder="Número da página" min="1" max="999" value="1" /></div></div></form>';
else:
//Esse trecho acessa a URL do boleto e exibe o conteudo na pagina, de acordo com a quantidade de parcelas, na hora da impressão ja gera a paginação.
     //echo $result;   
	 echo "Não há resultados para o filtro realizado!";
	 echo '<div class="row justify-content-md-center" style="margin: 30px 0;"><div class="col-2" style="text-align:center;"><label><strong>Página:</strong></label><input type="number" name="page" class="form-control" style="text-align:center" onChange="this.form.submit()" placeholder="Número da página" min="1" max="999" value="" /></div></div></form>';

endif;

?>
										
										
                                        
                                    </div>
									<div>
                                                
                                         </div>
                                </div>
                            </div>
							
							
							
							
							</form>
							
		
							
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	<!-- Start Script para trocar tipo de pessoa -->
<script>
		$('input[name="tipopessoa"]').change(function () {
    if ($('input[name="tipopessoa"]:checked').val() === "pj") {
        $('.exibetipopessoapj').show();
		 $('.exibetipopessoapf').hide();
    } else {
        $('.exibetipopessoapj').hide();
		$('.exibetipopessoapf').show();
    }
});
	</script>
	<!-- End Script para trocar tipo de pessoa -->
	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->