<?php
session_start();
include 'connect.php';

if(isset($_GET['deptid'])){
    $delete= $conn->query("delete from department where dept_id='{$_GET['deptid']}'");
    if ($delete == true) {
        echo "<script>
        alert('department deleted')
        window.location.href='department.php'
        </script>";
        }else {
            echo "<script>
            alert('not deleted')
            window.location.href='department.php'
            </script>";
        }
}

if(isset($_GET['levelid'])){
    $delete= $conn->query("delete from level where l_id='{$_GET['levelid']}'");
    if ($delete == true) {
        echo "<script>
        alert('level deleted');
        window.location.href='department.php'
        </script>";
        }else {
            echo "<script>
            alert('not deleted')
            window.location.href='department.php'
            </script>";
        }
}
if(isset($_GET['classid'])){
    $delete= $conn->query("delete from trade where trede_id='{$_GET['classid']}'");
    if ($delete == true) {
        echo "<script>
        alert('trade deleted')
        window.location.href='trade.php'
        </script>";
        }else {
            echo "<script>
            alert('not deleted')
            window.location.href='trade.php'
            </script>";
        }
}
if(isset($_GET['moduleid'])){
    $delete= $conn->query("delete from module where module_code='{$_GET['moduleid']}'");
    if ($delete == true) {
        echo "<script>
        alert('module deleted')
        window.location.href='module.php'
        </script>";
        }else {
            echo "<script>
            alert('not deleted')
            window.location.href='module.php'
            </script>";
        }
}
if(isset($_GET['trainerid'])){
    $delete= $conn->query("delete from trainer where tr_id='{$_GET['trainerid']}'");
    if ($delete == true) {
        echo "<script>
        alert('trainer deleted')
        window.location.href='trainer.php'
        </script>";
        }else {
            echo "<script>
            alert('not deleted')
            window.location.href='trainer.php'
            </script>";
        }
}
if(isset($_GET['assid'])){
    $delete= $conn->query("delete from mod_trade_tr where ass_id='{$_GET['assid']}'");
    if ($delete == true) {
        echo "<script>
        alert('module unsigned to trainer and module')
        window.location.href='assign.php'
        </script>";
        }else {
            echo "<script>
            alert('not deleted')
            window.location.href='assign.php'
            </script>";
        }
}
if(isset($_GET['traineeid'])){
    $delete= $conn->query("delete from trainee where t_id='{$_GET['traineeid']}'");
    if ($delete == true) {
        echo "<script>
                alert('student deleted')
                window.location.href='trainee.php'
                </script>";
        }else {
            echo "<script>
                    alert('not deleted')
                    window.location.href='trainee.php'
                </script>";
        }
}
?>