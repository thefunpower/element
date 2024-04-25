<?php 
$checkbox = $name."__model";
?>
<el-form-item label="<?=$label?>" <?=$item_attr?>>
    <?php
    if($v['value'] && is_array($v['value'])) {
        ?>
    <el-checkbox-group v-model="<?=$checkbox?>">
        <?php
            foreach($v['value'] as $kk => $vv) {
        ?>
        <el-checkbox border label="<?=$vv['value']?>"><?=$vv['label']?></el-checkbox>
        <?php }?>
    </el-checkbox-group>
    <?php }?>
</el-form-item> 
<?php 
$vue->data_form($name, "[]");
$vue->data($checkbox,"[]");
$vue->watch($model,"
  handler(new_val,old_val){  
    if(this.".$model.".".$name."){
        console.log(11);
        this.".$checkbox."=this.".$model.".".$name.";
    }
  }, 
  deep: true
");
$vue->watch($checkbox."(new_val,old_val)"," 
    console.log(new_val); 
    this.".$model.".".$name." = new_val;
");
?>