<?php
// 删除用户的逻辑

// 告诉我们应该删除那行记录了
$id = $_GET['id'];
$sql = "DELETE FROM `user` WHERE id={$id};";

mysql_connect('localhost', 'root', 'hahaha');
mysql_query('SET NAMES utf8');
mysql_select_db('userlist4');

// 将sql语句发送到mysql服务器里执行
if (mysql_query($sql)) {
    // 删除成功
    echo '删除成功';
    // 跳转?那个页面？=>跳转回用户列表页面，方便用户查看最新的用户列表
    header('Refresh: 3; url=userlist.php');
} else {
    // 删除失败
    echo '删除失败';
    header('Refresh: 3; url=userlist.php');
}