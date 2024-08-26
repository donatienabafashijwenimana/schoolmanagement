<?php
session_start();
include '../php/connect.php';
if (isset($_POST['login'])) {
    

$select = $conn->query("select*from users where name='{$_POST['username']}' and password='{$_POST['password']}' and role='{$_POST['role']}'");
if (mysqli_num_rows($select)>0) {
    $row = mysqli_fetch_array($select);
    $_SESSION['id']=$row['id'];
    $_SESSION['username']=$row['name'];
    $_SESSION['role']=$row['role'];
     if ($row['role']=='dos') {
        header("location:../php/dashboard.php");
     }elseif ($row['role']=="TRAINER") {
        header("location:../trainer/trainer.php");
     }elseif($row['role']=="STUDENT") {
        header("location:../trainee/student.php");
     }
}else {
    echo"login failed";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
   <form action="#" method="post"><small class="header">sign in</small><br><br><b><br><br>
    <label for="">username</label>
    <input type="text" name="username" id=""><br>
    <label for="">role</label><select name="role">
        <option value="dos">dos</option>
        <option value="TRAINER">trainer</option>
        <option value="STUDENT">student</option>
    </select>
    <label for="">password</label>
    <input type="password" name="password" id=""><br>
    <input type="submit" name="login" value="login"><br>
    <a href="registration.php">create account  </a>
   </form> 
</body>
</html>