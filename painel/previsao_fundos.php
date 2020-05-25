<?php
$page = 3;

include('config-header.php');

$mesfilter = $GET['mes_filter'];
$anofilter = $GET['ano_filter'];

if(isset($mesfilter) && isset($anofilter)){
$qr = "SELECT * FROM rfa_prev_fundos WHERE clube='$clube' AND MONTH(data_prev_fundos)='$mesfilter' AND YEAR(data_prev_fundos)='$anofilter' ORDER BY data_prev_fundos DESC";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}else{
   $qr = "SELECT * FROM rfa_prev_fundos WHERE clube='$clube' ORDER BY data_prev_fundos DESC";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis); 
}

$mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'Fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
);

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<!--Pergunta antes de ação-->
	<script language="JavaScript" type="text/javascript">

$(document).ready(function(){
    $("a.remove").click(function(e){
        if(!confirm('Tem certeza que deseja excluir esta receita?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
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
<script type="text/javascript" src="script/functions-prev-fundos.js"></script>
</head>

<body>
    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->

            
 <div class="main-content">
            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Fundos Previstos</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        
                                        <div class="rs-select2--light rs-select2--md">
										<form method="get" action="">
                                            <select class="js-select2" name="mesfilter">
											<option value="">Filtrar Mês</option>
                                                <?php 
                                                    for($i=1; $i<=12; $i++){
                                                        $ano = date("Y")."-".$i."-1";
                                                        $data = date('M',strtotime($ano));
                                                        echo "<option value='".$i."'>".$mes_extenso["$data"]."</option>";
                                                    }
                                                ?>
                                            </select>
										
                                            <div class="dropDownSelect2"></div>
                                            <?php if($_GET['clube']){?>
                                                <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                <?php } ?>
											
                                        </div>

                                        <div class="rs-select2--light rs-select2--md">
                                        
                                            <select class="js-select2" name="anofilter" onChange="this.form.submit()">
                                            <option value="">Filtrar Ano</option>
                                            <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                                            <option value="<?php echo date('Y')+1;?>"><?php echo date('Y')+1;?></option>
                                            </select>
                                        
                                            <div class="dropDownSelect2"></div>
                                            <?php if($_GET['clube']){?>
                                                <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                <?php } ?>
                                            </form>
                                        </div>

                                        
                                        <div class="rs-select2--light rs-select2--sm">
                                            
                                            <select class="js-select2" name="acao" id="acao" onChange="enviarMain();">
                                                <option selected="selected">Ação</option>
                                                <option value="1">Excluir</option>
                                                <option value="2">Duplicar</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="previsao_cd_fundos.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Adicionar</a>
                                        <!--<div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Exportar</option>
                                                <option value="">Opção 1</option>
                                                <option value="">Opção 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>-->
                                    </div>
                                </div>
								<?php if($totalRows_lis == 0){echo "<div class='row'><div class='col' style='text-align:center;'>Nenhum resultado encontrado!</div></div>";}else{?>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox" onClick="toggle(this)" id="select-all">
                                                        <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                
                                                
                                                <th>Descrição</th>
                                                <th>Data</th>
                                                
                                                <th>Valor</th>
                                                <th>Categoria</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="previsao-acao-fundos.php" method="post" id="mainForm">
                                                <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                <input type="hidden" name="tipoacao" id="tipoacao">
										<?php while($row_lis = mysqli_fetch_array($lis)){ ?>

                                            <tr class="tr-shadow">
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox" name="checklist[]" value="<?php echo $row_lis['id_prev_fundos'];?>">

                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                
                                                
                                                <td class="desc" contenteditable="true" data-old_value="<?php echo $row_lis['desc_prev_fundos']; ?>" onBlur="saveInlineEdit(this,'desc_prev_fundos','<?php echo $row_lis['id_prev_fundos']; ?>')" onClick="highlightEdit(this);" scope="row" ><?php echo $row_lis['desc_prev_fundos'];?></td>
                                                <td ><?php echo date("d/m/Y",strtotime($row_lis['data_prev_fundos']));?></td>
                                                
                                                <td contenteditable="true" data-old_value="<?php echo $row_lis['valor_prev_fundos']; ?>" onBlur="saveInlineEdit(this,'valor_prev_fundos','<?php echo $row_lis['id_prev_fundos']; ?>')" onClick="highlightEdit(this);" scope="row" ><?php echo number_format($row_lis['valor_prev_fundos'], 2, ',', '.');?></td>
                                                <td>
                                                    <?php 
                                                        $idcat = $row_lis['cat_prev_fundos'];
                                                        $qrct = "SELECT * FROM rfa_prev_categorias WHERE clube='$clube' AND id_categoria='$idcat'";
                                                        $lisct = mysqli_query($link, $qrct) or die(mysqli_error($link));
                                                        $row_lisct = mysqli_fetch_array($lisct);
                                                    ?>
                                                    <span style="width: 20px; height: 20px; background: <?php echo $row_lisct['cor_categoria'];?>; display:block;border-radius: 100%; float:left;">&nbsp;</span> <span style="margin-left: 10px"><?php echo $row_lisct['nome_categoria'];?></span>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <!--<button class="item" data-toggle="tooltip" data-placement="top" title="Enviar">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>-->
                                                        <a href="previsao_duplicar_fundos.php?idfundos=<?php echo $row_lis['id_prev_fundos'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" class="item" data-toggle="tooltip" data-placement="top" title="Duplicar"><i class="zmdi zmdi-copy"></i></a>

                                                        <a href="previsao_edt_fundos.php?idfundos=<?php echo $row_lis['id_prev_fundos'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" class="item" >
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                       <a href="previsao-excluir-fundos.php?idfundos=<?php echo $row_lis['id_prev_fundos'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" class="item remove" data-toggle="tooltip" data-placement="top" title="Deletar">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                        <!--<button class="item" data-toggle="tooltip" data-placement="top" title="Mais">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>-->
                                                    </div>
                                                </td>
                                            </tr>
											
											
											
											<tr class="spacer"></tr>
										<?php } ?>
											
										</form>
                                            
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
								<?php } ?>
                                <!-- END DATA TABLE -->
                            </div>
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
<script>
    function enviarMain(){
        var form = document.querySelector("#mainForm");
        var acao = document.querySelector("#acao");
        var tipoacao = document.querySelector("#tipoacao");

        tipoacao.value = acao.value;
        form.submit();
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

    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->