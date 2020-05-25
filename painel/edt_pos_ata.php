<?php
$page = 6;

include('config-header.php');
$idpauta = $_GET['cod_pauta'];

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

//Pega ATA
$sqata = "SELECT * FROM rfa_ata WHERE id_pauta='$idpauta' AND id_reuniao='$idreuniao' AND clube='$clube'";
$pegaata = mysqli_query($link, $sqata) or die(mysqli_error($link));
$row_pegaata = mysqli_fetch_assoc($pegaata);

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
    <title>Ata de Reunião - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->

	
	<style>
		.note {
	width:100%;
	box-sizing:border-box;

	display:block;
	max-width:100%;
	line-height:1.5;
	padding:15px 15px 30px;
	border-radius:3px;
	border:1px solid #F7E98D;
	font:13px Tahoma, cursive;
	transition:box-shadow 0.5s ease;
	box-shadow:0 4px 6px rgba(0,0,0,0.1);
	font-smoothing:subpixel-antialiased;
	background:linear-gradient(#F9EFAF, #F7E98D);
	background:-o-linear-gradient(#F9EFAF, #F7E98D);
	background:-ms-linear-gradient(#F9EFAF, #F7E98D);
	background:-moz-linear-gradient(#F9EFAF, #F7E98D);
	background:-webkit-linear-gradient(#F9EFAF, #F7E98D);
	text-align:left;
}

	</style>

	<script type="text/javascript">
			function fMasc(objeto,mascara) {
				obj=objeto
				masc=mascara
				setTimeout("fMascEx()",1)
			}
			function fMascEx() {
				obj.value=masc(obj.value)
			}
			function mTel(tel) {
				tel=tel.replace(/\D/g,"")
				tel=tel.replace(/^(\d)/,"($1")
				tel=tel.replace(/(.{3})(\d)/,"$1)$2")
				if(tel.length == 9) {
					tel=tel.replace(/(.{1})$/,"-$1")
				} else if (tel.length == 10) {
					tel=tel.replace(/(.{2})$/,"-$1")
				} else if (tel.length == 11) {
					tel=tel.replace(/(.{3})$/,"-$1")
				} else if (tel.length == 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				} else if (tel.length > 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				}
				return tel;
			}
			function mCNPJ(cnpj){
				cnpj=cnpj.replace(/\D/g,"")
				cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
				cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
				cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
				cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
				return cnpj
			}
			function mCPF(cpf){
				cpf=cpf.replace(/\D/g,"")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
				return cpf
			}
			function mCEP(cep){
				cep=cep.replace(/\D/g,"")
				cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
				cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
				return cep
			}
			function mNum(num){
				num=num.replace(/\D/g,"")
				return num
			}
			
			
			
			
		</script>
	
<!--Mask Money-->
<script language="javascript">   
function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
}
 </script>
 
 <script type="text/javascript">
    function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
        img.src = 'http://granjasaojorge.com.br/img/loading1.gif';
        div.innerHTML = "";
        div.style.cssText = 'position: fixed; top: 20%; left: 40%; z-index: 5000; width: 200px; text-align: center;';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
        // These 2 lines cancel form submission, so only use if needed.
        //window.event.cancelBubble = true;
        //e.stopPropagation();
    }
</script>



<script>
function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        // charCode 8 = backspace   
        // charCode 9 = tab
        if (charCode != 8 && charCode != 9) {
            // charCode 48 equivale a 0   
            // charCode 57 equivale a 9
            if (charCode < 48 || charCode > 57) {
                return false;
            }
        }
    }
</script>
	
<script>
function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
}
</script>

<script LANGUAGE="JavaScript">
<!--

    function valida_horas(edit){

      if(event.keyCode<48 || event.keyCode>57){

        event.returnValue=false;

      }

      if(edit.value.length==2 || edit.value.length==5){

        edit.value+=":";}

}

//-->

</SCRIPT>

<script src="moment/moment.js"></script>

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
			<form method="post" action="proc_edt_ata.php" id="formsocios" name="form-socios" runat="server"  onsubmit="ShowLoading(); ">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Ata Pós-Reunião</strong>
                                        
                                    </div>
                                    <div class="card-body card-block">
                                        
										<input type="hidden" name="idpauta" value="<?php echo $idpauta; ?>">
										<input type="hidden" name="idreuniao" value="<?php echo $idreuniao; ?>">
										<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
										
                                     
 <fieldset>


<div class='row'>
	<div class='col-12 col-md-6'><strong>Ano Rotário:</strong><?php echo $row_pegapauta['ano_rotario']; ?></div>
	<div class='col-12 col-md-6'><strong>Data da reunião:</strong><?php echo date("d/m/Y", strtotime($row_pegareuniao['data_reuniao'])); ?></div>
</div>

<div class='row'>
	<div class='col-12 col-md-6'><strong>Reunião: </strong><?php echo $row_pegareuniao['nome_reuniao']; ?></div>
	<div class='col-12 col-md-6'><strong>Hora de início: </strong><?php echo $row_pegapauta['inicio_reuniao']; ?></div>
</div>

<div class='row'>
	<div class='col-12 col-md-6'><strong>Presidente:</strong> <?php echo $row_pegapauta['pres_reuniao']; ?></div>
	<div class='col-12 col-md-6'><strong>Local:</strong> <?php echo $row_pegalocal['nome_local']; ?></div>
</div>

<div class='row'>
	<div class='col-12 col-md-6'><strong>Secretário:</strong> <?php echo $row_pegapauta['sec_reuniao']; ?></div>
	<div class='col-12 col-md-6'><strong>Abertura por:</strong> <?php echo $row_pegapauta['nome_abertura']; ?></div>
</div>

<div class='row'>
	<div class='col-12 col-md-6'><strong>Protocolo:</strong> <?php echo $row_pegapauta['user_protocolo']; ?></div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Protocolo / Composição da Mesa Diretora</h2></div>
</div>
<div class='row'>
	<div class='col'>
		<ul style='margin-left: 15px'><?php echo $nomemesa; ?></ul>
	</div>
</div>
<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id="adicional-mesa" name='adicional-mesa' placeholder='Digite nomes adicionais de pessoas que também fizeram parte da composição da mesa.'><?php echo $row_pegaata['adicional_mesa'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Convidados/Recuperantes</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='convi-recup' name='convi-recup' placeholder='Digite as informações anotadas sobre a seção de convidados e recuperantes.'><?php echo $row_pegaata['convi_recup'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Tempo da Secretaria</h2></div>
</div>


<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='secretaria' name='secretaria' placeholder='Digite as informações anotadas sobre a seção Secretaria.'><?php echo $row_pegaata['secretaria'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Comissão de Administração</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='com-admin' name='com-admin' placeholder='Digite as informações anotadas sobre a seção Comissão de Administração.'><?php echo $row_pegaata['com_admin'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Subcomissão de Companheirismo</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='sub-comp' name='sub-comp' placeholder='Digite as informações anotadas sobre a seção Subcomissão de Companheirismo.'><?php echo $row_pegaata['sub_comp'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Comissão de Projetos</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='com-proj' name='com-proj' placeholder='Digite as informações anotadas sobre a seção Comissão de Projetos.'><?php echo $row_pegaata['com_proj'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Comissão da Fundação Rotária</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='com-fund-rot' name='com-fund-rot' placeholder='Digite as informações anotadas sobre a seção Comissão da Fundação Rotária.'><?php echo $row_pegaata['com_fund_rot'];?></textarea>
	</div>
</div>


<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Comissão de Relações Públicas</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='com-rel-publi' name='com-rel-publi' placeholder='Digite as informações anotadas sobre a seção Comissão de Relações Públicas.'><?php echo $row_pegaata['com_rel_publi'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Pequenas Comunicações</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='peq-com' name='peq-com' placeholder='Digite as informações anotadas sobre a seção Pequenas Comunicações.'><?php echo $row_pegaata['peq_com'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Apresentação do Palestrante</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='apres-pales' name='apres-pales' placeholder='Digite as informações anotadas sobre a seção Apresentação do Palestrante.'><?php echo $row_pegaata['apres_pales'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Tema</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<input type='text' class='form-control note' id='tema' name='tema' placeholder='Digite o tema da palestra.' value="<?php echo $row_pegaata['tema'];?>">
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Tempo do(a) Presidente</h2></div>
</div>

<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='presid' name='presid' placeholder='Digite as informações anotadas sobre a seção Tempo de Presidente.'><?php echo $row_pegaata['presid'];?></textarea>
	</div>
</div>

<div class='row' style='margin: 20px 0 20px 0'>
	<div class='col'><h2>Encerramento</h2></div>
</div>


<div class='row' style='margin-top: 15px'>
	<div class='col'>
		<textarea class='form-control note' id='encerramento' name='encerramento' placeholder='Digite as informações anotadas sobre a seção Encerramento.'><?php echo $row_pegaata['encerramento'];?></textarea>
	</div>
</div>


 </fieldset>
 
										
										<div id="btn1" class="no-print" style="margin-top: 20px">
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> ATUALIZAR</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
                                        
                                    </div>
                                </div>
								
                            </div>
							</form>
							
							
							
							
</div>
            

            <?php include("footer.php"); ?>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	
  
<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
	<script>
	autosize(document.getElementById("adicional-mesa"));
	autosize(document.getElementById("convi-recup"));
	autosize(document.getElementById("secretaria"));
	autosize(document.getElementById("com-admin"));
	autosize(document.getElementById("sub-comp"));
	autosize(document.getElementById("com-proj"));
	autosize(document.getElementById("com-fund-rot"));
	autosize(document.getElementById("com-rel-publi"));
	autosize(document.getElementById("peq-com"));
	autosize(document.getElementById("apres-pales"));
	autosize(document.getElementById("tema"));
	autosize(document.getElementById("presid"));
	autosize(document.getElementById("encerramento"));
	</script>
	
	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->