<?php 
//Conexão com banco de dados
include_once("config.php");

$club = $_POST['club'];
$idslide = $_POST['idslide'];
$titulobanner = $_POST['titulo_banner'];
$subbanner = $_POST['sub_banner'];
$btnbanner = $_POST['btn_banner'];
$linkbotao = $_POST['link_botao'];
$updateslide = $_POST['updateslide'];
$delslide = $_POST['delslide'];
$ativo = $_POST['ativo'][0];
$posicao = $_POST['posicao'];

$banner = 'img_banner';
$mobile = 'img_mobile';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/sites/clube'.$club.'/';

mkdir($pastaimg, 0777, true);

/*Variáveis do upload do banner*/
    foreach($titulobanner as $key => $titlebanner){
        if($ativo == $idslide[$key] || $ativo[0]=="b"){
            $atv = "active";
        }else{
            $atv = "skyblue";
        }

        if($delslide[$key]==1){
            $sql .= "DELETE FROM rfa_site_slides WHERE clube='$club' AND id_slide='$idslide[$key]';";
        }elseif($updateslide[$key]==1){
            $imgbanner = $_FILES[$banner]['name'][$key];
            $tempbanner = $_FILES[$banner]['tmp_name'][$key];
            $bn = explode('.',$imgbanner);
            $bnn = md5($bn[0]).".".$bn[1];

            $imgmobile = $_FILES[$mobile]['name'][$key];
            $tempmobile = $_FILES[$mobile]['tmp_name'][$key];
            $bn2 = explode('.',$imgmobile);
            $bnn2 = md5($bn2[0]).".".$bn2[1];

            if($imgbanner=="" && $imgmobile!=""){
                $dirmobile= $pastaimg.$data.$bnn2;
                $sql .= "UPDATE rfa_site_slides SET lado='$posicao[$key]', img_mobile_topo='$dirmobile', ativo='$atv',banner_title='$titlebanner', banner_sub='$subbanner[$key]',  banner_btn='$btnbanner[$key]', link_botao='$linkbotao[$key]' WHERE clube='$club' AND id_slide='$idslide[$key]';";
                move_uploaded_file($tempmobile,$dirmobile);
            }elseif($imgbanner!="" && $imgmobile==""){
                $dirbanner = $pastaimg.$data.$bnn;
                $sql .= "UPDATE rfa_site_slides SET lado='$posicao[$key]', img_banner_topo='$dirbanner', ativo='$atv',banner_title='$titlebanner', banner_sub='$subbanner[$key]',  banner_btn='$btnbanner[$key]', link_botao='$linkbotao[$key]' WHERE clube='$club' AND id_slide='$idslide[$key]';";
                move_uploaded_file($tempbanner,$dirbanner);
            }elseif($imgbanner=="" && $imgmobile==""){
                $sql .= "UPDATE rfa_site_slides SET lado='$posicao[$key]', ativo='$atv',banner_title='$titlebanner', banner_sub='$subbanner[$key]',  banner_btn='$btnbanner[$key]', link_botao='$linkbotao[$key]' WHERE clube='$club' AND id_slide='$idslide[$key]';";

            }else{
                $dirbanner = $pastaimg.$data.$bnn;
                $dirmobile= $pastaimg.$data.$bnn2;
                $sql .= "UPDATE rfa_site_slides SET lado='$posicao[$key]', ativo='$atv',img_mobile_topo='$dirmobile', img_banner_topo='$dirbanner', banner_title='$titlebanner', banner_sub='$subbanner[$key]',  banner_btn='$btnbanner[$key]', link_botao='$linkbotao[$key]' WHERE clube='$club' AND id_slide='$idslide[$key]';";
                move_uploaded_file($tempbanner,$dirbanner);
                move_uploaded_file($tempmobile,$dirmobile);
            }

        }else{
            $imgbanner = $_FILES[$banner]['name'][$key];
            $tempbanner = $_FILES[$banner]['tmp_name'][$key];
            $bn = explode('.',$imgbanner);
            $bnn = md5($bn[0]).".".$bn[1];
            $dirbanner = $pastaimg.$data.$bnn;	

            $imgmobile = $_FILES[$mobile]['name'][$key];
            $tempmobile = $_FILES[$mobile]['tmp_name'][$key];
            $bn2 = explode('.',$imgmobile);
            $bnn2 = md5($bn2[0]).".".$bn2[1];
            $dirmobile = $pastaimg.$data.$bnn2;
        
            $sql .= "INSERT INTO rfa_site_slides (img_banner_topo, lado, ativo, img_banner_topo, banner_title, banner_sub,  banner_btn, link_botao, clube) VALUES ('$dirmobile','$posicao[$key]','$atv', '$dirbanner', '$titlebanner', '$subbanner[$key]', '$btnbanner[$key]', '$linkbotao[$key]','$club');";
            move_uploaded_file($tempbanner,$dirbanner);
            move_uploaded_file($tempmobile,$dirmobile);
        }
    }
	
	if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Slides atualizados com sucesso!');javascript:window.location='slides'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>