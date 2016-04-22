<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th > ID </th>
            <th > 角色名称 </th>
            <th > 操作 </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($roles as $val) {
            echo "<tr>";
            echo "<th> {$val['id']} </th>";
            echo "<td> {$val['name']} </td>";
            echo '<td>
                <a href="/admin/role/edit/'.$val['id'].'" title="编辑">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> &nbsp;&nbsp;
                <a href="/admin/role/delete/'.$val['id'].'" title="删除" onclick="return confirm(\'确认删除？\');">
                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
                </td>';
            echo "</tr>";
        }?>
    </tbody>
</table>

<?php
    function list_act($act)
    {
        $arr = unserialize($act);
        return implode(',', $arr);
    }
?>
