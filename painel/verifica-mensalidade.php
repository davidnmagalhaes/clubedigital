<?php 
/////////////////////////////Faz verificação das mensalidades e insere as mensalidades do mês na tabela caso não tenha sido criadas ainda///////////
//Verifica os sócios
$sqsoc = "SELECT * FROM rfs_socios WHERE clube='$clube' AND status_cob='1' AND status_socio='1'";
$versocios = mysqli_query($link, $sqsoc) or die(mysqli_error($link));
$row_versocios = mysqli_fetch_assoc($versocios);

//Pega taxa do clube
$sqcl = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$exbtx = mysqli_query($link, $sqcl) or die(mysqli_error($link));
$row_exbtx = mysqli_fetch_array($exbtx);
$txph = $row_exbtx['paghiper_taxa'];



foreach($versocios as $soci){

    $mesat = date('m');
    $anoat = date('Y');

    $dataatual = date('Y-m-d');

    $idsoc = $soci['id_socio'];
    $firstpay = $soci['data_cadastro'];
    $monthpay = date('m',strtotime($firstpay));
    $yearpay = date('Y',strtotime($firstpay));

    $datapay = date('Y-m-d',strtotime($firstpay));

    $payinitial = 0;

    if($firstpay <= $dataatual){//Verifica se a primeira parcela é deste mês e ano, ou de meses e anos anteriores

    $sqv = "SELECT * FROM rfa_mensalidades WHERE MONTH(data_mensalidade)='$mesat' AND YEAR(data_mensalidade)='$anoat' AND id_socio='$idsoc' AND clube='$clube'";
    $verexistemens = mysqli_query($link, $sqv) or die(mysqli_error($link));
    $totalRows_verexistemens = mysqli_num_rows($verexistemens);

    if($totalRows_verexistemens > 0){}else{//Se as mensalidades já existem retorna vazio, senão executa o script
    $codmens = rand();

    //Faz verificação do código, caso exista gera outro
    $sqcd = "SELECT * FROM rfa_mensalidades WHERE cod_mensalidade='$codmens'";
    $vercode = mysqli_query($link, $sqcd) or die(mysqli_error($link));
    $totalRows_vercode = mysqli_num_rows($vercode);

    if($totalRows_vercode > 0){
        $codmens = rand();
    }

    $diamens = $soci['mensalidade_diavenc'];

    $datamensalidade = date('Y-m-d',strtotime(($anoat."-".$mesat."-".$diamens)));
    $valormensalidade = $soci['mensalidade_valor'];

    $sqlmsld .= "INSERT INTO rfa_mensalidades (cod_mensalidade, id_socio, data_mensalidade, valor_mensalidade, taxa, pagamento, clube) VALUES ('$codmens', '$idsoc', '$datamensalidade', '$valormensalidade', '$txph', '$payinitial', '$clube');";

    }
}

}

if ($link->multi_query($sqlmsld) === TRUE) {
        //Executa a query normalmente, mas não exibe mensagem.
    } else {
        //Não exibe nada porque as mensalidades já existem
    }
?>