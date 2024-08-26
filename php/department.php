<?php
session_start();
include 'connect.php';
if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']=="DOS") header('location:../index/login.php');
include '../update/updatedepartment.php';
include '../update/updatelevel.php';
if(!isset($_SESSION['id']) || $_SESSION['role']=='DOS') header('location:../index/login.php');
    $_SESSION['id'];
    $_SESSION['username'];
    $_SESSION['role'];
    $page= "department";
$select = $conn->query("select *from department");
if(isset($_POST['adddep'])){
    $select1= $conn->query("select*from department where dept_name='{$_POST['dept_name']}'");
    if (mysqli_num_rows($select1)==0) {
        $insert = $conn->query("insert into department values(null,'{$_POST['dept_name']}')");
        if($insert==true){
            ?>
            <script>
            alert('this department added');
            window.location.href='department.php'

        </script>
            <?php
        }else{
            ?>
            <script>
        alert('this department not added');
    </script>
        <?php
        }
    }else{?>
    <script>
        alert('this department exist');
    </script>
        <?php
    }
}
$select2 = $conn->query("select *from level");
if(isset($_POST['adddlevel'])){
    $select1= $conn->query("select*from level where lname='{$_POST['l_name']}'");
    if (mysqli_num_rows($select1)==0) {
        $insert = $conn->query("insert into level values(null,'{$_POST['l_name']}')");
        if($insert==true){
            ?>
            <script>
            alert('this level added');
            window.location.href='dos previleges.php';
        </script>
            <?php
        }else{
            ?>
            <script>
        alert('this level not added');
        window.location.href='dos previleges.php';
    </script>
        <?php
        }
    }else{?>
    <script>
        alert('this this exist');
        window.location.href='dos previleges.php';
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
        <div class="header">department and level</div><br><br><br>
            <div class="table">
                <table border="1" id="tab-department">
                    
                        
                        
                        <thead>
                        <td>department</td>
                        
                        <td colspan="2" class="action" id="action">action<button id="printdepartment"><img src="../icon/printer.png"></button><button id="adddep"><img src="../icon/add.png"></button></td>
                    </thead>
                    <?php foreach ($select as $data) {
                        ?>
                        <tr>
                            <td><?=$data['dept_name'];?></td>
                            <td  id="action"><a href="?deptid=<?=$data['dept_id'];?>"id="update">update</a>
                                <a href="delete.php?deptid=<?=$data['dept_id'];?>"id="delete">delete</a></td>
                        </tr>

                    <?php }?>
                </table>
                <div class="form" id ='form-add-department'>
                    <form action="#" method="post" ><img id="cancel" src="../icon/cancel.png">
                            

                        <label for="">department name</label><br>
                        <input type="text" name="dept_name"><br>
                        <input type="submit" name="adddep" value="add department">
                        
                    </form>
                </div>
                <?php
                if (isset($_GET['deptid'])) {
                    ?><div class="update">
                        <?php
                        updatedepartment($conn,$_GET['deptid']);
                        ?></div>
                        <?php
                }?>
                <table border="1" id="tab-level">
                    <thead>
                        <td>levels</td>
                        
                        <td colspan="2" class="action" id="action">action<button  id="print-level"><img src="../icon/printer.png"></button><button id="addlevel"><img src="../icon/add.png"></button></td>
                    </thead>
                    <?php foreach ($select2 as $data) {
                        ?>
                        <tr>
                            <td><?=$data['lname'];?></td>
                            <td id="action"><a href="?levelid=<?=$data['l_id'];?>"id="update">update</a>
                                <a href="delete.php?levelid=<?=$data['l_id'];?>"id="delete">delete</a></td>
                        </tr>

                    <?php }?>
                </table>
                <div class="form" id="form-add-level">
                    <form action="add.php" method="post" ><img id="cancel2" src="../icon/cancel.png">
                        <label for="">level name</label><br>
                        <input type="text" name="l_name"><br>
                        <input type="submit" name="addlevel" value="add level">
                    </form>
                </div>
                <?php
                if (isset($_GET['levelid'])) {
                    ?><div class="update uplevel ">
                        <?php
                        updatelevel($conn,$_GET['levelid']);
                        ?></div>
                        <?php
                    }?>
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