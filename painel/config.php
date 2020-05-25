<?php
// FileName="Connection_php_mysql.htm"
// Type="MYSQL"
// HTTP="true"
include("config-db.php");

$local = $hst;
$usuario = $user;
$senha = $pass;
$banco = $bd;
$link = mysqli_connect($local, $usuario, $senha, $banco);
 
if (!$link) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

mysqli_set_charset($link,"utf8");
 
 //Oculta os warnings
error_reporting(0);
//echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;
?>