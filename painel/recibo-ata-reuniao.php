<?php 
include("mpdf60/mpdf.php");
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
$Week = date('w'); /* Semana atual... */
//$FirstDay = date('d', strtotime('-'.$Week.' days'));
//$LastDay = date('d', strtotime('+'.(6-$Week).' days'));
$FirstDay = date('d',strtotime($row_pegapauta['niver_inicial']));
$LastDay = date('d',strtotime($row_pegapauta['niver_final']));
$Month = date('m');
$DiaAtual = date('Y-m-d');
$AnoAtual = date('Y');

//Serviços à comunidade
$sc = "SELECT * FROM rfa_servicos_comunidade WHERE (dia_servico BETWEEN '$FirstDay' AND '$LastDay') AND mes_servico='$Month' AND clube='$clube' ORDER BY dia_servico ASC";
$pegacomunidade= mysqli_query($link, $sc) or die(mysqli_error($link));
$row_pegacomunidade = mysqli_fetch_assoc($pegacomunidade);
$totalRows_pegacomunidade = mysqli_num_rows($pegacomunidade);

$dataserv = "";
if($totalRows_pegacomunidade <= 0){$dataserv = "Não há serviços à comunidade esta semana!";}else{
foreach($pegacomunidade as $pegacom){
	$dataserv .= $pegacom['dia_servico']." - ".$pegacom['nome_servico']."<Br>";
}
}

//Serviços Profissionais
$sp = "SELECT * FROM rfa_servicos_profissionais WHERE (dia_prof BETWEEN '$FirstDay' AND '$LastDay') AND mes_prof='$Month' AND clube='$clube' ORDER BY dia_prof ASC";
$pegaprofissional= mysqli_query($link, $sp) or die(mysqli_error($link));
$row_pegaprofissional = mysqli_fetch_assoc($pegaprofissional);
$totalRows_pegaprofissional = mysqli_num_rows($pegaprofissional);

$dataprof = "";
if($totalRows_pegaprofissional <= 0){$dataprof = "Não há serviços profissionais esta semana!";}else{
foreach($pegaprofissional as $pegaprof){
	$dataprof .= $pegaprof['dia_prof']." - ".$pegaprof['nome_prof']."<Br>";
}
}

//Datas Importantes
$si = "SELECT * FROM rfa_datas_importantes WHERE (dia_data_imp BETWEEN '$FirstDay' AND '$LastDay') AND mes_data_imp='$Month' AND clube='$clube' ORDER BY dia_data_imp ASC";
$pegaimportante= mysqli_query($link, $si) or die(mysqli_error($link));
$row_pegaimportante = mysqli_fetch_assoc($pegaimportante);
$totalRows_pegaimportante = mysqli_num_rows($pegaimportante);

$dataimp = "";
if($totalRows_pegaimportante <= 0){$dataimp = "Não há datas importantes esta semana!";}else{
foreach($pegaimportante as $pegaimp){
	$dataimp .= $pegaimp['dia_data_imp']." - ".$pegaimp['nome_data_imp']."<Br>";
}
}

//Aniversariantes Sócios
$sani = "SELECT * FROM rfs_socios WHERE (DAY(data_nascto_socio) BETWEEN '$FirstDay' AND '$LastDay') AND MONTH(data_nascto_socio)='$Month' AND clube='$clube' ORDER BY nome_socio ASC";
$pegaaniversario= mysqli_query($link, $sani) or die(mysqli_error($link));
$row_pegaaniversario = mysqli_fetch_assoc($pegaaniversario);
$totalRows_pegaaniversario = mysqli_num_rows($pegaaniversario);

$dataani = "";
if($totalRows_pegaaniversario <= 0){$dataani = "Não há sócios aniversariando esta semana!";}else{
foreach($pegaaniversario as $pegaani){
	$dataani .= date('d/m',strtotime($pegaani['data_nascto_socio']))." - ".$pegaani['nome_socio']."<Br>";
}
}

