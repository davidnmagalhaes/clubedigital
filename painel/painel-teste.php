<?php 

$filtromes = $_GET['filtromes'];//Ano de Filtro
$filtroano = $_GET['filtroano'];//Mês de Filtro

if($filtromes == "" && $filtroano == ""){
	$filtromes = date('m');//Mês atual
	$filtroano = date('Y');//Ano atual
}

$datahoje = date('Y-m-d');

$scl = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$sclu = mysqli_query($link, $scl) or die(mysqli_error($link));
$row_sclu = mysqli_fetch_assoc($sclu);
$dominio = $row_sclu['urldominio'];
$balanco = $row_sclu['balanco'];

$scamb = "SELECT * FROM rfa_config_cambio WHERE id_cambio='1'";
$camb = mysqli_query($link, $scamb) or die(mysqli_error($link));
$row_camb = mysqli_fetch_assoc($camb);

$cambio = $row_camb['valor_cambio'];

//////////////////////////////////// Exibe todas as mensalidades do mês ///////////////////////////////////////////
$sqmsm = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND MONTH(rfa_mensalidades.data_mensalidade) = '$filtromes' AND YEAR(rfa_mensalidades.data_mensalidade) = '$filtroano' ORDER BY rfs_socios.nome_socio ASC";
$msm = mysqli_query($link, $sqmsm) or die(mysqli_error($link));
$totalRows_msm = mysqli_num_rows($msm);

//////////////////////////////////// Saldos Iniciais das Contas ///////////////////////////////////////////
$sqsld = "SELECT SUM(saldo) as valor FROM rfa_bancos WHERE clube='$clube'";
$sldtotal = mysqli_query($link, $sqsld) or die(mysqli_error($link));
$row_sldtotal = mysqli_fetch_assoc($sldtotal);

//////////////////////////////////// Despesas Totais///////////////////////////////////////////
$sqdt = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND MONTH(data_pagar) = '$filtromes' AND YEAR(data_pagar) = '$filtroano'";
$despesatotal = mysqli_query($link, $sqdt) or die(mysqli_error($link));
$row_despesatotal = mysqli_fetch_assoc($despesatotal);

//////////////////////////////////// Campanhas Totais///////////////////////////////////////////
$scmp = "SELECT rfa_campanhas.valor_campanha as valor, SUM(rfa_campanhas_pedidos.quantidade_pedido) as quantidade FROM rfa_campanhas_pedidos INNER JOIN rfa_campanhas ON rfa_campanhas_pedidos.cod_campanha=rfa_campanhas.cod_campanha WHERE rfa_campanhas_pedidos.tipodoacao_pedido='valor' AND rfa_campanhas_pedidos.status_pedido='1' AND (rfa_campanhas_pedidos.metodopgto_pedido='boleto' OR rfa_campanhas_pedidos.metodopgto_pedido='pagseguro') AND rfa_campanhas_pedidos.clube='$clube' AND MONTH(rfa_campanhas_pedidos.data_pagamento) = '$filtromes' AND YEAR(rfa_campanhas_pedidos.data_pagamento) = '$filtroano'";
$cmp = mysqli_query($link, $scmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_assoc($cmp);
$totalcampanhas = ($row_cmp['valor'] * $row_cmp['quantidade']);

$scmptx = "SELECT * FROM rfa_campanhas_pedidos WHERE tipodoacao_pedido='valor' AND status_pedido='1' AND metodopgto_pedido='boleto' AND clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano'";
$cmptx = mysqli_query($link, $scmptx) or die(mysqli_error($link));
$row_cmptx = mysqli_fetch_assoc($cmptx);
$totalrow_cmptx = mysqli_num_rows($cmptx);

$taxabolcamp = $totalrow_cmptx * 2.49;

//////////////////////////////////// Consórcios Totais///////////////////////////////////////////
$scns = "SELECT SUM(valor_pagamento) as valor FROM rfa_consorcio_pagamentos WHERE status_pagamento='1' AND clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano'";
$cns = mysqli_query($link, $scns) or die(mysqli_error($link));
$row_cns = mysqli_fetch_assoc($cns);
$totalconsorcio = $row_cns['valor'];

//////////////////////////////////// Inadimplências Totais///////////////////////////////////////////
$sqinad = "SELECT SUM(rfa_mensalidades.valor_mensalidade) as valor FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio=rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND MONTH(rfa_mensalidades.data_mensalidade) <= '$filtromes' AND YEAR(rfa_mensalidades.data_mensalidade) <= '$filtroano' AND rfa_mensalidades.pagamento=0 AND rfa_mensalidades.data_mensalidade < '$datahoje' AND rfs_socios.status_socio='1' AND rfs_socios.status_cob='1'";
$inadtotal = mysqli_query($link, $sqinad) or die(mysqli_error($link));
$row_inadtotal = mysqli_fetch_assoc($inadtotal);

//////////////////////////////////// Inadimplências Totais Mês///////////////////////////////////////////
$sqinadm = "SELECT SUM(rfa_mensalidades.valor_mensalidade) as valor FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio=rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND MONTH(rfa_mensalidades.data_mensalidade) = '$filtromes' AND YEAR(rfa_mensalidades.data_mensalidade) = '$filtroano' AND rfa_mensalidades.pagamento=0 AND rfa_mensalidades.data_mensalidade < '$datahoje' AND rfs_socios.status_socio='1' AND rfs_socios.status_cob='1'";
$inadtotalm = mysqli_query($link, $sqinadm) or die(mysqli_error($link));
$row_inadtotalm = mysqli_fetch_assoc($inadtotalm);

//////////////////////////////////// Lista os Inadimplentes ///////////////////////////////////////////
$sqlisinad = "SELECT * FROM rfa_mensalidades INNER JOIN rfs_socios ON rfa_mensalidades.id_socio = rfs_socios.id_socio WHERE rfa_mensalidades.clube='$clube' AND rfa_mensalidades.pagamento=0 AND rfa_mensalidades.data_mensalidade < '$datahoje' AND rfs_socios.status_socio='1' AND rfs_socios.status_cob='1'";
$lisinadtotal = mysqli_query($link, $sqlisinad) or die(mysqli_error($link));
$row_lisinadtotal = mysqli_fetch_assoc($lisinadtotal);
$totalRows_lisinadtotal = mysqli_num_rows($lisinadtotal);

//////////////////////////////////// Receitas Totais///////////////////////////////////////////
$sqrec = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND MONTH(data_receita) = '$filtromes' AND YEAR(data_receita) = '$filtroano'";
$rectotal = mysqli_query($link, $sqrec) or die(mysqli_error($link));
$row_rectotal = mysqli_fetch_assoc($rectotal);

//////////////////////////////////// Mensalidades Totais///////////////////////////////////////////
$sqmt = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_mensalidade) = '$filtromes' AND YEAR(data_mensalidade) = '$filtroano'";
$mttotal = mysqli_query($link, $sqmt) or die(mysqli_error($link));
$row_mttotal = mysqli_fetch_assoc($mttotal);

