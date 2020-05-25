<?php 
$page = 10;

include('config-header.php');

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.id_lista_banco ORDER BY rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);

//Seleciona todos os planos
$qry = "SELECT * FROM rfa_planos";
$lisy = mysqli_query($link, $qry) or die(mysqli_error($link));
$row_lisy = mysqli_fetch_assoc($lisy);

//Seleciona todos os clubes
$qclu = "SELECT * FROM rfa_clubes ORDER BY nome_clube";
$lisclube = mysqli_query($link, $qclu) or die(mysqli_error($link));
$row_lisclube = mysqli_fetch_assoc($lisclube);

$exibeclube = "";
foreach($lisclube as $liclu){
	$exibeclube .= "<option value='".$liclu['id_clube']."'>".$liclu['nome_clube']."</option>";
}

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
    <title>Cadastro de Usuários - Rotary Fortaleza Alagadiço</title>

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
			<form method="post" action="login-seguro/proc_cd_usuario.php" name="form-contabancaria" enctype="multipart/form-data">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Cadastro</strong>
                                        <small> Usuários</small>
                                    </div>
                                    <div class="card-body card-block">
									
									
									
									
									
                                        
												 
												 <div class="row">
												 	<div class="col-12 col-md-3">
												 		<div class="form-group">
											<label for="destino" class=" form-control-label">Tipo de Usuário </label>
                                                <!--<select name="funcao" id="funcao" class="form-control" required>
                                                    <option value="">Selecione a função do usuário...</option>
                                                    <option value="1">Administrador</option>
													<option value="2">Presidente de Clube</option>
													<option value="3">Secretário de Clube</option>
													<option value="4">Contador de Clube</option>
													<option value="5">Secretário Executivo de Clube</option>
                                                 </select>  -->

                                                 <div class="dropdown" >
												  <button class="btn btn-secondary dropdown-toggle" style="width: 100%" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												    Selecione a função do usuário...
												  </button>
												  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												    <a class="dropdown-item adm" href="#" id="idadm" data-sel="isento">Administrador</a>
												    <a class="dropdown-item oddplanos" href="#" id="idpres" data-sel="oddplanos">Presidente de Clube</a>
												    <a class="dropdown-item isento" href="#" id="idsec" data-sel="isento">Secretário de Clube</a>
												    <a class="dropdown-item isento" href="#" id="idcont" data-sel="isento">Contador de Clube</a>
												    <a class="dropdown-item isento" href="#" id="idexec" data-sel="isento">Secretário Executivo de Clube</a>
												  </div>
												</div>
												<input type="hidden" name="funcao" id="funcao" class="funcao">

												 </div>
												 	</div>
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Nome completo</label>
												<input type="text" name="nome_usuario" id="nome_usuario" placeholder="Digite o nome do usuário" class="form-control" required>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">E-mail</label>
												<input type="email" name="email_usuario" id="email_usuario" placeholder="Digite o e-mail do usuário" class="form-control" required>
											</div>
										</div>
										
										</div>
										<div class="row">
										<div class="col" id="clubusuario">
                                                <div class="form-group">
												<label for="clube" class=" form-control-label">Nome do Clube que administra</label>
												<input type="text" name="clube" id="clube" placeholder="Digite o nome do Clube deste usuário" class="form-control">
											</div>
												
                                         </div>
                                         <input type="hidden" id="ativaclube" name="ativaclube">
                                         <input type="hidden" id="nomesclubes" value="<?php echo $exibeclube;?>">
                                         
										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Senha do Usuário</label>
												<input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required>
											</div>
										</div>
										</div>
                                        <div class="row form-group">
                                            
                                            <div class="col">




                                                <div class="form-group exibetipopessoapf">
                                                    <label for="status" class="form-control-label">Plano</label>
													<div id="plan1">
												<select name="plano" class="form-control" id="sel">
													<option value="0" class="isento">Isento</option>
													<?php 
														foreach($lisy as $rw){
															echo "<option value=".$rw['id_plano']." class='oddplanos'>".$rw['nome_plano']." (R$ ".number_format($rw['valor_plano'],2,',','.').")</option>";
														}
													?>
												</select>
												</div>
												
												
											
                                                </div>
												
                                            </div>
											
											 <div class="col">
                                                <div class="form-group exibetipopessoapf">
                                                    <label for="formapagamento" class="form-control-label">Forma de Pagamento</label>
												<div id="pgto1">
												<select name="formapagamento" class="form-control" id="sel2">
													
													<option value="1" class="oddplanos">Boleto Bancário</option>
													<option value="2" class="oddplanos">Pagseguro</option>
													<option value="3" class="oddplanos">Paypal</option>
													<option value="4" class="isento">Isento</option>
												</select>
												</div>
												<div id="pgto2" style="display:none;">
												<select name="formapagamento" class="form-control">
													
													
												</select>
												</div>
                                                </div>
												
                                            </div>
											
                                        </div>

                                       
										<div class="row">
											<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">CEP</label>
												<input type="text" name="cep_clube" id="cep_clube" class="form-control" onkeypress="return somenteNumeros(event)" maxlength="8" required>
											</div>
										</div>

										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Endereço do Clube</label>
												<input type="text" name="endereco_clube" id="endereco_clube" class="form-control" required>
											</div>
										</div>
										
										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Número</label>
												<input type="text" name="numero_clube" id="numero_clube" class="form-control" required>
											</div>
										</div>

									</div>
									<div class="row">

										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Bairro</label>
												<input type="text" name="bairro_clube" id="bairro_clube" class="form-control" required>
											</div>
										</div>

										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Cidade</label>
												<input type="text" name="cidade_clube" id="cidade_clube" class="form-control" required>
											</div>
										</div>

										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Estado</label>
												<select name="estado_clube" id="estado_clube" class="form-control" >
													<option value="AC">Acre</option>
													<option value="AL">Alagoas</option>
													<option value="AP">Amapá</option>
													<option value="AM">Amazonas</option>
													<option value="BA">Bahia</option>
													<option value="CE">Ceará</option>
													<option value="DF">Distrito Federal</option>
													<option value="ES">Espírito Santo</option>
													<option value="GO">Goiás</option>
													<option value="MA">Maranhão</option>
													<option value="MT">Mato Grosso</option>
													<option value="MS">Mato Grosso do Sul</option>
													<option value="MG">Minas Gerais</option>
													<option value="PA">Pará</option>
													<option value="PB">Paraíba</option>
													<option value="PR">Paraná</option>
													<option value="PE">Pernambuco</option>
													<option value="PI">Piauí</option>
													<option value="RJ">Rio de Janeiro</option>
													<option value="RN">Rio Grande do Norte</option>
													<option value="RS">Rio Grande do Sul</option>
													<option value="RO">Rondônia</option>
													<option value="RR">Roraima</option>
													<option value="SC">Santa Catarina</option>
													<option value="SP">São Paulo</option>
													<option value="SE">Sergipe</option>
													<option value="TO">Tocantins</option>
													<option value="EX">Estrangeiro</option>
												</select>
											</div>
										</div>

										</div>
										<div class="row">
											<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Telefone do clube</label>
												<input type="text" name="telefone_clube" id="telefone_clube" class="form-control" maxlength="14" onkeydown="javascript: fMasc( this, mTel );" required>
											</div>
										</div>

										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">E-mail do Clube</label>
												<input type="email" name="email_clube" id="email_clube" class="form-control" required>
											</div>
										</div>
										

									</div>
										
										
										
										<div id="btn1">
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
										 <div id="btn2" style="display:none">
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Continuar...</span>
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

	<script>

