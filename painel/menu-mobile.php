<aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="#">
                        <img src="images/icon/logo-white.png" alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="<?php if(empty($_SESSION['imagem'])){echo "images/001-user.svg";}else{echo "login-seguro/".$_SESSION['imagem'];}?>" />
                    </div>
                    <h4 class="name"><?= $_SESSION['nome'] ?></h4>
										<?php if($_SESSION['funcao'] == 1){echo "Administrador";}elseif($_SESSION['funcao'] == 2){echo "Presidente de Clube";}elseif($_SESSION['funcao'] == 3){echo "Secretário de Clube";}elseif($_SESSION['funcao'] == 4){echo "Contador de Clube";}else{echo "Secretário Executivo de Clube";} ?>

                    <a href="logout.php">Sair</a>
                </div>
                <nav class="navbar-sidebar2">
                    <?php include("ul-menu.php");?>    
                </nav>
                </div>
            </aside>