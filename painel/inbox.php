<?php 
$page = 2;

include('config-header.php');
$user = $_SESSION['id_usuario'];

$sql = "SELECT * FROM rfa_usuario WHERE funcao!=1 AND cod_usuario!='$user' AND clube='$clube'";
$usuarios = mysqli_query($link, $sql) or die(mysqli_error($link));

$sq = "SELECT * FROM rfa_mensagens INNER JOIN rfa_usuario ON rfa_mensagens.destinatario = rfa_usuario.cod_usuario WHERE tipo_mensagem=1 AND (remetente='$user' OR destinatario='$user') ORDER BY data_mensagem, hora_mensagem ASC;";
$privada = mysqli_query($link, $sq) or die(mysqli_error($link));

$sqsh = "SELECT * FROM rfa_mensagens INNER JOIN rfa_usuario ON rfa_mensagens.remetente = rfa_usuario.cod_usuario WHERE tipo_mensagem=2 ORDER BY data_mensagem, hora_mensagem DESC;";
$share = mysqli_query($link, $sqsh) or die(mysqli_error($link));

$sqlanalisa .= "UPDATE rfa_notificacao SET notificacao=1 WHERE id_usuario='$user';";

    if ($link->multi_query($sqlanalisa) === TRUE) {

    }

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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            

