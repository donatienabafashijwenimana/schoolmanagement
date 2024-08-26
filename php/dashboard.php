
<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']=="DOS") header('location:../index/login.php');
include 'total.php';
$page='dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="top"><?php include('../hrf/header.php');?></div>
    <div class="body">
        <div class="left"><?php include('../hrf/right-menu.php');?></div>
        <div class="right">
            <div class="header"><img src="../icon/dashboard.png" id='right-img'>dashboard</div>
            <div class="row1">
                <div class="item1"><img src="../icon/department.png" alt="" srcset="">
                   <h4><a href="department.php"> department(<?=$totaldepartment['total'];?>)</a></h4>
                </div>
                <div class="item1"><img src="../icon/level.png" alt="" srcset="">
                   <h4><a href="department.php"> level(<?=$totallevel['count(*)'];?>)</a></h4>
                </div>
                <div class="item1"><img src="../icon/trade.png" alt="" srcset="">
                   <h4><a href="trade.php"> class(<?=$totaltrade['count(*)'];?>)</a></h4>
                </div>
                <div class="item1"><img src="../icon/course.png" alt="" srcset="">
                   <h4><a href="module.php"> course(<?=$totalcourse['count(*)'];?>)</a></h4>
                </div>
            </div>
            <div class="row1">
                <div class="item1"><img src="../icon/trainer.png" alt="" srcset="">
                   <h4><a href="trainer.php"> trainer(<?=$totaltrainer['count(*)'];?>)</a></h4>
                </div>
                <div class="item1"><img src="../icon/trainee.png" alt="" srcset="">
                   <h4><a href="trainee.php"> trainee(<?=$totaltrainee['count(*)'];?>)</a></h4>
                </div>
                <div class="item1"><img src="../icon/assign.png" alt="" srcset="">
                   <h4><a href="assign.php"> assign module(<?=$totalassign['count(*)'];?>)</a></h4>
                </div>
                <div class="item1"><img src="../icon/result.png" alt="" srcset="">
                   <h4><a href="marks.php"> marks</a></h4>
                </div>
            </div>
            
        </div>
    </div>
    <?php  include('../hrf/footer.php');?>
</body>
</html>
<script>
    let userinfo = document.querySelector(".userrole");
    userinfo.innerHTML="<?=$_SESSION['username'].'/'.$_SESSION['role']?>"

</script>