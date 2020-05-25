<?php 

//Ano Rotário
$anoinicial = date('Y');
$anoseguinte = $anoinicial + 1;

//Busca categorias para exibir na listagem de categorias
$scat = "SELECT * FROM rfa_prev_categorias WHERE clube='$clube'";
$vercat = mysqli_query($link, $scat) or die(mysqli_error($link));
$totalRows_vercat = mysqli_num_rows($vercat);

///////////////////////PIZZA FUNDOS/////////////////////////////////////
//Pega categorias para listar na lateral do gráfico de pizza
$scatg2 = "SELECT * FROM rfa_prev_categorias INNER JOIN rfa_prev_fundos ON rfa_prev_categorias.id_categoria = rfa_prev_fundos.cat_prev_fundos WHERE rfa_prev_fundos.clube='$clube' GROUP BY rfa_prev_fundos.cat_prev_fundos";
$vercatg2 = mysqli_query($link, $scatg2) or die(mysqli_error($link));
$totalRows_vercatg2 = mysqli_num_rows($vercatg2);

//Busca categorias para gráfico
$scatg = "SELECT * FROM rfa_prev_categorias INNER JOIN rfa_prev_fundos ON rfa_prev_categorias.id_categoria = rfa_prev_fundos.cat_prev_fundos WHERE rfa_prev_fundos.clube='$clube' GROUP BY rfa_prev_fundos.cat_prev_fundos";
$vercatg = mysqli_query($link, $scatg) or die(mysqli_error($link));
$totalRows_vercatg = mysqli_num_rows($vercatg);

$catlist = "";
$valorlist = "";
foreach($vercatg as $vcat){
    $idct = $vcat['id_categoria'];
    $sctg = "SELECT SUM(valor_prev_fundos) as valor FROM rfa_prev_fundos WHERE clube='$clube' AND cat_prev_fundos='$idct'";
    $verctg = mysqli_query($link, $sctg) or die(mysqli_error($link));
    $row_verctg = mysqli_fetch_array($verctg);
   
    $valorlist .= $row_verctg['valor'].",";
    
    $catlist .= $vcat['nome_categoria'].","; 
}
$vrlist = substr($valorlist,0,-1);
$ctlist = substr($catlist,0,-1);

$corlist = "";
foreach($vercatg as $ccat){
    $corlist .= $ccat['cor_categoria'].","; 
}
$crlist = substr($corlist,0,-1);

///////////////////////PIZZA FUNDOS/////////////////////////////////////

///////////////////////PIZZA PAGAR/////////////////////////////////////
//Pega categorias para listar na lateral do gráfico de pizza
$scatg3 = "SELECT * FROM rfa_prev_categorias INNER JOIN rfa_prev_pagar ON rfa_prev_categorias.id_categoria = rfa_prev_pagar.cat_prev_pagar WHERE rfa_prev_pagar.clube='$clube' GROUP BY rfa_prev_pagar.cat_prev_pagar";
$vercatg3 = mysqli_query($link, $scatg3) or die(mysqli_error($link));
$totalRows_vercatg3 = mysqli_num_rows($vercatg3);

//Busca categorias para gráfico
$scatg1 = "SELECT * FROM rfa_prev_categorias INNER JOIN rfa_prev_pagar ON rfa_prev_categorias.id_categoria = rfa_prev_pagar.cat_prev_pagar WHERE rfa_prev_pagar.clube='$clube' GROUP BY rfa_prev_pagar.cat_prev_pagar";
$vercatg1 = mysqli_query($link, $scatg1) or die(mysqli_error($link));
$totalRows_vercatg1 = mysqli_num_rows($vercatg1);

$catlist1 = "";
$valorlist1 = "";
foreach($vercatg1 as $vcat1){
    $idct1 = $vcat1['id_categoria'];
    $sctg1 = "SELECT SUM(valor_prev_pagar) as valor FROM rfa_prev_pagar WHERE clube='$clube' AND cat_prev_pagar='$idct1'";
    $verctg1 = mysqli_query($link, $sctg1) or die(mysqli_error($link));
    $row_verctg1 = mysqli_fetch_array($verctg1);
   
    $valorlist1 .= $row_verctg1['valor'].",";
    
    $catlist1 .= $vcat1['nome_categoria'].","; 
}
$vrlist1 = substr($valorlist1,0,-1);
$ctlist1 = substr($catlist1,0,-1);

$corlist1 = "";
foreach($vercatg1 as $ccat1){
    $corlist1 .= $ccat1['cor_categoria'].","; 
}
$crlist1 = substr($corlist1,0,-1);

///////////////////////PIZZA PAGAR/////////////////////////////////////


//Busca informações do clube
$sc = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$verclub = mysqli_query($link, $sc) or die(mysqli_error($link));
$row_verclub = mysqli_fetch_assoc($verclub);
$taxaclube = $row_verclub['paghiper_taxa'];

//Valores fixos
$sq = "SELECT * FROM rfa_prev_fixas WHERE clube='$clube'";
$verfixas = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_verfixas = mysqli_fetch_assoc($verfixas);
$totalRows_verfixas = mysqli_num_rows($verfixas);

