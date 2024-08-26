<?php
include 'connect.php';
$select21 = $conn->query("select trade.trede_id,trade.trede_name,department.dept_name,level.lname from trade right join department on department.dept_id=trade.dept_id inner join level on level.l_id=trade.l_id order by level.lname asc");


