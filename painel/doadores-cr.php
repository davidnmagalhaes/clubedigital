<?php
$page = 5;

include('config-header.php');

if(isset($_GET['id_solicitante'])){
    $idsolicitante = $_GET['id_solicitante'];

$qbd = "SELECT * FROM rfa_cr_solicitante WHERE clube='$clube' AND id_solicitante='$idsolicitante'";
$libd = mysqli_query($link, $qbd) or die(mysqli_error($link));
$row_libd = mysqli_fetch_array($libd);

$qrh = "SELECT * FROM rfa_cr_doador WHERE clube='$clube' AND entrega_doador>=1 AND id_solicitante=0 ORDER BY data_doador, hora_doador";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$row_lish = mysqli_fetch_assoc($lish);
$totalRows_lish = mysqli_num_rows($lish);

}else{

$qrh = "SELECT * FROM rfa_cr_doador WHERE clube='$clube' ORDER BY data_doador, hora_doador";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$row_lish = mysqli_fetch_assoc($lish);
$totalRows_lish = mysqli_num_rows($lish);

}



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
        if(!confirm('Tem certeza que deseja excluir este doador?')){
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

            
 <div class="main-content">
            <div class="col-lg-12">
                <div class="user-data m-b-30">
									
									<h3 class="title-3 m-b-30">
                       <i class="fab fa-accessible-icon"></i>Doadores
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

<?php if(isset($_GET['id_solicitante'])){ ?>
<div class="row">
    <div class="col">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Atenção!</strong> Você está prestes a escolher um doador para a solicitação de <strong><?php echo $row_libd['nome_solicitante'];?></strong> referente ao protocolo <strong><?php echo $row_libd['protocolo_solicitante'];?>.</strong><br> Nesta lista são exibidos apenas doadores que já realizaram a entrega do item de doação ao clube.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    </div>
</div>
<?php } ?>
											
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
                                                    <td style="text-align:center">Doador</td>
                                                    <td style="text-align:center"><?php if(isset($_GET['id_solicitante'])){echo "Disponibilidade";}else{echo "Entrega";} ?></td>
													<td style="text-align:center">E-mail</td>
                                                    
                                                    <?php 
                                                    if(isset($_GET['id_solicitante'])){
                                                        echo '<td style="text-align:center">Cidade</td>';
                                                        echo '<td style="text-align:center">Estado</td>';
                                                        echo '<td style="text-align:center">CEP</td>';
                                                        echo "<td style='text-align:center'>Selecionar</td>";
                                                    }else{
                                                    ?>
                                                    <td style="text-align:center">Telefone</td>
                                                    <td style="text-align:center">Celular</td>
                                                    <td style="text-align:center">CPF</td>
                                                    <?php }?>
                                                    
                                                    <td style="text-align:center">Informações</td>
                                                    <?php if(isset($_GET['id_solicitante'])){}else{ ?>
                                                    <td style="text-align:center">Entregue?</td>
                                                    <!--<td style="text-align:center">Editar</td>-->
                                                    <td style="text-align:center">Excluir</td>
                                                    <?php } ?>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if($totalRows_lish < 1){echo "<tr><td colspan='10' align='center'><strong>Não há doador disponível!</strong></td></tr>";}else{?>
											                     <?php do{ ?>
                                                <tr>
                                                    <td style="text-align:center">
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" name="checkdoador[]" value="<?php echo $row_lish['id_doador'];?>">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>

                                                    <td style="text-align:center">
                                                        <div class="table-data__info">
                                                            <h6> <?php echo "<strong style='color: #007bff'>".$row_lish['nome_doador']."</strong>";?></h6>
                                                            
                                                        </div>
                                                    </td>

                                                    <td style="text-align:center">
                                                        <div class="table-data__info">
                                                            <h6> <?php if($row_lish['entrega_doador'] == 0){echo "<strong style='color: #ff0000'>Falta entregar!</strong>";}elseif(isset($_GET['id_solicitante']) && $row_lish['entrega_doador'] > 0){echo "<strong style='color: #23a513'><i class='far fa-smile-beam' style='margin-right: 3px'></i>Item Disponível!</strong>";}else{echo "<strong style='color: #23a513'><i class='far fa-smile-beam' style='margin-right: 3px'></i>Item Entregue!</strong>";} ?></h6>
                                                            
                                                        </div>
                                                    </td>

													                          <td style="text-align:center"> 
                                                        <div class="table-data__info">
                                                           
                                                            <span class="block-email" style="background: #e7f2ff">
                                                               <a href="mailto:<?php echo $row_lish['email_doador'];?>"><?php echo $row_lish['email_doador'];?></a>
                                                            </span>
                                                        </div>
                                                    </td>
													
                                                    <?php if(isset($_GET['id_solicitante'])){ ?>
                                                    <td style="text-align:center">
													<span class="block-email" style="background: #e7f2ff">
                                                          <?php echo $row_lish['cid_doador'];?>
                                                    </span>
													 </td>
                                                    <?php }else{?>
                                                    <td style="text-align:center">
                                                    <span class="block-email" style="background: #e7f2ff">
                                                          <?php echo $row_lish['fone_doador'];?>
                                                    </span>
                                                     </td>
                                                    <?php } ?>

                                                    <?php if(isset($_GET['id_solicitante'])){ ?>
                                                    <td style="text-align:center">
                                                    <span class="block-email" style="background: #e7f2ff">
                                                          <?php echo $row_lish['uf_doador'];?>
                                                    </span>
                                                    </td>
                                                     <?php }else{?>
                                                    <td style="text-align:center">
                                                    <span class="block-email" style="background: #e7f2ff">
                                                          <?php echo $row_lish['cel_doador'];?>
                                                    </span>
                                                    </td>
                                                    <?php } ?>

                                                    <?php if(isset($_GET['id_solicitante'])){ ?>
													<td style="text-align:center">
                                                    <span class="block-email" style="background: #e7f2ff">
                                                            <?php echo $row_lish['cep_doador'];?>
                                                    </span>
                                                    </td>
                                                    <?php }else{?>
                                                    <td style="text-align:center">
                                                    <span class="block-email" style="background: #e7f2ff">
                                                            <?php echo $row_lish['cpf_doador'];?>
                                                    </span>
                                                    </td>
                                                    <?php } ?>

                                                    <?php 
                                                    if(isset($_GET['id_solicitante'])){
                                                        echo "<td style='text-align:center'><a href='selecionar-doador.php?iddoador=".$row_lish['id_doador']."&clube=".$clube."&idsolicitante=".$_GET['id_solicitante']."' onsubmit='ShowLoading()'><i class='fas fa-hand-pointer' style='color:#1a9818'></i></a></td>";
                                                    }
                                                    ?>

                                                    <td style="text-align:center">
                                                       <a href="mpdf/doc-doador.php?clube=<?php echo $clube;?>&protocolo=<?php echo $row_lish['protocolo_doador'];?>" target="_blank">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                    </td>
													
                                                    <?php if(isset($_GET['id_solicitante'])){}else{ ?>

                                                    <td style="text-align:center">
                                                        <form action="entrega-item.php" method="post" id="entrega">
                                                       <input type="checkbox" <?php if($row_lish['entrega_doador'] == 1){echo "checked";}else{}?> data-toggle="toggle" onChange="this.form.submit()" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" name="statusentrega" value="<?php if($row_lish['entrega_doador'] == 1){echo "0";}else{echo "1";}?>" >
                                                       <input type="hidden" name="iddoador" value="<?php echo $row_lish['id_doador'];?>">
                                                       <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                        </form>
                                                    </td>

                                                    <!--<td style="text-align:center">
                                                       <a href="edt-socios.php?id_socio=<?php //echo $row_lish['id_socio'];?><?php //if($_GET['clube']){echo '&clube='.$clube;}?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                    </td>-->

													                           <td style="text-align:center">
                                                       <a href="excluir-doador.php?id_doador=<?php echo $row_lish['id_doador'];?>&clube=<?php echo $clube;?>" class="remove">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </td>
                                                    <?php } ?>

                                                </tr>
												
												

											<?php }while($row_lish = mysqli_fetch_assoc($lish));?>
										      <?php } ?>
											
											
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