//////////////////////////////////// Taxa total do mês///////////////////////////////////////////
$sqtx = "SELECT SUM(taxa) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano' AND pagamento=1";
$txtotal = mysqli_query($link, $sqtx) or die(mysqli_error($link));
$row_txtotal = mysqli_fetch_assoc($txtotal);

//////////////////////////////////// Fundos Totais///////////////////////////////////////////
$sqdtfn = "SELECT SUM(valor_fundo) as valor FROM rfa_fundos WHERE clube='$clube' AND MONTH(data_fundo) = '$filtromes' AND YEAR(data_fundo) = '$filtroano' AND status_fundo='2'";
$fundototal = mysqli_query($link, $sqdtfn) or die(mysqli_error($link));
$row_fundototal = mysqli_fetch_assoc($fundototal);

$resultadodespesa = $row_despesatotal['valor'] + $row_txtotal['valor'] + $row_fundototal['valor'] + $taxabolcamp;//Despesa com taxa
$resultadodespesastaxa = $row_despesatotal['valor'];//Despesa sem taxa

//////////////////////////////////// Taxa total do mês///////////////////////////////////////////
$sqtxg = "SELECT SUM(taxa) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) <= '$filtromes' AND YEAR(data_pagamento) <= '$filtroano' AND pagamento=1";
$txtotalg = mysqli_query($link, $sqtxg) or die(mysqli_error($link));
$row_txtotalg = mysqli_fetch_assoc($txtotalg);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////PAGOS////////////////////////////////////////////
//////////////////////////////////// Despesas Pagas///////////////////////////////////////////
$sqdtp = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND MONTH(data_pagar) = '$filtromes' AND YEAR(data_pagar) = '$filtroano' AND status_pagar=2";
$despesatotalp = mysqli_query($link, $sqdt) or die(mysqli_error($link));
$row_despesatotalp = mysqli_fetch_assoc($despesatotalp);
//////////////////////////////////// Receitas Pagas ///////////////////////////////////////////
$sqrecp = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND MONTH(data_receita) = '$filtromes' AND YEAR(data_receita) = '$filtroano' AND status_receita=2";
$recptotal = mysqli_query($link, $sqrecp) or die(mysqli_error($link));
$row_recptotal = mysqli_fetch_assoc($recptotal);

//////////////////////////////////// Mensalidades Pagas///////////////////////////////////////////
$sqmtp = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) = '$filtromes' AND YEAR(data_pagamento) = '$filtroano' AND pagamento=1";
$mtptotal = mysqli_query($link, $sqmtp) or die(mysqli_error($link));
$row_mtptotal = mysqli_fetch_assoc($mtptotal);

