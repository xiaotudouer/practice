<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
<style type='text/css'>
	table tr .id{ width:63px; text-align: center;}
	table tr .name{ width:118px; padding-left:17px;}
	table tr .nickname{ width:63px; padding-left:17px;}
	table tr .dept_id{ width:63px; padding-left:13px;}
	table tr .sex{ width:63px; padding-left:13px;}
	table tr .birthday{ width:80px; padding-left:13px;}
	table tr .tel{ width:113px; padding-left:13px;}
	table tr .email{ width:160px; padding-left:13px;}
	table tr .addtime{ width:160px; padding-left:13px;}
	table tr .operate{ padding-left:13px;}
</style>
</head>

<body>
<div class="title"><h2>知识管理</h2></div>
<div class="table-operate ue-clear">
	<a href="/index.php/Admin/Knowledge/add" class="add" id="btnadd">添加</a>
    <a href="javascript:;" class="del" id="btndel">删除</a>
    <a href="javascript:;" class="edit" id="btnedit">编辑</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="id">序号</th>
                <th class="title">标题</th>
				<th class="thumb">缩略图</th>
                <th class="picture">图片</th>
                <th class="description">描述</th>
                <th class="content">内容</th>
                <th class="author">作者</th>
				<th class="addtime">添加时间</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            	<td class="id"><?php echo ($vo["id"]); ?></td>
                <td class="title"><?php echo ($vo["title"]); ?></td>
				<td class="thumb"><?php echo ($vo["thumb"]); ?></td>
                <td class="picture"><?php echo ($vo["picture"]); ?></td>
                <td class="description"><?php echo ($vo["description"]); ?></td>
                <td class="content"><?php echo ($vo["content"]); ?></td>
                <td class="author"><?php echo ($vo["author"]); ?></td>
                <td class="addtime"><?php echo ($vo["addtime"]); ?></td>
                <td class="operate">
                	<a href ='javascript:;'>查看</a>
                    <input type="checkbox" value="<?php echo ($vo["id"]); ?>"/>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<div class="pagination ue-clear">
	<div class="pagin-list">
		<?php echo ($page); ?>
	</div>
	<div class="pxofy">共 <?php echo ($count); ?> 条记录</div>
</div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');

//jQuery事件
$(function () {
   //给删除按钮添加点击事件
    $('#btndel').on('click',function () {
       //id值
        var id = $(':checked:checked');
        var ids = '';
        //循环取出id值
        for(var i = 0;i < id.length;i++)
        {
            //将取出的id值以字符串的形式连接存到ids中
            ids = ids + id[i].value + ',';
        }
        //去掉末尾的逗号
        ids = ids.substring(0,ids.length-1);
        //console.log(ids);return;
        //传递参数给del方法
        window.location.href = '/index.php/Admin/Knowledge/del/ids/' + ids;
    });
    //给编辑按钮添加点击事件
    $('#btnedit').on('click',function () {
       //获取被选中id值
        var id = $(':checked:checked').val();
        //console.log(id);return;
        //判断是否选中id
        if(!id){
            window.alert('请选择需要修改的数据');
        }else{
            //跳转
            window.location.href = '/index.php/Admin/Knowledge/edit/id/' + id;
        }

    });
});
</script>
</html>