$qtdsocios = $row_verfixas['qtd_socios'];
$valormensalidades = $row_verfixas['valor_mensalidades'];
$qtdrefeicoes = $row_verfixas['qtd_refeicoes'];
$qtdalmocos = $row_verfixas['qtd_almocos'];
$valorrefeicoes = $row_verfixas['valor_refeicoes'];
$valorpercaptari = $row_verfixas['valor_percapta_ri'];
$valorpercaptadi = $row_verfixas['valor_percapta_di'];
$cambio = $row_verfixas['cambio'];
$saldoinicial = $row_verfixas['saldo_inicial'];

if($totalRows_verfixas < 1){
    $sql = "INSERT INTO rfa_prev_fixas (cambio, saldo_inicial,qtd_socios,valor_mensalidades, qtd_refeicoes, valor_refeicoes, valor_percapta_di, valor_percapta_ri, clube) VALUES ('0','0','0','0','0','0','0','0','$clube');";
    $link->multi_query($sql);
}

//Fundos totais
$sqfund = "SELECT SUM(valor_prev_fundos) as valor FROM rfa_prev_fundos WHERE clube='$clube'";
$ttfund = mysqli_query($link, $sqfund) or die(mysqli_error($link));
$row_fund = mysqli_fetch_assoc($ttfund);

//Retiradas totais
$sqret = "SELECT SUM(valor_prev_retiradas) as valor FROM rfa_prev_retiradas WHERE clube='$clube'";
$ttret = mysqli_query($link, $sqret) or die(mysqli_error($link));
$row_ret = mysqli_fetch_assoc($ttret);

//Despesas totais
$sqdesp = "SELECT SUM(valor_prev_pagar) as valor FROM rfa_prev_pagar WHERE clube='$clube'";
$ttdesp = mysqli_query($link, $sqdesp) or die(mysqli_error($link));
$row_ttdesp = mysqli_fetch_assoc($ttdesp);

$totalpercaptari = (($cambio * $valorpercaptari) * $qtdsocios) / 12;//mes
$totalrefeicoes = ($qtdrefeicoes * $valorrefeicoes) * $qtdalmocos;//mes
$totaltaxas = $qtdsocios * $taxaclube; // mês
$totalmensalidades = $qtdsocios * $valormensalidades;//mes

$totalretiradas = $row_ret['valor'];
$totalpercaptariano = $totalpercaptari * 12;//ano
$totaltaxasano = ($qtdsocios * $taxaclube) * 12;//ano
$totalfundos =  ($row_fund['valor'] + ($totalpercaptari * 12)) - $totalretiradas;//ano
$totalrefeicoesano = $totalrefeicoes * 12;//ano
$totalpercaptadiano = $valorpercaptadi * 12;


//Total despesas gerais
$totaldespesas = $row_ttdesp['valor'] + (($totalrefeicoes + $valorpercaptadi + $totaltaxas) * 12);

//Total despesas sem taxas
$totaldespsemtaxa = $row_ttdesp['valor'] + $row_fund['valor'] + (($totalpercaptari + $totalrefeicoes + $valorpercaptadi) * 12);

//Receitas totais
$sqrec = "SELECT SUM(valor_prev_receitas) as valor FROM rfa_prev_receitas WHERE clube='$clube'";
$ttrec = mysqli_query($link, $sqrec) or die(mysqli_error($link));
$row_rec = mysqli_fetch_assoc($ttrec);

$totalreceitas = $row_rec['valor'] + ($totalmensalidades * 12) + $saldoinicial;

//Saldo final
$saldofinal = $totalreceitas - ($totaldespesas + $row_fund['valor'] + $totalpercaptariano);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////GRÁFICO////////////////////////////////////////////

function receitagrafico($mes, $ano, $clube){
include('config.php');

$sqrecpgraf = "SELECT SUM(valor_prev_receitas) as valor FROM rfa_prev_receitas WHERE clube='$clube' AND MONTH(data_prev_receitas) = '$mes' AND YEAR(data_prev_receitas) = '$ano'";
$recpgraftotal = mysqli_query($link, $sqrecpgraf) or die(mysqli_error($link));
$row_recpgraftotal = mysqli_fetch_assoc($recpgraftotal);

$sqf = "SELECT * FROM rfa_prev_fixas WHERE clube='$clube'";
$verfixas = mysqli_query($link, $sqf) or die(mysqli_error($link));
$row_verfixas = mysqli_fetch_assoc($verfixas);
$totalRows_verfixas = mysqli_num_rows($verfixas);

$qtdsocios = $row_verfixas['qtd_socios'];
$valormensalidades = $row_verfixas['valor_mensalidades'];
$saldoinicial = $row_verfixas['saldo_inicial'];


echo $row_recpgraftotal['valor'] + ($qtdsocios * $valormensalidades);

}

