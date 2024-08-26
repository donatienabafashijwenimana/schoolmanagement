

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/headerfooter.css">

<body>
    <div class="rightmenu">
        <a href="dashboard.php"><img src="../icon/dashboard.png" id='right-img'><div class="right-link-menu 
        <?php if($page=='dashboard') echo'active'?>"> dashboard</div></a><br>

        <a href="department.php"><img src="../icon/department.png" id='right-img'><div class="right-link-menu
        <?php if($page=='department') echo'active'?>"> department</div></a><br>

        

        <a href="trade.php"><img src="../icon/trade.png" id='right-img'><div class="right-link-menu
        <?php if($page=='trade') echo'active'?>"> trade</div></a><br>

        <a href="module.php"><img src="../icon/course.png" id='right-img'><div class="right-link-menu
        <?php if($page=='module') echo'active'?>"> course</div></a><br>

        <a href="trainer.php"><img src="../icon/trainer.png" id='right-img'><div class="right-link-menu
        <?php if($page=='trainer') echo'active'?>"> trainer</div></a><br>

        <a href="trainee.php"><img src="../icon/trainee.png" id='right-img'><div class="right-link-menu
        <?php if($page=='trainee') echo'active'?>"> trainee</div></a><br>

        <a href="assign.php"><img src="../icon/assign.png" id='right-img'><div class="right-link-menu
        <?php if($page=='assign') echo'active'?>"> assign module</div></a><br>

        <a href="marks.php"><img src="../icon/result.png" id='right-img'><div class="right-link-menu
        <?php if($page=='marks') echo'active'?>"> marks</div></a><br>

    </div>
</body>
</html>