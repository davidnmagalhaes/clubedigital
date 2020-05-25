<div class="modal fade " id="exampleModal<?php echo $row_lis['id_socio'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="zmdi zmdi-money-box" style="margin-right: 15px;"></i> REALIZAR PAGAMENTO DE MENSALIDADE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
	  
	  
	  <?php 
		$idsocio = $row_lis['id_socio'];
		$mescadastro = date('m',strtotime($row_lis['mensalidade_vencimento']));
		$anocadastro = date('Y',strtotime($row_lis['mensalidade_vencimento']));
		
		$mesjan = 1;
		$mesfev = 2;
		$mesmar = 3;
		$mesabr = 4;
		$mesmai = 5;
		$mesjun = 6;
		$mesjul = 7;
		$mesago = 8;
		$messet = 9;
		$mesout = 10;
		$mesnov = 11;
		$mesdez = 12;
		
		$mesatual = date('m');
		$ano = date('Y');
		$hoje = date('Y-m-d');
		
		//Query de Janeiro
	    $queryjan = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesjan' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$jan = mysqli_query($link, $queryjan) or die(mysqli_error($link));
		$row_jan = mysqli_fetch_assoc($jan);
		$totalRows_jan = mysqli_num_rows($jan);
		
		//Query de Fevereiro
	    $queryfev = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesfev' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$fev = mysqli_query($link, $queryfev) or die(mysqli_error($link));
		$totalRows_fev = mysqli_num_rows($fev);
		
		//Query de Março
	    $querymar = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesmar' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$mar = mysqli_query($link, $querymar) or die(mysqli_error($link));
		$totalRows_mar = mysqli_num_rows($mar);
		
		//Query de Abril
	    $queryabr = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesabr' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$abr = mysqli_query($link, $queryabr) or die(mysqli_error($link));
		$totalRows_abr = mysqli_num_rows($abr);
		
		//Query de Maio
	    $querymai = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesmai' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$mai = mysqli_query($link, $querymai) or die(mysqli_error($link));
		$totalRows_mai = mysqli_num_rows($mai);
		
		//Query de Junho
	    $queryjun = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesjun' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$jun = mysqli_query($link, $queryjun) or die(mysqli_error($link));
		$totalRows_jun = mysqli_num_rows($jun);
		
		//Query de Julho
	    $queryjul = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesjul' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$jul = mysqli_query($link, $queryjul) or die(mysqli_error($link));
		$totalRows_jul = mysqli_num_rows($jul);
		
		//Query de Agosto
	    $queryago = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesago' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$ago = mysqli_query($link, $queryago) or die(mysqli_error($link));
		$totalRows_ago = mysqli_num_rows($ago);
		
		//Query de Setembro
	    $queryset = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$messet' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$set = mysqli_query($link, $queryset) or die(mysqli_error($link));
		$totalRows_set = mysqli_num_rows($set);
		
		//Query de Outubro
	    $queryout = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesout' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$out = mysqli_query($link, $queryout) or die(mysqli_error($link));
		$totalRows_out = mysqli_num_rows($out);
		
		//Query de Novembro
	    $querynov = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesnov' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$nov = mysqli_query($link, $querynov) or die(mysqli_error($link));
		$totalRows_nov = mysqli_num_rows($nov);
		
		//Query de Dezembro
	    $querydez = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesdez' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$dez = mysqli_query($link, $querydez) or die(mysqli_error($link));
		$totalRows_dez = mysqli_num_rows($dez);
		
		//Query de consulta do status do pagamento do mês
	    $querypg = "SELECT * FROM rfa_pgto_mensalidades WHERE ref_socio='$idsocio' AND MONTH(mes_ref) = '$mesatual' AND YEAR(mes_ref) = '$ano' AND user='$user'";
		$pg = mysqli_query($link, $querypg) or die(mysqli_error($link));
		$totalRows_pg = mysqli_num_rows($pg);
		
	  ?>
	  
	  <div class="row">
	  <div class="col-12">
	  <p><strong>Sócio:</strong> <?php echo $row_lis['nome_socio'];?></p>
	  <p><strong>Dia do vencimento:</strong> <?php echo $row_lis['mensalidade_diavenc'];?></p>
	  <p><strong>Pagamento do mês:</strong> 
	  
	  		<?php if($totalRows_pg == 0){echo "<strong style='color: #ff0000;'>Pagamento não identificado</strong>";}else{echo "<strong style='color: #21b342;'>Pagamento identificado</strong>";}?>
	  
	  </p><br>
	  </div>
	  
	  </div>
	  
	  <div class="row alert alert-primary" role="alert">
		<div class="col">
		<strong>Jan</strong><br>
		<?php if($mescadastro > $mesjan && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_jan == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Fev</strong><br>
		<?php if($mescadastro > $mesfev && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_fev == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Mar</strong><br>
		<?php if($mescadastro > $mesmar && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_mar == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Abr</strong><br>
		<?php if($mescadastro > $mesabr && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_abr == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Mai</strong><br>
		<?php if($mescadastro > $mesmai && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_mai == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Jun</strong><br>
		<?php if($mescadastro > $mesjun && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_jun == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Jul</strong><br>
		<?php if($mescadastro > $mesjul && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_jul == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Ago</strong><br>
		<?php if($mescadastro > $mesago && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_ago == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Set</strong><br>
		<?php if($mescadastro > $messet && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_set == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Out</strong><br>
		<?php if($mescadastro > $mesout && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_out == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Nov</strong><br>
		<?php if($mescadastro > $mesnov && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_nov == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		<div class="col">
		<strong>Dez</strong><br>
		<?php if($mescadastro > $mesdez && $anocadastro >= $ano ){echo "-";}else{?>
		<?php if($totalRows_dez == 0){echo "<strong style='color: #ff0000;'>F</strong>";}else{echo "<strong style='color: #21b342;'>OK</strong>";}?>
		<?php }?>
		</div>
		
		
	  </div>
	  
        <form action="proc_pgto_mensalidade.php" method="post" name="formsocio" id="formsocio">
		<label for="message-text" class="col-form-label">Valor da parcela:</label>
		<div class="input-group mb-2">
		 
        <div class="input-group-prepend">
          <div class="input-group-text">R$</div>
        </div>
        <input type="text" class="form-control" name="valormens" id="recipient-name" value="<?php echo number_format($row_lis['mensalidade_valor'],2,',', '.');?>" tabindex="0" data-toggle="tooltip" title="A alteração deste valor não modificará a mensalidade base definida. Somente o valor do mês será alterado.">
      </div>
          
		  <div class="form-group" style="margin-top: 20px;">
		  
		  
			  <input class="form-check-input" type="radio" name="radios" id="exampleRadios1" value="manual" style="margin-left:0;" checked>
			  <label class="form-check-label" for="exampleRadios1" style="margin-left:25px;">
				Manual
			  </label>
		  
			  <input class="form-check-input" type="radio" name="radios" id="exampleRadios2" value="boleto" style="margin-left:10px;" >
			  <label class="form-check-label" for="exampleRadios2" style="margin-left:35px;">
				Boleto do mês
			  </label>
			  
			  <input class="form-check-input" type="radio" name="radios" id="exampleRadios2" value="boletosano" style="margin-left:10px;" >
			  <label class="form-check-label" for="exampleRadios2" style="margin-left:35px;">
				Boletos do ano
			  </label>
		  
		  </div>
		  
          <div class="form-group exibedatapagamento" ">
            <label for="message-text" class="col-form-label">Data de Pagamento:</label>
            <input type="date" name="datapagamento" class="form-control" tabindex="0" data-toggle="tooltip">
          </div>
		  
		  <div class="form-group">
            <label for="message-text" class="col-form-label">Referente ao vencimento:</label>
			<div class="row">
			<div class="col">
            <input type="text" name="diaref" class="form-control" placeholder="Dia (05)" tabindex="0" data-toggle="tooltip" title="Dia do Vencimento" value="<?php echo $row_lis['mensalidade_diavenc'];?>">
			</div>
			<div class="col">
			<select name="mesref" class="form-control" tabindex="0" data-toggle="tooltip" title="Mês do Vencimento">
				<option>Selecione o mês...</option>
				<option value="01">Janeiro</option>
				<option value="02">Fevereiro</option>
				<option value="03">Março</option>
				<option value="04">Abril</option>
				<option value="05">Maio</option>
				<option value="06">Junho</option>
				<option value="07">Julho</option>
				<option value="08">Agosto</option>
				<option value="09">Setembro</option>
				<option value="10">Outubro</option>
				<option value="11">Novembro</option>
				<option value="12">Dezembro</option>
			</select>
			</div>
			<div class="col">
			<select name="anoref" class="form-control" tabindex="0" data-toggle="tooltip" title="Ano do Vencimento">
				<option>Selecione o ano...</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				<option value="2021">2021</option>
				<option value="2022">2022</option>
				<option value="2023">2023</option>
				<option value="2024">2024</option>
				<option value="2025">2025</option>
			</select>
			
			</div>
			</div>
		  </div>
		  
		 <input type="hidden" name="user" class="form-control" value="<?php echo $_SESSION['id_usuario'];?>">
        <input type="hidden" name="idsocio" class="form-control" value="<?php echo $idsocio;?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">AVANÇAR</button>
      </div>
	  </form>
    </div>
  </div>
</div>