function despesagrafico($mespg, $anopg, $clubepg){
include('config.php');

$sqdespgraf = "SELECT SUM(valor_prev_pagar) as valor FROM rfa_prev_pagar WHERE clube='$clubepg' AND MONTH(data_prev_pagar) = '$mespg' AND YEAR(data_prev_pagar) = '$anopg'";
$despgraftotal = mysqli_query($link, $sqdespgraf) or die(mysqli_error($link));
$row_despgraftotal = mysqli_fetch_assoc($despgraftotal);

$sq = "SELECT * FROM rfa_prev_fixas WHERE clube='$clubepg'";
$verfixas = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_verfixas = mysqli_fetch_assoc($verfixas);
$totalRows_verfixas = mysqli_num_rows($verfixas);

$sqfundgraf = "SELECT SUM(valor_prev_fundos) as valor FROM rfa_prev_fundos WHERE clube='$clubepg' AND MONTH(data_prev_fundos) = '$mespg' AND YEAR(data_prev_fundos) = '$anopg'";
$fundgraftotal = mysqli_query($link, $sqfundgraf) or die(mysqli_error($link));
$row_fundgraftotal = mysqli_fetch_assoc($fundgraftotal);

$sc = "SELECT * FROM rfa_clubes WHERE id_clube='$clubepg'";
$verclub = mysqli_query($link, $sc) or die(mysqli_error($link));
$row_verclub = mysqli_fetch_assoc($verclub);
$taxaclube = $row_verclub['paghiper_taxa'];

$qtdsocios = $row_verfixas['qtd_socios'];
$valormensalidades = $row_verfixas['valor_mensalidades'];
$qtdrefeicoes = $row_verfixas['qtd_refeicoes'];
$valorrefeicoes = $row_verfixas['valor_refeicoes'];
$valorpercaptari = $row_verfixas['valor_percapta_ri'];
$valorpercaptadi = $row_verfixas['valor_percapta_di'];
$cambio = $row_verfixas['cambio'];
$saldoinicial = $row_verfixas['saldo_inicial'];
$qtdalmocos = $row_verfixas['qtd_almocos'];

$totalpercaptari = (($cambio * $valorpercaptari) * $qtdsocios) / 12;
$totalrefeicoes = ($qtdrefeicoes * $valorrefeicoes) * $qtdalmocos;
$taxaboleto = $qtdsocios * $taxaclube;

echo $taxaboleto + $row_despgraftotal['valor'] + ($totalrefeicoes + $valorpercaptadi);

}

function saldografico($messd, $anosd, $clubesd){
include('config.php');

$sqrecpgraf = "SELECT SUM(valor_prev_receitas) as valor FROM rfa_prev_receitas WHERE clube='$clubesd' AND MONTH(data_prev_receitas) = '$messd' AND YEAR(data_prev_receitas) = '$anosd'";
$recpgraftotal = mysqli_query($link, $sqrecpgraf) or die(mysqli_error($link));
$row_recpgraftotal = mysqli_fetch_assoc($recpgraftotal);

$sqdespgraf = "SELECT SUM(valor_prev_pagar) as valor FROM rfa_prev_pagar WHERE clube='$clubesd' AND MONTH(data_prev_pagar) = '$messd' AND YEAR(data_prev_pagar) = '$anosd'";
$despgraftotal = mysqli_query($link, $sqdespgraf) or die(mysqli_error($link));
$row_despgraftotal = mysqli_fetch_assoc($despgraftotal);

$sq = "SELECT * FROM rfa_prev_fixas WHERE clube='$clubesd'";
$verfixas = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_verfixas = mysqli_fetch_assoc($verfixas);
$totalRows_verfixas = mysqli_num_rows($verfixas);

$sqfundgraf = "SELECT SUM(valor_prev_fundos) as valor FROM rfa_prev_fundos WHERE clube='$clubesd' AND MONTH(data_prev_fundos) = '$messd' AND YEAR(data_prev_fundos) = '$anosd'";
$fundgraftotal = mysqli_query($link, $sqfundgraf) or die(mysqli_error($link));
$row_fundgraftotal = mysqli_fetch_assoc($fundgraftotal);

$sc = "SELECT * FROM rfa_clubes WHERE id_clube='$clubesd'";
$verclub = mysqli_query($link, $sc) or die(mysqli_error($link));
$row_verclub = mysqli_fetch_assoc($verclub);
$taxaclube = $row_verclub['paghiper_taxa'];

//Retiradas totais
$sqret = "SELECT SUM(valor_prev_retiradas) as valor FROM rfa_prev_retiradas WHERE clube='$clubesd' AND MONTH(data_prev_retiradas) = '$messd' AND YEAR(data_prev_retiradas) = '$anosd'";
$ttret = mysqli_query($link, $sqret) or die(mysqli_error($link));
$row_ret = mysqli_fetch_assoc($ttret);
$totalretiradas = $row_ret['valor'];

$qtdsocios = $row_verfixas['qtd_socios'];
$valormensalidades = $row_verfixas['valor_mensalidades'];
$qtdrefeicoes = $row_verfixas['qtd_refeicoes'];
$valorrefeicoes = $row_verfixas['valor_refeicoes'];
$valorpercaptari = $row_verfixas['valor_percapta_ri'];
$valorpercaptadi = $row_verfixas['valor_percapta_di'];
$cambio = $row_verfixas['cambio'];
$saldoinicial = $row_verfixas['saldo_inicial'];
$qtdalmocos = $row_verfixas['qtd_almocos'];

$totalpercaptari = (($cambio * $valorpercaptari) * $qtdsocios) / 12;
$totalrefeicoes = ($qtdrefeicoes * $valorrefeicoes) * $qtdalmocos;
$taxaboleto = $qtdsocios * $taxaclube;

$totalreceitas = $row_recpgraftotal['valor'] + ($qtdsocios * $valormensalidades);
$totaldespesas = $totalretiradas + $row_despgraftotal['valor'] + $row_fundgraftotal['valor'] + ($totalpercaptari + $totalrefeicoes + $valorpercaptadi + $taxaboleto);

echo $totalreceitas - $totaldespesas;

}

