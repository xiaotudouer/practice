<?php
//****************************************************连接数据库及常用函数的被包含文件****************************************
//header("content-type:text/HTML;charset=utf-8");
//配置数据库信息
$db_host = "localhost";
$db_user = "root";
$db_pwd = "root";
$db_name = "bbs";
//连接数据库
$link = @mysql_connect($db_host,$db_user,$db_pwd);
//判断数据库是否连通
if(!$link)
{
  exit("数据库连接失败!请联系管理员!");
}
//选择数据库
if(!mysql_select_db($db_name))
{
  exit("选择数据库{$db_name}失败!");
}
//设置请求或返回数据的字符集
mysql_query("set names utf8");
//常用函数定义
function dump($arr = array())
{
  echo "<pre>";
  print_r($arr);
  echo "</pre>";
}
?>
