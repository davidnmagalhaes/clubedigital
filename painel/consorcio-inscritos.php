<?php
$page = 4;

include('config-header.php');

$clube = $_GET['clube'];
$idconsorcio = $_GET['idconsorcio'];

$qcm = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND cod_consorcio='$idconsorcio'";
$cm = mysqli_query($link, $qcm) or die(mysqli_error($link));
$row_cm = mysqli_fetch_array($cm);

$datainicial = $row_cm['data_inicial'];
$datafinal = $row_cm['data_final'];
$diavencimento = str_pad($row_cm['dia_vencimento'] , 2 , '0' , STR_PAD_LEFT);
$valorconsorcio = $row_cm['valor_consorcio'];

//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfa_consorcio_inscritos INNER JOIN rfs_socios ON rfa_consorcio_inscritos.id_socio = rfs_socios.id_socio WHERE rfa_consorcio_inscritos.clube='$clube' AND rfa_consorcio_inscritos.cod_consorcio='$idconsorcio'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);

$data1 = new DateTime($datainicial);
$data2 = new DateTime($datafinal);

$intervalo = $data1->diff( $data2 );// Número de meses entre as duas datas

//Anos e meses inicial e final
$startYear = $data1->format('Y');
$startMonth = $data1->format('m');

$endYear = $data2->format('Y');
$endMonth = $data2->format('m');

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



</script>


<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>

    <script src="js/summernote-pt-BR.js"></script>
    <script src="js/summernote-ext-elfinder.js"></script>
 
    <!--Mask Money-->
