<?php
session_start();

if(!isset($_SESSION['logado']) || $_SESSION['funcao'] != $permissao):
	header("Location: ../index.php");
endif;


?>