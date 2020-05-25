<?php
$page = 4;

include('config-header.php');

$nomecampanha = mysqli_real_escape_string($link,$_POST['nomecampanha']);
$tipocampanha = mysqli_real_escape_string($link,$_POST['tipocampanha']);


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
  <form action="proc_cd_campanha.php" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">



               <!-- USER DATA-->
                <div class="card">
                                    <div class="card-header">
                                        <strong>Campanhas</strong>
                                        <small> Gestão de criação de campanha</small>
                                    </div>
                                    <div class="card-body card-block">
                    
                                     

                                     <div class="alert alert-primary" role="alert">
                                        <div class="row">
                                        <div class="col">
                                          <strong>Nome da Campanha: </strong><?php echo $nomecampanha; ?><br>
                                          <strong>Tipo de Campanha: </strong><?php if($tipocampanha == "valor"){echo "Campanha de Valor";}elseif($tipocampanha == "item"){echo "Campanha de Itens";}else{echo "Campanha de Valor ou Itens";} ?><Br>
                                        </div>
                                     </div>
                                      </div>

                                      <?php if($tipocampanha == "valor" || $tipocampanha == "ambos"){?>
                                      <div class="row" style="margin-top: 15px">
                                        <div class="col">
                                          <h2>Campanha de Valor</h2>
                                        </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-12 col-md-6">
                                            
                                              <label for="titulo" class="col-form-label">Valor da Campanha:</label>
                                              <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                  <div class="input-group-text">R$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup" onKeyPress="return(moeda(this,'.',',',event))" placeholder="Digite o valor da campanha" name="valorpagamento">
                                              </div>
                                          </div>

                                          <div class="col-12 col-md-6">

                                              <label for="titulo" class="col-form-label">Método de pagamento:</label>
                                              <select name="metodopagamento" class="form-control">
                                               <option selected disabled>Selecione um método</option>
                                               <option value="boleto">Boleto Bancário</option>
                                               <option value="pagseguro">Pagseguro</option>
                                               <option value="ambos">Ambos</option>
                                              </select>
                                          </div>
                                          
                                      </div>
                                    <?php } ?>

                                    <?php if($tipocampanha == "item" || $tipocampanha == "ambos"){?>
                                      <!-- ///////////////////////////////////-->
                                      <div id="dynamic_field" style="margin-top: 15px">
                                      <div class="row">
                                        <div class="col">
                                          <h2>Campanha de Itens <button type="button" name="add" id="add" class="btn btn-primary"><i class="fas fa-child" style="margin-right: 5px"></i> Adicionar mais itens</button></h2>
                                            
                                        </div>
                                      </div>
                                      <div class="row form-group" >

                                         <div class="col-12 col-md-2">
                                          <div class="form-group">
                                            <label class=" form-control-label">Quantidade</label>
                                            <input type="text" name="qtd[]" class="form-control" >
                                          </div>
                                        </div>
                                          <div class="col-12 col-md-10">
                                          <div class="form-group">
                                            <label class=" form-control-label">Item da Campanha</label>
                                            <input type="text" name="item[]" class="form-control">
                                          </div>
                                        </div>
                                     </div>
                                      

                                      </div>
                                      <!-- ///////////////////////////////////-->
                                    <?php } ?>


                                    <input type="hidden" name="nomecampanha" value="<?php echo $nomecampanha;?>">
                                    <input type="hidden" name="tipocampanha" value="<?php echo $tipocampanha;?>">
                                    <input type="hidden" name="clube" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">

                                      <div class="row" style="margin-top: 20px">
                                          <div class="col-12">
                                             
   <!--<textarea name="descricao" id="editor" rows="10" cols="80"></textarea>-->



<textarea id="summernote" name="descricao"></textarea>
    <script>

  $('#summernote').summernote({
        toolbar: [
  ['style', ['style']],
  ['font', ['bold', 'underline', 'clear', 'fontsize', 'fontsizeunit', 'strikethrough', 'superscript', 'subscript']],
  ['fontname', ['fontname']],
  ['color', ['color', 'forecolor', 'backcolor']],
  ['para', ['ul', 'ol', 'paragraph', 'style', 'height']],
  ['table', ['table']],
  ['insert', ['link']],
  ['view', ['fullscreen', 'codeview', 'help', 'undo', 'redo']],
],

        callbacks: {
            onImageUpload: function(files) {
                for(let i=0; i < files.length; i++) {
                    $.upload(files[i]);
                }
            }
        },
        height: 500,
        lang: 'pt-BR',
        placeholder: 'Digite a descrição de sua campanha aqui...',

    });

    $.upload = function (file) {
        let out = new FormData();
        out.append('file', file, file.name);

        $.ajax({
            method: 'POST',
            url: 'envia-img-summernote.php',
            contentType: false,
            cache: false,
            processData: false,
            data: out,
            success: function (img) {
                $('#summernote').summernote('insertImage', img);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus + " " + errorThrown);
            }
        });
    };


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
                               
  </form>



                                

                                         
                </div>
              
</div>
            

            <?php include("footer.php"); ?>
      
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

  
<script>

  

$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;
    $('#dynamic_field').append('<div class="row form-group" id="row'+i+'"><div class="col-12 col-md-2"><div class="form-group"><label class=" form-control-label">Quantidade</label><input type="text" name="qtd[]" class="form-control" ></div></div><div class="col-12 col-md-8"><div class="form-group"><label class=" form-control-label">Item da Campanha</label><input type="text" name="item[]" class="form-control"></div></div><div class="col-12 col-md-2"><button type="button" name="remove" id="'+i+'" style="margin-top: 30px" class="btn btn-danger btn_remove">X</button></div></div>');
  
  });

  
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
  });
  
  
  
});
</script>

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