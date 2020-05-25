<?php
$page = 4;

include('config-header.php');

$idcampanha = $_GET['idcampanha'];
$clube = $_GET['clube'];

$qrh = "SELECT * FROM rfa_campanhas WHERE clube='$clube' AND cod_campanha='$idcampanha'";
$lish = mysqli_query($link, $qrh) or die(mysqli_error($link));
$row_lish = mysqli_fetch_array($lish);

$tipocampanha = $row_lish['tipo_campanha'];
$metodocampanha = $row_lish['metodo_campanha'];

$qrhli = "SELECT * FROM rfa_campanhas_itens WHERE clube='$clube' AND cod_campanha='$idcampanha'";
$lishli = mysqli_query($link, $qrhli) or die(mysqli_error($link));
$row_lishli = mysqli_fetch_array($lishli);

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


            
 <div class="main-content">
  <form action="proc_edt_campanha.php" method="post" enctype="multipart/form-data">
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
                                          <strong>Nome da Campanha: </strong><input type="text" class="form-control" name="nomecampanha" value="<?php echo $row_lish['nome_campanha']; ?>"><br>
                                          <strong>Tipo de Campanha: </strong>
                                            <select name="tipocampanha" class="form-control" id="tipocampanha">
                                              <option value="valor" <?php if($tipocampanha == "valor"){echo "selected";}?>>Campanha de Valor</option>
                                              <option value="item" <?php if($tipocampanha == "item"){echo "selected";}?>>Campanha de Itens</option>
                                              <option value="ambos" <?php if($tipocampanha == "ambos"){echo "selected";}?>>Campanha de Valor ou Itens</option>
                                            </select>
                                          <Br>
                                        </div>
                                     </div>
                                      </div>

                                      
                                      <div id="campanhavalor">
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
                                                <input type="text" class="form-control" value="<?php echo number_format($row_lish['valor_campanha'],2,',','.');?>" id="inlineFormInputGroup" onKeyPress="return(moeda(this,'.',',',event))" placeholder="Digite o valor da campanha" name="valorpagamento">
                                              </div>
                                          </div>

                                          <div class="col-12 col-md-6">

                                              <label for="titulo" class="col-form-label">Método de pagamento:</label>
                                              <select name="metodopagamento" class="form-control">
                                               <option selected disabled>Selecione um método</option>
                                               <option value="boleto" <?php if($metodocampanha == 'boleto'){echo "selected";}?>>Boleto Bancário</option>
                                               <option value="pagseguro" <?php if($metodocampanha == 'pagseguro'){echo "selected";}?>>Pagseguro</option>
                                               <option value="ambos" <?php if($metodocampanha == 'ambos'){echo "selected";}?>>Ambos</option>
                                              </select>
                                          </div>
                                          
                                      </div>
                                    </div>
                                   

                                   
                                      <!-- ///////////////////////////////////-->
                                      <div id="dynamic_field" style="margin-top: 15px">
                                      <div class="row">
                                        <div class="col">
                                          <h2>Campanha de Itens <button type="button" name="add" id="add" class="btn btn-primary">+ Adicionar mais itens</button></h2>
                                            
                                        </div>
                                      </div>
                                      <?php foreach($lishli as $listando){?>
                                      <div class="row form-group" >
                                        <input type="hidden" name="iditem[]" value="<?php echo $listando['id_item']?>">
                                         <div class="col-12 col-md-2">
                                          <div class="form-group">
                                            <label class=" form-control-label">Quantidade</label>
                                            <input type="text" name="qtd[]" class="form-control" value="<?php echo $listando['qtd_item']?>">
                                          </div>
                                        </div>
                                          <div class="col-12 col-md-8">
                                          <div class="form-group">
                                            <label class=" form-control-label">Item da Campanha</label>
                                            <input type="text" name="item[]" class="form-control" value="<?php echo $listando['nome_item']?>">
                                          </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                          <div class="form-group">
                                            <label class=" form-control-label">Excluir?</label><br>
                                            <input type="checkbox" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" id="excluir<?php echo $listando['id_item']?>" name="excluir[]" onchange="deletar('excluir<?php echo $listando['id_item']?>')">
                                          </div>
                                        </div>
                                        
                                     </div>
                                      <?php } ?>

                                      </div>
                                      <!-- ///////////////////////////////////-->
                                 


                                    <input type="hidden" name="idcampanha" value="<?php echo $idcampanha;?>">
                                    <input type="hidden" name="clube" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">

                                      <div class="row" style="margin-top: 20px">
                                          <div class="col-12">
                                             
   <!--<textarea name="descricao" id="editor" rows="10" cols="80"></textarea>-->



<textarea id="summernote" name="descricao"><?php echo $row_lish['descricao_campanha'];?></textarea>
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
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Atualizar</span>
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
  function deletar(id)
{
  if (document.getElementById(id).checked) 
  {
      document.getElementById(id).value = 1;
  }else{
      document.getElementById(id).value = 0;
  }
}
</script>

<script>


    if( $('#tipocampanha').val()==="valor"){
    $("#dynamic_field").hide();
    $("#campanhavalor").show();
    }

    if( $('#tipocampanha').val()==="item"){
    $("#dynamic_field").show();
    $("#campanhavalor").hide();
    }

    if( $('#tipocampanha').val()==="ambos"){
    $("#dynamic_field").show();
    $("#campanhavalor").show();
    }

$('#tipocampanha').on('change',function(){
    if( $(this).val()==="valor"){
    $("#dynamic_field").hide();
    $("#campanhavalor").show();
    }
    
});

$('#tipocampanha').on('change',function(){
    if( $(this).val()==="item"){
    $("#dynamic_field").show();
    $("#campanhavalor").hide();
    }
    
});

$('#tipocampanha').on('change',function(){
    if( $(this).val()==="ambos"){
    $("#dynamic_field").show();
    $("#campanhavalor").show();
    }
    
});
</script>
  
<script>

  

$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;
    $('#dynamic_field').append('<div class="row form-group" id="row'+i+'"><div class="col-12 col-md-2"><div class="form-group"><label class=" form-control-label">Quantidade</label><input type="text" name="qtd2[]" class="form-control" ></div></div><div class="col-12 col-md-8"><div class="form-group"><label class=" form-control-label">Item da Campanha</label><input type="text" name="item2[]" class="form-control"></div></div><div class="col-12 col-md-2"><button type="button" name="remove" id="'+i+'" style="margin-top: 30px" class="btn btn-danger btn_remove">X</button></div></div>');
  
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