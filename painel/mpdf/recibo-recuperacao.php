<?php 
require_once __DIR__ . '/vendor/autoload.php';
include_once("../config.php");

$idpauta = $_GET['cod_pauta'];
$clube = $_GET['clube'];

//Pega informações da Pauta
$sql = "SELECT * FROM rfa_pauta WHERE cod_pauta='$idpauta' AND clube='$clube'";
$pegapauta = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_pegapauta = mysqli_fetch_assoc($pegapauta);

//Pega informações do Clube
$sq = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$pegaclube = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_pegaclube = mysqli_fetch_assoc($pegaclube);

//Pega Local da Reunião
$idlocal = $row_pegapauta['id_local'];

$q = "SELECT * FROM rfa_local_reuniao WHERE id_local='$idlocal' AND clube='$clube'";
$pegalocal = mysqli_query($link, $q) or die(mysqli_error($link));
$row_pegalocal = mysqli_fetch_assoc($pegalocal);

//Pega informações da Reunião Agendada
$idreuniao = $row_pegapauta['ref_reuniao'];

$query = "SELECT * FROM rfa_reuniao WHERE id_reuniao='$idreuniao' AND clube='$clube'";
$pegareuniao = mysqli_query($link, $query) or die(mysqli_error($link));
$row_pegareuniao = mysqli_fetch_assoc($pegareuniao);

//Pega presidente do clube
$funcaopresidente = 2;

$s = "SELECT * FROM rfa_usuario WHERE clube='$clube' AND funcao='$funcaopresidente'";
$pegapresidente = mysqli_query($link, $s) or die(mysqli_error($link));
$row_pegapresidente = mysqli_fetch_assoc($pegapresidente);

//Pega secretário do clube
$funcaosecretario = 3;

$r = "SELECT * FROM rfa_usuario WHERE clube='$clube' AND funcao='$funcaosecretario'";
$pegasecretario = mysqli_query($link, $r) or die(mysqli_error($link));
$row_pegasecretario = mysqli_fetch_assoc($pegasecretario);

//Pega composição da mesa diretora
$m = "SELECT * FROM rfa_mesa WHERE ref_pauta='$idpauta' AND clube='$clube'";
$pegamesa = mysqli_query($link, $m) or die(mysqli_error($link));
$row_pegamesa = mysqli_fetch_assoc($pegamesa);

$nomemesa = "";

foreach($pegamesa as $mesa){
	$nomemesa .= "<li><strong>".$mesa['cargo_mesa'].":</strong> ".$mesa['nome_mesa']."</li>";
}

//Datas atuais
$AnoAtual = date('Y');
$Y = '0001';
$Week = date('w'); /* Semana atual... */
//$FirstDay = date('d', strtotime('-'.$Week.' days'));
//$LastDay = date('d', strtotime('+'.(6-$Week).' days'));
$FirstDay = date('d',strtotime($row_pegapauta['niver_inicial']));
$LastDay = date('d',strtotime($row_pegapauta['niver_final']));
$FirstM = date('m',strtotime($row_pegapauta['niver_inicial']));
$LastM = date('m',strtotime($row_pegapauta['niver_final']));
$InicialDate = $Y."-".date('m-d',strtotime($row_pegapauta['niver_inicial']));
$FinalDate = $Y."-".date('m-d',strtotime($row_pegapauta['niver_final']));
$Month = date('m');
$DiaAtual = date('Y-m-d');


//Serviços à comunidade
$sc = "SELECT * FROM rfa_servicos_comunidade WHERE clube='$clube' ORDER BY mes_servico ASC, dia_servico ASC ";
$pegacomunidade= mysqli_query($link, $sc) or die(mysqli_error($link));
$row_pegacomunidade = mysqli_fetch_assoc($pegacomunidade);
$totalRows_pegacomunidade = mysqli_num_rows($pegacomunidade);

$dataserv = "";

