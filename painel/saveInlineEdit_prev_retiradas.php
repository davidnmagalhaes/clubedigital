<?php

include_once("config.php");


$column = $_REQUEST["column"];
$value = $_REQUEST["value"];
$idinsc = $_REQUEST["id"];

$sql = "UPDATE rfa_prev_retiradas set ".$_REQUEST["column"]."='".$_REQUEST["value"]."' WHERE  id_prev_retiradas='".$_REQUEST["id"]."';";

if ($link->multi_query($sql) === TRUE) {
		
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>