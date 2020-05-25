<?php 
include_once("config.php");

$user = $_SESSION['id_usuario'];
$clube = $_SESSION['clube'];

$mes = date('Y-m-d', strtotime($hoje. ' + 1 month'));


$filtroano = $_GET['filtroano'];
$filtromes = $_GET['filtromes'];


//////////////////////////////////// Despesas///////////////////////////////////////////

$sql = "SELECT SUM(valor_pagar) as valor, data_pagar as datapagar FROM rfa_pagar WHERE clube='$clube'";
$despesa = mysqli_query($link, $sql) or die(mysqli_error($link));
$row_despesa = mysqli_fetch_assoc($despesa);


// JANEIRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 1 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesajan = round($row_despesa['valor']);
}else{
	$despesajan = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 1 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesajan = round($row_despesa['valor']);
}else{
	$despesajan = 0;
}
}
// FEVEREIRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 2 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesafev = round($row_despesa['valor']);
}else{
	$despesafev = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 2 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesafev = round($row_despesa['valor']);
}else{
	$despesafev = 0;
}
}
// MARÇO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 3 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesamar = round($row_despesa['valor']);
}else{
	$despesamar = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 3 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesamar = round($row_despesa['valor']);
}else{
	$despesamar = 0;
}
}
// ABRIL PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 4 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesaabr = round($row_despesa['valor']);
}else{
	$despesaabr = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 4 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesaabr = round($row_despesa['valor']);
}else{
	$despesaabr = 0;
}
}
// MAIO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 5 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesamai = round($row_despesa['valor']);
}else{
	$despesamai = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 5 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesamai = round($row_despesa['valor']);
}else{
	$despesamai = 0;
}
}
// JUNHO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 6 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesajun = round($row_despesa['valor']);
}else{
	$despesajun = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 6 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesajun = round($row_despesa['valor']);
}else{
	$despesajun = 0;
}
}
// JULHO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 7 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesajul = round($row_despesa['valor']);
}else{
	$despesajul = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 7 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesajul = round($row_despesa['valor']);
}else{
	$despesajul = 0;
}
}
// AGOSTO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 8 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesaago = round($row_despesa['valor']);
}else{
	$despesaago = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 8 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesaago = round($row_despesa['valor']);
}else{
	$despesaago = 0;
}
}
// SETEMBRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 9 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesaset = round($row_despesa['valor']);
}else{
	$despesaset = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 9 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesaset = round($row_despesa['valor']);
}else{
	$despesaset = 0;
}
}
// OUTUBRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 10 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesaout = round($row_despesa['valor']);
}else{
	$despesaout = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 10 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesaout = round($row_despesa['valor']);
}else{
	$despesaout = 0;
}
}
// NOVEMBRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 11 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesanov = round($row_despesa['valor']);
}else{
	$despesanov = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 11 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesanov = round($row_despesa['valor']);
}else{
	$despesanov = 0;
}
}
// DEZEMBRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_despesa['datapagar'])) == 12 && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
	$despesadez = round($row_despesa['valor']);
}else{
	$despesadez = 0;
}
}else{
if(date('m',strtotime($row_despesa['datapagar'])) == 12 && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
	$despesadez = round($row_despesa['valor']);
}else{
	$despesadez = 0;
}
}

// Despesas Pagas
$query = "SELECT SUM(valor_pagar) as valorpago FROM rfa_pagar WHERE clube='$clube' AND status_pagar='2'";
$despesapaga = mysqli_query($link, $query) or die(mysqli_error($link));
$row_despesapaga = mysqli_fetch_assoc($despesapaga);

///////////////////////////// Receitas//////////////////////////////
$sq = "SELECT SUM(valor_receita) as valorreceita, data_receita as datareceita FROM rfa_receitas WHERE clube='$clube'";
$receita = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_receita = mysqli_fetch_assoc($receita);

// JANEIRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 1 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitajan = round($row_receita['valorreceita']); 
}else{
	$receitajan = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 1 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitajan = round($row_receita['valorreceita']); 
}else{
	$receitajan = 0;
}
}

// FEVEREIRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 2 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitafev = round($row_receita['valorreceita']); 
}else{
	$receitafev = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 2 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitafev = round($row_receita['valorreceita']); 
}else{
	$receitafev = 0;
}
}

// MARÇO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 3 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitamar = round($row_receita['valorreceita']); 
}else{
	$receitamar = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 3 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitamar = round($row_receita['valorreceita']); 
}else{
	$receitamar = 0;
}
}

// ABRIL PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 4 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitaabr = round($row_receita['valorreceita']); 
}else{
	$receitaabr = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 4 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitaabr = round($row_receita['valorreceita']); 
}else{
	$receitaabr = 0;
}
}

// MAIO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 5 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitamai = round($row_receita['valorreceita']); 
}else{
	$receitamai = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 5 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitamai = round($row_receita['valorreceita']); 
}else{
	$receitamai = 0;
}
}

// JUNHO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 6 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitajun = round($row_receita['valorreceita']); 
}else{
	$receitajun = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 6 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitajun = round($row_receita['valorreceita']); 
}else{
	$receitajun = 0;
}
}

// JULHO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 7 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitajul = round($row_receita['valorreceita']); 
}else{
	$receitajul = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 7 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitajul = round($row_receita['valorreceita']); 
}else{
	$receitajul = 0;
}
}

// AGOSTO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 8 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitaago = round($row_receita['valorreceita']); 
}else{
	$receitaago = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 8 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitaago = round($row_receita['valorreceita']); 
}else{
	$receitaago = 0;
}
}

// SETEMBRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 9 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitaset = round($row_receita['valorreceita']); 
}else{
	$receitaset = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 9 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitaset = round($row_receita['valorreceita']); 
}else{
	$receitaset = 0;
}
}

// OUTUBRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 10 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitaout = round($row_receita['valorreceita']); 
}else{
	$receitaout = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 10 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitaout = round($row_receita['valorreceita']); 
}else{
	$receitaout = 0;
}
}

// NOVEMBRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 11 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitanov = round($row_receita['valorreceita']); 
}else{
	$receitanov = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 11 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitanov = round($row_receita['valorreceita']); 
}else{
	$receitanov = 0;
}
}

