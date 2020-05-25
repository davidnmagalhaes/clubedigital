<?php

include('painel/config.php');

$location =  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if($location == "www.rotaryalagadico.com.br/"){
	header('Location: painel/site/index.php?clube=1');
}else{
	echo "<h1>Site em manutenção!</h1>";
}

?>
