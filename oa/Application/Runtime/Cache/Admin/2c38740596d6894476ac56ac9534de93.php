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
<div class="title"><h2>公文管理</h2></div>
<div class="table-operate ue-clear">
	<a href="/index.php/Admin/Doc/add" class="add">添加</a>
    <a href="javascript:;" id="btndel" class="del">删除</a>
    <a href="javascript:;" id="btnedit" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="id">序号</th>
                <th class="name">标题</th>
				<th class="file">附件</th>
                <th class="content">内容</th>
				<th class="addtime">添加时间</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            	<td class="id"><?php echo ($vo["id"]); ?></td>
                <td class="name"><?php echo ($vo["title"]); ?></td>
				<td class="file"><?php echo ($vo["filename"]); if($vo["hasfile"] == 1): ?>[<a href="javascript:;" class="download" data="<?php echo ($vo["id"]); ?>">下载</a>
                    ]<?php endif; ?>
                </td>
                <td class="content"><?php echo (msubstr(html_entity_decode($vo["content"]),0,20)); ?></td>
                <td class="addtime"><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
                <td class="operate">
                    <input type="checkbox" value="<?php echo ($vo["id"]); ?>"/>
                	<a href ='javascript:;' class="show" data="<?php echo ($vo["id"]); ?>" data-title="<?php echo ($vo["title"]); ?>">查看</a>
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
<script type="text/javascript" src="/Public/Admin/layer/layer.js"></script>
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

//jQuery
$(function () {
   $('.download').on('click',function () {
       //给下载按钮添加点击事件
     var id = $(this).attr('data');
     //跳转
       window.location.href = '/index.php/Admin/Doc/download/id/' + id;
   });
   //给查看按钮添加点击事件
    $('.show').on('click',function () {
       //获取公文id
        var id = $(this).attr('data');
        //获取公文标题
        var doc_title = $(this).attr('data-title');
        //alert(doc_title);
        layer.open({
           type: 2,
           title: doc_title,
            shadeClose: true,
            shade: 0.8,
            area: ['380px','90%'],
            content: '/index.php/Admin/Doc/getContent/id/' + id,
        });
    });
    //给编辑按钮添加点击事件
    $('.edit').on('click',function () {
       //获取被选择的id值
        var id = $(':checked:checked').val();
        //判断是否有id值传过来
        if(!id)
        {
            //提示请选择需要选择需要编辑的内容
            window.alert("请选择需要修改的数据!");
        }else{
            //跳转
            window.location.href = '/index.php/Admin/Doc/edit/id/' + id;
        }
    });
    //给删除按钮添加点击事件
    $('#btndel').on('click',function () {
       //获取被选中的id值
        var id = $(':checked:checked');
        //console.log(id);return;
        var ids = '';
        //循环取出id存的数据
        for(var i = 0;i < id.length;i++)
        {
            //将没读取的数据放到ids中,并以逗号隔开
            ids = ids + id[i].value + ',';
        }
        //去掉末尾的逗号
        ids = ids.substring(0,ids.length-1);
        //alert(ids);
        //跳转到删除方法
        window.location.href = '/index.php/Admin/Doc/del/ids/' + ids;
    });
});
</script>
</html>