function fundosgrafico($mesfd, $anofd, $clubefd){
include('config.php');

$sqfundgraf = "SELECT SUM(valor_prev_fundos) as valor FROM rfa_prev_fundos WHERE clube='$clubefd' AND MONTH(data_prev_fundos) = '$mesfd' AND YEAR(data_prev_fundos) = '$anofd'";
$fundgraftotal = mysqli_query($link, $sqfundgraf) or die(mysqli_error($link));
$row_fundgraftotal = mysqli_fetch_assoc($fundgraftotal);

$sq = "SELECT * FROM rfa_prev_fixas WHERE clube='$clubefd'";
$verfixas = mysqli_query($link, $sq) or die(mysqli_error($link));
$row_verfixas = mysqli_fetch_assoc($verfixas);
$totalRows_verfixas = mysqli_num_rows($verfixas);

//Retiradas totais
$sqret = "SELECT SUM(valor_prev_retiradas) as valor FROM rfa_prev_retiradas WHERE clube='$clubefd' AND MONTH(data_prev_retiradas) = '$mesfd' AND YEAR(data_prev_retiradas) = '$anofd'";
$ttret = mysqli_query($link, $sqret) or die(mysqli_error($link));
$row_ret = mysqli_fetch_assoc($ttret);

$qtdsocios = $row_verfixas['qtd_socios'];
$valormensalidades = $row_verfixas['valor_mensalidades'];
$qtdrefeicoes = $row_verfixas['qtd_refeicoes'];
$valorrefeicoes = $row_verfixas['valor_refeicoes'];
$valorpercaptari = $row_verfixas['valor_percapta_ri'];
$valorpercaptadi = $row_verfixas['valor_percapta_di'];
$cambio = $row_verfixas['cambio'];
$saldoinicial = $row_verfixas['saldo_inicial'];
$totalretiradas = $row_ret['valor'];


$totalpercaptari = (($cambio * $valorpercaptari) * $qtdsocios) / 12;

echo ($row_fundgraftotal['valor'] + $totalpercaptari) - $totalretiradas;

}

?>

<input type="text" name="fundofinal" id="fundofinal"> 
<!-- Modal Câmbio-->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Câmbio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="previsao_cambio.php" method="post">
            <label class="form-control-label">Valor do Câmbio</label>
            <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">R$</div>
        </div>
        <input type="text" class="form-control" id="cambio" name="cambio" onKeyPress="return(moeda(this,'.',',',event))" value="<?php echo number_format($cambio,2,',','.');?>">
        <input type="hidden" name="clube" value="<?php echo $clube; ?>">
      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Saldo Inicial-->
<div class="modal fade" id="modalExemplo2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Saldo Inicial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="previsao_saldoinicial.php" method="post">
            <label class="form-control-label">Valor do Saldo Inicial</label>
            <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">R$</div>
        </div>
        <input type="text" class="form-control" id="saldoinicial" name="saldoinicial" onKeyPress="return(moeda(this,'.',',',event))" value="<?php echo number_format($saldoinicial,2,',','.');?>">
        <input type="hidden" name="clube" value="<?php echo $clube; ?>">
      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Categorias-->
<div class="modal fade" id="modalExemplo3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="previsao_categorias.php" method="post" class="form-inline">
            <div class="row" style="width: 100% !important;  text-align: center;">
                <div class="col">
                    <label class="form-control-label"><Strong>Nome da Categoria:</Strong></label>
                    <input type="text" class="form-control my-1 mr-sm-2" id="nomecategoria" name="nomecategoria" placeholder="Digite o nome da categoria...">
                    <select class="form-control" name="corcategoria">
                        <option>Cor...</option>
                        <option value="#000" style="background: #000;"></option>
                        <option value="#007bff" style="background: #007bff;"></option>
                        <option value="#28a745" style="background: #28a745;"></option>
                        <option value="#a7289d" style="background: #a7289d;"></option>
                        <option value="#1d28b1" style="background: #1d28b1;"></option>
                        <option value="#b51717" style="background: #b51717;"></option>
                        <option value="#484848" style="background: #484848;"></option>
                        <option value="#189494" style="background: #189494;"></option>
                        <option value="#dccb02" style="background: #dccb02;"></option>
                        <option value="#dc8502" style="background: #dc8502;"></option>
                        <option value="#5f0c8a" style="background: #5f0c8a;"></option>
                        <option value="#09275d" style="background: #09275d;"></option>
                        <option value="#5eb730" style="background: #5eb730;"></option>
                        <option value="#d9b1dc" style="background: #d9b1dc;"></option>
                        
                    </select>
                    <button type="submit" class="btn btn-primary my-1">Inserir</button>
                </div>
            </div>
            <input type="hidden" name="clube" value="<?php echo $clube; ?>">
        </form>
            <div class="row" style="margin-top: 15px; ">
                <div class="col">
                    <h4 align="center">Categorias cadastradas:</h4>

                    <table class="table" style="margin-top: 10px">
                      
                      <tbody>
                        <?php 
                        if($totalRows_vercat < 1){echo "<tr><td colspan='3' align='center'>Não há categorias cadastradas!</td></tr>";}else{
                        while($row_vercat = mysqli_fetch_array($vercat)){
                            
                            ?>
                        <tr>
                          <th scope="row" style="text-align:center;"><?php echo $row_vercat['nome_categoria'];?></th>
                          <td style="text-align:center;"><span style="width: 20px; height: 20px; background: <?php echo $row_vercat['cor_categoria'];?>; display:block;border-radius: 100%; ">&nbsp;</span></td>
                          <td style="text-align:center;"><a href="previsao-excluir-categoria.php?idcat=<?php echo $row_vercat['id_categoria'];?>&clube=<?php echo $clube;?>"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php }} ?>
                      </tbody>
                    </table>

                </div>
            </div>

        
     
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>

