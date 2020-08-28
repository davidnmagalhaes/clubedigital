<?php 
$page = 11;

include('config-header.php');

$sql = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$clubeinfo = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_clubeinfo = mysqli_fetch_assoc($clubeinfo);

$sqlogo = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$logotopo = mysqli_query($link, $sqlogo) or die(mysqli_error($link));
$row_logotopo = mysqli_fetch_assoc($logotopo);

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
    <title>Configurações - Rotary Fortaleza Alagadiço</title>

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

							
							<form method="post" action="proc_edt_configuracoes.php" name="form-contabancaria" enctype="multipart/form-data">
			
			
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Configurações do Clube</strong>
                                        <small>Ajuste as informações sobre seu clube</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
												
										<div class="row">
										<div class="col-12 col-md-12">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Logotipo do Clube</label>
												<input type="file" name="logotipo_clube" class="form-control">
											</div>
										</div>
										
										
										</div>

										

										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">CEP</label>
												<input type="text" name="cep_clube" id="cep_clube" class="form-control" value="<?php echo $row_clubeinfo['cep_clube'];?>" onkeypress="return somenteNumeros(event)" maxlength="8" required>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Endereço do Clube</label>
												<input type="text" name="endereco_clube" id="endereco_clube" class="form-control" value="<?php echo $row_clubeinfo['endereco_clube'];?>" required>
											
											<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Número</label>
												<input type="text" name="numero_clube" id="numero_clube" class="form-control" value="<?php echo $row_clubeinfo['numero_clube'];?>" required>
											
											<input type="hidden" name="club" value="<?php echo $_SESSION['clube'];?>">
											</div>
										</div>
										</div>
										
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Bairro</label>
												<input type="text" name="bairro_clube" id="bairro_clube" class="form-control" value="<?php echo $row_clubeinfo['bairro_clube'];?>" required>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Cidade</label>
												<input type="text" name="cidade_clube" id="cidade_clube" class="form-control" value="<?php echo $row_clubeinfo['cidade_clube'];?>" required>
											
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Estado</label>
												<select name="estado_clube" class="form-control" id="estado_clube" required>
													<option>Selecione um estado...</option>
													<option value="AC" <?php if($row_clubeinfo['estado_clube'] == 'AC'){echo 'selected';} ?>>Acre</option>
													<option value="AL" <?php if($row_clubeinfo['estado_clube'] == 'ALL'){echo 'selected';} ?>>Alagoas</option>
													<option value="AP" <?php if($row_clubeinfo['estado_clube'] == 'AP'){echo 'selected';} ?>>Amapá</option>
													<option value="AM" <?php if($row_clubeinfo['estado_clube'] == 'AM'){echo 'selected';} ?>>Amazonas</option>
													<option value="BA" <?php if($row_clubeinfo['estado_clube'] == 'BA'){echo 'selected';} ?>>Bahia</option>
													<option value="CE" <?php if($row_clubeinfo['estado_clube'] == 'CE'){echo 'selected';} ?>>Ceará</option>
													<option value="DF" <?php if($row_clubeinfo['estado_clube'] == 'DF'){echo 'selected';} ?>>Distrito Federal</option>
													<option value="ES" <?php if($row_clubeinfo['estado_clube'] == 'ES'){echo 'selected';} ?>>Espírito Santo</option>
													<option value="GO" <?php if($row_clubeinfo['estado_clube'] == 'GO'){echo 'selected';} ?>>Goiás</option>
													<option value="MA" <?php if($row_clubeinfo['estado_clube'] == 'MA'){echo 'selected';} ?>>Maranhão</option>
													<option value="MT" <?php if($row_clubeinfo['estado_clube'] == 'MT'){echo 'selected';} ?>>Mato Grosso</option>
													<option value="MS" <?php if($row_clubeinfo['estado_clube'] == 'MS'){echo 'selected';} ?>>Mato Grosso do Sul</option>
													<option value="MG" <?php if($row_clubeinfo['estado_clube'] == 'MG'){echo 'selected';} ?>>Minas Gerais</option>
													<option value="PA" <?php if($row_clubeinfo['estado_clube'] == 'PA'){echo 'selected';} ?>>Pará</option>
													<option value="PB" <?php if($row_clubeinfo['estado_clube'] == 'PB'){echo 'selected';} ?>>Paraíba</option>
													<option value="PR" <?php if($row_clubeinfo['estado_clube'] == 'PR'){echo 'selected';} ?>>Paraná</option>
													<option value="PE" <?php if($row_clubeinfo['estado_clube'] == 'PE'){echo 'selected';} ?>>Pernambuco</option>
													<option value="PI" <?php if($row_clubeinfo['estado_clube'] == 'PI'){echo 'selected';} ?>>Piauí</option>
													<option value="RJ" <?php if($row_clubeinfo['estado_clube'] == 'RJ'){echo 'selected';} ?>>Rio de Janeiro</option>
													<option value="RN" <?php if($row_clubeinfo['estado_clube'] == 'RN'){echo 'selected';} ?>>Rio Grande do Norte</option>
													<option value="RS" <?php if($row_clubeinfo['estado_clube'] == 'RS'){echo 'selected';} ?>>Rio Grande do Sul</option>
													<option value="RO" <?php if($row_clubeinfo['estado_clube'] == 'RO'){echo 'selected';} ?>>Rondônia</option>
													<option value="RR" <?php if($row_clubeinfo['estado_clube'] == 'RR'){echo 'selected';} ?>>Roraima</option>
													<option value="SC" <?php if($row_clubeinfo['estado_clube'] == 'SC'){echo 'selected';} ?>>Santa Catarina</option>
													<option value="SP" <?php if($row_clubeinfo['estado_clube'] == 'SP'){echo 'selected';} ?>>São Paulo</option>
													<option value="SE" <?php if($row_clubeinfo['estado_clube'] == 'SE'){echo 'selected';} ?>>Sergipe</option>
													<option value="TO" <?php if($row_clubeinfo['estado_clube'] == 'TO'){echo 'selected';} ?>>Tocantins</option>
													<option value="EX" <?php if($row_clubeinfo['estado_clube'] == 'EX'){echo 'selected';} ?>>Estrangeiro</option>
												</select>
											
											</div>
										</div>
										</div>
										
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">CNPJ</label>
												<input type="text" name="cnpj_clube" id="cnpj_clube" class="form-control" value="<?php echo $row_clubeinfo['cnpj_clube'];?>" onkeydown="javascript: fMasc( this, mCNPJ );" required>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Telefone</label>
												<input type="text" name="telefone_clube" id="telefone_clube" class="form-control" value="<?php echo $row_clubeinfo['telefone_clube'];?>" maxlength="14" onkeydown="javascript: fMasc( this, mTel );" required>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">E-mail</label>
												<input type="text" name="email_clube" id="email_clube" class="form-control" value="<?php echo $row_clubeinfo['email_clube'];?>" required>
											
										
											</div>
										</div>
										
										</div>
										
										
										<div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Atualizar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
                                        
                                    </div>
                                </div>
                            </div>
							</form>
							
		
							
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	<script type="text/javascript">
		
		$("#cep_clube").focusout(function(){
			$.ajax({
				url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
				dataType: 'json',
				success: function(resposta){
					$("#endereco_clube").val(resposta.logradouro);
			
					$("#bairro_clube").val(resposta.bairro);
					$("#cidade_clube").val(resposta.localidade);
					$("#estado_clube").val(resposta.uf);
					$("#numero_clube").focus();
					document.getElementById("endereco").style.display = "block";
				}
			});
		});
	</script>
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->