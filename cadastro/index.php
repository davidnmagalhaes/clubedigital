<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cadastre-se | Clube Digital</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Clube Digital">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="vendor/date-picker/css/datepicker.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
		<script src="https://kit.fontawesome.com/13f03eba23.js" crossorigin="anonymous"></script>

		<script type="text/javascript">
			function fMasc(objeto,mascara) {
				obj=objeto
				masc=mascara
				setTimeout("fMascEx()",1)
			}
			function fMascEx() {
				obj.value=masc(obj.value)
			}
			function mTel(tel) {
				tel=tel.replace(/\D/g,"")
				tel=tel.replace(/^(\d)/,"($1")
				tel=tel.replace(/(.{3})(\d)/,"$1)$2")
				if(tel.length == 9) {
					tel=tel.replace(/(.{1})$/,"-$1")
				} else if (tel.length == 10) {
					tel=tel.replace(/(.{2})$/,"-$1")
				} else if (tel.length == 11) {
					tel=tel.replace(/(.{3})$/,"-$1")
				} else if (tel.length == 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				} else if (tel.length > 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				}
				return tel;
			}
			function mCNPJ(cnpj){
				cnpj=cnpj.replace(/\D/g,"")
				cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
				cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
				cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
				cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
				return cnpj
			}
			function mCPF(cpf){
				cpf=cpf.replace(/\D/g,"")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
				return cpf
			}
			function mCEP(cep){
				cep=cep.replace(/\D/g,"")
				cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
				cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
				return cep
			}
			function mNum(num){
				num=num.replace(/\D/g,"")
				return num
			}
			
			
			
			
		</script>

		<script>
function somenteNumeros(e) {
        var charCode = e.charCode ? e.charCode : e.keyCode;
        // charCode 8 = backspace   
        // charCode 9 = tab
        if (charCode != 8 && charCode != 9) {
            // charCode 48 equivale a 0   
            // charCode 57 equivale a 9
            if (charCode < 48 || charCode > 57) {
                return false;
            }
        }
    }
