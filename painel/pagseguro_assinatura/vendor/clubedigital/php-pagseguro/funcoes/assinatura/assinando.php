<?php
//=============================================//
//           Criando uma assinatura		       //
//=============================================//
include("conexao.php");

require dirname(__FILE__)."/../_autoload.class.php";
use CWG\PagSeguro\PagSeguroAssinaturas;

$select = $conn->query("
SELECT *
FROM rfa_config_pagseguro
WHERE id_pagseguro = '1'");
$result = $select->fetch(PDO::FETCH_ASSOC);

$email = $result['email_pagseguro'];
$token = $result['token_pagseguro'];
if($result['sandbox_pagseguro'] == 1){
$sandbox = true;
}else{ 
$sandbox = false;
}

$pagseguro = new PagSeguroAssinaturas($email, $token, $sandbox);

//Sete apenas TRUE caso queira importa o Jquery também. Caso já possua, não precisa
$js = $pagseguro->preparaCheckoutTransparente(true);
echo $js['completo'];
?>

<h2> Campos Obrigatórios </h2>
<p>Número do Cartão</p>
<input type="text" id="pagseguro_cartao_numero" value="4111111111111111"/>

<p>CVV do cartão</p>
<input type="text" id="pagseguro_cartao_cvv" value="123"/>

<p>Mês de expiração do Cartao</p>
<input type="text" id="pagseguro_cartao_mes" value="12"/>

<p>Ano de Expiração do Cartão</p>
<input type="text" id="pagseguro_cartao_ano" value="2030"/>

<br/>

<button id="botao_comprar">Comprar</button>

<script type="text/javascript">

    //Gera os conteúdos necessários
    $('#botao_comprar').click(function() {
        PagSeguroBuscaHashCliente(); //Cria o Hash identificador do Cliente usado na transição
        PagSeguroBuscaBandeira();   //Através do pagseguro_cartao_numero do cartão busca a bandeira
        PagSeguroBuscaToken();      //Através dos 4 campos acima gera o Token do cartão  
        setTimeout(function() {
            enviarPedido();
        }, 3000);
    });

    function enviarPedido() {
        alert($('#pagseguro_cliente_hash').val())
        alert($('#pagseguro_cartao_token').val())
        
        var data = {
            hash:  $('#pagseguro_cliente_hash').val(),
            token: $('#pagseguro_cartao_token').val()
        };
        
        $.post('assinando2.php', data, function(response) {
            alert(response);
        });
    }
</script>