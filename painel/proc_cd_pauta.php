<?php 
//Conexão com banco de dados
include_once("config.php");

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);

$presidentereuniao = mysqli_real_escape_string($link,$_POST['presidente_reuniao']);
$secretarioreuniao = mysqli_real_escape_string($link,$_POST['secretario_reuniao']);

//Informações
$idreuniao = mysqli_real_escape_string($link,$_POST['id_reuniao']);
$idlocal = mysqli_real_escape_string($link,$_POST['local_reuniao']);

$tiporeuniao = mysqli_real_escape_string($link,$_POST['tipo_reuniao']);
$anorotario = mysqli_real_escape_string($link,$_POST['ano_rotario']);

$niverinicial = mysqli_real_escape_string($link,$_POST['niver_inicial']);
$niverfinal = mysqli_real_escape_string($link,$_POST['niver_final']);

//Cardápio
$entradacardapio = mysqli_real_escape_string($link,$_POST['entrada_cardapio']);
$principalcardapio = mysqli_real_escape_string($link,$_POST['principal_cardapio']);
$sobremesacardapio = mysqli_real_escape_string($link,$_POST['sobremesa_cardapio']);

$lastpauta = rand();

//Pega última Pauta
$quer = "SELECT * FROM rfa_pauta WHERE cod_pauta='$lastpauta'";
$lis = mysqli_query($link, $quer) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);

if($totalRows_lis > 0){
	$lastpauta += rand(); //Caso o número da pauta exista troca
}


//Protocolo
$horainicio = mysqli_real_escape_string($link,$_POST['hora_inicio']);
$tempoprotocolo = mysqli_real_escape_string($link,$_POST['tempo_protocolo']);
$finalprotocolo = mysqli_real_escape_string($link,$_POST['final_protocolo']);
$protocolouser = mysqli_real_escape_string($link,$_POST['protocolo_user']);

//Abertura
$aberturauser = mysqli_real_escape_string($link,$_POST['abertura_user']);

//Secretaria
$iniciosecretaria = mysqli_real_escape_string($link,$_POST['inicio_secretaria']);
$temposecretaria = mysqli_real_escape_string($link,$_POST['tempo_secretaria']);
$finalsecretaria = mysqli_real_escape_string($link,$_POST['final_secretaria']);
$secretariauser = mysqli_real_escape_string($link,$_POST['secretaria_user']);

//Tesouraria
$iniciotesouraria = mysqli_real_escape_string($link,$_POST['inicio_tesouraria']);
$tempotesouraria = mysqli_real_escape_string($link,$_POST['tempo_tesouraria']);
$finaltesouraria = mysqli_real_escape_string($link,$_POST['final_tesouraria']);
$tesourariauser = mysqli_real_escape_string($link,$_POST['tesouraria_user']);

//Subcomissão de Companheirismo
$iniciocompanheirismo = mysqli_real_escape_string($link,$_POST['inicio_companheirismo']);
$tempocompanheirismo = mysqli_real_escape_string($link,$_POST['tempo_companheirismo']);
$finalcompanheirismo = mysqli_real_escape_string($link,$_POST['final_companheirismo']);
$companheirismouser = mysqli_real_escape_string($link,$_POST['companheirismo_user']);

//Comissão Administrativa
$iniciocomadm = mysqli_real_escape_string($link,$_POST['inicio_comadm']);
$tempocomadm = mysqli_real_escape_string($link,$_POST['tempo_comadm']);
$finalcomadm = mysqli_real_escape_string($link,$_POST['final_comadm']);
$comadmuser = mysqli_real_escape_string($link,$_POST['comadm_user']);

//Comissão Projetos
$iniciocomproj = mysqli_real_escape_string($link,$_POST['inicio_comproj']);
$tempocomproj = mysqli_real_escape_string($link,$_POST['tempo_comproj']);
$finalcomproj = mysqli_real_escape_string($link,$_POST['final_comproj']);
$comprojuser = mysqli_real_escape_string($link,$_POST['comproj_user']);

