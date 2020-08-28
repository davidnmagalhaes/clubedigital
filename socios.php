<?php
$page = 5;
$search = $_GET['search'];

include('config-header.php');
include('verifica-mensalidade.php');

$qcmb = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$camb = mysqli_query($link, $qcmb) or die(mysqli_error($link));
$row_camb = mysqli_fetch_assoc($camb);
$cambio = $row_camb['cambio']; 

if(empty($search)){
//Seleciona todos os sócios representativos
$qr = "SELECT * FROM rfs_socios WHERE clube='$clube' AND categoria_socio='rp' ORDER BY nome_socio ASC";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis);
}else{
//Seleciona todos os sócios representativos
$qr = "SELECT * FROM rfs_socios WHERE clube='$clube' AND categoria_socio='rp' AND nome_socio LIKE '%".$search."%' ORDER BY nome_socio ASC";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis);
}

if(empty($search)){
//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfs_socios WHERE clube='$clube' AND categoria_socio='hn' ORDER BY nome_socio ASC";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);
}else{
//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfs_socios WHERE clube='$clube' AND categoria_socio='hn' AND nome_socio LIKE '%".$search."%' ORDER BY nome_socio ASC";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);
}

$hoje = date('Y-m-d');
$semana = date('Y-m-d', strtotime($hoje. ' + 7 days'));
$mes = date('Y-m-d', strtotime($hoje. ' + 1 month'));

if($_GET['hoje'] == "hoje"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.id_conta WHERE rfa_pagar.data_pagar='$hoje' AND rfa_pagar.user='$user'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "semana"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.id_conta WHERE rfa_pagar.data_pagar<'$semana' AND rfa_pagar.user='$user'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "mes"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.id_conta WHERE rfa_pagar.data_pagar<'$mes' AND rfa_pagar.user='$user'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis);
}

$s = "SELECT * FROM rfa_tipo_cob WHERE clube='$clube'";
$tipocob = mysqli_query($link, $s) or die(mysqli_error($link));
$row_tipocob = mysqli_fetch_assoc($tipocob);
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
    <title>Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

<!--Pergunta antes de ação-->
	<script language="JavaScript" type="text/javascript">

