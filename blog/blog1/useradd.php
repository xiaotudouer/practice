<?php

var_dump($_POST);
// 用户的添加的用户数据存到数据库里
mysqli_connect('localhost','root','root');
mysqli_query('set names utf8');
mysqli_select_db('userlist');
$sql = "INSERT INTO `user` ('username','nickname','email') values ('{$_POST['Username']}','{$_POST['Nickname']}','{$_POST['Email']}')";
//mysqli_query($sql);
//判断MySQL插入语句是否成功
if(mysqli_query($sql))
{
    //插入成功
    echo "插入成功!";
}else{
    //插入失败
    echo "插入失败!";
}
require 'useradd.html';