<?php
$localidade =  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$separalocal = explode('/', $localidade);
$local = $separalocal[0];

$sclube = "SELECT * FROM rfa_clubes WHERE urldominio='$local'";
$pclube = mysqli_query($link, $sclube) or die(mysqli_error($link));
$row_pclube = mysqli_fetch_assoc($pclube);
$totalrow_pclube = mysqli_num_rows($pclube);
$domain = $row_pclube['urldominio'];
$codclube = $row_pclube['id_clube'];

if($totalrow_pclube > 0){
$signal = 1;
$clube = $codclube;
}else{
$signal = 0;
if(isset($_GET['clube'])){
$clube = $_GET['clube'];
}else{
$clube = $_POST['clube'];
}
}

?>