// DEZEMBRO PARA O GRÁFICO
if($filtroano == ""){
if(date('m',strtotime($row_receita['datareceita'])) == 12 && date('Y',strtotime($row_receita['datareceita'])) == date("Y")){
	$receitadez = round($row_receita['valorreceita']); 
}else{
	$receitadez = 0;
}
}else{
if(date('m',strtotime($row_receita['datareceita'])) == 12 && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
	$receitadez = round($row_receita['valorreceita']); 
}else{
	$receitadez = 0;
}
}
///////////////////////////////////////////////////////////////////

// A Receber
$q = "SELECT SUM(valor_receber) as valorreceber, data_receber as datareceber FROM rfa_receber WHERE clube='$clube'";
$receber = mysqli_query($link, $q) or die(mysqli_error($link));
$row_receber = mysqli_fetch_assoc($receber);

// Receitas Pagas
$quer = "SELECT SUM(valor_receita) as valorreceitapaga FROM rfa_receitas WHERE clube='$clube' AND status_receita='2'";
$receitapaga = mysqli_query($link, $quer) or die(mysqli_error($link));
$row_receitapaga = mysqli_fetch_assoc($receitapaga);

// Caixa
if($filtroano == "" || $filtromes == ""){
$matual = date("m");
$s = "SELECT SUM(saldo) as saldo FROM rfa_bancos WHERE clube='$clube' AND MONTH(data_cadastro) <= '$matual'";
$contabanco = mysqli_query($link, $s) or die(mysqli_error($link));
$row_contabanco = mysqli_fetch_assoc($contabanco);
}else{
$s = "SELECT SUM(saldo) as saldo FROM rfa_bancos WHERE clube='$clube' AND MONTH(data_cadastro) <= '$filtromes'";
$contabanco = mysqli_query($link, $s) or die(mysqli_error($link));
$row_contabanco = mysqli_fetch_assoc($contabanco);
}

////////////////////////////////////// START - PARA SOMAR AS MENSALIDADES A RECEBER AO CAMPO A RECEBER //////////////////////////////////////////////

if($filtroano == "" || $filtromes == ""){
$mesa = date('m');
$anoa = date('Y');
// Pegar mensalidades devidas
$sqlina = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimpa, mensalidade_vencimento as vencmena, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE rfs_socios.clube='$clube' AND MONTH(rfs_socios.data_cadastro) = '$mesa' AND YEAR(rfs_socios.data_cadastro) = '$anoa'";
$inadimpa = mysqli_query($link, $sqlina) or die(mysqli_error($link));
$row_inadimpa = mysqli_fetch_assoc($inadimpa);

// Pegar mensalidades pagas
$sqlpga = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgtoa FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mesa' AND YEAR(mes_ref) = '$anoa'";
$valorpagoa = mysqli_query($link, $sqlpga) or die(mysqli_error($link));
$row_valorpagoa = mysqli_fetch_assoc($valorpagoa);

}else{
// Pegar mensalidades devidas
$sqlina = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimpa, mensalidade_vencimento as vencmena, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE rfs_socios.clube='$clube' AND MONTH(rfs_socios.data_cadastro) = '$filtromes' AND YEAR(rfs_socios.data_cadastro) = '$filtroano'";
$inadimpa = mysqli_query($link, $sqlina) or die(mysqli_error($link));
$row_inadimpa = mysqli_fetch_assoc($inadimpa);

// Pegar mensalidades pagas
$sqlpga = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgtoa FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$filtromes' AND YEAR(mes_ref) = '$filtroano'";
$valorpagoa = mysqli_query($link, $sqlpga) or die(mysqli_error($link));
$row_valorpagoa = mysqli_fetch_assoc($valorpagoa);

}





////////////////////////////////////// END - PARA SOMAR AS MENSALIDADES A RECEBER AO CAMPO A RECEBER //////////////////////////////////////////////

////////////////////////////////////// START - CÁLCULOS INADIMPLENTES MÊS E ANO ATUAIS //////////////////////////////////////////////
// Pegar mensalidades devidas
$mesatual = date('m');
$anoatual = date('Y');
$diaatual = date('d');

//Retorna 11º mês
$mespass = date('m') - 1;
$mespass2 = $filtromes - 1;

//Retorna 10º mês
$mespass3 = date('m') - 2;
$mespass4 = $filtromes - 2;

//Retorna 9º mês
$mespass5 = date('m') - 3;
$mespass6 = $filtromes - 3;

//Retorna 8º mês
$mespass7 = date('m') - 4;
$mespass8 = $filtromes - 4;

//Retorna 7º mês
$mespass9 = date('m') - 5;
$mespass10 = $filtromes - 5;

//Retorna 6º mês
$mespass11 = date('m') - 6;
$mespass12 = $filtromes - 6;

//Retorna 5º mês
$mespass13 = date('m') - 7;
$mespass14 = $filtromes - 7;

//Retorna 4º mês
$mespass15 = date('m') - 8;
$mespass16 = $filtromes - 8;

//Retorna 3º mês
$mespass17 = date('m') - 9;
$mespass18 = $filtromes - 9;

//Retorna 2º mês
$mespass19 = date('m') - 10;
$mespass20 = $filtromes - 10;

//Retorna 1º mês
$mespass21 = date('m') - 11;
$mespass22 = $filtromes - 11;


