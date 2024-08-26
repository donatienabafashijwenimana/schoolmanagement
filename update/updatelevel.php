<?php

include '../php/connect.php';
function updatelevel($conn,$levelid){
    $select= $conn->query("select* from level where l_id='$levelid'");
    $data = mysqli_fetch_array($select);
    ?>
        <form action="../update/updatelevel.php" method="post">
            <label for="">department name</label><a href="department.php"><img id="cancel" src="../icon/cancel.png" alt=""></a><br><br>
            <input type="hidden" name="id" value='<?=$data['l_id'];?>'>
            <input type="text" name="dept_name" value='<?=$data['lname'];?>'><br>
            <input type="submit" name="update" value="update">
        </form>
    <?php

}


if (isset($_POST['update'])) {
    
    $select1= $conn->query("select*from level where lname='{$_POST['dept_name']}' and l_id!='{$_POST['id']}'");
    if (mysqli_num_rows($select1)>0) {
        ?>
        <script>
        alert('no duplication of level');
        window.location.href='../php/department.php'

    </script>
        <?php
    }else{
    $update= $conn->query("update level set lname ='{$_POST['dept_name']}' where l_id='{$_POST['id']}'");
    if($update==true){
        ?>
        <script>
        alert('this level updated');
        window.location.href='../php/department.php'

    </script>
        <?php
    }else{
        ?>
        <script>
    alert('this level not not updated');
    window.location.href='../php/department.php'
</script>
    <?php
    }
}
}