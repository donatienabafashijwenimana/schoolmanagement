<?php

include '../php/connect.php';
function updatecourse($conn,$id){
    $selecttrade = $conn->query("select trade.trede_id,trade.trede_name,department.dept_name,level.lname
     from trade inner join department on department.dept_id=trade.dept_id inner join level on
      level.l_id=trade.l_id");
    $select = $conn->query("select trainee.t_id,trainee.fname,trade.trede_id,trainee.lname as lastname,trade.trede_name,
    level.lname,department.dept_name from trainee,trade,level,department where trainee.trade_id = trade.trede_id and 
    level.l_id=trade.l_id and trade.dept_id=department.dept_id and trainee.t_id='$id' order  by trade.trede_name asc");
     $data1 = mysqli_fetch_array($select);

    ?>
       <form action="../update/updatetrainee.php" method="post" >
            <input type="hidden" name="trade" value ="<?=$data1['trede_id'];?>">
            <input type="hidden" name="id" value="<?=$data1['t_id']?>">
            <label for=""><u>add new student </u></label><a href="trainee.php?trade=<?=$data1['trede_id'];?>"><img id="cancel" src="../icon/cancel.png" alt=""></a><br><br>
            <smal>first name</small><br>
            <input type="text" name="fname" value='<?=$data1['fname']?>'><br>
            <smal>last name</small><br>
            <input type="text" name="lname" value='<?=$data1['lastname']?>'><br>
            <label for="">trade</label><br>
            <select name="trede" id="">
                <option value="<?=$data1['trede_id'];?>"><?=$data1['lname'].$data1['trede_name'];?></option>
            <?php
                foreach($selecttrade as $data){
                    if ($data1['lastname']==$data1['lastname']) continue;
                ?>
                <option value="<?=$data['trede_id'];?>"><?=$data['lname'].$data['trede_name'];?></option>
                <?php
                }
                ?>
            </select><br><br>
            <input type="submit" name="updatetrainee" value="update">
        </form><?php } ?>


        <?php

         if(isset($_POST['updatetrainee'])){
            
            $update = $conn->query("update trainee set fname='{$_POST['fname']}',lname='{$_POST['lname']}',trade_id='{$_POST['trede']}' where t_id='{$_POST['id']}'");
        if($update==true){
            ?>
            <script>
            alert('trainee updated');
            window.location.href='../php/trainee.php?trade=<?=$_POST['trede']?>';
        </script>
            <?php
         }else{
            ?>
            <script>
            alert('trainee not updated');
            window.location.href='../php/trainee.php?trade=<?=$_POST['trede']?>';
        </script>
            <?php
         }
        }
        ?>