//Comissão Fundação Rotária
$iniciocomfundrot = mysqli_real_escape_string($link,$_POST['inicio_comfundrot']);
$tempocomfundrot = mysqli_real_escape_string($link,$_POST['tempo_comfundrot']);
$finalcomfundrot = mysqli_real_escape_string($link,$_POST['final_comfundrot']);
$comfundrotuser = mysqli_real_escape_string($link,$_POST['comfundrot_user']);

//Apresentação Palestrantes
$aprespalestranteuser = mysqli_real_escape_string($link,$_POST['aprespalestrante_user']);

//Palestrante
$iniciopalestra = mysqli_real_escape_string($link,$_POST['inicio_palestra']);
$tempopalestra = mysqli_real_escape_string($link,$_POST['tempo_palestra']);
$finalpalestra = mysqli_real_escape_string($link,$_POST['final_palestra']);
$palestranteuser = mysqli_real_escape_string($link,$_POST['palestrante_user']);

//Tema
$temauser = mysqli_real_escape_string($link,$_POST['tema_user']);

//Informação Rotária
$inicioinforot = mysqli_real_escape_string($link,$_POST['inicio_inforot']);
$tempoinforot = mysqli_real_escape_string($link,$_POST['tempo_inforot']);
$finalinforot = mysqli_real_escape_string($link,$_POST['final_inforot']);
$inforotuser = mysqli_real_escape_string($link,$_POST['inforot_user']);

//Presidência
$iniciopres = mysqli_real_escape_string($link,$_POST['inicio_pres']);
$tempopres = mysqli_real_escape_string($link,$_POST['tempo_pres']);
$finalpres = mysqli_real_escape_string($link,$_POST['final_pres']);
$presuser = mysqli_real_escape_string($link,$_POST['pres_user']);

//Pequenas Comunicações
$iniciopeqcom = mysqli_real_escape_string($link,$_POST['inicio_peqcom']);
$tempopeqcom = mysqli_real_escape_string($link,$_POST['tempo_peqcom']);
$finalpeqcom = mysqli_real_escape_string($link,$_POST['final_peqcom']);
$peqcomuser = mysqli_real_escape_string($link,$_POST['peqcom_user']);

//Subcomissão de Frequência
$iniciosubfreq = mysqli_real_escape_string($link,$_POST['inicio_subfreq']);
$temposubfreq = mysqli_real_escape_string($link,$_POST['tempo_subfreq']);
$finalsubfreq = mysqli_real_escape_string($link,$_POST['final_subfreq']);
$subfrequser = mysqli_real_escape_string($link,$_POST['subfreq_user']);

//Almoço
$inicioalmoco = mysqli_real_escape_string($link,$_POST['inicio_almoco']);
$tempoalmoco = mysqli_real_escape_string($link,$_POST['tempo_almoco']);
$finalalmoco = mysqli_real_escape_string($link,$_POST['final_almoco']);

//Encerramento
$finalencerra = mysqli_real_escape_string($link,$_POST['final_encerra']);
$encerrauser = mysqli_real_escape_string($link,$_POST['encerra_user']);

//Mesa
	$nomemesa = $_POST['nome_mesa'];
	$cargomesa = $_POST['cargo_mesa'];

