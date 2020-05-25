<?php

//load.php


include("../config-db.php");
session_start();

$connect = new PDO('mysql:host='.$hst.';dbname='.$bd, $user, $pass);
$connect->exec("set names utf8");

$data = array();

$clube = $_SESSION['clube'];
$query = "SELECT * FROM rfa_reuniao WHERE clube='$clube' ORDER BY id_reuniao";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id_reuniao"],
  'title'   => $row["nome_reuniao"],
  'start'   => $row["data_reuniao"],
  'end'   => $row["data_final_reuniao"],
  'clube'   => $row["clube"]
 );
}

echo json_encode($data);

?>
