<?php
$page = 4;

include('config-header.php');

//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfa_site_menu_pages WHERE clube='$clube'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$totalRows_lish = mysqli_num_rows($lish);

$query = "SELECT * FROM rfa_site_menu WHERE clube='$clube'";
$limenu = mysqli_query($link, $query) or die(mysqli_error($link));



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
  <form action="proc_cd_site_paginas.php" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">

<div class="card" style="margin-top: 20px">
                                    <div class="card-header">
                                        <strong>Páginas Criadas</strong>
                                        
                                    </div>
                                    <div class="card-body card-block">
                  
                                      
<table class="table table-striped">
  <?php if($totalRows_lish <= 0){echo "<tr><td colspan='5' align='center'><strong>Não há páginas cadastradas!</strong></td></tr>";}else{ ?>
  <thead>
    <tr>
      <th scope="col">Nome da Página</th>
      <th scope="col">Menu Pai</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php while($row_lish = mysqli_fetch_array($lish)){ ?>
    <tr>
    
      
      <td style="vertical-align:middle;"><?php echo $row_lish['nome_page']; ?></td>
      <td style="vertical-align:middle;">
        <?php 
          $refmenu = $row_lish['ref_menu'];
          $sqlmenu = "SELECT * FROM rfa_site_menu WHERE clube='$clube' AND id_menu='$refmenu'";
          $nmenu = mysqli_query($link, $sqlmenu) or die(mysqli_error($link));
          $row_nmenu = mysqli_fetch_array($nmenu);
          echo $row_nmenu['nome_menu'];
        ?> 
      </td>
      <td><a href="<?php echo "https://".$_SERVER['HTTP_HOST']."/".basename(__DIR__)."/site/page.php?id_page=".$row_lish['id_page']."&clube=".$clube; ?>" target="_blank"><i class="fas fa-link"></i></a></td>
      <td style="vertical-align:middle;"><a href="edt-paginas.php?id_page=<?php echo $row_lish['id_page']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-pen-alt"></i></a></td>
      <td style="vertical-align:middle;"><a href="excluir-site-paginas.php?id_page=<?php echo $row_lish['id_page']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-trash"></i></a></td>
    </tr>
    <?php } ?>
  
  </tbody>
  <?php } ?>
</table>

                                        
                                    </div>
                                </div>
                                <!-- END USER DATA-->

               <!-- USER DATA-->
                <div class="card">
                                    <div class="card-header">
                                        <strong>Páginas</strong>
                                        <small> Gestão de Páginas</small>
                                    </div>
                                    <div class="card-body card-block">
                  
                                     

                                      <div class="row">
                                          <div class="col-12 col-md-6">
                                              <label for="titulo" class="col-form-label">Nome da Página:</label>
                                              <input type="text" name="titulo" class="form-control" placeholder="Exemplo: Serviços" >
                                          </div>

                                          <div class="col-12 col-md-6">
                                              <label for="titulo" class="col-form-label">Menu Pai:</label>
                                              <select name="menu" class="form-control">
                                                <?php 
                                                while($row_limenu = mysqli_fetch_array($limenu)){
                                                  if($row_limenu['nome_menu'] == "Início"){}else{
                                                    echo "<option value='".$row_limenu['id_menu']."'>".$row_limenu['nome_menu']."</option>";
                                                  }
                                                }
                                                ?>
                                                
                                              </select>
                                          </div>
                                          
                                      </div>

                                      <div class="row" style="margin-top: 20px">
                                          <div class="col-12">
                                             
   <!--<textarea name="descricao" id="editor" rows="10" cols="80"></textarea>-->



<div id="summernote"></div>
    <script>
      $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
            callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
        }
    }
        });
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "envia-img-summernote.php",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    editor.insertImage(welEditable, url);
                }
            });
        }
    });



    </script>


                                          </div>
                                      </div>



                                        
                                    </div>
                                    <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Cadastrar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
                                </div>
                                <input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
                                <input type="hidden" name="por" value="<?= $_SESSION['id_usuario'] ?>">
  </form>



                                

                                         
                </div>
              
</div>
            

            <?php include("footer.php"); ?>
      
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>



  

    <?php include("scripts-footer.php"); ?>
  
  

</body>


  <script type="text/javascript">
    SyntaxHighlighter.all()
  </script>
</html>
<!-- end document-->