<?php 
//Conexão com banco de dados
include_once("config.php");



$matual = date('m');
$aatual = date('Y');

$primeiromessocio = mysqli_real_escape_string($link,$_POST['primeiro_mes_socio']);
$primeiroanosocio = mysqli_real_escape_string($link,$_POST['primeiro_ano_socio']);

if($primeiromessocio < $matual && $primeiroanosocio <= $aatual){
	echo "<script>javascript:alert('Você não pode inserir uma data antiga para o primeiro pagamento!');javascript:window.location='cd_socios.php'</script>";
}else{

/*Recebe as variáveis de cd_socios.php*/
$nomesocio = mysqli_real_escape_string($link,$_POST['nome_socio']);
$classifsocio = mysqli_real_escape_string($link,$_POST['classif_socio']);
$idrisocio = mysqli_real_escape_string($link,$_POST['id_ri_socio']);
$dataadmissao = mysqli_real_escape_string($link,$_POST['data_admissao']);
$padrinho = mysqli_real_escape_string($link,$_POST['padrinho']);
$rgsocio = mysqli_real_escape_string($link,$_POST['rg_socio']);
$cpf1 = mysqli_real_escape_string($link,str_replace('.','',$_POST['cpf_socio']));
$cpf2 = str_replace('-','',$cpf1);
$cpfsocio = $cpf2;
$datanasctosocio = mysqli_real_escape_string($link,$_POST['data_nascto_socio']);
$conjuge = mysqli_real_escape_string($link,$_POST['conjuge']);
$datanasctoconjuge = mysqli_real_escape_string($link,$_POST['data_nascto_conjuge']);
$emailsocio = mysqli_real_escape_string($link,$_POST['email_socio']);
$telefone1 = mysqli_real_escape_string($link,str_replace('(','',$_POST['telefone_socio']));
$telefone2 = str_replace(')','',$telefone1);
$telefone3 = str_replace('-','',$telefone2);
$telefonesocio = $telefone3;
$categoriasocio = mysqli_real_escape_string($link,$_POST['categoria_socio']);
$telefonecon1 = mysqli_real_escape_string($link,str_replace('(','',$_POST['telefone_conjuge']));
$telefonecon2 = str_replace(')','',$telefonecon1);
$telefoneconjuge = str_replace('-','',$telefonecon2);
$datacasamento = mysqli_real_escape_string($link,$_POST['data_casamento']);
$celularsoc1 = mysqli_real_escape_string($link,str_replace('(','',$_POST['celular_socio']));
$celularsoc2 = str_replace(')','',$celularsoc1);
$celularsocio = str_replace('-','',$celularsoc2);
$cepsocio = mysqli_real_escape_string($link,$_POST['cep_socio']);
$enderecosocio = mysqli_real_escape_string($link,$_POST['endereco_socio']);
$numeroendsocio = mysqli_real_escape_string($link,$_POST['numero_end_socio']);
$bairrosocio = mysqli_real_escape_string($link,$_POST['bairro_socio']);
$complementosocio = mysqli_real_escape_string($link,$_POST['complemento_socio']);
$cidadesocio = mysqli_real_escape_string($link,$_POST['cidade_socio']);
$estadosocio = mysqli_real_escape_string($link,$_POST['estado_socio']);
$sexo = mysqli_real_escape_string($link,$_POST['sexo']);
$statussocio = mysqli_real_escape_string($link,$_POST['statussocio']);
$idsoc = mysqli_real_escape_string($link,$_POST['idsocio']);

$nomefilho = mysqli_real_escape_string($link,$_POST['nome_filho']);
$datanasctofilho = mysqli_real_escape_string($link,$_POST['data_nascto_filho']);


$referenciamensalidadesocio = mysqli_real_escape_string($link,$_POST['referencia_mensalidade_socio']);
$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_mensalidade_socio']));
$valormensalidadesocio = str_replace(',','.',$valor);
$vencimentomensalidadesocio = mysqli_real_escape_string($link,$_POST['vencimento_mensalidade_socio']);

$status = 1; //Significa Pendente inicialmente - STATUS DA MENSALIDADE

$user = $_POST['user'];
$club = $_POST['club'];

$foto = 'img_socio';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/socios/';

/*Variáveis do upload do logotipo*/
	$imgfoto = $_FILES[$foto]['name'];
	$tempfoto = $_FILES[$foto]['tmp_name'];

	if($imgfoto == NULL){
	$dirfoto = $pastaimg."avatarsocio.jpg";	
	}else{
	$dirfoto = $pastaimg.$data.$imgfoto;	
	}


$cod = rand();

$quer = "SELECT * FROM rfs_socios WHERE clube='$club' AND ref_socio='$cod'";
$lis = mysqli_query($link, $quer) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$totalRows_lis = mysqli_num_rows($lis);

if($totalRows_lis > 0){
$cod = rand();
$cod += 10;
}

$datacadastro = $primeiroanosocio."-".$primeiromessocio."-".$vencimentomensalidadesocio;

$datahoje = date('Y-m-d');
$statussocio = 1; //Ativo

if($datacadastro >= $datahoje){
$statuscob = 1; //Inativo
}else{
$statuscob = 0; //Inativo
}

$sql = "INSERT INTO rfs_socios (status_socio, status_cob, sexo, nome_socio, classif_socio, id_ri_socio, data_admissao, padrinho, rg_socio, cpf_socio, data_nascto_socio, conjuge, data_nascto_conjuge, email_socio, telefone_socio, mensalidade_ref, mensalidade_valor, mensalidade_diavenc, mensalidade_vencimento, user, data_cadastro, mensalidade_status, clube, ref_socio, categoria_socio, telefone_conjuge, data_casamento, celular_socio, cep_socio, endereco_socio, numero_end_socio, bairro_socio, complemento_socio, cidade_socio, estado_socio) VALUES ('$statussocio','$statuscob','$sexo','$nomesocio', '$classifsocio', '$idrisocio', '$dataadmissao', '$padrinho', '$rgsocio', '$cpfsocio', '$datanasctosocio', '$conjuge', '$datanasctoconjuge', '$emailsocio', '$telefonesocio', '$referenciamensalidadesocio', '$valormensalidadesocio', '$vencimentomensalidadesocio', '$primeiromensalidadesocio', '$user', '$datacadastro', '$status', '$club', '$cod', '$categoriasocio', '$telefoneconjuge', '$datacasamento', '$celularsocio', '$cepsocio', '$enderecosocio', '$numeroendsocio', '$bairrosocio', '$complementosocio', '$cidadesocio', '$estadosocio');";

if($statussocio == 1){
$sql .= "UPDATE rfa_socios_novos SET status_novo='$statussocio' WHERE clube='$clube' AND id_novo='$idsoc';";
}

foreach($nomefilho as $key => $name){
$sql .= "INSERT INTO rfa_socios_filhos (nome_filho, data_nascto_filho, id_socio) VALUES ('$name', '$datanasctofilho[$key]', '$cod');";
}

	
if ($link->multi_query($sql) === TRUE) {
	move_uploaded_file($tempfoto,$dirfoto);
		echo "<script>javascript:window.location='crop-socios.php?cod_usuario=".$cod."&clube=".$club."'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();
}
?>