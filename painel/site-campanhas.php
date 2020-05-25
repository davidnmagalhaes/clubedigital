<?php
$page = 4;

include('config-header.php');

//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfa_campanhas WHERE clube='$clube'";
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


<!-- Adicionar campanha -->
<form action="site-continua-campanha.php" method="post">
<div class="modal fade" id="novacampanha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Criar Nova Campanha</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <label>Nome da Campanha:</label>
            <input type="text" class="form-control" name="nomecampanha" required>
          </div>
          
        </div>
        <div class="row">
            <div class="col">
              <label>Tipo de Campanha:</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tipocampanha" id="tipocampanha1" value="valor" checked>
              <label class="form-check-label" for="gridRadios1">
                Doação em Valor
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tipocampanha" id="tipocampanha2" value="item">
              <label class="form-check-label" for="gridRadios2">
                Doação em Itens
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="tipocampanha" id="tipocampanha3" value="ambos">
              <label class="form-check-label" for="gridRadios3">
                Doação Valor ou Itens
              </label>
            </div>
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
                                        <strong>Campanhas Criadas</strong> <a href="" role="button" class="btn btn-success" data-toggle="modal" data-target="#novacampanha">+ Nova campanha</a>
                                        
                                    </div>
                                    <div class="card-body card-block">
                  
                                      
<table class="table table-striped">
  <?php if($totalRows_lish <= 0){echo "<tr><td colspan='5' align='center'><strong>Não há campanhas cadastradas!</strong></td></tr>";}else{ ?>
  <thead>
    <tr>
      <th scope="col" style="text-align:center">Nome da Campanha</th>
      <th scope="col" style="text-align:center">Tipo de Campanha</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php while($row_lish = mysqli_fetch_array($lish)){ ?>
    <tr>
    
      
      <td style="vertical-align:middle; text-align:center"><?php echo $row_lish['nome_campanha']; ?></td>
      <td style="vertical-align:middle;text-align:center"><?php if($row_lish['tipo_campanha'] == 'valor'){echo "Campanha de valor";}elseif($row_lish['tipo_campanha'] == 'itens'){echo "Campanha de Itens";}else{echo "Campanha de Valor ou Itens";} ?></td>
      <td style="text-align:center"><a href="<?php echo "https://".$_SERVER['HTTP_HOST']."/".basename(__DIR__)."/site/campanha.php?idcmp=".$row_lish['cod_campanha']."&clube=".$clube; ?>" target="_blank"><i class="fas fa-link"></i></a></td>
      <td style="text-align:center"><a href="site-campanhas-pedidos.php?idcampanha=<?php echo $row_lish['cod_campanha']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-hand-holding-medical"></i></a></td>
      <td style="vertical-align:middle;text-align:center"><a href="edt-campanha.php?idcampanha=<?php echo $row_lish['cod_campanha']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-pen-alt"></i></a></td>
      <td style="vertical-align:middle;text-align:center"><a href="excluir-campanha.php?idcampanha=<?php echo $row_lish['id_campanha']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-trash"></i></a></td>
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