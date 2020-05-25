<?php

//update.php
include("../config-db.php");
$connect = new PDO('mysql:host='.$hst.';dbname='.$bd, $user, $pass);
$connect->exec("set names utf8");

if(isset($_POST["id"]))
{
 $query = "
 UPDATE rfa_reuniao 
 SET nome_reuniao=:title, data_reuniao=:start_event, data_final_reuniao=:end_event, clube=:clube 
 WHERE id_reuniao=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':clube' => $_POST['clube'],
   ':id'   => $_POST['id']

  )
 );
}

?>
