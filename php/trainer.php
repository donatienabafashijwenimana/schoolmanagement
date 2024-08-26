<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']=="DOS") header('location:../index/login.php');
$page = 'trainer';
include 'connect.php';
include '../update/updatetrainer.php';
$select = $conn->query("select trainer.tr_id, trainer.tr_fname,trainer.tr_lname,trainer.email,department.dept_name from trainer inner join department on department.dept_id= trainer.dept_id");
$selectdepartment = $conn->query("select*from department");

if(isset($_POST['addtrainer'])){
        $insert = $conn->query("insert into trainer values(null,'{$_POST['fname']}','{$_POST['lname']}','{$_POST['email']}','{$_POST['department']}')");
        if($insert==true){
            ?>
            <script>
            alert('this trainer  added');
            window.location.href='trainer.php';
        </script>
            <?php
        }else{
            ?>
            <script>
        alert('this trainer not added');
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
        <div class="header">trainer</div><br><br>
             <?php if(mysqli_num_rows($select) > 0){ ?>
                <?php
                if (isset($_GET['trainerid'])) {
                    ?><div class="update">
                        <?php
                       updatetrainer($conn,$_GET['trainerid']);
                       ?></div>
                       <?php
                   }?>
            <table border="1" width="100%">
                        <tr>
                            <thead>
                                <td>terainer name</td>
                                <td>email</td>
                                <td>department</td>
                                <td id="action">action<button id="print"><img src="../icon/printer.png"></button><button id="addstudent"><img src="../icon/add.png"></button></td>
                            </thead>
                            <?php foreach ($select as $data) {
                                ?>
                                <tr>
                                    <td><?=$data['tr_fname']." ".$data['tr_lname'];?></td>
                                    
                                    <td><?=$data['email'];?></td>
                                    <td><?=$data['dept_name'];?></td>
                                    <td><a href="?trainerid=<?=$data['tr_id'];?>"id="update">update</a>
                                        <a href="delete.php?trainerid=<?=$data['tr_id'];?>"id="delete">delete</a>
                                    </td>
                                </tr>

                            <?php }?>
                        </tr>
                    </table>
                    <?php }
                    else echo "<div class='empty'>!!!!!!!!no trainer recorded</div>";  ?>

                <div class="form" style="top:2pc">
                <form action="trainer.php" method="post">
                    <label for=""><u>add new trainer</u></label><img id="cancel" src="../icon/cancel.png" alt=""><br><br>
                    <smal>first name</small><br>
                    <input type="text" name="fname"><br>
                    <smal>last name</small><br>
                    <input type="text" name="lname"><br>
                    <smal>email</small><br>
                    <input type="text" name="email"><br>
                    <label for="">deprtment</label><br>
                    <select name="department" id="">
                    <?php
                        foreach($selectdepartment as $data){
                        ?>
                        <option value="<?=$data['dept_id'];?>"><?=$data['dept_name'];?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <input type="submit" name="addtrainer" value="add trainer">
              </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    let userinfo = document.querySelector(".userrole");
    userinfo.innerHTML="<?=$_SESSION['username'].'/'.$_SESSION['role']?>"

</script>