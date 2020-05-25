<?php 

$page = 3;

include('config-header.php');

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_lista_bancos WHERE clube='$clube' AND nome_lista_banco!='Caixa' ORDER BY nome_lista_banco ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);
$total_listabancos = mysqli_num_rows($listabancos);

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco WHERE clube='$clube' AND nome_lista_tipo != 'Caixa' ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);
$total_listatipobanco = mysqli_num_rows($listatipobanco);

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
    <title>Cadastro de Bancos - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->
	
	<script language="javascript">
			function valida(){
				if(valida_cpf(document.getElementById('cpf').value))
					alert('CPF Válido');
				else
					alert('CPF Inválido');
			}
			
			function valida_cpf(cpf){
				  var numeros, digitos, soma, i, resultado, digitos_iguais;
				  digitos_iguais = 1;
				  if (cpf.length < 11)
						return false;
				  for (i = 0; i < cpf.length - 1; i++)
						if (cpf.charAt(i) != cpf.charAt(i + 1))
							  {
							  digitos_iguais = 0;
							  break;
							  }
				  if (!digitos_iguais)
						{
						numeros = cpf.substring(0,9);
						digitos = cpf.substring(9);
						soma = 0;
						for (i = 10; i > 1; i--)
							  soma += numeros.charAt(10 - i) * i;
						resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
						if (resultado != digitos.charAt(0))
							  return false;
						numeros = cpf.substring(0,10);
						soma = 0;
						for (i = 11; i > 1; i--)
							  soma += numeros.charAt(11 - i) * i;
						resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
						if (resultado != digitos.charAt(1))
							  return false;
						return true;
						}
				  else
						return false;
			}
		</script>

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
			<form method="post" action="proc_cd_banco.php" name="form-contabancaria">
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Cadastro</strong>
                                        <small> contas bancárias</small>
                                    </div>
                                    <div class="card-body card-block">

                                    	<?php if($total_listabancos < 1 && $total_listatipobanco < 1){?>
                                    	<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Opa!</strong> Antes de cadastrar sua conta bancária é essencial que adicione <strong>tipos de bancos</strong> e <strong>tipos de contas</strong> nos botões abaixo.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>
										<?php }elseif($total_listabancos < 1){?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Opa!</strong> Antes de cadastrar sua conta bancária é essencial que adicione <strong>tipos de bancos</strong> utilizando o botão abaixo.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>
										<?php }elseif($total_listatipobanco < 1){?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
										  <strong>Opa!</strong> Antes de cadastrar sua conta bancária é essencial que adicione <strong>tipos de contas</strong> utilizando o botão abaixo.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>
										<?php }else{} ?>

									<div class="row form-group">
                                            
                                            
											<div class="col">
                                                <div class="form-group">
                                                    <label for="banco" class=" form-control-label">Tipo de Banco <a href="#" class="badge badge-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Adicionar...</a></label>
                                                    <select name="banco" id="banco" class="form-control" required>
                                                        <option value="" disabled selected>Selecione um banco...</option>
                                                        <?php if($total_listabancos < 1){}else{?>
                                                        <?php do{?>
														<option value="<?php echo $row_listabancos['cod_lista_banco'];?>"><?php echo $row_listabancos['nome_lista_banco'];?></option>
														<?php }while($row_listabancos = mysqli_fetch_assoc($listabancos));?>
														<?php } ?>
                                                    </select>
                                                </div>
                                            </div>
											<div class="col">
                                                <div class="form-group">
                                                    <label for="tipoconta" class=" form-control-label">Tipo de Conta <a href="#" class="badge badge-primary" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Adicionar...</a></label>
                                                    <select name="tipoconta" id="tipoconta" class="form-control" required>
                                                        <option value="" disabled selected>Selecione um tipo de conta...</option>
                                                        <?php if($total_listatipobanco < 1){}else{?>
                                                        <?php do{?>
														<option value="<?php echo $row_listatipobanco['cod_lista_tipo_banco'];?>"><?php echo $row_listatipobanco['nome_lista_tipo'];?></option>
														<?php }while($row_listatipobanco = mysqli_fetch_assoc($listatipobanco));?>
														<?php } ?>
                                                    </select>
                                                </div>
												
                                            </div>
                                        </div>
									
                                        <div class="form-group">
										
										
                                            <label for="favorecido" class=" form-control-label">Favorecido</label>
                                            <input type="text" name="favorecido" id="favorecido" placeholder="Digite a razão social do clube" class="form-control" required>
                                        </div>
										<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="agencia" class=" form-control-label">Agência</label>
												<input type="text" name="agencia" id="agencia" placeholder="Ex.: 8470" class="form-control" onkeypress="return somenteNumeros(event)" required>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Nº da Conta</label>
												<input type="text" name="n_conta" id="n_conta" onkeypress="return somenteNumeros(event)" placeholder="Ex.: 77778" class="form-control" required>
											</div>
										</div>
										</div>
                                        <div class="row form-group">
                                            
                                            <div class="col">
                                                
												<div class="form-group exibetipopessoapj">
                                                    <label for="cnpj" class=" form-control-label">CNPJ</label>
                                                    <input type="text" id="cnpj" name="cnpj" placeholder="Ex.: 19.829.198/0001-01" class="form-control" maxlength="18" onkeydown="javascript: fMasc( this, mCNPJ );" required>
                                                </div>
                                            </div>
											<div class="col">
                                                <div class="form-group">
                                                    <label for="saldo" class=" form-control-label">Saldo</label>
													<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">R$</div>
													</div>
													<input type="text" name="saldo" id="saldo" onKeyPress="return(moeda(this,'.',',',event))" class="form-control" data-toggle="tooltip" data-placement="top" title="Este saldo será somado ao caixa, receitas e contas a receber." required> 
													</div>
                                                    
                                                </div>
												
                                            </div>
                                        </div>
										
										
										
										<div class="row">
											<div class="col">
												<div class="alert alert-warning" role="alert" style="padding: 25px 15px">
												  Esta conta será utilizada para receber os saques realizados de <strong>boletos referente a mensalidades</strong>?<Br>
												  <select class="form-control" name="conta-mensalidade" required>
														<option value="1">Sim, todas as mensalidades serão transferidas para esta conta</option>
														<option value="0">Não, as mensalidades serão transferidas para outra conta</option>
												  </select>
												</div>
											</div>
										</div>
										
										<input type="hidden" name="user" id="user" value="<?= $_SESSION['id_usuario'] ?>">
										<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
										
										<div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
                                        
                                    </div>
                                </div>
                            </div>
							</form>
							
							<!-- Start Formulário para inserir bancos -->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Adicionar Banco</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  
										<form method="post" action="proc_cd_lista_bancos.php" enctype="multipart/form-data">
										  <div class="form-group">
											<label for="recipient-name" class="col-form-label">Nome do Banco:</label>
											<input type="text" class="form-control" id="nomebanco" name="nomebanco" placeholder="Ex.: Itaú">
										  </div>
										  <div class="form-group">
											<label for="message-text" class="col-form-label">Logotipo do Banco:</label>
											<input type="file" class="form-control" id="logobanco" name="logobanco">
										  </div>
										<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
										<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
										<button type="submit" class="btn btn-primary">Adicionar</button>
									  </div>
									  </form>
									</div>
								  </div>
								</div>
							<!-- End Formulário para inserir bancos -->
							
							<!-- Start Formulário para inserir tipos de contas -->
								<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Adicionar Tipo de Conta</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  
										<form method="post" action="proc_cd_lista_tipo_conta.php">
										  <div class="form-group">
											<label for="recipient-name" class="col-form-label">Nome do Tipo de Conta:</label>
											<input type="text" class="form-control" id="nometipobanco" name="nometipobanco" placeholder="Ex.: Corrente">
										  </div>
										 <input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
										 <input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
										<button type="submit" class="btn btn-primary">Adicionar</button>
										</form>
									  </div>
									</div>
								  </div>
								</div>
							<!-- End Formulário para inserir tipos de contas  -->
							
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