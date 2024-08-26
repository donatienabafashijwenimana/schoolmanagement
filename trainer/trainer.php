<?php
session_start();
include '../php/connect.php';

if (!isset($_SESSION['role']) || !isset($_SESSION['id']) || $_SESSION['role']!="TRAINER") {
    header("location:../index/login.php?!");
}


$select1 = $conn->query("select module.module_code,module.module_name,trade.trede_id,trade.trede_name,level.lname,trainer.tr_fname,trainer.tr_lname from mod_trade_tr,level,trade,module,trainer where module.module_code=mod_trade_tr.module_code and trade.trede_id=mod_trade_tr.trede_id and trainer.tr_id=mod_trade_tr.tr_id and level.l_id=trade.l_id and trainer.tr_id='{$_SESSION['id']}'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="../css/trainer.css">
</head>
<body>
    
       <?php
         include '../hrf/header.php';
       ?><div class="body">
            <div class="left-menu">
                
            </div>
            <div class="right-menu">
                <?php
                if (mysqli_num_rows($select1)>0) { ?>
                 
                    <table border="1" id="tab1" width="40%">
                            <thead>
                                <td>choose class to view marks</td>
                            </thead>
                            <?php
                        foreach($select1 as $data){
                            ?><tr>
                                <td><?=$data['lname'].$data['trede_name'];?>--<?=$data['module_name'];?></td>
                                <td><a href="?tradeid=<?=$data['trede_id']?>&leasson=<?=$data['module_code']?>"> view marks</a></td>
                                
                            </tr>
                            <?php
                            }    
                            
                        ?>
                </table><?php }else{
                        echo"no module you assigned";
                    }?>
                <div class="marks">
                    <?php
                    if(isset($_GET['tradeid'])){
                        $_SESSION['tradeid']=$_GET['tradeid']." ";
                        $_SESSION['leasson']=$_GET['leasson'];
                        $selectstudent= $conn->query("select trainee.t_id, trainee.fname,trainee.lname,trade.trede_id,level.lname as level,trade.trede_name from trainee,trade,level where trade.l_id=level.l_id and trainee.trade_id=trade.trede_id and trade.trede_id='{$_SESSION['tradeid']}'");

                        

                      if ($a=mysqli_num_rows($selectstudent)>0) {
                        $selectmarks = $conn->query("select sum(distinct overmarks) as overmarks  from result where trede_id='{$_SESSION['tradeid']}' and module_code='{$_SESSION['leasson']}' ");
                        $omarks =  mysqli_fetch_array($selectmarks);
                        ?>
                        <table  width='100%' id="tabm">
                            <form action="insert.php" method="post">
                            <thead>
                                <td>student name</td>
                                <td colspan="2" id="m">marks/<?=$omarks['overmarks']?>
                                    <div class="btn">
                                       <span id="add">&plus;</span>
                                       <img src="../icon/printer.png" id="printt">
                                    </div>
                                </td>
                                <td class='inp'>
                                    <div class="input">
                                        
                                        <input type="text" name="mtype" placeholder="marks type"><br>
                                        <input type="number" name="overmarks" placeholder="over marks" id="ovmarks">
                                        
                                        <input type="hidden" name="leasson" value="<?=$row['module_code'];?>">
                                    </div>
                                </td>
                            </thead>
                        <?php
                        foreach($selectstudent as $row){
                            $selectmarks = $conn->query("select sum(marks) from result where t_id='{$row['t_id']}' and module_code='{$_SESSION['leasson']}' ");
                            $mark1= mysqli_fetch_array($selectmarks);
                            ?>
                            <tr>
                                <td><?=$row['fname']." ".$row['lname'];?></td>
                                <td colspan="1"><?=$mark1['sum(marks)'];?></td>
                                  
                                    <td class='inp'>
                                        <input type="hidden" name="studentid[]" value="<?=$row['t_id']?>">
                                         <input type="number" name="marks[]" id="marks[]">
                                         <small class="errormarks"></small>
                                    </td>
                                 
                            </tr>
                            <?php
                        }
                        ?>
                    <td colspan="3" border='0' class='inp'>
                        <input type="submit" name="record" value="record">
                        <label class="cansel">cancel</label>
                     </td>   
                    </form></table>
                        <?php
                      }else{
                        echo"<h1>!!!no student we have in our class</h1>";
                      }

                    }else echo "<h1>!!!choose class to view and record marks</h1>";
                    ?>
                </div>
            </div>
        </div>
        <?php  include('../hrf/footer.php');?>
</body>


</html>
<script src="../js/jquery-3.6.3.js"></script>
<script src="../js/jstrainer.js"></script>
<script>
    let userinfo = document.querySelector(".userrole");
    userinfo.innerHTML="<?=$_SESSION['username'].'/'.$_SESSION['role']?>"

</script>