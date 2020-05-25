<?php
$page = 6;

include('config-header.php');

$sql = "SELECT * FROM rfa_reuniao WHERE clube='$clube'";
$reuniao = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_reuniao = mysqli_fetch_assoc($reuniao);
$totalRows_reuniao = mysqli_num_rows($reuniao);

$sq = "SELECT * FROM rfa_local_reuniao WHERE clube='$clube'";
$local = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_local = mysqli_fetch_assoc($local);

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
    <title>Cadastro de Pautas - Rotary Fortaleza Alagadiço</title>

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
			<form method="post" action="proc_cd_pauta.php" id="formsocios" name="form-socios" runat="server"  onsubmit="ShowLoading(); ">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Cadastro</strong>
                                        <small> de Pauta</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
										<div class="row">
										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="classif_socio" class=" form-control-label">Reunião</label>
												<select name="id_reuniao" id="id_reuniao" class="form-control" required>
													<?php do{ ?>
													<option value="<?php echo $row_reuniao['id_reuniao'];?>"><?php echo $row_reuniao['nome_reuniao'];?></option>
													<?php }while($row_reuniao = mysqli_fetch_assoc($reuniao)); ?>
												</select>
											</div>
										</div>
										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="nome_socio" class=" form-control-label">Tipo de reunião</label>
												<select name="tipo_reuniao" class="form-control">
													<option value="ord">Ordinária</option>
													<option value="exord">Extraordinária</option>
												</select>
											</div>
										</div>
										
										<div class="col-12 col-md-3">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">Ano Rotário</label>
												<select name="ano_rotario" class="form-control">
													<?php 
													$anoatual = date("Y")-1;
													$anofinal = $anoatual + 3;
													for($i=$anoatual; $i < $anofinal; $i++){
														$o = $i + 1;
														echo "<option value='".$i." - ".$o."'>".$i." - ".$o."</option>";
													}
													?>
												</select>
											</div>
										</div>
										
										
										
										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="nome_socio" class=" form-control-label">Local</label>
												<select name="local_reuniao" id="local_reuniao" class="form-control" onchange="showDiv('novolocal', this)">
													<?php do{ ?>
														<option value="<?php echo $row_local['id_local'];?>"><?php echo $row_local['nome_local'];?></option>
													<?php }while($row_local = mysqli_fetch_assoc($local));?>
													<option value="1">Outro local...</option>
												</select>
											</div>
										</div>
										
										</div>
										
                                        <div id="novolocal" style="display:none;">
										<div class="row"  >
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">Nome do local</label>
												<input type="text" class="form-control" name="nome_local">
											</div>
										</div>
										
										<div class="col-12 col-md-1">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">CEP</label>
												<input type="text" class="form-control" maxlength="8" onkeypress="return somenteNumeros(event)" name="cep_local" id="cep_local">
											</div>
										</div>
										
										<div class="col-12 col-md-3">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">Logradouro</label>
												<input type="text" class="form-control" name="logradouro_local" id="logradouro_local">
											</div>
										</div>
										
										<div class="col-12 col-md-1">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">Nº</label>
												<input type="text" class="form-control" name="numero_local" id="numero_local">
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">Bairro</label>
												<input type="text" class="form-control" name="bairro_local" id="bairro_local">
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">Cidade</label>
												<input type="text" class="form-control" name="cidade_local" id="cidade_local">
											</div>
										</div>
										
										<div class="col-12 col-md-1">
											<div class="form-group">
											<label for="nome_socio" class=" form-control-label">UF</label>
												<select name="uf_local" name="uf_local" class="form-control">
													<option value="AC">AC</option>
													<option value="AL">AL</option>
													<option value="AP">AP</option>
													<option value="AM">AM</option>
													<option value="BA">BA</option>
													<option value="CE">CE</option>
													<option value="DF">DF</option>
													<option value="ES">ES</option>
													<option value="GO">GO</option>
													<option value="MA">MA</option>
													<option value="MT">MT</option>
													<option value="MS">MS</option>
													<option value="MG">MG</option>
													<option value="PA">PA</option>
													<option value="PB">PB</option>
													<option value="PR">PR</option>
													<option value="PE">PE</option>
													<option value="PI">PI</option>
													<option value="RJ">RJ</option>
													<option value="RN">RN</option>
													<option value="RS">RS</option>
													<option value="RO">RO</option>
													<option value="RR">RR</option>
													<option value="SC">SC</option>
													<option value="SP">SP</option>
													<option value="SE">SE</option>
													<option value="TO">TO</option>
													<option value="EX">EX</option>
												</select>
											</div>
										</div>
										
										
										</div>
										</div>

										<div class="row">
											<div class="col">
											<div class="input-group mb-2">
									        <div class="input-group-prepend">
									          <div class="input-group-text"><Strong>Presidente da Reunião:</Strong></div>
									        </div>
									        <input type="text" class="form-control" name="presidente_reuniao" placeholder="Digite o presidente da reunião" value="<?php echo $row_pegapauta['pres_reuniao']; ?>">
									      </div>
									  		</div>

									  		<div class="col">
											<div class="input-group mb-2">
									        <div class="input-group-prepend">
									          <div class="input-group-text"><strong>Secretário da Reunião:</strong></div>
									        </div>
									        <input type="text" class="form-control" name="secretario_reuniao" placeholder="Digite o secretário da reunião" value="<?php echo $row_pegapauta['sec_reuniao']; ?>">
									      </div>
									  		</div>

									    </div>
										
										
                                        
                                    </div>
                                </div>
								
								<div class="card">
                                    <div class="card-header">
                                        <strong>Cardápio</strong>
                                        <small> da Reunião</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
										<div class="row">
										
										<div class="col-12 col-md-4">
											<label class="sr-only">Entrada</label>
											  <div class="input-group">
												<div class="input-group-prepend">
												  <div class="input-group-text"><i class="fas fa-glass-martini-alt"></i></div>
												</div>
												<input type="text" class="form-control" name="entrada_cardapio" placeholder="Digite a entrada">
											  </div>
										</div>
										<div class="col-12 col-md-4">
											<label class="sr-only">Prato Principal</label>
											  <div class="input-group">
												<div class="input-group-prepend">
												  <div class="input-group-text"><i class="fas fa-utensils"></i></div>
												</div>
												<input type="text" class="form-control" name="principal_cardapio" placeholder="Digite o prato principal">
											  </div>
										</div>
										<div class="col-12 col-md-4">
											<label class="sr-only">Sobremesa</label>
											  <div class="input-group">
												<div class="input-group-prepend">
												  <div class="input-group-text"><i class="fa fa-ice-cream"></i></div>
												</div>
												<input type="text" class="form-control" name="sobremesa_cardapio" placeholder="Digite a sobremesa">
											  </div>
										</div>
										

										
										</div>
										
										
                                        
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <strong>Aniversários</strong>
                                        <small> da Reunião</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
										<div class="row">
										
										<div class="col-12 col-md-6">
											<label class="sr-only">Dia Inicial</label>
											  <div class="input-group">
												<div class="input-group-prepend">
												  <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
												</div>
												<input type="date" class="form-control" name="niver_inicial" value="<?php echo $row_pegapauta['niver_inicial']; ?>">
											  </div>
										</div>
										<div class="col-12 col-md-6">
											<label class="sr-only">Dia Final</label>
											  <div class="input-group">
												<div class="input-group-prepend">
												  <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
												</div>
												<input type="date" class="form-control" name="niver_final" value="<?php echo $row_pegapauta['niver_final']; ?>">
											  </div>
										</div>

										
										</div>
										
										
                                        
                                    </div>
                                </div>
								
								<div class="card">
                                    <div class="card-header">
                                        <strong>Mesa</strong> <button type="button" name="add" id="add" class="btn btn-primary" style="margin-left: 30px;"><i class="fas fa-user-plus" style="margin-right: 5px;"></i> Adicionar á mesa diretora</button> 
                                       
                                    </div>
                                    <div class="card-body card-block" id="dynamic_field">
									
									<div class="row form-group" >
                                            
                                            <div class="col-12 col-md-6">
											<div class="form-group">
												<label for="nome_filho" class=" form-control-label">Nome</label>
												<input type="text" name="nome_mesa[]" id="nome_mesa" class="form-control" placeholder="Digite o nome da pessoa que irá compor a mesa">
											</div>
										</div>
											<div class="col-12 col-md-6">
											<div class="form-group">
												<label for="data_nascto_filho" class=" form-control-label">Cargo</label>
												<!--<select name="cargo_mesa[]" class="form-control">
													<option>Presidente</option>
													<option>Governador</option>
													<option>Governador Assistente</option>
													<option>1º Secretário</option>
													<option>2º Secretário</option>
													<option>1ª Dama</option>
													<option>Visitante</option>
													<option>Secretário Geral</option>
													<option>Diretor</option>
													<option>Coordenador da Fund. Rotária</option>
													<option>Coordenador de Rotary</option>
													<option>Curador da Fund. Rotária</option>
													<option>Palestrante</option>
													<option>Sócio Aniversariante</option>
													<option>Tesoureiro</option>
													<option>Presidente da Subcomissão de Companheirismo</option>
												</select>-->
												<input type="text" name="cargo_mesa[]" class="form-control">
											</div>
										</div>
                                        </div>
									
									
										<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
										<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
										
										
										
									
									</div>
									
									
									
								</div>
								
								<div class="card">
                                    <div class="card-header">
                                        <strong>Informações</strong>
                                        
                                    </div>
                                    <div class="card-body card-block">
									<!--Start - PROTOCOLO-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												<label for="vencimento_mensalidade_socio" class="form-control-label">Início</label>
												<input type="text" name="hora_inicio" id="hora_inicio" maxlength="5" class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												<label for="vencimento_mensalidade_socio" class="form-control-label">Tempo</label>
												<input type="text" name="tempo_protocolo" maxlength="2" id="tempo_protocolo" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												<label for="vencimento_mensalidade_socio" class="form-control-label">Término</label>
												<input type="text" name="final_protocolo" maxlength="5" readonly id="final_protocolo" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											<label for="vencimento_mensalidade_socio" class="form-control-label">Pauta</label><br>
												<input type="text"  class="form-control" value="PROTOCOLO:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="vencimento_mensalidade_socio" class="form-control-label">Tempo usado por</label>
												<input type="text" name="protocolo_user" id="protocolo_user" class="form-control" placeholder="Tempo usado por..." >
											</div>
										</div>
										
                                        </div>
									<!--End - PROTOCOLO-->
									
									<!--Start - ABERTURA-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="ABERTURA:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="abertura_user" id="abertura_user" class="form-control" placeholder="Quem fará a abertura?" >
											</div>
										</div>
										
                                        </div>
									<!--End - ABERTURA-->
									
									<!--Start - SECRETARIA-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_secretaria" id="inicio_secretaria" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_secretaria" maxlength="2" id="tempo_secretaria" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_secretaria" maxlength="5" readonly id="final_secretaria" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="SECRETARIA:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="secretaria_user" id="secretaria_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - SECRETARIA-->
									
									<!--Start - TESOURARIA-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_tesouraria" id="inicio_tesouraria" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_tesouraria" maxlength="2" id="tempo_tesouraria" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_tesouraria" maxlength="5" readonly id="final_tesouraria" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="TESOURARIA:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="tesouraria_user" id="tesouraria_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - TESOURARIA-->
									
									<!--Start - SUBCOMISSÃO DE COMPANHEIRISMO-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_companheirismo" id="inicio_companheirismo" readonly maxlength="5" class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_companheirismo" maxlength="2" id="tempo_companheirismo" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_companheirismo" maxlength="5" readonly id="final_companheirismo" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="SUB. DE COMPANHEIRISMO:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="companheirismo_user" id="companheirismo_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - SUBCOMISSÃO DE COMPANHEIRISMO-->
									
									<!--Start - COMISSÃO ADMINISTRAÇÃO-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_comadm" id="inicio_comadm" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_comadm" maxlength="2" id="tempo_comadm" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_comadm" maxlength="5" readonly id="final_comadm" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="COM. ADMINISTRAÇÃO:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="comadm_user" id="comadm_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - COMISSÃO ADMINISTRAÇÃO-->
									
									<!--Start - COMISSÃO PROJETOS-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_comproj" id="inicio_comproj" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_comproj" maxlength="2" id="tempo_comproj" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_comproj" maxlength="5" readonly id="final_comproj" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="COM. PROJETOS:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="comproj_user" id="comproj_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - COMISSÃO PROJETOS-->
									
									<!--Start - COMISSÃO FUNDAÇÃO ROTÁRIA-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_comfundrot" id="inicio_comfundrot" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_comfundrot" maxlength="2" id="tempo_comfundrot" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_comfundrot" maxlength="5" readonly id="final_comfundrot" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="COM. FUND. ROTÁRIA:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="comfundrot_user" id="comfundrot_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - COMISSÃO FUNDAÇÃO ROTÁRIA-->
									
									<!--Start - APRESENTAÇÃO PALESTRANTE-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="APRES. PALESTRANTE:" style="border:0; background: #fff; font-weight:bold;"  readonly>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="aprespalestrante_user" id="aprespalestrante_user" class="form-control" placeholder="Tempo usado por..." value="<?php echo $row_pegapauta['apres_palestrante']; ?>" >
											</div>
										</div>
										
                                        </div>
									<!--End - APRESENTAÇÃO PALESTRANTE-->
									
									<!--Start - APRESENTAÇÃO PALESTRANTE-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_palestra" id="inicio_palestra" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" value="<?php echo $row_pegapauta['inicio_palestra']; ?>"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_palestra" maxlength="2" id="tempo_palestra" onblur="alteraHora();" class="form-control" value="<?php echo $row_pegapauta['tmp_palestra']; ?>"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_palestra" maxlength="5" readonly id="final_palestra" class="form-control" value="<?php echo $row_pegapauta['final_palestra']; ?>" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="PALESTRANTE:" style="border:0; background: #fff; font-weight:bold;" readonly>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="palestrante_user" id="palestrante_user" class="form-control" placeholder="Tempo usado por..." value="<?php echo $row_pegapauta['palestrante']; ?>" >
											</div>
										</div>
										
                                        </div>
									<!--End - APRESENTAÇÃO PALESTRANTE-->
									
									<!--Start - APRESENTAÇÃO PALESTRANTE-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="TEMA:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="tema_user" id="tema_user" class="form-control" placeholder="Digite o tema..." value="<?php echo $row_pegapauta['tema']; ?>" >
											</div>
										</div>
										
                                        </div>
									<!--End - APRESENTAÇÃO PALESTRANTE-->

									<!--Start - INFORMAÇÃO ROTÁRIA-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_almoco" id="inicio_almoco" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" value="<?php echo $row_pegapauta['inicio_almoco']; ?>"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_almoco" maxlength="2" id="tempo_almoco" onblur="alteraHora();" class="form-control" value="<?php echo $row_pegapauta['tmp_almoco']; ?>"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_almoco" maxlength="5" readonly id="final_almoco" class="form-control" value="<?php echo $row_pegapauta['final_almoco']; ?>" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="ALMOÇO" style="border:0; background: #fff; font-weight:bold;" readonly>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												
											</div>
										</div>
										
                                        </div>
									<!--End - INFORMAÇÃO ROTÁRIA-->
									
									<!--Start - INFORMAÇÃO ROTÁRIA-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_inforot" id="inicio_inforot" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_inforot" maxlength="2" id="tempo_inforot" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_inforot" maxlength="5" readonly id="final_inforot" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="INFORMAÇÃO ROTÁRIA:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="inforot_user" id="inforot_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - INFORMAÇÃO ROTÁRIA-->
									
									<!--Start - PRESIDÊNCIA-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_pres" id="inicio_pres" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_pres" maxlength="2" id="tempo_pres" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_pres" maxlength="5" readonly id="final_pres" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="PRESIDÊNCIA:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="pres_user" id="pres_user" class="form-control" placeholder="Tempo usado por..." >
											</div>
										</div>
										
                                        </div>
									<!--End - PRESIDÊNCIA-->
									
									<!--Start - PEQUENAS COMUNICAÇÕES-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_peqcom" id="inicio_peqcom" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_peqcom" maxlength="2" id="tempo_peqcom" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_peqcom" maxlength="5" readonly id="final_peqcom" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="PEQUENAS COMUNICAÇÕES:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="peqcom_user" id="peqcom_user" class="form-control" placeholder="Tempo usado por..." >
											</div>
										</div>
										
                                        </div>
									<!--End - PEQUENAS COMUNICAÇÕES-->
									
									<!--Start - SUBCOMISSÃO DE FREQUÊNCIA-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="inicio_subfreq" id="inicio_subfreq" maxlength="5" readonly class="form-control" onblur="alteraHora();" onkeypress="valida_horas(this)" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="tempo_subfreq" maxlength="2" id="tempo_subfreq" onblur="alteraHora();" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_subfreq" maxlength="5" readonly id="final_subfreq" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="SUB. DE FREQUÊNCIA:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="subfreq_user" id="subfreq_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - SUBCOMISSÃO DE FREQUÊNCIA-->
									
									<!--Start - ENCERRAMENTO-->
										<div class="row form-group">

										<div class="col-12 col-md-2">
											<div class="form-group">
												
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
												
												<input type="text" name="final_encerra" maxlength="5" readonly id="final_encerra" class="form-control"  required>
											</div>
										</div>
										
										<div class="col-12 col-md-2">
											<div class="form-group">
											
												<input type="text"  class="form-control" value="ENCERRAMENTO:" style="border:0; background: #fff; font-weight:bold;" readonly required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												
												<input type="text" name="encerra_user" id="encerra_user" class="form-control" placeholder="Tempo usado por...">
											</div>
										</div>
										
                                        </div>
									<!--End - ENCERRAMENTO-->
									
									</div>
									
									
									<div>
                                                <button id="payment-button" type="submit" onClick="return faz()" class="btn btn-lg btn-success btn-block vld">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
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

	var inicioalmoco = document.getElementById("inicio_almoco");
	var tempoalmoco = document.getElementById("tempo_almoco");
	var finalalmoco = document.getElementById("final_almoco");

	var iniciopalestra = document.getElementById("inicio_palestra");
	var tempopalestra = document.getElementById("tempo_palestra");
	var finalpalestra = document.getElementById("final_palestra");
	
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
	iniciopalestra.value = resulcomfundrot;
	}

	//Calcula hora da PALESTRA
	var horapalestra = resulcomfundrot;
	var resulpalestra = moment.utc(horapalestra, 'HH:mm').add(tempopalestra.value, 'minutes').format('HH:mm');
	if(iniciopalestra.value == "" || horainicio.value == "" || tempopalestra.value == ""){
    finalpalestra.value = 0;
	}else{
	finalpalestra.value = resulpalestra;
	inicioalmoco.value = resulpalestra;
	}

	//Calcula hora da ALMOÇO
	var horaalmoco = resulpalestra;
	var resulalmoco = moment.utc(horaalmoco, 'HH:mm').add(tempoalmoco.value, 'minutes').format('HH:mm');
	if(inicioalmoco.value == "" || horainicio.value == "" || tempoalmoco.value == ""){
    finalalmoco.value = 0;
	}else{
	finalalmoco.value = resulalmoco;
	inicioinforot.value = resulalmoco;
	}
	
	//Calcula hora da INFORMAÇÃO ROTÁRIA
	var horainforot = resulalmoco;
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
		$('#dynamic_field').append('<div class="row form-group" id="row'+i+'"><div class="col-12 col-md-6"><div class="form-group"><label for="nome_filho" class=" form-control-label">Nome</label><input type="text" name="nome_mesa[]" id="nome_mesa" class="form-control" placeholder="Digite o nome da pessoa que irá compor a mesa"></div></div><div class="col-12 col-md-4"><div class="form-group"><label for="data_nascto_filho" class=" form-control-label">Cargo</label><input type="text" name="cargo_mesa[]" class="form-control"></div></div><div class="col-12 col-md-2" ><div class="form-group"><br><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button> REMOVER</div></div></div>');
	
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