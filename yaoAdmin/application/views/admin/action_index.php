<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th> 操作名称 </th>
            <th> 链接地址 </th>
            <th> 验证字符 </th>
            <th> 菜单中显示 </th>
            <th> 排序 </th>
            <th> 操作 </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($act as $val) {
            echo genTableCell($val);
            if ( !empty($val['subact']) ) {
                foreach ( $val['subact'] as $subval ) {
                    echo genTableCell($subval, '__');
                }
            }
        }?>
    </tbody>
</table>

<?php
function genTableCell($val, $indent = '') {
    $tr_class = $indent ? '' : 'class="info"';
    $cell = "<tr {$tr_class}>";
    $cell .= "<td> {$val['title']} </td>";
    $cell .= "<td> {$val['target']} </td>";
    $cell .= "<td> {$val['verify']} </td>";
    $cell .= "<td> {$val['display']} </td>";
    $cell .= "<td> {$val['orderby']} </td>";
    $cell .= '<td class="actions"><a href="/admin/action/edit/'.$val['id'].'" title="编辑">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> &nbsp;&nbsp;
        <a href="/admin/action/delete/'.$val['id'].'" title="删除" onclick="return confirm(\'确认删除？\');">
        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
        </td>';
    $cell .= "</tr>";
    return $cell;
}
