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

$codpagar = $row_pegadespesa['cod_pagar'];
$nomefuncionario = $row_pegadespesa['nome_funcionario'];
$cargofuncionario = $row_pegadespesa['cargo_funcionario'];
$cpffuncionario = $row_pegadespesa['cpf_funcionario'];
$mesreferencia = '2020-'.$row_pegadespesa['mes_referencia'].'-01';
$anoreferencia = $row_pegadespesa['ano_referencia'];
$valor = $row_pegadespesa['valor_pagar'];
$descontossalario = $row_pegadespesa['descontos_salario'];
$referenciasalario = $row_pegadespesa['referencia_salario'];
$data = date('d/m/Y',strtotime($row_pegadespesa['data_pagar']));
$descricao = $row_pegadespesa['descricao_pagar'];

$contrinss = number_format($row_pegadespesa['contr_inss'],2,',','.');
$basefgts = number_format($row_pegadespesa['base_fgts'],2,',','.');
$fgtsmes = number_format($row_pegadespesa['fgts_mes'],2,',','.');
$baseirrf = number_format($row_pegadespesa['base_irrf'],2,',','.');
$faixairrf = $row_pegadespesa['faixa_irrf'];

$sqlvc = "SELECT * FROM rfa_pagar_venc WHERE clube='$clube' AND ref_pagar='$codpagar'";
$pegavc = mysqli_query($link, $sqlvc) or die(mysqli_error($link));
$row_pegavc = mysqli_fetch_assoc($pegavc);

$venc = "";
foreach($pegavc as $livencimentos){
    $venc .= "<tr>
    <td width='500' style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'>".$livencimentos['descricao_venc']."</td>
    <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'>".$livencimentos['referencia_venc']."</td>
    <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'>".number_format($livencimentos['valor_venc'],2,',','.')."</td>
    <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'>".number_format($livencimentos['descontos_venc'],2,',','.')."</td>
</tr>";
    $subtotalvenc += $livencimentos['valor_venc'];
    $subtotaldesc += $livencimentos['descontos_venc'];
}

    $totalvencimentos = $subtotalvenc + $valor;
    $totaldescontos = $subtotaldesc + $descontossalario;

    $totalliquido = $totalvencimentos - $totaldescontos;

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Fortaleza');

