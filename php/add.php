<?php
session_start();
include 'connect.php';

if(isset($_POST['addtrade'])){
    $select1= $conn->query("select*from trade where trede_name='{$_POST['t_name']}' and l_id='{$_POST['level']}' and dept_id='{$_POST['department']}'");
    if (mysqli_num_rows($select1)==0) {
        $insert = $conn->query("insert into trade values(null,'{$_POST['t_name']}','{$_POST['department']}','{$_POST['level']}')");
        if($insert==true){
            echo"<script>
            alert('this trade added')
            window.location.href='trade.php'
        </script>";
            
            
        }else{
        echo"<script>
        alert('this trade not added')
        window.location.href='trade.php'
        </script>";
        
        }
    }else{
        echo"<script>
        alert('this trade exist')
        window.location.href='trade.php'
        </script>";
        
    }
}

if(isset($_POST['addlevel'])){
    $select1= $conn->query("select*from level where lname='{$_POST['l_name']}'");
    if (mysqli_num_rows($select1)==0 or !empty($_POST['l_name'])) {
        $insert = $conn->query("insert into level values(null,'{$_POST['l_name']}')");
        if($insert==true){
            echo "level added";
        }else{
        echo('this level not added');
        
        }
    }else{
        echo('this this exist');
    }
}
?>
