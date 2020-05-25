<?php 
$page = 10;

include('config-header.php');

//Seleciona todos os tipos de contas bancárias
$qr = "SELECT * FROM rfa_usuario";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));


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
                                        <i class="zmdi zmdi-account-calendar"></i>Usu&aacute;rios
										<a href="cd_usuario.php" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Adicionar</a>
										</h3>
                                    <div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">Tudo</option>
                                                <option value="">Administrador</option>
                                                <option value="">Padr&atilde;o</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        
                                    </div>
									
									<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 0 25px">
  Esta &eacute; uma &aacute;rea administrativa. Aqui &eacute; poss&iacute;vel ver todos os usu&aacute;rios cadastrados de todos os clubes registrados.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
									
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
												
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
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
											<?php while($row_lis = mysqli_fetch_array($lis)){?>
                                                <tr>
													
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
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
                                                        <?php if($row_lis['funcao'] == 1){echo "<span class='role admin'>Administrador</span>";}elseif($row_lis['funcao'] == 2){echo "<span class='role member'>Presidente do Clube</span>";}elseif($row_lis['funcao'] == 3){echo "<span class='role user'>Secret&aacute;rio de Clube</span>";}elseif($row_lis['funcao'] == 4){echo "<span class='role contador'>Contador de Clube</span>";}else{echo "<span class='role executivo'>Secret&aacute;rio Executivo de Clube</span>";}; ?>
                                                    </td>
                                                    <td>
														<form method="post" action="proc_atv_usuario.php">
													<label class="switch">
													  <input type="checkbox"  id="atv" onChange="this.form.submit()" name="atv" <?php if($row_lis['status'] == "A"){echo "value='0' checked";}else{echo "value='A'";};?>>
													  <span class="slider round"></span>
													</label>
													<input type="hidden" name="iduser" value="<?php echo $row_lis['id_usuario'];?>">
													</form>
													</td>
                          <td>
                              <a href="crop-usuarios.php?cod_usuario=<?php echo $row_lis['cod_usuario'];?>" data-toggle="tooltip" title="Trocar imagem">
                                     <i class="far fa-image"></i>
                               </a>
                          </td>

                          <td>
    													<a href="#" data-toggle="modal" data-target=".editaruser<?php echo $row_lis['id_usuario'];?>">
                                     <i class="zmdi zmdi-edit"></i>
                              </a>
													</td>
													 <td>
													 <a href="excluir-usuario.php?id_usuario=<?php echo $row_lis['id_usuario'];?>&user=<?php echo $row_lis['id_usuario'];?>">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
													 </td>
                                                </tr>
												
<div class="modal fade bd-example-modal-lg editaruser<?php echo $row_lis['id_usuario'];?>" id="" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="padding: 15px">
      <form method="post" action="login-seguro/proc_edt_usuario.php" enctype="multipart/form-data">
	  <div class="row">
										<div class="col">
											<div class="form-group">
												<label for="imagem" class=" form-control-label">Imagem do Usu&aacute;rio:</label>
												<input type="file" name="imagem" id="imagem" class="form-control" >
											</div>
										</div>
										
										</div>
									
                                        <div class="form-group">
											<label for="destino" class=" form-control-label">Tipo de Usu&aacute;rio </label>
                                                <select name="funcao" id="funcao" class="form-control" required>
                                                   <?php if($row_lis['funcao'] == 1){?>
                           <option value="1" selected>Administrador</option>
													<option value="2">Presidente de Clube</option>
                          <option value="3">Secret&aacute;rio de Clube</option>
                          <option value="4">Contador de Clube</option>
                          <option value="5">Secret&aacute;rio Executivo de Clube</option>
												   <?php }elseif($row_lis['funcao'] == 2){?>
													<option value="1" >Administrador</option>
                          <option value="2" selected>Presidente de Clube</option>
                          <option value="3">Secret&aacute;rio de Clube</option>
                          <option value="4">Contador de Clube</option>
                          <option value="5">Secret&aacute;rio Executivo de Clube</option>
												   <?php }elseif($row_lis['funcao'] == 3){?>
												   <option value="1" >Administrador</option>
                          <option value="2" >Presidente de Clube</option>
                          <option value="3" selected>Secret&aacute;rio de Clube</option>
                          <option value="4">Contador de Clube</option>
                          <option value="5">Secret&aacute;rio Executivo de Clube</option>
												   <?php }elseif($row_lis['funcao'] == 4){?>
												   <option value="1" >Administrador</option>
                          <option value="2" >Presidente de Clube</option>
                          <option value="3">Secret&aacute;rio de Clube</option>
                          <option value="4" selected>Contador de Clube</option>
                          <option value="5">Secret&aacute;rio Executivo de Clube</option>
												   <?php }else{ ?>
												  <option value="1" >Administrador</option>
                          <option value="2" >Presidente de Clube</option>
                          <option value="3">Secret&aacute;rio de Clube</option>
                          <option value="4">Contador de Clube</option>
                          <option value="5" selected>Secret&aacute;rio Executivo de Clube</option>
												   <?php } ?>
													<!--<option value="3">Secretário de Clube</option>
													<option value="4">Contador de Clube</option>
													<option value="5">Secretário Executivo de Clube</option>-->
                                                 </select>                                        
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
                        <label for="clube" class=" form-control-label">Selecione o clube</label>
                        <select name="clube2" class="form-control">
                              <?php 
                                  $sqcl = "SELECT * FROM rfa_clubes";
                                  $showclub = mysqli_query($link, $sqcl) or die(mysqli_error($link));
                                  while($row_showclub = mysqli_fetch_array($showclub)){
                                    
                                      echo "<option value='".$row_showclub['id_clube']."'>".$row_showclub['nome_clube']."</option>";
                                  }
                              ?>
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
                                        <div class="row form-group">
                                            
                                            <div class="col">
                                                <div class="form-group exibetipopessoapf">
                                                    <label for="status" class="form-control-label">Plano</label>
												<select name="plano" class="form-control" required>
												<option>Selecione o plano...</option>
													<?php 
														foreach($lisy as $rw){
															
															echo "<option value=".$rw['id_plano'].">".$rw['nome_plano']." (R$ ".number_format($rw['valor_plano'],2,',','.').")</option>";
														}
													?>
												<option value="0">Isento</option>
												</select>
											
                                                </div>
												
                                            </div>
											
											<div class="col">
                                                <div class="form-group exibetipopessoapf">
                                                    <label for="formapagamento" class="form-control-label">Forma de Pagamento</label>
												
												<select name="formapagamento" class="form-control" required>
													<option>Selecione a forma de pagamento...</option>
													<option value="1">Boleto Banc&aacute;rio</option>
													<option value="2">Pagseguro</option>
													<option value="2">Paypal</option>
													<option value="4">Isento</option>
												</select>
												
												
											
                                                </div>
												
                                            </div>
											
                                        </div>
										
										
										<input type="hidden" name="user" value="<?php echo $row_lis['id_usuario'];?>">
										<input type="hidden" name="club" value="<?= $_SESSION['clube'] ?>">
										
										
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
                                                <?php  }?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="user-data__footer">
                                        <button class="au-btn au-btn-load">VER MAIS</button>
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

</html>
<!-- end document-->