$totalentrada = ($row_recptotal['valor'] + $row_mtptotal['valor']+ $totalcampanhas + $totalconsorcio) - ($row_despesatotalp['valor'] + $row_txtotal['valor'] + $taxabolcamp + $row_fundototal['valor']);
$receitatotal = $row_mtptotal['valor'] + $row_recptotal['valor'] + $totalcampanhas + $totalconsorcio;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////SALDO GERAL////////////////////////////////////////////
//////////////////////////////////// Despesas Pagas no Geral ///////////////////////////////////////////
$sqdtg = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND MONTH(data_pagar) <= '$filtromes' AND YEAR(data_pagar) <= '$filtroano' AND status_pagar=2";
$despesatotalg = mysqli_query($link, $sqdtg) or die(mysqli_error($link));
$row_despesatotalg = mysqli_fetch_assoc($despesatotalg);
//////////////////////////////////// Mensalidades Pagas no Geral ///////////////////////////////////////////
$sqmtg = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND MONTH(data_pagamento) <= '$filtromes' AND YEAR(data_pagamento) <= '$filtroano' AND pagamento=1";
$mtgtotal = mysqli_query($link, $sqmtg) or die(mysqli_error($link));
$row_mtgtotal = mysqli_fetch_assoc($mtgtotal);
//////////////////////////////////// Receitas Pagas no Geral ///////////////////////////////////////////
$sqrecpg = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND MONTH(data_receita) <= '$filtromes' AND YEAR(data_receita) <= '$filtroano' AND status_receita=2";
$recpgtotal = mysqli_query($link, $sqrecpg) or die(mysqli_error($link));
$row_recpgtotal = mysqli_fetch_assoc($recpgtotal);

//////////////////////////////////// Queries para Saldo Geral ///////////////////////////////////////////
$sqmtg1 = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND pagamento=1";
$mtgtotal1 = mysqli_query($link, $sqmtg1) or die(mysqli_error($link));
$row_mtgtotal1 = mysqli_fetch_assoc($mtgtotal1);

$sqrecpg1 = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND status_receita=2";
$recpgtotal1 = mysqli_query($link, $sqrecpg1) or die(mysqli_error($link));
$row_recpgtotal1 = mysqli_fetch_assoc($recpgtotal1);

$sqdtg1 = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND status_pagar=2";
$despesatotalg1 = mysqli_query($link, $sqdtg1) or die(mysqli_error($link));
$row_despesatotalg1 = mysqli_fetch_assoc($despesatotalg1);


$sqtxg1 = "SELECT SUM(taxa) as valor FROM rfa_mensalidades WHERE clube='$clube' AND pagamento=1";
$txtotalg1 = mysqli_query($link, $sqtxg1) or die(mysqli_error($link));
$row_txtotalg1 = mysqli_fetch_assoc($txtotalg1);

$sqfng1 = "SELECT SUM(valor_fundo) as valor FROM rfa_fundos WHERE clube='$clube' AND status_fundo=2";
$fntotalg1 = mysqli_query($link, $sqfng1) or die(mysqli_error($link));
$row_fntotalg1 = mysqli_fetch_assoc($fntotalg1);

$sqrtg1 = "SELECT SUM(valor_retirada) as valor FROM rfa_retirada WHERE clube='$clube'";
$rttotalg1 = mysqli_query($link, $sqrtg1) or die(mysqli_error($link));
$row_rttotalg1 = mysqli_fetch_assoc($rttotalg1);

//////////////////////////////////// Campanhas Totais///////////////////////////////////////////
$scmpg = "SELECT rfa_campanhas.valor_campanha as valor, SUM(rfa_campanhas_pedidos.quantidade_pedido) as quantidade FROM rfa_campanhas_pedidos INNER JOIN rfa_campanhas ON rfa_campanhas_pedidos.cod_campanha=rfa_campanhas.cod_campanha WHERE rfa_campanhas_pedidos.tipodoacao_pedido='valor' AND rfa_campanhas_pedidos.status_pedido='1' AND (rfa_campanhas_pedidos.metodopgto_pedido='boleto' OR rfa_campanhas_pedidos.metodopgto_pedido='pagseguro') AND rfa_campanhas_pedidos.clube='$clube'";
$cmpg = mysqli_query($link, $scmpg) or die(mysqli_error($link));
$row_cmpg = mysqli_fetch_assoc($cmpg);
$totalcampanhasg = ($row_cmpg['valor'] * $row_cmpg['quantidade']);

$scmptxg = "SELECT * FROM rfa_campanhas_pedidos WHERE tipodoacao_pedido='valor' AND status_pedido='1' AND metodopgto_pedido='boleto' AND clube='$clube'";
$cmptxg = mysqli_query($link, $scmptxg) or die(mysqli_error($link));
$row_cmptxg = mysqli_fetch_assoc($cmptxg);
$totalrow_cmptxg = mysqli_num_rows($cmptxg);

