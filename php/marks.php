<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']=="DOS") header('location:../index/login.php');
$page='marks';
include 'connect.php';
include 'script.php';
$select = $conn->query("select trainee.fname,trainee.lname  as lastname,trade.trede_name,level.lname,
      module.module_name,result.marks,result.overmarks,result.type,trainer.tr_fname,trainer.tr_lname from trainee,
      level,trade,module,result,mod_trade_tr,trainer where trainee.t_id=result.t_id and
      module.module_code= result.module_code and trade.l_id=level.l_id and trainee.trade_id=trade.trede_id and 
      module.module_code=mod_trade_tr.module_code
      and trainer.tr_id= mod_trade_tr.tr_id order by module.module_name desc");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <div class="top"><?php include('../hrf/header.php');?></div>
    <div class="body">
        <div class="left"><?php include('../hrf/right-menu.php');?></div>
        <div class="right">
            <div class="header">student result</div><br><br>
            <div class="selectinmarks">
                <form action="#" method="post">
                    <select name="trade" id="selecttrade">
                        <option value="">choose trade...</option>
                        <?php foreach($select21 as $trade){?>
                            <option value="<?=$trade['trede_id'];?>"><?=$trade['lname'].$trade['trede_name'];?></option>
                        <?php }?>
                    </select>
                    <div id="selectcourse">
                        
                    </div>

                    
                </form>
            </div>
            <?php
            $display = null;
            if(isset($_POST['displaybyclass'])){
                $class = $_POST['trade'];
                $select=$conn->query("select trade.trede_name,trainee.t_id, trainee.fname,trainee.lname,module.module_code,
                module.module_name,sum(result.marks)as marks,sum(result.overmarks) as overmarks,result.type from trade right join trainee on 
                trade.trede_id=trainee.trade_id right join mod_trade_tr on mod_trade_tr.trede_id = trade.trede_id left
                join module on module.module_code=mod_trade_tr.module_code  left join result on trainee.t_id = result.t_id  
                and module.module_code=result.module_code where trade.trede_id='$class' group by trainee.t_id");
                if(mysqli_num_rows($select) > 0){
                $header =  mysqli_fetch_array($select);
                $dataheader ="<div class='header'>".$header['lname']." ".$header['trede_name']."</div>";
                
                }$display = 1;
            }elseif(isset($_POST['displaybycourse'])){
                
                $class = $_POST['trade'];
               $course = $_POST['course'];
               $select=$conn->query("select trade.trede_name,trainee.t_id, trainee.fname,trainee.lname,module.module_code,
                module.module_name,sum(result.marks)as marks,sum(result.overmarks) as overmarks,result.type from trade right join trainee on 
                trade.trede_id=trainee.trade_id right join mod_trade_tr on mod_trade_tr.trede_id = trade.trede_id left
                join module on module.module_code=mod_trade_tr.module_code  left join result on trainee.t_id = result.t_id  
                and module.module_code=result.module_code where trade.trede_id='$class' and module.module_code='$course' group by trainee.t_id");
                if(mysqli_num_rows($select) > 0){
                    $header =  mysqli_fetch_array($select);
                    $dataheader ="<div class='header'>".$header['lname']." ".$header['trede_name']." on ".$header['module_name']."</div>";
                    
                }$display = 1;
            }
            if(!$display == null){
                if(mysqli_num_rows($select) > 0){
                    $dataheader;  ?>
                           
                        <table border="1" width="100%">
                            
                            <thead>
                                <td>Student Name</td>
                                <td>marks</td>
                                <td>over marks</td>
                                <td>percentage</td>
                                <td id="action">action<button id="print"><img src="../icon/printer.png"></button></td>
                            </thead>
                            <?php foreach ($select as $data) {
                                $overmarks=$data['overmarks'];
                                $marks = $data['marks'];
                                
                                if($marks =='' and $overmarks ==''){
                                     $percentage='nomarks';
                                     $marks="no marks";
                                     $overmarks = "nomarks";
                                }
                                else {$percentage = round($marks *100 / $overmarks)."%";};

                                ?>
                                <tr>
                                    <td><?=$data['fname']." ".$data['lname'];?></td>
                                    <td><?=$marks;?></td>
                                    <td><?=$overmarks;?></td>
                                    <td><?=$percentage;?></td>
                                    <td ><a target="_blank" href="../trainee/student.php?sid=<?=$data['t_id'] ?>"><button id ="update">view mark own</button></a></td>
                                </tr>

                            <?php }?>
                    </table>
                    <?php }
                        else echo "<div class='empty'>!!!!!!!!no marks available</div>";  ?>

                    </div>
            <?php
                        }else{

                            echo "<div class='empty'><img src='../icon/select.png'><br>!!!!select class to display marks<!div>";
                        }
            ?>
         
    </div>
</body>
</html>
<script src="../js/jquery-3.6.3.js"></script>
<script src="../js/javascript.js"></script>
<script>
    let userinfo = document.querySelector(".userrole");
    userinfo.innerHTML="<?=$_SESSION['username'].'/'.$_SESSION['role']?>"

</script>