if($totalRows_pegacomunidade <= 0){$dataserv .= "Não há serviços à comunidade esta semana!";}else{
foreach($pegacomunidade as $pegacom){
	if(date('Y-m-d',strtotime(($Y."-".$pegacom['mes_servico']."-".$pegacom['dia_servico']))) >= date('Y-m-d',strtotime($InicialDate)) && date('Y-m-d',strtotime(($Y."-".$pegacom['mes_servico']."-".$pegacom['dia_servico']))) <= date('Y-m-d',strtotime($FinalDate))){
	$dataserv .= $pegacom['dia_servico']."/".$pegacom['mes_servico']." - ".$pegacom['nome_servico']."<Br>";
}
}
if($dataserv  == ""){$dataserv  .= "Não há serviços à comunidade esta semana!<br>";}
}

//Serviços Profissionais
$sp = "SELECT * FROM rfa_servicos_profissionais WHERE clube='$clube' ORDER BY mes_prof ASC, dia_prof ASC";
$pegaprofissional= mysqli_query($link, $sp) or die(mysqli_error($link));
$row_pegaprofissional = mysqli_fetch_assoc($pegaprofissional);
$totalRows_pegaprofissional = mysqli_num_rows($pegaprofissional);

$dataprof = "";

if($totalRows_pegaprofissional <= 0){$dataprof .= "Não há serviços profissionais esta semana!";}else{
foreach($pegaprofissional as $pegaprof){
	if(date('Y-m-d',strtotime(($Y."-".$pegaprof['mes_prof']."-".$pegaprof['dia_prof']))) >= date('Y-m-d',strtotime($InicialDate)) && date('Y-m-d',strtotime(($Y."-".$pegaprof['mes_prof']."-".$pegaprof['dia_prof']))) <= date('Y-m-d',strtotime($FinalDate))){
	$dataprof .= $pegaprof['dia_prof']."/".$pegaprof['mes_prof']." - ".$pegaprof['nome_prof']."<Br>";
}
}
if($dataprof  == ""){$dataprof  .= "Não há serviços profissionais esta semana!<br>";}
}

//Datas importantes
$si = "SELECT * FROM rfa_datas_importantes WHERE clube='$clube' ORDER BY mes_data_imp ASC, dia_data_imp ASC";
$pegaimportante= mysqli_query($link, $si) or die(mysqli_error($link));
$row_pegaimportante = mysqli_fetch_assoc($pegaimportante);
$totalRows_pegaimportante = mysqli_num_rows($pegaimportante);

$dataimp = "";

if($totalRows_pegaimportante <= 0){$dataimp .= "Não há datas importantes esta semana!";}else{
foreach($pegaimportante as $pegaimp){
	if(date('Y-m-d',strtotime(($Y."-".$pegaimp['mes_data_imp']."-".$pegaimp['dia_data_imp']))) >= date('Y-m-d',strtotime($InicialDate)) && date('Y-m-d',strtotime(($Y."-".$pegaimp['mes_data_imp']."-".$pegaimp['dia_data_imp']))) <= date('Y-m-d',strtotime($FinalDate))){
	$dataimp .= $pegaimp['dia_data_imp']."/".$pegaimp['mes_data_imp']." - ".$pegaimp['nome_data_imp']."<Br>";
}
}
if($dataimp  == ""){$dataimp  .= "Não há datas importantes esta semana!<br>";}
}

//Aniversariantes Sócios
$sani = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY nome_socio ASC";
$pegaaniversario= mysqli_query($link, $sani) or die(mysqli_error($link));
$row_pegaaniversario = mysqli_fetch_assoc($pegaaniversario);
$totalRows_pegaaniversario = mysqli_num_rows($pegaaniversario);

