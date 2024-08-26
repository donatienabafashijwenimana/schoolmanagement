<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']=="DOS") header('location:../index/login.php');
$page='trainee';
include 'connect.php';
include 'script.php';
include '../update/updatetrainee.php';
$selecttrade = $conn->query("select trade.trede_id,trade.trede_name,department.dept_name,level.lname from
 trade inner join department on department.dept_id=trade.dept_id inner join level on level.l_id=trade.l_id");

$select = $conn->query("select trainee.t_id,trainee.fname,trainee.lname as lastname,trade.trede_name,level.lname,
department.dept_name from trainee,trade,level,department where trainee.trade_id = trade.trede_id and 
level.l_id=trade.l_id and trade.dept_id=department.dept_id order by trade.trede_name asc");

if(isset($_POST['addtrainee'])){
        $insert = $conn->query("insert into trainee values(null,'{$_POST['fname']}','{$_POST['lname']}','{$_POST['trede']}')");
        if($insert==true){
            ?>
            <script>
            alert('this trainee  added');
            window.location.href='trainee.php';
        </script>
            <?php
        }else{
            ?>
            <script>
        alert('this trainee not added');
    </script>
        <?php
    }
}

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
        <div class="header">trainee</div><br><br>
            
            <div class="selectinmarks">
                <form action="#" method="get">
                    <select name="trade" id="selecttrade">
                        <option value="">choose trade...</option>
                        <?php foreach($select21 as $trade){?>
                            <option value="<?=$trade['trede_id'];?>"><?=$trade['lname'].$trade['trede_name'];?></option>
                        <?php }?>
                    </select>
                    <input type="submit" value="display" name="display">
                </form>
            </div>
           <?php 
           if (isset($_GET['trade'])){
            $select = $conn->query("select trainee.t_id,trainee.fname,trainee.lname as lastname,trade.trede_name,
            level.lname,department.dept_name from trainee,trade,level,department where 
            trainee.trade_id = trade.trede_id and level.l_id=trade.l_id and trade.dept_id=department.dept_id
            and trade.trede_id='{$_GET['trade']}' order by trade.trede_name asc");

           
                if(mysqli_num_rows($select) > 0){ 
                  if (isset($_GET['traineeidu'])) {
                    ?><div class="update">
                        <?php
                       updatecourse($conn,$_GET['traineeidu']);
                       ?></div>
                       <?php
                   }?>
                <table border="1" width="100%">
                    
                    <tr>
                        <thead>
                            <td>terainer name</td>
                            <td>class</td>
                            <td>department</td>
                            <td id="action">action<button id="print"><img src="../icon/printer.png"></button><button id="addstudent"><img src="../icon/add.png"></button></td>
                        </thead>
                        <?php foreach ($select as $data) {
                            ?>
                            <tr style="font-size:15px;">
                                <td><?=$data['fname']." ".$data['lastname'];?></td>
                                <td><?=$data['lname'].$data['trede_name'];?></td>
                                <td><?=strtoupper($data['dept_name'])?></td>
                                <td><a href="?trade=<?=$_GET['trade']?>&traineeidu=<?=$data['t_id']?>" id="update">update</a>
                                    <a href="delete.php?traineeid=<?=$data['t_id'];?>"id="delete">delete</a>
                                </td>
                            </tr>

                        <?php }?>
                        <td>

                        </td>
                    </tr>
                </table>
                <?php }
                else echo "<div class='empty'>!!!!!!!!no trinee available in this class</div><button id='addstudent'>add new trainee</button>";  ?>
                <?php }else{?>
                    <div class='empty'><img src="../icon/select.png"><br>!!!select class to view student</div>;    
                <?php } ?>
        <div class="form" style="top:2pc">
        <form action="trainee.php" method="post" >
            
            <label for=""><u>add new student </u></label><img id="cancel" src="../icon/cancel.png" alt=""><br><br>
            <smal>first name</small><br>
            <input type="text" name="fname"><br>
            <smal>last name</small><br>
            <input type="text" name="lname"><br>
            <label for="">trade</label><br>
            <select name="trede" id="">
            <?php
                foreach($selecttrade as $data){
                ?>
                <option value="<?=$data['trede_id'];?>"><?=$data['lname'].$data['trede_name'];?></option>
                <?php
                }
                ?>
            </select><br><br>
            <input type="submit" name="addtrainee" value="add trainer">
        </form>
        </div>
        </div>
    </div>
</body>
</html>
<script src="../js/jquery-3.6.3.js"></script>
<script src="../js/javascript.js"></script>
<script>
    let userinfo = document.querySelector(".userrole");
    userinfo.innerHTML="<?=$_SESSION['username'].'/'.$_SESSION['role']?>"

</script>