var $sel = $('#sel option').detach(); // global variable

$('a').on('click', function (e) {
    e.preventDefault();
    var c = $(this).data('sel');
    $('#sel').empty().append( $sel.filter('.'+c) );

});

var $sel2 = $('#sel2 option').detach(); // global variable

$('a').on('click', function (e) {
    e.preventDefault();
    var c = $(this).data('sel');
    $('#sel2').empty().append( $sel2.filter('.'+c) );
    
});

$('.oddplanos').on('click', function() {
  $('#clubusuario').replaceWith( "<div class='col' id='clubusuario'><div class='form-group'><label for='clube' class='form-control-label'>Nome do Clube que administra</label><input type='text' name='clube' id='clube' placeholder='Digite o nome do Clube deste usuário' class='form-control'></div></div>" );
});

$('.isento').on('click', function() {
	var nomesclubes = document.querySelector("#nomesclubes").value;
  $('#clubusuario').replaceWith( "<div class='col' id='clubusuario'><div class='form-group'><label for='clube' class='form-control-label'>Nome do Clube que administra</label><select name='clube' id='clube' class='form-control'>"+nomesclubes+"</select></div></div>" );
});

$('.adm').on('click', function() {
  $('#clubusuario').replaceWith( "<div class='col' id='clubusuario'><div class='form-group'><label for='clube' class='form-control-label'>Nome do Clube que administra</label><select name='clube' id='clube' class='form-control'><option value='0'>Isento</option></select></div></div>" );
});

$('#idadm').on('click', function() {
	var func = document.querySelector("#funcao");
	var atvclube = document.querySelector("#ativaclube");
	atvclube.value = 0;
	func.value = 1;
});
$('#idpres').on('click', function() {
	var func = document.querySelector("#funcao");
	var atvclube = document.querySelector("#ativaclube");
	func.value = 2;
	atvclube.value = 1;
});
$('#idsec').on('click', function() {
	var func = document.querySelector("#funcao");
	var atvclube = document.querySelector("#ativaclube");
	atvclube.value = 0;
	func.value = 3;
});
$('#idcont').on('click', function() {
	var func = document.querySelector("#funcao");
	var atvclube = document.querySelector("#ativaclube");
	atvclube.value = 0;
	func.value = 4;
});
$('#idexec').on('click', function() {
	var func = document.querySelector("#funcao");
	var atvclube = document.querySelector("#ativaclube");
	atvclube.value = 0;
	func.value = 5;
});

	</script>
	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->