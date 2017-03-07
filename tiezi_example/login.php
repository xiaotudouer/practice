<?PHP
header("content-type:text/HTML;charset=utf-8");
//包含连接数据库文件
require_once("./include/conn.php");
//开启session并生成表单随机值
session_start();
$_SESSION['rand_value'] = uniqid();
//取出cookie数据
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="<?php echo $str_language; ?>" xml:lang="<?php echo $str_language;?>">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>用户注册页面</title>
<style type="text/css">
</style>
</head>
<body>
  <?php
//包含页面头文件
require_once("./header.php");
//
  ?>
  <img />
</body>
</html>
