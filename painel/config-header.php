<?php
//Inicia a sessão
session_start();

//Carrega conexão com banco
include("config.php");

if($_GET['clube']){
$clube = $_GET['clube'];
}else{
$clube = $_SESSION['clube'];
}
$funcao = $_SESSION['funcao'];

$sqsess= "SELECT * FROM rfa_acesso_paginas WHERE clube='$clube' AND nivel_acesso = '$funcao' AND pagina_id = '$page'";
$sessao = mysqli_query($link, $sqsess) or die(mysqli_error($link));
if($funcao == 1){
$row_sess = 1;
}else{
$row_sessao = mysqli_fetch_assoc($sessao);
$row_sess = $row_sessao['consulta_acesso'];
}

if(!isset($_SESSION['logado']) || $row_sess != 1){
    // Apaga todas as variáveis da sessão
$_SESSION = array();

// Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
// Nota: Isto destruirá a sessão, e não apenas os dados!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destrói a sessão
session_destroy();
// Por último, redireciona para a página de login
echo "<script>javascript:alert('Você não está autorizado(a) a acessar esta página! Consulte o administrador ou presidente do clube!');javascript:window.location='index.php'</script>";
}

//Carrega o logotipo do clube
$sqlogo = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$logotopo = mysqli_query($link, $sqlogo) or die(mysqli_error($link));
$row_logotopo = mysqli_fetch_assoc($logotopo);


?>