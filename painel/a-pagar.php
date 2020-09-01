<?php
$page = 3;

include('config-header.php');

//Seleciona todos os bancos em ordem crescente pelo nome nome do banco
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.cod_lista_banco WHERE rfa_bancos.clube='$clube' ORDER BY rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$bancos ="";
while($row_listabancos = mysqli_fetch_array($listabancos)){
    $bancos .= '<option value="'.$row_listabancos['cod_banco'].'">'.$row_listabancos['favorecido'].'<strong>('.$row_listabancos['nome_lista_banco'].')</strong></option>';
}

//Seleciona todos os tipos de bancos em ordem crescente pelo nome nome do tipo de banco
$query = "SELECT * FROM rfa_lista_tipo_banco WHERE clube='$clube' ORDER BY nome_lista_tipo ASC";
$listatipobanco = mysqli_query($link, $query) or die(mysqli_error($link));
$row_listatipobanco = mysqli_fetch_assoc($listatipobanco);

//Seleciona todos os tipos de contas bancárias
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.cod_banco WHERE rfa_pagar.clube='$clube' ORDER BY data_pagar DESC";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis);

$hoje = date('Y-m-d');
$semana = date('Y-m-d', strtotime($hoje. ' + 7 days'));
$mes = date('Y-m-d', strtotime($hoje. ' + 1 month'));

