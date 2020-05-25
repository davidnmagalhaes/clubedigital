<?php 
//Conexão com banco de dados
include_once("config.php");

$idcategoria = $_GET['idcat'];
$club = $_GET['clube'];

$sq = "SELECT * FROM rfa_prev_pagar WHERE clube='$club' AND cat_prev_pagar='$idcategoria'";
$verpagar = mysqli_query($link, $sq) or die(mysqli_error($link));
$totalRows_verpagar = mysqli_num_rows($verpagar);

$sq1 = "SELECT * FROM rfa_prev_receitas WHERE clube='$club' AND cat_prev_receitas='$idcategoria'";
$verreceitas = mysqli_query($link, $sq1) or die(mysqli_error($link));
$totalRows_verreceitas = mysqli_num_rows($verreceitas);

$sq2 = "SELECT * FROM rfa_prev_fundos WHERE clube='$club' AND cat_prev_fundos='$idcategoria'";
$verfundos = mysqli_query($link, $sq2) or die(mysqli_error($link));
$totalRows_verfundos = mysqli_num_rows($verfundos);

if($totalRows_verfundos != 0 || $totalRows_verpagar != 0 || $totalRows_verreceitas != 0){
		echo "<script>javascript:alert('Esta categoria está associada a um ou mais registros  de receitas, despesas ou fundos! Verifique os registros antes de remover a categoria...');javascript:window.location='previsao.php'</script>";
}else{
	$sql = "DELETE FROM rfa_prev_categorias WHERE id_categoria='$idcategoria';";

	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Categoria removida com sucesso!');javascript:window.location='previsao.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
	
	

?>