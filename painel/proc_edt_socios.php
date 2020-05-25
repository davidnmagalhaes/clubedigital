<?php 
//Conexão com banco de dados
include_once("config.php");

/*Recebe as variáveis de cd_socios.php*/
$nomesocio = mysqli_real_escape_string($link,$_POST['nome_socio']);
$idsoc = mysqli_real_escape_string($link,$_POST['idsoc']);
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

$idfilho = mysqli_real_escape_string($link,$_POST['idfilho']);
$nomefilho = mysqli_real_escape_string($link,$_POST['nome_filho']);
$nomefilho2 = mysqli_real_escape_string($link,$_POST['nome_filho2']);
$datanasctofilho = mysqli_real_escape_string($link,$_POST['data_nascto_filho']);
$datanasctofilho2 = mysqli_real_escape_string($link,$_POST['data_nascto_filho2']);

$referenciamensalidadesocio = mysqli_real_escape_string($link,$_POST['referencia_mensalidade_socio']);
$valor = mysqli_real_escape_string($link,str_replace('.','',$_POST['valor_mensalidade_socio']));
$valormensalidadesocio = str_replace(',','.',$valor);
$vencimentomensalidadesocio = mysqli_real_escape_string($link,$_POST['vencimento_mensalidade_socio']);
$primeiromensalidadesocio = mysqli_real_escape_string($link,$_POST['primeiro_mensalidade_socio']);
$status = 1; //Significa Pendente inicialmente - STATUS DA MENSALIDADE

$user = mysqli_real_escape_string($link,$_POST['user']);
$club = mysqli_real_escape_string($link,$_POST['club']);
$datacadastro = date('Y-m-d');

$quer = "SELECT * FROM rfs_socios WHERE clube='$club' AND id_socio='$idsoc'";
$lis = mysqli_query($link, $quer) or die(mysqli_error($link));
$row_lis = mysqli_fetch_assoc($lis);
$cod = $row_lis['ref_socio'];

$foto = 'img_socio';
$data = date("d-m-Y-H-i");
$pastaimg = 'images/socios/';

/*Variáveis do upload do logotipo*/
	$imgfoto = $_FILES[$foto]['name'];
	$tempfoto = $_FILES[$foto]['tmp_name'];
	$dirfoto = $pastaimg.$data.$imgfoto;	

if(empty($imgfoto)){
$sql = "UPDATE rfs_socios SET sexo = '$sexo', categoria_socio='$categoriasocio', telefone_conjuge='$telefoneconjuge', data_casamento='$datacasamento', celular_socio='$celularsocio', cep_socio='$cepsocio', endereco_socio='$enderecosocio', numero_end_socio='$numeroendsocio', bairro_socio='$bairrosocio', complemento_socio='$complementosocio', cidade_socio='$cidadesocio', estado_socio='$estadosocio', nome_socio='$nomesocio', classif_socio='$classifsocio', id_ri_socio='$idrisocio', data_admissao='$dataadmissao', padrinho='$padrinho', rg_socio='$rgsocio', cpf_socio='$cpfsocio', data_nascto_socio='$datanasctosocio', conjuge='$conjuge', data_nascto_conjuge='$datanasctoconjuge', email_socio='$emailsocio', telefone_socio='$telefonesocio', mensalidade_ref='$referenciamensalidadesocio', mensalidade_valor='$valormensalidadesocio', mensalidade_diavenc='$vencimentomensalidadesocio', mensalidade_vencimento='$primeiromensalidadesocio' WHERE id_socio='$idsoc';";
}else{
	$sql = "UPDATE rfs_socios SET imagem = '$dirfoto', sexo = '$sexo', categoria_socio='$categoriasocio', telefone_conjuge='$telefoneconjuge', data_casamento='$datacasamento', celular_socio='$celularsocio', cep_socio='$cepsocio', endereco_socio='$enderecosocio', numero_end_socio='$numeroendsocio', bairro_socio='$bairrosocio', complemento_socio='$complementosocio', cidade_socio='$cidadesocio', estado_socio='$estadosocio', nome_socio='$nomesocio', classif_socio='$classifsocio', id_ri_socio='$idrisocio', data_admissao='$dataadmissao', padrinho='$padrinho', rg_socio='$rgsocio', cpf_socio='$cpfsocio', data_nascto_socio='$datanasctosocio', conjuge='$conjuge', data_nascto_conjuge='$datanasctoconjuge', email_socio='$emailsocio', telefone_socio='$telefonesocio', mensalidade_ref='$referenciamensalidadesocio', mensalidade_valor='$valormensalidadesocio', mensalidade_diavenc='$vencimentomensalidadesocio', mensalidade_vencimento='$primeiromensalidadesocio' WHERE id_socio='$idsoc';";
}

foreach($nomefilho2 as $ke => $name2){
$sql .= "INSERT INTO rfa_socios_filhos (nome_filho, data_nascto_filho, id_socio) VALUES ('$name2', '$datanasctofilho2[$ke]', '$cod');";
}

foreach($nomefilho as $key => $name){
$sql .= "UPDATE rfa_socios_filhos SET nome_filho='$name', data_nascto_filho='$datanasctofilho[$key]' WHERE id_filho='$idfilho[$key]';";
}

	
if ($link->multi_query($sql) === TRUE) {
	move_uploaded_file($tempfoto,$dirfoto);
		echo "<script>javascript:alert('Edição de sócio realizada com sucesso!');javascript:window.location='socios.php'</script>";
	
	} else {
		echo "Error: " . $sql . "<br>" . $link->error;
	}

	$link->close();

?>