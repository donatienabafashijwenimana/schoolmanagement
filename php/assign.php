<?php
session_start();
$page='assign';
if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']=="DOS") header('location:../index/login.php');
include 'connect.php';
$select1= $conn->query("select mod_trade_tr.ass_id, trainer.tr_fname,trainer.tr_lname,module.module_name,trade.trede_name,level.lname from trade,module,trainer,level,mod_trade_tr where trainer.tr_id=mod_trade_tr.tr_id and module.module_code=mod_trade_tr.module_code and mod_trade_tr.trede_id=trade.trede_id and level.l_id=trade.l_id");

$selectdep = $conn->query("select *from department");

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
                <div class="header">assigened module</div><br><br>
                <div class="assign">
                    <form action="addmodule.php" method="post" >
                        <select name="" id="select">
                            <option>choose department asssign......</option>
                            <?php
                            foreach ($selectdep as $dat) {
                                ?><option id="dep" value="<?=$dat['dept_name'];?>"><?=$dat['dept_name'];?></option>
                                <?php
                            }
                            ?>
                        </select><br>
                    </form>
                    <div class="a"></div>
                </div>
                <?php if(mysqli_num_rows($select1) > 0){ ?>
                    <table border="1" width="100%">
                        <thead>
                            <td>trainer name</td>
                            <td>moadulename</td>
                            <td>trade name</td>
                            
                            <td colspan="2" class="action">action</td>
                        </thead>
                <?php foreach($select1 as $data){ ?><tr>
                    <td><?=$data['tr_fname']." ".$data['tr_lname'];?></td>
                    <td><?=$data['module_name']?></td>
                    <td><?=$data['lname']." ".$data['trede_name']?></td>
                    <td><a href="#?upid=<?=$data['ass_id'];?>"id="update">update</a>
                        <a href="delete.php?assid=<?=$data['ass_id'];?>"id="delete">delete</a>
                    </td></tr>
                    
                <?php }?>
            </table>
            <?php }
            else echo "<div class='empty'>!!!!!!!!no module assigned</div>";  ?>
  
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