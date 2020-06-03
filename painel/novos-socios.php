<?php
$page = 5;

include('config-header.php');

//Seleciona todos os sócios representativos
$qr = "SELECT * FROM rfa_socios_novos INNER JOIN rfs_socios ON rfa_socios_novos.id_padrinho=rfs_socios.id_ri_socio WHERE rfa_socios_novos.clube='$clube' AND rfa_socios_novos.status_novo=0 ORDER BY rfa_socios_novos.data_novo, rfa_socios_novos.hora_novo DESC";
$lis = mysqli_query($link, $qr) or die(mysqli_error($link));
$totalRows_lis = mysqli_num_rows($lis);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestão do Rotary Fortaleza Alagadiço">
    <meta name="author" content="David Magalhães">
    <meta name="keywords" content="rotary alagadiço, rotary fortaleza alagadiço, fortaleza alagadiço">


    <title>Rotary Fortaleza Alagadiço</title>

    <?php include("head.php");?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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

	

<script language="JavaScript" type="text/javascript">

$(document).ready(function(){
    $("a.exclui").click(function(e){
        if(!confirm('Tem certeza que deseja excluir este socio(a)?')){
            e.preventDefault();
            return false;
        }

        return true;
    });
});
</script>



 <script type="text/javascript">
    function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
        img.src = 'http://granjasaojorge.com.br/img/loading1.gif';
        div.innerHTML = "";
        div.style.cssText = 'position: fixed; top: 20%; left: 40%; z-index: 5000; width: 200px; text-align: center;';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
        // These 2 lines cancel form submission, so only use if needed.
        //window.event.cancelBubble = true;
        //e.stopPropagation();
    }
</script>

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}


.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</head>

<body id="corpo">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <div class="page-wrapper">
	 
        <?php include("menu-desktop.php");?>

        <div class="page-container2">

			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>

            
 <div class="main-content">
            <div class="col-lg-12">
                              
                                <div class="user-data m-b-30">
                                    
										
								
									<h3 class="title-3 m-b-30">
                                        <i class="fas fa-user-friends"></i>Novos pedidos de associação
									</h3>
										
