<?php 
require_once __DIR__ . '/vendor/autoload.php';
include_once("../config.php");

$idpagar = $_GET['idpagar'];
$clube = $_GET['clube'];

//Pega informações do clube
$sql = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$pegaclube = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_pegaclube = mysqli_fetch_assoc($pegaclube);

//Pega informações de despesas
$sqlp = "SELECT * FROM rfa_pagar WHERE clube='$clube' AND id_pagar='$idpagar'";
$pegadespesa = mysqli_query($link, $sqlp) or die(mysqli_error($link));
$row_pegadespesa = mysqli_fetch_assoc($pegadespesa);

$nomefuncionario = $row_pegadespesa['nome_funcionario'];
$cpffuncionario = $row_pegadespesa['cpf_funcionario'];
$valor = number_format($row_pegadespesa['valor_pagar'],2,',','.');
$data = date('d/m/Y',strtotime($row_pegadespesa['data_pagar']));
$descricao = $row_pegadespesa['descricao_pagar'];

if (!empty($nomefuncionario) || !empty($cpffuncionario)) {

 $html = "
 <fieldset>

 
<div style='width: 100%;min-height: 200px; border: 1px solid #000; text-align:center; padding: 20px; margin-top: 25px'>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
<h2>Recibo - RC ".$row_pegaclube['nome_clube']."</h2>

<table>
	<tr>
		<th style='width: 30%; text-align:left;'>Nome do funcionário: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$nomefuncionario."</td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>CPF do Funcionário: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$cpffuncionario."</td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>Valor do Salário: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>R$ ".$valor."</td>
    </tr>
    
    <tr>
		<th style='width: 30%; text-align:left;'>Data do Pagamento: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$data."</td>
	</tr>
	<tr>
		<td style='height: 30px'></td>
	</tr>
	<tr>
        <th style='text-align:center; font-weight: 0;' colspan='2'>
            Este recibo comprova o pagamento de salário por ".$row_pegaclube['nome_clube']." ao funcionário acima citado.
		</th>
	</tr>

</table>

<div style='text-align:center; margin: 10px auto 0 auto;'><img src='../images/clube-digital.jpg' width='200' ></div>

</div>

<div style='width: 100%;min-height: 200px; border: 1px solid #000; text-align:center; padding: 20px;'>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
<h2>Recibo - RC ".$row_pegaclube['nome_clube']."</h2>

<table>
	<tr>
		<th style='width: 30%; text-align:left;'>Nome do funcionário: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$nomefuncionario."</td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>CPF do Funcionário: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$cpffuncionario."</td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>Valor do Salário: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>R$ ".$valor."</td>
    </tr>
    
    <tr>
		<th style='width: 30%; text-align:left;'>Data do Pagamento: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$data."</td>
	</tr>
	<tr>
		<td style='height: 30px'></td>
	</tr>
	<tr>
        <th style='text-align:center; font-weight: 0;' colspan='2'>
            Este recibo comprova o pagamento de salário por ".$row_pegaclube['nome_clube']." ao funcionário acima citado.
		</th>
	</tr>

</table>

<div style='text-align:center; margin: 10px auto 0 auto;'><img src='../images/clube-digital.jpg' width='200' ></div>

</div>


 </fieldset>
 
 ";

}else{

    $html = "
    <fieldset>
   
    
   <div style='width: 100%;min-height: 200px; border: 1px solid #000; text-align:center; padding: 20px; margin-top: 25px'>
   <div class='logo'><img src='logo-rotary.jpg' width='200'></div>
   <h2>Recibo - RC ".$row_pegaclube['nome_clube']."</h2>
   
   <table>
       <tr>
           <th style='width: 30%; text-align:left;'>Descrição: </th>
           <td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$descricao."</td>
       </tr>
   
       <tr>
           <th style='width: 30%; text-align:left;'>Valor: </th>
           <td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>R$ ".$valor."</td>
       </tr>
       
       <tr>
           <th style='width: 30%; text-align:left;'>Data: </th>
           <td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$data."</td>
       </tr>
       <tr>
           <td style='height: 30px'></td>
       </tr>
       <tr>
           <th style='text-align:center; font-weight: 0;' colspan='2'>
               Este recibo comprova o pagamento de uma despesa por ".$row_pegaclube['nome_clube'].".
           </th>
       </tr>
   
   </table>
   
   <div style='text-align:center; margin: 10px auto 0 auto;'><img src='../images/clube-digital.jpg' width='200' ></div>
   
   </div>
   
   <div style='width: 100%;min-height: 200px; border: 1px solid #000; text-align:center; padding: 20px; margin-top: 25px'>
   <div class='logo'><img src='logo-rotary.jpg' width='200'></div>
   <h2>Recibo - RC ".$row_pegaclube['nome_clube']."</h2>
   
   <table>
       <tr>
           <th style='width: 30%; text-align:left;'>Descrição: </th>
           <td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$descricao."</td>
       </tr>
   
       <tr>
           <th style='width: 30%; text-align:left;'>Valor: </th>
           <td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>R$ ".$valor."</td>
       </tr>
       
       <tr>
           <th style='width: 30%; text-align:left;'>Data: </th>
           <td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$data."</td>
       </tr>
       <tr>
           <td style='height: 30px'></td>
       </tr>
       <tr>
           <th style='text-align:center; font-weight: 0;' colspan='2'>
               Este recibo comprova o pagamento de uma despesa por ".$row_pegaclube['nome_clube'].".
           </th>
       </tr>
   
   </table>
   
   <div style='text-align:center; margin: 10px auto 0 auto;'><img src='../images/clube-digital.jpg' width='200' ></div>
   
   </div>
   
   
    </fieldset>
    
    ";

}

$mpdf = new \Mpdf\Mpdf();
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output();

 exit;