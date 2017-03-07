<?php
header("content-type:text/html;charset=utf-8");
//包含连接数据库的文件
require_once("./conn.php");
//开启session会话
session_start();
//判断用户是否存在
if(isset($_SESSION['username']))
{
  //跳转到登录页面
  echo "<script>location.href='./login.php'</script>";
  exit();//结束脚本
}
//判断表单是否提交
if(isset($_POST['ac'])&& $_POST['ac']==$_SESSION['rand_value'])
{
  //获取表单提交值
  $title = $_POST['title'];
  $content = $_POST['content'];
  $addate = time();//记录帖子发布时间
  $uid = $_SESSION['uid'];//记录用户id
  //构建插入的sql语句
  $sql = "insert into thread(uid,title,content,addate)values($uid,'$title','$content',$addate)";
  //执行sql结果并进行判断
  if(mysql_query($sql))
  {
    $url = "./list.php";
    $msg = urlencode("帖子发布成功");
    echo "<script>location.href='./success.php?url=$url&message=$msg'</script>";
  }
}else {
  //如果没提交,非法操作,跳转到发帖页面
  header("location:send.php");
  exit();
}
?>
