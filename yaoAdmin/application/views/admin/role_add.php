<link href="/static/css/icheck_skins/all.css" rel="stylesheet">
<script src="/static/js/icheck.min.js"></script>

<form action="" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="input1" class="col-sm-2 control-label">角色名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="roleName" value="<?php echo $role['name'];?>">
            <span id="helpBlock" class="help-block">
            请填写角色的名称，如：市场经理
            </span>
        </div>

        <label for="input2" class="col-sm-2 control-label">权限分配</label>
        <div class="col-sm-10">
            <?php
            echo "<table class=\"table table-striped\">";
            foreach ($act as $key=>$val) {
                echo "<tr><th width=\"20%\">{$val['title']}</th>";
                echo "<td>";
                foreach ($val['subact'] as $k=>$value) {
                    $isChecked = @in_array($value['id'], unserialize($role['act'])) ? ' checked' : '';
                    if ('控制面板' == $value['title']) {
                        $isChecked = ' checked disabled';
                        $value['title'] .= '（必选）';
                    }
                    echo '<label class="checkbox-inline">';
                    echo "<input type=\"checkbox\" name=\"roleAct[]\" value=\"{$value['id']}\" {$isChecked}>
                        <span class=\"label label-info\">{$value['title']}</span>";
                    echo '</label>';
                    echo ($k + 1) % 4 == 0 ? '<br>' : '';
                }
                echo "</td></tr>";
            }
            echo "</table>";
            ?>
        </div>
    </div>

    <label for="input1" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
        <input type="submit" name="submit" class="btn btn-primary" value="提交">
    </div>
</form>

<script type="text/javascript">
    $('input').iCheck({ 
      labelHover : true, 
      cursor : true, 
      checkboxClass : 'icheckbox_square-blue', 
      increaseArea : '20%' 
    });
</script>