$dataani = "";
if($totalRows_pegaaniversario <= 0){$dataani = "Não há sócios aniversariando esta semana!<br>";}else{
foreach($pegaaniversario as $pegaani){
	if((date('Y',strtotime($pegacas['data_nascto_socio'])) != $Y || date('Y',strtotime($pegacas['data_nascto_socio'])) == $Y) && ($AnoAtual."-".(date('m-d',strtotime($pegaani['data_nascto_socio'])))) >= ($AnoAtual."-".(date('m-d',strtotime($InicialDate)))) && ($AnoAtual."-".(date('m-d',strtotime($pegaani['data_nascto_socio'])))) <= ($AnoAtual."-".(date('m-d',strtotime($FinalDate))))){
	$dataani .= date('d/m',strtotime($pegaani['data_nascto_socio']))." - ".$pegaani['nome_socio']."<Br>";

	}
}
if($dataani == ""){$dataani .= "Não há sócios aniversariando esta semana!<br>";}
}


//Aniversariantes Cônjuges
$sanicon = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY conjuge ASC";
$pegaaniversariocon= mysqli_query($link, $sanicon) or die(mysqli_error($link));
$row_pegaaniversariocon = mysqli_fetch_assoc($pegaaniversariocon);
$totalRows_pegaaniversariocon = mysqli_num_rows($pegaaniversariocon);

$dataanicon = "";
if($totalRows_pegaaniversariocon <= 0){$dataanicon = "Não há cônjuges aniversariando esta semana!<br>";}else{
foreach($pegaaniversariocon as $pegaanicon){
	if((date('Y',strtotime($pegacas['data_nascto_conjuge'])) != $Y || date('Y',strtotime($pegacas['data_nascto_conjuge'])) == $Y) && ($AnoAtual."-".(date('m-d',strtotime($pegaanicon['data_nascto_conjuge'])))) >= ($AnoAtual."-".(date('m-d',strtotime($InicialDate)))) && ($AnoAtual."-".(date('m-d',strtotime($pegaanicon['data_nascto_conjuge'])))) <= ($AnoAtual."-".(date('m-d',strtotime($FinalDate))))){
	$dataanicon .= date('d/m',strtotime($pegaanicon['data_nascto_conjuge']))." - ".$pegaanicon['conjuge']." <strong>(Cônjuge de ".$pegaanicon['nome_socio'].")</strong><Br>";
	}

}
if($dataanicon == ""){$dataanicon .= "Não há cônjuges aniversariando esta semana!<br>";}
}

//Aniversariantes Filhos
$sanifilho = "SELECT * FROM rfa_socios_filhos INNER JOIN rfs_socios ON rfs_socios.ref_socio = rfa_socios_filhos.id_socio WHERE clube='$clube' ORDER BY nome_filho ASC";
$pegaaniversariofilho= mysqli_query($link, $sanifilho) or die(mysqli_error($link));
$row_pegaaniversariofilho = mysqli_fetch_assoc($pegaaniversariofilho);
$totalRows_pegaaniversariofilho = mysqli_num_rows($pegaaniversariofilho);

$dataanifilho = "";
if($totalRows_pegaaniversariofilho <= 0){$dataanifilho = "Não há filhos de sócios aniversariando esta semana!<br>";}else{
foreach($pegaaniversariofilho as $pegaanifilho){
	if((date('Y',strtotime($pegacas['data_nascto_filho'])) != $Y || date('Y',strtotime($pegacas['data_nascto_filho'])) == $Y) && ($AnoAtual."-".(date('m-d',strtotime($pegaanifilho['data_nascto_filho'])))) >= ($AnoAtual."-".(date('m-d',strtotime($InicialDate)))) && ($AnoAtual."-".(date('m-d',strtotime($pegaanifilho['data_nascto_filho'])))) <= ($AnoAtual."-".(date('m-d',strtotime($FinalDate))))){
	$dataanifilho .= date('d/m',strtotime($pegaanifilho['data_nascto_filho']))." - ".$pegaanifilho['nome_filho']." <strong>(Filho de ".$pegaanifilho['nome_socio'].")</strong><Br>";
	}

}
if($dataanifilho == ""){$dataanifilho .= "Não há filhos de sócios aniversariando esta semana!<br>";}
}


