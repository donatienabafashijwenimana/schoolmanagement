<?php
include '../php/connect.php';
if (isset($_POST['register'])) {

    if($_POST['role']== "TRAINER") {
       $select = $conn->query("select*from trainer where tr_fname='{$_POST['firstname']}' and tr_lname='{$_POST['lastname']}'") ;
       if (mysqli_num_rows($select)>0) {
        $row = mysqli_fetch_array($select);
        $insert = $conn->query("insert into users values('{$row['tr_id']}','{$_POST['username']}','{$_POST['role']}','{$_POST['password']}')");
        if ($insert == true) {
            echo "<script>
        alert('trainer account created successfully')
        window.location.href='login.php'
        </script>";
        }else {
            echo "teacher not registered";
        }
       }else {
        echo "<script>
        alert('not registered on teachers of this school')
        </script>";
       }
    }

    elseif($_POST['role']== "STUDENT") {
        $select = $conn->query("select*from trainee where fname='{$_POST['firstname']}' and lname='{$_POST['lastname']}'") ;
        if (mysqli_num_rows($select)>0) {
         $row = mysqli_fetch_array($select);
         $insert = $conn->query("insert into users values('{$row['t_id']}','{$_POST['username']}','{$_POST['role']}','{$_POST['password']}')");
         if ($insert == true) {
             echo"student registered";
         }else {
             echo "student not registered";
         }
        }else {
         echo "not you";
        }
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
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <form action="#" method="post"><small class="header">sign up</small><br><br><b><br><br>
        <label for="">first name</label><br>
        <input type="text" name="firstname" id=""><br>
        <label for="">last name</label><br>
        <input type="text" name="lastname" id=""><br>
        <label for="">create username</label><br>
        <input type="text" name="username" id=""><br>
        role<select name="role">
            <option value="TRAINER">trainer</option>
            <option value="STUDENT">student</option>
        </select><br>
        <label for="">password</label><br>
        <input type="password" name="password" id=""><br>
        <input type="submit" name="register" value="register"><br>
        i have account<a href="login.php">sign in</a>


    </form>
</body>
</html>