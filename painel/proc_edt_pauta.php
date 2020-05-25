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
$idpauta = mysqli_real_escape_string($link,$_POST['idpauta']);

$tiporeuniao = mysqli_real_escape_string($link,$_POST['tipo_reuniao']);
$anorotario = mysqli_real_escape_string($link,$_POST['ano_rotario']);

$niverinicial = mysqli_real_escape_string($link,$_POST['niver_inicial']);
$niverfinal = mysqli_real_escape_string($link,$_POST['niver_final']);

//Cardápio
$entradacardapio = mysqli_real_escape_string($link,$_POST['entrada_cardapio']);
$principalcardapio = mysqli_real_escape_string($link,$_POST['principal_cardapio']);
$sobremesacardapio = mysqli_real_escape_string($link,$_POST['sobremesa_cardapio']);

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
	$idmesa = $_POST['idmesa'];
	$nomemesa = mysqli_real_escape_string($link,$_POST['nome_mesa']);
	$cargomesa = mysqli_real_escape_string($link,$_POST['cargo_mesa']);
	$atv = $_POST['check'];
	
	//Caso haja adição de mais membros á mesa
	$nomemesa2 = $_POST['nome_mesa2'];
	$cargomesa2 = $_POST['cargo_mesa2'];

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

	$sql = "UPDATE rfa_pauta SET
	pres_reuniao = '$presidentereuniao', 
	sec_reuniao = '$secretarioreuniao', 
	ref_reuniao = '$idreuniao', 
	tipo_reuniao = '$tiporeuniao', 
	ano_rotario = '$anorotario', 
	entrada_cardapio = '$entradacardapio', 
	prato_cardapio = '$principalcardapio', 
	sobrem_cardapio = '$sobremesacardapio', 
	nome_abertura = '$aberturauser', 
	inicio_reuniao = '$horainicio', 
	tmp_protocolo = '$tempoprotocolo', 
	final_protocolo = '$finalprotocolo', 
	user_protocolo = '$protocolouser', 
	inicio_secretaria = '$iniciosecretaria', 
	tmp_secretaria = '$temposecretaria', 
	final_secretaria = '$finalsecretaria', 
	user_secretaria = '$secretariauser', 
	inicio_tesouraria = '$iniciotesouraria', 
	tmp_tesouraria = '$tempotesouraria', 
	final_tesouraria = '$finaltesouraria', 
	user_tesouraria = '$tesourariauser', 
	inicio_sub_comp = '$iniciocompanheirismo', 
	tmp_sub_comp = '$tempocompanheirismo', 
	final_sub_comp = '$finalcompanheirismo', 
	user_sub_comp = '$companheirismouser', 
	inicio_com_adm = '$iniciocomadm', 
	tmp_com_adm = '$tempocomadm', 
	final_com_adm = '$finalcomadm', 
	user_com_adm = '$comadmuser', 
	inicio_com_proj = '$iniciocomproj', 
	tmp_com_proj = '$tempocomproj', 
	final_com_proj = '$finalcomproj', 
	user_com_proj = '$comprojuser', 
	inicio_com_fund = '$iniciocomfundrot', 
	tmp_com_fund = '$tempocomfundrot', 
	final_com_fund = '$finalcomfundrot',
	user_com_fund = '$comfundrotuser', 
	apres_palestrante = '$aprespalestranteuser',
	inicio_palestra = '$iniciopalestra',
	tmp_palestra = '$tempopalestra',
	final_palestra = '$finalpalestra', 
	inicio_almoco = '$inicioalmoco',
	tmp_almoco = '$tempoalmoco',
	final_almoco = '$finalalmoco',
	niver_inicial = '$niverinicial',
	niver_final = '$niverfinal',
	palestrante = '$palestranteuser', 
	tema = '$temauser', 
	inicio_info_rotaria = '$inicioinforot', 
	tmp_info_rotaria = '$tempoinforot', 
	final_info_rotaria = '$finalinforot', 
	user_info_rotaria = '$inforotuser', 
	inicio_presidencia = '$iniciopres', 
	tmp_presidencia = '$tempopres', 
	final_presidencia = '$finalpres', 
	user_presidencia = '$presuser', 
	inicio_pq_com = '$iniciopeqcom', 
	tmp_pq_com = '$tempopeqcom', 
	final_pq_com = '$finalpeqcom', 
	user_pq_com = '$peqcomuser', 
	inicio_sub_freq = '$iniciosubfreq', 
	tmp_sub_freque = '$temposubfreq', 
	final_sub_freq = '$finalsubfreq', 
	user_sub_freque = '$subfrequser', 
	time_encerramento = '$finalencerra', 
	user_encerramento = '$encerrauser', 
	clube = '$club', 
	id_local = '$lastlocal' WHERE cod_pauta='$idpauta' AND clube='$club';";
	
	//Mesa adicional
	if(isset($nomemesa2) || isset($cargomesa2)){
		foreach($nomemesa2 as $k => $nme){
		$sql .= "INSERT INTO rfa_mesa (ref_pauta, cargo_mesa, nome_mesa, clube) VALUES ('$idpauta', '$cargomesa2[$k]', '$nme', '$club');";
		}
	}
	
	// Foreach mesa
	foreach($nomemesa as $key => $nmesa){
		$sql .= "UPDATE rfa_mesa SET cargo_mesa = '$cargomesa[$key]', nome_mesa = '$nmesa' WHERE ref_pauta='$idpauta' AND id_mesa='$idmesa[$key]' AND clube='$club';";
	}
	

	$sql .= "INSERT INTO rfa_local_reuniao (id_local, nome_local, cep_local, logradouro_local, numero_local, bairro_local, cidade_local, uf_local, clube) VALUES ('$lastlocal', '$nomelocal', '$ceplocal', '$logradourolocal', '$numerolocal', '$bairrolocal', '$cidadelocal', '$uflocal', $club)";
}else{
	$sql = "UPDATE rfa_pauta SET
		pres_reuniao = '$presidentereuniao', 
		sec_reuniao = '$secretarioreuniao', 
		ref_reuniao = '$idreuniao', 
		tipo_reuniao = '$tiporeuniao', 
		ano_rotario = '$anorotario', 
		entrada_cardapio = '$entradacardapio', 
		prato_cardapio = '$principalcardapio', 
		sobrem_cardapio = '$sobremesacardapio', 
		nome_abertura = '$aberturauser', 
		inicio_reuniao = '$horainicio', 
		tmp_protocolo = '$tempoprotocolo', 
		final_protocolo = '$finalprotocolo', 
		user_protocolo = '$protocolouser', 
		inicio_secretaria = '$iniciosecretaria', 
		tmp_secretaria = '$temposecretaria', 
		final_secretaria = '$finalsecretaria', 
		user_secretaria = '$secretariauser', 
		inicio_tesouraria = '$iniciotesouraria', 
		tmp_tesouraria = '$tempotesouraria', 
		final_tesouraria = '$finaltesouraria', 
		user_tesouraria = '$tesourariauser', 
		inicio_sub_comp = '$iniciocompanheirismo', 
		tmp_sub_comp = '$tempocompanheirismo', 
		final_sub_comp = '$finalcompanheirismo', 
		user_sub_comp = '$companheirismouser', 
		inicio_com_adm = '$iniciocomadm', 
		tmp_com_adm = '$tempocomadm', 
		final_com_adm = '$finalcomadm', 
		user_com_adm = '$comadmuser', 
		inicio_com_proj = '$iniciocomproj', 
		tmp_com_proj = '$tempocomproj', 
		final_com_proj = '$finalcomproj', 
		user_com_proj = '$comprojuser', 
		inicio_com_fund = '$iniciocomfundrot', 
		tmp_com_fund = '$tempocomfundrot', 
		final_com_fund = '$finalcomfundrot',
		user_com_fund = '$comfundrotuser', 
		apres_palestrante = '$aprespalestranteuser', 
		inicio_palestra = '$iniciopalestra',
		tmp_palestra = '$tempopalestra',
		final_palestra = '$finalpalestra', 
		inicio_almoco = '$inicioalmoco',
		tmp_almoco = '$tempoalmoco',
		final_almoco = '$finalalmoco',
		niver_inicial = '$niverinicial',
		niver_final = '$niverfinal',
		palestrante = '$palestranteuser', 
		tema = '$temauser', 
		inicio_info_rotaria = '$inicioinforot', 
		tmp_info_rotaria = '$tempoinforot', 
		final_info_rotaria = '$finalinforot', 
		user_info_rotaria = '$inforotuser', 
		inicio_presidencia = '$iniciopres', 
		tmp_presidencia = '$tempopres', 
		final_presidencia = '$finalpres', 
		user_presidencia = '$presuser', 
		inicio_pq_com = '$iniciopeqcom', 
		tmp_pq_com = '$tempopeqcom', 
		final_pq_com = '$finalpeqcom', 
		user_pq_com = '$peqcomuser', 
		inicio_sub_freq = '$iniciosubfreq', 
		tmp_sub_freque = '$temposubfreq', 
		final_sub_freq = '$finalsubfreq', 
		user_sub_freque = '$subfrequser', 
		time_encerramento = '$finalencerra', 
		user_encerramento = '$encerrauser', 
		clube = '$club', 
		id_local = '$idlocal' WHERE cod_pauta='$idpauta' AND clube='$club';";
	
	// Mesa adicional
	if(isset($nomemesa2) || isset($cargomesa2)){
		foreach($nomemesa2 as $k => $nme){
		$sql .= "INSERT INTO rfa_mesa (ref_pauta, cargo_mesa, nome_mesa, clube, atv) VALUES ('$idpauta', '$cargomesa2[$k]', '$nme', '$club', '2');";
		}
	}
	
	// Foreach mesa
	foreach($nomemesa as $key => $nmesa){
		$sql .= "UPDATE rfa_mesa SET cargo_mesa = '$cargomesa[$key]', nome_mesa = '$nmesa', atv = '$atv[$key]' WHERE ref_pauta='$idpauta' AND id_mesa='$idmesa[$key]' AND clube='$club';";
	}

	// Foreach mesa
	foreach($atv as $ky => $ativa){
		if($ativa == 1){
		$sql .= "DELETE FROM rfa_mesa WHERE ref_pauta='$idpauta' AND id_mesa='$idmesa[$ky]' AND clube='$club';";
		}
	}
	

}

	
if ($link->multi_query($sql) === TRUE) {
		echo "<script>javascript:alert('Pauta atualizada com sucesso!');javascript:window.location='pauta.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>