<?php

//insert.php
include("../config-db.php");

$connect = new PDO('mysql:host='.$hst.';dbname='.$bd, $user, $pass);
$connect->exec("set names utf8");

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO rfa_reuniao 
 (nome_reuniao, data_reuniao, data_final_reuniao, clube) 
 VALUES (:title, :start_event, :end_event, :clube)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':clube' => $_POST['clube']
  )
 );
}


?>