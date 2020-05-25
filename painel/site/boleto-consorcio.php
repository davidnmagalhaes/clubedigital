<?php 

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}
include_once("../config.php");
		
include('verificacao.php');
$idconsorcio = $_GET['idconsorcio'];
$idsocio = $_GET['idsocio'];

$metodopagamento = mysqli_real_escape_string($link,$_GET['metodopagamento']);

$protocolo = mysqli_real_escape_string($link,$_GET['protocolo']);
$data = mysqli_real_escape_string($link,$_GET['data']);
$hora = mysqli_real_escape_string($link,$_GET['hora']);
$mesvenc = mysqli_real_escape_string($link,$_GET['mesvenc']);
$anovenc = mysqli_real_escape_string($link,$_GET['anovenc']);

$qcmp = "SELECT * FROM rfa_consorcio WHERE clube='$clube' AND cod_consorcio='$idconsorcio'";
$cmp = mysqli_query($link, $qcmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_array($cmp);

$qclb = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$clb = mysqli_query($link, $qclb) or die(mysqli_error($link));
$row_clb = mysqli_fetch_array($clb);

$taxapaghiper = $row_clb['paghiper_taxa'];

$valorcampanha = $row_cmp['valor_consorcio'];

$qcmb = "SELECT * FROM rfa_config_cambio WHERE id_cambio='1'";
$cmb = mysqli_query($link, $qcmb) or die(mysqli_error($link));
$row_cmb = mysqli_fetch_array($cmb);

$cambio = $row_cmb['valor_cambio'];
$taxa = $taxapaghiper;
$total = ($valorcampanha * $cambio) + $taxa;

$qsc = "SELECT * FROM rfs_socios WHERE clube='$clube' AND id_socio='$idsocio'";
$sc = mysqli_query($link, $qsc) or die(mysqli_error($link));
$row_sc = mysqli_fetch_array($sc);

$nome = $row_sc['nome_socio'];
$email = $row_sc['email_socio'];
$telefone = $row_sc['telefone_socio'];
$cpf = $row_sc['cpf_socio'];

?>
	

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PagHiper - Último passo para gerar o boleto bancário</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
        <link rel="shortcut icon" href="https://www.paghiper.com/img/icon/ico.gif" />
        <link rel="stylesheet" href="https://www.paghiper.com/css/checkout.css" />
        <script src="https://www.paghiper.com/js/jquery-1.11.2.min.js"></script>
        <script src="https://www.paghiper.com/js/jquery-mask.js"></script>
        <script src="https://www.paghiper.com/js/config.js"></script>
        <script>
            //SCRIPT RESPONSÁVEL POR EXIBIR OU OCULTAR A PESSOA FISICA OU JURIDICA
            var Main = function(){
                var self = this;
                
                this.verificaPessoa = function(value){
                    if(value == 'pf'){
                        $('.pj').hide();
                        $('.pf').show();
                        $('.cpf').attr('required', 'required');
                        $('.cnpj').removeAttr('required');
                        $('.rsocial').removeAttr('required');
                    } else {
                        $('.pj').show();
                        $('.pf').hide();
                        $('.cpf').removeAttr('required');
                        $('.cnpj').attr('required', 'required');
                        $('.rsocial').attr('required', 'required');
                    }
                };
                
            };            
            var ctrl = new Main();
            
            $(function(){
                ctrl.verificaPessoa('pf');
            });
        </script>
		<script language="javascript">    
         document.onkeydown = function () { 
           switch (event.keyCode) {
             case 116 :  
                event.returnValue = false;
                event.keyCode = 0;           
                return false;             
              case 82 : 
                if (event.ctrlKey) {  
                   event.returnValue = false;
                  event.keyCode = 0;             
                  return false;
           }
         }
     } 
     </script>
    </head>
    <body>
        <div id="header">
            <div class="page">
                <img src="https://www.paghiper.com/img/logo.gif" alt="PagHiper - Forma facil e segura de comprar na Internet" border="0"/>
                <dl>
                    <dt></dt>
                    <dd></dd>
                </dl>
            </div>
        </div>
        <div class="page">
            <br />
            <h1 style="margin-bottom: -5px;">Finalizar Doação <?php echo $protocolo?></h1>
            <hr />
            <br />
            <br />
            <fieldset>
                <legend>Forma de Pagamento</legend>
                <div>
                    <div class="col col-1 vertical-align-middle" style="padding: 15px">
                        <img src="https://www.paghiper.com/img/icon/boleto-bancario-ico-gray.jpg" alt="Boleto Bancário" />
                    </div>
                    <div class="col col-8 vertical-align-middle" >
                        <h3 style="margin:0 0 5px 0;">Boleto Bancário</h3>
                        <p style="margin: 0">
                            Seu pagamento será processado pelo PagHiper!<br> <strong>Base de Câmbio:</strong> R$ <?php echo number_format($cambio,2,',','.'); ?>  <strong></strong>.
                        </p>
                    </div>
                </div>
            </fieldset>
            <br />
            <br />
            <br />
            
            <fieldset>
                <legend>Resumo de Doação</legend>
            <!--
                * INICIO DA TABELA ONDE APRESENTA A LISTAGEM DE PRODUTOS
            -->
			<form method="post" action="paghiper-consorcio.php">
            <input type="hidden" name="clube" id="clube" value="<?php echo $clube;?>">
            <input type="hidden" name="idconsorcio" id="idconsorcio" value="<?php echo $idconsorcio;?>">
            <input type="hidden" name="idsocio" id="idsocio" value="<?php echo $idsocio;?>">
			<input type="hidden" name="totalboleto" id="totalboleto" value="<?php echo $total;?>">
            <input type="hidden" name="metodopagamento" id="metodopagamento" value="<?php echo $metodopagamento;?>">
            <input type="hidden" name="protocolo" id="protocolo" value="<?php echo $protocolo;?>">
            <input type="hidden" name="data" id="data" value="<?php echo $data;?>">
            <input type="hidden" name="hora" id="hora" value="<?php echo $hora;?>">
            <input type="hidden" name="mesvenc" id="mesvenc" value="<?php echo $mesvenc;?>">
            <input type="hidden" name="anovenc" id="anovenc" value="<?php echo $anovenc;?>">

            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" width="100%" class="table">
                    <thead>
                        <tr>
                            <th width="55%" align="left">Doação</th>
                            <th width="5%" align="left"></th>
                            <th >Valor</th>
                            
                        </tr>
                    </thead>
                                        
                    <tbody>
                        <!-- AQUI SERÁ ONDE DEVERÁ LISTAR OS PRODUTOS -->
						
                        <tr>
                                <td>Doação em Valor Convertido</td>
                                <td></td>
                                <td align="center">R$ <?php echo number_format(($total-$taxa),2,',','.'); ?></td>
                                
                        </tr>   
                        <tr>
                                <td>Taxa Boleto</td>
                                <td></td>
                                <td align="center">R$ <?php echo number_format($taxa,2,',','.'); ?></td>
                                
                        </tr>  
							
    
                         
							
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" align="right">
                                <!-- AQUI DEVERÁ APRESENTAR O TOTAL DA COMPRA -->
                                <table width="100%">
                                    
                                    
                                 
                                    
                                    <tr class="table-total">
                                        <td>Total:</td>
                                        <td align="right">R$ <?php echo number_format($total,2,',','.'); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tfoot>
                    
                                        
                </table>
            </div>
            </fieldset>
            <div>
                <br />
                <br />
                <br />
                
                <fieldset>
                    <legend>Identificação para finalizar a compra</legend>
                    
                    <div>
                        <div class="col col-5">
                            <label><strong>Nome </strong><span class="tx-red">*</span></label>
                            <div>
                                <input type="text" placeholder="Informe seu nome" readonly name="nome" value="<?php echo $nome;?>" class="ipt col-9" required/>
                            </div>
                        </div>
                        <div class="col col-5 pf">
                            <label><strong>CPF </strong><span class="tx-red">*</span></label>
                            <div>
                                <input type="text" name="cpf" placeholder="Informe seu CPF" class="ipt col-9 cpf" value="<?php echo $cpf;?>" required/>
                            </div>
                        </div>
                       
                    </div>
                    
                    <br />
                    <div>
                        <div class="col col-5">
                            <label><strong>E-mail </strong><span class="tx-red">*</span></label>
                            <div>
                                <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Informe seu E-mail" class="ipt col-9" required/>
                            </div>
                        </div>
                        <div class="col col-5">
                            <label><strong>Telefone </strong><span class="tx-red">*</span></label>
                            <div>
                                <input type="text" name="telefone" placeholder="Informe seu telefone" class="ipt col-9 telefone" value="<?php echo $telefone; ?>" required />
                            </div>
                        </div>
                    </div>
					<div>
                        
                        
                    </div>
                    <div class="grid-btn-pagamento text-right">
                        <input type="submit" value="Gerar Boleto!" />
                    </div>
                </fieldset>
                </form>
            </div>
        </div>
        
        <div id="rodape">
            <div class="page">
                <p>Todos os direitos reservados a PagHiper Serviços Online - CNPJ: 20.110.153-0001/07 | © <?php echo date('Y');?></p>
            </div>
        </div>
    </body>
</html>