<!-- Modal Calculador-->
<div class="modal fade" id="modalExemplo4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Calculadora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="container text-center" id="calc">
  <div class="calcBG text-center">
    
    <div class="row" id="result">
      <form name="calc">
        <input type="text" class="screen text-right" name="result" readonly>
      </form>
    </div>
    <div class="row">
      <button id="allClear" type="button" class="btn btn-danger button-calc" onclick="clearScreen()">AC</button>
      <button id="clear" type="button" class="btn btn-warning button-calc" onclick="clearScreen()">CE</button>
      <button id="%" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">%</button>
      <button id="/" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">÷</button>
    </div>
    <div class="row">
      <button id="7" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">7</button>
      <button id="8" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">8</button>
      <button id="9" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">9</button>
      <button id="*" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">x</button>
    </div>
    <div class="row">
      <button id="4" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">4</button>
      <button id="5" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">5</button>
      <button id="6" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">6</button>
      <button id="-" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">-</button>
    </div>
    <div class="row">
      <button id="1" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">1</button>
      <button id="2" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">2</button>
      <button id="3" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">3</button>
      <button id="+" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">+</button>
    </div>
    <div class="row">
      <button id="0" type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">0</button>
      <button id="." type="button" class="btn btn-info button-calc" onclick="myFunction(this.id)">.</button>
      <button id="equals" type="button" class="btn btn-success button-calc" onclick="calculate()">=</button>
      <button id="blank" type="button" class="btn btn-info button-calc">&nbsp;</button>
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
                                

                                    <a href="previsao_receitas.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" role="button" class=" btn btn-success btrespons">
                                        <i class="fas fa-plus-circle" style="margin-right: 10px"></i> Receitas Previstas</a>
                                    <a href="previsao_pagar.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" role="button" class=" btn btn-danger btrespons">
                                        <i class="fas fa-plus-circle" style="margin-right: 10px"></i> Despesas Previstas</a>
                                    <a href="previsao_fundos.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" role="button" class=" btn btn-danger btrespons" style="background:#434a94; border: 1px solid #434a94;">
                                        <i class="fas fa-plus-circle" style="margin-right: 10px"></i> Fundos Previstos</a>

                                        <a href="previsao_retiradas.php" role="button" class=" btn btn-danger btrespons" style="background:#000; border: 1px solid #000;">
                                        <i class="fas fa-plus-circle" style="margin-right: 10px"></i> Retiradas</a>

                                    <a href="#" role="button" class=" btn btn-info btrespons" data-toggle="modal" data-target="#modalExemplo">
                                        <i class="fas fa-dollar-sign" style="margin-right: 10px"></i> Câmbio Estimado <strong>(R$ <?php echo number_format($cambio,2,',','.'); ?>)</strong></a>
                                     <a href="#" role="button" class=" btn btn-secondary btrespons" data-toggle="modal" data-target="#modalExemplo2">
                                        <i class="fas fa-dollar-sign" style="margin-right: 10px"></i> Saldo inicial <strong>(R$ <?php echo number_format($saldoinicial,2,',','.'); ?>)</strong></a>
                                        
                                        <a href="#" data-toggle="modal" data-target="#modalExemplo3" role="button" class="btn btn-danger btrespons" style="background:#6d4394; border: 1px solid #6d4394;">
                                        <i class="fas fa-chart-pie" style="margin-right: 10px"></i> Categorias</a>

                                        

                                    </div>
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
                        <div class="col">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Seja bem vindo(a) á Previsão Orçamentária do seu clube</strong><br> Faça os ajustes nos campos abaixo, e também preencha as receitas previstas, despesas previstas e fundos previstos de forma adequada para obter resultados próximos da realidade de seu clube.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>  
                        </div>             
                    </div>
					
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-12 col-md-4">
                                <form action="previsao_proc_fixas.php" method="post">
                                 <label class="form-control-label"><i class="fas fa-money-check-alt"></i> N° sócios</label>
                                 
                                    
                                    <input type="text" class="form-control" onkeypress="return somenteNumeros(event)" name="qtd-socios" id="qtd-socios" onChange="this.form.submit()" value="<?php echo $qtdsocios; ?>" onKeyPress="return(moeda(this,'.',',',event))">
                                    <input type="hidden" name="club" value="<?php echo $clube;?>">
                                    <input type="hidden" name="md" value="7">
                                  
                                </form>
                            </div>
                             <div class="col-12 col-md-4">
                                <form action="previsao_proc_fixas.php" method="post">
                                 <label class="form-control-label"><i class="fas fa-money-check-alt"></i> Valor Mensalidades</label>
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="text" class="form-control" name="valor-mensalidades" id="valor-mensalidades" onBlur="this.form.submit()" value="<?php echo number_format($valormensalidades,2,',','.'); ?>" onKeyPress="return(moeda(this,'.',',',event))">
                                    <input type="hidden" name="club" value="<?php echo $clube;?>">
                                    <input type="hidden" name="md" value="1">
                                  </div>
                                </form>
                            </div>
                            <div class="col-12 col-md-4">
                                <form action="previsao_proc_fixas.php" method="post">
                                 <label class="form-control-label">Valor Per Capta DI</label>
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="text" class="form-control" name="valor-percaptadi" id="valor-percaptadi" onBlur="this.form.submit()" value="<?php echo number_format($valorpercaptadi,2,',','.'); ?>" onKeyPress="return(moeda(this,'.',',',event))">
                                  </div>
                                  <input type="hidden" name="club" value="<?php echo $clube;?>">
                                    <input type="hidden" name="md" value="5">
                                </form>
                            </div> 
                            <div class="col-12 col-md-3">
                                <form action="previsao_proc_fixas.php" method="post">
                                  <label class="form-control-label"><i class="fas fa-utensils"></i> N° de refeições</label>
                                  
                                    <input type="text" class="form-control" onkeypress="return somenteNumeros(event)" name="qtd-refeicoes" id="qtd-refeicoes" onChange="this.form.submit()" value="<?php echo "$qtdrefeicoes"; ?>">
                                    <input type="hidden" name="club" value="<?php echo $clube;?>">
                                    <input type="hidden" name="md" value="2">
                                </form>
                             </div>  
                             <div class="col-12 col-md-3">
                                <form action="previsao_proc_fixas.php" method="post">
                                 <label class="form-control-label"> <i class="fas fa-utensils"></i> Valor Refeições</label>
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="text" class="form-control" name="valor-refeicoes" id="valor-refeicoes" onBlur="this.form.submit()" value="<?php echo number_format($valorrefeicoes,2,',','.'); ?>" onKeyPress="return(moeda(this,'.',',',event))">
                                    <input type="hidden" name="club" value="<?php echo $clube;?>">
                                    <input type="hidden" name="md" value="3">
                                  </div>
                              </form>
                            </div>   
                            <div class="col-12 col-md-3">
                                <form action="previsao_proc_fixas.php" method="post">
                                  <label class="form-control-label"><i class="fas fa-utensils"></i> N° de almoços por mês</label>
                                  
                                    <input type="text" class="form-control" onkeypress="return somenteNumeros(event)" name="qtd-almocos" id="qtd-almocos" onChange="this.form.submit()" value="<?php echo "$qtdalmocos"; ?>">
                                    <input type="hidden" name="club" value="<?php echo $clube;?>">
                                    <input type="hidden" name="md" value="6">
                                </form>
                             </div> 
                            <div class="col-12 col-md-3">
                                <form action="previsao_proc_fixas.php" method="post">
                                 <label class="form-control-label">Valor Per Capta RI <i class="fas fa-info-circle" style="color: #434a94;font-size: 13px;margin-left: 5px;" data-toggle="tooltip" data-html="true" title="<strong>Valor convertido:</strong><br><?php echo "R$ ".number_format(($cambio * $valorpercaptari),2,',','.'); ?><br>Por sócio informado. "></i></label>
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">U$</div>
                                    </div>
                                    <input type="text" class="form-control" name="valor-percaptari" id="valor-percaptari" onBlur="this.form.submit()" value="<?php echo number_format($valorpercaptari,2,',','.'); ?>" onKeyPress="return(moeda(this,'.',',',event))">
                                  </div>
                                  <input type="hidden" name="club" value="<?php echo $clube;?>">
                                    <input type="hidden" name="md" value="4">
                                </form>
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
                            
							
                        
                            <div class="col-sm-6 col-lg-3">
                                <a href="previsao_pagar.php" class="col" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c3" data-toggle="tooltip" data-html="true" title="Soma o total de despesas durante o ano.<br><br><strong>Taxas de boletos:</strong><br> R$ <?php echo number_format($totaltaxasano,2,',','.');?> /ano<Br><strong>Despesas:</strong><br> R$ <?php echo number_format($totaldespsemtaxa,2,',','.');?> /ano">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-chart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
													if($totaldespesas == 0){echo "0,00";}else{echo number_format($totaldespesas,2,',','.');};
												?>
												</h2>
                                                <span>Total Despesas</span>
                                            </div>
                                            <div class="overview-chart">
                                                <canvas id="widgetChart3"></canvas>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </a>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <a href="previsao_receitas.php" class="col" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c2" data-toggle="tooltip" data-html="true" title="Soma as receitas do ano.<br><br><strong>Receitas:</strong><br> R$ <?php echo number_format($row_rec['valor'],2,',','.');?><br><strong>Mensalidades:</strong><br> R$ <?php echo number_format(($totalmensalidades*12),2,',','.');?><br><strong>Saldo inicial:</strong><br> R$ <?php echo number_format($saldoinicial,2,',','.');?>">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-chart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
													if($totalreceitas == 0){echo "0,00";}else{echo number_format($totalreceitas,2,',','.');};
												?>
												</h2>
                                                <span>Total Receitas</span>
                                            </div>
                                        </div>
                                       <!-- <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </a>
                            </div>
							
							
							
                            <div class="col-sm-6 col-lg-3">
                                <a href="#" class="col" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c5" data-toggle="tooltip" data-html="true"  >
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-chart"></i>
                                            </div>
                                            <div class="text">
                                                <h2 id="fundotroca">R$ 
												<?php 
                          //$fd = fundosgrafico('6', $anoseguinte, $clube);
													//if($fd == 0){echo "0,00";}else{echo number_format($fd,2,',','.');};
												?>
													<span id="fd"></span>
												</h2>
                                                <span>Total Fundos</span>
                                            </div>
                                        </div>
                                        <!--<div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>-->
                                    </div>
                                </div>
                            </a>
                            </div>
                            
                            <div class="col-sm-6 col-lg-3">
                                <a href="#" class="col" style="margin:0; padding:0;">
                                <div class="overview-item overview-item--c4" data-toggle="tooltip" data-html="true"  title="Total de receitas - Total de despesas">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-chart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>R$ 
												<?php 
													//if($saldofinal == 0){echo "0,00";}else{echo number_format($saldofinal,2,',','.');};
												?>
                        <span id="sd"></span>            
                        </h2>
                                                <span>Saldo Final</span>
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
                                    <h3 class="title-3" style="text-align:center;"><strong>Gráfico</strong> - Previsão Orçamentário de Ano Rotário | <strong><?php echo date('Y');?> / <?php echo date('Y')+1;?></strong></h3>
                                    <div class="chart-info">
                                        
                                       
                                    </div>

                                    <div class="col-lg-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <!--<h3 class="title-2 m-b-40">Bar chart</h3>-->
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>

									<input type="hidden" id="desp-jul-inic" value="<?php despesagrafico('7', $anoinicial, $clube); ?>">
									<input type="hidden" id="desp-ago-inic" value="<?php despesagrafico('8', $anoinicial, $clube); ?>">
									<input type="hidden" id="desp-set-inic" value="<?php despesagrafico('9', $anoinicial, $clube); ?>">
									<input type="hidden" id="desp-out-inic" value="<?php despesagrafico('10', $anoinicial, $clube); ?>">
									<input type="hidden" id="desp-nov-inic" value="<?php despesagrafico('11', $anoinicial, $clube); ?>">
									<input type="hidden" id="desp-dez-inic" value="<?php despesagrafico('12', $anoinicial, $clube); ?>">
									<input type="hidden" id="desp-jan-seg" value="<?php despesagrafico('1', $anoseguinte, $clube); ?>">
									<input type="hidden" id="desp-fev-seg" value="<?php despesagrafico('2', $anoseguinte, $clube); ?>">
									<input type="hidden" id="desp-mar-seg" value="<?php despesagrafico('3', $anoseguinte, $clube); ?>">
									<input type="hidden" id="desp-abr-seg" value="<?php despesagrafico('4', $anoseguinte, $clube); ?>">
									<input type="hidden" id="desp-mai-seg" value="<?php despesagrafico('5', $anoseguinte, $clube); ?>">
									<input type="hidden" id="desp-jun-seg" value="<?php despesagrafico('6', $anoseguinte, $clube); ?>">
									
									<input type="hidden" id="rec-jul-inic" value="<?php receitagrafico('7', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="rec-ago-inic" value="<?php receitagrafico('8', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="rec-set-inic" value="<?php receitagrafico('9', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="rec-out-inic" value="<?php receitagrafico('10', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="rec-nov-inic" value="<?php receitagrafico('11', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="rec-dez-inic" value="<?php receitagrafico('12', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="rec-jan-seg" value="<?php receitagrafico('1', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="rec-fev-seg" value="<?php receitagrafico('2', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="rec-mar-seg" value="<?php receitagrafico('3', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="rec-abr-seg" value="<?php receitagrafico('4', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="rec-mai-seg" value="<?php receitagrafico('5', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="rec-jun-seg" value="<?php receitagrafico('6', $anoseguinte, $clube); ?>">

                                    <input type="hidden" id="sald-jul-inic" value="<?php saldografico('7', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="sald-ago-inic" value="<?php saldografico('8', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="sald-set-inic" value="<?php saldografico('9', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="sald-out-inic" value="<?php saldografico('10', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="sald-nov-inic" value="<?php saldografico('11', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="sald-dez-inic" value="<?php saldografico('12', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="sald-jan-seg" value="<?php saldografico('1', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="sald-fev-seg" value="<?php saldografico('2', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="sald-mar-seg" value="<?php saldografico('3', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="sald-abr-seg" value="<?php saldografico('4', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="sald-mai-seg" value="<?php saldografico('5', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="sald-jun-seg" value="<?php saldografico('6', $anoseguinte, $clube); ?>">

                                    <input type="hidden" id="fund-jul-inic" value="<?php fundosgrafico('7', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="fund-ago-inic" value="<?php fundosgrafico('8', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="fund-set-inic" value="<?php fundosgrafico('9', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="fund-out-inic" value="<?php fundosgrafico('10', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="fund-nov-inic" value="<?php fundosgrafico('11', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="fund-dez-inic" value="<?php fundosgrafico('12', $anoinicial, $clube); ?>">
                                    <input type="hidden" id="fund-jan-seg" value="<?php fundosgrafico('1', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="fund-fev-seg" value="<?php fundosgrafico('2', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="fund-mar-seg" value="<?php fundosgrafico('3', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="fund-abr-seg" value="<?php fundosgrafico('4', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="fund-mai-seg" value="<?php fundosgrafico('5', $anoseguinte, $clube); ?>">
                                    <input type="hidden" id="fund-jun-seg" value="<?php fundosgrafico('6', $anoseguinte, $clube); ?>">


                                    <input type="hidden" id="saldini" value="<?php echo $saldoinicial; ?>">
									
                                    <!--<div class="recent-report__chart">
                                        <canvas id="recent-rep2-chart"></canvas>
                                    </div>-->
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

            <!-- Para fundos -->
            <?php if($totalRows_vercatg2 < 1){ ?>
            <input type="hidden" id="categorias" value="<?php echo "Per Capta RI"; ?>">
            <input type="hidden" id="corcat" value="<?php echo "#ef00d1"; ?>">
            <input type="hidden" id="valorcat" value="<?php echo $totalpercaptariano; ?>">
            <?php }else{?>

            <input type="hidden" id="categorias" value="<?php echo "Per Capta RI, ".$ctlist; ?>">
            <input type="hidden" id="corcat" value="<?php echo "#ef00d1, ".$crlist; ?>">
            <input type="hidden" id="valorcat" value="<?php echo $totalpercaptariano.", ".$vrlist; ?>">

            <?php } ?>

            <!-- Para despesas-->
            <?php if($totalRows_vercatg3 < 1){ ?>
            <input type="hidden" id="categorias1" value="<?php echo "Sem registros"; ?>">
            <input type="hidden" id="corcat1" value="<?php echo "#bdbdbd"; ?>">
            <input type="hidden" id="valorcat1" value="<?php echo "0.01"; ?>">
            <?php }else{?>
            
            <input type="hidden" id="categorias1" value="<?php echo "Per Capta Distrital, Refeições, ".$ctlist1; ?>">
            <input type="hidden" id="corcat1" value="<?php echo "#8c8c8c, #69473b, ".$crlist1; ?>">
            <input type="hidden" id="valorcat1" value="<?php echo $totalpercaptadiano.", ".$totalrefeicoesano.", ".$vrlist1; ?>">
            <?php } ?>
            
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="au-card chart-percent-card">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 tm-b-5"><strong>Despesas</strong> - Por categoria</h3>
                                        <div class="row no-gutters">
                                            <div class="col-xl-6">
                                                <div class="chart-note-wrap">
                                                    <?php if($totalRows_vercatg3 < 1){ ?>
                                                        <div class="chart-note mr-0 d-block">
                                                        <span style="width: 10px; height: 10px; display:inline-block;border-radius:100%; background: #bdbdbd"></span>
                                                        <span>Sem registros</span>
                                                    </div>
                                                    <?php }else{?>

                                                    <div class="chart-note mr-0 d-block">
                                                        <span style="width: 10px; height: 10px; display:inline-block;border-radius:100%; background: #8c8c8c"></span>
                                                        <span>Per Capta Distrital</span>
                                                    </div>

                                                    <div class="chart-note mr-0 d-block">
                                                        <span style="width: 10px; height: 10px; display:inline-block;border-radius:100%; background: #69473b"></span>
                                                        <span>Refeições</span>
                                                    </div>


                                                    <?php while($row_verctgi1 = mysqli_fetch_array($vercatg3)){?>

                                                    <div class="chart-note mr-0 d-block">
                                                        <span style="width: 10px; height: 10px; display:inline-block;border-radius:100%; background: <?php echo $row_verctgi1['cor_categoria'];?>"></span>
                                                        <span><?php echo $row_verctgi1['nome_categoria'];?></span>
                                                    </div>
                                                    <?php }} ?>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="percent-chart">
                                                    <canvas id="percent-chart1"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="au-card chart-percent-card">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 tm-b-5"><strong>Fundos</strong> - Por categoria</h3>
                                        <div class="row no-gutters">
                                            <div class="col-xl-6">
                                                <div class="chart-note-wrap">
                                                    <?php if($totalRows_vercatg2 < 1){ ?>
                                                        <div class="chart-note mr-0 d-block">
                                                        <span style="width: 10px; height: 10px; display:inline-block;border-radius:100%; background: #ef00d1"></span>
                                                        <span>Per Capta RI</span>
                                                    </div>
                                                    <?php }else{?>

                                                    <div class="chart-note mr-0 d-block">
                                                        <span style="width: 10px; height: 10px; display:inline-block;border-radius:100%; background: #ef00d1"></span>
                                                        <span>Per Capta RI</span>
                                                    </div>

                                                    <?php while($row_verctgi = mysqli_fetch_array($vercatg2)){?>
                                                    <div class="chart-note mr-0 d-block">
                                                        <span style="width: 10px; height: 10px; display:inline-block;border-radius:100%; background: <?php echo $row_verctgi['cor_categoria'];?>"></span>
                                                        <span><?php echo $row_verctgi['nome_categoria'];?></span>
                                                    </div>
                                                    <?php }} ?>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="percent-chart">
                                                    <canvas id="percent-chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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