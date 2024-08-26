<?php

include '../php/connect.php';
function updatedepartment($conn,$deptid){
    $select= $conn->query("select* from department where dept_id='$deptid'");
    $data = mysqli_fetch_array($select);
    ?>
        <form action="../update/updatedepartment.php" method="post">
            <label for="">department name</label><a href="department.php"><img id="cancel" src="../icon/cancel.png" alt=""></a><br><br>
            <input type="hidden" name="id" value='<?=$data['dept_id'];?>'>
            <input type="text" name="dept_name" value='<?=$data['dept_name'];?>'><br>
            <input type="submit" name="updatedept" value="update">
        </form>
    <?php

}


if (isset($_POST['updatedept'])) {
    session_start();
    $select1= $conn->query("select*from department where dept_name='{$_POST['dept_name']}' and dept_id!='{$_POST['id']}'");
    if (mysqli_num_rows($select1)>0) {
        ?>
        <script>
        alert('no duplication of department');
        window.location.href='../php/department.php'

    </script>
        <?php
    }else{
    $update= $conn->query("update department set dept_name ='{$_POST['dept_name']}' where dept_id='{$_POST['id']}'");
    if($update==true){
        ?>
        <script>
        alert('this department updated');
        window.location.href='../php/department.php'

    </script>
        <?php
    }else{
        ?>
        <script>
    alert('this department not not updated');
    window.location.href='../php/department.php'
</script>
    <?php
    }
}
}

?>