//Aniversário de Admissão
$sadmiss = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY nome_socio ASC";
$pegaadmiss= mysqli_query($link, $sadmiss) or die(mysqli_error($link));
$row_pegaadmiss = mysqli_fetch_assoc($pegaadmiss);
$totalRows_pegaadmiss = mysqli_num_rows($pegaadmiss);

$dataadmiss = "";
if($totalRows_pegaadmiss <= 0){$dataadmiss = "Não há aniversários de admissão nesta semana!<br>";}else{
foreach($pegaadmiss as $pegaadmi){
	if((date('Y',strtotime($pegacas['data_admissao'])) != $Y || date('Y',strtotime($pegacas['data_admissao'])) == $Y) && ($AnoAtual."-".(date('m-d',strtotime($pegaadmi['data_admissao'])))) >= ($AnoAtual."-".(date('m-d',strtotime($InicialDate)))) && ($AnoAtual."-".(date('m-d',strtotime($pegaadmi['data_admissao'])))) <= ($AnoAtual."-".(date('m-d',strtotime($FinalDate))))){
	$data1 = new DateTime( $DiaAtual );
	$data2 = new DateTime( $pegaadmi['data_admissao'] );

	$intervalo = $data1->diff( $data2 );
	if($intervalo->y == 0){
		$interval = "Novo membro!";
	}else{
		$interval = $intervalo->y." anos de sociedade";
	}

	$dataadmiss .= date('d/m',strtotime($pegaadmi['data_admissao']))." - ".$pegaadmi['nome_socio']." <strong>(".$interval.")</strong><Br>";
	}

}
if($dataadmiss == ""){$dataadmiss .= "Não há aniversários de admissão nesta semana!<br>";}
}


//Aniversário de Casamento
$scasam = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY data_casamento ASC";
$pegacasam= mysqli_query($link, $scasam) or die(mysqli_error($link));
$row_pegacasam = mysqli_fetch_assoc($pegacasam);
$totalRows_pegacasam = mysqli_num_rows($pegacasam);

$datacasam = "";
if($totalRows_pegacasam <= 0){$datacasam = "Não há aniversários de casamento nesta semana!<br>";}else{
foreach($pegacasam as $pegacas){
	if((date('Y',strtotime($pegacas['data_casamento'])) != $Y || date('Y',strtotime($pegacas['data_casamento'])) == $Y) && ($AnoAtual."-".(date('m-d',strtotime($pegacas['data_casamento'])))) >= ($AnoAtual."-".(date('m-d',strtotime($InicialDate)))) && ($AnoAtual."-".(date('m-d',strtotime($pegacas['data_casamento'])))) <= ($AnoAtual."-".(date('m-d',strtotime($FinalDate))))){
	$datacasam .= date('d/m',strtotime($pegacas['data_casamento']))." - ".$pegacas['nome_socio']." <strong>&</strong> ".$pegacas['conjuge']."<Br>";
	}


}
if($datacasam == ""){$datacasam .= "Não há aniversários de casamento nesta semana!<br>";}
}




//Novas admissões no clube
$snovaadm = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY nome_socio ASC";
$peganovaadm= mysqli_query($link, $snovaadm) or die(mysqli_error($link));
$row_peganovaadm = mysqli_fetch_assoc($peganovaadm);
$totalRows_peganovaadm = mysqli_num_rows($peganovaadm);

$datanovaadm = "";

if($totalRows_peganovaadm <= 0){$datanovaadm = "Não há novas admissões no clube nesta semana!";}else{
foreach($peganovaadm as $peganovaad){
	if((date('Y',strtotime($peganovaad['data_admissao'])) == $AnoAtual) && ($AnoAtual."-".(date('m-d',strtotime($peganovaad['data_admissao'])))) >= ($AnoAtual."-".(date('m-d',strtotime($InicialDate)))) && ($AnoAtual."-".(date('m-d',strtotime($peganovaad['data_admissao'])))) <= ($AnoAtual."-".(date('m-d',strtotime($FinalDate))))){
	$datanovaadm .= date('d/m',strtotime($peganovaad['data_admissao']))." - ".$peganovaad['nome_socio']."<Br>";
}
}
if($datanovaadm  == ""){$datanovaadm  .= "Não há novas admissões no clube nesta semana!<br>";}
}

 $html = "
 <fieldset>

 
