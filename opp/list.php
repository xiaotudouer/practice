<?php
header("content-type:text/html;charset=utf-8");
//包含公共的文件
require_once("./conn.php");
//构建执行sql语句
$sql = "select * from student order by id desc";
$arr = $db->getAllRows($sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>学生信息列表</title>
  </head>
  <body>
    <table width="800" border="3" bordercolor="red" align="center" cellpeding="5" rules="all">
      <tr align="center" bgcolor="grey">
        <th>编号</th>
        <th>姓名</th>
        <th>性别</th>
        <th>年龄</th>
        <th>学历</th>
        <th>工资</th>
        <th>奖金</th>
        <th>籍贯</th>
        <th>操作选项</th>
      </tr>
      <?php for($i=0;$i<count($arr);$i++){?>
      <tr align="center">
        <td><?php echo $arr[$i]['id'];?></td>
        <td><?php echo $arr[$i]['name'];?></td>
        <td><?php echo $arr[$i]['sex'];?></td>
        <td><?php echo $arr[$i]['age'];?></td>
        <td><?php echo $arr[$i]['edu'];?></td>
        <td><?php echo $arr[$i]['salary'];?></td>
        <td><?php echo $arr[$i]['bouns'];?></td>
        <td><?php echo $arr[$i]['city'];?></td>
        <td>
          <a href="edit.php?id=<?php echo $arr[$i]['id']?>">修改</a> |
          <a href="del.php?id=<?php echo $arr[$i]['id']?>">删除</a>
        </td>
      </tr>
      <?php }?>
      <tr align="center" class="pagelist">
        <td colspan="9">分页代码</td>
      </tr>
    </table>
  </body>
</html>
