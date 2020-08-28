<?php
$page = 3;

include('config-header.php');

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.cod_lista_banco WHERE rfa_bancos.clube='$clube' ORDER BY rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_listabancos = mysqli_fetch_assoc($listabancos);
$totalRows_listabancos = mysqli_num_rows($listabancos);

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco WHERE clube='$clube' ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);
$totalRows_listatipobanco = mysqli_num_rows($listatipobanco);

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- Title Page-->
    <title>Cadastro de Contas a Pagar - Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	
	<!-- Start Ativa Tooltip no formulário -->
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- Final Ativa Tooltip no formulário -->
	
<script>
//isso você coloca em um arquivo js externo, a ser chamado depois do jquery, ou na tag script de uma página
            jQuery.fn.preventDoubleSubmit = function() {
              jQuery(this).submit(function() {
                if (this.beenSubmitted)
                  return false;
                else
                  this.beenSubmitted = true;
              });
            };

            //isso você coloca dentro do $(document).ready
    $(document).ready(function() 
    { 
      jQuery('form').preventDoubleSubmit(); 
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
    <style>
    .toggle{
        width: 110.453px !important;
    height: 37.7266px !important;
    }
    </style>
</head>

<body class="animsition">

    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->

            
 <div class="main-content">
			<form method="post" action="proc_cd_a_pagar.php" name="form-contabancaria">
            <div class="col-lg-12">
                                <div class="card"> 
                                    <div class="card-header">
                                        <strong>Cadastro</strong>
                                        <small> despesas</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="row">
                                        <div class="col-12 col-md-10">
                                        <div class="form-group">
											<label for="origem" class=" form-control-label">Origem </label>
                                                <select name="origem_pagar" id="origem_pagar" class="form-control" required>
                                                    <option value="">Selecione uma conta...</option>
													<?php if($totalRows_listabancos <= 0){}else{?>
                                                    <?php do{?>
													<option value="<?php echo $row_listabancos['cod_banco'];?>"><?php echo $row_listabancos['favorecido'];?> <strong>(<?php echo $row_listabancos['nome_lista_banco'];?>)</strong></option>
													<?php }while($row_listabancos = mysqli_fetch_assoc($listabancos));?>
														<?php }?>
                                                 </select>
                                        </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                        <label>É salário?</label><br>
                                        <input type="checkbox" id="salario" name="salario" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" value="">
                                        </div> 
                                        </div>
                                        <div class="alert alert-success" id="exibefuncionario" style="display:none; margin-bottom: 15px;">
                                        <div class="row" >
                                            <div class="col">
                                                <label for="nomefuncionario">Nome do Funcionário</label>
                                                <input type="text" name="nomefuncionario" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label for="nomefuncionario">CPF do Funcionário</label>
                                                <input type="text" name="cpffuncionario" class="form-control" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14">
                                            </div>
                                            <div class="col">
                                                <label for="nomefuncionario">Cargo</label>
                                                <input type="text" name="cargofuncionario" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 15px">
                                            <div class="col">
                                                    <label>Mês de Referência</label>
                                                    <select class="form-control" name="mesreferencia">
                                                    <option disabled selected>Selecione...</option>
                                                        <?php 
                                                            for($i=1; $i<=12; $i++){
                                                                echo "<option value='".$i."'>".$i."</option>";
                                                            }
                                                        ?>
                                                       
                                                    </select>
                                            </div>
                                            <div class="col">
                                                    <label>Ano de Referência</label>
                                                    <select class="form-control" name="anoreferencia">
                                                    <option disable selected>Selecione...</option>
                                                    <?php 
                                                            $anoseguinte = date('Y')+1;
                                                            for($i=2000; $i<=$anoseguinte; $i++){
                                                                echo "<option value='".$i."'>".$i."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                            </div>
                                            <div class="col">
                                                        <label>Data de Pagamento</label>
                                                        <input type="date" name="datapagamento" class="form-control">
                                                    </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="status" class="form-control-label">Status</label>
												<select name="status_pagar2" class="form-control">
													<option value="1">Pendente</option>
													<option value="2">Pago</option>
												</select>
											
                                                </div>
												
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px">
                                                <div class="col">
                                                    <h3>Detalhes financeiros <button class="badge badge-primary" id="addvencimento" type="button">+ Vencimentos</button></h3>
                                                </div>
                                        </div>
                                        <div class="row">
                                                    <div class="col">
                                                        <label>Descrição</label>
                                                        <input type="text" disabled class="form-control" value="SALÁRIO">
                                                    </div>
                                                    
                                                    <div class="col">
                                                            <div class="form-group">
                                                            <label for="valor_pagar" class=" form-control-label">Valor do Salário</label>
                                                            <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                            <div class="input-group-text">R$</div>
                                                            </div>
                                                            <input type="text" name="valor_salario" onKeyPress="return(moeda(this,'.',',',event))" id="valor_salario" class="form-control">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                            <div class="form-group">
                                                            <label for="valor_pagar" class=" form-control-label">Descontos</label>
                                                            <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                            <div class="input-group-text">R$</div>
                                                            </div>
                                                            <input type="text" name="descontos_salario" onKeyPress="return(moeda(this,'.',',',event))" id="descontos_salario" class="form-control">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label>Referência</label>
                                                        <input type="text" name="referenciasalario" class="form-control" placeholder="Ex.: 30 dias">
                                                    </div>
                                        </div>
                                        
                                        <div id="vencimentos"></div>
                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px">
                                                <div class="col">
                                                    <h3>Contribuições</h3>
                                                </div>
                                        </div>
                                        <div class="row">
                                        <div class="col">
                                                            <div class="form-group">
                                                            <label for="valor_pagar" class=" form-control-label">Sal. Contr. INSS</label>
                                                            <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                            <div class="input-group-text">R$</div>
                                                            </div>
                                                            <input type="text" name="contrinss" onKeyPress="return(moeda(this,'.',',',event))" id="contr_inss" class="form-control">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                            <div class="form-group">
                                                            <label for="valor_pagar" class=" form-control-label">Base Cálc. FGTS</label>
                                                            <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                            <div class="input-group-text">R$</div>
                                                            </div>
                                                            <input type="text" name="basefgts" onKeyPress="return(moeda(this,'.',',',event))" id="base_fgts" class="form-control">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                            <div class="form-group">
                                                            <label for="valor_pagar" class=" form-control-label">FGTS do Mês</label>
                                                            <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                            <div class="input-group-text">R$</div>
                                                            </div>
                                                            <input type="text" name="fgts_mes" onKeyPress="return(moeda(this,'.',',',event))" id="fgts_mes" class="form-control">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                            <div class="form-group">
                                                            <label for="valor_pagar" class=" form-control-label">Base Cálc. IRRF</label>
                                                            <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                            <div class="input-group-text">R$</div>
                                                            </div>
                                                            <input type="text" name="base_irrf" onKeyPress="return(moeda(this,'.',',',event))" id="base_irrf" class="form-control">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                            
                                                            <label for="valor_pagar" class=" form-control-label">Faixa IRRF</label>
                                                            
                                                            <input type="text" name="faixa_irrf" id="faixa_irrf" class="form-control">
                                                            
                                                            
                                                       
                                                    </div>
                                        </div>



                                        </div>
										<div class="row" id="padrao1">
										<div class="col" >
											<div class="form-group">
												<label for="descricao_pagar" class=" form-control-label">Descrição</label>
												<input type="text" name="descricao_pagar" id="descricao_pagar" placeholder="Ex.: Conta de Luz" class="form-control">
											</div>
										</div>
										<div class="col" >
											<div class="form-group">
												<label for="data_pagar" class=" form-control-label">Vencimento</label>
												<input type="date" name="data_pagar" id="data_pagar" class="form-control">
											</div>
										</div>
										</div>
                                        <div class="row form-group" id="padrao2">
                                            
                                            <div class="col">
                                                <div class="form-group exibetipopessoapf">
                                                    <label for="status" class="form-control-label">Status</label>
												<select name="status_pagar" class="form-control">
													<option value="1">Pendente</option>
													<option value="2">Pago</option>
												</select>
											
                                                </div>
												
                                            </div>
											<div class="col">
                                                <div class="form-group">
                                                    <label for="valor_pagar" class=" form-control-label">Valor</label>
													<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">R$</div>
													</div>
													<input type="text" name="valor_pagar" onKeyPress="return(moeda(this,'.',',',event))" id="valor_pagar" class="form-control">
													</div>
                                                    
                                                </div>
												
                                            </div>
                                        </div>
										
										
										<input type="hidden" name="por" value="<?= $_SESSION['nome'] ?>">
										<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
										<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
										
										
										<div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
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
	
	
	<script>
    
    $(document).ready(function(){
	var i=1;
	$('#addvencimento').click(function(){
		i++;
		$('#vencimentos').append('<div class="row" id="row'+i+'"><div class="col"><label>Descrição<button class="badge badge-danger btn_remove" id="'+i+'" type="button">X</button></label><input type="text" class="form-control" name="descricao_vencimento[]" placeholder="Ex.: SALÁRIO FAMÍLIA"></div><div class="col"><div class="form-group"><label for="valor_pagar" class=" form-control-label">Valor do Vencimento</label><div class="input-group mb-2"><div class="input-group-prepend"><div class="input-group-text">R$</div></div><input type="text" name="valor_vencimento[]" onKeyPress="return(moeda(this,\'.\',\',\',event))" id="valor_vencimento" class="form-control" required></div></div></div><div class="col"><div class="form-group"><label for="valor_pagar" class=" form-control-label">Descontos</label><div class="input-group mb-2"><div class="input-group-prepend"><div class="input-group-text">R$</div></div><input type="text" name="descontos_vencimento[]" onKeyPress="return(moeda(this,\'.\',\',\',event))" id="descontos_vencimento" class="form-control" required></div></div></div><div class="col"><label>Referência</label><input type="text" name="referencia_vencimento[]" class="form-control" placeholder="Ex.: 30 dias"></div></div>');
	
	});

	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	
	
});
    </script>

    <script type="text/javascript">


window.onload = function () {
    var input = document.querySelector('input[type=checkbox]');
    
    function check() {
        var a = input.checked ? "1" : "0";
        var func = document.getElementById('exibefuncionario');
        document.getElementById('salario').value = a;

        if ($('input[name="salario"]:checked').val() === "1") {
        $('#exibefuncionario').show();
        $('#padrao1').hide();
        $('#padrao2').hide();
    } else {
        $('#exibefuncionario').hide();
        $('#padrao1').show();
        $('#padrao2').show();
    }

    }
    input.onchange = check;
    check();
}
</script>

	
    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->