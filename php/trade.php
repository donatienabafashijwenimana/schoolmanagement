<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']=="DOS") header('location:../index/login.php');
$page='trade';
include 'connect.php';
include '../update/updateclass.php';
$select = $conn->query("select trade.trede_id,trade.trede_name,department.dept_name,level.lname from trade right join department on department.dept_id=trade.dept_id inner join level on level.l_id=trade.l_id order by level.lname asc");
$selectlevel = $conn->query("select*from level");
$selectdepartment = $conn->query("select*from department");


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
                   <div class="header">trade</div>   <br><br>
        
                    <?php if(mysqli_num_rows($select) > 0){ ?>
                        <?php
                    if (isset($_GET['tradeid'])) {
                    ?><div class="update">
                        <?php
                       updatetrade($conn,$_GET['tradeid']);
                       ?></div>
                       <?php
                   }?>
                    <table border="1" width="100%">
                        
                        <tr>
                            <thead>
                                <td>class</td>
                                <td>trade name</td>
                                <td>level</td>
                                <td>department</td>
                                <td id="action">action<button id="print"><img src="../icon/printer.png"></button><button id="addstudent"><img src="../icon/add.png"></button></td>
                                </thead>
                            </thead>
                            <?php foreach ($select as $data) {
                                ?>
                                <tr>
                                    <td><?=$data['lname'].$data['trede_name'];?></td>
                                    <td><?=$data['trede_name'];?></td>
                                    
                                    <td><?=$data['lname'];?></td>
                                    <td><?=$data['dept_name'];?></td>
                                    <td><a href="?tradeid=<?=$data['trede_id'];?>"id="update">update</a>
                                        <a href="delete.php?classid=<?=$data['trede_id'];?>"id="delete">delete</a>
                                    </td>
                                </tr>
                            <?php }?>
                        </tr>
                    </table>
                   
                    <?php }
                    else echo "<div class='empty'>!!!!!!!!no trade we have</div>";  ?>
                

                
            <div class="form" style="top:2pc">
            <form action="add.php" method="post">
                <label for=""><u>add new trade</u></label><img id="cancel" src="../icon/cancel.png" alt=""><br><br>
                <small>trade name</small><br>
                <input type="text" name="t_name" id="t_name"><br>
                <label for="">trade level</label><br>
                <select name="level" id="level">
                    <?php
                    foreach($selectlevel as $data){
                    ?>
                    <option value="<?=$data['l_id'];?>"><?=$data['lname'];?></option>
                    <?php
                    }
                    ?>
                </select><br>
                <label for="">deprtment</label><br>
                <select name="department" id="department">
                <?php
                    foreach($selectdepartment as $data){
                    ?>
                    <option value="<?=$data['dept_id'];?>"><?=$data['dept_name'];?></option>
                    <?php
                    }
                    ?>
                </select><br>
                <input type="submit" name="addtrade" value = "add trade">
            </form>    
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