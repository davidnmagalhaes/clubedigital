<?php
$page = 4;

include('config-header.php');

//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfa_consorcio WHERE clube='$clube'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);

$qsc = "SELECT * FROM rfs_socios WHERE clube='$clube' ORDER BY nome_socio ASC";
$socios = mysqli_query($link, $qsc) or die(mysqli_error($link));

$listasocios = "";
foreach($socios as $sc){
  $listasocios .= "<option value='".$sc['id_socio']."'>".$sc['nome_socio']."</option>";
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
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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


<!-- Adicionar campanha -->
<form action="proc_cd_consorcio.php" method="post">
<div class="modal fade" id="novoconsorcio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Criar Novo Consórcio</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <label>Nome do Consórcio:</label>
            <input type="text" class="form-control" name="nomeconsorcio" required>
          </div>
          
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
              <label>Data Inicial:</label>
              <input type="date" class="form-control" name="datainicial">
          </div>
          <div class="col-12 col-md-6">
              <label>Data Final:</label>
              <input type="date" class="form-control" name="datafinal">
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6">
              <label>Valor por Participante:</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">US</div>
                </div>
                <input type="text" class="form-control" name="valorconsorcio" placeholder="Valor">
              </div>
          </div>
          <div class="col-12 col-md-6">
              <label>Dia de Vencimento:</label>
            <input type="text" class="form-control" onkeypress="return somenteNumeros(event)" name="diavencimento" required>
          </div>
        </div>

         <input type="hidden" name="clube" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Continuar</button>
      </div>
    </div>
  </div>
</div>
</form>

            
 <div class="main-content">

            <div class="col-lg-12">

<div class="card" style="margin-top: 20px">
                                    <div class="card-header">
                                        <strong>Consórcios Paul Harris</strong> <a href="" role="button" class="btn btn-success" data-toggle="modal" data-target="#novoconsorcio">+ Novo Consórcio</a>
                                        
                                    </div>
                                    <div class="card-body card-block">
                  
                                      
<table class="table table-striped">
  <?php if($totalRows_lish <= 0){echo "<tr><td colspan='5' align='center'><strong>Não há consórcios cadastradas!</strong></td></tr>";}else{ ?>
  <thead>
    <tr>
      <th scope="col" style="text-align:center">Nome da Consórcio</th>
      <th scope="col" style="text-align:center">Participantes <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="Participantes com primeira parcela paga." style="color: #3889b9;"></i></th>
      <th scope="col" style="text-align:center">Período <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="O consórcio será cobra durante o período informado." style="color: #3889b9;"></th>
      <th scope="col" style="text-align:center">Valor/Meta <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="Valor e meta para pagamento da primeira parcela do consórcio." style="color: #3889b9;"></i></th>
      <th scope="col" style="text-align:center">Vencimento <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="Dia de vencimento do pagamento do consórcio." style="color: #3889b9;"></th>
      <th scope="col" style="text-align:center">Ativo no Site <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="O consórcio ativo será exibido no site." style="color: #3889b9;"></th>
      <th scope="col" style="text-align:center">Sorteio <i class="far fa-question-circle" data-toggle="tooltip" data-placement="top" title="O sorteio só é liberado após a meta da primeira parcela ser atingida." style="color: #3889b9;"></th>
      
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php while($row_lish = mysqli_fetch_array($lish)){ ?>
        <?php 
            $cdconsorcio = $row_lish['cod_consorcio'];

            $qcon = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND cod_consorcio='$cdconsorcio'";
            $con = mysqli_query($link, $qcon) or die(mysqli_error($link));
            $row_con = mysqli_fetch_array($con);
            $mesinicial = date('m',strtotime($row_con['data_inicial']));
            $anoinicial = date('Y',strtotime($row_con['data_inicial']));

            $qlic = "SELECT * FROM rfa_consorcio_pagamentos WHERE clube='$clube' AND cod_consorcio='$cdconsorcio' AND MONTH(data_vencimento)='$mesinicial' AND YEAR(data_vencimento)='$anoinicial' AND status_pagamento='1'";
            $lic = mysqli_query($link, $qlic) or die(mysqli_error($link));
            $totalRows_lic = mysqli_num_rows($lic);

            $qmaxins = "SELECT * FROM rfa_consorcio_inscritos WHERE clube='$clube' AND cod_consorcio='$cdconsorcio'";
            $maxins = mysqli_query($link, $qmaxins) or die(mysqli_error($link));
            $totalRows_maxins = mysqli_num_rows($maxins);
        ?>

<!-- Modal cadastro de participante-->   
<form method="post" action="proc_cd_consorcio_inscritos.php">     
<div class="modal fade" id="add<?php echo $row_lish['cod_consorcio']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Adicionar participante manualmente</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if($totalRows_maxins >= 10){?>
        <div class="alert alert-danger" role="alert">
          Este consórcio já está cheio! O número máximo permitido é de <strong>10 participantes</strong>!
        </div>
        <?php }else{?>

        <div class="row">
            <div class="col">
              <label>Escolha um sócio para inserir no consórcio:</label>
              <select name="socio" class="form-control" required>
                <option selected disabled>Selecione...</option>
                <?php echo $listasocios;?>
              </select>
            </div>
        </div>


        <input type="hidden" name="idconsorcio" value="<?php echo $row_lish['cod_consorcio']; ?>">
        <input type="hidden" name="clube" value="<?php echo $clube; ?>">
        <?php }?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Adicionar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal cadastro de participante-->  
</form>

<!-- Modal Sorteio -->
<div class="modal fade" id="sorteio<?php echo $row_lish['cod_consorcio']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sorteio do Consórcio <?php echo $row_lish['nome_consorcio']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="alert alert-warning" role="alert">
                <strong>Atenção:</strong><br>
                O sorteio escolhe participantes pagantes com parcelas quitadas sem inadimplências. Portanto, é importante que todos os participantes mantenham suas parcelas pagas em dia, evitando assim que fique de fora do sorteio.<br><strong>Obs.:</strong> Tenha certeza antes de realizar um sorteio, pois o procedimento é irreversível.
              </div>
            </div>
          </div>
          <div class="row" style="padding: 10px">
            <?php

            $cdcons = $row_lish['cod_consorcio'];
            $qcm = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND cod_consorcio='$cdcons'";
            $cm = mysqli_query($link, $qcm) or die(mysqli_error($link));
            $row_cm = mysqli_fetch_array($cm);

            $datainicial = $row_cm['data_inicial'];
            $datafinal = $row_cm['data_final'];

            $data1 = new DateTime($datainicial);
            $data2 = new DateTime($datafinal);
            //Anos e meses inicial e final
            $startYear = $data1->format('Y');
            $startMonth = $data1->format('m');

            $endYear = $data2->format('Y');
            $endMonth = $data2->format('m');

            $startDate = strtotime("$startYear/$startMonth/01");
            $endDate   = strtotime("$endYear/$endMonth/01");

            $currentDate = $endDate;

            while ($currentDate >= $startDate) {
                echo "<div class='col' style='text-align:center'><strong>".date('m/y',$startDate)."</strong></div>";
                $startDate = strtotime( date('Y/m/01/',$startDate).' +1 month');
            }?>
          </div>
          <div class="row" style="padding: 10px">
            <?php

            $inicialDate = strtotime("$startYear/$startMonth/01");
            $finalDate   = strtotime("$endYear/$endMonth/01");

            $totalDate = $endDate;

            while ($totalDate >= $inicialDate) {
                $messorteio = date('m',$inicialDate);
                $anosorteio = date('Y',$inicialDate);

                $qcolor = "SELECT * FROM rfa_consorcio_sorteio WHERE clube='$clube' AND cod_consorcio='$cdcons' AND mes_sorteio='$messorteio' AND ano_sorteio='$anosorteio'";
                $color = mysqli_query($link, $qcolor) or die(mysqli_error($link));
                $row_color = mysqli_num_rows($color);

                if($row_color > 0){
                  $color = "danger";
                }else{
                  $color = "success";
                }

                echo "<div class='col' style='padding:0; text-align:center'><a href='sortear_consorcio.php?clube=".$clube."&codconsorcio=".$row_lish['cod_consorcio']."&mes=".$messorteio."&ano=".$anosorteio."' class='btn btn-".$color."'><i class='fas fa-gift'></i></a></div>";
                $inicialDate = strtotime( date('Y/m/01/',$inicialDate).' +1 month');

            }?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal Sorteio -->

<!-- Editar -->
<form action="proc_edt_consorcio.php" method="post">
<div class="modal fade" id="edt<?php echo $row_lish['cod_consorcio']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Consórcio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <label>Nome do Consórcio</label>
            <input type="text" name="nomeconsorcio" class="form-control" value="<?php echo $row_lish['nome_consorcio']; ?>">
          </div>
        </div>
        <input type="hidden" name="idconsorcio" value="<?php echo $row_lish['cod_consorcio']; ?>">
        <input type="hidden" name="clube" value="<?php echo $clube; ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Atualizar</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Editar -->

    <tr>
      <td style="vertical-align:middle; text-align:center"><?php echo $row_lish['nome_consorcio']; ?></td>
      <td style="vertical-align:middle;text-align:center">
        <a href="consorcio-inscritos.php?idconsorcio=<?php echo $row_lish['cod_consorcio']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" class="btn btn-primary"><strong><?php echo $totalRows_lic;?></strong> de <strong>10</strong></a>
      </td>
      <td style="vertical-align:middle;text-align:center"><?php echo date('d/m/y',strtotime($row_lish['data_inicial'])); ?> a <?php echo date('d/m/y',strtotime($row_lish['data_final'])); ?></td>
      <td style="vertical-align:middle;text-align:center">U$ <?php echo number_format($totalRows_lic*$row_lish['valor_consorcio'],2,'.','.');?> / U$ <?php echo number_format(10*$row_lish['valor_consorcio'],2,'.','.'); ?></td>
      <td style="vertical-align:middle; text-align:center">Dia <?php echo $row_lish['dia_vencimento']; ?></td>
      <td style="vertical-align:middle;text-align:center">
        <form action="status-site-consorcio.php" method="POST" id="form<?php echo $row_lish['cod_consorcio'];?>"> 
          <input type="checkbox" <?php if($row_lish['status_site'] == 1){echo "checked";}else{} ?> data-toggle="toggle" onChange="document.forms['form<?php echo $row_lish['cod_consorcio'];?>'].submit();" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" name="statussite" value="<?php if($row_lish['status_site'] == 1){echo "0";}else{echo "1";} ?>">
          <input type="hidden" name="idconsorcio" value="<?php echo $row_lish['cod_consorcio'];?>">
          <input type="hidden" name="clube" value="<?php echo $clube;?>">
        </form>
      </td>
      <td style="vertical-align:middle;text-align:center"><button class="btn btn-success" <?php if($totalRows_lic < 10){echo "disabled";} ?> data-toggle="modal" data-target="#sorteio<?php echo $row_lish['cod_consorcio']; ?>"><i class="fas fa-gift"></i> SORTEAR</button></td>
    
      <td style="vertical-align:middle;text-align:center"><a href="#" data-toggle="modal" data-target="#add<?php echo $row_lish['cod_consorcio']; ?>"><i class="fas fa-plus-circle"></i></a></td>
      <td style="vertical-align:middle;text-align:center"><a href="#" data-toggle="modal" data-target="#edt<?php echo $row_lish['cod_consorcio']; ?>"><i class="fas fa-pen-alt"></i></a></td>
      <td style="vertical-align:middle;text-align:center"><a href="excluir-consorcio.php?idconsorcio=<?php echo $row_lish['id_campanha']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-trash"></i></a></td>
      
    </tr>
    <?php } ?>
  
  </tbody>
  <?php } ?>
</table>

                                        
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