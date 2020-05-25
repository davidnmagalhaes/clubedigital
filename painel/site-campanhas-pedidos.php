<?php
$page = 4;

include('config-header.php');

$clube = $_GET['clube'];
$idcampanha = $_GET['idcampanha'];

$qcm = "SELECT * FROM rfa_campanhas WHERE clube='$clube' AND cod_campanha='$idcampanha'";
$cm = mysqli_query($link, $qcm) or die(mysqli_error($link));
$row_cm = mysqli_fetch_array($cm);

//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfa_campanhas_pedidos WHERE clube='$clube' AND cod_campanha='$idcampanha'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);


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

<div class="card" style="margin-top: 20px">
                                    <div class="card-header">
                                        <strong>Doações - </strong><strong style="color:#4272d7">Campanha <?php echo $row_cm['nome_campanha'];?></strong>
                                        
                                    </div>
                                    <div class="card-body card-block">
                  
                                      
<table class="table table-striped">
  <?php if($totalRows_lish <= 0){echo "<tr><td colspan='5' align='center'><strong>Não há doações!</strong></td></tr>";}else{ ?>
  <thead>
    <tr>
      <th scope="col" style="text-align:center">Protocolo</th>
      <th scope="col" style="text-align:center">Data</th>
      <th scope="col" style="text-align:center">Tipo</th>
      <th scope="col" style="text-align:center">Nome</th>
      <th scope="col" style="text-align:center">CPF</th>
      <th scope="col" style="text-align:center">E-mail</th>
      <th scope="col" style="text-align:center"></th>
      <th scope="col" style="text-align:center">Status</th>
      <th scope="col" style="text-align:center"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php while($row_lish = mysqli_fetch_array($lish)){ ?>
    <tr>
    
      
      <td style="vertical-align:middle; text-align:center"><?php echo $row_lish['protocolo_pedido']; ?></td>
      <td style="vertical-align:middle; text-align:center"><?php echo date('d/m/Y',strtotime($row_lish['data']))." às ".date('H:i:s',strtotime($row_lish['hora'])); ?></td>
      <td style="vertical-align:middle; text-align:center"><?php if($row_lish['tipodoacao_pedido'] == 'valor'){echo "Valor";}elseif($row_lish['tipodoacao_pedido'] == 'item'){echo "Item";}else{echo "Ambos";} ?></td>
      <td style="vertical-align:middle; text-align:center"><?php echo $row_lish['nome_pedido']; ?></td>
      <td style="vertical-align:middle; text-align:center"><?php echo $row_lish['cpf_pedido']; ?></td>
      <td style="vertical-align:middle; text-align:center"><?php echo $row_lish['email_pedido']; ?></td>
      <td style="vertical-align:middle; text-align:center"><?php if($row_lish['metodopgto_pedido'] == 'pagseguro'){echo "<img src='images/logo-pagseguro.png' width='50'>";}elseif($row_lish['metodopgto_pedido'] == 'boleto'){echo "<img src='images/logo-paghiper.png' width='50'>";}else{echo "<i class='fas fa-box-open'></i>";} ?></td>
      <td style="vertical-align:middle; text-align:center"><?php if($row_lish['status_pedido'] == 0 && $row_lish['tipodoacao_pedido'] == 'valor'){echo "<strong style='color: #ff0000'>Não Pago</strong>";}elseif($row_lish['status_pedido'] == 0 && $row_lish['tipodoacao_pedido'] == 'item'){echo "<strong style='color: #ff0000'>Não entregue</strong>";}elseif(($row_lish['status_pedido'] == 1 || $row_lish['status_pedido'] == 3 || $row_lish['status_pedido'] == 4) && $row_lish['tipodoacao_pedido'] == 'valor'){echo "<strong style='color: #179e07'>Pago</strong>";}else{echo "<strong style='color: #179e07'>Entregue</strong>";} ?></td>
      <td style="text-align:center"><a href="mpdf/<?php if($row_lish['tipodoacao_pedido'] == 'valor'){echo "doc-campanha-valor.php";}else{echo "doc-campanha-item.php";} ?>?clube=<?php echo $clube; ?>&protocolo=<?php echo $row_lish['protocolo_pedido'];?><?php if($row_lish['tipodoacao_pedido'] == 'valor'){echo "&metodopagamento=".$row_lish['metodopgto_pedido'];}?>" target="_blank"><i class="far fa-file-alt"></i></a></td>
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