<br>
<!---->
											
									<input type="hidden" name="user" value="<?php echo $_SESSION['id_usuario'];?>">	
									<input type="hidden" name="club" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">
									
                                   
                                    <div class="table-responsive ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>Data</td>
                                                    <td>Nome</td>
													<td>Padrinho</td>
													
                                                    <td>E-mail</td>
													<td>Telefone</td>
													<td>CPF</td>
                          <td>Ativo?</td>

                                                    <td colspan="3" align="center"><?php echo "<strong style='margin-right: 5px; color: #ff0000;'>Total de pedidos: </strong>".$totalRows_lis;?></td>
													
                                                </tr>
                                            </thead>
                                            <tbody>
										
											
											<?php if($totalRows_lis <= 0){}else{?>
											<?php while($row_lis = mysqli_fetch_array($lis)){ ?>

                        <!-- Informações -->
<div class="modal fade" id="exibeinfo<?php echo $row_lis['id_novo'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informações da solicitação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Data do Pedido:</strong> <?php echo date('d/m/Y',strtotime($row_lis['data_novo']))." às ".$row_lis['hora_novo'];?><br><Br>
        <strong>Nome:</strong> <?php echo $row_lis['nome_novo'];?><br>
        <strong>Padrinho:</strong> <?php echo $row_lis['nome_socio'];?><br>
        <strong>E-mail:</strong> <?php echo $row_lis['email_novo'];?><br>
        <strong>RG:</strong> <?php echo $row_lis['rg_novo'];?><br>
        <strong>CPF:</strong> <?php echo $row_lis['cpf_novo'];?><br>
        <strong>Data de Nascto.:</strong> <?php echo date('d/m/Y',strtotime($row_lis['nascto_novo']));?><br>
        <strong>CEP:</strong> <?php echo $row_lis['cep_novo'];?><br>
        <strong>Endereço:</strong> <?php echo $row_lis['endereco_novo'];?><br>
        <strong>Número:</strong> <?php echo $row_lis['numero_novo'];?><br>
        <strong>Bairro:</strong> <?php echo $row_lis['bairro_novo'];?><br>
        <strong>Cidade:</strong> <?php echo $row_lis['cidade_novo'];?><br>
        <strong>Estado:</strong> <?php echo $row_lis['estado_novo'];?><br>
        <strong>Telefone:</strong> <?php echo $row_lis['telefone_novo'];?><br>
        <strong>Profissão:</strong> <?php echo $row_lis['profissao_novo'];?><br><br>
        <h3>Cônjuge</h3><br>
        <strong>Nome do cônjuge:</strong> <?php echo $row_lis['nomeconjuge_novo'];?><br>
        <strong>Data do Casamento:</strong> <?php echo date('d/m/Y',strtotime($row_lis['datacasamento_novo']));?><br>
        <strong>Data de Nascto. Cônjuge:</strong> <?php echo date('d/m/Y',strtotime($row_lis['nasctoconjuge_novo']));?><br>
        <Br>
        <h3>Filhos</h3><br>
        <?php 
        $soc = $row_lis['ref_novo'];
        $qra = "SELECT * FROM rfa_socios_novos_filhos WHERE clube='$clube' AND id_socio='$soc'";
        $lisa = mysqli_query($link, $qra) or die(mysqli_error($link));
        $row_lisa = mysqli_fetch_array($lisa);

        foreach($lisa as $exibefilhos){
          echo "<strong>Nome do filho:</strong> ".$exibefilhos['nome_filho']."<br><strong>Data de Nascimento:</strong> ".date('d/m/Y',strtotime($exibefilhos['nascto_filho']))."<br><br>";
        }

        ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

                                                <tr>
                                                     <td>
                                                        <div class="table-data__info">
                                                            <h6><?php echo date('d/m/Y',strtotime($row_lis['data_novo']));?></h6>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?php echo $row_lis['nome_novo'];?></h6>
                                                            
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?php echo $row_lis['nome_socio'];?></h6>
                                                            
                                                        </div>
                                                    </td>
													<td>
                                                        <div class="table-data__info">
                                                           
                                                            <span class="block-email">
                                                               <a href="mailto:<?php echo $row_lis['email_novo'];?>"><?php echo $row_lis['email_novo'];?></a>
                                                            </span>
                                                        </div>
                                                    </td>
													
                                                    <td>
														<span class="block-email">
                                                               <?php echo $row_lis['telefone_novo'];?>
                                                          </span>
													</td>
                                                    <td>
                                                        <span class="block-email">
                                                             <?php echo $row_lis['cpf_novo'];?>
                                                          </span>
                                                    </td>
													

                                                    

                                                    <td style="text-align:center" >
                                                        <form action="status-pedido-socio.php" method="POST" id="form<?php echo $row_lis['id_novo'];?>b" runat="server" onsubmit="ShowLoading()"> 
                                                       <input type="checkbox" <?php if($row_lis['status_novo'] == 1){echo "checked";}else{} ?> data-toggle="toggle" onChange="document.forms['form<?php echo $row_lis['id_novo'];?>b'].submit();" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" name="statussocio" value="<?php if($row_lis['status_novo'] == 1){echo "0";}else{echo "1";} ?>">
                                                       <input type="hidden" name="id_socio" value="<?php echo $row_lis['id_novo'];?>">
                                                       <input type="hidden" name="clube" value="<?php echo $clube;?>">
                                                        </form>
                                                    </td>
													
                                                    <td>
                                                       <a href="#" data-toggle="modal" data-target="#exibeinfo<?php echo $row_lis['id_novo'];?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    
													<td>
                                                       <a href="excluir-pedido-socio.php?id_novo=<?php echo $row_lis['id_novo'];?><?php if($_GET['clube']){echo '&clube='.$clube;}?>" class="exclui">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </td>
													
                                                </tr>
												
												

											<?php }?>
											<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
								 
                                </div>
                                
                            </div>
</div>
            

            <?php include("footer.php"); ?>
			
            
          
        </div>

    </div>
	

    <?php include("scripts-footer.php"); ?>
	
	

</body>

</html>
