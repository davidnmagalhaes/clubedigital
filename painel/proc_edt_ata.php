<?php 
//Conexão com banco de dados
include_once("config.php");

$club = $_POST['club'];

//Informações
$idreuniao = $_POST['idreuniao'];
$idpauta = $_POST['idpauta'];
$codata = rand();

$adicionalmesa = mysqli_real_escape_string($link,$_POST['adicional-mesa']);
$convirecup = mysqli_real_escape_string($link,$_POST['convi-recup']);
$secretaria = mysqli_real_escape_string($link,$_POST['secretaria']);
$comadmin = mysqli_real_escape_string($link,$_POST['com-admin']);
$subcomp = mysqli_real_escape_string($link,$_POST['sub-comp']);
$comproj = mysqli_real_escape_string($link,$_POST['com-proj']);
$comfundrot = mysqli_real_escape_string($link,$_POST['com-fund-rot']);
$comrelpubli = mysqli_real_escape_string($link,$_POST['com-rel-publi']);
$peqcom = mysqli_real_escape_string($link,$_POST['peq-com']);
$aprespales = mysqli_real_escape_string($link,$_POST['apres-pales']);
$tema = mysqli_real_escape_string($link,$_POST['tema']);
$presid = mysqli_real_escape_string($link,$_POST['presid']);
$encerramento = mysqli_real_escape_string($link,$_POST['encerramento']);

	$q = "SELECT * FROM rfa_ata WHERE id_pauta='$idpauta' AND clube='$club' AND id_reuniao='$idreuniao'";
	$pegaata = mysqli_query($link, $q) or die(mysqli_error($link));
	$row_pegaata = mysqli_fetch_assoc($pegaata);
	$totalRows_pegaata = mysqli_num_rows($pegaata);

if($totalRows_pegaata <= 0){

	$sql = "INSERT INTO rfa_ata (cod_ata, id_pauta, id_reuniao, adicional_mesa, convi_recup, secretaria, com_admin, sub_comp, com_proj, com_fund_rot, com_rel_publi, peq_com, apres_pales,tema, presid, encerramento, clube) VALUES ('$codata', '$idpauta', '$idreuniao', '$adicionalmesa', '$convirecup', '$secretaria', '$comadmin', '$subcomp', '$comproj', '$comfundrot', '$comrelpubli', '$peqcom', '$aprespales', '$tema', '$presid', '$encerramento', '$club');";
	
}else{
	$sql = "UPDATE rfa_ata SET adicional_mesa = '$adicionalmesa', convi_recup = '$convirecup', secretaria = '$secretaria', com_admin = '$comadmin', sub_comp = '$subcomp', com_proj = '$comproj', com_fund_rot = '$comfundrot', com_rel_publi = '$comrelpubli', peq_com = '$peqcom', apres_pales = '$aprespales',tema = '$tema', presid = '$presid', encerramento = '$encerramento' WHERE clube='$club' AND id_pauta = '$idpauta' AND id_reuniao = '$idreuniao';";

}

	
if ($link->multi_query($sql) === TRUE) {
				echo "<script>javascript:alert('Ata atualizada com sucesso!');javascript:window.location='pauta.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>