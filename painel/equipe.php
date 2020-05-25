<?php 
$page = 9;

include('config-header.php');

//Seleciona todos os tipos de contas bancárias
$qr = "SELECT * FROM rfa_usuario WHERE (funcao='2' OR funcao='3' OR funcao='4' OR funcao='5' OR funcao='6') AND clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);

//Seleciona todos os planos
$qry = "SELECT * FROM rfa_planos";
$lisy = mysqli_query($link, $qry) or die(mysqli_error($link));
$row_lisy = mysqli_fetch_assoc($lisy);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestão do Rotary Fortaleza Alagadiço">
    <meta name="author" content="David Magalhães">
    <meta name="keywords" content="rotary alagadiço, rotary fortaleza alagadiço, fortaleza alagadiço">

    <!-- Title Page-->
    <title>Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

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
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Equipe
										<a href="cd_equipe.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Adicionar</a>
										</h3>
                                    <!--<div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">Tudo</option>
                                                <option value="">Administrador</option>
                                                <option value="">Padr&atilde;o</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        
                                    </div>-->
									
									
									<?php if($totalRows_lis > 0){?>
                                    <div class="table-responsive table-data">
									
                                        <table class="table">
                                            <thead>
                                                <tr>
												
                                                    <!--<td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>-->
													<td></td>
                                                    <td>Usu&aacute;rio</td>
                                                    <td>N&iacute;vel</td>
                                                    <td>Ativo?</td>
                                                    <td></td>
                                                    <td></td>
													<td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php do{?>
                                                <tr>
													
                                                    <!--<td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>-->
													<td>
														<img src="login-seguro/<?php echo $row_lis['imagem']; ?>" width="100" style="border-radius: 100px" />
													</td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?php echo $row_lis['nome']; ?></h6>
                                                            <span>
                                                                <a href="#"><?php echo $row_lis['email']; ?></a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php if($row_lis['funcao'] == 1){echo "<span class='role admin'>Administrador</span>";}elseif($row_lis['funcao'] == 2){echo "<span class='role member'>Presidente do Clube</span>";}elseif($row_lis['funcao'] == 3){echo "<span class='role user'>Secret&aacute;rio(a) de Clube</span>";}elseif($row_lis['funcao'] == 4){echo "<span class='role contador'>Contador(a) de Clube</span>";}elseif($row_lis['funcao'] == 6){echo "<span class='role tesoureiro'>Tesoureiro(a) de Clube</span>";}else{echo "<span class='role executivo'>Secret&aacute;rio(a) Executivo(a) de Clube</span>";}; ?>
                                                    </td>
                                                    <td>
														<form method="post" action="proc_atv_usuario.php">
													<label class="switch">
													  <input type="checkbox"  id="atv" onChange="this.form.submit()" name="atv" <?php if($row_lis['status'] == "A"){echo "value='0' checked";}else{echo "value='A'";};?>>
													  <span class="slider round"></span>
													</label>
                          <?php if($_GET['clube']){?>
                        <input type="hidden" name="clube" value="<?php echo $clube;?>">
                        <?php } ?>
													<input type="hidden" name="iduser" value="<?php echo $row_lis['id_usuario'];?>">
													</form>
													</td>
                                                    <td>
													<a href="#" data-toggle="modal" data-target=".editaruser<?php echo $row_lis['id_usuario'];?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
													</td>
                          <td>
                           <a href="crop-equipe.php?cod_usuario=<?php echo $row_lis['cod_usuario'];?><?php echo '&clube='.$clube;?>">
                                                            <i class="far fa-image"></i>
                                                        </a>
                           </td>
													 <td>
													 <a href="excluir-usuario.php?id_usuario=<?php echo $row_lis['id_usuario'];?>&user=<?php echo $row_lis['id_usuario'];?><?php if($_GET['clube']){echo '&clube='.$clube;}?>">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
													 </td>
                                                </tr>
												
<div class="modal fade bd-example-modal-lg editaruser<?php echo $row_lis['id_usuario'];?>" id="" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="padding: 15px">
      <form method="post" action="login-seguro/proc_edt_equipe.php" enctype="multipart/form-data">
	  <div class="row">
										<div class="col">
											<div class="form-group">
												<div class="file-drop-area">
                                                <span class="fake-btn"><strong style="color:#4272d7"><i class="fas fa-cloud-upload-alt" style="margin-right: 15px"></i> Imagem do usuário</strong></span>
                                                <span class="file-msg">ou arraste e solte aqui...</span>
                                                <input class="file-input" type="file" name="imagem">
                                              </div>
											</div>
										</div>
										
										</div>
									
                                        
												 
												 <div class="row">
										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">Nome completo</label>
												<input type="text" name="nome_usuario" id="nome_usuario" placeholder="Digite o nome completo do usuário" value="<?php echo $row_lis['nome'];?>" class="form-control" required >
											</div>
										</div>
										
										<div class="col">
											<div class="form-group">
												<label for="descricao_receber" class=" form-control-label">E-mail</label>
												<input type="email" name="email_usuario" id="email_usuario" placeholder="Digite o e-mail do usuário" value="<?php echo $row_lis['email'];?>" class="form-control" required >
											</div>
										</div>
										
										</div>
										<div class="row">
										
										<div class="col">
											<div class="form-group">
											<label for="destino" class=" form-control-label">Tipo de Usu&aacute;rio </label>
                                                <select name="funcao" id="funcao" class="form-control" required>
                                                   <?php if($row_lis['funcao'] == 1){?>
                                                    <option value="1" selected>Administrador</option>
													<option value="2">Presidente de Clube</option>
												   <?php }elseif($row_lis['funcao'] == 2){?>
													
													<option value="2">Presidente de Clube</option>
												   <?php }elseif($row_lis['funcao'] == 3){?>
												   <option value="3" selected>Secret&aacute;rio(a) de Clube</option>
													<option value="4">Contador(a) de Clube</option>
													<option value="5">Secret&aacute;rio(a) Executivo(a) de Clube</option>
                          <option value="6">Tesoureiro(a)</option>
												   <?php }elseif($row_lis['funcao'] == 4){?>
												   <option value="3" >Secret&aacute;rio(a) de Clube</option>
													<option value="4" selected>Contador(a) de Clube</option>
													<option value="5">Secret&aacute;rio(a) Executivo(a) de Clube</option>
                          <option value="6">Tesoureiro(a)</option>
                        <?php }elseif($row_lis['funcao'] == 6){?>
                           <option value="3" >Secret&aacute;rio(a) de Clube</option>
                          <option value="4" >Contador(a) de Clube</option>
                          <option value="5">Secret&aacute;rio(a) Executivo(a) de Clube</option>
                          <option value="6" selected>Tesoureiro(a)</option>
												   <?php }else{ ?>
												   <option value="3" >Secret&aacute;rio(a) de Clube</option>
													<option value="4" >Contador(a) de Clube</option>
													<option value="5" selected>Secret&aacute;rio(a) Executivo(a) de Clube</option>
                          <option value="6">Tesoureiro(a)</option>
												   <?php } ?>
													<!--<option value="3">Secretário de Clube</option>
													<option value="4">Contador de Clube</option>
													<option value="5">Secretário Executivo de Clube</option>-->
                                                 </select>                                        
												 </div>
										</div>
										
										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Senha do Usu&aacute;rio</label>
												<input type="password" name="senha_usuario" id="senha_usuario" class="form-control" placeholder="Deixe em branco para n&atilde;o alterar">
											</div>
										</div>
										</div>
                                        
										
										
										<input type="hidden" name="user" value="<?php echo $row_lis['cod_usuario'];?>">
										<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
										
										
										<div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                                    
                                                    <span id="payment-button-amount"><i class="fas fa-paper-plane"></i> Atualizar</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                         </div>
	  </form>
	  
    </div>
  </div>
</div>
                                                <?php  }while($row_lis = mysqli_fetch_assoc($lis));?>
                                                
                                            </tbody>
                                        </table>
									
                                    </div>
									<?php }else{echo "<div class='row'><div class='col' style='text-align:center;'>Não há usuários cadastrados!</div></div>";}?>
                                    
                                </div>
                                <!-- END USER DATA-->
                            </div>
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
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

    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->