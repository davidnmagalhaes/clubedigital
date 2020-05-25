<?php 
//Página Visão Geral
$page = 10;

include('config-header.php');

//$page1 = 1; //Página Visão Geral visualizada por todos
$page2= 2;
$page3 = 3;
$page4 = 4;
$page5 = 5;
$page6 = 6;
$page7 = 7;
$page8 = 8;
$page9 = 9;
$page10 = 10;
$page11 = 11;

//Níveis
$nivel_presidente = 2;
$nivel_secretario = 3;
$nivel_contador = 4;
$nivel_secretarioex = 5;
$nivel_tesoureiro = 6;

//Queries dos níveis
$sqnoti = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page2' AND clube = '$clube'";
$qnotificacao = mysqli_query($link, $sqnoti) or die(mysqli_error($link));

$sqfinan = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page3' AND clube = '$clube'";
$qfinan = mysqli_query($link, $sqfinan) or die(mysqli_error($link));

$sqsite = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page4' AND clube = '$clube'";
$qsite = mysqli_query($link, $sqsite) or die(mysqli_error($link));

$sqsocios = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page5' AND clube = '$clube'";
$qsocios = mysqli_query($link, $sqsocios) or die(mysqli_error($link));

$sqreun = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page6' AND clube = '$clube'";
$qreuniao = mysqli_query($link, $sqreun) or die(mysqli_error($link));

$sqloc = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page7' AND clube = '$clube'";
$qloc = mysqli_query($link, $sqloc) or die(mysqli_error($link));

$sqinteg = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page8' AND clube = '$clube'";
$qinteg = mysqli_query($link, $sqinteg) or die(mysqli_error($link));

$sqequipe = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page9' AND clube = '$clube'";
$qequipe = mysqli_query($link, $sqequipe) or die(mysqli_error($link));

$sqadmin = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page10' AND clube = '$clube'";
$qadmin = mysqli_query($link, $sqadmin) or die(mysqli_error($link));

$sqconfig = "SELECT * FROM rfa_acesso_paginas WHERE pagina_id = '$page11' AND clube = '$clube'";
$qconfig = mysqli_query($link, $sqconfig) or die(mysqli_error($link));



while($row_qnotificacao = mysqli_fetch_array($qnotificacao)){
$nac2 .= $row_qnotificacao['nivel_acesso'].",";
$cac2 .= $row_qnotificacao['consulta_acesso'].",";
}
$nacesso2 = explode(',', $nac2);
$cacesso2 = explode(',', $cac2);


while($row_qfinan = mysqli_fetch_array($qfinan)){
$nac3 .= $row_qfinan['nivel_acesso'].",";
$cac3 .= $row_qfinan['consulta_acesso'].",";
}
$nacesso3 = explode(',', $nac3);
$cacesso3 = explode(',', $cac3);

while($row_qsite = mysqli_fetch_array($qsite)){
$nac4 .= $row_qsite['nivel_acesso'].",";
$cac4 .= $row_qsite['consulta_acesso'].",";
}
$nacesso4 = explode(',', $nac4);
$cacesso4 = explode(',', $cac4);

while($row_qsocios = mysqli_fetch_array($qsocios)){
$nac5 .= $row_qsocios['nivel_acesso'].",";
$cac5 .= $row_qsocios['consulta_acesso'].",";
}
$nacesso5 = explode(',', $nac5);
$cacesso5 = explode(',', $cac5);

while($row_qreuniao = mysqli_fetch_array($qreuniao)){
$nac6 .= $row_qreuniao['nivel_acesso'].",";
$cac6 .= $row_qreuniao['consulta_acesso'].",";
}
$nacesso6 = explode(',', $nac6);
$cacesso6 = explode(',', $cac6);

while($row_qloc = mysqli_fetch_array($qloc)){
$nac7 .= $row_qloc['nivel_acesso'].",";
$cac7 .= $row_qloc['consulta_acesso'].",";
}
$nacesso7 = explode(',', $nac7);
$cacesso7 = explode(',', $cac7);

while($row_qinteg = mysqli_fetch_array($qinteg)){
$nac8 .= $row_qinteg['nivel_acesso'].",";
$cac8 .= $row_qinteg['consulta_acesso'].",";
}
$nacesso8 = explode(',', $nac8);
$cacesso8 = explode(',', $cac8);

while($row_qequipe = mysqli_fetch_array($qequipe)){
$nac9 .= $row_qequipe['nivel_acesso'].",";
$cac9 .= $row_qequipe['consulta_acesso'].",";
}
$nacesso9 = explode(',', $nac9);
$cacesso9 = explode(',', $cac9);

