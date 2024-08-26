<?php

include '../php/connect.php';


function updatetrainer($conn,$id){
    $select = $conn->query("select trainer.tr_id, trainer.tr_fname,trainer.tr_lname,trainer.email,department.dept_id,department.dept_name from trainer inner join department on department.dept_id= trainer.dept_id and trainer.tr_id='$id'");
    $data1 = mysqli_fetch_array($select);
    $selectdepartment = $conn->query("select*from department");?>
    <form action="trainer.php" method="post">
        <label for=""><u>add new trainer</u></label><a href="trainer.php"><img id="cancel" src="../icon/cancel.png" alt=""></a><br><br>
        <smal>first name</small><br>
        <input type="hidden" name="id" value="<?=$data1['tr_id']?>">
        <input type="text" name="fname" value='<?=$data1['tr_fname']?>'><br>
        <smal>last name</small><br>
        <input type="text" name="lname" value='<?=$data1['tr_lname']?>'><br>
        <smal>email</small><br>
        <input type="text" name="email" value='<?=$data1['email']?>'><br>
        <label for="">deprtment</label><br>
        <select name="department" id="">
            <option value="<?=$data1['dept_id']?>"><?=$data1['dept_name']?></option>
        <?php
            foreach($selectdepartment as $data){
                if($data1['dept_id']==$data['dept_id'])continue;
            ?>
            <option value="<?=$data['dept_id'];?>"><?=$data['dept_name'];?></option>
            <?php
            }
            ?>
        </select><br>
        <input type="submit" name="updatetrainer" value="update">
    </form>
 <?php } ?>


 <?php 
 if(isset($_POST['updatetrainer'])){
    
    $update = $conn->query("update trainer set tr_fname='{$_POST['fname']}',tr_lname='{$_POST['lname']}',email='{$_POST['email']}',dept_id='{$_POST['department']}' where tr_id='{$_POST['id']}'");
        if($update==true){
            ?>
            <script>
            alert('trainer updated');
            window.location.href='../php/trainer.php?>';
        </script>
            <?php
         }else{
            ?>
            <script>
            alert('trainer not updated');
            window.location.href='../php/trainer.php?>';
        </script>
            <?php
         }
 }
