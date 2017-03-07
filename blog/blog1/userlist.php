<?php
// 查询出所有用户，显示到html里
mysql_connect('localhost', 'root', 'root');
mysql_query('SET NAMES utf8');
mysql_select_db('userlist');

$sql = "SELECT * FROM user WHERE 2 > 1";
$resourceResult = mysql_query($sql);
var_dump($resourceResult);
// 从资源里获取数据？

$users = array();
while($user = mysql_fetch_assoc($resourceResult)) {
    $users[] = $user;
}
var_dump($users);

require 'userlist.html';