if (!empty($nomefuncionario) || !empty($cpffuncionario)) {

    $html = "
 
    <div style='width: 100%;min-height: 200px; border: 1px solid #000; text-align:center; padding: 20px; margin-top: 25px'>
    
     <table border='0'>
         <tr>
             <td style='background-image: linear-gradient(#fff, #beecbf); padding: 15px'>
                 <strong>RC ".$row_pegaclube['nome_clube']."</strong><br>
                 ".$row_pegaclube['endereco_clube'].", ".$row_pegaclube['numero_clube'].", ".$row_pegaclube['bairro_clube'].", ".$row_pegaclube['cidade_clube'].", ".$row_pegaclube['estado_clube']."<br>
                 <strong>CNPJ.:</strong> ".$row_pegaclube['cnpj_clube']."
             </td>
             <td style='background-image: linear-gradient(#fff, #beecbf); padding: 15px'>
                 <strong style='font-size: 20px; color: #00b050'>Recibo de Pagamento de Salário</strong><br>
                 ".ucfirst(strftime('%B', strtotime($mesreferencia)))." / ".$anoreferencia."
             </td>
         </tr>
         <tr>
             <td style='background-image: linear-gradient(#fff, #beecbf); padding: 15px'>
                 <strong>Nome do Funcionário</strong><br>
                 ".$nomefuncionario."
             </td>
             <td style='background-image: linear-gradient(#fff, #beecbf); padding: 15px'>
                 <strong>Cargo:</strong><br>
                 ".$cargofuncionario."
             </td>
         </tr>
     </table>
 
     <table cellpadding='0' cellspacing='0' border='0'>
         <tr>
             <th width='500'>Descrição</th>
             <th>Referência</th>
             <th>Vencimentos</th>
             <th>Descontos</th>
         </tr>
         <tr>
             <td width='500' style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'>SALÁRIO</td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'>".$referenciasalario."</td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'>".number_format($valor,2,',','.')."</td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'>".number_format($descontossalario,2,',','.')."</td>
         </tr>
         ".$venc."
         <tr>
             <td width='500' height='100' style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
         </tr>
         <tr>
             <td width='500' style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center; font-weight:bold'>Total de vencimentos</td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center;font-weight:bold'>Total de descontos</td>
         </tr>
         <tr>
             <td width='500' style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center;'>".number_format($totalvencimentos,2,',','.')."</td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center;'>".number_format($totaldescontos,2,',','.')."</td>
         </tr>
         <tr>
             <td width='500' style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             <td style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 3px; text-align:center'></td>
             
             <td colspan='2' style='background-image: linear-gradient(to right, #fff, #beecbf); padding: 10px; text-align:center;'><strong>Valor Líquido:</strong> ".number_format($totalliquido,2,',','.')."</td>
         </tr>
     </table>
 
     <table cellpadding='0' cellspacing='0' border='0'>
         <tr>
             <th style='background-image: linear-gradient(#fff, #beecbf); padding: 5px'>Salário Base</th>
             <th style='background-image: linear-gradient(#fff, #beecbf); padding: 5px'>Sal. Contr. INSS</th>
             <th style='background-image: linear-gradient(#fff, #beecbf); padding: 5px'>Base Cálc. FGTS</th>
             <th style='background-image: linear-gradient(#fff, #beecbf); padding: 5px'>FTGS do Mês</th>
             <th style='background-image: linear-gradient(#fff, #beecbf); padding: 5px'>Base Cálc. IRRF</th>
             <th style='background-image: linear-gradient(#fff, #beecbf); padding: 5px'>Faixa IRRF</th>
         </tr>
         <tr>
             <td style='background: #beecbf; padding: 3px; text-align:center'>".number_format($valor,2,',','.')."</td>
             <td style='background: #beecbf; padding: 3px; text-align:center'>".$contrinss."</td>
             <td style='background: #beecbf; padding: 3px; text-align:center'>".$basefgts."</td>
             <td style='background: #beecbf; padding: 3px; text-align:center'>".$fgtsmes."</td>
             <td style='background: #beecbf; padding: 3px; text-align:center'>".$baseirrf."</td>
             <td style='background: #beecbf; padding: 3px; text-align:center'>".$faixairrf."</td>
         </tr>
     </table>
     <table cellpadding='0' cellspacing='0' border='0' style='margin-top: 15px; padding: 5px'>
        <tr>
            <td colspan='2' style='padding-top: 10px;padding-bottom: 30px;background: #beecbf; text-align:center'>DECLARO TER RECEBIDO A IMPORTÂNCIA LÍQUIDA DISCRIMINADA NESTE RECIBO</td>
        </tr>
        <tr>
            <td style='background: #beecbf; padding: 3px; text-align:center'>
                ________/_______/_______<br>
                DATA
            </td>
            <td style='background: #beecbf; padding: 3px; text-align:center'>
                ___________________________________<br>
                ASSINATURA DO FUNCIONÁRIO
            </td>
        </tr>
     </table>
 
    
    
    </div>
    
 
     
     ";

}else{

    $html = "
 <fieldset>

 
<div style='width: 100%;min-height: 200px; border: 1px solid #000; text-align:center; padding: 20px; margin-top: 25px; margin-bottom: 250px'>
<div class='logo'><img src='logo-rotary.jpg' width='200'></div>
<h2>Recibo - RC ".$row_pegaclube['nome_clube']."</h2>

<table>
	

	<tr>
		<th style='width: 30%; text-align:left;'>Descrição: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$descricao."</td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>Valor: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>R$ ".number_format($valor,2,',','.')."</td>
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
            Este recibo comprova um pagamento realizado por RC ".$row_pegaclube['nome_clube']." conforme descrito acima.
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
		<th style='width: 30%; text-align:left;'>Descrição: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>".$descricao."</td>
	</tr>

	<tr>
		<th style='width: 30%; text-align:left;'>Valor: </th>
		<td style='border-bottom: 1px solid #000; width: 70%; height: 30px'>R$ ".number_format($valor,2,',','.')."</td>
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
            Este recibo comprova um pagamento realizado por RC ".$row_pegaclube['nome_clube']." conforme descrito acima.
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
 $mpdf->AddPage('L');
 $css = file_get_contents("css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output();

 exit;