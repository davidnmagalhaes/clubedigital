<?php

//delete.php

include("../config-db.php");

if(isset($_POST["id"]))
{
$connect = new PDO('mysql:host='.$hst.';dbname='.$bd, $user, $pass);
 $query = "
 DELETE from rfa_reuniao WHERE id_reuniao=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>