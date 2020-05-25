<?php
$page = 1;

include('config-header.php');
include('verifica-mensalidade.php');

//Verifica se Integração foi realizada
$qclube = "SELECT * FROM rfa_clubes WHERE id_clube='$clube'";
$lisclube = mysqli_query($link, $qclube) or die(mysqli_error($link));
$row_lisclube = mysqli_fetch_assoc($lisclube);

$appkey = $row_lisclube['paghiper_appkey'];
$token = $row_lisclube['paghiper_token'];
$cepclube = $row_lisclube['cep_clube'];
$enderecoclube = $row_lisclube['endereco_clube'];
$numeroclube = $row_lisclube['numero_clube'];
$bairroclube = $row_lisclube['bairro_clube'];
$cidadeclube = $row_lisclube['cidade_clube'];
$estadoclube = $row_lisclube['estado_clube'];
$telefoneclube = $row_lisclube['telefone_clube'];
$emailclube = $row_lisclube['email_clube'];
$cambioclube = $row_lisclube['cambio'];



//Verifica se há algum banco principal configurado para receber as mensalidades
$qmainbank = "SELECT * FROM rfa_bancos WHERE clube='$clube' AND conta_mensalidade='1'";
$lismainbank = mysqli_query($link, $qmainbank) or die(mysqli_error($link));
$totalRows_lismainbank = mysqli_num_rows($lismainbank);

//Verifica se há alguma configuração de topo para o site
$qsttopo = "SELECT * FROM rfa_site_topo WHERE clube='$clube'";
$lissttopo = mysqli_query($link, $qsttopo) or die(mysqli_error($link));
$row_lissttopo = mysqli_fetch_assoc($lissttopo);
$totalRows_lissttopo = mysqli_num_rows($lissttopo);

$facebook = $row_lissttopo['facebook_url'];
$instagram = $row_lissttopo['insta_url'];
$youtube = $row_lissttopo['youtube_url'];
$linhanoticia = $row_lissttopo['linha_noticia'];
$titleseo = $row_lissttopo['title_seo'];
$descriptionseo = $row_lissttopo['description_seo'];
$keywordseo = $row_lissttopo['keyword_seo'];
$bannertitle = $row_lissttopo['banner_title'];
$bannersub = $row_lissttopo['banner_sub'];
$bannerbtn = $row_lissttopo['banner_btn'];
$linkbotao = $row_lissttopo['link_botao'];

//Verifica se há algum post no blog
$qstblog = "SELECT * FROM rfa_site_blog WHERE clube='$clube'";
$lisstblog = mysqli_query($link, $qstblog) or die(mysqli_error($link));
$totalRows_lisstblog = mysqli_num_rows($lisstblog);

//Verifica se há alguma configuração de conteúdo para o site
$qstcontent = "SELECT * FROM rfa_site_conteudo WHERE clube='$clube'";
$lisstcontent = mysqli_query($link, $qstcontent) or die(mysqli_error($link));
$row_lisstcontent = mysqli_fetch_assoc($lisstcontent);
$totalRows_lisstcontent = mysqli_num_rows($lisstcontent);

$titledestaque = $row_lisstcontent['title_destaque'];
$titlevideo = $row_lisstcontent['title_video'];
$subvideo = $row_lisstcontent['sub_video'];
$linkvideo = $row_lisstcontent['link_video'];
$titleequipe = $row_lisstcontent['title_equipe'];
$subequipe = $row_lisstcontent['sub_equipe'];

$qstclube = "SELECT * FROM rfa_site_clube WHERE clube='$clube'";
$lisstclube = mysqli_query($link, $qstclube) or die(mysqli_error($link));
$row_lisstclube = mysqli_fetch_assoc($lisstclube);

$titleclube = $row_lisstclube['title_site_clube'];
$textoclube = $row_lisstclube['texto_site_clube'];

//Verifica se há algum presidente cadastrado na galeria de presidentes
$qstgallery = "SELECT * FROM rfa_site_galeria WHERE clube='$clube'";
$lisstgallery = mysqli_query($link, $qstgallery) or die(mysqli_error($link));
$totalRows_lisstgallery = mysqli_num_rows($lisstgallery);

//Verifica se há serviços a comunidade
$qsvcomun = "SELECT * FROM rfa_servicos_comunidade WHERE clube='$clube'";
$lissvcomun = mysqli_query($link, $qsvcomun) or die(mysqli_error($link));
$totalRows_lissvcomun = mysqli_num_rows($lissvcomun);

//Verifica se há serviços profissionais
$qsvprof = "SELECT * FROM rfa_servicos_profissionais WHERE clube='$clube'";
$lissvprof = mysqli_query($link, $qsvprof) or die(mysqli_error($link));
$totalRows_lissvprof = mysqli_num_rows($lissvprof);