if($filtroano == "" || $filtromes == ""){ //SE O FILTRO FOR VAZIO


$sqlin = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mesatual' AND YEAR(data_cadastro) <= '$anoatual' AND mensalidade_diavenc < '$diaatual'";
$inadimp = mysqli_query($link, $sqlin) or die(mysqli_error($link));
$row_inadimp = mysqli_fetch_assoc($inadimp);

$sqlinteste = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass' AND YEAR(data_cadastro) <= '$anoatual'";
$inadimpteste = mysqli_query($link, $sqlinteste) or die(mysqli_error($link));
$row_inadimpteste = mysqli_fetch_assoc($inadimpteste);

$sqlin3 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass3' AND YEAR(data_cadastro) <= '$anoatual'";
$inadimp3 = mysqli_query($link, $sqlin3) or die(mysqli_error($link));
$row_inadimp3 = mysqli_fetch_assoc($inadimp3);

$sqlin4 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass5' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp4 = mysqli_query($link, $sqlin4) or die(mysqli_error($link));
$row_inadimp4 = mysqli_fetch_assoc($inadimp4);

$sqlin5 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass7' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp5 = mysqli_query($link, $sqlin5) or die(mysqli_error($link));
$row_inadimp5 = mysqli_fetch_assoc($inadimp5);

$sqlin6 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass9' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp6 = mysqli_query($link, $sqlin6) or die(mysqli_error($link));
$row_inadimp6 = mysqli_fetch_assoc($inadimp6);

$sqlin7 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass11' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp7 = mysqli_query($link, $sqlin7) or die(mysqli_error($link));
$row_inadimp7 = mysqli_fetch_assoc($inadimp7);

$sqlin8 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass13' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp8 = mysqli_query($link, $sqlin8) or die(mysqli_error($link));
$row_inadimp8 = mysqli_fetch_assoc($inadimp8);

$sqlin9 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass15' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp9 = mysqli_query($link, $sqlin9) or die(mysqli_error($link));
$row_inadimp9 = mysqli_fetch_assoc($inadimp9);

$sqlin10 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass17' AND YEAR(data_cadastro) <= '$anoatual'";
$inadimp10 = mysqli_query($link, $sqlin10) or die(mysqli_error($link));
$row_inadimp10 = mysqli_fetch_assoc($inadimp10);

$sqlin11 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass19' AND YEAR(data_cadastro) <= '$anoatual'";
$inadimp11 = mysqli_query($link, $sqlin11) or die(mysqli_error($link));
$row_inadimp11 = mysqli_fetch_assoc($inadimp11);

$sqlin12 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass21' AND YEAR(data_cadastro) <= '$anoatual'";
$inadimp12 = mysqli_query($link, $sqlin12) or die(mysqli_error($link));
$row_inadimp12 = mysqli_fetch_assoc($inadimp12);

}elseif($filtroano == $anoatual && $filtromes == $mesatual){ //SE O FILTRO FOR IGUAL AO ANO E MÊS ATUAL


$sqlin = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mesatual' AND YEAR(data_cadastro) <= '$anoatual'  AND mensalidade_diavenc < '$diaatual'";
$inadimp = mysqli_query($link, $sqlin) or die(mysqli_error($link));
$row_inadimp = mysqli_fetch_assoc($inadimp);

$sqlinteste = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass' AND YEAR(data_cadastro) <= '$anoatual'";
$inadimpteste = mysqli_query($link, $sqlinteste) or die(mysqli_error($link));
$row_inadimpteste = mysqli_fetch_assoc($inadimpteste);

$sqlin3 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass3' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp3 = mysqli_query($link, $sqlin3) or die(mysqli_error($link));
$row_inadimp3 = mysqli_fetch_assoc($inadimp3);

$sqlin4 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass5' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp4 = mysqli_query($link, $sqlin4) or die(mysqli_error($link));
$row_inadimp4 = mysqli_fetch_assoc($inadimp4);

$sqlin5 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass7' AND YEAR(data_cadastro) <= '$anoatual'";
$inadimp5 = mysqli_query($link, $sqlin5) or die(mysqli_error($link));
$row_inadimp5 = mysqli_fetch_assoc($inadimp5);

$sqlin6 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass9' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp6 = mysqli_query($link, $sqlin6) or die(mysqli_error($link));
$row_inadimp6 = mysqli_fetch_assoc($inadimp6);

$sqlin7 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass11' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp7 = mysqli_query($link, $sqlin7) or die(mysqli_error($link));
$row_inadimp7 = mysqli_fetch_assoc($inadimp7);

$sqlin8 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass13' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp8 = mysqli_query($link, $sqlin8) or die(mysqli_error($link));
$row_inadimp8 = mysqli_fetch_assoc($inadimp8);

$sqlin9 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass15' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp9 = mysqli_query($link, $sqlin9) or die(mysqli_error($link));
$row_inadimp9 = mysqli_fetch_assoc($inadimp9);

$sqlin10 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass17' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp10 = mysqli_query($link, $sqlin10) or die(mysqli_error($link));
$row_inadimp10 = mysqli_fetch_assoc($inadimp10);

$sqlin11 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass19' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp11 = mysqli_query($link, $sqlin11) or die(mysqli_error($link));
$row_inadimp11 = mysqli_fetch_assoc($inadimp11);

$sqlin12 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass21' AND YEAR(data_cadastro) <= '$anoatual' ";
$inadimp12 = mysqli_query($link, $sqlin12) or die(mysqli_error($link));
$row_inadimp12 = mysqli_fetch_assoc($inadimp12);


}else{ //SE O FILTRO FOR DIFERENTE DO ANO E MÊS ATUAL


$sqlin = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$filtromes' AND YEAR(data_cadastro) <= '$filtroano' AND mensalidade_diavenc < '$diaatual'";
$inadimp = mysqli_query($link, $sqlin) or die(mysqli_error($link));
$row_inadimp = mysqli_fetch_assoc($inadimp);

$sqlinteste = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass2' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimpteste = mysqli_query($link, $sqlinteste) or die(mysqli_error($link));
$row_inadimpteste = mysqli_fetch_assoc($inadimpteste);

$sqlin3 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass4' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp3 = mysqli_query($link, $sqlin3) or die(mysqli_error($link));
$row_inadimp3 = mysqli_fetch_assoc($inadimp3);

$sqlin4 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass6' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp4 = mysqli_query($link, $sqlin4) or die(mysqli_error($link));
$row_inadimp4 = mysqli_fetch_assoc($inadimp4);

$sqlin5 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass8' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp5 = mysqli_query($link, $sqlin5) or die(mysqli_error($link));
$row_inadimp5 = mysqli_fetch_assoc($inadimp5);

$sqlin6 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass10' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp6 = mysqli_query($link, $sqlin6) or die(mysqli_error($link));
$row_inadimp6 = mysqli_fetch_assoc($inadimp6);

$sqlin7 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass12' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp7 = mysqli_query($link, $sqlin7) or die(mysqli_error($link));
$row_inadimp7 = mysqli_fetch_assoc($inadimp7);

$sqlin8 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass14' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp8 = mysqli_query($link, $sqlin8) or die(mysqli_error($link));
$row_inadimp8 = mysqli_fetch_assoc($inadimp8);

$sqlin9 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass16' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp9 = mysqli_query($link, $sqlin9) or die(mysqli_error($link));
$row_inadimp9 = mysqli_fetch_assoc($inadimp9);

$sqlin10 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass18' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp10 = mysqli_query($link, $sqlin10) or die(mysqli_error($link));
$row_inadimp10 = mysqli_fetch_assoc($inadimp10);

$sqlin11 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass20' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp11 = mysqli_query($link, $sqlin11) or die(mysqli_error($link));
$row_inadimp11 = mysqli_fetch_assoc($inadimp11);

$sqlin12 = "SELECT SUM(rfs_socios.mensalidade_valor) as vrinadimp, mensalidade_vencimento as vencmen, data_cadastro as datacadastro, mensalidade_diavenc as diavenc FROM rfs_socios WHERE clube='$clube' AND MONTH(data_cadastro) <= '$mespass22' AND YEAR(data_cadastro) <= '$filtroano' ";
$inadimp12 = mysqli_query($link, $sqlin12) or die(mysqli_error($link));
$row_inadimp12 = mysqli_fetch_assoc($inadimp12);

}

