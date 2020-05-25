<?php 

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}
include_once("../config.php");
		
include('verificacao.php');
$idcampanha = $_GET['idcampanha'];
$nome = mysqli_real_escape_string($link,$_GET['nome']);
$cpf = mysqli_real_escape_string($link,$_GET['cpf']);
$email = mysqli_real_escape_string($link,$_GET['email']);
$telefone = mysqli_real_escape_string($link,$_GET['telefone']);
$cep = mysqli_real_escape_string($link,$_GET['cep']);
$estado = mysqli_real_escape_string($link,$_GET['estado']);
$endereco = mysqli_real_escape_string($link,$_GET['endereco']);
$numero = mysqli_real_escape_string($link,$_GET['numero']);
$cidade = mysqli_real_escape_string($link,$_GET['cidade']);
$tipodoacao = mysqli_real_escape_string($link,$_GET['tipodoacao']);
$metodopagamento = mysqli_real_escape_string($link,$_GET['metodopagamento']);
$confidencial = mysqli_real_escape_string($link,$_GET['confidencial']);
$quantidade = mysqli_real_escape_string($link,$_GET['quantidade']);

$protocolo = mysqli_real_escape_string($link,$_GET['protocolo']);
$data = mysqli_real_escape_string($link,$_GET['data']);
$hora = mysqli_real_escape_string($link,$_GET['hora']);

$qcmp = "SELECT * FROM rfa_campanhas WHERE clube='$clube' AND cod_campanha='$idcampanha'";
$cmp = mysqli_query($link, $qcmp) or die(mysqli_error($link));
$row_cmp = mysqli_fetch_array($cmp);

$valorcampanha = $quantidade*$row_cmp['valor_campanha'];

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
                            Seu pagamento será processado pelo PagHiper!  <strong></strong>.
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
			<form method="post" action="paghiper.php">
            <input type="hidden" name="clube" id="clube" value="<?php echo $clube;?>">
            <input type="hidden" name="quantidade" id="quantidade" value="<?php echo $quantidade;?>">
            <input type="hidden" name="idcampanha" id="idcampanha" value="<?php echo $idcampanha;?>">
			<input type="hidden" name="totalboleto" id="totalboleto" value="<?php echo $valorcampanha;?>">
			<input type="hidden" name="cep" id="cep" value="<?php echo $cep;?>">
            <input type="hidden" name="estado" id="estado" value="<?php echo $estado;?>">
            <input type="hidden" name="endereco" id="endereco" value="<?php echo $endereco;?>">
            <input type="hidden" name="numero" id="numero" value="<?php echo $numero;?>">
            <input type="hidden" name="cidade" id="cidade" value="<?php echo $cidade;?>">
            <input type="hidden" name="tipodoacao" id="tipodoacao" value="<?php echo $tipodoacao;?>">
            <input type="hidden" name="metodopagamento" id="metodopagamento" value="<?php echo $metodopagamento;?>">
            <input type="hidden" name="confidencial" id="confidencial" value="<?php echo $confidencial;?>">
            <input type="hidden" name="protocolo" id="protocolo" value="<?php echo $protocolo;?>">
            <input type="hidden" name="data" id="data" value="<?php echo $data;?>">
            <input type="hidden" name="hora" id="hora" value="<?php echo $hora;?>">

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
                                <td>Doação em Valor</td>
                                <td></td>
                                <td align="center">R$ <?php echo number_format($valorcampanha,2,',','.'); ?></td>
                                
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
                                        <td align="right">R$ <?php echo number_format($valorcampanha,2,',','.'); ?></td>
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
<?php 

/*} else {
	echo "<script>window.alert('Voc\u00ea esqueceu de pressionar o reCaptcha no final do formul\u00e1rio, tente novamente!');window.location.href='evento_single.php?ref=".$ref."';</script>";
 }*/

?>