<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 17/1/9
 * Time: 21:15
 */

namespace app\controller\backend;


class UserController extends \core\Controller
{
    public function add()
    {

        //var_dump($_POST);
        // 用户的添加的用户数据存到数据库里
        /*sqli_connect('localhost','root','root');
        mysqli_query('set names utf8');
        mysqli_select_db('userlist');*/

        $userModel = Model::create('\app\model\UserModel');
        var_dump($userModel);die;

        if(!empty($_POST)) {

            $sql = "INSERT INTO `user` ('username','nickname','email') values ('{$_POST['Username']}','{$_POST['Nickname']}','{$_POST['Email']}')";
            //mysqli_query($sql);
            //判断MySQL插入语句是否成功
            if(mysqli_query($sql)) {
                //插入成功
                echo "插入成功!";
            } else {
                //插入失败
                echo "插入失败!";
            }
            require 'useradd.html';
        }

    }
    public function getList()
    {

    }
    public function delete()
    {

    }
    public function update()
    {

    }
}