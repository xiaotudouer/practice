<?php
header("content-type:text/html;charset=utf-8");
//开启session会话
session_start();
//判断用户是否存在
if(!isset($_SESSION['username']))
{
  //跳转到登录页面
  echo "<script><location.href='./login.php'/script>";
  exit();//终止脚本向下运行
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="<?php echo $str_language; ?>" xml:lang="<?php echo $str_language; ?>">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>发布新帖</title>
<style type="text/css">
</style>
</head>
<body>
  <img />
</body>
</html>