//Local
if($idlocal == 1){
	$nomelocal = mysqli_real_escape_string($link,$_POST['nome_local']);
	$ceplocal = mysqli_real_escape_string($link,$_POST['cep_local']);
	$logradourolocal = mysqli_real_escape_string($link,$_POST['logradouro_local']);
	$numerolocal = mysqli_real_escape_string($link,$_POST['numero_local']);
	$bairrolocal = mysqli_real_escape_string($link,$_POST['bairro_local']);
	$cidadelocal = mysqli_real_escape_string($link,$_POST['cidade_local']);
	$uflocal = mysqli_real_escape_string($link,$_POST['uf_local']);
	
	//Pega último local
	$q = "SELECT * FROM rfa_local_reuniao ORDER BY id_local DESC";
	$pegalocal = mysqli_query($link, $q) or die(mysqli_error($link));
	$row_pegalocal = mysqli_fetch_assoc($pegalocal);

	$lastlocal = $row_pegalocal['id_local'];
	$lastlocal += 1;


	$sql = "INSERT INTO rfa_pauta (pres_reuniao, sec_reuniao, inicio_palestra, tmp_palestra, final_palestra, inicio_almoco, tmp_almoco, final_almoco, niver_inicial, niver_final, cod_pauta, ref_reuniao, tipo_reuniao, ano_rotario, entrada_cardapio, prato_cardapio, sobrem_cardapio, nome_abertura, inicio_reuniao, tmp_protocolo, final_protocolo, user_protocolo, inicio_secretaria, tmp_secretaria, final_secretaria, user_secretaria, inicio_tesouraria, tmp_tesouraria, final_tesouraria, user_tesouraria, inicio_sub_comp, tmp_sub_comp, final_sub_comp, user_sub_comp, inicio_com_adm, tmp_com_adm, final_com_adm, user_com_adm, inicio_com_proj, tmp_com_proj, final_com_proj, user_com_proj, inicio_com_fund, tmp_com_fund, final_com_fund,user_com_fund, apres_palestrante, palestrante, tema, inicio_info_rotaria, tmp_info_rotaria, final_info_rotaria, user_info_rotaria, inicio_presidencia, tmp_presidencia, final_presidencia, user_presidencia, inicio_pq_com, tmp_pq_com, final_pq_com, user_pq_com, inicio_sub_freq, tmp_sub_freque, final_sub_freq, user_sub_freque, time_encerramento, user_encerramento, clube, id_local) VALUES ('$presidentereuniao','$secretarioreuniao','$iniciopalestra','$tempopalestra','$finalpalestra','$inicioalmoco', '$tempoalmoco', '$finalalmoco', '$niverinicial', '$niverfinal', '$lastpauta', '$idreuniao', '$tiporeuniao', '$anorotario', '$entradacardapio', '$principalcardapio', '$sobremesacardapio', '$aberturauser', '$horainicio', '$tempoprotocolo', '$finalprotocolo', '$protocolouser', '$iniciosecretaria', '$temposecretaria', '$finalsecretaria', '$secretariauser', '$iniciotesouraria', '$tempotesouraria', '$finaltesouraria', '$tesourariauser', '$iniciocompanheirismo', '$tempocompanheirismo', '$finalcompanheirismo', '$companheirismouser', '$iniciocomadm', '$tempocomadm', '$finalcomadm', '$comadmuser', '$iniciocomproj', '$tempocomproj', '$finalcomproj', '$comprojuser', '$iniciocomfundrot', '$tempocomfundrot', '$finalcomfundrot', '$comfundrotuser', '$aprespalestranteuser', '$palestranteuser', '$temauser', '$inicioinforot', '$tempoinforot', '$finalinforot', '$inforotuser', '$iniciopres', '$tempopres', '$finalpres', '$presuser', '$iniciopeqcom', '$tempopeqcom', '$finalpeqcom','$peqcomuser', '$iniciosubfreq', '$temposubfreq', '$finalsubfreq', '$subfrequser', '$finalencerra', '$encerrauser', '$club', '$lastlocal');";
	
	
	// Foreach mesa
	foreach($nomemesa as $key => $nmesa){
		$sql .= "INSERT INTO rfa_mesa (ref_pauta, cargo_mesa, nome_mesa, clube) VALUES ('$lastpauta', '$cargomesa[$key]', '$nmesa', '$club');";
	}
	

	$sql .= "INSERT INTO rfa_local_reuniao (id_local, nome_local, cep_local, logradouro_local, numero_local, bairro_local, cidade_local, uf_local, clube) VALUES ('$lastlocal', '$nomelocal', '$ceplocal', '$logradourolocal', '$numerolocal', '$bairrolocal', '$cidadelocal', '$uflocal', $club)";
}else{
	$sql = "INSERT INTO rfa_pauta (pres_reuniao, sec_reuniao,inicio_palestra, tmp_palestra, final_palestra, inicio_almoco, tmp_almoco, final_almoco, niver_inicial, niver_final, cod_pauta, ref_reuniao, tipo_reuniao, ano_rotario, entrada_cardapio, prato_cardapio, sobrem_cardapio, nome_abertura, inicio_reuniao, tmp_protocolo, final_protocolo, user_protocolo, inicio_secretaria, tmp_secretaria, final_secretaria, user_secretaria, inicio_tesouraria, tmp_tesouraria, final_tesouraria, user_tesouraria, inicio_sub_comp, tmp_sub_comp, final_sub_comp, user_sub_comp, inicio_com_adm, tmp_com_adm, final_com_adm, user_com_adm, inicio_com_proj, tmp_com_proj, final_com_proj, user_com_proj, inicio_com_fund, tmp_com_fund, final_com_fund,user_com_fund, apres_palestrante, palestrante, tema, inicio_info_rotaria, tmp_info_rotaria, final_info_rotaria, user_info_rotaria, inicio_presidencia, tmp_presidencia, final_presidencia, user_presidencia, inicio_pq_com, tmp_pq_com, final_pq_com, user_pq_com, inicio_sub_freq, tmp_sub_freque, final_sub_freq, user_sub_freque, time_encerramento, user_encerramento, clube, id_local) VALUES ('$presidentereuniao','$secretarioreuniao','$iniciopalestra','$tempopalestra','$finalpalestra','$inicioalmoco', '$tempoalmoco', '$finalalmoco', '$niverinicial', '$niverfinal','$lastpauta','$idreuniao', '$tiporeuniao', '$anorotario', '$entradacardapio', '$principalcardapio', '$sobremesacardapio', '$aberturauser', '$horainicio', '$tempoprotocolo', '$finalprotocolo', '$protocolouser', '$iniciosecretaria', '$temposecretaria', '$finalsecretaria', '$secretariauser', '$iniciotesouraria', '$tempotesouraria', '$finaltesouraria', '$tesourariauser', '$iniciocompanheirismo', '$tempocompanheirismo', '$finalcompanheirismo', '$companheirismouser', '$iniciocomadm', '$tempocomadm', '$finalcomadm', '$comadmuser', '$iniciocomproj', '$tempocomproj', '$finalcomproj', '$comprojuser', '$iniciocomfundrot', '$tempocomfundrot', '$finalcomfundrot', '$comfundrotuser', '$aprespalestranteuser', '$palestranteuser', '$temauser', '$inicioinforot', '$tempoinforot', '$finalinforot', '$inforotuser', '$iniciopres', '$tempopres', '$finalpres', '$presuser', '$iniciopeqcom', '$tempopeqcom', '$finalpeqcom','$peqcomuser', '$iniciosubfreq', '$temposubfreq', '$finalsubfreq', '$subfrequser', '$finalencerra', '$encerrauser', '$club', '$idlocal');";

	
	// Foreach mesa
	foreach($nomemesa as $key => $nmesa){
		$sql .= "INSERT INTO rfa_mesa (ref_pauta, cargo_mesa, nome_mesa, clube) VALUES ('$lastpauta', '$cargomesa[$key]', '$nmesa', '$club');";
	}
	

}

	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Pauta cadastrada com sucesso!');javascript:window.location='pauta.php';javascript:window.open('mpdf/recibo-pauta-reuniao.php?cod_pauta=".$lastpauta."&clube=".$club."')</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();




?>