//Verifica se há datas importantes
$qdatasimp = "SELECT * FROM rfa_datas_importantes WHERE clube='$clube'";
$lisdatasimp = mysqli_query($link, $qdatasimp) or die(mysqli_error($link));
$totalRows_lisdatasimp = mysqli_num_rows($lisdatasimp);

$regra1 = empty($appkey) || empty($token);
$regra2 = $totalRows_lismainbank < 1;
$regra3 = empty($cepclube) || empty($enderecoclube) || empty($numeroclube) || empty($bairroclube) || empty($cidadeclube) || empty($estadoclube) || empty($telefoneclube) || empty($emailclube) || empty($cambioclube);
$regra4 = $totalRows_lissttopo < 1;
$regra5 = empty($facebook) || empty($instagram) || empty($youtube) || empty($linhanoticia) || empty($titleseo) || empty($descriptionseo) || empty($keywordseo) || empty($bannertitle) || empty($bannersub) || empty($bannerbtn) || empty($linkbotao);
$regra6 = $totalRows_lisstblog < 1;
$regra7 = $totalRows_lisstcontent < 1;
$regra8 = empty($titledestaque) || empty($titlevideo) || empty($subvideo) || empty($linkvideo) || empty($titleequipe) || empty($subequipe) || empty($titleclube) || empty($textoclube);
$regra9 = $totalRows_lisstgallery < 1;
$regra10 = $totalRows_lissvcomun < 1 || $totalRows_lissvprof < 1 || $totalRows_lisdatasimp < 1;
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

</head>

<body >

<?php if($regra1 != 1 && $regra2 != 1 && $regra3 != 1 && $regra4 != 1 && $regra5 != 1 && $regra6 != 1 && $regra7 != 1 && $regra8 != 1 && $regra9 != 1 && $regra10 != 1){}else{?>
<div class="modal fade" id="global-modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!--Modal Content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atenção</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body" style="padding: 0;">
        <div class="row">
            <div class="col" style="margin: 15px;">
                <strong>Olá! Seja bem vindo(a) ao Clube Digital! Temos alguns passos para que você possa começar a usar o sistema, veja abaixo:</strong><br><br>
            </div>
        </div>
        <?php 
           if($regra1){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Você precisa configurar sua integração com o Paghiper, para que assim seja possível emitir boletos. <a href='integracao'>Clique para configurar...</a></div></div>";
            }
        ?>

        <?php 
           if($regra2){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Você precisa criar uma conta bancária principal para recebimento de mensalidades. <a href='banco'>Clique para configurar...</a></div></div>";
            }
        ?>

        <?php 
           if($regra3){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Preencha as informações do seu clube. <a href='configuracoes'>Clique para configurar...</a></div></div>";
            }
        ?>

        <?php 
           if($regra4){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Você precisa começar a configurar o topo do site de seu clube. <a href='topo'>Clique para configurar...</a></div></div>";
            }
        ?>

        <?php 
           if($regra5){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Há alguns campos que ainda estão pendentes de preenchimento para o topo de seu site. <a href='topo'>Clique para configurar...</a></div></div>";
            }
        ?>

        <?php 
           if($regra6){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Faça pelo menos uma postagem no blog do seu site. <a href='blog'>Clique para configurar...</a></div></div>";
            }
        ?>

        <?php 
           if($regra7){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Você precisa começar a configurar o conteúdo do site de seu clube. <a href='conteudo'>Clique para configurar...</a></div></div>";
            }
        ?> 

        <?php 
           if($regra8){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Há alguns campos que ainda estão pendentes de preenchimento para o conteúdo de seu site. <a href='conteudo'>Clique para configurar...</a></div></div>";
            }
        ?>

        <?php 
           if($regra9){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Cadastre pelo menos um presidente na galeria de presidentes de seu site. <a href='galeria'>Clique para configurar...</a></div></div>";
            }
        ?> 

        <?php 
           if($regra10){
               echo "<div class='row' style='margin: 15px'><div class='col-3 col-md-1'><img src='images/cancel.png'></div> <div class='col-9 col-md-11'>Cadastre os serviços à comunidade, serviços profissionais e datas importantes, no menu <strong>reuniões</strong>.</div></div>";
            }
        ?> 
        

      </div>
    </div>
  </div>
</div>
<?php } ?>

    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->

         

			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->

            

            <?php include("painel-teste.php"); ?>

            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php include("scripts-footer.php"); ?>

<script>
    $(document).ready(function() {
  $('#global-modal').modal('show');
});
</script>

</body>

</html>
<!-- end document-->