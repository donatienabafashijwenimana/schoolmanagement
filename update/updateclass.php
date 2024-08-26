<?php

include '../php/connect.php';
function updatetrade($conn,$id){
    $select = $conn->query("select trade.trede_id,trade.trede_name,department.dept_id,department.dept_name,level.l_id,level.lname from trade right join department on department.dept_id=trade.dept_id inner join level on level.l_id=trade.l_id and trade.trede_id='$id' order by level.lname asc");
    $data1 = mysqli_fetch_array($select);
    $selectlevel = $conn->query("select*from level");
    $selectdepartment = $conn->query("select*from department");
    
    
    ?>
        <form action="../update/updateclass.php" method="post">
        <label for=""><u>add new trade</u></label><a href="trade.php"><img id="cancel" src="../icon/cancel.png"></a><br><br>
                 <input type="hidden" name="id" value='<?=$data1['trede_id'];?>'>
                <small>trade name</small><br>
                <input type="text" name="t_name" value='<?=$data1['trede_name'];?>' id="t_name"><br>
                <label for="">trade level</label><br>
                <select name="level" id="level">
                    <option value="<?=$data1['l_id']?>"><?=$data1['lname']?></option>
                    <?php
                    foreach($selectlevel as $data){
                        if ($data['l_id'] == $data1['l_id']) continue;
                    ?>
                    <option value="<?=$data['l_id'];?>"><?=$data['lname'];?></option>
                    <?php
                    }
                    ?>
                </select><br>
                <label for="">deprtment</label><br>
                <select name="department" id="department">
                    <option value="<?=$data1['dept_id'];?>"><?=$data1['dept_name'];?></option>
                <?php
                    foreach($selectdepartment as $data){
                        if ($data1['dept_id'] == $data['dept_id']) continue;
                    ?>
                    <option value="<?=$data['dept_id'];?>"><?=$data['dept_name'];?></option>
                    <?php
                    }
                    ?>
                </select><br>
                <input type="submit" name="updatetrade" value = "update trade"  class="add">
        </form>
    <?php

 

}


if(isset($_POST['updatetrade'])){
    
    $select1= $conn->query("select*from trade where trede_name='{$_POST['t_name']}' and l_id='{$_POST['level']}' and dept_id='{$_POST['department']}' and trede_id!='{$_POST['id']}'");
    if (mysqli_num_rows($select1)>0) {
        ?>
            <script>
            alert('no duplication of trade');
            window.location.href='../php/trade.php'
        </script>
        <?php
    }else{
        $update= $conn->query("update trade set trede_name='{$_POST['t_name']}',dept_id='{$_POST['department']}',l_id='{$_POST['level']}' where trede_id='{$_POST['id']}'");
        if($update==true){
            ?>
            <script>
        alert('this trade updated');
        window.location.href='../php/trade.php'
       </script>
        <?php
        }else{
            ?>
            <script>
        alert('this trade not updated');
        window.location.href='../php/trade.php'
       </script>
        <?php
        }
    }
}

?>