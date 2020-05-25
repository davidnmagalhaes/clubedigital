<?php 
    /*
    *   JQUERY AJAX FILTER TABLE [UPDATED]
    *
    *   THANKS FOR WATCHING AND
    *   SUBSCRIBE ME FOR MORE VIDEOS LIKE THIS
    *   https://www.youtube.com/amankharbanda14
    *
    *   FOLLOW ME / SUBSCRIBE ME ON FOLLOWING SOCIAL LINKS
    *   https://goo.gl/8Ep9e6
    *   https://goo.gl/MXPcdx
    *   https://goo.gl/V1iugX
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax Filter table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            function create_list(data){
                var table = $('#table');
                table.html('');
                var table_head = $('<tr>');
                table_head.append($('<th>').text('ID'))
                
                table_head.append($('<th>').text('Type'))
                table.append(table_head);
                for(var x in data){
                    var tr = $('<tr>');
                    tr.append($('<td>').text(data[x].id));
                   
                    tr.append($('<td>').int(data[x].type));
                    table.append(tr);
                };
            }
            $.ajax({
                url:'fetch.php?filter=all',
                type:'GET',
                success:function(data){
                    var d = JSON.parse(data);
                    create_list(d);
                }
            })
            $('#filter').on('change',function(){
                var filter = $(this).val();
                $.ajax({
                url:'fetch.php?filter='+filter,
                type:'GET',
                success:function(data){
                    var d = JSON.parse(data);
                    create_list(d);
                }
            })
            })
        })
    </script>
    <style>
        .checkbox {
            margin-right : 5px;
            font-size:16px;

        }
        input[type="checkbox"]{
            margin-right : 5px;
        }
        table {
            margin-top:10px;
        }
        table tr {
            border-bottom: 1px solid #ddd;
        }
        table tr th {
            text-transform:uppercase;
            padding:5px 10px;
        }
        table tr td {
            padding:5px 10px;
        }
        table tr:nth-child(odd){
            background:#eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
           <h1> Jquery Ajax Filter</h1>
        </div>

    </div>
    <div class="container">
        <div class="col-md-8 col-md-offset-2">

            <select id="filter">
            
                <option value="all" name="" >All </option>
                <option value="1"  >Intern</option>
                <option value="2"  >employee</option>
                <option value="temp"  >temp</option>
            </select>
        </div>
        <div class="col-md-8 col-md-offset-2" >
            <table class="table table-striped" id="table">

            </table>
        </div> 
    </div>
</body>
</html>