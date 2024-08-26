<?php
session_start();
include 'connect.php';
//insert into module trainer trede table

if(isset($_POST['assign'])){
if (!isset($_POST['module'])||!isset($_POST['trade'])||!isset($_POST['trainer'])) {
    ?>
      <script>
        alert('you do not have trade or module or trainer');
      </script>
    <?php
}else{
    $check = $conn->query("select* from mod_trade_tr where module_code='{$_POST['module']}' and trede_id='{$_POST['trade']}'");
    if (mysqli_num_rows($check)<=0) {
       
    
$insert = $conn->query("insert into mod_trade_tr values(null,'{$_POST['module']}','{$_POST['trade']}','{$_POST['trainer']}')");

if ($insert = true) {
    ?>
      <script>
        alert('module assigned');window.location.href="assign.php"
      </script>
    <?php
}else {
    ?>
      <script>
        alert('module not asssigned');window.location.href="assign.php"
      </script>
    <?php
}
}else{
    ?>
    <script>
      alert('module exist');window.location.href="assign.php"
    </script>
  <?php
} 
}
}










if (isset($_POST['department'])) {
    $selectmodule = $conn->query("select module.module_code,module.module_name,department.dept_name from module,department where module.dept_id= department.dept_id and department.dept_name='{$_POST['department']}'");

    $selecttrade = $conn->query("select trade.trede_id,trade.trede_name,level.lname,department.dept_name from trade,level,department where level.l_id=trade.l_id and trade.dept_id=department.dept_id and dept_name='{$_POST['department']}'");

    $selecttrainer = $conn->query("select trainer.tr_id,trainer.tr_fname,trainer.tr_lname,department.dept_name from trainer,department where trainer.dept_id = department.dept_id and department.dept_name='{$_POST['department']}'");
    ?>
    <form action="assignmodule_trade.php" method="post">
    <?php
    if (mysqli_num_rows($selecttrade)>0) {
        
        ?>
        
        <select name="trade" id="">
          <option value="">choose trade...</option>
            <?php foreach($selecttrade as $data) { ?>
            <option value="<?=$data['trede_id']?>"><?=$data['lname'].$data['trede_name']?></option>
            <?php } ?>
        </select> 
        <?php
    }else{
      ?>
      <select>
        <option value="">no trade available...</option>
      </select>
      
      <?php
    }
    if (mysqli_num_rows($selecttrainer)>0) {
        
        ?>
        <select name="trainer" id="">
          <option value="">choose trainer...</option>
            <?php foreach($selecttrainer as $data) { ?>
            <option value="<?=$data['tr_id']?>"><?=$data['tr_fname']." ".$data['tr_lname']?></option>
            <?php } ?>
        </select>
        <?php
    }else{
      ?>
      <select>
        <option value="">no trainer available...</option>
      </select>
      
      <?php
    }
    if (mysqli_num_rows($selecttrainer)>0) {
        
        ?>
        <select name="module" id="">
          <option value="">choose module...</option>
            <?php foreach($selectmodule as $data) { ?>
            <option value="<?=$data['module_code']?>"><?=$data['module_name'];?></option>
            <?php } ?>
        </select>
        
        <?php
    }else{
      ?>
      <select>
        <option value="">no mudule available...</option>
      </select>
      
      <?php
    }

}

?>
<button type="submit" name="assign">assign</button>
</form>