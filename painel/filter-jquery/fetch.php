<?php 
    if(isset($_GET['filter'])){
        $filter = trim($_GET['filter']);
        if(!empty($_GET['filter'])){
            $con = mysqli_connect('db_volvo.mysql.dbaas.com.br','db_volvo','Afe159753@Volv','db_volvo');
            if($filter == 'all'){
                $stmnt = $con->prepare('select * from rfa_receber');
            }else {
                $stmnt = $con->prepare('select * from rfa_receber where status_receber=?');
                $stmnt->bind_param('s',$filter);
            };
            $stmnt->execute();
            $stmnt->store_result();
            $stmnt->bind_result($id,$type);
            $final = array();
            while($stmnt->fetch()){
                $each = array(
                    'id'=>$id,
                    
                    'type'=>$type
                );
                array_push($final,$each);
            };
            echo json_encode($final);
            $stmnt->close();
            $con->close();
        };
    };
?>