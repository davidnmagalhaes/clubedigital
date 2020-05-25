<?php
session_start();

if(!isset($_SESSION['logado']) || $_SESSION['funcao'] != 1 && $_SESSION['funcao'] != 3):
	header("Location: index.php");
endif;

$user = $_SESSION['id_usuario'];
$clube = $_GET['clube'];
$iddataimp = $_GET['id_data_imp'];

//Conexão com banco de dados
include_once("config.php");

$s = "SELECT * FROM rfa_datas_importantes WHERE id_data_imp='$iddataimp' AND clube='$clube'";
$servico = mysqli_query($link, $s) or die(mysqli_error($link));
$row_servico = mysqli_fetch_assoc($servico);

$sql = "SELECT * FROM rfa_reuniao WHERE clube='$clube'";
$reuniao = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_reuniao = mysqli_fetch_assoc($reuniao);
$totalRows_reuniao = mysqli_num_rows($reuniao);

$sq = "SELECT * FROM rfa_local_reuniao WHERE clube='$clube'";
$local = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_local = mysqli_fetch_assoc($local);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestão do Rotary Fortaleza Alagadiço">
    <meta name="author" content="David Magalhães">
    <meta name="keywords" content="rotary alagadiço, rotary fortaleza alagadiço, fortaleza alagadiço">

    <!-- Title Page-->
    <title>Atualizar Serviços Profissionais - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->
	
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
			<form method="post" action="proc_edt_datas_importantes.php" id="formsocios" name="form-socios" runat="server"  onsubmit="ShowLoading(); ">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Atualização</strong>
                                        <small> de Serviços Profissionais</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="classif_socio" class=" form-control-label">Dia</label>
												<select name="dia_importante" id="dia_importante" class="form-control" required>
													<option>Selecione o dia...</option>
													<?php 
													for($i=1; $i < 32; $i++){
														echo "<option value='".$i."'>".$i."</option>";
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="nome_socio" class=" form-control-label">Mês</label>
												<select name="mes_importante" id="mes_importante" class="form-control" required>
													<option>Selecione o mês...</option>
													<?php 
													setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
													date_default_timezone_set('America/Sao_Paulo');
													for($i=1; $i < 13; $i++){
														$nomemes = date("Y")."-".$i."-"."01";
														echo "<option value='".$i."'>".strtoupper(strftime('%b',strtotime($nomemes)))."</option>";
													}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">Nome da Data Importante</label>
												<input type="text" name="nome_servico" id="nome_servico" class="form-control" value="<?php echo $row_servico['nome_data_imp'];?>">
											</div>
										</div>
										
										
										
										
										</div>
										
                                        
                                    </div>
                                </div>
								
								
									<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
									<input type="hidden" name="club" value="<?php echo $clube; ?>">
									<input type="hidden" name="idservico" value="<?php echo $iddataimp; ?>">
								
								<div>
                                                <button id="payment-button" type="submit" onClick="return faz()" class="btn btn-lg btn-success btn-block vld">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Atualizar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
								
                            </div>
							</form>
							
							
							
							
</div>
            

            <?php include("footer.php"); ?>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	

<script>
	function alteraHora(){
	//Pega campos do formulário
	var horainicio = document.getElementById("hora_inicio");
	var tempoprotocolo = document.getElementById("tempo_protocolo");
	var finalprotocolo = document.getElementById("final_protocolo");
	
	var iniciosecretaria = document.getElementById("inicio_secretaria");
	var temposecretaria = document.getElementById("tempo_secretaria");
	var finalsecretaria = document.getElementById("final_secretaria");
	
	var iniciotesouraria = document.getElementById("inicio_tesouraria");
	var tempotesouraria = document.getElementById("tempo_tesouraria");
	var finaltesouraria = document.getElementById("final_tesouraria");
	
	var iniciocompanheirismo = document.getElementById("inicio_companheirismo");
	var tempocompanheirismo = document.getElementById("tempo_companheirismo");
	var finalcompanheirismo = document.getElementById("final_companheirismo");
	
	var iniciocomadm = document.getElementById("inicio_comadm");
	var tempocomadm = document.getElementById("tempo_comadm");
	var finalcomadm = document.getElementById("final_comadm");
	
	var iniciocomproj = document.getElementById("inicio_comproj");
	var tempocomproj = document.getElementById("tempo_comproj");
	var finalcomproj = document.getElementById("final_comproj");
	
	var iniciocomfundrot = document.getElementById("inicio_comfundrot");
	var tempocomfundrot = document.getElementById("tempo_comfundrot");
	var finalcomfundrot = document.getElementById("final_comfundrot");
	
	var inicioinforot = document.getElementById("inicio_inforot");
	var tempoinforot = document.getElementById("tempo_inforot");
	var finalinforot = document.getElementById("final_inforot");
	
	var iniciopres = document.getElementById("inicio_pres");
	var tempopres = document.getElementById("tempo_pres");
	var finalpres = document.getElementById("final_pres");
	
	var iniciopeqcom = document.getElementById("inicio_peqcom");
	var tempopeqcom = document.getElementById("tempo_peqcom");
	var finalpeqcom = document.getElementById("final_peqcom");
	
	var iniciosubfreq = document.getElementById("inicio_subfreq");
	var temposubfreq = document.getElementById("tempo_subfreq");
	var finalsubfreq = document.getElementById("final_subfreq");
	
	var iniciosubfreq = document.getElementById("inicio_subfreq");
	var temposubfreq = document.getElementById("tempo_subfreq");
	var finalsubfreq = document.getElementById("final_subfreq");
	
	var encerra = document.getElementById("final_encerra");
	
	//Calcula hora do PROTOCOLO
	var horaini = horainicio.value;
	var resultado = moment.utc(horaini, 'HH:mm').add(tempoprotocolo.value, 'minutes').format('HH:mm');
	if(horainicio.value == "" || tempoprotocolo.value == ""){
    finalprotocolo.value = 0;
	}else{
	finalprotocolo.value = resultado;
	iniciosecretaria.value = resultado;
	}
	
	//Calcula hora da SECRETARIA
	var horasecretaria = resultado;
	var resulsecretaria = moment.utc(horasecretaria, 'HH:mm').add(temposecretaria.value, 'minutes').format('HH:mm');
	if(iniciosecretaria.value == "" || horainicio.value == "" || temposecretaria.value == ""){
    finalsecretaria.value = 0;
	}else{
	finalsecretaria.value = resulsecretaria;
	iniciotesouraria.value = resulsecretaria;
	}
	
	//Calcula hora da TESOURARIA
	var horatesouraria = resulsecretaria;
	var resultesouraria = moment.utc(horatesouraria, 'HH:mm').add(tempotesouraria.value, 'minutes').format('HH:mm');
	if(iniciotesouraria.value == "" || horainicio.value == "" || tempotesouraria.value == ""){
    finaltesouraria.value = 0;
	}else{
	finaltesouraria.value = resultesouraria;
	iniciocompanheirismo.value = resultesouraria;
	}
	
	//Calcula hora da SUBCOMISSÃO DE COMPANHEIRISMO
	var horacompanheirismo = resultesouraria;
	var resulcompanheirismo = moment.utc(horacompanheirismo, 'HH:mm').add(tempocompanheirismo.value, 'minutes').format('HH:mm');
	if(iniciocompanheirismo.value == "" || horainicio.value == "" || tempocompanheirismo.value == ""){
    finalcompanheirismo.value = 0;
	}else{
	finalcompanheirismo.value = resulcompanheirismo;
	iniciocomadm.value = resulcompanheirismo;
	}
	
	//Calcula hora da COMISSÃO ADMINISTRAÇÃO
	var horacomadm = resulcompanheirismo;
	var resulcomadm = moment.utc(horacomadm, 'HH:mm').add(tempocomadm.value, 'minutes').format('HH:mm');
	if(iniciocomadm.value == "" || horainicio.value == "" || tempocomadm.value == ""){
    finalcomadm.value = 0;
	}else{
	finalcomadm.value = resulcomadm;
	iniciocomproj.value = resulcomadm;
	}
	
	//Calcula hora da COMISSÃO PROJETOS
	var horacomproj = resulcomadm;
	var resulcomproj = moment.utc(horacomproj, 'HH:mm').add(tempocomproj.value, 'minutes').format('HH:mm');
	if(iniciocomproj.value == "" || horainicio.value == "" || tempocomproj.value == ""){
    finalcomproj.value = 0;
	}else{
	finalcomproj.value = resulcomproj;
	iniciocomfundrot.value = resulcomproj;
	}
	
	//Calcula hora da COMISSÃO FUNDAÇÃO ROTÁRIA
	var horacomfundrot = resulcomproj;
	var resulcomfundrot = moment.utc(horacomfundrot, 'HH:mm').add(tempocomfundrot.value, 'minutes').format('HH:mm');
	if(iniciocomfundrot.value == "" || horainicio.value == "" || tempocomfundrot.value == ""){
    finalcomfundrot.value = 0;
	}else{
	finalcomfundrot.value = resulcomfundrot;
	inicioinforot.value = resulcomfundrot;
	}
	
	//Calcula hora da INFORMAÇÃO ROTÁRIA
	var horainforot = resulcomfundrot;
	var resulinforot = moment.utc(horainforot, 'HH:mm').add(tempoinforot.value, 'minutes').format('HH:mm');
	if(inicioinforot.value == "" || horainicio.value == "" || tempoinforot.value == ""){
    finalinforot.value = 0;
	}else{
	finalinforot.value = resulinforot;
	iniciopres.value = resulinforot;
	}
	
	//Calcula hora da PRESIDÊNCIA
	var horapres = resulinforot;
	var resulpres = moment.utc(horapres, 'HH:mm').add(tempopres.value, 'minutes').format('HH:mm');
	if(iniciopres.value == "" || horainicio.value == "" || tempopres.value == ""){
    finalpres.value = 0;
	}else{
	finalpres.value = resulpres;
	iniciopeqcom.value = resulpres;
	}
	
	//Calcula hora da PEQUENAS COMUNICAÇÕES
	var horapeqcom = resulpres;
	var resulpeqcom = moment.utc(horapeqcom, 'HH:mm').add(tempopeqcom.value, 'minutes').format('HH:mm');
	if(iniciopeqcom.value == "" || horainicio.value == "" || tempopeqcom.value == ""){
    finalpeqcom.value = 0;
	}else{
	finalpeqcom.value = resulpeqcom;
	iniciosubfreq.value = resulpeqcom;
	}
	
	//Calcula hora da SUBCOMISSÃO DE FREQUÊNCIA
	var horasubfreq = resulpeqcom;
	var resulsubfreq = moment.utc(horasubfreq, 'HH:mm').add(temposubfreq.value, 'minutes').format('HH:mm');
	if(iniciosubfreq.value == "" || horainicio.value == "" || temposubfreq.value == ""){
    finalsubfreq.value = 0;
	}else{
	finalsubfreq.value = resulsubfreq;
	encerra.value = resulsubfreq;
	}

	}
</script>

	
	<!--Script para busca de endereços por CEP-->
	<script type="text/javascript">
		
		$("#cep_local").focusout(function(){
			$.ajax({
				url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
				dataType: 'json',
				success: function(resposta){
					$("#logradouro_local").val(resposta.logradouro);
					$("#complemento_socio").val(resposta.complemento);
					$("#bairro_local").val(resposta.bairro);
					$("#cidade_local").val(resposta.localidade);
					$("#uf_local").val(resposta.uf);
					$("#numero_local").focus();
					document.getElementById("endereco").style.display = "block";
				}
			});
		});
	</script>
	
<script>

  

$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<div class="row form-group" id="row'+i+'"><div class="col-12 col-md-6"><div class="form-group"><label for="nome_filho" class=" form-control-label">Nome</label><input type="text" name="nome_mesa[]" id="nome_mesa" class="form-control" placeholder="Digite o nome da pessoa que irá compor a mesa"></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="data_nascto_filho" class=" form-control-label">Cargo</label><select name="cargo_mesa[]" class="form-control"><option>Presidente</option><option>Governador</option><option>Governador Assistente</option><option>1º Secretário</option><option>2º Secretário</option><option>1ª Dama</option><option>Visitante</option><option>Secretário Geral</option><option>Diretor</option><option>Coordenador da Fund. Rotária</option><option>Coordenador de Rotary</option><option>Curador da Fund. Rotária</option><option>Palestrante</option><option>Sócio Aniversariante</option></select></div></div><div class="col-12 col-md-2" ><div class="form-group"><br><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button> REMOVER</div></div></div>');
	
	});

	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	
	
});
</script>
	
	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->