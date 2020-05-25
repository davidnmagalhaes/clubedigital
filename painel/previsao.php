<?php
$page = 3;

include('config-header.php');

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
    
<style>
#fd{
  font-weight: 300;
    color: #fff;
    font-size: 26px;
    line-height: 1;
    margin-bottom: 5px;
    margin-top: 20px;
}
#sd{
  font-weight: 300;
    color: #fff;
    font-size: 26px;
    line-height: 1;
    margin-bottom: 5px;
    margin-top: 20px;
}
.button-calc {
  height: 50px;
  width: 21%;
  margin: 10px 4px;
  box-shadow: inset 1px 1px 50px  #0066FF;
  border: none !important;
}
*:focus {
    outline: 0 !important;
}
#allClear {
  box-shadow: inset 1px 1px 50px  #990000;
  border: none;
}
#clear {
  box-shadow: inset 1px 1px 50px  #CC6600;
  border: none;
}
#equals{
  box-shadow: inset 1px 1px 50px #006633;
  border: none;
}
/* Hidden button for formatting sake */
#blank {
  visibility: hidden;
}
.calcBG {
  width: 280px;
  background-color: #333333;
  border-radius: 20px;
  padding: 20px;
  margin-top: 50px;
  margin-bottom: 50px;
  box-shadow: inset 1px 1px 50px #000;
  margin: 1vh auto;
}
.screen {
  height: 40px;
  border-radius: 10px;
  padding: 10px;
  margin: 10px 2px;
  font-size: 16px;
  font-weight: bold;
  

background: #8e9eab; /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #8e9eab , #eef2f3); /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #8e9eab , #eef2f3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        
  box-shadow: 0px 4px  #FFF inset;
  
}
small {
  color: #fff;
  font-weight: bold;
}

</style>



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

 <script>
   document.addEventListener("DOMContentLoaded", function() {
  function troca(){
    var valFund = document.querySelector("#fundofinal");
      var saldIni = document.querySelector("#saldini");
      var fundotroca = document.querySelector("#fundotroca");
      valFund.value = saldIni.value;
      var fundotroca = document.querySelector("#fundotroca");
      document.getElementById(fundotroca).innerHTML = valFund.value;
      
  }
});
      

 </script>

</head>

<body>

    <div class="page-wrapper">
    
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->

         

            <?php include("topo.php");?>
            
            
            <?php include("menu-mobile.php");?>
            
            <!-- END HEADER DESKTOP-->

            

            <?php include("previsao-page.php"); ?>

            

            <?php include("footer.php"); ?>
            
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

<script>
    // Determines button clicked via id
function myFunction(id) {
  document.calc.result.value+=id;
}

// Clears calculator input screen
function clearScreen() {
  document.calc.result.value="";
}

// Calculates input values
function calculate() {
  try {
    var input = eval(document.calc.result.value);
    document.calc.result.value=input;
  } catch(err){
      document.calc.result.value="Error";
    }
}
</script>

    <?php include("scripts-footer.php"); ?>

</body>

</html>
<!-- end document-->