// Pegar mensalidades pagas
if($filtroano == "" || $filtromes == ""){
	
	
$sqlpg = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mesatual' AND YEAR(mes_ref) = '$anoatual'";
$valorpago = mysqli_query($link, $sqlpg) or die(mysqli_error($link));
$row_valorpago = mysqli_fetch_assoc($valorpago);

$sqlpgteste = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass' AND YEAR(mes_ref) = '$anoatual'";
$valorpagoteste = mysqli_query($link, $sqlpgteste) or die(mysqli_error($link));
$row_valorpagoteste = mysqli_fetch_assoc($valorpagoteste);

$sqlpg3 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass3' AND YEAR(mes_ref) = '$anoatual'";
$valorpago3 = mysqli_query($link, $sqlpg3) or die(mysqli_error($link));
$row_valorpago3 = mysqli_fetch_assoc($valorpago3);

$sqlpg4 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass5' AND YEAR(mes_ref) = '$anoatual'";
$valorpago4 = mysqli_query($link, $sqlpg4) or die(mysqli_error($link));
$row_valorpago4 = mysqli_fetch_assoc($valorpago4);

$sqlpg5 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass7' AND YEAR(mes_ref) = '$anoatual'";
$valorpago5 = mysqli_query($link, $sqlpg5) or die(mysqli_error($link));
$row_valorpago5 = mysqli_fetch_assoc($valorpago5);

$sqlpg6 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass9' AND YEAR(mes_ref) = '$anoatual'";
$valorpago6 = mysqli_query($link, $sqlpg6) or die(mysqli_error($link));
$row_valorpago6 = mysqli_fetch_assoc($valorpago6);

$sqlpg7 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass11' AND YEAR(mes_ref) = '$anoatual'";
$valorpago7 = mysqli_query($link, $sqlpg7) or die(mysqli_error($link));
$row_valorpago7 = mysqli_fetch_assoc($valorpago7);

$sqlpg8 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass13' AND YEAR(mes_ref) = '$anoatual'";
$valorpago8 = mysqli_query($link, $sqlpg8) or die(mysqli_error($link));
$row_valorpago8 = mysqli_fetch_assoc($valorpago8);

$sqlpg9 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass15' AND YEAR(mes_ref) = '$anoatual'";
$valorpago9 = mysqli_query($link, $sqlpg9) or die(mysqli_error($link));
$row_valorpago9 = mysqli_fetch_assoc($valorpago9);

$sqlpg10 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass17' AND YEAR(mes_ref) = '$anoatual'";
$valorpago10 = mysqli_query($link, $sqlpg10) or die(mysqli_error($link));
$row_valorpago10 = mysqli_fetch_assoc($valorpago10);

$sqlpg11 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass19' AND YEAR(mes_ref) = '$anoatual'";
$valorpago11 = mysqli_query($link, $sqlpg11) or die(mysqli_error($link));
$row_valorpago11 = mysqli_fetch_assoc($valorpago11);

$sqlpg12 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass21' AND YEAR(mes_ref) = '$anoatual'";
$valorpago12 = mysqli_query($link, $sqlpg12) or die(mysqli_error($link));
$row_valorpago12 = mysqli_fetch_assoc($valorpago12);

}else{
$sqlpg = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$filtromes' AND YEAR(mes_ref) = '$filtroano'";
$valorpago = mysqli_query($link, $sqlpg) or die(mysqli_error($link));
$row_valorpago = mysqli_fetch_assoc($valorpago);

$sqlpgteste = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass2' AND YEAR(mes_ref) = '$filtroano'";
$valorpagoteste = mysqli_query($link, $sqlpgteste) or die(mysqli_error($link));
$row_valorpagoteste = mysqli_fetch_assoc($valorpagoteste);

$sqlpg3 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass4' AND YEAR(mes_ref) = '$filtroano'";
$valorpago3 = mysqli_query($link, $sqlpg3) or die(mysqli_error($link));
$row_valorpago3 = mysqli_fetch_assoc($valorpago3);

$sqlpg4 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass6' AND YEAR(mes_ref) = '$filtroano'";
$valorpago4 = mysqli_query($link, $sqlpg4) or die(mysqli_error($link));
$row_valorpago4 = mysqli_fetch_assoc($valorpago4);

$sqlpg5 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass8' AND YEAR(mes_ref) = '$filtroano'";
$valorpago5 = mysqli_query($link, $sqlpg5) or die(mysqli_error($link));
$row_valorpago5 = mysqli_fetch_assoc($valorpago5);

$sqlpg6 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass10' AND YEAR(mes_ref) = '$filtroano'";
$valorpago6 = mysqli_query($link, $sqlpg6) or die(mysqli_error($link));
$row_valorpago6 = mysqli_fetch_assoc($valorpago6);

$sqlpg7 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass12' AND YEAR(mes_ref) = '$filtroano'";
$valorpago7 = mysqli_query($link, $sqlpg7) or die(mysqli_error($link));
$row_valorpago7 = mysqli_fetch_assoc($valorpago7);

$sqlpg8 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass14' AND YEAR(mes_ref) = '$filtroano'";
$valorpago8 = mysqli_query($link, $sqlpg8) or die(mysqli_error($link));
$row_valorpago8 = mysqli_fetch_assoc($valorpago8);

$sqlpg9 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass16' AND YEAR(mes_ref) = '$filtroano'";
$valorpago9 = mysqli_query($link, $sqlpg9) or die(mysqli_error($link));
$row_valorpago9 = mysqli_fetch_assoc($valorpago9);

$sqlpg10 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass18' AND YEAR(mes_ref) = '$filtroano'";
$valorpago10 = mysqli_query($link, $sqlpg10) or die(mysqli_error($link));
$row_valorpago10 = mysqli_fetch_assoc($valorpago10);

$sqlpg11 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass20' AND YEAR(mes_ref) = '$filtroano'";
$valorpago11 = mysqli_query($link, $sqlpg11) or die(mysqli_error($link));
$row_valorpago11 = mysqli_fetch_assoc($valorpago11);

$sqlpg12 = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgto FROM rfa_pgto_mensalidades WHERE rfa_pgto_mensalidades.clube='$clube' AND MONTH(mes_ref) = '$mespass22' AND YEAR(mes_ref) = '$filtroano'";
$valorpago12 = mysqli_query($link, $sqlpg12) or die(mysqli_error($link));
$row_valorpago12 = mysqli_fetch_assoc($valorpago12);

}
////////////////////////////////////// END - CÁLCULOS INADIMPLENTES MÊS E ANO ATUAIS //////////////////////////////////////////////

