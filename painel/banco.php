<?php
$page = 3;

include('config-header.php');

//Seleciona todas as contas bancárias
$sql = "SELECT * FROM rfa_bancos INNER JOIN rfa_lista_bancos ON rfa_bancos.banco = rfa_lista_bancos.cod_lista_banco INNER JOIN rfa_lista_tipo_banco ON rfa_bancos.tipo_conta = rfa_lista_tipo_banco.cod_lista_tipo_banco WHERE rfa_bancos.clube='$clube' AND rfa_bancos.favorecido <> 'Caixa' ORDER BY rfa_bancos.conta_mensalidade DESC, rfa_bancos.favorecido ASC";
$listabancos = mysqli_query($link, $sql) or die(mysqli_error($link));
$totalRows_listabancos = mysqli_num_rows($listabancos);

//Seleciona o caixa
$scx = "SELECT * FROM rfa_bancos WHERE favorecido='Caixa' AND clube='$clube'";
$listacx = mysqli_query($link, $scx) or die(mysqli_error($link));
$totalRows_listacx = mysqli_num_rows($listacx);





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

    <script type="text/javascript">
            function fMasc(objeto,mascara) {
                obj=objeto
                masc=mascara
                setTimeout("fMascEx()",1)
            }
            function fMascEx() {
                obj.value=masc(obj.value)
            }
            function mTel(tel) {
                tel=tel.replace(/\D/g,"")
                tel=tel.replace(/^(\d)/,"($1")
                tel=tel.replace(/(.{3})(\d)/,"$1)$2")
                if(tel.length == 9) {
                    tel=tel.replace(/(.{1})$/,"-$1")
                } else if (tel.length == 10) {
                    tel=tel.replace(/(.{2})$/,"-$1")
                } else if (tel.length == 11) {
                    tel=tel.replace(/(.{3})$/,"-$1")
                } else if (tel.length == 12) {
                    tel=tel.replace(/(.{4})$/,"-$1")
                } else if (tel.length > 12) {
                    tel=tel.replace(/(.{4})$/,"-$1")
                }
                return tel;
            }
            function mCNPJ(cnpj){
                cnpj=cnpj.replace(/\D/g,"")
                cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
                cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
                cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
                cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
                return cnpj
            }
            function mCPF(cpf){
                cpf=cpf.replace(/\D/g,"")
                cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
                cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
                cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
                return cpf
            }
            function mCEP(cep){
                cep=cep.replace(/\D/g,"")
                cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
                cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
                return cep
            }
            function mNum(num){
                num=num.replace(/\D/g,"")
                return num
            }
            
            
            
            
        </script>

<!--Mask Money-->
<script language="javascript">   
function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
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

 <script>
function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        // charCode 8 = backspace   
        // charCode 9 = tab
        if (charCode != 8 && charCode != 9) {
            // charCode 48 equivale a 0   
            // charCode 57 equivale a 9
            if (charCode < 48 || charCode > 57) {
                return false;
            }
        }
    }
</script>

</head>

