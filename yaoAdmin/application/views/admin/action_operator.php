<link href="/css/emoji.css?v=0.2.0" rel="stylesheet" type="text/css" />
<script src="/script/emoji.js?v=0.2.0"></script>
<style type="text/css">
    td { line-height: 20px; }
    .form {position: relative;}
    .search-input { padding:5px 3px; width: 100px; margin: 10px;}
    .submit{ position: absolute; top: 8px; left: 350px;}
</style>
<h1> <?php echo $title;?> </h1>
<div class="bloc">
    <div class="title">
    </div>
    <form method="get" action="/admin/action/operator" class="form">
        &nbsp;&nbsp;用户名<input type="text" name="userName" class="search-input"
            value="<?php echo isset($_GET['userName']) ? $_GET['userName'] : '';?>" placeholder="请输入检索用户的完整名称"/>
        <div class="submit"> <input type="submit"  value="搜索" /></div>
    </form>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th> ID </th>
                    <th> 用户 </th>
                    <th> 内容 </th>
                    <th> 时间 </th>
                    <th> 备注 </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach(array_slice($records, 0, 100) as $val) {
                    $d = explode(' ', $val);
                    if (count($d) < 5) { continue; }
                    echo "<tr>";
                    echo "<td>$d[5]</td>";
                    echo "<td>$d[6]</td>";
                    echo "<td>$d[4]</td>";
                    echo "<td>$d[0] $d[1]</td>";
                    echo (isset($d[7])) ? "<td>$d[7]</td>" : "<td>——</td>";
                    echo "</tr>";
                }?>
            </tbody>
        </table>
        <div style="text-align: center; font-size: 20px; color: red; line-height: 30px; margin-top: 5px;" class="loadMore"> 加载更多... </div>
        <div class="cb"></div>
    </div>
</div>

<script type="text/javascript">
    var curPage = 1;
    var nomore = false;
    var logs = '<?php echo json_encode($records);?>'.split('\n');
    $('.loadMore').click(function() {
        if (nomore) {
            alert('没有啦');
            return;
        }
        for (var i = 0; i < 100; i++) {
            index = i + curPage*100;
            if (logs[index]) {
                data = logs[index].split(' ');
                addData(data);
            } else {
                nomore = true;
                break;
            }
        }
        curPage += 1;
    });

    function addData(d) {
        if (6 < d.length) {
            var content = '';
            content += '<tr>';
            content += '<td>'+d[5]+'</td>';
            content += '<td>'+d[6].substr(0, d[6].length-3)+'</td>';
            content += '<td>'+d[4]+'</td>';
            content += '<td>'+d[0]+' '+d[1]+'</td>';
            content += d[7] ? '<td>'+d[7]+'</td>' : '<td>——</td>';
            content += '</tr>';
            $('table tbody').append(content);
        }
    }
</script>