<script language="javascript">   
function moeda(a, t) {
    var e = '.';
    var r = ',';
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
 

<style>
    .centralizar{text-align:center;}
</style>

</head>

<body >

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

<div class="row">
    <div class="col">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          Esta lista exibe todos os participantes, <strong>pagos e não pagos</strong>. O consórcio apenas permitirá a efetivação da participação do sócio após o pagamento da <strong>primeira parcela.</strong> Inadimplências durante o período do consórcio impedirá que o participante seja incluído em sorteios até que sejam regularizadas suas pendências.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 20px">
                                    <div class="card-header">
                                        <strong><a href="consorcio<?php echo $clube;?>" style="margin-right: 10px"><i class="fas fa-arrow-circle-left"></i></a> Participantes - </strong><strong style="color:#4272d7">Consórcio <?php echo $row_cm['nome_consorcio'];?></strong>
                                        
                                    </div>
                                    <div class="card-body card-block">
                  
                                      

  <?php if($totalRows_lish <= 0){echo "<div class='row'><div class='col'><strong>Não há inscritos!</strong></div></div>";}else{ ?>
  
    <div id="accordion">
        <?php while($row_lish = mysqli_fetch_array($lish)){ ?>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#<?php echo $row_lish['cod_inscrito']; ?>" aria-expanded="false" aria-controls="<?php echo $row_lish['cod_inscrito']; ?>">
          <strong><?php echo $row_lish['cod_inscrito']; ?></strong> - <?php echo $row_lish['nome_socio']; ?> 
          
        </button>
        
          <a href="excluir-consorcio-inscrito.php?idconsorcio=<?php echo $row_lish['cod_consorcio']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>&codinscrito=<?php echo $row_lish['cod_inscrito']; ?>"><i class="fas fa-trash"></i></a>
      </h5>
    </div>

    <div id="<?php echo $row_lish['cod_inscrito']; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <?php

$startDate = strtotime("$startYear/$startMonth/01");
$endDate   = strtotime("$endYear/$endMonth/01");

$currentDate = $endDate;

while ($currentDate >= $startDate) {
    echo "<th class='centralizar'>".date('m/y',$startDate)."</th>";
    $startDate = strtotime( date('Y/m/01/',$startDate).' +1 month');
}?>
            </tr>
            <tr>
                <?php
$inicialDate = strtotime("$startYear/$startMonth/01");
$finalDate   = strtotime("$endYear/$endMonth/01");

$totalDate = $finalDate;

while ($totalDate >= $inicialDate) {
    $ninscrito = $row_lish['cod_inscrito'];
    $namesocio = $row_lish['nome_socio'];
    $idsocio = $row_lish['id_socio'];
    $mes = date('m',$inicialDate);
    $ano = date('Y',$inicialDate);

    $qpay = "SELECT * FROM rfa_consorcio_pagamentos WHERE clube='$clube' AND cod_consorcio='$idconsorcio' AND MONTH(data_vencimento)='$mes' AND YEAR(data_vencimento)='$ano' AND cod_inscrito='$ninscrito';";
    $pay = mysqli_query($link, $qpay) or die(mysqli_error($link));
    $rows_pay = mysqli_fetch_array($pay);

    if($rows_pay['origem_pagamento'] == 'manual'){
        $origem = "Baixa Manual";
    }else{
        $origem = "Baixa Paghiper";
    }

    if($rows_pay['forma_pagamento'] == 'boleto'){
        $formapgto = "Boleto Bancário";
    }else{
        $formapgto = "Depósito Bancário";
    }

    $protocolo = $ninscrito;
    $data = date('Y-m-d');
    $hora = date('H:i:s');
    $urlSegundaVia = $rows_pay['url_segunda_via'];

    if($rows_pay['boleto_emitido'] == 0){
        $boletoemitido = "<strong>Emitir boleto:</strong> <a href='site/boleto-consorcio.php?clube=".$clube."&idconsorcio=".$idconsorcio."&idsocio=".$idsocio."&metodopagamento=boleto&protocolo=".$protocolo."&data=".$data."&hora=".$hora."&mesvenc=".$mes."&anovenc=".$ano."' target='_blank'><i class='fas fa-barcode' style='font-size: 30px'></a></i>";
    }else{
        $boletoemitido = "<strong>Boleto emitido:</strong> <a href='".$urlSegundaVia."' target='_blank'><i class='fas fa-barcode'></i> 2ª via</a>";
    }

    if($rows_pay['status_pagamento'] == 1){
         echo '
        <form action="proc_atualiza_consorcio.php" method="post">
            <div class="modal fade" id="'.$ninscrito.'-'.$mes.'-'.$ano.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Pagamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Nome do sócio:</strong> '.$namesocio.'<Br>
        <strong>Data de Vencimento:</strong> '.$diavencimento.'/'.$mes.'/'.$ano.'<br>
        <strong>Valor do consórcio:</strong> US$ '.number_format($valorconsorcio,2,'.',',').'<br>
        <strong>Origem de Pagamento:</strong> '.$origem.'<Br>
        <strong>Data do Pagamento:</strong> '. date('d/m/Y',strtotime($rows_pay['data_pagamento'])).'<Br>
        <strong>Forma de Pagamento:</strong> '.$formapgto.'<br>
        <strong>Valor pago:</strong> R$ '.number_format($rows_pay['valor_pagamento'],2,',','.').'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</form>
        ';

        echo "<td class='centralizar'><a href='#' class='btn btn-success' data-toggle='modal' data-target='#".$ninscrito."-".$mes."-".$ano."'>Pago</a></td>";
    }else{

        echo "
        <form action='proc_atualiza_consorcio.php' method='post'>
            <div class='modal fade' id='".$ninscrito."-".$mes."-".$ano."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Baixar pagamento manualmente</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        <strong>Nome do sócio:</strong> ".$namesocio."<Br>
        <strong>Data de Vencimento:</strong> ".$diavencimento."/".$mes."/".$ano."<br>
        <strong>Valor do consórcio:</strong> US$ ".number_format($valorconsorcio,2,'.',',')."<br>

        <div class='row' style='margin: 20px 0 25px 0;'>
            <div class='col'>
                ".$boletoemitido."
            </div>
        </div>

        <div class='row' style='margin-top: 15px'>
            <div class='col'>
                <label>Forma de Pagamento:</label>
                <select name='formapagamento' class='form-control' required>
                    <option value='boleto'>Boleto</option>
                    <option value='deposito'>Depósito</option>
                </select>
            </div>
        </div>
        <div class='row' style='margin-top: 15px'>
            <div class='col'>
            <label>Data de Pagamento:</label>
                <input type='date' name='datapagamento' class='form-control' value='".date('Y-m-d')."' required>
            </div>
        </div>
        <div class='row' style='margin-top: 15px'>
            <div class='col'>
            <label>Valor pago:</label>
                <div class='input-group mb-2'>
                <div class='input-group-prepend'>
                  <div class='input-group-text'>R$</div>
                </div>
                <input type='text' class='form-control' name='valorpagamento' placeholder='Valor convertido' onKeyPress='return(moeda(this,event))' required>
              </div>
            </div>
        </div>
      </div>
      <input type='hidden' name='clube' value='".$clube."'>
      <input type='hidden' name='codinscrito' value='".$ninscrito."'>
      <input type='hidden' name='codconsorcio' value='".$idconsorcio."'>
      <input type='hidden' name='vencimento' value='".$ano."-".$mes."-".$diavencimento."'>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
        <button type='submit' class='btn btn-primary'>Baixar Manualmente</button>
      </div>
    </div>
  </div>
</div>
</form>
        ";

        echo "<td class='centralizar'><strong><a href='#' class='btn btn-danger' data-toggle='modal' data-target='#".$ninscrito."-".$mes."-".$ano."'>Pendente</a></strong></td>";
    }

    $inicialDate = strtotime( date('Y/m/01/',$inicialDate).' +1 month');
}?>
            </tr>
            </thead>
        </table>
        </div>

        

      </div>
    </div>
  </div>
 <?php } ?>
</div>
    
  <?php } ?>


                                        
                                    </div>
                                </div>
                                <!-- END USER DATA-->

               
                               

                                         
                </div>
              
</div>
            

            <?php include("footer.php"); ?>
      
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

  


    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="js/main.js?versao=<?php echo rand(); ?>"></script>
  
  

</body>

</html>
<!-- end document-->