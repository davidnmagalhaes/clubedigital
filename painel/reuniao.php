<?php
$page = 6;

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

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
	
	<!-- Vendor CSS-->
    
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

   

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

<link rel="stylesheet" href="calendario/fullcalendar.css" />
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  
  <script src="calendario/fullcalendar.js"></script>
	<script src='calendario/locale/pt-br.js'></script>

 <script>
  
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'calendario/load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Digite um nome para a reunião");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
	  var clube = document.getElementById("clube").value;
      $.ajax({
       url:"calendario/insert.php",
       type:"POST",
       data:{title:title, start:start, end:end, clube:clube},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Reunião criada com sucesso!");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
	 var clube = document.getElementById("clube").value;
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"calendario/update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id, clube:clube},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Reunião alterada com sucesso!');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
	 var clube = document.getElementById("clube").value;
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"calendario/update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id, clube:clube},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Reunião alterada com sucesso!");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Tem certeza que deseja cancelar a reunião?"))
     {
      var id = event.id;
      $.ajax({
       url:"calendario/delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Reunião cancelada!");
		
       }
      });
     }
    },

   });
  });
   
  </script>

</head>

<body >

    <div class="page-wrapper">
	
        <?php include("menu-desktop.php");?>

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
			<?php include("topo.php");?>
            
            
			<?php include("menu-mobile.php");?>
			
            <!-- END HEADER DESKTOP-->

    <input type="hidden" id="clube" value="<?php if($_GET['clube']){echo $clube;}else{echo $clube;}?>">        
 <div class="main-content">
            <div class="col-lg-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="fas fa-handshake"></i>Reuniões <a href="cd_pauta.php<?php if($_GET['clube']){echo '?clube='.$clube;}?>" class="btn btn-success"><i class="fas fa-plus" style="margin-left: 10px"></i> Pauta de Reunião</a>
										</h3>
                                   
						
                                    <div style="margin-bottom: 80px">
									
									 <div class="container">
   <div id="calendar"></div>
  </div>
                                       </div>
					
                                    
                                </div>
                                <!-- END USER DATA-->
                            </div>
</div>
            

            <?php include("footer.php"); ?>
			
            
            <!-- END PAGE CONTAINER-->
        </div>

    </div>


   
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->