if($_GET['hoje'] == "hoje"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.cod_banco WHERE rfa_pagar.data_pagar='$hoje' AND rfa_pagar.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "semana"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.cod_banco WHERE rfa_pagar.data_pagar<'$semana' AND rfa_pagar.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

if($_GET['hoje'] == "mes"){
$qr = "SELECT * FROM rfa_pagar INNER JOIN rfa_bancos ON rfa_pagar.origem_pagar = rfa_bancos.cod_banco WHERE rfa_pagar.data_pagar<'$mes' AND rfa_pagar.clube='$clube'";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestão do Rotary Fortaleza Alagadiço">
    <meta name="author" content="David Magalhães">
    <meta name="keywords" content="rotary alagadiço, rotary fortaleza alagadiço, fortaleza alagadiço">

    <!-- Title Page-->
    <title>Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <!--Pergunta antes de ação-->
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function () {
            $("a.remove").click(function (e) {
                if (!confirm('Tem certeza que deseja excluir esta conta?')) {
                    e.preventDefault();
                    return false;
                }
                return true;
            });
        });
    </script>

    <!--Mask Money-->
    <script language="javascript">
        function moeda(a, e, r, t) {
            let n = "",
                h = j = 0,
                u = tamanho2 = 0,
                l = ajd2 = "",
                o = window.Event ? t.which : t.keyCode;
            if (13 == o || 8 == o)
                return !0;
            if (n = String.fromCharCode(o),
                -1 == "0123456789".indexOf(n))
                return !1;
            for (u = a.value.length,
                h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
            ;
            for (l = ""; h < u; h++)
                -
                1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
            if (l += n,
                0 == (u = l.length) && (a.value = ""),
                1 == u && (a.value = "0" + r + "0" + l),
                2 == u && (a.value = "0" + r + l),
                u > 2) {
                for (ajd2 = "",
                    j = 0,
                    h = u - 3; h >= 0; h--)
                    3 == j && (ajd2 += e,
                        j = 0),
                    ajd2 += l.charAt(h),
                    j++;
                for (a.value = "",
                    tamanho2 = ajd2.length,
                    h = tamanho2 - 1; h >= 0; h--)
                    a.value += ajd2.charAt(h);
                a.value += r + l.substr(u - 2, u)
            }
            return !1
        }
    </script>

</head>

<body class="animsition">
    <div class="page-wrapper">

        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <?php include("topo.php");?>


            <?php include("menu-mobile.php");?>







            <div class="main-content">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">A Pagar</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <!--<div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">All Properties</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>-->
                            <div class="rs-select2--light rs-select2--sm">
                                <form method="get" action="">
                                    <select class="js-select2" name="hoje" onChange="this.form.submit()">
                                        <option value="">Filtar</option>
                                        <option value="hoje">Hoje</option>
                                        <option value="semana">7 dias</option>
                                        <option value="mes">1 mês</option>
                                    </select>

                                    <div class="dropDownSelect2"></div>
                                    <?php if($_GET['clube']){?>
                                    <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                    <?php } ?>
                                </form>
                            </div>

                        </div>
                        <div class="table-data__tool-right">
                            <a href="cd_a_pagar.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>"
                                class="au-btn au-btn-icon au-btn--green au-btn--small" role="button">
                                <i class="zmdi zmdi-plus"></i>Despesa</a>

                            <!--<div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Exportar</option>
                                                <option value="">Opção 1</option>
                                                <option value="">Opção 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>-->
                        </div>
                    </div>
                    <?php if($totalRows_lis == 0){echo "<div class='row'><div class='col' style='text-align:center;'>Nenhum resultado encontrado!</div></div>";}else{?>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <!--<th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>-->
                                    <th>Origem</th>
                                    <th>Por</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Valor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while($row_lis = mysqli_fetch_array($lis)){ ?>

                                <tr class="tr-shadow">
                                    <!--<td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>-->
                                    <td><?php echo $row_lis['favorecido'];?></td>
                                    <td>
                                        <span class="block-email"><?php echo $row_lis['por_pagar'];?></span>
                                    </td>
                                    <td class="desc"><?php echo $row_lis['descricao_pagar'];?></td>
                                    <td><?php echo date("d/m/Y",strtotime($row_lis['data_pagar']));?></td>
                                    <td>
                                        <span
                                            class="status--<?php if($row_lis['status_pagar'] == 1){echo "denied";}else{echo "process";};?>"><?php if($row_lis['status_pagar'] == 1){echo "Pendente";}else{echo "Pago";};?></span>
                                    </td>
                                    <td>R$ <?php echo number_format($row_lis['valor_pagar'], 2, ',', '.');?></td>
                                    <td>
                                        <div class="table-data-feature" style="text-align:center">
                                            <!--<button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>-->
                                            <a href="#" class="item" data-toggle="modal"
                                                data-target="#Modal<?php echo $row_lis['id_pagar'];?>" title="Editar">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a href="excluir-a-pagar.php?idpagar=<?php echo $row_lis['id_pagar'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"
                                                class="item remove" data-toggle="tooltip" data-placement="top"
                                                title="Deletar">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            <?php if($row_lis['status_pagar'] == 2){?>
                                            <a href="mpdf/recibo-despesa.php?idpagar=<?php echo $row_lis['id_pagar'];?>&clube=<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>"
                                                class="item" data-toggle="tooltip" data-placement="top" title="Recibo"
                                                target="_blank">
                                                <i class="zmdi zmdi-receipt"></i>
                                            </a>
                                            <?php }?>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="Modal<?php echo $row_lis['id_pagar'];?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modificar pagamento</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="proc_edt_a_pagar.php">
                                                    <?php if($row_lis['status_pagar'] == 2){echo "<div class='row'><div class='col'>Parabéns! Você já pagou esta conta.</div></div>";}else{?>
                                                    <div class="form-group">
                                                        <label for="origem" class=" form-control-label">Origem </label>
                                                        <select name="origem_pagar" id="origem_pagar"
                                                            class="form-control" required>
                                                            <option value="" selected disabled>Selecione uma conta...
                                                            </option>

                                                            <?php echo $bancos; ?>
                                                        </select>
                                                    </div>

                                                    <?php if(!empty($row_lis['nome_funcionario'])){?>
                                                    <input type="hidden" name="atvfuncion" value="1">
                                                    <div class="alert alert-success" id="exibefuncionario">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="nomefuncionario">Nome do Funcionário</label>
                                                                <input type="text" name="nomefuncionario"
                                                                    class="form-control"
                                                                    value="<?php echo $row_lis['nome_funcionario'];?>">
                                                            </div>
                                                            <div class="col">
                                                                <label for="nomefuncionario">CPF do Funcionário</label>
                                                                <input type="text" name="cpffuncionario"
                                                                    class="form-control"
                                                                    onkeydown="javascript: fMasc( this, mCPF );"
                                                                    maxlength="14"
                                                                    value="<?php echo $row_lis['cpf_funcionario'];?>">
                                                            </div>
                                                            <div class="col">
                                                                <label for="nomefuncionario">Cargo</label>
                                                                <input type="text" name="cargofuncionario"
                                                                    class="form-control"
                                                                    value="<?php echo $row_lis['cargo_funcionario'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 15px">
                                                            <div class="col-12 col-md-6">
                                                                <label>Mês de Referência</label>
                                                                <select class="form-control" name="mesreferencia">
                                                                    <option
                                                                        value="<?php echo $row_lis['mes_referencia'];?>"
                                                                        selected>
                                                                        <?php echo $row_lis['mes_referencia'];?>
                                                                    </option>
                                                                    <?php 
                                                            for($i=1; $i<=12; $i++){
                                                                echo "<option value='".$i."'>".$i."</option>";
                                                            }
                                                        ?>

                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <label>Ano de Referência</label>
                                                                <select class="form-control" name="anoreferencia">
                                                                    <option
                                                                        value="<?php echo $row_lis['ano_referencia'];?>"
                                                                        selected>
                                                                        <?php echo $row_lis['ano_referencia'];?>
                                                                    </option>
                                                                    <?php 
                                                            $anoseguinte = date('Y')+1;
                                                            for($i=2000; $i<=$anoseguinte; $i++){
                                                                echo "<option value='".$i."'>".$i."</option>";
                                                            }
                                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <label>Data de Pagamento</label>
                                                                <input type="date" name="datapagamento"
                                                                    class="form-control"
                                                                    value="<?php echo $row_lis['data_pagar'];?>">
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="status"
                                                                        class="form-control-label">Status</label>
                                                                    <select name="status_pagar2" class="form-control">
                                                                        <option value="2" selected>Pago</option>
                                                                        <option value="1">Pendente</option>
                                                                    </select>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px">
                                                            <div class="col">
                                                                <h3>Detalhes financeiros <button
                                                                        class="badge badge-primary" id="addvencimento-<?php echo $row_lis['id_pagar'];?>"
                                                                        type="button" onclick="addvencimento(this)">+ Vencimentos</button></h3>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Descrição</label>
                                                                <input type="text" disabled class="form-control"
                                                                    value="SALÁRIO">
                                                            </div>

                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="valor_pagar"
                                                                        class=" form-control-label">Valor do
                                                                        Salário</label>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">R$</div>
                                                                        </div>
                                                                        <input type="text" name="valor_salario"
                                                                            onKeyPress="return(moeda(this,'.',',',event))"
                                                                            id="valor_salario" class="form-control"
                                                                            value="<?php echo number_format($row_lis['valor_pagar'],2,',','.');?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="valor_pagar"
                                                                        class=" form-control-label">Descontos</label>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">R$</div>
                                                                        </div>
                                                                        <input type="text" name="descontos_salario"
                                                                            onKeyPress="return(moeda(this,'.',',',event))"
                                                                            id="descontos_salario" class="form-control"
                                                                            value="<?php echo number_format($row_lis['descontos_salario'],2,',','.');?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <label>Referência</label>
                                                                <input type="text" name="referenciasalario"
                                                                    class="form-control" placeholder="Ex.: 30 dias"
                                                                    value="<?php echo $row_lis['referencia_salario'];?>">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <?php 
                                                $idpagar = $row_lis['cod_pagar'];
                                                $qrvc = "SELECT * FROM rfa_pagar_venc WHERE clube='$clube' AND ref_pagar='$idpagar'";
                                                $lisvc = mysqli_query($link, $qrvc) or die(mysqli_error($link));
                                                while($row_lisvc = mysqli_fetch_array($lisvc)){
                                            ?>
                                                            <input type="hidden" name="idvenc[]" value="<?php echo $row_lisvc['id_venc'];?>">
                                                            
                                                            <input type="hidden" name="excluir_venc[]" id="excluirvenc-<?php echo $row_lisvc['id_venc'];?>" value="0">
                                                            
                                                            <div class="row" id="vencimento-<?php echo $row_lisvc['id_venc'];?>">
                                                                <div class="col"><label>Descrição <button class="badge badge-danger" type="button" id="bt-<?php echo $row_lisvc['id_venc'];?>" onclick="excluirVenc(this)">X</button></label><input
                                                                        type="text" class="form-control"
                                                                        name="descricao_vencimento[]"
                                                                        placeholder="Ex.: SALÁRIO FAMÍLIA" value="<?php echo $row_lisvc['descricao_venc'];?>"></div>
                                                                <div class="col">
                                                                    <div class="form-group"><label for="valor_pagar"
                                                                            class=" form-control-label">Valor</label>
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">R$</div>
                                                                            </div><input type="text"
                                                                                name="valor_vencimento[]"
                                                                                onKeyPress="return(moeda(this,\'.\',\',\',event))"
                                                                                id="valor_vencimento"
                                                                                class="form-control" value="<?php echo number_format($row_lisvc['valor_venc'],2,',','.');?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group"><label for="valor_pagar"
                                                                            class=" form-control-label">Descontos</label>
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">R$</div>
                                                                            </div><input type="text"
                                                                                name="descontos_vencimento[]"
                                                                                onKeyPress="return(moeda(this,\'.\',\',\',event))"
                                                                                id="descontos_vencimento"
                                                                                class="form-control" value="<?php echo number_format($row_lisvc['descontos_venc'],2,',','.');?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col"><label>Referência</label><input
                                                                        type="text" name="referencia_vencimento[]"
                                                                        class="form-control" placeholder="Ex.: 30 dias" value="<?php echo $row_lisvc['referencia_venc'];?>">
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        </div>
                                                        <div id="vencimentos-<?php echo $row_lis['id_pagar'];?>"></div>
                                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px">
                                                            <div class="col">
                                                                <h3>Contribuições</h3>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="valor_pagar"
                                                                        class=" form-control-label">Sal. Contr.
                                                                        INSS</label>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">R$</div>
                                                                        </div>
                                                                        <input type="text" name="contrinss"
                                                                            onKeyPress="return(moeda(this,'.',',',event))"
                                                                            id="contr_inss" class="form-control"
                                                                            value="<?php echo number_format($row_lis['contr_inss'],2,',','.');?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="valor_pagar"
                                                                        class=" form-control-label">Base Cálc.
                                                                        FGTS</label>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">R$</div>
                                                                        </div>
                                                                        <input type="text" name="basefgts"
                                                                            onKeyPress="return(moeda(this,'.',',',event))"
                                                                            id="base_fgts" class="form-control"
                                                                            value="<?php echo number_format($row_lis['base_fgts'],2,',','.');?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="valor_pagar"
                                                                        class=" form-control-label">FGTS do Mês</label>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">R$</div>
                                                                        </div>
                                                                        <input type="text" name="fgts_mes"
                                                                            onKeyPress="return(moeda(this,'.',',',event))"
                                                                            id="fgts_mes" class="form-control"
                                                                            value="<?php echo number_format($row_lis['fgts_mes'],2,',','.');?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="valor_pagar"
                                                                        class=" form-control-label">Base Cálc.
                                                                        IRRF</label>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">R$</div>
                                                                        </div>
                                                                        <input type="text" name="base_irrf"
                                                                            onKeyPress="return(moeda(this,'.',',',event))"
                                                                            id="base_irrf" class="form-control"
                                                                            value="<?php echo number_format($row_lis['base_irrf'],2,',','.');?>">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col">

                                                                <label for="valor_pagar"
                                                                    class=" form-control-label">Faixa IRRF</label>

                                                                <input type="text" name="faixa_irrf" id="faixa_irrf"
                                                                    class="form-control"
                                                                    value="<?php echo $row_lis['faixa_irrf'];?>">



                                                            </div>
                                                        </div>



                                                    </div>
                                                    <?php } ?>

                                                    <?php if(empty($row_lis['nome_funcionario'])){?>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="descricao_pagar"
                                                                    class=" form-control-label">Descrição</label>
                                                                <input type="text" name="descricao_pagar"
                                                                    id="descricao_pagar"
                                                                    value="<?php echo $row_lis['descricao_pagar'];?>"
                                                                    placeholder="Ex.: Conta de Luz" class="form-control"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="data_pagar"
                                                                    class=" form-control-label">Vencimento</label>
                                                                <input type="date" name="data_pagar" id="data_pagar"
                                                                    value="<?php echo $row_lis['data_pagar'];?>"
                                                                    class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">

                                                        <div class="col">
                                                            <div class="form-group exibetipopessoapf">
                                                                <label for="status"
                                                                    class="form-control-label">Status</label>
                                                                <select name="status_pagar" class="form-control">

                                                                    <option value="2" selected>Pago</option>
                                                                    
                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="valor_pagar"
                                                                    class=" form-control-label">Valor</label>
                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">R$</div>
                                                                    </div>
                                                                    <input type="text" name="valor_pagar"
                                                                        onKeyPress="return(moeda(this,'.',',',event))"
                                                                        id="valor_pagar"
                                                                        value="<?php echo number_format($row_lis['valor_pagar'],2,',','.');?>"
                                                                        class="form-control" required
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Este valor será debitado da conta de origem escolhida.">
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <?php }} ?>
                                                    <input type="hidden" name="por" value="<?= $_SESSION['nome'] ?>">
                                                    <input type="hidden" name="user"
                                                        value="<?= $_SESSION['id_usuario'] ?>">
                                                    <input type="hidden" name="club"
                                                        value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
                                                    <input type="hidden" name="idpagar"
                                                        value="<?php echo $row_lis['id_pagar']; ?>">
                                                        <input type="hidden" name="codpagar"
                                                        value="<?php echo $row_lis['cod_pagar']; ?>">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Fechar</button>
                                                <?php if($row_lis['status_pagar'] == 2){}else{echo "<button type='submit' class='btn btn-primary'>Continuar...</button>";} ?>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <tr class="spacer"></tr>

                                <?php }?>

                            </tbody>
                        </table>
                    </div>

                    <?php } ?>
                    <!-- END DATA TABLE -->
                </div>
            </div>

            <script>
                function excluirVenc(elem) {
                var botao = document.getElementById(elem.id).id;
                var res = botao.split("-");
                var rs = res[1];
                document.getElementById("vencimento-" + rs).style.display = "none";
                document.getElementById("excluirvenc-" + rs).value = "1";
            }
            </script>

            <script>
                function addvencimento(elem) {
                    var botao = document.getElementById(elem.id).id;
                    var res = botao.split("-");
                    var rs = res[1];
                    var i = Math.round(Math.random() * 550 / 5) * 5 + 5;

                        $('#vencimentos-'+rs).append('<div class="row" id="row'+i+'-'+rs+'"><div class="col"><label>Descrição<button class="badge badge-danger btn_remove" id="'+i+'-'+rs+'" type="button">X</button></label><input type="text" class="form-control" name="descricao_vencimento2[]" placeholder="Ex.: SALÁRIO FAMÍLIA"></div><div class="col"><div class="form-group"><label for="valor_pagar" class=" form-control-label">Valor</label><div class="input-group mb-2"><div class="input-group-prepend"><div class="input-group-text">R$</div></div><input type="text" name="valor_vencimento2[]" onKeyPress="return(moeda(this,\'.\',\',\',event))" id="valor_vencimento" class="form-control" required></div></div></div><div class="col"><div class="form-group"><label for="valor_pagar" class=" form-control-label">Descontos</label><div class="input-group mb-2"><div class="input-group-prepend"><div class="input-group-text">R$</div></div><input type="text" name="descontos_vencimento2[]" onKeyPress="return(moeda(this,\'.\',\',\',event))" id="descontos_vencimento" class="form-control" required></div></div></div><div class="col"><label>Referência</label><input type="text" name="referencia_vencimento2[]" class="form-control" placeholder="Ex.: 30 dias"></div></div>'
                            );

                    


                    $(document).on('click', '.btn_remove', function () {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    });



                };
            </script>

            <?php include("footer.php"); ?>


            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->