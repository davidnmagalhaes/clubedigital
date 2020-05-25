<?php
$page = 6;

include('config-header.php');
$idpauta = $_GET['cod_pauta'];



$s = "SELECT * FROM rfa_pauta WHERE cod_pauta='$idpauta' AND clube='$clube'";
$pegapauta = mysqli_query($link, $s) or die(mysqli_error($link));
$row_pegapauta = mysqli_fetch_assoc($pegapauta);

$q = "SELECT * FROM rfa_mesa WHERE ref_pauta='$idpauta' AND clube='$clube'";
$pegamesa = mysqli_query($link, $q) or die(mysqli_error($link));
$row_pegamesa = mysqli_fetch_assoc($pegamesa);

$sql = "SELECT * FROM rfa_reuniao WHERE clube='$clube'";
$reuniao = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_reuniao = mysqli_fetch_assoc($reuniao);
$totalRows_reuniao = mysqli_num_rows($reuniao);

$sq = "SELECT * FROM rfa_local_reuniao WHERE clube='$clube'";
$local = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_local = mysqli_fetch_assoc($local);

$sqrec = "SELECT * FROM rfa_recuperantes WHERE clube='$clube' AND id_pauta='$idpauta'";
$rec = mysqli_query($link, $sqrec) or die(mysqli_error($link));
$totalRows_rec = mysqli_num_rows($rec);

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
    <title>Edição de Pauta - Rotary Fortaleza Alagadiço</title>

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

<script>
function showMesa(divId, element)
{
    document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
    document.getElementById(element.id).style.display = 'none';
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

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

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
			<form method="post" action="proc_cd_recuperante.php" id="formsocios" name="form-socios" runat="server"  onsubmit="ShowLoading(); ">
            <div class="col-lg-12">
                                
								

								
								<div class="card" >
                                    <div class="card-header">
                                        <strong>Cadastrar recuperantes</strong> <button type="button" name="add" id="add" class="btn btn-primary" style="margin-left: 30px;"><i class="fas fa-user-plus" style="margin-right: 5px;"></i> Adicionar recuperante</button> 
                                       
                                    </div>
                                    <div class="card-body card-block" id="dynamic_field">
									
									
									<div class="row form-group" >
                                            
                                            <div class="col-12 col-md-4">
											<div class="form-group">
												<label for="nome_filho" class="form-control-label">Nome do Recuperante:</label>
												<input type="text" name="nome_recuperante[]" id="nome_recuperante" class="form-control" placeholder="Digite o nome do recuperante...">
											</div>
										</div>

										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="nome_filho" class="form-control-label">E-mail do Recuperante:</label>
												<input type="email" name="email_recuperante[]" id="nome_recuperante" class="form-control" placeholder="Digite o e-mail do recuperante...">
											</div>
										</div>

										<div class="col-12 col-md-3">
											<div class="form-group">
												<label for="nome_filho" class="form-control-label">E-mail do Clube:</label>
												<input type="email" name="email_clube[]" id="nome_recuperante" class="form-control" placeholder="Digite o e-mail do clube...">
											</div>
										</div>

										<div class="col-12 col-md-2">
											<div class="form-group">
												<label for="nome_filho" class="form-control-label">Clube do Recuperante:</label>
												<input type="text" name="clube_recuperante[]" id="clube_recuperante" class="form-control" placeholder="Digite o clube do recuperante...">
											</div>
										</div>

										
                                     </div>

									</div>
									<input type="hidden" name="user" value="<?= $_SESSION['id_usuario'] ?>">
										<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
										<input type="hidden" name="idpauta" value="<?php echo $idpauta; ?>">
									
									
									
								</div>
								
								
								
										<div>
                                                <button id="payment-button" type="submit" onClick="return faz()" class="btn btn-lg btn-success btn-block vld">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar Recuperante</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                        </div>
                                </form>

                                        <div class="card" style="margin-top:50px">
		                                    <div class="card-header">
		                                        <strong>Recuperantes cadastrados</strong> 
		                                    </div>
		                                    <div class="card-body card-block">
											
												<table class="table table-striped">
												  <thead>
												    <tr>
												      <th scope="col">Nome do Recuperante</th>
												      <th scope="col">E-mail do Recuperante</th>
												      <th scope="col">E-mail do Clube</th>
												      <th scope="col">Clube</th>
												      <th scope="col">Enviar</th>
												      <th scope="col">Excluir</th>
												    </tr>
												  </thead>
												  <tbody>
												  	
												  	<?php while($row_rec = mysqli_fetch_array($rec)){?>
													    <tr>
													      <th scope="row"><?php echo $row_rec['nome_recuperante'];?></th>
													      <td><?php echo $row_rec['email_recuperante'];?></td>
													      <td><?php echo $row_rec['email_clube'];?></td>
													      <td><?php echo $row_rec['clube_recuperante'];?></td>
													      <td><a href="proc_emitir_recuperante.php?cod_rec=<?php echo $row_rec['cod_recuperante'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-paper-plane"></i></a></td>
													      <td><a href="excluir-recuperante.php?cod_rec=<?php echo $row_rec['cod_recuperante'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-trash-alt"></i></a></td>
													    </tr>
													<?php } ?>
												    
												  </tbody>
												</table>
											

											</div>
										</div>

                            </div>
							
							
							
							
							
</div>
            

            <?php include("footer.php"); ?>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
	


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
		$('#dynamic_field').append('<div class="row form-group" id="row'+i+'"><div class="col-12 col-md-3"><div class="form-group"><label for="nome_filho" class="form-control-label">Nome do Recuperante:</label><input type="text" name="nome_recuperante[]" id="nome_recuperante" class="form-control" placeholder="Digite o nome do recuperante..."></div></div><div class="col-12 col-md-3"><div class="form-group"><label for="nome_filho" class="form-control-label">E-mail do Recuperante:</label><input type="email" name="email_recuperante[]" id="nome_recuperante" class="form-control" placeholder="Digite o e-mail do recuperante..."></div></div><div class="col-12 col-md-3"><div class="form-group"><label for="nome_filho" class="form-control-label">E-mail do Clube:</label><input type="email" name="email_clube[]" id="nome_recuperante" class="form-control" placeholder="Digite o e-mail do clube..."></div></div><div class="col-12 col-md-2"><div class="form-group"><label for="nome_filho" class="form-control-label">Clube do Recuperante:</label><input type="text" name="clube_recuperante[]" id="clube_recuperante" class="form-control" placeholder="Digite o clube do recuperante..."></div></div><div class="col-12 col-md-1" ><div class="form-group"><br><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div></div>');
	
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