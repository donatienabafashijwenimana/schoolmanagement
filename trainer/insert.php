<?php
session_start();
include '../php/connect.php';
if(isset($_POST['record'])){
    $marks=$_POST['marks'];
    $sid =$_POST['studentid'];
    $type = $_POST['mtype'];
    $module=$_SESSION['leasson']." ";
    $overmarks = $_POST['overmarks']."<br>";
     $checktype =$conn->query("select*from result where module_code='$module' and trede_id='{$_SESSION['tradeid']}' and type='$type'");
        if (mysqli_num_rows($checktype)>0){
           ?> <script>
           alert('this marks was recorded')
            window.history.back();
            </script><?php
        }else{
    for($i=0;$i<count($sid);$i++){
        if (empty($marks[$i]))echo "--- "." ";
        echo $student = $sid[$i]." ";
        echo $mark= $marks[$i]." ";
        $insert = $conn->query("insert into result values(null,'$student','$module','{$_SESSION['tradeid']}','$mark','$overmarks','$type')");
        if($insert==true){
            ?>
            <script>
            alert('record success fully');
            window.location.href="trainer.php?tradeid=<?=$_SESSION['tradeid']?>&leasson=<?=$module?>";
        </script>
            <?php
        }else{
            ?>
            <script>
        alert('record failed');
        window.history.back()
    </script>
        <?php
    }
}
    }
}