<?php
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

session_start();
 
if(isset($_SESSION['logado']) &&  $_SESSION['logado'] == 'SIM'):
	header("Location: home.php");
endif; 

include('config.php');

$qdados = "SELECT * FROM rfa_config_email WHERE id_config='1'";
$buscadados = mysqli_query($link, $qdados) or die(mysqli_error($link));
$row_buscadados = mysqli_fetch_assoc($buscadados);
$publickey = $row_buscadados['publickey_recaptcha'];

$cadastrosucesso = $_GET['cadastrosucesso'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login - Gestão de Clube</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login-seguro/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login-seguro/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login-seguro/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login-seguro/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login-seguro/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login-seguro/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login-seguro/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login-seguro/css/util.css">
	<link rel="stylesheet" type="text/css" href="login-seguro/css/main.css">
<!--===============================================================================================-->
<script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('login-seguro/images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				
				<form id="login-form" class="login100-form validate-form" role="form" action="login-seguro/login.php" method="post">  
					<!--<div class="login100-form-avatar">
						<img src="login-seguro/images/avatar-01.jpg" alt="AVATAR">
					</div>-->
					
					<span class="login100-form-title p-t-20 p-b-45">
						<img src="images/clube-digital-white.png" width="350">
					</span>
					<?php if($cadastrosucesso==1){?>
					<div class="alert alert-success" id="success-alert">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Parabéns! </strong> <br>Agora aproveite seu período de avaliação para desfrutar de todas as ferramentas do Clube Digital!
</div>
					<?php } ?>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Digite um e-mail">
						<input class="input100" type="email" name="email" placeholder="E-mail">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Digite uma senha">
						<input class="input100" type="password" name="senha" placeholder="Senha" id="myInput">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
						
						
							
						
					</div>

					
					
					<div class="text-center w-full p-t-25" style="color: #cccccc;">
						<div>
							<div class="g-recaptcha custom-recaptcha" style="width: 80%; margin:0 auto" data-sitekey="<?php echo $publickey; ?>"></div>
						</div>	
						<input type="checkbox" onclick="myFunction()" style="margin-right: 5px;">Mostrar senha
					</div>

					<div class="container-login100-form-btn p-t-10">
						
							<button type="submit" class="login100-form-btn" name="btn-login" id="btn-login">
                                  Entrar
                                </button>
						
					</div>

					<div class="text-center w-full p-t-25 p-b-230">
						<a href="#" class="txt1">
							Esqueceu sua senha?
						</a>
					</div>

					<div class="text-center w-full">
						<a class="txt1" href="/register">
							Cadastro
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script>
	function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").fadeTo(6000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });

});
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="login-seguro/custom.js"></script>   
	
<!--===============================================================================================-->	
	<script src="login-seguro/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login-seguro/vendor/bootstrap/js/popper.js"></script>

<!--===============================================================================================-->
	<script src="login-seguro/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login-seguro/js/main.js"></script>

</body>
</html>