</script>

  <script src='https://www.google.com/recaptcha/api.js'></script>

	<style>
		.estado option{
			color:#469afb;
		}
	</style>

	</head>
	<body>
		
		<div class="wrapper">
			<div class="image-holder">
				<img src="images/form-wizard.png" alt="">
			</div>
            <form action="index.php" method="post" id="formulario" name="formulario">
            	<div class="form-header">
            	
            		<h3>Torne seu clube mais digital!</h3>
            	</div>
            	<div id="wizard">
            		<!-- SECTION 1 -->
	                <h4></h4>
	                
	                <section>
	                	<p style="text-align:center; margin-bottom: 35px"><strong style="color: #276b80; font-size: 20px">Promoção de Lançamento!</strong><br>Período de avaliação durante 3 meses! </p>
	                	<div class="form-row">
	                    	<label for="">
	                    		Nome do clube:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control" name="nomeclube" required>
	                    	</div>
	                    </div>
	                    <div class="form-row" style="margin-bottom: 26px">
	                    	<label for="">
	                    		E-mail do clube:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="email" class="form-control" name="emailclube" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row">
	                    	<label for="">
	                    		Telefone do clube:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control" name="telclube" maxlength="14" onkeydown="javascript: fMasc( this, mTel );" required>
	                    	</div>
	                    </div>	
	                   
	                    <!--<div class="form-row">
	                    	<label for="">
	                    		Preferred System:
	                    	</label>
	                    	<div class="form-holder">
	                    		<select name="" id="" class="form-control">
									<option value="canvas" class="option">Canvas</option>
									<option value="svg" class="option">Svg</option>
								</select>
								<i class="zmdi zmdi-caret-down"></i>
	                    	</div>
	                    </div>
	                    <div class="form-row">
	                    	<label for="">
	                    		College / Department:
	                    	</label>
	                    	<div class="form-holder">
	                    		<select name="" id="" class="form-control">
									<option value="florida" class="option">University of Florida</option>
									<option value="havard" class="option">University of Havard</option>
									<option value="oxford" class="option">University of Oxford</option>
								</select>
								<i class="zmdi zmdi-caret-down"></i>
	                    	</div>
	                    </div>	
	                    <div class="form-row">
	                    	<label for="">
	                    		Term:
	                    	</label>
	                    	<div class="form-holder">
	                    		<select name="" id="" class="form-control">
	                    			<option value="" selected disabled>Select Term</option>
									<option value="term 1" class="option">Term 1</option>
									<option value="term 2" class="option">Term 2</option>
									<option value="term 3" class="option">Term 3</option>
								</select>
								<i class="zmdi zmdi-caret-down"></i>
	                    	</div>
	                    </div>	-->	
	                    		
	                </section>
	                
					<!-- SECTION 2 -->
	                <h4></h4>
	                <section>
	                   	<p style="text-align:center; margin-bottom: 35px"><strong style="color: #276b80; font-size: 20px">Endereço do Clube</strong></p>
	                    <div class="form-row">
	                    	<label for="">
	                    		CEP:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control" name="cepclube" onkeypress="return somenteNumeros(event)" maxlength="8" name="cep" id="cep" required>
	                    	</div>
	                    </div>
	                    <div class="form-row">
	                    	<label for="">
	                    		Endereço:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control" name="enderecoclube" id="endereco" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row" style="margin-bottom: 3.4vh">
	                    	<label for="">
	                    		Número:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control" name="numeroclube" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row" style="margin-bottom: 3.4vh">
	                    	<label for="">
	                    		Bairro:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control" name="bairroclube" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row" style="margin-bottom: 3.4vh">
	                    	<label for="">
	                    		Cidade:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control" name="cidadeclube" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row">
	                    	<label for="">
	                    		Estado:
	                    	</label>
	                    	<div class="form-holder">
	                    		<select name="estadoclube" id="estado" class="form-control estado">
	                    			<option value="" selected disabled>Selecione um estado</option>
									<option value="AC">Acre</option>
								    <option value="AL">Alagoas</option>
								    <option value="AP">Amapá</option>
								    <option value="AM">Amazonas</option>
								    <option value="BA">Bahia</option>
								    <option value="CE">Ceará</option>
								    <option value="DF">Distrito Federal</option>
								    <option value="ES">Espírito Santo</option>
								    <option value="GO">Goiás</option>
								    <option value="MA">Maranhão</option>
								    <option value="MT">Mato Grosso</option>
								    <option value="MS">Mato Grosso do Sul</option>
								    <option value="MG">Minas Gerais</option>
								    <option value="PA">Pará</option>
								    <option value="PB">Paraíba</option>
								    <option value="PR">Paraná</option>
								    <option value="PE">Pernambuco</option>
								    <option value="PI">Piauí</option>
								    <option value="RJ">Rio de Janeiro</option>
								    <option value="RN">Rio Grande do Norte</option>
								    <option value="RS">Rio Grande do Sul</option>
								    <option value="RO">Rondônia</option>
								    <option value="RR">Roraima</option>
								    <option value="SC">Santa Catarina</option>
								    <option value="SP">São Paulo</option>
								    <option value="SE">Sergipe</option>
								    <option value="TO">Tocantins</option>
								    <option value="EX">Estrangeiro</option>
								</select>
								<i class="zmdi zmdi-caret-down"></i>
	                    	</div>
	                    </div>
	                    		
	                </section>

	                <!-- SECTION 3 -->
	                <h4></h4>
	                <section>
	                	<p style="text-align:center; margin-bottom: 35px"><strong style="color: #276b80; font-size: 20px">Presidente do Clube</strong></p>
	                	<div class="form-row" style="margin-bottom: 3.4vh">
	                    	<label for="">
	                    		Nome do Presidente:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control" name="presidenteclube" required>
	                    	</div>
	                    </div>	
	                	 <div class="form-row">
	                    	<label for="">
	                    		Data de Nascimento:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control datepicker-here" data-language='en' data-date-format="dd/mm/yyyy" id="dp1" name="nascto">
	                    	</div>
	                    </div>
	                    <div class="form-row" style="margin-bottom: 50px;">
	                    	<label for="">
	                    		Gênero:
	                    	</label>
	                    	<div class="form-holder">
	                    		<div class="checkbox-circle">
									<label class="male">
										<input type="radio" name="genero" value="m" checked required> Masculino<br>
										<span class="checkmark"></span>
									</label>
									<label class="female">
										<input type="radio" name="genero" value="f" required> Feminino<br>
										<span class="checkmark"></span>
									</label>
									
								</div>
	                    	</div>
	                    </div>
	                    <div class="form-row">
	                    	<label for="">
	                    		Senha:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="password" class="form-control" name="senha">
	                    	</div>
	                    </div>	

	                    <div class="form-row">
	                    	<label for="">
	                    		Onde nos conheceu?
	                    	</label>
	                    	<div class="form-holder">
	                    		<select name="origemclube" id="origem" class="form-control estado" required>
	                    			<option value="" selected disabled>Selecione a origem</option>
									<option value="Google">Google</option>
								    <option value="Amigo">Amigo</option>
								    <option value="Redes Sociais">Redes Sociais</option>
								    <option value="Palestra">Palestra</option>
								    <option value="Outros">Outros</option>
								</select>
								<i class="zmdi zmdi-caret-down"></i>
	                    	</div>
	                    </div>

	                    <div class="form-row">
	                    	
	                    	<div class="form-holder">
	                    		<div class="g-recaptcha custom-recaptcha" data-sitekey="6LfPJOoUAAAAAP_Z6aYEp7sbzZbWInoG-2-7JzTs"></div>
	                    	</div>
	                    </div>	

	                    
	                    
	                    <div class="checkbox-circle" style="margin-bottom: 48px;">
							<label>
								<input type="checkbox" checked>Eu concordo com os termos e condições
								<span class="checkmark"></span>
							</label>
						</div>
	                </section>

	                
	                
            	</div>
            </form>
		</div>

		<script type="text/javascript">
		
		$("#cep").focusout(function(){
			$.ajax({
				url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
				dataType: 'json',
				success: function(resposta){
					$("#endereco").val(resposta.logradouro);
					$("#complemento").val(resposta.complemento);
					$("#bairro").val(resposta.bairro);
					$("#cidade").val(resposta.localidade);
					$("#estado").val(resposta.uf);
					$("#numero").focus();
					//document.getElementById("endereco").style.display = "block";
				}
			});
		});
		</script>
		<script src="js/jquery-3.3.1.min.js"></script>
		
		<!-- JQUERY STEP -->
		<script src="js/jquery.steps.js"></script>

		<!-- DATE-PICKER -->
		<script src="vendor/date-picker/js/datepicker.js"></script>
		<script src="vendor/date-picker/js/datepicker.en.js"></script>

		<script src="js/main.js"></script>
<!-- Template created and distributed by Colorlib -->
</body>
</html>