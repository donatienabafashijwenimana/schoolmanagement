
<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']=="DOS") header('location:../index/login.php');
$page="module";
include 'connect.php';

include '../update/updatecourse.php';
$selectdepartment = $conn->query("select*from department");

$select = $conn->query("select trade.trede_id,trade.trede_name,department.dept_name,level.lname from trade right join department on department.dept_id=trade.dept_id inner join level on level.l_id=trade.l_id");

$select2 = $conn->query("select module.module_code, module.module_name,department.dept_name from department inner join module on module.dept_id = department.dept_id");

if(isset($_POST['recordmodule'])){
    $select1= $conn->query("select*from module where module_code='{$_POST['modulecode']}' or module_name='{$_POST['modulename']}' and dept_id='{$_POST['department']}'");
    if (mysqli_num_rows($select1)==0) {
        $insert = $conn->query("insert into module values('{$_POST['modulecode']}','{$_POST['modulename']}','{$_POST['department']}')");
        if($insert==true){
            ?>
            <script>
            alert('this module added');
            window.location.href='module.php';
        </script>
            <?php
        }else{
            ?>
            <script>
        alert('this module not added');
    </script>
        <?php
        }
    }else{?>
    <script>
        alert('this module exist');
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
            <div class="header">module</div><br><br>
            
            <?php if(mysqli_num_rows($select2) > 0){ ?>
                <?php
                if (isset($_GET['moduleid'])) {
                    ?><div class="update">
                        <?php
                       updatecourse($conn,$_GET['moduleid']);
                       ?></div>
                       <?php
                   }?>
            <table border="1" width="100%">
                <thead>
                    <td>module name</td>
                    <td>department</td>
                    <td id="action">action<button id="print"><img src="../icon/printer.png"></button><button id="addstudent"><img src="../icon/add.png"></button></td>
                </thead>
                <?php foreach ($select2 as $data) {
                    ?>
                    <tr>
                        <td><?=$data['module_name'];?></td>
                        <td><?=$data['dept_name']?></td>
                        <td><a href="?moduleid=<?=$data['module_code'];?>"id="update">update</a>
                            <a href="delete.php?moduleid=<?=$data['module_code'];?>"id="delete">delete</a></td>
                    </tr>
            
                <?php }?>
            </table>
            <?php }
                else echo "<div class='empty'>!!!!!!!!no module recorded</div>";  ?>

                <div class="form" style="top:2pc;">
                <form action="module.php" method="post">
                       <label for=""><u>add new module</u></label><img id="cancel" src="../icon/cancel.png" alt=""><br><br>
                        <label for="">module code</label><br>
                            <input type="text" name="modulecode"><br>
                            <label for="">modulename</label><br>
                            <input type="text" name="modulename" id=""><br>
                            <label for="">class</label><br>
                            <select name="department" id="">
                                <?php
                                    foreach($selectdepartment as $data){
                                    ?>
                                    <option value="<?=$data['dept_id'];?>"><?=$data['dept_name'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select><br>
                            <input type="submit" name="recordmodule" value="record">
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