<body class="animsition">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->

            
 <div class="main-content">
            <div class="col-lg-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-balance-wallet"></i>Contas 
										<a class="btn btn-success" href="cd_banco.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" role="button">Adicionar</a></h3>
                                    <!--<div class="filters m-b-45">
                                        <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">Todos</option>
                                                <option value="">Itaú</option>
                                                <option value="">Bradesco</option>
												<option value="">Banco do Brasil</option>
												<option value="">Santander</option>
												<option value="">Caixa</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                            <select class="js-select2 au-select-dark" name="time">
                                                <option selected="selected">Todos</option>
                                                <option value="">Corrente</option>
                                                <option value="">Poupança</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>-->

                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <!--<td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>-->
													<td>Cadastro</td>
                                                    <td>Conta</td>
													
													<td>Saldo Atual</td>
                                                    <td>Banco</td>
													<td>Tipo</td>
                                                    <td></td>
													<td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php while($row_listacx = mysqli_fetch_array($listacx)){ ?>
                                                <tr>
                                                    <!--<td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>-->
													<td>
														<div class="table-data__info">
                                                            <h6><?php echo date('d/m/Y',strtotime($row_listacx['data_cadastro']));?></h6>
                                                           <i class="zmdi zmdi-balance-wallet" style="color:#5eac24"></i> <strong>CAIXA DO CLUBE</strong>
                                                        </div>
													</td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <span><?php echo $row_listacx['favorecido'];?></span>
                                                            
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="table-data__info">
                                                            <h6>Saldo atual</h6>
                                                            <span>
                                                                <strong>
                                                                    <?php 
                                                                            $orgbnccx = $row_listacx['cod_banco'];
                                                                            $saldcx = $row_listacx['saldo'];
                                                                            $mhjcx = date('m');
                                                                            $ahjcx = date('Y');
                                                                            $dtjcx = date('Y-m-d');
                                                                            $spgcx = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND data_pagar <= '$dtjcx' AND status_pagar=2 AND origem_pagar='$orgbnccx'";
                                                                            $pgcx = mysqli_query($link, $spgcx) or die(mysqli_error($link));
                                                                            $row_pgcx = mysqli_fetch_array($pgcx);

                                                                            //////////////////////////////////// Mensalidades em Dinheiro ///////////////////////////////////////////
                                                                            $smsdin = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND data_pagamento <= '$dtjcx' AND tipo_pagamento=2";
                                                                            $msdin = mysqli_query($link, $smsdin) or die(mysqli_error($link));
                                                                            $row_msdin = mysqli_fetch_array($msdin);
                                                                            
                                                                            //////////////////////////////////// Receitas Pagas no Geral ///////////////////////////////////////////
                                                                            $srccx = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND data_receita <= '$dtjcx' AND status_receita=2 AND destino_receita='$orgbnccx'";
                                                                            $rccx = mysqli_query($link, $srccx) or die(mysqli_error($link));
                                                                            $row_rccx = mysqli_fetch_array($rccx);

                                                                            
                                                                            $ttgcx = $saldcx + (($row_rccx['valor']+$row_msdin['valor']) - ($row_pgcx['valor']));
                                                                             
                                                                    ?>




                                                                    R$ <?php echo number_format($ttgcx, 2, ',', '.');?></strong>

                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span><img src="images/wallet.png" width="70"/></span>
                                                    </td>
                                                    <td>
                                                        <span>Caixa</span>
                                                    </td>
                                                    
													<td>
                                                       <a href="#" data-toggle="modal" data-target="#editarbanco<?php echo $row_listacx['cod_banco'];?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                    </td>
													<td>
                                                       <!--<a href="excluir-conta.php?id_conta=<?php //echo $row_listabancos['id_conta'];?>">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>-->
                                                    </td>
                                                </tr>
												
												<div class="modal fade" id="editarbanco<?php echo $row_listacx['cod_banco'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">
													  <div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Editar <?php echo $row_listacx['favorecido'];?></h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
														  <span aria-hidden="true">&times;</span>
														</button>
													  </div>
													  <div class="modal-body">
													  <div class="alert alert-danger" role="alert">
                                                        <strong>Atenção!</strong> Este é o saldo inicial, ao realizar uma alteração você estará ciente de que este valor influenciará nos saldos finais. Tenha certeza antes de mudar.
                                                    </div>
													  <!--Formulário de edição da conta bancária-->
														<form method="post" action="proc_edt_banco.php">
														
														<input type="hidden" name="id_conta" value="<?php echo $row_listacx['cod_banco'];?>">
														<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
														
														<input type="hidden" name="favorecido" id="favorecido" placeholder="Digite o nome do favorecido da conta" class="form-control" value="<?php echo $row_listacx['favorecido'];?>" required>

										
                                        <div class="row form-group">
                                            
                                           
											<div class="col">
                                                <div class="form-group">
                                                    <label for="saldo" class=" form-control-label">Saldo</label>
													<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">R$</div>
													</div>
													<input type="text" name="saldo" id="saldo" onKeyPress="return(moeda(this,'.',',',event))" placeholder="Ex.: 1000.00 (Sem unidade monetária)" class="form-control" value="<?php echo number_format($row_listacx['saldo'], 2, ',', '.');?>" required data-toggle="tooltip" data-placement="top" title="Este saldo será somado ao caixa, receitas e contas a receber.">
													</div>
                                                    
                                                </div>
												
                                            </div>
                                        </div>
										
														
													  </div>
													  <div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
														<button type="submit" class="btn btn-primary">Atualizar</button>
													  </div>
													  </form>
													</div>
												  </div>
												</div>
											<?php } ?>
										
						
										
											<?php while($row_listabancos = mysqli_fetch_array($listabancos)){?>
                                                <tr>
                                                    <!--<td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>-->
													<td>
														<div class="table-data__info">
                                                            <h6><?php echo date('d/m/Y',strtotime($row_listabancos['data_cadastro']));?></h6>
                                                           <?php if($row_listabancos['conta_mensalidade'] == 1){echo "<strong><i class='zmdi zmdi-bookmark' style='color:#ff4b5a'></i> CONTA PRINCIPAL</strong>";}else{}?>
                                                        </div>
													</td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?php echo $row_listabancos['favorecido'];?></h6>
                                                            <span>
                                                                <a href="#"><strong>Ag.:</strong> <?php echo $row_listabancos['agencia'];?> | <strong>Conta:</strong> <?php echo $row_listabancos['n_conta'];?>
																<br><strong><?php if($row_listabancos['cnpj'] == 0){echo "CPF";}else{echo "CNPJ";};?>.:</strong> <?php if($row_listabancos['cnpj'] == 0){echo $row_listabancos['cpf'];}else{echo $row_listabancos['cnpj'];};?></a>
																
																
                                                            </span>
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="table-data__info">
                                                            <h6>Saldo atual</h6>
                                                            <span>
                                                                <strong>
                                                                    <?php 
                                                                        $orgbnc = $row_listabancos['cod_banco'];
                                                                        $cntmens = $row_listabancos['conta_mensalidade'];
                                                                        $saldmes = $row_listabancos['saldo'];
                                                                        $mhj = date('m');
                                                                        $ahj = date('Y');
                                                                        $dthj = date('Y-m-d');
                                                                        $spg = "SELECT SUM(valor_pagar) as valor FROM rfa_pagar WHERE clube='$clube' AND status_pagar=2 AND origem_pagar='$orgbnc'";
                                                                            $pg = mysqli_query($link, $spg) or die(mysqli_error($link));
                                                                            $row_pg = mysqli_fetch_array($pg);
                                                                            //////////////////////////////////// Mensalidades Pagas no Geral ///////////////////////////////////////////
                                                                            $sms = "SELECT SUM(valor_mensalidade) as valor FROM rfa_mensalidades WHERE clube='$clube' AND  pagamento=1 AND (tipo_pagamento=1 OR tipo_pagamento=3 OR tipo_pagamento=4 OR tipo_pagamento IS NULL)";
                                                                            $ms = mysqli_query($link, $sms) or die(mysqli_error($link));
                                                                            $row_ms = mysqli_fetch_array($ms);

                                                                            $srt = "SELECT SUM(valor_retirada) as valor FROM rfa_retirada WHERE clube='$clube' AND origem_retirada='$orgbnc'";
                                                                            $rt = mysqli_query($link, $srt) or die(mysqli_error($link));
                                                                            $row_rt = mysqli_fetch_array($rt);

                                                                            //////////////////////////////////// Taxas no Geral ///////////////////////////////////////////
                                                                            $smstx = "SELECT SUM(taxa) as valor FROM rfa_mensalidades WHERE clube='$clube' AND  pagamento=1 AND (tipo_pagamento=1 OR tipo_pagamento=3 OR tipo_pagamento=4 OR tipo_pagamento IS NULL)";
                                                                            $mstx = mysqli_query($link, $smstx) or die(mysqli_error($link));
                                                                            $row_mstx = mysqli_fetch_array($mstx);


                                                                            $scmpg = "SELECT rfa_campanhas.valor_campanha as valor, SUM(rfa_campanhas_pedidos.quantidade_pedido) as quantidade FROM rfa_campanhas_pedidos INNER JOIN rfa_campanhas ON rfa_campanhas_pedidos.cod_campanha=rfa_campanhas.cod_campanha WHERE rfa_campanhas_pedidos.tipodoacao_pedido='valor' AND rfa_campanhas_pedidos.status_pedido='1' AND (rfa_campanhas_pedidos.metodopgto_pedido='boleto' OR rfa_campanhas_pedidos.metodopgto_pedido='pagseguro') AND rfa_campanhas_pedidos.clube='$clube'";
                                                                            $cmpg = mysqli_query($link, $scmpg) or die(mysqli_error($link));
                                                                            $row_cmpg = mysqli_fetch_assoc($cmpg);
                                                                            $totalcampanhasg = ($row_cmpg['valor'] * $row_cmpg['quantidade']);

                                                                            $scmptxg = "SELECT * FROM rfa_campanhas_pedidos WHERE tipodoacao_pedido='valor' AND status_pedido='1' AND metodopgto_pedido='boleto' AND clube='$clube'";
                                                                            $cmptxg = mysqli_query($link, $scmptxg) or die(mysqli_error($link));
                                                                            $row_cmptxg = mysqli_fetch_assoc($cmptxg);
                                                                            $totalrow_cmptxg = mysqli_num_rows($cmptxg);

                                                                            $taxabolcampg = $totalrow_cmptxg * 2.49;

                                                                            //////////////////////////////////// Receitas Pagas no Geral ///////////////////////////////////////////
                                                                            $src = "SELECT SUM(valor_receita) as valor FROM rfa_receitas WHERE clube='$clube' AND  status_receita=2 AND destino_receita='$orgbnc'";
                                                                            $rc = mysqli_query($link, $src) or die(mysqli_error($link));
                                                                            $row_rc = mysqli_fetch_array($rc);

                                                                            if($cntmens == 1){
                                                                            $ttg = ($totalcampanhasg + $row_ms['valor'] + $row_rc['valor'] + $saldmes) - ($taxabolcampg + $row_pg['valor'] + $row_mstx['valor'] + $row_rt['valor']);
                                                                             }else{
                                                                            $ttg = $saldmes + ($row_rc['valor'] - ($row_pg['valor'] + $row_mstx['valor'] + $row_rt['valor']));
                                                                             }
                                                                    ?>




                                                                    R$ <?php echo number_format($ttg, 2, ',', '.');?></strong>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span><img src="<?php echo $row_listabancos['imagem_lista_banco'];?>" width="70"/></span>
                                                    </td>
                                                    <td>
                                                        <span><?php echo $row_listabancos['nome_lista_tipo'];?></span>
                                                    </td>
                                                    
													<td>
                                                       <a href="#" data-toggle="modal" data-target="#editarbanco<?php echo $row_listabancos['cod_banco'];?>">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                    </td>
													<td>
                                                       <a href="excluir-conta.php?id_conta=<?php echo $row_listabancos['cod_banco'];?>&clube=<?php echo $clube;?>">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </td>
                                                </tr>
												
												<div class="modal fade" id="editarbanco<?php echo $row_listabancos['cod_banco'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">
													  <div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Editar conta de <?php echo $row_listabancos['favorecido'];?></h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
														  <span aria-hidden="true">&times;</span>
														</button>
													  </div>
													  <div class="modal-body">
													  
													  <!--Formulário de edição da conta bancária-->
														<form method="post" action="proc_edt_banco.php">
														
														<input type="hidden" name="id_conta" value="<?php echo $row_listabancos['cod_banco'];?>">
														<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
														
														  <div class="form-group">
										
										
                                            <label for="favorecido" class=" form-control-label">Favorecido</label>
                                            <input type="text" name="favorecido" id="favorecido" placeholder="Digite o nome do favorecido da conta" class="form-control" value="<?php echo $row_listabancos['favorecido'];?>" required>
                                        </div>
										<div class="row">
										<div class="col">
											<div class="form-group">
												<label for="agencia" class=" form-control-label">Agência</label>
												<input type="text" name="agencia" id="agencia" placeholder="Ex.: 8470 (Somente números)" class="form-control" value="<?php echo $row_listabancos['agencia'];?>" onkeypress="return somenteNumeros(event)" required>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label for="n_conta" class=" form-control-label">Nº da Conta</label>
												<input type="text" name="n_conta" id="n_conta" placeholder="Ex.: 77778 (Somente números)" class="form-control" value="<?php echo $row_listabancos['n_conta'];?>" onkeypress="return somenteNumeros(event)" required>
											</div>
										</div>
										</div>
                                        <div class="row form-group">
                                            
                                            <div class="col">
                                                
												<div class="form-group " >
                                                    <label for="cnpj" class=" form-control-label">CNPJ</label>
                                                    <input type="text" id="cnpj" name="cnpj" placeholder="Ex.: 19.829.198/0001-01" class="form-control" maxlength="18" onkeydown="javascript: fMasc( this, mCNPJ );" value="<?php echo $row_listabancos['cnpj'];?>">
                                                </div>
                                            </div>
											<div class="col">
                                                <div class="form-group">
                                                    <label for="saldo" class=" form-control-label">Saldo</label>
													<div class="input-group mb-2">
													<div class="input-group-prepend">
													  <div class="input-group-text">R$</div>
													</div>
													<input type="text" name="saldo" id="saldo" onKeyPress="return(moeda(this,'.',',',event))" placeholder="Ex.: 1000.00 (Sem unidade monetária)" class="form-control" value="<?php echo number_format($row_listabancos['saldo'], 2, ',', '.');?>" required data-toggle="tooltip" data-placement="top" title="Este saldo será somado ao caixa, receitas e contas a receber.">
													</div>
                                                    
                                                </div>
												
                                            </div>
                                        </div>
										
										<div class="row form-group">
                                            
                                            
											<div class="col">
                                                <div class="form-group">
                                                    <label for="banco" class=" form-control-label">Banco </label>
                                                    <select name="banco" id="banco" class="form-control" required>
                                                        <option value="" disabled selected>Selecione um banco...</option>
                                                        
														<?php 
                                                            $cdbank = $row_listabancos['banco'];
                                                            $querybc = "SELECT * FROM rfa_lista_bancos WHERE clube='$clube'";
                                                            $listabc = mysqli_query($link, $querybc) or die(mysqli_error($link));
                                                            $row_listabc = mysqli_fetch_assoc($listabc);

                                                            while($row_listabc = mysqli_fetch_array($listabc)){
                                                            if($row_listabc['cod_lista_banco'] == $cdbank){
                                                                echo "<option value='".$row_listabc['cod_lista_banco']."' selected>".$row_listabc['nome_lista_banco']."</option>";
                                                            }
                                                            if($row_listabc['cod_lista_banco'] != $cdbank){
                                                                echo "<option value='".$row_listabc['cod_lista_banco']."'>".$row_listabc['nome_lista_banco']."</option>";
                                                            }
                                                            }
                                                        ?>

														
                                                    </select>
                                                </div>
                                            </div>
											
										
											
											<div class="col">
                                                <div class="form-group">
                                                    <label for="tipoconta" class=" form-control-label">Tipo de Conta </label>
                                                    <select name="tipoconta" id="tipoconta" class="form-control" required>
                                                        <option value="" disabled selected>Selecione um tipo de conta...</option>
                                                        

                                                        <?php 
                                                            $cdtipo = $row_listabancos['tipo_conta'];
                                                            $querytp = "SELECT * FROM rfa_lista_tipo_banco WHERE clube='$clube'";
                                                            $listatp = mysqli_query($link, $querytp) or die(mysqli_error($link));
                                                            $row_listatp = mysqli_fetch_assoc($listatp);

                                                            while($row_listatp = mysqli_fetch_array($listatp)){
                                                            if($row_listatp['cod_lista_tipo_banco'] == $cdtipo){
                                                                echo "<option value='".$row_listatp['cod_lista_tipo_banco']."' selected>".$row_listatp['nome_lista_tipo']."</option>";
                                                            }
                                                            if($row_listatp['cod_lista_tipo_banco'] != $cdtipo){
                                                                echo "<option value='".$row_listatp['cod_lista_tipo_banco']."'>".$row_listatp['nome_lista_tipo']."</option>";
                                                            }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
												
                                            </div>
                                        </div>
										
										<div class="row">
											<div class="col">
												<div class="alert alert-warning" role="alert" style="padding: 25px 15px">
												  Esta conta será utilizada para receber os saques realizados de <strong>boletos referente a mensalidades</strong>?<Br>
												  <select class="form-control" name="conta-mensalidade" required>
												  <?php if($row_listabancos['conta_mensalidade'] == 1){?>
														<option value="1" selected>Sim, todas as mensalidades serão transferidas para esta conta</option>
														<option value="0">Não, as mensalidades serão transferidas para outra conta</option>
												  <?php }else{?>
														<option value="1" >Sim, todas as mensalidades serão transferidas para esta conta</option>
														<option value="0" selected>Não, as mensalidades serão transferidas para outra conta</option>
												  <?php } ?>
												  </select>
												</div>
											</div>
										</div>
										
														
													  </div>
													  <div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
														<button type="submit" class="btn btn-primary">Atualizar</button>
													  </div>
													  </form>
													</div>
												  </div>
												</div>
											<?php }?>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
					
                                    
                                </div>
                                <!-- END USER DATA-->
                            </div>
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

	<!-- Start Script para trocar tipo de pessoa -->
<script>
		$('input[name="tipopessoa"]').change(function () {
    if ($('input[name="tipopessoa"]:checked').val() === "pj") {
        $('.exibetipopessoapj').show();
		 $('.exibetipopessoapf').hide();
    } else {
        $('.exibetipopessoapj').hide();
		$('.exibetipopessoapf').show();
    }
});
	</script>
	<!-- End Script para trocar tipo de pessoa -->

    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->