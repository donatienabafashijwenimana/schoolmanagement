<?php

include '../php/connect.php';
function updatecourse($conn,$moduleid){
    $selectdepartment = $conn->query("select*from department");

    $select = $conn->query("select trade.trede_id,trade.trede_name,department.dept_id,department.dept_name,level.lname from trade right join department on department.dept_id=trade.dept_id inner join level on level.l_id=trade.l_id");

    $select2 = $conn->query("select module.module_code, module.module_name,department.dept_id,department.dept_name from department inner join module on module.dept_id = department.dept_id where module.module_code='$moduleid'");
    $data1 = mysqli_fetch_array($select2);

    ?>
        <form action="module.php" method="post">
                <label for=""><u>update module</u></label><a href="module.php"><img id="cancel" src="../icon/cancel.png" alt=""></a><br><br>
                        
                            <input type="hidden" name="modulecode" value='<?=$data1['module_code']?>'><br>
                            <label for="">modulename</label><br>
                            <input type="text" name="modulename" value='<?=$data1['module_name']?>' id=""><br>
                            <label for="">class</label><br>
                            <select name="department" id="">
                            <option value="<?=$data1['dept_id'];?>"><?=$data1['dept_name'];?></option>
                                <?php
                                    foreach($selectdepartment as $data){
                                        if($data1['dept_id']==$data['dept_id'])continue;
                                    ?>
                                    <option value="<?=$data['dept_id'];?>"><?=$data['dept_name'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select><br>
                            <input type="submit" name="updatemodule" value="update course">
                        </form><?php } ?>

                         <?php
                        if(isset($_POST['updatemodule'])){
                            
                            $select1= $conn->query("select *from module where module_name='{$_POST['modulename']}' and dept_id='{$_POST['department']}' and module_code!='{$_POST['modulecode']}'");
                            if (mysqli_num_rows($select1)>0) {
                                ?>
                                <script>
                                alert('no duplication of module');
                                window.location.href='module.php';
                            </script>
                                <?php
                            }else{
                            $update = $conn->query("update module set module_name='{$_POST['modulename']}',dept_id='{$_POST['department']}' where module_code='{$_POST['modulecode']}'");
                            if($update==true){
                                ?>
                                <script>
                                alert('this module updated');
                                window.location.href='module.php';
                            </script>
                                <?php
                            }else{
                                ?>
                                <script>
                            alert('this module not updated');
                        </script>
                            <?php
                            }
                        }
                    }
                    ?>