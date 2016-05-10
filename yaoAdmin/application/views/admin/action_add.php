<link href="/static/css/icheck_skins/all.css" rel="stylesheet">
<script src="/static/js/icheck.min.js"></script>

<form action="" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="input1" class="col-sm-2 control-label">操作名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title" value="<?php echo $act['title'];?>">
        </div>
    </div>

    <div class="form-group">
        <label for="input2" class="col-sm-2 control-label">icon图标</label>
        <div class="col-sm-10">
            <?php
                $icon_arr = $this->config->item('admin_action_icon');
                foreach ($icon_arr as $icon) {
                    $isChecked = $icon == $act['icon'] ? 'checked' : '';
                    echo "<input type=\"radio\" name=\"icon\" value=\"{$icon}\" {$isChecked}>
                        <span class=\"glyphicon glyphicon-{$icon}\"></span>&nbsp;&nbsp;";
                }
            ?>
            <span id="helpBlock" class="help-block">顶级菜单选择有效</span>
        </div>
    </div>

    <div class="form-group">
        <label for="input3" class="col-sm-2 control-label">链接地址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="target" value="<?php echo $act['target'];?>">
            <span id="helpBlock" class="help-block">顶级菜单选择有效</span>
        </div>
    </div>

    <div class="form-group">
        <label for="input4" class="col-sm-2 control-label">验证字符</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="verify" value="<?php echo $act['verify'];?>">
        </div>
    </div>


    <div class="form-group">
        <label for="input5" class="col-sm-2 control-label">父级操作</label>
        <div class="col-sm-3">
            <select name="pid" class="form-control">
                <option value="0"> 顶级操作 </option>
                <?php foreach ( $top_act as $val ) {
                    $selected = $val['id'] == $act['pid'] ? 'selected' : '';
                    echo "<option value=\"{$val['id']}\" {$selected}> {$val['title']} </option>";
                }?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="input6" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            <div class="radio">
                <label>
                    <input type="radio" name="display" value="yes" <?php echo $act['display'] == 'yes' ? 'checked' : '';?>>
                    YES &nbsp;&nbsp;
                </label>
                <label>
                    <input type="radio" name="display" value="no" <?php echo $act['display'] == 'no' ? 'checked' : '';?>>
                    NO 
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="input7" class="col-sm-2 control-label">排序</label>
        <div class="col-sm-10">
            <input type="number" name="orderby" class="form-control" value="<?php echo $act['orderby'];?>">
        </div>
    </div>

    <div class="form-group">
        <label for="input8" class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <input type="submit" name="submit" class="btn btn-primary" value="提交">
        </div>
    </div>
</form>

<script type="text/javascript">
    $('input').iCheck({ 
      labelHover : true, 
      cursor : true, 
      radioClass : 'iradio_square-blue', 
      increaseArea : '20%' 
    });
</script>
