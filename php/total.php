<?php
include 'connect.php';
$selctdepartment = $conn->query("select count(*) as total from department");
$totaldepartment = mysqli_fetch_array($selctdepartment);

$selectlevel = $conn->query("select count(*) from level");
$totallevel = mysqli_fetch_array($selectlevel);

$selecttrade = $conn->query("select count(*) from trade");
$totaltrade = mysqli_fetch_array($selecttrade);

$selectcourse = $conn->query("select count(*) from module");
$totalcourse = mysqli_fetch_array($selectcourse);

$selecttrainer = $conn->query("select count(*) from trainer");
$totaltrainer = mysqli_fetch_array($selecttrainer);

$selecttrainee = $conn->query("select count(*) from trainee");
$totaltrainee = mysqli_fetch_array($selecttrainee);

$selectassign = $conn->query("select count(*) from mod_trade_tr");
$totalassign = mysqli_fetch_array($selectassign);

?>