<div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-comment-text"></i>Mensages <strong>Privadas</strong></h3>
                                        <!--<button class="au-btn-plus">
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>-->
                                    </div>
                                    <div class="au-inbox-wrap">
                                        <div class="au-chat au-chat--border">
                                            <div class="au-chat__title">
                                                <div class="au-chat-info">
                                                    
                                                        <div class="avatar avatar--small">
                                                     
                                                            <?php if($_SESSION['imagem']==""){echo "<img src='images/001-user.svg'/>";}else{echo "<img src='login-seguro/".$_SESSION['imagem']."'";}?>
                                                        </div>
                                                    
                                                    <span class="nick">
                                                        <a href="#"><?= $_SESSION['nome'] ?></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="au-chat__content au-chat__content2 js-scrollbar5" id="conversa-priv">

                                                <?php while($row_privada = mysqli_fetch_array($privada)){?>

                                                <div class="<?php if($row_privada['remetente'] != $_SESSION['id_usuario']){echo 'recei';}else{echo 'send';} ?>-mess-wrap">
                                                    <span class="mess-time"><?php echo date('d/M',strtotime($row_privada['data_mensagem'])); ?> às <?php echo date('H:i',strtotime($row_privada['hora_mensagem'])); ?> 

                                                        <?php
                                                            $cdus = $row_privada['destinatario'];
                                                            $cdrem = $row_privada['remetente'];
                                                            $squ = "SELECT * FROM rfa_usuario WHERE funcao!=1 AND cod_usuario='$cdus';";
                                                            $usua = mysqli_query($link, $squ) or die(mysqli_error($link));
                                                            $row_usua = mysqli_fetch_array($usua);

                                                            $sqr = "SELECT * FROM rfa_usuario WHERE funcao!=1 AND cod_usuario='$cdrem';";
                                                            $rem = mysqli_query($link, $sqr) or die(mysqli_error($link));
                                                            $row_rem = mysqli_fetch_array($rem);

                                                            if($cdus == $user){
                                                                
                                                            }

                                                            if($cdrem != $user){
                                                                echo " - <strong>De:</strong> ".$row_rem['nome'];
                                                            }else{
                                                                echo " - <strong>Para:</strong> ".$row_usua['nome'];
                                                            }

                                                        ?>

                                                    </span>
                                                    <div class="<?php if($row_privada['remetente'] != $_SESSION['id_usuario']){echo 'recei';}else{echo 'send';} ?>-mess__inner">

                                                        <?php if($row_privada['remetente'] != $_SESSION['id_usuario']){ ?>
                                                            <?php if($cdrem != $user){ ?>
                                                        <div class="avatar avatar--tiny">
                                                            <img src="login-seguro/<?php echo $row_rem['imagem']; ?>" alt="<?php echo $row_rem['nome']; ?>" title="<?php echo $row_rem['nome']; ?>">
                                                        </div>
                                                            <?php } ?>
                                                        <?php } ?>

                                                        <div class="<?php if($row_privada['remetente'] != $_SESSION['id_usuario']){echo 'recei';}else{echo 'send';} ?>-mess-list">
                                                            <div class="<?php if($row_privada['remetente'] != $_SESSION['id_usuario']){echo 'recei';}else{echo 'send';} ?>-mess"><?php echo $row_privada['mensagem']; ?>
                                                               
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <?php } ?>
                                            </div>
                                            <div class="au-chat-textfield">
                                                <form class="au-form-icon" action="proc_mensagem.php" method="post">
                                                    <input type="hidden" name="remetente" value="<?php echo $_SESSION['id_usuario']; ?>">
                                                    <div class="row">
                                                        <div class="col" >
                                                            <select class="au-input au-input--full au-input--h65" name="tipo-mensagem" id="tipo-mensagem" onchange="showUser();" required>
                                                                <option>Selecione o tipo de mensagem...</option>
                                                                <option value="1">Mensagem Privada</option>
                                                                <option value="2">Mensagem Compartilhada</option>
                                                            </select>
                                                        </div>
                                                        <div class="col" style="display:none;" id="destinatario">
                                                        <select class="au-input au-input--full au-input--h65" name="destinatario">
                                                                <option value="0" selected>Selecione um destinatário...</option>
                                                                <?php while($row_usuarios = mysqli_fetch_array($usuarios)){?>
                                                                <option value="<?php echo $row_usuarios['cod_usuario']; ?>"><?php echo $row_usuarios['nome']; ?></option>
                                                                <?php } ?>
                                                        </select>
                                                        </div>
                                                    </div>

                                                    <input class="au-input au-input--full au-input--h65" maxlength="200" name="mensagem" type="text" placeholder="Digite uma mensagem (Máximo de 200 caractéres)">
                                                    <button class="au-input-icon" type="submit">
                                                        <i class="fas fa-paper-plane"></i>
                                                    </button>

                                                    
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-comment-text"></i>Mensagens <strong>Compartilhadas</strong></h3>
                                        <!--<button class="au-btn-plus">
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>-->
                                    </div>
                                    <div class="au-inbox-wrap js-inbox-wrap">
                                        <div class="au-message js-list-load">
                                            <!--<div class="au-message__noti">
                                                <p>Você tem
                                                    <span>2</span>

                                                    novas mensagens
                                                </p>
                                            </div>-->
                                            <div class="au-message-list">
                                                
                                                <?php while($row_share = mysqli_fetch_array($share)){?>
                                                <div class="au-message__item">
                                                    <div class="au-message__item-inner">
                                                        <div class="au-message__item-text">
                                                            <div class="avatar-wrap">
                                                                <div class="avatar">
                                                                    <img src="login-seguro/<?php echo $row_share['imagem']; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="text">
                                                                <h5 class="name"><?php echo $row_share['nome'];?></h5>
                                                                <p><?php echo $row_share['mensagem'];?></p>
                                                            </div>
                                                        </div>
                                                        <div class="au-message__item-time">
                                                            <span><?php echo date('d/m/Y',strtotime($row_share['data_mensagem']));?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                               
                                                
                                            </div>
                                            <!--<div class="au-message__footer">
                                                <button class="au-btn au-btn-load js-load-btn">ver mais</button>
                                            </div>-->
                                        </div>
                                        <div class="au-chat">
                                            <div class="au-chat__title">
                                                <div class="au-chat-info">
                                                    <div class="avatar-wrap online">
                                                        <div class="avatar avatar--small">
                                                            <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                        </div>
                                                    </div>
                                                    <span class="nick">
                                                        <a href="#">John Smith</a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="au-chat__content">
                                                <div class="recei-mess-wrap">
                                                    <span class="mess-time">12 Min ago</span>
                                                    <div class="recei-mess__inner">
                                                        <div class="avatar avatar--tiny">
                                                            <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                        </div>
                                                        <div class="recei-mess-list">
                                                            <div class="recei-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                                            <div class="recei-mess">Donec tempor, sapien ac viverra</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="send-mess-wrap">
                                                    <span class="mess-time">30 Sec ago</span>
                                                    <div class="send-mess__inner">
                                                        <div class="send-mess-list">
                                                            <div class="send-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="au-chat-textfield">
                                                <form class="au-form-icon">
                                                    <input class="au-input au-input--full au-input--h65" type="text" placeholder="Type a message">
                                                    <button class="au-input-icon">
                                                        <i class="zmdi zmdi-camera"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-account-calendar"></i>Tarefas</h3>
                                        <button class="au-btn-plus">
                                            <i class="zmdi zmdi-plus"></i>
                                        </button>
                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task__title">
                                            <p>Tarefas</p>
                                        </div>
                                        <div class="au-task-list js-scrollbar3">
                                            <div class="au-task__item au-task__item--danger">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Reunião do Rotary 2018</a>
                                                    </h5>
                                                    <span class="time">10:00</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--warning">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Reunião Conferência</a>
                                                    </h5>
                                                    <span class="time">11:00</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--primary">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Reunião Represe</a>
                                                    </h5>
                                                    <span class="time">14:00</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--success">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Reunião de Presidentes</a>
                                                    </h5>
                                                    <span class="time">09:30</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--danger js-load-item">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Reunião com GA's</a>
                                                    </h5>
                                                    <span class="time">12:00</span>
                                                </div>
                                            </div>
                                            <div class="au-task__item au-task__item--warning js-load-item">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">Reunião com Funcionários</a>
                                                    </h5>
                                                    <span class="time">15:00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-task__footer">
                                            <button class="au-btn au-btn-load js-load-btn">ver mais</button>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            

                        
                        </div>
                    </div>
                </div>
            </div>

            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <script>

    window.onload=function () {
    var objDiv = document.getElementById("conversa-priv");
    objDiv.scrollTop = objDiv.scrollHeight;
        }

        function showUser(){
            var tipomensagem = document.querySelector("#tipo-mensagem");
            var destinatario = document.querySelector("#destinatario");

            if(tipomensagem.value == 1){
                destinatario.style.display = "block";
            }else{
                destinatario.style.display = "none";
            }
        }
    </script>

    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->