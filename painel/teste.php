<?php 


include("config.php");
/*
$checksocios = $_POST['checksocios'];
$m = $_POST['mes'];
$tpcobr = $_POST['tipo-cobranca'];
$valordif = $_POST['valordif'];
$des = $_POST['descdif'];
$des1 = str_replace(',','',$des);
$descdif = str_replace('.','',$des1);
$vencdif = $_POST['vencdif'];
$ano = $_POST['ano'];
$club = $_POST['club'];



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

$idsocio = $row_soc['id_socio'];
$nomesocio = $row_soc['nome_socio'];
$email = $row_soc['email_socio'];
$cpf = $row_soc['cpf_socio'];
$telefone = $row_soc['telefone_socio'];


var_dump($_POST['checksocios']);
var_dump($_POST['mes']);
var_dump($_POST['tipo-cobranca']);
var_dump($_POST['club']);
var_dump($_POST['descricao_cob']);
var_dump($_POST['multa_cob']);
var_dump($_POST['juros_cob']);
var_dump($_POST['tipoboleto_cob']);
var_dump($_POST['desconto_cob']);
var_dump($_POST['valor_cob']);
var_dump($_POST['parcelas_cob']);
var_dump($_POST['desconto_cob']);
var_dump($_POST['pagamentoate_cob']);
var_dump($_POST['vencimento_cob']);
var_dump($_POST['converter']);
var_dump($_POST['vencimento_cob']);
var_dump($_POST['id_socio']);
var_dump($_POST['nome_socio']);
var_dump($_POST['email_socio']);
var_dump($_POST['cpf_socio']);
var_dump($_POST['telefone_socio']);*/


  $Codigos = $_POST['checksocios']; //array

   $teste =  explode(',',$Codigos);
   var_dump($teste);


?>