$(document).ready(function(){
    $(".remove").click(function(e){
        if(!confirm('Tem certeza que deseja emitir boleto(s)?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

<script language="JavaScript" type="text/javascript">

$(document).ready(function(){
    $("a.exclui").click(function(e){
        if(!confirm('Tem certeza que deseja excluir este socio(a)?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
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

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</head>

<body >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form action="proc_cd_tipo_cob.php" method="post" runat="server"  onsubmit="ShowLoading()">
  <input type="hidden" name="user" value="<?php echo $_SESSION['id_usuario'];?>">	
  <input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar tipo de cobrança <a href="edt-tipo-cob.php<?php echo '?clube='.$clube;?>" class="badge badge-danger">Editar</a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
                      <div class="col">
                        <div class="alert alert-primary" role="alert">
                          Deseja que esta cobrança tenha conversão de <strong>DÓLAR(U$)</strong> para <strong>REAL(R$)</strong>?<br>
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="converter" id="converter1" value="0" onchange="trocaMoeda();" checked>
                          <label class="form-check-label" for="exampleRadios1">
                            <strong>Não</strong>, continuar em real sem a conversão.
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="converter" id="converter2" value="1" onchange="trocaMoeda();">
                          <label class="form-check-label" for="exampleRadios2">
                            <strong>Sim</strong>, converter em real com base no <span style="text-decoration: underline;" data-toggle="tooltip"  title="Câmbio atual de R$ <?php echo number_format($cambio,2,',','.'); ?>">câmbio</span>.
                          </label>
                        </div>

                        </div>
                      </div>
                    </div>
        
		<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="descricao" class=" form-control-label">Descrição:</label>
												<input type="text" name="descricao" id="descricao" class="form-control" required placeholder="Digite a descrição. Max 200 caractéres">
											
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="email" class=" form-control-label">Tipo de Boleto:</label>
												<select name="tipoboleto" class="form-control">
													<option value="boletoCarne">Carnê</option>
													<option value="boletoA4">A4</option>
												</select>
											
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="email" class=" form-control-label">Aceitar pagamento até:</label>
												<select name="pagamentoate" class="form-control">
													<option value="0">Nenhum</option>
													<option value="5">5 dias após vencimento</option>
													<option value="10">10 dias após vencimento</option>
													<option value="15">15 dias após vencimento</option>
													<option value="20">20 dias após vencimento</option>
													<option value="25">25 dias após vencimento</option>
													<option value="30">30 dias após vencimento</option>
												</select>
											
											</div>
										</div>
							
										</div>
										
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="parcelas" class="form-control-label">Número de parcelas:</label>
												<select name="parcelas" class="form-control">
													<option value="1">1 parcela</option>
													<option value="2">2 parcelas</option>
													<option value="3">3 parcelas</option>
													<option value="4">4 parcelas</option>
													<option value="5">5 parcelas</option>
													<option value="6">6 parcelas</option>
													<option value="7">7 parcelas</option>
													<option value="8">8 parcelas</option>
													<option value="9">9 parcelas</option>
													<option value="10">10 parcelas</option>
													<option value="11">11 parcelas</option>
													<option value="12">12 parcelas</option>
												</select>
											</div>
										</div>
										
										<div class="col-12 col-md-4">
											<label for="form-control-label">Valor da parcela:</label>
										  <div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text"><input type="text" id="md" value="R$" style="width: 30px; background: none;"></div>
											</div>
											
											<input type="text" class="form-control" name="valor" placeholder="Em real" id="valor" onKeyPress="return(moeda(this,'.',',',event))">
										  </div>
										</div>
										
										
										<div class="col-12 col-md-4">
											<label for="form-control-label">Desconto até o vencimento:</label>
										  <div class="input-group mb-2">
											<div class="input-group-prepend">
											  <div class="input-group-text">%</div>
											</div>
											<input type="text" class="form-control" name="desconto" placeholder="">
										  </div>
										</div>
							
										</div>
										
										
										<div class="row">
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="multa" class="form-control-label">Aplicar multa:</label>
												<select name="multa" class="form-control">
													<option value="0">Não</option>
													<option value="1">1%</option>
													<option value="2">2% (Limite máximo de acordo com o artigo 52 do CDC)</option>
													
												</select>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="juros" class=" form-control-label">Aplicar juros:</label>
												<select name="juros" class="form-control">
													<option value="0">Não</option>
													<option value="true">1% de juros máximo ao mês</option>
													
													
												</select>
											
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="form-group">
												<label for="juros" class=" form-control-label" required>Vencimento:</label>
												<input type="date" name="vencimento" class="form-control">
											
											</div>
										</div>
										
							
										</div>

                    
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
	</form>
  </div>
</div>

            
 <div class="main-content">
            <div class="col-lg-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    
										
									
									<form action="emite-mens-socios-mes.php" method="post" runat="server" onsubmit="ShowLoading()">
									<h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-balance-wallet"></i>Sócios
									<a href="cd_socios.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" role="button" class="btn btn-success btrespons">
                                            <i class="fas fa-plus"></i> Sócio</a>									
									<a href="#" role="button" class="btn btn-primary btrespons" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-plus"></i> Cobrança</a> 
									<button class="btn btn-danger remove btrespons" onclick="showMainForm()" type="submit" data-toggle="tooltip" title="Esta funcionalidade emite todos os boletos do mês referentes aos sócios marcados abaixo.">Emitir boleto(s)</button> </h3>
										
<br>
<div class="row">
<div class="col">
<div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border" style="margin-left: 35px">
                                            <select class="js-select2" name="mes" data-toggle="tooltip" title="Selecione o mês que deseja emitir todos os boletos dos sócios selecionados">
                                                <option value="" selected="selected">Mês</option>
                                                <option value="1">Janeiro</option>
                                                <option value="2">Fevereiro</option>
												<option value="3">Março</option>
												<option value="4">Abril</option>
												<option value="5">Maio</option>
												<option value="6">Junho</option>
												<option value="7">Julho</option>
												<option value="8">Agosto</option>
												<option value="9">Setembro</option>
												<option value="10">Outubro</option>
												<option value="11">Novembro</option>
												<option value="12">Dezembro</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>

                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border" style="margin-left: 35px">
                                            <select class="js-select2" name="ano" data-toggle="tooltip" title="Selecione o ano que deseja emitir todos os boletos dos sócios selecionados">
                                                <option value="" selected="selected">Ano</option>
                                                <?php 
                                                  $a = date('Y');
                                                  $b = $a + 1;

                                                  for($i=$a;$i<=$b;$i++){
                                                    echo "<option value='".$i."'>".$i."</option>";
                                                  }
                                                ?>
                                                
                        
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>

										<div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border " style="margin-left: 15px">
                                            <select name="tipo-cobranca" class="js-select2" required>
											<option value="" disable selected>Cobrança</option>
											<?php do{?>
												<option value="<?php echo $row_tipocob['id_cob'];?>" ><?php echo $row_tipocob['descricao_cob'];?></option>
											<?php }while($row_tipocob = mysqli_fetch_assoc($tipocob));?>
												
											</select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
										
										 <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
      <label class="sr-only" for="inlineFormInputGroup">Usuário</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">R$</div>
        </div>
		
       
	 <input type="text" name="valordif" class="form-control" placeholder="Valor especial" onKeyPress="return(moeda(this,'.',',',event))" data-toggle="tooltip" title="* (Opcional) - Aqui você pode digitar um novo valor para o mês dos sócios selecionados.">

      </div>
    </div>
	
	<div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
      <label class="sr-only" for="inlineFormInputGroup">Usuário</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">R$</div>
        </div>
		
       
	 <input type="text" name="descdif" class="form-control" placeholder="Desconto especial" onKeyPress="return(moeda(this,'.',',',event))" data-toggle="tooltip" title="* (Opcional) - Aqui você pode digitar novo valor de desconto para os sócios selecionados.">

      </div>
    </div>

    <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border ">
      <label class="sr-only" for="inlineFormInputGroup">Usuário</label>
      <div class="input-group mb-2" style="width: 240px">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
        </div>
		
       
	 <input type="date" name="vencdif" class="form-control" placeholder="Vencimento especial" data-toggle="tooltip" title="* (Opcional) - Aqui você pode digitar novo vencimento para os sócios selecionados.">

      </div>
    </div>
	

	
										<div  style="margin-left: 15px">
                                        </div>
</div>
</div>
											
									<input type="hidden" name="user" value="<?php echo $_SESSION['id_usuario'];?>">	
									<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
									
                                    <!--<div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">Todos</option>
                                                <option value="">Itaú</option>
                                                <option value="">Bradesco</option>
												<option value="">Banco do Brasil</option>
												<option value="">Santander</option>
												<option value="">Caixa</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <select class="js-select2 au-select-dark" name="time">
                                                <option selected="selected">Todos</option>
                                                <option value="">Corrente</option>
                                                <option value="">Poupança</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>-->
                                    <div class="table-responsive ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" onClick="toggle(this)" id="select-all">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>Sócio</td>
													<td>E-mail</td>
													
                                                    <td>Telefone</td>
													<td>Vencimento</td>
													<td>Mensalidade</td>
                          <td>Cobrança</td>
                          <td>Ativo?</td>
                                                    <td colspan="5" align="center"><?php echo "<strong style='margin-right: 5px; color: #ff0000;'>Total de sócios: </strong>".$totalRows_lis;?></td>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if($totalRows_lish <= 0){}else{?>
											<?php while($row_lish = mysqli_fetch_array($lish)){ ?>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" name="checksocios[]" value="<?php echo $row_lish['id_socio'];?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6> <?php echo "<strong style='color: #007bff' data-toggle='tooltip' title='Sócio Honorário'>".$row_lish['nome_socio']."</strong>";?></h6>
                                                            
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="table-data__info">
                                                           
                                                            <span class="block-email" style="background: #e7f2ff">
                                                               <a href="mailto:<?php echo $row_lish['email_socio'];?>"><?php echo $row_lish['email_socio'];?></a>
                                                            </span>
                                                        </div>
                                                    </td>
													
                                                    <td>
														<span class="block-email" style="background: #e7f2ff">
                                                               <?php echo $row_lish['telefone_socio'];?>
                                                          </span>
													</td>
                                                    <td>
                                                        <span class="block-email" style="background: #e7f2ff">
                                                               Dia <?php echo $row_lish['mensalidade_diavenc'];?>
                                                          </span>
                                                    </td>
													<td>
                                                        <span class="block-email" style="background: #e7f2ff">
                                                             R$ <?php echo number_format($row_lish['mensalidade_valor'],2,',','.');?>
                                                          </span>
                                                    </td>

                                                    <td style="text-align:center">
                                                        <form action="entrega-item.php" method="post" id="entrega">
                                                       <input type="checkbox" data-toggle="toggle" onChange="this.form.submit()" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" name="statusentrega" >
                                                       
                                                       <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                        </form>
                                                    </td>

                                                    <td style="text-align:center">
                                                        <form action="entrega-item.php" method="post" id="entrega">
                                                       <input type="checkbox" data-toggle="toggle" onChange="this.form.submit()" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" name="statusentrega" >
                                                       
                                                       <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                        </form>
                                                    </td>
													
                                                    <td>
                                                       <a href="edt-socios.php?id_socio=<?php echo $row_lish['id_socio'];?><?php if($_GET['clube']){echo '&clube='.$clube;}?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                       <a href="crop-socios.php?cod_usuario=<?php echo $row_lish['ref_socio'];?><?php if($_GET['clube']){echo '&clube='.$clube;}?>" data-toggle="tooltip" title="Trocar imagem">
                                                            <i class="far fa-image"></i>
                                                        </a>
                                                    </td>
													<td>
                                                       <a href="excluir-socio.php?id_socio=<?php echo $row_lish['id_socio'];?><?php if($_GET['clube']){echo '&clube='.$clube;}?>" class="exclui">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </td>
													<td>
                                                       <a href="mensalidades.php?idsoc=<?php echo $row_lish['id_socio'];?>&filtroano=<?php echo date('Y');?><?php if($_GET['clube']){echo '&clube='.$clube;}?>" >
                                                           <i class="zmdi zmdi-money"></i>
                                                        </a>
                                                    </td>
                                                </tr>
												
												

											<?php }?>
											<?php } ?>
											
											<?php if($totalRows_lis <= 0){}else{?>
											<?php while($row_lis = mysqli_fetch_assoc($lis)){ ?>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" name="checksocios[]" value="<?php echo $row_lis['id_socio'];?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?php echo $row_lis['nome_socio'];?></h6>
                                                            
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="table-data__info">
                                                           
                                                            <span class="block-email">
                                                               <a href="mailto:<?php echo $row_lis['email_socio'];?>"><?php echo $row_lis['email_socio'];?></a>
                                                            </span>
                                                        </div>
                                                    </td>
													
                                                    <td>
														<span class="block-email">
                                                               <?php echo $row_lis['telefone_socio'];?>
                                                          </span>
													</td>
                                                    <td>
                                                        <span class="block-email">
                                                               Dia <?php echo $row_lis['mensalidade_diavenc'];?>
                                                          </span>
                                                    </td>
													<td>
                                                        <span class="block-email">
                                                             R$ <?php echo number_format($row_lis['mensalidade_valor'],2,',','.');?>
                                                          </span>
                                                    </td>

                                                    <td style="text-align:center">
                                                        <form action="status-cobranca.php" method="post" id="form<?php echo $row_lis['id_socio'];?>">
                                                       <input type="checkbox" <?php if($row_lis['status_cob'] == 1){echo "checked";}else{} ?> data-toggle="toggle" onChange="document.forms['form<?php echo $row_lis['id_socio'];?>'].submit();" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" name="statuscob" value="<?php if($row_lis['status_cob'] == 1){echo "0";}else{echo "1";} ?>">
                                                       <input type="hidden" name="idsocio" value="<?php echo $row_lis['id_socio'];?>">
                                                       <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                        </form>
                                                    </td>

                                                    <td style="text-align:center">
                                                        <form action="status-socio.php" method="post" id="form<?php echo $row_lis['id_socio'];?>1">
                                                       <input type="checkbox" <?php if($row_lis['status_socio'] == 1){echo "checked";}else{} ?> data-toggle="toggle" onChange="this.form.submit()" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" name="statussocio" value="<?php if($row_lis['status_socio'] == 1){echo "0";}else{echo "1";} ?>">
                                                       <input type="hidden" name="idsocio" value="<?php echo $row_lis['id_socio'];?>">
                                                       <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                        </form>
                                                    </td>
													
                                                    <td>
                                                       <a href="edt-socios.php?id_socio=<?php echo $row_lis['id_socio'];?><?php if($_GET['clube']){echo '&clube='.$clube;}?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                       <a href="crop-socios.php?cod_usuario=<?php echo $row_lis['ref_socio'];?><?php if($_GET['clube']){echo '&clube='.$clube;}else{echo '&clube='.$clube;}?>" data-toggle="tooltip" title="Trocar imagem">
                                                            <i class="far fa-image"></i>
                                                        </a>
                                                    </td>
													<td>
                                                       <a href="excluir-socio.php?id_socio=<?php echo $row_lis['id_socio'];?><?php if($_GET['clube']){echo '&clube='.$clube;}?>" class="exclui">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </td>
													<td>
                                                       <a href="mensalidades.php?idsoc=<?php echo $row_lis['id_socio'];?>&filtroano=<?php echo date('Y');?><?php if($_GET['clube']){echo '&clube='.$clube;}?>" >
                                                           <i class="zmdi zmdi-money"></i>
                                                        </a>
                                                    </td>
                                                </tr>
												
												

											<?php }?>
											<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
									</form>
                                    <!--<div class="user-data__footer">
                                        <button class="au-btn au-btn-load">Ver mais</button>
                                    </div>-->
                                </div>
                                <!-- END USER DATA-->
                            </div>
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>



<script>
  function trocaMoeda(){
      var naoconverte = document.querySelector("#converter1");
      var converte = document.querySelector("#converter2");
      var moeda = document.querySelector("#md");
      var valor = document.querySelector("#valor");
      if(converte.checked){
        moeda.value = "U$";
        valor.placeholder = "Em dólar"
      }else{
        moeda.value = "R$";
        valor.placeholder = "Em real"
      }
  }

</script>

<script>
// Para selecionar todos os checkboxes dos sócios
		$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
	</script>

<script>


		$('input[name="radios"]').change(function () {
    if ($('input[name="radios"]:checked').val() === "manual") {
       
		 $('.exibedatapagamento').show();
    } else {
        $('.exibedatapagamento').hide();
    }
});
	</script>
	
	

    <?php include("scripts-footer.php"); ?>
	
	

</body>
	<script type="text/javascript">
		SyntaxHighlighter.all()
	</script>
</html>
<!-- end document-->