//Totais mês atual (12º Mês)
$mensdevidas = $row_inadimp['vrinadimp'] ;
$menspagas = $row_valorpago['vrpgto'];

//Totais (11º Mês)
$mensdevidasteste = $row_inadimpteste['vrinadimp'] ;
$menspagasteste = $row_valorpagoteste['vrpgto'];

//Totais (10º Mês)
$mensdevidas3 = $row_inadimp3['vrinadimp'] ;
$menspagas3 = $row_valorpago3['vrpgto'];

//Totais (9º Mês)
$mensdevidas4 = $row_inadimp4['vrinadimp'] ;
$menspagas4 = $row_valorpago4['vrpgto'];

//Totais (8º Mês)
$mensdevidas5 = $row_inadimp5['vrinadimp'] ;
$menspagas5 = $row_valorpago5['vrpgto'];

//Totais (7º Mês)
$mensdevidas6 = $row_inadimp6['vrinadimp'] ;
$menspagas6 = $row_valorpago6['vrpgto'];

//Totais (6º Mês)
$mensdevidas7 = $row_inadimp7['vrinadimp'] ;
$menspagas7 = $row_valorpago7['vrpgto'];

//Totais (5º Mês)
$mensdevidas8 = $row_inadimp8['vrinadimp'] ;
$menspagas8 = $row_valorpago8['vrpgto'];

//Totais (4º Mês)
$mensdevidas9 = $row_inadimp9['vrinadimp'] ;
$menspagas9 = $row_valorpago9['vrpgto'];

//Totais (3º Mês)
$mensdevidas10 = $row_inadimp10['vrinadimp'] ;
$menspagas10 = $row_valorpago10['vrpgto'];

//Totais (2º Mês)
$mensdevidas11 = $row_inadimp11['vrinadimp'] ;
$menspagas11 = $row_valorpago11['vrpgto'];

//Totais (1º Mês)
$mensdevidas12 = $row_inadimp12['vrinadimp'] ;
$menspagas12 = $row_valorpago12['vrpgto'];

// SOMA DE TODAS AS INADIMPLÊNCIAS DURANTE OS 12 MESES PASSADOS DESDE A DATA ATUAL
$resmens = ($mensdevidas - $menspagas) + ($mensdevidasteste - $menspagasteste) + ($mensdevidas3 - $menspagas3) + ($mensdevidas4 - $menspagas4) + ($mensdevidas5 - $menspagas5) + ($mensdevidas6 - $menspagas6) + ($mensdevidas7 - $menspagas7) + ($mensdevidas8 - $menspagas8) + ($mensdevidas9 - $menspagas9) + ($mensdevidas10 - $menspagas10) + ($mensdevidas11 - $menspagas11) + ($mensdevidas12 - $menspagas12); 


// PEGA MENSALIDADES PAGAS E ADICIONA AO SALDO GERAL
if($filtromes == "" || $filtroano == ""){
$spga = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgtoa FROM rfa_pgto_mensalidades WHERE clube='$clube' AND MONTH(data_cadastro) = '$mesatual' AND YEAR(data_cadastro) = '$anoatual'";
$vlrpagoa = mysqli_query($link, $spga) or die(mysqli_error($link));
$row_vlrpagoa = mysqli_fetch_assoc($vlrpagoa);
}else{
$spga = "SELECT SUM(rfa_pgto_mensalidades.valor_pgto) as vrpgtoa FROM rfa_pgto_mensalidades WHERE clube='$clube' AND MONTH(data_cadastro) = '$filtromes' AND YEAR(data_cadastro) = '$filtroano'";
$vlrpagoa = mysqli_query($link, $spga) or die(mysqli_error($link));
$row_vlrpagoa = mysqli_fetch_assoc($vlrpagoa);
}

// PEGA TAXAS DAS MENSALIDADES PAGAS
if($filtromes == "" || $filtroano == ""){
$stx = "SELECT SUM(rfa_pgto_mensalidades.taxa) as tx FROM rfa_pgto_mensalidades WHERE clube='$clube' AND MONTH(data_cadastro) = '$mesatual' AND YEAR(data_cadastro) = '$anoatual'";
$vlrtx = mysqli_query($link, $stx) or die(mysqli_error($link));
$row_vlrtx = mysqli_fetch_assoc($vlrtx);
}else{
$stx = "SELECT SUM(rfa_pgto_mensalidades.taxa) as tx FROM rfa_pgto_mensalidades WHERE clube='$clube' AND MONTH(data_cadastro) = '$filtromes' AND YEAR(data_cadastro) = '$filtroano'";
$vlrtx = mysqli_query($link, $stx) or die(mysqli_error($link));
$row_vlrtx = mysqli_fetch_assoc($vlrtx);
}