$taxabolcampg = $totalrow_cmptxg * 2.49;

//////////////////////////////////// Consórcios Totais///////////////////////////////////////////
$scnsg = "SELECT SUM(valor_pagamento) as valor FROM rfa_consorcio_pagamentos WHERE status_pagamento='1' AND clube='$clube'";
$cnsg = mysqli_query($link, $scnsg) or die(mysqli_error($link));
$row_cnsg = mysqli_fetch_assoc($cnsg);
$totalconsorciog = $row_cnsg['valor'];

$totalgeral = ($totalconsorciog + $totalcampanhasg + $row_mtgtotal1['valor'] + $row_recpgtotal1['valor'] + $row_sldtotal['valor']) - ($taxabolcampg + $row_despesatotalg1['valor'] + $row_txtotalg1['valor'] + $row_fntotalg1['valor']);
$entradasgerais = ($row_mtgtotal['valor'] + $row_recpgtotal['valor'] + $row_sldtotal['valor']);
$saidasgerais = ($row_despesatotalg['valor'] + $row_txtotalg['valor']);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////GRÁFICO////////////////////////////////////////////

function receitagrafico($mes, $ano, $clube){
include('config.php');

//////////////////////////////////// Campanhas Totais///////////////////////////////////////////
$scmp = "SELECT rfa_campanhas.valor_campanha as valor, SUM(rfa_campanhas_pedidos.quantidade_pedido) as quantidade FROM rfa_campanhas_pedidos INNER JOIN rfa_campanhas ON rfa_campanhas_pedidos.cod_campanha=rfa_campanhas.cod_campanha WHERE rfa_campanhas_pedidos.tipodoacao_pedido='valor' AND rfa_campanhas_pedidos.status_pedido='1' AND (rfa_campanhas_pedidos.metodopgto_pedido='boleto' OR rfa_campanhas_pedidos.metodopgto_pedido='pagseguro') AND rfa_campanhas_pedidos.clube='$clube' AND MONTH(rfa_campanhas_pedidos.data_pagamento) = '$mes' AND YEAR(rfa_campanhas_pedidos.data_pagamento) = '$ano'";
$cmp = mysqli_query($link, $scmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_assoc($cmp);
$totalcampanhas = ($row_cmp['valor'] * $row_cmp['quantidade']);

//////////////////////////////////// Consórcios Totais///////////////////////////////////////////
$scns = "SELECT SUM(valor_pagamento) as valor FROM rfa_consorcio_pagamentos WHERE status_pagamento='1' AND clube='$clube' AND MONTH(data_pagamento) = '$mes' AND YEAR(data_pagamento) = '$ano'";
$cns = mysqli_query($link, $scns) or die(mysqli_error($link));
$row_cns = mysqli_fetch_assoc($cns);
$totalconsorcio = $row_cns['valor'];

//////////////////////////////////// Mensalidades Totais para o Gráfico ///////////////////////////////////////////
$sqmtgraf = "SELECT SUM(valor_mensalidade) as valor, data_mensalidade FROM rfa_mensalidades WHERE clube='$clube' AND pagamento=1 AND MONTH(data_pagamento) = '$mes' AND YEAR(data_pagamento) = '$ano'";
$mtgraftotal = mysqli_query($link, $sqmtgraf) or die(mysqli_error($link));
$row_mtgraftotal = mysqli_fetch_assoc($mtgraftotal);

//////////////////////////////////// Receitas Totais para o Gráfico ///////////////////////////////////////////
$sqrecpgraf = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND MONTH(data_receita) = '$mes' AND YEAR(data_receita) = '$ano' AND status_receita=2";
$recpgraftotal = mysqli_query($link, $sqrecpgraf) or die(mysqli_error($link));
$row_recpgraftotal = mysqli_fetch_assoc($recpgraftotal);

echo ($row_mtgraftotal['valor'] + $row_recpgraftotal['valor'] + $totalcampanhas + $totalconsorcio);

}

function despesagrafico($mespg, $anopg, $clubepg){
include('config.php');

$scmptx = "SELECT * FROM rfa_campanhas_pedidos WHERE tipodoacao_pedido='valor' AND status_pedido='1' AND metodopgto_pedido='boleto' AND clube='$clubepg' AND MONTH(data_pagamento) = '$mespg' AND YEAR(data_pagamento) = '$anopg'";
$cmptx = mysqli_query($link, $scmptx) or die(mysqli_error($link));
$row_cmptx = mysqli_fetch_assoc($cmptx);
$totalrow_cmptx = mysqli_num_rows($cmptx);

$taxabolcamp = $totalrow_cmptx * 2.49;

//////////////////////////////////// Despesas Totais para o Gráfico ///////////////////////////////////////////
$sqdtgraf = "SELECT SUM(valor_pagar) as valor, data_pagar FROM rfa_pagar WHERE clube='$clubepg' AND status_pagar=2 AND MONTH(data_pagar) = '$mespg' AND YEAR(data_pagar) = '$anopg'";
$despesatotalgraf = mysqli_query($link, $sqdtgraf) or die(mysqli_error($link));
$row_despesatotalgraf = mysqli_fetch_assoc($despesatotalgraf);

$sqmtgraftx = "SELECT SUM(taxa) as valor, data_mensalidade FROM rfa_mensalidades WHERE clube='$clubepg' AND pagamento=1 AND MONTH(data_pagamento) = '$mespg' AND YEAR(data_pagamento) = '$anopg'";
$mtgraftotaltx = mysqli_query($link, $sqmtgraftx) or die(mysqli_error($link));
$row_mtgraftotaltx = mysqli_fetch_assoc($mtgraftotaltx);

//////////////////////////////////// Fundos Totais///////////////////////////////////////////
$sqdtfn = "SELECT SUM(valor_fundo) as valor FROM rfa_fundos WHERE clube='$clubepg' AND MONTH(data_fundo) = '$mespg' AND YEAR(data_fundo) = '$anopg' AND status_fundo='2'";
$fundototal = mysqli_query($link, $sqdtfn) or die(mysqli_error($link));
$row_fundototal = mysqli_fetch_assoc($fundototal);

echo $row_despesatotalgraf['valor'] + $row_mtgraftotaltx['valor'] + $row_fundototal['valor'] + $taxabolcamp;

}

?>


<!-- Modal -->
<div class="modal fade" id="balanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Selecione a data do balanço 

        <form action="ativa-balanco.php" method="POST" id="formb" style="margin: 20px 15px 15px 15px;"> 
         <input type="checkbox" style="width: 45px" name="balanco" <?php if($balanco == 1){echo "checked";}?> onChange="document.forms['formb'].submit();" value="<?php if($balanco == 1){echo "0";}else{echo "1";}?>"> Ativar no site?
         <input type="hidden" name="clube" value="<?php echo $clube;?>">
        </form>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="mpdf/balanco-financeiro.php" method="post">
      <div class="modal-body">
        <div class="row">
            <div class="col">
                <select class="form-control" name="filtroano">
                     <option value="" selected="selected">Selecione o ano</option>
                     <option value="<?php echo date("Y");?>"><?php echo date("Y");?></option>
                     <option value="<?php echo (date("Y")-1);?>"><?php echo (date("Y")-1);?></option>
                     <option value="<?php echo (date("Y")-2);?>"><?php echo (date("Y")-2);?></option>
                     <option value="<?php echo (date("Y")-3);?>"><?php echo (date("Y")-3);?></option>
                </select>
            </div>
            <div class="col">
                <select class="form-control" name="filtromes">
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
            </div>
        </div>
      </div>
      <input type="hidden" name="clube" value="<?php echo $clube;?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Gerar balanço</button>
      </div>
      </form>
    </div>
  </div>
</div>


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
                                   <div class="row">
                                    <div class="col">

                                    <!-- Exemplo de botão danger dividido -->
                                    <!-- Exemplo de único botão danger -->
                                

                                    <a href="receitas.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" role="button" class=" btn btn-success btrespons">
                                        <i class="fas fa-plus-circle" style="margin-right: 10px"></i> Receitas</a>

                                    

                                  
                                    <a href="a-pagar.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" role="button" class=" btn btn-danger btrespons">
                                        <i class="fas fa-plus-circle" style="margin-right: 10px"></i> Despesas</a>


                                    <a href="fundos.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" role="button" class=" btn btn-secondary btrespons">
                                        <i class="fas fa-plus-circle" style="margin-right: 10px"></i> Fundos</a>

                                     
                                    <a href="#" role="button" class=" btn btn-info btrespons">
                                        <i class="fas fa-dollar-sign" style="margin-right: 10px"></i> Câmbio <strong>(R$ <?php echo number_format($cambio,2,',','.'); ?>)</strong></a>
                                    

                                    
                                       <?php if(empty($row_logotopo['urldominio'])){ ?>
                                    <a href="site/clube<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>" role="button" class=" btn btn-primary btrespons" target="_blank">
                                        <i class="fab fa-chrome" style="margin-right: 10px"></i> Site do Clube</a> 

                                    <?php }else{?>
                                     <a href="<?php echo "https://".$row_logotopo['urldominio'];?>" role="button" class=" btn btn-primary btrespons" target="_blank">
                                        <i class="fab fa-chrome" style="margin-right: 10px"></i> Site do Clube</a>
                                    <?php } ?>

                                    <a href="#" role="button" class=" btn btn-dark btrespons" data-toggle="modal" data-target="#balanco">
                                        <i class="far fa-chart-bar" style="margin-right: 10px"></i> Balanço </a>

                                    <a href="consorcio<?php echo $clube;?>" role="button" class="btn btn-warning btrespons">
                                        <i class="fas fa-donate" style="margin-right: 10px"></i> Consórcios </a>

                                    <?php if($_SESSION['funcao'] == 1){?>
                                        <form method="post" action="atualizar_cambio.php">
                                         <input type="text" class="form-control" placeholder="Câmbio" onBlur="this.form.submit()" onKeyPress="return(moeda(this,'.',',',event))" name="cambio" style="width: 20%;float: left;margin: 0 5px;" value="<?php echo $cambio; ?>">                          
                                        </form>
                                   <?php } ?>
                                    </div>
                                    
										
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
												
                                                <?php if($_GET['clube']){?>
												<input type="hidden" name="clube" value="<?php echo $clube;?>">
												<?php } ?>
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
                                <a href="#" class="col" data-toggle="modal" data-target="#exampleModalLong" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c3" data-toggle="tooltip" data-html="true" title="Valor acumulado de mensalidades pendentes.<Br><br><strong>Clique para ver os inadimplentes...</strong>">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <?php
                                                    if($row_inadtotal['valor'] == 0){
                                                        echo '<i class="far fa-laugh-wink" style="color: #fff57d;"></i>';
                                                    }else{
                                                        echo '<i class="zmdi zmdi-mood-bad"></i>';
                                                    };
                                                ?>
                                                
                                            </div>
                                            <div class="text">
                                                <h2 style="font-size: 18px; font-weight:bold">R$ 
                                                <?php
                                                    echo number_format($row_inadtotalm['valor'], 2, ',', '.');
                                                ?>
                                                </h2>
                                                <span style="font-size: 16px">Inadimplências /mês</span>
                                            </div>
                                            <div class="text">
                                                <h2 style="font-size: 18px; font-weight:bold">R$ 
												<?php
													echo number_format($row_inadtotal['valor'], 2, ',', '.');
												?>
												</h2>
                                                <span style="font-size: 16px">Inadimplências</span>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                                </a>
                            </div>
                        
                            <div class="col-sm-6 col-lg-2">
                                <a href="a-pagar.php" class="col" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c3" data-toggle="tooltip" data-html="true" title="Soma o total de despesas do mês + o total de taxas de boletos do mês + Fundos do mês.<br><br><strong>Taxas de boletos:</strong> R$ <?php echo number_format($row_txtotal['valor']+$taxabolcamp,2,',','.');?><Br><strong>Despesas:</strong> R$ <?php echo number_format($resultadodespesastaxa,2,',','.');?><br><strong>Fundos:</strong> R$ <?php echo number_format($row_fundototal['valor'],2,',','.');?> ">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-minus-circle"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
													if($resultadodespesa == 0){echo "0,00";}else{echo number_format($resultadodespesa,2,',','.');};
												?>
												</h2>
                                                <span>Despesas /mês</span>
                                                
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </a>
                            </div>

                            <div class="col-sm-6 col-lg-2">
                                <a href="receitas.php" class="col" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c2" data-toggle="tooltip" data-html="true" title="Soma as receitas adicionais confirmadas do mês(Ex.: refeições, doações, consórcios, etc...) + mensalidades pagas do mês. <br><br><strong>Receitas:</strong> R$ <?php echo number_format($row_recptotal['valor'],2,',','.');?><br><strong>Mensalidades pagas:</strong> R$ <?php echo number_format($row_mtptotal['valor'],2,',','.');?><br><strong>Campanhas:</strong> R$ <?php echo number_format($totalcampanhas,2,',','.'); ?><br><strong>Consórcios:</strong> R$ <?php echo number_format($totalconsorcio,2,',','.'); ?>">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
													if($receitatotal == 0){echo "0,00";}else{echo number_format($receitatotal,2,',','.');};
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
                            </a>
                            </div>
							
							
							<div class="col-sm-6 col-lg-2">
                                <a href="#" class="col" style="margin:0; padding:0;" data-toggle="modal" data-target="#ModalMensalidade">
                                <div class="overview-item overview-item--c2" data-toggle="tooltip" data-html="true"  title="Total de todas as mensalidades que o clube deverá receber este mês.">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
													if($row_mttotal['valor'] == 0){echo "0,00";}else{echo number_format($row_mttotal['valor'],2,',','.');};
												?>
												</h2>
                                                <span>Mensalidades /mês</span>
                                            </div>
                                        </div>
                                       <!-- <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </a>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <a href="#" class="col" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c2" data-toggle="tooltip" data-html="true"  title="(Receita do mês + mensalidades pagas do mês) - (Despesas do mês)<br><br><strong>Entradas:</strong> R$ <?php echo number_format($receitatotal,2,',','.');?><Br><strong>Saídas:</strong> R$ <?php echo number_format($resultadodespesa,2,',','.');?>">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-balance"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
													if($totalentrada == 0){echo "0,00";}else{echo number_format($totalentrada,2,',','.');};
												?>
													
												</h2>
                                                <span>Saldo /mês</span>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </a>
                            </div>
                            
                            <div class="col-sm-6 col-lg-2">
                                <a href="#" class="col" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c4" data-toggle="tooltip" data-html="true"  title="Saldo acumulado (Entradas acumuladas + Saldos iniciais bancários + Saldo inicial do caixa) - (Despesas acumuladas)<br><br><strong>Entradas:</strong> R$ <?php echo number_format($entradasgerais,2,',','.');?><Br><strong>Saídas:</strong> R$ <?php echo number_format($saidasgerais,2,',','.');?>">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <!--<div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>-->
                                            <div class="text">
                                                <span style="font-size: 16px !important">Bancos + Caixa</span>
                                                <h2 style="font-size: 18px !important; margin: 0 0 10px 0 !important;">R$ 
												<?php 
													if($totalgeral == 0){echo "0,00";}else{echo number_format($totalgeral,2,',','.');};
												?></h2>
                                                <span style="font-size: 16px !important">Fundo Acumulado</span>
                                                <h2 style="font-size: 18px !important; margin: 0 0 10px 0 !important;">R$ <?php echo number_format(($row_fntotalg1['valor']-$row_rttotalg1['valor']),2,',','.'); ?></h2>
                                                <span style="font-size: 16px !important">Retiradas Fundo</span>
                                                <h2 style="font-size: 18px !important; margin: 0 0 10px 0 !important;">R$ <?php echo number_format(($row_rttotalg1['valor']),2,',','.'); ?></h2>
                                                <span style="font-size: 16px !important">Bancos + Caixa + Fundo</span>
                                                <h2 style="font-size: 18px !important; margin: 0 !important;">R$ <?php echo number_format((($row_fntotalg1['valor']-$row_rttotalg1['valor']) + $totalgeral),2,',','.'); ?></h2>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </a>
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
                                                <?php if($_GET['clube']){?>
                                                <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                <?php } ?>
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
									<input type="hidden" id="janeiro" value="<?php despesagrafico('1', $filtroano, $clube); ?>">
									<input type="hidden" id="fevereiro" value="<?php despesagrafico('2', $filtroano, $clube); ?>">
									<input type="hidden" id="marco" value="<?php despesagrafico('3', $filtroano, $clube); ?>">
									<input type="hidden" id="abril" value="<?php despesagrafico('4', $filtroano, $clube); ?>">
									<input type="hidden" id="maio" value="<?php despesagrafico('5', $filtroano, $clube); ?>">
									<input type="hidden" id="junho" value="<?php despesagrafico('6', $filtroano, $clube); ?>">
									<input type="hidden" id="julho" value="<?php despesagrafico('7', $filtroano, $clube); ?>">
									<input type="hidden" id="agosto" value="<?php despesagrafico('8', $filtroano, $clube); ?>">
									<input type="hidden" id="setembro" value="<?php despesagrafico('9', $filtroano, $clube); ?>">
									<input type="hidden" id="outubro" value="<?php despesagrafico('10', $filtroano, $clube); ?>">
									<input type="hidden" id="novembro" value="<?php despesagrafico('11', $filtroano, $clube); ?>">
									<input type="hidden" id="dezembro" value="<?php despesagrafico('12', $filtroano, $clube); ?>">
									
									<input type="hidden" id="recjaneiro" value="<?php receitagrafico('1', $filtroano, $clube); ?>">
									<input type="hidden" id="recfevereiro" value="<?php receitagrafico('2', $filtroano, $clube); ?>">
									<input type="hidden" id="recmarco" value="<?php receitagrafico('3', $filtroano, $clube); ?>">
									<input type="hidden" id="recabril" value="<?php receitagrafico('4', $filtroano, $clube); ?>">
									<input type="hidden" id="recmaio" value="<?php receitagrafico('5', $filtroano, $clube); ?>">
									<input type="hidden" id="recjunho" value="<?php receitagrafico('6', $filtroano, $clube); ?>">
									<input type="hidden" id="recjulho" value="<?php receitagrafico('7', $filtroano, $clube); ?>">
									<input type="hidden" id="recagosto" value="<?php receitagrafico('8', $filtroano,$clube); ?>">
									<input type="hidden" id="recsetembro" value="<?php receitagrafico('9', $filtroano, $clube); ?>">
									<input type="hidden" id="recoutubro" value="<?php receitagrafico('10', $filtroano, $clube); ?>">
									<input type="hidden" id="recnovembro" value="<?php receitagrafico('11', $filtroano, $clube); ?>">
									<input type="hidden" id="recdezembro" value="<?php receitagrafico('12', $filtroano, $clube); ?>">
									
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
			

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Inadimplentes do mês</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
                <div class="row">
                    <div class="col-lg-12">
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-30">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                            <!--<thead>
                                                <th colspan="3" style="color: #fff; text-align:center;">Inadimplentes do mês <button type="button" onclick="exibeinad();" class="btn btn-warning" style="margin-left: 10px">Exibir / Ocultar</button></th>
                                            </thead>-->
                                            <?php if($totalRows_lisinadtotal < 1){echo "<tbody><tr><td colspan='3' align='center'>Ainda não há inadimplentes deste mês!</td></tr></tbody>";}else{?>
                                                <tbody id="exibeinad" >
                                                <tr>
                                                    <td style="text-align:center; font-weight:bold;">Sócio</td>
                                                    <td style="text-align:center; font-weight:bold;">Vencimento</td>
                                                    <td style="text-align:center; font-weight:bold;">Valor</td>
                                                    <td style="text-align:center; font-weight:bold;"></td>
                                                    <td style="text-align:center; font-weight:bold;"></td>
                                                    <td style="text-align:center; font-weight:bold;"></td>
                                                </tr>
                                                <?php do{?>
                                                    <tr>
                                                        <td style="text-align:center;"><?php echo $row_lisinadtotal['nome_socio'];?></td>
                                                        <td style="text-align:center;"><?php echo date('d/m/y',strtotime($row_lisinadtotal['data_mensalidade']));?></td>
                                                        <td style="text-align:center;">R$ <?php echo number_format($row_lisinadtotal['valor_mensalidade'],2,',','.');?></td>
                                                        <td style="text-align:center;"><a href="proc_primeira_cob.php?id_socio=<?php echo $row_lisinadtotal['id_socio'];?>&clube=<?php echo $clube;?>&codmens=<?php echo $row_lisinadtotal['cod_mensalidade'];?>" data-toggle="tooltip" title="Enviar 1ª cobrança" style="color: #fff;"><i class="fas fa-envelope-open"></i></a></td>
                                                        <td style="text-align:center;"><a href="proc_segunda_cob.php?id_socio=<?php echo $row_lisinadtotal['id_socio'];?>&clube=<?php echo $clube;?>&codmens=<?php echo $row_lisinadtotal['cod_mensalidade'];?>" data-toggle="tooltip" title="Enviar 2ª cobrança" style="color: #fff;"><i class="far fa-envelope-open"></i></a></td>
                                                        <td style="text-align:center;"><a href="proc_cob_whatsapp.php?id_socio=<?php echo $row_lisinadtotal['id_socio'];?>&clube=<?php echo $clube;?>&codmens=<?php echo $row_lisinadtotal['cod_mensalidade'];?>"><i class="fab fa-whatsapp" style="color: #a9ff9a"></i></a></td>
                                                    </tr>
                                                <?php }while($row_lisinadtotal = mysqli_fetch_assoc($lisinadtotal));?> 
                                                </tbody>
                                            <?php }?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalMensalidade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mensalidades do Mês</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
                <div class="row">
                    <div class="col-lg-12">
                                <div class="au-card au-card--bg-mensalidades au-card-top-countries m-b-30">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                            <!--<thead>
                                                <th colspan="3" style="color: #fff; text-align:center;">Inadimplentes do mês <button type="button" onclick="exibeinad();" class="btn btn-warning" style="margin-left: 10px">Exibir / Ocultar</button></th>
                                            </thead>-->
                                            <?php if($totalRows_msm < 1){echo "<tbody><tr><td colspan='3' align='center'>Ainda não há mensalidades deste mês!</td></tr></tbody>";}else{?>
                                                <tbody id="exibeinad" >
                                                <tr>
                                                    <td style="text-align:center; font-weight:bold;">Sócio</td>
                                                    <td style="text-align:center; font-weight:bold;">Vencimento</td>
                                                    <td style="text-align:center; font-weight:bold;">Valor</td>
                                                    <td style="text-align:center; font-weight:bold;">Pagamento</td>
                                                </tr>
                                                <?php while($row_msm = mysqli_fetch_array($msm)){?>
                                                    <tr>
                                                        <td style="text-align:center;"><?php echo $row_msm['nome_socio'];?></td>
                                                        <td style="text-align:center;"><?php echo date('d/m/y',strtotime($row_msm['data_mensalidade']));?></td>
                                                        <td style="text-align:center;" contenteditable="true" data-old_value="<?php echo $row_msm['valor_mensalidade']; ?>" onBlur="saveInlineEdit(this,'valor_mensalidade','<?php echo $row_msm['cod_mensalidade']; ?>')" onClick="highlightEdit(this);" scope="row" align="center" style="text-align:center;" ><?php echo number_format($row_msm['valor_mensalidade'],2,',','.');?></td>
                                                        <td style="text-align:center;"><?php if($row_msm['pagamento'] == 1){echo "<i class='fas fa-check-circle' style='font-size: 22px; color: #52e840'></i>";}else{echo "<i class='fas fa-ban' style='font-size: 22px; color: #ff0000;'></i>";};?></td>
                                                    </tr>
                                                <?php } ?> 
                                                </tbody>
                                            <?php }?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>


			<div class="section__content section__content--p30">
                    
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