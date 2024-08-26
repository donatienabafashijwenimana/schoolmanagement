<?php
session_start();
include '../php/connect.php';
if (isset($_GET['sid'])) {
    
}elseif (!isset($_SESSION['role']) || !isset($_SESSION['id']) || $_SESSION['role']!=="STUDENT") {
    header("location:../index/login.php?!");
}else
$sid = $_SESSION['id'];

if (isset($_GET['sid'])) {
    $sid = $_GET['sid'];
}

$select=$conn->query("select trade.trede_name, trainee.fname,trainee.lname,module.module_code,
module.module_name,sum(result.marks)as marks,sum(result.overmarks) as overmarks,result.type from trade right join trainee on 
trade.trede_id=trainee.trade_id right join mod_trade_tr on mod_trade_tr.trede_id = trade.trede_id left
 join module on module.module_code=mod_trade_tr.module_code  left join result on trainee.t_id = result.t_id  
 and module.module_code=result.module_code where trainee.t_id='$sid' group by result.module_code");

$sum = $conn->query("select sum(marks),sum(overmarks) from result where t_id='$sid'");
$data = mysqli_fetch_array($sum);
if($data['sum(marks)']=='' and $data['sum(overmarks)']=='')$percentage='-';
else $percentage = $data['sum(marks)'] * 100/$data['sum(overmarks)'];
$row = mysqli_fetch_array($select);
?>
<style>
    thead th{
        text-align:left;
    }
</style>
<table border="1" width='60%'>
    <thead>
        <th colspan="5">names:<?=$row['fname']." ".$row['lname'];?></th>
    </thead>
    <thead>
        <th colspan="4">class:<?=$row['trede_name'];?></th>
    </thead>
    <tr>
       <th colspan="0">module</th>
       <th colspan="3">result</th>

    </tr>
    <tr>
        <td>module name</td>
        <td>marks</td>
        <td>over marks</td>
    </tr>
<?php 
foreach ($select as $row) {
    ?><tr>
        <td><?=$row['module_name'];?></td>
        <td><?php if($row['marks']=="") echo "--";else echo $row['marks'];?></td>
        <td><?php if($row['overmarks']=="") echo "--";else echo $row['overmarks'];?></td>
    </tr>
    
    <?php
}
?>
   <tr>
    <th>total</th>
    <th colspan="5"><?=$data['sum(marks)']."/".$data['sum(overmarks)'];?></th>
    </tr>
    <tr>
        <th>percentage</th>
        <?php if($row['marks']=="" and  $row['overmarks']=="") $persent ='-'; else $persent=round($percentage,2)."%";?>
        <th colspan="5"><?=$persent;?></th>
    </tr>
    <tr>
        <th>decision</th>
        <th colspan="5"><?php if ($persent>=50)echo "competent";
                        else echo "not yet competent";?>
        </th>
    </tr>
</table>