//Aniversariantes Cônjuges
$sanicon = "SELECT * FROM rfs_socios WHERE (DAY(data_nascto_conjuge) BETWEEN '$FirstDay' AND '$LastDay') AND MONTH(data_nascto_conjuge)='$Month' AND clube='$clube' ORDER BY conjuge ASC";
$pegaaniversariocon= mysqli_query($link, $sanicon) or die(mysqli_error($link));
$row_pegaaniversariocon = mysqli_fetch_assoc($pegaaniversariocon);
$totalRows_pegaaniversariocon = mysqli_num_rows($pegaaniversariocon);

$dataanicon = "";
if($totalRows_pegaaniversariocon <= 0){$dataanicon = "Não há cônjuges aniversariando esta semana!";}else{
foreach($pegaaniversariocon as $pegaanicon){
	$dataanicon .= date('d/m',strtotime($pegaanicon['data_nascto_conjuge']))." - ".$pegaanicon['conjuge']." <strong>(Cônjuge de ".$pegaanicon['nome_socio'].")</strong><Br>";
}
}

//Aniversariantes Filhos
$sanifilho = "SELECT * FROM rfa_socios_filhos INNER JOIN rfs_socios ON rfs_socios.ref_socio = rfa_socios_filhos.id_socio WHERE (DAY(data_nascto_filho) BETWEEN '$FirstDay' AND '$LastDay') AND MONTH(data_nascto_filho)='$Month' GROUP BY nome_filho ORDER BY nome_filho ASC";
$pegaaniversariofilho= mysqli_query($link, $sanifilho) or die(mysqli_error($link));
$row_pegaaniversariofilho = mysqli_fetch_assoc($pegaaniversariofilho);
$totalRows_pegaaniversariofilho = mysqli_num_rows($pegaaniversariofilho);

$dataanifilho = "";
if($totalRows_pegaaniversariofilho <= 0){$dataanifilho = "Não há filhos de sócios aniversariando esta semana!";}else{
foreach($pegaaniversariofilho as $pegaanifilho){
	$dataanifilho .= date('d/m',strtotime($pegaanifilho['data_nascto_filho']))." - ".$pegaanifilho['nome_filho']." <strong>(Filho de ".$pegaanifilho['nome_socio'].")</strong><Br>";
}
}

//Aniversário de Admissão
$sadmiss = "SELECT * FROM rfs_socios WHERE (DAY(data_admissao) BETWEEN '$FirstDay' AND '$LastDay') AND MONTH(data_admissao)='$Month' AND clube='$clube' ORDER BY nome_socio ASC";
$pegaadmiss= mysqli_query($link, $sadmiss) or die(mysqli_error($link));
$row_pegaadmiss = mysqli_fetch_assoc($pegaadmiss);
$totalRows_pegaadmiss = mysqli_num_rows($pegaadmiss);

$dataadmiss = "";

if($totalRows_pegaadmiss <= 0){$dataadmiss = "Não há aniversários de admissão nesta semana!";}else{
foreach($pegaadmiss as $pegaadmi){
	$data1 = new DateTime( $DiaAtual );
	$data2 = new DateTime( $pegaadmi['data_admissao'] );

	$intervalo = $data1->diff( $data2 );

	$dataadmiss .= date('d/m',strtotime($pegaadmi['data_admissao']))." - ".$pegaadmi['nome_socio']." <strong>(".$intervalo->y." anos de sociedade)</strong><Br>";
}
}

//Aniversário de Casamento
$scasam = "SELECT * FROM rfs_socios WHERE (DAY(data_casamento) BETWEEN '$FirstDay' AND '$LastDay') AND MONTH(data_casamento)='$Month' AND clube='$clube' ORDER BY nome_socio ASC";
$pegacasam= mysqli_query($link, $scasam) or die(mysqli_error($link));
$row_pegacasam = mysqli_fetch_assoc($pegacasam);
$totalRows_pegacasam = mysqli_num_rows($pegacasam);

$datacasam = "";

