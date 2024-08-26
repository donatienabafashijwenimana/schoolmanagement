<?php
include 'connect.php';
if (isset($_POST['trade'])) {
    $selectmoduleimark = $conn->query("SELECT module.module_name,mod_trade_tr.module_code from 
                    module,mod_trade_tr  where mod_trade_tr.module_code=module.module_code and
                     mod_trade_tr.trede_id='{$_POST['trade']}'") ;

    ?>
    <select name="course" id="course">
        <option value="">choose course.....</option>
       <?php
       foreach($selectmoduleimark as $moduleinmarks) {             
       ?>
           <option value="<?=$moduleinmarks['module_code']?>"><?=$moduleinmarks['module_name']?></option>
       
       <?php
       }
       ?>
    </select>
    <input type="submit" name="displaybyclass" value="display by class">
    <input type="submit" name="displaybycourse" value="display by course">
    <?php
}

?>