//LISTA DE INADIMPLENTES DO MÊS
if($filtromes == "" || $filtroano == ""){
$qrlis = "SELECT * FROM rfs_socios WHERE MONTH(data_cadastro)='$mesatual' AND YEAR(data_cadastro)= '$anoatual' AND mensalidade_diavenc < '$diaatual' AND clube='$clube' AND id_socio NOT IN (SELECT ref_socio FROM rfa_pgto_mensalidades WHERE MONTH(mes_ref) = '$mesatual') ";
$lisin= mysqli_query($link, $qrlis) or die(mysqli_error($link));
$row_lisin = mysqli_fetch_assoc($lisin);
$totalRows_lisin = mysqli_num_rows($lisin);
}else{
$qrlis = "SELECT * FROM rfs_socios WHERE MONTH(data_cadastro)='$filtromes' AND YEAR(data_cadastro)= '$filtroano' AND mensalidade_diavenc < '$diaatual' AND clube='$clube' AND id_socio NOT IN (SELECT ref_socio FROM rfa_pgto_mensalidades WHERE MONTH(mes_ref) = '$filtromes') ";
$lisin= mysqli_query($link, $qrlis) or die(mysqli_error($link));
$row_lisin = mysqli_fetch_assoc($lisin);
$totalRows_lisin = mysqli_num_rows($lisin);
}
?>

