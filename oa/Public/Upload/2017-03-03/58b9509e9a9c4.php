<?php
header("content-type:text/html;charset=utf-8");
//定义自动加载类文件的函数
function __autoload($className){
  require_once("$className.class.php");
}
//创建数据库对象
$config = array(
  'host' => 'localhost',
  'port' => '3306',
  'user' => 'root',
  'pwd' => 'root',
  'name' => 'student',
  'charset' => 'utf8'
);
$db = Db::getInstance($config);
?>