while($row_qadmin = mysqli_fetch_array($qadmin)){
$nac10 .= $row_qadmin['nivel_acesso'].",";
$cac10 .= $row_qadmin['consulta_acesso'].",";
}
$nacesso10 = explode(',', $nac10);
$cacesso10 = explode(',', $cac10);

while($row_qconfig = mysqli_fetch_array($qconfig)){
$nac11 .= $row_qconfig['nivel_acesso'].",";
$cac11 .= $row_qconfig['consulta_acesso'].",";
}
$nacesso11 = explode(',', $nac11);
$cacesso11 = explode(',', $cac11);

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
    <title>Permissões - Rotary Fortaleza Alagadiço</title>

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

		<style>
			.title-acc{width: 15%; text-align:left;}
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
			
							
							
			
			
            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Permissões de páginas</strong>
                                        <small>Vincule permissões aos tipos de usuários</small>
                                    </div>
                                    <div class="card-body card-block">
                                        
											
										
										<div class="accordion" id="accordionExample">

											<!-- Start - Notificação-->
										<form action="proc_permissoes.php" method="post">

											<input type="hidden" name="page" value="<?php echo $page2;?>">
										  <div class="card">
										    <div class="card-header" id="menu2">
										      <h5 class="mb-0">
										        <button class="btn btn-link title-acc" type="button" data-toggle="collapse" data-target="#notificacao" aria-expanded="true" aria-controls="notificacao">
										         <i class="fas fa-bell"></i> Notificações
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>

										    <div id="notificacao" class="collapse show" aria-labelledby="menu2" data-parent="#accordionExample">
										      <div class="card-body">
										        
										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso2[0] == $nivel_presidente){echo $cacesso2[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso2[0] == 1 && $nacesso2[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso2[1] == $nivel_secretario){echo $cacesso2[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso2[1] == 1 && $nacesso2[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso2[2] == $nivel_contador){echo $cacesso2[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso2[2] == 1 && $nacesso2[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso2[3] == $nivel_secretarioex){echo $cacesso2[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso2[3] == 1 && $nacesso2[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso2[4] == $nivel_tesoureiro){echo $cacesso2[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso2[4] == 1 && $nacesso2[4] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>

										      </div>
										    </div>
										  </div>
										</form>
										  <!-- Fim - Notificação-->

										  <!-- Start - Financeiro-->
										  <form action="proc_permissoes.php" method="post">
										  	<input type="hidden" name="page" value="<?php echo $page3;?>">
										  <div class="card">
										    <div class="card-header" id="menu3">
										      <h5 class="mb-0">
										        <button class="btn btn-link collapsed title-acc" type="button" data-toggle="collapse" data-target="#financeiro" aria-expanded="false" aria-controls="financeiro">
										          <i class="fas fa-dollar-sign"></i> Financeiro
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>
										    <div id="financeiro" class="collapse" aria-labelledby="menu3" data-parent="#accordionExample">
										      <div class="card-body">


										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso3[0] == $nivel_presidente){echo $cacesso3[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso3[0] == 1 && $nacesso3[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso3[1] == $nivel_secretario){echo $cacesso3[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso3[1] == 1 && $nacesso3[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso3[2] == $nivel_contador){echo $cacesso3[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso3[2] == 1 && $nacesso3[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso3[3] == $nivel_secretarioex){echo $cacesso3[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso3[3] == 1 && $nacesso3[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso3[4] == $nivel_tesoureiro){echo $cacesso3[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso3[4] == 1 && $nacesso3[4] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>


										      </div>
										    </div>
										  </div>
										</form>
										<!-- Fim - Financeiro-->

										<!-- Start - Site-->
										  <form action="proc_permissoes.php" method="post">
										  	<input type="hidden" name="page" value="<?php echo $page4;?>">
										  <div class="card">
										    <div class="card-header" id="menu4">
										      <h5 class="mb-0">
										        <button class="btn btn-link collapsed title-acc" type="button" data-toggle="collapse" data-target="#site" aria-expanded="false" aria-controls="site">
										          <i class="far fa-window-restore"></i> Site
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>
										    <div id="site" class="collapse" aria-labelledby="menu4" data-parent="#accordionExample">
										      <div class="card-body">


										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso4[0] == $nivel_presidente){echo $cacesso4[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso4[0] == 1 && $nacesso4[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso4[1] == $nivel_secretario){echo $cacesso4[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso4[1] == 1 && $nacesso4[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso4[2] == $nivel_contador){echo $cacesso4[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso4[2] == 1 && $nacesso4[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso4[3] == $nivel_secretarioex){echo $cacesso4[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso4[3] == 1 && $nacesso4[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso4[4] == $nivel_tesoureiro){echo $cacesso4[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso4[4] == 1 && $nacesso4[4] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>


										      </div>
										    </div>
										  </div>
										</form>
										<!-- Fim - Site-->

										<!-- Start - Sócios-->
										  <form action="proc_permissoes.php" method="post">
										  	<input type="hidden" name="page" value="<?php echo $page5;?>">
										  <div class="card">
										    <div class="card-header" id="menu5">
										      <h5 class="mb-0">
										        <button class="btn btn-link collapsed title-acc" type="button" data-toggle="collapse" data-target="#socios" aria-expanded="false" aria-controls="socios">
										          <i class="fas fa-users"></i> Sócios
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>
										    <div id="socios" class="collapse" aria-labelledby="menu5" data-parent="#accordionExample">
										      <div class="card-body">


										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso5[0] == $nivel_presidente){echo $cacesso5[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso5[0] == 1 && $nacesso5[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso5[1] == $nivel_secretario){echo $cacesso5[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso5[1] == 1 && $nacesso5[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso5[2] == $nivel_contador){echo $cacesso5[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso5[0] == 1 && $nacesso5[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso5[3] == $nivel_secretarioex){echo $cacesso5[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso5[3] == 1 && $nacesso5[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso5[4] == $nivel_tesoureiro){echo $cacesso5[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso5[4] == 1 && $nacesso5[4] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>


										      </div>
										    </div>
										  </div>
										</form>
										<!-- Fim - Sócios-->

										<!-- Start - Reuniões-->
										  <form action="proc_permissoes.php" method="post">
										  	<input type="hidden" name="page" value="<?php echo $page6;?>">
										  <div class="card">
										    <div class="card-header" id="menu6">
										      <h5 class="mb-0">
										        <button class="btn btn-link collapsed title-acc" type="button" data-toggle="collapse" data-target="#reunioes" aria-expanded="false" aria-controls="reunioes">
										          <i class="fas fa-handshake"></i> Reuniões
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>
										    <div id="reunioes" class="collapse" aria-labelledby="menu6" data-parent="#accordionExample">
										      <div class="card-body">


										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso6[0] == $nivel_presidente){echo $cacesso6[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso6[0] == 1 && $nacesso6[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso6[1] == $nivel_secretario){echo $cacesso6[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso6[1] == 1 && $nacesso6[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso6[2] == $nivel_contador){echo $cacesso6[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso6[2] == 1 && $nacesso6[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso6[3] == $nivel_secretarioex){echo $cacesso6[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso6[3] == 1 && $nacesso6[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso6[4] == $nivel_tesoureiro){echo $cacesso6[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso6[4] == 1 && $nacesso6[4] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>


										      </div>
										    </div>
										  </div>
										</form>
										<!-- Fim - Reuniões-->

										<!-- Start - Banco de C.R.-->
										  <form action="proc_permissoes.php" method="post">
										  	<input type="hidden" name="page" value="<?php echo $page7;?>">
										  <div class="card">
										    <div class="card-header" id="menu7">
										      <h5 class="mb-0">
										        <button class="btn btn-link collapsed title-acc" type="button" data-toggle="collapse" data-target="#localizar" aria-expanded="false" aria-controls="localizar">
										          <i class="fab fa-accessible-icon"></i> Banco de C.R.
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>
										    <div id="localizar" class="collapse" aria-labelledby="menu7" data-parent="#accordionExample">
										      <div class="card-body">


										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso7[0] == $nivel_presidente){echo $cacesso7[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso7[0] == 1 && $nacesso7[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso7[1] == $nivel_secretario){echo $cacesso7[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso7[1] == 1 && $nacesso7[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso7[2] == $nivel_contador){echo $cacesso7[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso7[2] == 1 && $nacesso7[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso7[3] == $nivel_secretarioex){echo $cacesso7[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso7[3] == 1 && $nacesso7[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso7[8] == $nivel_tesoureiro){echo $cacesso7[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso7[4] == 1 && $nacesso7[8] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>


										      </div>
										    </div>
										  </div>
										</form>
										<!-- Fim - Banco de C.R.-->

										<!-- Start - Integração-->
										  <form action="proc_permissoes.php" method="post">
										  	<input type="hidden" name="page" value="<?php echo $page8;?>">
										  <div class="card">
										    <div class="card-header" id="menu8">
										      <h5 class="mb-0">
										        <button class="btn btn-link collapsed title-acc" type="button" data-toggle="collapse" data-target="#integracao" aria-expanded="false" aria-controls="integracao">
										          <i class="fas fa-inbox"></i> Integração
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>
										    <div id="integracao" class="collapse" aria-labelledby="menu8" data-parent="#accordionExample">
										      <div class="card-body">


										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso8[0] == $nivel_presidente){echo $cacesso8[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso8[0] == 1 && $nacesso8[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso8[1] == $nivel_secretario){echo $cacesso8[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso8[1] == 1 && $nacesso8[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso8[2] == $nivel_contador){echo $cacesso8[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso8[2] == 1 && $nacesso8[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso8[3] == $nivel_secretarioex){echo $cacesso8[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso8[3] == 1 && $nacesso8[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso8[4] == $nivel_tesoureiro){echo $cacesso8[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso8[4] == 1 && $nacesso8[4] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>


										      </div>
										    </div>
										  </div>
										</form>
										<!-- Fim - Integração-->

										<!-- Start - Equipe-->
										  <form action="proc_permissoes.php" method="post">
										  	<input type="hidden" name="page" value="<?php echo $page9;?>">
										  <div class="card">
										    <div class="card-header" id="menu9">
										      <h5 class="mb-0">
										        <button class="btn btn-link collapsed title-acc" type="button" data-toggle="collapse" data-target="#equipe" aria-expanded="false" aria-controls="equipe">
										          <i class="far fa-address-book"></i> Equipe
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>
										    <div id="equipe" class="collapse" aria-labelledby="menu9" data-parent="#accordionExample">
										      <div class="card-body">


										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso9[0] == $nivel_presidente){echo $cacesso9[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso9[0] == 1 && $nacesso9[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso9[1] == $nivel_secretario){echo $cacesso9[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso9[1] == 1 && $nacesso9[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso9[2] == $nivel_contador){echo $cacesso9[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso9[2] == 1 && $nacesso9[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso9[3] == $nivel_secretarioex){echo $cacesso9[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso9[3] == 1 && $nacesso9[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso9[4] == $nivel_tesoureiro){echo $cacesso9[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso9[4] == 1 && $nacesso9[4] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>


										      </div>
										    </div>
										  </div>
										</form>
										<!-- Fim - Equipe-->

										

										<!-- Start - Configurações-->
										  <form action="proc_permissoes.php" method="post">
										  	<input type="hidden" name="page" value="<?php echo $page11;?>">
										  <div class="card">
										    <div class="card-header" id="menu11">
										      <h5 class="mb-0">
										        <button class="btn btn-link collapsed title-acc" type="button" data-toggle="collapse" data-target="#configuracoes" aria-expanded="false" aria-controls="configuracoes">
										         <i class="fas fa-wrench"></i> Configurações
										          <button class="btn btn-primary" type="submit" style="margin-left: 30px;">Atualizar</button>
										        </button>
										      </h5>
										    </div>
										    <div id="configuracoes" class="collapse" aria-labelledby="menu11" data-parent="#accordionExample">
										      <div class="card-body">


										        <div class="row">
										        	<div class="col">
												      	<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="presidente" value="<?php if($nacesso11[0] == $nivel_presidente){echo $cacesso11[0];}  ?>" onclick="alteraValor(this)" <?php if($cacesso11[0] == 1 && $nacesso11[0] == $nivel_presidente){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Presidente
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretario" value="<?php if($nacesso11[1] == $nivel_secretario){echo $cacesso11[1];}  ?>" onclick="alteraValor(this)" <?php if($cacesso11[1] == 1 && $nacesso11[1] == $nivel_secretario){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="contador" value="<?php if($nacesso11[2] == $nivel_contador){echo $cacesso11[2];}  ?>" onclick="alteraValor(this)" <?php if($cacesso11[2] == 1 && $nacesso11[2] == $nivel_contador){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Contador(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="secretarioex" value="<?php if($nacesso11[3] == $nivel_secretarioex){echo $cacesso11[3];}  ?>" onclick="alteraValor(this)" <?php if($cacesso11[3] == 1 && $nacesso11[3] == $nivel_secretarioex){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Secretário(a) Executivo(a)
														  </label>
														</div>
													</div>

													<div class="col">
														<div class="form-check">
														  <input class="form-check-input" type="checkbox" name="tesoureiro" value="<?php if($nacesso11[4] == $nivel_tesoureiro){echo $cacesso11[4];}  ?>" onclick="alteraValor(this)" <?php if($cacesso11[4] == 1 && $nacesso11[4] == $nivel_tesoureiro){echo 'checked';} ?>>
														  <label class="form-check-label" for="defaultCheck1">
														    Tesoureiro(a)
														  </label>
														</div>
													</div>
												</div>


										      </div>
										    </div>
										  </div>
										</form>
										<!-- Fim - Configurações-->

										</div>
                                        
                                    </div>
                                </div>
                            </div>
							
							
		
							
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    <script>
    	function alteraValor(obj){
    		
    		if(obj.checked){
    			obj.value = 1;
    		}
    		else{
    			obj.value = 0;
    		}
    	}
    </script>

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