<!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <!--<div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">You are here:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="#">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Dashboard</li>
                                        </ul>
                                    </div>-->
                                    <button class="au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>Add Itens</button>
										
	
										
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->
			
			<!-- STATISTIC-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
					
					<div class="row">
					
						<div class="col-md-12 offset-md-9" style="margin-bottom: 20px;">
						
						<div class="rs-select2--dark rs-select2--md m-r-10">
						
										   <form action="" method="get">
                                                <select class="js-select2" name="filtroano">
												<option value="" selected="selected">Selecione o ano</option>
                                                    <option value="<?php echo date("Y");?>"><?php echo date("Y");?></option>
                                                    <option value="<?php echo (date("Y")-1);?>"><?php echo (date("Y")-1);?></option>
													 <option value="<?php echo (date("Y")-2);?>"><?php echo (date("Y")-2);?></option>
													  <option value="<?php echo (date("Y")-3);?>"><?php echo (date("Y")-3);?></option>
                                                </select>
												
                                                <div class="dropDownSelect2"></div>
												
												
												
											
                                            </div>
											<div class="rs-select2--dark rs-select2--md m-r-10">
										  
                                                <select class="js-select2" name="filtromes" onChange="this.form.submit()">
												<option value="" selected="selected">Selecione o mês</option>
                                                    <option value="1">Janeiro</option>
                                                    <option value="2">Fevereiro</option>
													<option value="3">Março</option>
													<option value="4">Abril</option>
													<option value="5">Maio</option>
													<option value="6">Junho</option>
													<option value="7">Julho</option>
													<option value="8">Agosto</option>
													<option value="9">Setembro</option>
													<option value="10">Outubro</option>
													<option value="11">Novembro</option>
													<option value="12">Dezembro</option>
                                                </select>
												
                                                <div class="dropDownSelect2"></div>
												
												
												
											</form>
                                            </div>
						</div>
						
					</div>
					
                        <div class="row">
                            <!--<div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>100</h2>
                                                <span>Sócios<br>&nbsp;<br>&nbsp;</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
							<div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-mood-bad"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php
													if($resmens < 0){
												echo "0,00";
													}else{
												echo number_format($resmens,2,",", ".");
													}
												
												?>
												</h2>
                                                <span>Inadimplências</span>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c3" data-toggle="tooltip" title="O total de taxas com boletos este mês é de: R$ <?php echo number_format($row_vlrtx['tx'],2,',','.');?>">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-minus-circle"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
												if($filtroano == "" || $filtromes == ""){
												if(date('m',strtotime($row_despesa['datapagar'])) == date('m') && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')){
													echo number_format($row_despesa['valor'],2,',','.'); $pagaratualizada = $row_despesa['valor'];
													}else{
														echo '0,00';
														} 
												}else{
													if(date('m',strtotime($row_despesa['datapagar'])) == $filtromes && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano){
													echo number_format($row_despesa['valor'],2,',','.'); $pagaratualizada = $row_despesa['valor'];
													}else{
														echo '0,00';
														} 
												}
												?>
												</h2>
                                                <span>A pagar /mês</span>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-balance"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
												if($filtroano == "" || $filtromes == ""){
												if((date('m',strtotime($row_despesa['datapagar'])) == date('m') && date('Y',strtotime($row_despesa['datapagar'])) == date('Y')) || (date('m',strtotime($row_inadimpa['datacadastro'])) <= date('m') && date('Y',strtotime($row_inadimpa['datacadastro'])) == date('Y')) || (date('m',strtotime($row_receber['datacadastro'])) <= date('m') && date('Y',strtotime($row_receber['datacadastro'])) == date('Y')) || (date('m',strtotime($row_vlrpagoa['data_cadastro'])) <= date('m') && date('Y',strtotime($row_vlrpagoa['data_cadastro'])) == date('Y'))){
													echo number_format((($row_vlrpagoa['vrpgtoa'] + $row_receber['valorreceber'] + $row_receita['valorreceita']) - ($row_despesa['valor'] + $row_vlrtx['tx'])),2,',','.');
													}else{
														echo '0,00';
														} 
												}else{
													if((date('m',strtotime($row_despesa['datapagar'])) == $filtromes && date('Y',strtotime($row_despesa['datapagar'])) == $filtroano) || (date('m',strtotime($row_inadimpa['datacadastro'])) <= $filtromes && date('Y',strtotime($row_inadimpa['datacadastro'])) == $filtroano) || (date('m',strtotime($row_receber['datacadastro'])) <= $filtromes && date('Y',strtotime($row_receber['datacadastro'])) == $filtroano) || (date('m',strtotime($row_vlrpagoa['data_cadastro'])) <= $filtromes && date('Y',strtotime($row_vlrpagoa['data_cadastro'])) == $filtroano)){
													echo number_format((($row_vlrpagoa['vrpgtoa'] + $row_receber['valorreceber'] + $row_inadimpa['vrinadimpa'] + $row_receita['valorreceita']) - ($row_despesa['valor'] + $row_vlrtx['tx'])),2,',','.');
													}else{
														echo '0,00';
														} 
												}
												?></h2>
                                                <span>Saldo /mês</span>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
												if($filtroano == "" || $filtromes == ""){
												if((date('m',strtotime($row_receber['datareceber'])) == date('m') && date('Y',strtotime($row_receber['datareceber'])) == date('Y')) || (date('m',strtotime($row_inadimpa['datacadastro'])) <= date('m') && date('Y',strtotime($row_inadimpa['datacadastro'])) == date('Y')) || (date('m',strtotime($row_inadimpa['datacadastro'])) <= date('m') && date('Y',strtotime($row_inadimpa['datacadastro'])) == date('Y'))){
													echo number_format((($row_receber['valorreceber']+$row_inadimpa['vrinadimpa'])-$row_valorpagoa['vrpgtoa']),2,',','.'); $receberatualizada = $row_receber['valorreceber'] + $resmensa; 
													}else{
													echo '0,00';};
												}else{
													if((date('m',strtotime($row_receber['datareceber'])) == $filtromes && date('Y',strtotime($row_receber['datareceber'])) == $filtroano) || (date('m',strtotime($row_inadimpa['datacadastro'])) <= $filtromes && date('Y',strtotime($row_inadimpa['datacadastro'])) == $filtroano) || (date('m',strtotime($row_inadimpa['datacadastro'])) <= $filtromes && date('Y',strtotime($row_inadimpa['datacadastro'])) == $filtroano)){
													echo number_format((($row_receber['valorreceber']+$row_inadimpa['vrinadimpa'])-$row_valorpagoa['vrpgtoa']),2,',','.'); $receberatualizada = $row_receber['valorreceber'] + $resmensa; 
													}else{
													echo '0,00';};
												}
												?>
												</h2>
                                                <span>A receber /mês</span>
                                            </div>
                                        </div>
                                       <!-- <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
												if($filtroano == "" || $filtromes == ""){
												if(date('m',strtotime($row_receita['datareceita'])) == date('m') && date('Y',strtotime($row_receita['datareceita'])) == date('Y')){
													$receitaatualizada = number_format($row_receita['valorreceita'],2,',','.'); 
													 echo $receitaatualizada;												
													}else{
													echo '0,00';};
												}else{
													if(date('m',strtotime($row_receita['datareceita'])) == $filtromes && date('Y',strtotime($row_receita['datareceita'])) == $filtroano){
													$receitaatualizada = number_format($row_receita['valorreceita'],2,',','.'); 
													 echo $receitaatualizada;
													}else{
													echo '0,00';};
												}
												?>
												</h2>
                                                <span>Receitas /mês</span>
                                            </div>
                                        </div>
                                       <!-- <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php echo number_format(($row_contabanco['saldo']),2,',','.'); ?></h2>
                                                <span>Saldo Geral</span>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
			
			<section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <!-- RECENT REPORT 2-->
                                <div class="recent-report2">
                                    <h3 class="title-3"><strong>Gráfico</strong> - Fluxo de Caixa</h3>
                                    <div class="chart-info">
                                        <div class="chart-info__left">
                                            <div class="chart-note">
                                                <span class="dot dot--blue"></span>
                                                <span>Despesas</span>
                                            </div>
                                            <div class="chart-note">
                                                <span class="dot dot--green"></span>
                                                <span>Receitas</span>
                                            </div>
                                        </div>
                                        <div class="chart-info-right">
                                           <div class="rs-select2--dark rs-select2--md m-r-10">
										   <form action="" method="get">
                                                <select class="js-select2" name="filtroano" onChange="this.form.submit()">
												<option selected="selected">Filtrar por ano</option>
                                                    <option value="<?php echo date("Y");?>"><?php echo date("Y");?></option>
                                                    <option value="<?php echo (date("Y")-1);?>"><?php echo (date("Y")-1);?></option>
													 <option value="<?php echo (date("Y")-2);?>"><?php echo (date("Y")-2);?></option>
													  <option value="<?php echo (date("Y")-3);?>"><?php echo (date("Y")-3);?></option>
                                                </select>
                                                <div class="dropDownSelect2"></div>
											</form>
                                            </div>
                                            <!--<div class="rs-select2--dark rs-select2--lg">
                                                <select class="js-select2 au-select-dark" name="time">
                                                    <option selected="selected">Filtar por ano</option>
                                                    <option value=""></option>
                                                    <option value=""></option>
													 <option value=""></option>
													  <option value=""></option>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>-->
                                        </div>
                                    </div>
									<input type="hidden" id="janeiro" value="<?php echo $despesajan; ?>">
									<input type="hidden" id="fevereiro" value="<?php echo $despesafev; ?>">
									<input type="hidden" id="marco" value="<?php echo $despesamar; ?>">
									<input type="hidden" id="abril" value="<?php echo $despesaabr; ?>">
									<input type="hidden" id="maio" value="<?php echo $despesamai; ?>">
									<input type="hidden" id="junho" value="<?php echo $despesajun; ?>">
									<input type="hidden" id="julho" value="<?php echo $despesajul; ?>">
									<input type="hidden" id="agosto" value="<?php echo $despesaago; ?>">
									<input type="hidden" id="setembro" value="<?php echo $despesaset; ?>">
									<input type="hidden" id="outubro" value="<?php echo $despesaout; ?>">
									<input type="hidden" id="novembro" value="<?php echo $despesanov; ?>">
									<input type="hidden" id="dezembro" value="<?php echo $despesadez; ?>">
									
									<input type="hidden" id="recjaneiro" value="<?php echo $receitajan; ?>">
									<input type="hidden" id="recfevereiro" value="<?php echo $receitafev; ?>">
									<input type="hidden" id="recmarco" value="<?php echo $receitamar; ?>">
									<input type="hidden" id="recabril" value="<?php echo $receitaabr; ?>">
									<input type="hidden" id="recmaio" value="<?php echo $receitamai; ?>">
									<input type="hidden" id="recjunho" value="<?php echo $receitajun; ?>">
									<input type="hidden" id="recjulho" value="<?php echo $receitajul; ?>">
									<input type="hidden" id="recagosto" value="<?php echo $receitaago; ?>">
									<input type="hidden" id="recsetembro" value="<?php echo $receitaset; ?>">
									<input type="hidden" id="recoutubro" value="<?php echo $receitaout; ?>">
									<input type="hidden" id="recnovembro" value="<?php echo $receitanov; ?>">
									<input type="hidden" id="recdezembro" value="<?php echo $receitadez; ?>">
									
                                    <div class="recent-report__chart">
                                        <canvas id="recent-rep2-chart"></canvas>
                                    </div>
                                </div>
                                <!-- END RECENT REPORT 2             -->
                            </div>
                            <div class="col-xl-4">
                                <!-- TASK PROGRESS
                                <div class="task-progress">
                                    <h3 class="title-3">task progress</h3>
                                    <div class="au-skill-container">
                                        <div class="au-progress">
                                            <span class="au-progress__title">Web Design</span>
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="90">
                                                    <span class="au-progress__value js-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-progress">
                                            <span class="au-progress__title">HTML5/CSS3</span>
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="85">
                                                    <span class="au-progress__value js-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-progress">
                                            <span class="au-progress__title">WordPress</span>
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="95">
                                                    <span class="au-progress__value js-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-progress">
                                            <span class="au-progress__title">Support</span>
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="95">
                                                    <span class="au-progress__value js-value"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                END TASK PROGRESS-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			
			<div class="section__content section__content--p30">
                    <div class="container-fluid">
				<div class="row">
					<div class="col-lg-6">
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-30">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
											<thead>
												<th colspan="3" style="color: #fff; text-align:center;">Inadimplentes do mês <button type="button" onclick="exibeinad();" class="btn btn-warning" style="margin-left: 10px">Exibir / Ocultar</button></th>
											</thead>
											<?php if($totalRows_lisin < 1){echo "<tbody><tr><td colspan='3' align='center'>Ainda não há inadimplentes deste mês!</td></tr></tbody>";}else{?>
                                                <tbody id="exibeinad" style="display:none;">
												<tr>
													<td style="text-align:center; font-weight:bold;">Sócio</td>
													<td style="text-align:center; font-weight:bold;">Vencimento</td>
													<td style="text-align:center; font-weight:bold;">Valor</td>
												</tr>
												<?php do{?>
                                                    <tr>
                                                        <td style="text-align:center;"><?php echo $row_lisin['nome_socio'];?></td>
														<td style="text-align:center;"><?php echo $row_lisin['mensalidade_diavenc'];?></td>
                                                        <td style="text-align:center;">R$ <?php echo number_format($row_lisin['mensalidade_valor'],2,',','.');?></td>
                                                    </tr>
												<?php }while($row_lisin = mysqli_fetch_assoc($lisin));?> 
                                                </tbody>
											<?php }?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
				</div>
				</div>
			</section>
			
			<!--<section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6">
                                
                                <div class="user-data m-b-40">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>user data</h3>
                                    <div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">All Properties</option>
                                                <option value="">Products</option>
                                                <option value="">Services</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <select class="js-select2 au-select-dark" name="time">
                                                <option selected="selected">All Time</option>
                                                <option value="">By Month</option>
                                                <option value="">By Day</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>name</td>
                                                    <td>role</td>
                                                    <td>type</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>lori lynch</h6>
                                                            <span>
                                                                <a href="#">johndoe@gmail.com</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role admin">admin</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2" name="property">
                                                                <option selected="selected">Full Control</option>
                                                                <option value="">Post</option>
                                                                <option value="">Watch</option>
                                                            </select>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" checked="checked">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>lori lynch</h6>
                                                            <span>
                                                                <a href="#">johndoe@gmail.com</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role user">user</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2" name="property">
                                                                <option value="">Full Control</option>
                                                                <option value="" selected="selected">Post</option>
                                                                <option value="">Watch</option>
                                                            </select>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>lori lynch</h6>
                                                            <span>
                                                                <a href="#">johndoe@gmail.com</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role user">user</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2" name="property">
                                                                <option value="">Full Control</option>
                                                                <option value="" selected="selected">Post</option>
                                                                <option value="">Watch</option>
                                                            </select>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>lori lynch</h6>
                                                            <span>
                                                                <a href="#">johndoe@gmail.com</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role member">member</span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2" name="property">
                                                                <option selected="selected">Full Control</option>
                                                                <option value="">Post</option>
                                                                <option value="">Watch</option>
                                                            </select>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="user-data__footer">
                                        <button class="au-btn au-btn-load">load more</button>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-xl-6">
                                
                                <div class="map-data m-b-40">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-map"></i>map data</h3>
                                    <div class="filters">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">All Worldwide</option>
                                                <option value="">Products</option>
                                                <option value="">Services</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <select class="js-select2 au-select-dark" name="time">
                                                <option selected="selected">All Time</option>
                                                <option value="">By Month</option>
                                                <option value="">By Day</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="map-wrap m-t-45 m-b-80">
                                        <div id="vmap" style="height: 284px;"></div>
                                    </div>
                                    <div class="table-wrap">
                                        <div class="table-responsive table-style1">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>United States</td>
                                                        <td>$119,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Australia</td>
                                                        <td>$70,261.65</td>
                                                    </tr>
                                                    <tr>
                                                        <td>United Kingdom</td>
                                                        <td>$46,399.22</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive table-style1">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Germany</td>
                                                        <td>$20,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>France</td>
                                                        <td>$10,366.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Russian</td>
                                                        <td>$5,366.96</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->

            <script>
            	function exibeinad(){
            	var exibeinad = document.getElementById('exibeinad');
            	if(exibeinad.style.display == 'block'){
            	exibeinad.style.display = 'none';
            	}else{
				exibeinad.style.display = 'block';
            	}
				}
            </script>