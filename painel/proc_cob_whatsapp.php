<?php 
//Conexão com banco de dados
include_once("config.php");

$idsocio = $_GET['id_socio'];
$clube = $_GET['clube'];
$codmens = $_GET['codmens'];

$q = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.cod_mensalidade='$codmens' AND rfa_mensalidades.clube='$clube'";
$buscamensa = mysqli_query($link, $q) or die(mysqli_error($link));
$row_buscamensa = mysqli_fetch_assoc($buscamensa);

$nomesocio = $row_buscamensa['nome_socio'];
$emailsocio = $row_buscamensa['email_socio'];
$celularsocio = str_replace(' ','',$row_buscamensa['celular_socio']);
$valormensalidade = number_format($row_buscamensa['valor_mensalidade'],2,',','.');
$vencimento = date('d/m/Y',strtotime($row_buscamensa['data_mensalidade']));

$query = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$buscaclube = mysqli_query($link, $query) or die(mysqli_error($link));
$row_buscaclube = mysqli_fetch_assoc($buscaclube);

$nomeclube = $row_buscaclube['nome_clube'];
$emailclube = $row_buscaclube['email_clube'];
	

		echo "<script>javascript:window.location='https://api.whatsapp.com/send?phone=55".$celularsocio."&text=Prezado(a)%20companheiro(a)%20".$nomesocio.",%20esta%20é%20uma%20mensagem%20automática%20do%20clube%20de%20Rotary%20o%20qual%20você%20é%20associado(a).%20Infelizmente%20ainda%20não%20localizamos%20o%20pagamento%20da%20mensalidade%20com%20vencimento%20no%20dia%20".$vencimento."%20no%20valor%20de%20R$%20".$valormensalidade.".%20Por%20gentileza%20solicitamos%20que%20regularize%20o%20mais%20breve%20possível.%20Caso%20já%20tenha%20efetuado%20o%20pagamento%20pedimos%20que%20ignore%20esta%20mensagem.%20Qualquer%20dúvida%20estamos%20à%20disposição.%20Cordialmente,%20RC%20".$nomeclube.".';</script>";
	

?>