<?php

// 获取当前需要修改的用户，在html里回显出用户信息
$id = $_GET['id'];

mysql_connect('localhost', 'root', 'hahaha');
mysql_query('SET NAMES utf8');
mysql_select_db('userlist4');

var_dump($_POST);
if (!empty($_POST)) {
    $sql = "UPDATE `user` SET username='{$_POST['Username']}', nickname='{$_POST['Nickname']}', email='{$_POST['Email']}' WHERE id={$id}";
// 修改成功后，给用户一个友好的提示，修改失败后，给用户一个失败的提示
//      修改成功后，跳转到用户列表页
//      修改失败后，跳转到用户修改页
    if (mysql_query($sql)) {
        // 修改成功
        echo '修改成功';
        header('Refresh: 3; url=userlist.php');
    } else {
        // 修改失败了
        echo '修改失败';
        header('Refresh: 3; url=useredit.php?id=' . $id);
    }
} else {
    $sql = "SELECT * FROM `user` WHERE id={$id}";
    $resourceResult = mysql_query($sql);
    $user = mysql_fetch_assoc($resourceResult);
    var_dump($user);


    require 'useredit.html';
}