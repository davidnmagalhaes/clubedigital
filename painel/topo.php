

<header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="<?php if($row_logotopo['logo_clube'] == ""){echo "images/clube-digital.png";}else{echo $row_logotopo['logo_clube'];} ?>" style="width: 60%;" alt="Logotipo" />
                                </a>
                            </div>
                            <div class="header-button2 no-print">
                            <div class="header-button-item js-item-menu cambio" style="font-size: 16px">
                            <i class="fas fa-dollar-sign" style="margin-right: 10px"></i> Câmbio <strong>(R$ <?php echo number_format($cambio,2,',','.'); ?>)</strong>
                            </div>

                                <div class="header-button-item js-item-menu">
								
                                    <i class="zmdi zmdi-search icon-mobile"></i>
                                    <div class="search-dropdown js-dropdown">
                                        <form action="socios.php" method="get">
                                            
                                            <input class="au-input au-input--full au-input--h65" type="text" name="search" placeholder="Pesquisar sócios..." />
                                            <span class="search-dropdown__icon">
                                                <i class="zmdi zmdi-search"></i>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                                <!--<div class="header-button-item has-noti js-item-menu">
                                    <i class="zmdi zmdi-notifications"></i>
                                    <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__title">
                                            <p>Você tem 3 notificações</p>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p>Você recebeu uma notificação</p>
                                                <span class="date">30/07/2019 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c2 img-cir img-40">
                                                <i class="zmdi zmdi-account-box"></i>
                                            </div>
                                            <div class="content">
                                                <p>Sua conta foi alterada</p>
                                                <span class="date">30/07/2019 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c3 img-cir img-40">
                                                <i class="zmdi zmdi-file-text"></i>
                                            </div>
                                            <div class="content">
                                                <p>Você fez upload de um arquivo</p>
                                                <span class="date">30/07/2019 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__footer">
                                            <a href="#">Todas as notificações</a>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu icon-mobile"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="configuracoes">
                                                <i class="zmdi zmdi-account"></i>Conta</a>
                                        </div>
                                        <!--<div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Configurações</a>
                                        </div>-->
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Plano</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <!--<div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-globe"></i>Idioma</a>
                                        </div>-->
                                        
                                        
                                        <div class="account-dropdown__item">
                                            <a href="inbox.php">
                                                <i class="zmdi zmdi-notifications"></i>Notificações</a>
                                        </div>
										
										<div class="account-dropdown__item">
                                            <a href="login-seguro/logout.php">
                                                <i class="zmdi zmdi-mail-reply"></i>Sair</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>