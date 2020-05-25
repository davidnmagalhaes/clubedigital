<?php
$page = 5;

include('config-header.php');

$qrh = "SELECT * FROM rfa_cr_solicitante WHERE clube='$clube'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);

$hoje = date('Y-m-d');
$semana = date('Y-m-d', strtotime($hoje. ' + 7 days'));
$mes = date('Y-m-d', strtotime($hoje. ' + 1 month'));

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
    <title><?php echo $nomeclube; ?></title>

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
        if(!confirm('Tem certeza que deseja remover esta solicitação?')){
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


 <div class="main-content">
            <div class="col-lg-12">
                <div class="user-data m-b-30">
									
									<h3 class="title-3 m-b-30">
                       <i class="fab fa-accessible-icon"></i>Solicitantes
									</h3>
										
<br>
<div class="row">
<div class="col">
<div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border" style="margin-left: 35px; margin-bottom: 15px;">
                                            <select class="js-select2" name="acao" data-toggle="tooltip" title="Selecione a ação que deseja executar.">
                                                <option value="" selected="selected">Ação</option>
                                                <option value="exc">Excluir</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
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
                                                    <td style="text-align:center">Solicitante</td>
                                                    <td style="text-align:center">Doador</td>
													<td style="text-align:center">E-mail</td>
                                                    <td style="text-align:center">Telefone</td>
                          							<td style="text-align:center">Celular</td>
                          							<td style="text-align:center">CPF</td>
                                                    <td style="text-align:center">Buscar Doador</td>
                                                    <td style="text-align:center">Informações</td>
                                                    <!--<td style="text-align:center">Editar</td>-->
                                                    <td style="text-align:center">Excluir</td>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if($totalRows_lish < 1){echo "<tr><td colspan='11' align='center'><strong>Não há solicitações!</strong></td></tr>";}else{?>
											                     <?php while($row_lish = mysqli_fetch_array($lish)){ 

                                                                    ?>


<!-- Modal Doador Encontrado -->
<div class="modal fade" id="doadorencontrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><h2>Doador encontrado</h2></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Saiba quem foi o doador abaixo:</p><br>
        <p>
            <?php 
                $iddoador = $row_lish['id_doador'];
                $qde = "SELECT * FROM rfa_cr_doador WHERE clube='$clube' AND id_doador='$iddoador'";
                $lide = mysqli_query($link, $qde) or die(mysqli_error($link));
                $row_lide = mysqli_fetch_array($lide);
            ?>
            <strong>Nome:</strong> <?php echo $row_lide['nome_doador'];?><br>
            <strong>E-mail:</strong> <?php echo $row_lide['email_doador'];?><br>
            <strong>Telefone:</strong> <?php echo $row_lide['fone_doador'];?><br>
            <strong>Celular:</strong> <?php echo $row_lide['cel_doador'];?><br>
            <strong>CPF:</strong> <?php echo $row_lide['cpf_doador'];?><br>
            <strong>RG:</strong> <?php echo $row_lide['rg_doador'];?><br>
            <strong>Endereço:</strong> <?php echo $row_lide['end_doador'].", ".$row_lide['num_doador'].", ".$row_lide['cid_doador'].", ".$row_lide['uf_doador'].", ".$row_lide['cep_doador'];?><br>
            <strong>Tipo de Cadeira:</strong> <?php if($row_lide['tipo_cadeira'] == "cadeira-rodas"){echo "Cadeira de Rodas";}else{echo "Cadeira de Banho";};?><br>
            <strong>Tempo de Uso:</strong> <?php echo $row_lide['tmp_uso_item'];?><br>
            <strong>Descrição:</strong> <?php echo $row_lide['desc_item'];?><br>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
       
      </div>
    </div>
  </div>
</div>
<!-- Modal Doador Encontrado -->



                                                <tr>
                                                    <td style="text-align:center">
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" name="checksolicitante[]" value="<?php echo $row_lish['id_solicitante'];?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>

                                                    <td style="text-align:center">
                                                        <div class="table-data__info">
                                                            <h6> <?php echo "<strong style='color: #007bff'>".$row_lish['nome_solicitante']."</strong>";?></h6>
                                                            
                                                        </div>
                                                    </td>

                                                    <td style="text-align:center">
                                                        <div class="table-data__info">
                                                            <h6> <?php if($row_lish['id_doador'] == 0){echo "<strong style='color: #ff0000'>Sem doador!</strong>";}else{echo "<a href='#' data-toggle='modal' data-target='#doadorencontrado'><strong style='color: #23a513'><i class='far fa-smile-beam' style='margin-right: 3px'></i>Doador encontrado!</strong></a>";} ?></h6>
                                                            
                                                        </div>
                                                    </td>

													                          <td style="text-align:center"> 
                                                        <div class="table-data__info">
                                                           
                                                            <span class="block-email" style="background: #e7f2ff">
                                                               <a href="mailto:<?php echo $row_lish['email_solicitante'];?>"><?php echo $row_lish['email_solicitante'];?></a>
                                                            </span>
                                                        </div>
                                                    </td>
													
                                                    <td style="text-align:center">
														                        <span class="block-email" style="background: #e7f2ff">
                                                          <?php echo $row_lish['fone_solicitante'];?>
                                                    </span>
													                          </td>

                                                    <td style="text-align:center">
                                                    <span class="block-email" style="background: #e7f2ff">
                                                          <?php echo "<a href='https://api.whatsapp.com/send?phone=55".str_replace(')','',str_replace('(','',str_replace('-','',$row_lish['cel_solicitante'])))."' target='_blank'>".$row_lish['cel_solicitante']."</a>";?>
                                                    </span>
                                                    </td>

													<td style="text-align:center">
                                                        <span class="block-email" style="background: #e7f2ff">
                                                            <?php echo $row_lish['cpf_solicitante'];?>
                                                        </span>
                                                    </td>

                                                    <td style="text-align:center">
                                                       <a href="doadores-cr.php?clube=<?php echo $clube;?>&id_solicitante=<?php echo $row_lish['id_solicitante'];?>">
                                                            <i class="fas fa-search"></i>
                                                        </a>
                                                    </td>

                                                    <td style="text-align:center">
                                                       <a href="mpdf/doc-solicitante.php?clube=<?php echo $clube;?>&protocolo=<?php echo $row_lish['protocolo_solicitante'];?>" target="_blank">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                    </td>
													
                                                    <!--<td style="text-align:center">
                                                       <a href="edt-socios.php?id_socio=<?php //echo $row_lish['id_socio'];?><?php //if($_GET['clube']){echo '&clube='.$clube;}?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                    </td>-->

													                           <td style="text-align:center">
                                                       <a href="excluir-solicitante-cr.php?id_solicitante=<?php echo $row_lish['id_solicitante'];?>&clube=<?php echo $clube; ?>" class="remove">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </td>

                                                </tr>
												
												

											<?php } }?>
										
											
											
                                            </tbody>
                                        </table>
                                    </div>
									
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


    <?php include("scripts-footer.php"); ?>
	
	

</body>
	<script type="text/javascript">
		SyntaxHighlighter.all()
	</script>
</html>
<!-- end document-->