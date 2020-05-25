 <?php 
 /*  
  * Constantes de parâmetros para configuração da conexão  
  */  
include("../../../../../../config-db.php");

try {
  $conn = new PDO('mysql:host='.$hst.';dbname='.$bd.';charset=utf8', $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>