<div style='width: 100%;min-height: 200px; border: 1px solid #000; text-align:center; padding: 20px;'>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
<h2>Recuperante do RC ".$row_pegaclube['nome_clube']."</h2>

<table>
	<tr>
		<td><strong>Ano Rotário:</strong> ".$row_pegapauta['ano_rotario']."</td>
		<td><strong>Data da reunião:</strong> ".date("d/m/Y", strtotime($row_pegareuniao['data_reuniao']))."</td>
	</tr>
	<tr>
		<td><strong>Reunião: </strong>".$row_pegareuniao['nome_reuniao']."</td>
		<td><strong>Hora de início: </strong>".date('H:i',strtotime($row_pegapauta['inicio_reuniao']))."</td>
	</tr>
	<tr>
		<td><strong>Presidente:</strong> ".$row_pegapresidente['nome']."</td>
		<td><strong>Local:</strong> ".$row_pegalocal['nome_local']."</td>
	</tr>
	
</table>

<table>
	<tr>
		<th style='width: 30%; text-align:left;'>Nome do Recuperante: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'></td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>E-mail do Recuperante: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'></td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>E-mail do Clube: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'></td>
	</tr>
	<tr>
		<td style='height: 30px'></td>
	</tr>
	<tr>
		<th style='text-align:center; font-weight: 0;' colspan='2'>Ao preencher este formulário o sistema <strong>Clube Digital</strong> enviará um comunicado para os e-mails preenchidos, comunicando a visita e a recuperação.<br>
		<strong style='font-size: 8px; margin-top: 15px'>VIA DO CLUBE</strong>
		</th>
	</tr>

</table>

<div style='text-align:center; margin: 10px auto 0 auto;'><img src='../images/clube-digital.jpg' width='200' ></div>

</div>

<div style='width: 100%;min-height: 200px; border: 1px solid #000; text-align:center; padding: 20px; margin-top: 25px'>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
<h2>Recuperante do RC ".$row_pegaclube['nome_clube']."</h2>

<table>
	<tr>
		<td><strong>Ano Rotário:</strong> ".$row_pegapauta['ano_rotario']."</td>
		<td><strong>Data da reunião:</strong> ".date("d/m/Y", strtotime($row_pegareuniao['data_reuniao']))."</td>
	</tr>
	<tr>
		<td><strong>Reunião: </strong>".$row_pegareuniao['nome_reuniao']."</td>
		<td><strong>Hora de início: </strong>".date('H:i',strtotime($row_pegapauta['inicio_reuniao']))."</td>
	</tr>
	<tr>
		<td><strong>Presidente:</strong> ".$row_pegapresidente['nome']."</td>
		<td><strong>Local:</strong> ".$row_pegalocal['nome_local']."</td>
	</tr>
	
</table>

<table>
	<tr>
		<th style='width: 30%; text-align:left;'>Nome do Recuperante: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'></td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>E-mail do Recuperante: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'></td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>E-mail do Clube: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'></td>
	</tr>
	<tr>
		<td style='height: 30px'></td>
	</tr>
	<tr>
		<th style='text-align:center; font-weight: 0;' colspan='2'>Ao preencher este formulário o sistema <strong>Clube Digital</strong> enviará um comunicado para os e-mails preenchidos, comunicando a visita e a recuperação.<br>
		<strong style='font-size: 8px; margin-top: 15px'>VIA DO RECUPERANTE</strong>
		</th>
	</tr>

</table>

<div style='text-align:center; margin: 10px auto 0 auto;'><img src='../images/clube-digital.jpg' width='200' ></div>

</div>


 </fieldset>
 
 ";

$mpdf = new \Mpdf\Mpdf();
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output();

 exit;