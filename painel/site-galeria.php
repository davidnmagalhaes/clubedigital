<?php
$page = 4;

include('config-header.php');

//Seleciona todos os sócios honorários
$qrh = "SELECT * FROM rfa_site_galeria WHERE clube='$clube'";
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
    <title>Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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

<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>
<style>
  .file-drop-area {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 100%;
    padding: 25px;
    border: 2px dashed rgb(66, 114, 215);
    border-radius: 3px;
    transition: 0.2s;
    &.is-active {: ;
    background-color: rgba(255, 255, 255, 0.05);
    }: ;
}

.fake-btn {
  flex-shrink: 0;
  background-color: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 3px;
  padding: 8px 15px;
  margin-right: 10px;
  font-size: 16px;
  text-transform: uppercase;
}

.file-msg {
  font-size: small;
  font-weight: 300;
  line-height: 1.4;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.file-input {
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  cursor: pointer;
  opacity: 0;
  &:focus {
    outline: none;
  }
}


</style>
</head>

<body class="animsition">
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
  <form action="proc_cd_site_galeria.php" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
               <!-- USER DATA-->
                <div class="card">
                                    <div class="card-header">
                                        <strong>Galeria de Presidentes</strong>
                                        <small> Gestão de Ex-Presidentes do Clube</small>
                                    </div>
                                    <div class="card-body card-block">
                  
                                     

                                      <div class="row">
                                          <div class="col-12 col-md-3">
                                              <label for="titulo" class="col-form-label">Nome do Presidente:</label>
                                              <input type="text" name="nome_presidente" class="form-control" placeholder="Digite o nome do presidente" >
                                          </div>
                                          
                                      
                                          <div class="col-12 col-md-3">
                                              <label for="titulo" class="col-form-label">Ano Rotário Inicial:</label>
                                              <input type="text" name="ano_rotario_i" class="form-control" maxlength="4" placeholder="<?php $hoje = date('Y'); echo "Ex.: ".$hoje; ?>">
                                          </div>
                                          <div class="col-12 col-md-3">
                                              <label for="titulo" class="col-form-label">Ano Rotário Final:</label>
                                              <input type="text" name="ano_rotario_f" class="form-control" maxlength="4" placeholder="<?php $hoje = date('Y')+1; echo "Ex.: ".$hoje; ?>">
                                          </div>

                                          <div class="col-12 col-md-3">
                                              <label for="titulo" class="col-form-label">Sexo:</label>
                                              <select name="sexo" class="form-control">
                                                <option>Selecione o sexo...</option>
                                                <option value="m">Masculino</option>
                                                <option value="f">Feminino</option>
                                              </select>
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



                                

                                         <div class="card" style="margin-top: 20px">
                                    <div class="card-header">
                                        <strong>Presidentes cadastrados na galeria</strong>
                                        
                                    </div>
                                    <div class="card-body card-block">
                  
                                      
<table class="table table-striped">
  <?php if($totalRows_lish <= 0){echo "<tr><td colspan='5' align='center'><strong>Não há presidentes cadastrados!</strong></td></tr>";}else{ ?>
  <thead>
    <tr>
      <th scope="col" style=" text-align:center;">Imagem</th>
      <th scope="col">Ano Rotário</th>
      <th scope="col">Nome do Presidente</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php while($row_lish = mysqli_fetch_array($lish)){ ?>
    <tr>
      <th style="vertical-align:middle; text-align:center;"><img src="<?php echo $row_lish['imagem_presidente']; ?>" style="width: 150px; border-radius: 100%;"></th>
      <td style="vertical-align:middle;"><?php echo $row_lish['ano_rotario_i']."/".$row_lish['ano_rotario_f']; ?></td>
      <td style="vertical-align:middle;"><?php echo $row_lish['nome_presidente']; ?></td>
      <td style="vertical-align:middle;"><a href="edt-galeria.php?id_galeria=<?php echo $row_lish['cod_galeria']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-pen-alt"></i></a></td>
      <td style="vertical-align:middle;"><a href="crop-galeria.php?cod_usuario=<?php echo $row_lish['cod_galeria']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="far fa-image"></i></a></td>
      <td style="vertical-align:middle;"><a href="excluir-site-galeria.php?id_galeria=<?php echo $row_lish['id_galeria']; ?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"><i class="fas fa-trash"></i></a></td>
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



	

    <?php include("scripts-footer.php"); ?>
	
	

</body>
<script>
  var $fileInput = $('.file-input');
var $droparea = $('.file-drop-area');

// highlight drag area
$fileInput.on('dragenter focus click', function() {
  $droparea.addClass('is-active');
});

// back to normal state
$fileInput.on('dragleave blur drop', function() {
  $droparea.removeClass('is-active');
});

// change inner text
$fileInput.on('change', function() {
  var filesCount = $(this)[0].files.length;
  var $textContainer = $(this).prev();

  if (filesCount === 1) {
    // if single file is selected, show file name
    var fileName = $(this).val().split('\\').pop();
    $textContainer.text(fileName);
  } else {
    // otherwise show number of files
    $textContainer.text(filesCount + ' arquivos selecionados');
  }
});
</script>
	<script type="text/javascript">
		SyntaxHighlighter.all()
	</script>
</html>
<!-- end document-->