if($totalRows_pegacasam <= 0){$datacasam = "Não há aniversários de casamento nesta semana!";}else{
foreach($pegacasam as $pegacas){
	$data1 = new DateTime( $DiaAtual );
	$data2 = new DateTime( $pegacas['data_casamento'] );

	$intervalo = $data1->diff( $data2 );

	$datacasam .= date('d/m',strtotime($pegacas['data_casamento']))." - ".$pegacas['nome_socio']." <strong>&</strong> ".$pegacas['conjuge']."<Br>";
}
}

//Novas admissões no clube
$snovaadm = "SELECT * FROM rfs_socios WHERE (DAY(data_admissao) BETWEEN '$FirstDay' AND '$LastDay') AND MONTH(data_admissao)='$Month' AND YEAR(data_admissao)='$AnoAtual' AND clube='$clube' ORDER BY nome_socio ASC";
$peganovaadm= mysqli_query($link, $snovaadm) or die(mysqli_error($link));
$row_peganovaadm = mysqli_fetch_assoc($peganovaadm);
$totalRows_peganovaadm = mysqli_num_rows($peganovaadm);

$datanovaadm = "";

if($totalRows_peganovaadm <= 0){$datanovaadm = "Não há novas admissões no clube nesta semana!";}else{
foreach($peganovaadm as $peganovaad){

	$datanovaadm .= date('d/m',strtotime($peganovaad['data_admissao']))." - ".$peganovaad['nome_socio']." <strong><Br>";
}
}


 $html = "
 <fieldset>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
 <h1>Ata de Reunião do RC ".$row_pegaclube['nome_clube']."</h1>
 
 
<table>
	<tr>
		<td><strong>Ano Rotário:</strong> ".$row_pegapauta['ano_rotario']."</td>
		<td><strong>Data da reunião:</strong> ".date("d/m/Y", strtotime($row_pegareuniao['data_reuniao']))."</td>
	</tr>
	<tr>
		<td><strong>Reunião: </strong>".$row_pegareuniao['nome_reuniao']."</td>
		<td><strong>Hora de início: </strong>".$row_pegapauta['inicio_reuniao']."</td>
	</tr>
	<tr>
		<td><strong>Presidente:</strong> ".$row_pegapauta['pres_reuniao']."</td>
		<td><strong>Local:</strong> ".$row_pegalocal['nome_local']."</td>
	</tr>
	<tr>
		<td><strong>Secretário:</strong> ".$row_pegapauta['sec_reuniao']."</td>
		<td><strong>Abertura por:</strong> ".$row_pegapauta['nome_abertura']."</td>
	</tr>
	<tr>
		<td><strong>Protocolo:</strong> ".$row_pegapauta['user_protocolo']."</td>
		<td></td>
	</tr>
</table>

<h2>Protocolo / Composição da Mesa Diretora</h2>

<table>
	<tr>
		<td>
			<ul>".$nomemesa."</ul>
		</td>
	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
</table>

<h2>Convidados/Recuperantes</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>


</table>

<h2>Tempo da Secretaria</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>

</table>

<h2>Comissão de Administração</h2>

<table>
	
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	
</table>

<h2>Subcomissão de Companheirismo</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	
	
</table>

<h2>Comissão de Projetos</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	
	
</table>

<h2>Comissão da Fundação Rotária</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	
	
</table>

<h2>Comissão de Relações Públicas</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	
	
</table>

<h2>Pequenas Comunicações</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>

	
	
	
</table>

<h2>Apresentação do Palestrante</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	
	
</table>

<h2>Tema</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	
</table>

<h2>Tempo do(a) Presidente</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	
	
	
</table>

<h2>Encerramento</h2>

<table>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>
		
	</tr>
	
	
	
</table>

<br><br>

<table>
	<tr>
		<td>".$row_pegasecretario['nome']."</td>
	</tr>
	<tr>
		<td class='line'>
			&nbsp;
		</td>

	</tr>
	
	
</table>


<div style='text-align:center; margin: 50px auto;'><img src='../images/clube-digital.jpg' width='200' ></div>


 </fieldset>
 
 ";

 $mpdf=new mPDF(); 
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output();

 exit;