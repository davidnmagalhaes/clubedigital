

<!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="#">
                    <img src="<?php if($row_logotopo['logo_clube'] == ""){echo "images/clube-digital.png";}else{echo $row_logotopo['logo_clube'];} ?>" alt="Logotipo"/>
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2" style="text-align:center;">
                    <div class="image img-cir img-120">
                        <img src="<?php if(empty($_SESSION['imagem'])){echo "images/001-user.svg";}else{echo "login-seguro/".$_SESSION['imagem'];}?>" />
                    </div>
                    <h4 class="name"><?= $_SESSION['nome'] ?></h4>
					<?php if($_SESSION['funcao'] == 1){echo "Administrador(a)";}elseif($_SESSION['funcao'] == 2){echo "Presidente de Clube";}elseif($_SESSION['funcao'] == 3){echo "Secretário(a) de Clube";}elseif($_SESSION['funcao'] == 4){echo "Contador(a) de Clube";}elseif($_SESSION['funcao'] == 5){echo "Secretário(a) Executivo(a) de Clube";}else{echo "Tesoureiro(a)";} ?>
                    <a href="logout.php">Sair</a>
                </div>

                <?php if($_SESSION['funcao'] == 1){ ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col" style="margin: 10px 25px 0 25px">
                               <select class="form-control" name="clube" onChange="this.form.submit()">
                                    <option>Escolha um clube...</option>
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
                    </form>
                <?php } ?>

                <?php if($_SESSION['funcao'] == 1){?>
                                        <form method="post" action="atualizar_cambio.php">
                                            <div class="row">
                                                <div class="col" style="text-align:center">
                                                <label style="margin-bottom: .0rem; margin-top: .5rem;">Câmbio:</label><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col" style="display:flex; justify-content:center;">
                                                
                                         <input type="text" class="form-control" placeholder="Câmbio" onBlur="this.form.submit()" onKeyPress="return(moeda(this,'.',',',event))" name="cambio" style="width: 83%; margin-top: 5px" value="<?php echo number_format($cambio,2,',','.'); ?>">                          
                                            </div>     
                                        </div>
                                        </form>
                                   <?php } ?>

                <nav class="navbar-sidebar2">
                    <?php include("ul-menu.php");?>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->