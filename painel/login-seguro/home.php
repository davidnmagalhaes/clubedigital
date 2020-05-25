<?php
include "verifica_sessao.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu Principal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style type="text/css">
    .margin-top-md{
        margin-top: 25px;
    }
    </style>
</head>
<body>   
    <div class="container">    
        <div id="loginbox" class="mainbox col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2 margin-top-md">                    
            <div class="panel panel-primary" >
                <div class="panel-heading">
                    <div class="panel-title">Menu - Olá (<?= $_SESSION['nome'] ?>)</div>
                </div>     

                <div class="col-sm-12 controls margin-top-md">
                  <a href="logout.php" class="btn-lg btn-danger">Sair </a>
                </div>
            </div>  
        </div>
    </div> 
</div>
</body>
</html>